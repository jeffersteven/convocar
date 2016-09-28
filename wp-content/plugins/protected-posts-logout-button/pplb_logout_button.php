<?php 
/*
	Plugin Name: Protected Posts Logout Button
	Plugin URI: http://omfgitsnater.com/protected-posts-logout-button/
	Description: A plugin built to add a logout button automatically to protected posts.
	Version: 1.2
	Author: Nate Reist
	Author URI: http://omfgitsnater.com
*/

/*
	Add the logout button to posts which require a password and the password has been provided.
*/

function pplb_logout_filter($content){
	global $post;
	$html = '';
	
	//Check if the post has a password and we are inside the loop.
	if(!empty($post->post_password) && in_the_loop()){
		//Check to see if the password has been provided.
		if(!post_password_required(get_the_ID())){
			//add the logout button to the output.
			$options = get_option('pplb_options');
			$class = (array_key_exists('pplb_button_class', $options)) ? $options['pplb_button_class'] : '';
			$html .= ' <input type="button" class="button logout '.esc_attr($class).'" value="Cerrar sesión">';
		}
	}
	
	return $html.$content;
	
}

/*
	Ajax function to reset the cookie in wordpress.
*/

function pplb_protected_logout(){
	// Set the cookie to expire ten days ago... instantly logged out.
	setcookie('wp-postpass_' . COOKIEHASH, stripslashes( '' ), time() - 864000, COOKIEPATH);
	$options = get_option('pplb_options');
	$pplb_alert = (array_key_exists('pplb_alert', $options)) ? $options['pplb_alert'] : 'no';
	if($pplb_alert == 'yes'){
		echo stripslashes($options['pplb_message']);
	}
	else{
		echo 0;
	}
	die();
}
/*
	Enqueue the scripts.
*/
function pplb_logout_js(){
	wp_enqueue_script('pplb_logout_js', plugins_url('/logout.js', __FILE__), array('jquery'));
	wp_localize_script( 'pplb_logout_js', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

}

/*
	The settings page.
*/
function pplb_settings_page(){
	if(array_key_exists('pplb_action', $_POST)){
		//update the option.
		$options = array();
		$options['pplb_alert'] = (array_key_exists('pplb_alert', $_POST)) ? $_POST['pplb_alert']: 'no';
		$options['pplb_message'] = esc_attr($_POST['pplb_message']);
		$options['pplb_button_class'] = esc_attr($_POST['pplb_button_class']);
		update_option('pplb_options', $options);
	}
	$new_options = get_option('pplb_options');
	if(is_array($new_options)){
		extract($new_options);	
	}
	?>
		<div class="wrap">
			<h2>Protected Posts Logout Settings</h2>
			<p>Thanks for using this plugin.  If you encounter any errors please report them to <a href="mailto:nate@omfgitsnater.com">nate@omfgitsnater.com</a></p>
			<form action="" method="post">
					<input type="hidden" name="pplb_action" value="update" />
			<table cellpadding="5" width="400">
				<tbody>
					<tr>
						<td><label>Alert user log out was successful?</label></td><td> <input type="checkbox" name="pplb_alert" value="yes" <?php echo ($pplb_alert=='yes') ? ' checked="checked"': ''; ?> /></td>
					</tr>
					<tr>
						<td><label>Checkout Message:</label></td><td> <input type="text" name="pplb_message" value="<?php echo stripslashes($pplb_message); ?>" /></td>
					</tr>
					<tr>
						<td><label>Button CSS class:</label></td><td> <input type="text" name="pplb_button_class" value="<?php echo stripslashes($pplb_button_class); ?>" /></td>
					</tr>
				</tbody>
			</table>
			<p><input type="submit" value="Update" class="button-primary" /></p>
			</form>
		</div><!-- .wrap pplb -->
		
	<?php 
}

/*
	Add the admin page
*/
function pplb_add_admin(){
	add_options_page('Protected Post Logout Settings', 'Protected Post Logout', 'manage_options', 'pplb-settings-page', 'pplb_settings_page');
}

/*
	Activation hook to install the options if they haven't been installed before.
*/
function install_pplb_options(){
	if(!get_option('pplb_options')){
		$options = array(
			'pplb_alert' => 'no',
			'pplb_message' => 'Successfully logged out.',
			'pplb_button_class' => ''
		);
		update_option('pplb_options', $options);
	}
}

register_activation_hook( __FILE__ , 'install_pplb_options' );
add_action('admin_menu', 'pplb_add_admin');

add_filter('the_content', 'pplb_logout_filter', 10, 1); 			// adds the button.
add_action('wp_enqueue_scripts','pplb_logout_js'); 					// adds the script to the header.
add_action('wp_ajax_nopriv_pplb_logout', 'pplb_protected_logout'); 	// logout for non-logged in wp users
add_action('wp_ajax_pplb_logout', 'pplb_protected_logout'); 		// logout for logged in wp users


?>