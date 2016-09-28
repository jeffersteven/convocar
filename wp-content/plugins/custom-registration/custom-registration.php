<?php

/*
  Plugin Name: Custom Registration
  Plugin URI: http://code.tutsplus.com
  Description: Updates user rating based on number of posts.
  Version: 1.0
  Author: Agbonghama Collins
  Author URI: http://tech4sky.com
 */ 
function custom_registration_function() {
    if (isset($_POST['submit'])) {
        registration_validation(
        $_POST['username'],
        $_POST['password'],
        $_POST['email'],
        $_POST['website'],
        $_POST['fname'],
        $_POST['lname'],
        $_POST['nickname'],
        $_POST['bio'],
		$_POST['role'],
		$_POST['bloint'],
		$_POST['apca']
		);
		
		// sanitize user form input
        global $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio, $role, $grupo,$bloint,$apca;
        $username	= 	sanitize_user($_POST['username']);
        $password 	= 	esc_attr($_POST['password']);
        $email 		= 	sanitize_email($_POST['email']);
        $website 	= 	esc_url($_POST['website']);
        $first_name = 	sanitize_text_field($_POST['fname']).' '.sanitize_text_field($_POST['lname']);
        $last_name 	= 	'';
        $nickname 	= 	sanitize_text_field($_POST['nickname']);
        $bio 		= 	esc_textarea($_POST['bio']);
		$role		= 	sanitize_text_field($_POST['role']);
		$grupo		=	sanitize_text_field($_POST['grupo']);
		$bloint		=	sanitize_text_field($_POST['bloint']);
		$apca		=	sanitize_text_field($_POST['apca']);

		// call @function complete_registration to create the user
		// only when no WP_error is found
        complete_registration(
        $username,
        $password,
        $email,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $bio,
		$role,
		$grupo,
		$bloint,
		$apca
		);
    }

    registration_form(
    	$username,
        $password,
        $email,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $bio,
		$role,
		$grupo,
		$bloint,
		$apca
		);
}

function registration_form( $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio, $role, $grupo ,$bloint,$apca ) {
    echo '
    <style>
	div {
		margin-bottom:2px;
	}
	
	input{
		margin-bottom:4px;
	}
	</style>
	';
	$user_id = get_current_user_id();  // Get current user Id
		$user_groups = wp_get_object_terms($user_id, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
		foreach($user_groups as $user_gro){		
			$vari= wp_get_object_terms( $user_id, $user_gro->taxonomy);
			foreach($vari as $user_gro1){
				$grupo = $user_gro1->slug;
			}
		}
    echo '
    <form class="regus" action="' . $_SERVER['REQUEST_URI'] . '" method="post">
	<div>
	<label for="username">Cédula <strong>*</strong></label>
	<input type="text" name="username" value="">
	</div>
		
	<div>
	<label for="firstname">Nombres</label>
	<input type="text" name="fname" value="">
	</div>
	
	<div>
	<label for="website">Apellidos</label>
	<input type="text" name="lname" value="">
	</div>
	
	<div>
	<label for="password">Contraseña <strong>*</strong></label>
	<input type="text" name="password" value="'.esc_attr( wp_generate_password( 10 ) ).'">
	</div>
	
	<div>
	<label for="email">Email <strong>*</strong></label>
	<input type="text" name="email" value="">
	</div>
	
	<div style="display:none;">
	<label for="role">Role <strong>*</strong></label>
	<input type="text" name="role" value="usuario_conjunto">
	<input type="text" name="grupo" value="'.$grupo.'">
	</div>
	

	<div>
	<label for="bloint">Bloque/Interior</label>
	<input type="text" name="bloint" id="bloint" value="" class="regular-text" /><br />
	</div>
	<div>
	<label for="apca">Apartamento/Casa</label>
	<input type="text" name="apca" id="apca" value="" class="regular-text" /><br />
	
	</div>
	<input type="submit" name="submit" value="Registrar"/>
	</form>
	';
}

function registration_validation( $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio, $role,$bloint,$apca)  {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field', 'Campo de formulario requerido no encontrado.');
    }

    if ( strlen( $username ) < 4 ) {
        $reg_errors->add('username_length', 'La cedula debe tener al menos 4 caracteres.');
    }

    if ( username_exists( $username ) )
        $reg_errors->add('user_name', 'El usuario ya existe.');

    if ( !validate_username( $username ) ) {
        $reg_errors->add('username_invalid', 'El usuario ingresado es invalido.');
    }

    if ( strlen( $password ) < 7 ) {
        $reg_errors->add('password', 'Contraseña debe tener ser de longitud mínima de 8.');
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add('email_invalid', 'Email no valido.');
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add('email', 'Email esta siendo usado ya.');
    }
    
    if ( !empty( $website ) ) {
        if ( !filter_var($website, FILTER_VALIDATE_URL) ) {
            $reg_errors->add('website', 'Url no valida.');
        }
    }

    if ( is_wp_error( $reg_errors ) ) {

        foreach ( $reg_errors->get_error_messages() as $error ) {
            echo '<div>';
            echo '<strong>ERROR</strong>: ';
            echo $error . '<br/>';

            echo '</div>';
        }
    }
}

function complete_registration() {
    global $reg_errors, $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio, $role, $grupo,$bloint,$apca;
    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $userdata = array(
        'user_login'	=> 	$username,
        'user_email' 	=> 	$email,
        'user_pass' 	=> 	$password,
        'user_url' 		=> 	$website,
        'first_name' 	=> 	$first_name,
        'last_name' 	=> 	$last_name,
        'nickname' 		=> 	$nickname,
        'description' 	=> 	$bio,
		);
        $user = wp_insert_user( $userdata );
		$the_user = get_user_by('email', $email);
		$the_user_id = $the_user->ID;
		
		wp_set_password( $password, $the_user_id );
		wp_update_user( array ('ID' => $the_user_id, 'role' => $role ) ) ;
		wp_update_user( array ('ID' => $the_user_id, 'first_name' => $first_name ) ) ;
		update_user_meta($the_user_id, 'bloint', $bloint);
		update_user_meta($the_user_id, 'apca', $apca);
		$idc= term_exists($grupo);

		$term_taxonomy_ids = wp_set_object_terms( $the_user_id, intval($idc), 'user-group' );
       	echo '<div style="width:100%; text-aling:center; font-size:20px;">Registro completo!</div>';
				
	}
}

// Register a new shortcode: [cr_custom_registration]
add_shortcode('cr_custom_registration', 'custom_registration_shortcode');

// The callback function that will replace [book]
function custom_registration_shortcode() {
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}

function get_user_role() {
	global $current_user;

	$user_roles = $current_user->roles;
	$user_role = array_shift($user_roles);

	return $user_role;
}

// visualiza usuarios
add_shortcode('listausuarios', 'cust1');
function cust1($atts, $content = null ) {
     extract( shortcode_atts( array(
	      'role' => '',
		  'titulo' => ''
     ), $atts ) );
		$busc=$_POST['buscar'];
		$user_id = get_current_user_id();  // Get current user Id
		$user_groups = wp_get_object_terms($user_id, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
		foreach($user_groups as $user_gro){		
			$vari= wp_get_object_terms( $user_id, $user_gro->taxonomy);
			foreach($vari as $user_gro1){
				$grupo = $user_gro1->slug;
			}
		}
		
		$role="usuario_conjunto";
		$out='';
		$args = array(
			'orderby'       => 'nicename',
			'role' 			=> $role
		);
		$usuarios = get_users($args);

		$out.= '<div><a class="elimi vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-classic vc_btn3-color-grey" href="#">Eliminar todos los usuarios</a></div>';
		$out.= '<div><a class="delete_all vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-classic vc_btn3-color-grey" href="#">Acepto eliminar usuarios</a>';
		$out.= '<a class="cancel vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-classic vc_btn3-color-grey" href="#">Cancelar</a></div>';
		$out.='<div class="busc"><form action="" method="post">
					<input type="text" name="buscar" value=""><input type="submit" value="Buscar">
				</form></div>';
		
		
		
		$out.= '<div class="tabla"><table id="usertable" class="widefat userlist"><thead class="thead">';
		$out.= '<tr>
				<th class="th th1"><a>Cédula</a>
				</th>
				<th class="th th2"><a>Nombre</a>
				</th>
				<th class="th th3"><a>Email</a>
				</th>
				<th class="th th4"><a>Bloque/Interior</a>
				</th>
				<th class="th th5"><a>Apartamento/Casa</a>
				</th>
				<th class="th th6"><a>Eliminar</a>
				</th>
				</tr>';
		$out.= '</thead>';
		$out.= '<tfoot class="tfoot">';
		$out.= '<tr>
				<th class="th th1"><a>Cédula</a>
				</th>
				<th class="th th2"><a>Nombre</a>
				</th>
				<th class="th th3"><a>Email</a>
				</th>
				<th class="th th4"><a>Bloque/Interior</a>
				</th>
				<th class="th th5"><a>Apartamento/Casa</a>
				</th>
				<th class="th th6"><a>Eliminar</a>
				</th>
				</tr>';
		$out.= '</tfoot>';
		$out.= '';
		
		
		foreach ($usuarios as $usuario) {
			
			$user_id = $usuario->ID;  // Get current user Id
			$user_groups = wp_get_object_terms($user_id, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
			foreach($user_groups as $user_gro){		
				$vari= wp_get_object_terms( $user_id, $user_gro->taxonomy);
				foreach($vari as $user_gro1){
					$grupo2 = $user_gro1->slug;
				}
			}
			if($busc!=''){
				if($grupo==$grupo2){
					if( (!(strpos($usuario->user_login,$busc) === false))||(!(strpos($usuario->first_name,$busc) === false))||(!(strpos($usuario->last_name,$busc) === false))||(!(strpos($usuario->user_email,$busc) === false))||(!(strpos((esc_attr( get_the_author_meta( 'bloint', $usuario->ID ) )),$busc) === false))||(!(strpos((esc_attr( get_the_author_meta( 'apca', $usuario->ID ) )),$busc) === false))){
						$out.='<tr><td>';
						$out.= $usuario->user_login.'</td><td>';
						$out.= $usuario->first_name.' ';
						$out.= $usuario->last_name;
						$out.='</td><td><a href="mailto:';
						$out.=$usuario->user_email;
						$out.='">';
						$out.=$usuario->user_email;
						$out.='</a></td><td>';
						$out.=esc_attr( get_the_author_meta( 'bloint', $usuario->ID ) );
						$out.='</td><td>';
						$out.=esc_attr( get_the_author_meta( 'apca', $usuario->ID ) );
						$out.='</td><td>';
						$out.='<a class="delete_user" delete-user-id="' . $usuario->ID . '" href="#">Eliminar</a></td></tr>';
					}
				}
			
			}elseif($grupo==$grupo2){
					$out.='<tr><td>';
					$out.= $usuario->user_login.'</td><td>';
					$out.= $usuario->first_name.' ';
					$out.= $usuario->last_name;
					$out.='</td><td><a href="mailto:';
					$out.=$usuario->user_email;
					$out.='">';
					$out.=$usuario->user_email;
					$out.='</a></td><td>';
					$out.=esc_attr( get_the_author_meta( 'bloint', $usuario->ID ) );
					$out.='</td><td>';
					$out.=esc_attr( get_the_author_meta( 'apca', $usuario->ID ) );
					$out.='</td><td>';
					$out.='<a class="delete_user" delete-user-id="' . $usuario->ID . '" href="#">Eliminar</a></td></tr>';
			}
		}
		$out.= '';
		$out.= '</table></div>';
		
		
    return $out;
}


add_action( 'wp_head', 'my_action_javascript' );
function my_action_javascript() {

        ?>
        <script type="text/javascript" >
                jQuery(document).ready(function() {

                        jQuery(".delete_user").click(function() {

                                var current_element_var = jQuery(this);

                                var data = {
                                        'action': 'delete_user_action',
                                        'user_id': current_element_var.attr('delete-user-id'),
                                        'security': '<?php echo wp_create_nonce( "security-special-string" ) ?>'
                                };
                                jQuery.post('<?php echo admin_url( 'admin-ajax.php' ) ?>', data, function(response) {
                                        if (response == 'deleted_successfully') {
                                                current_element_var.hide();
                                                current_element_var.after('<span> Usuario eliminado </span>');
                                                current_element_var.remove();
                                        }
                                });

                                return false;

                        });
						
						
						
						
						jQuery(".elimi").click(function() {
								jQuery(".delete_all").show();
								jQuery(".cancel").show();
								jQuery(".elimi").hide();
						});
						jQuery(".cancel").click(function() {
								jQuery(".delete_all").hide();
								jQuery(".cancel").hide();
								jQuery(".elimi").show();
						});
						jQuery(".delete_all").click(function() {
										var borra=jQuery("#elimc input[type='radio']:checked").val();
										jQuery("#elimc input[type='radio']:checked").hide();
										var current_element_var = jQuery(this);

										var data = {
												'action': 'delete_all_user_action',
												'user_id': current_element_var.attr('delete-user-id'),
												'segurity': '<?php echo wp_create_nonce( "security-special-string" ) ?>',
												'user-group': borra
										};
										jQuery.post('<?php echo admin_url( 'admin-ajax.php' ) ?>', data, function(response) {
												if (response == 'deleted_successfully') {
														current_element_var.hide();
														current_element_var.after('<span> Usuarios del conjunto eliminados </span>');
														current_element_var.remove();
														jQuery('.delete_user').html('Eliminado');
												}
										});
									jQuery(".elimi").hide();
									jQuery(".cancel").hide();
										return false;
									
								
                        });

                });
        </script>
        <?php

}

add_action( 'wp_ajax_delete_user_action', 'delete_user_action_callback' );

function delete_user_action_callback() {
        check_ajax_referer( 'security-special-string', 'security' );
        wp_delete_user( $_POST['user_id'] );
        echo 'deleted_successfully';
        die();
}


add_action( 'wp_ajax_delete_all_user_action', 'delete_all_user_action_callback' );

function delete_all_user_action_callback() {
        check_ajax_referer( 'security-special-string', 'segurity' );
		
		$removegrupo = $_POST["user-group"];
		if($removegrupo!=''){
				$grupo = $removegrupo;
				$role="usuario_conjunto";
				$result = get_users( 'role='.$role );

				foreach($result as $row){
					   // A lot of code for styling the mail-..
					   $user_id = $row->ID;  // Get current user Id
					$user_groups = wp_get_object_terms($user_id, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
					foreach($user_groups as $user_gro){		
						$vari= wp_get_object_terms( $user_id, $user_gro->taxonomy);
						foreach($vari as $user_gro1){
							$grupo2 = $user_gro1->slug;
						}
					}
					
					if($grupo==$grupo2){					
						wp_delete_user( $user_id );
					}
				}
				$role="administrador_conjunto";
				$result = get_users( 'role='.$role );

				foreach($result as $row){
					   // A lot of code for styling the mail-..
					   $user_id = $row->ID;  // Get current user Id
					$user_groups = wp_get_object_terms($user_id, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
					foreach($user_groups as $user_gro){		
						$vari= wp_get_object_terms( $user_id, $user_gro->taxonomy);
						foreach($vari as $user_gro1){
							$grupo2 = $user_gro1->slug;
						}
					}
					
					if($grupo==$grupo2){					
						wp_delete_user( $user_id );
					}
				}
			
			
			$term=get_term_by( 'slug', $removegrupo, 'user-group');
			 wp_delete_term( $term->term_id, 'user-group');
			$out .='Usuarios y conjunto: '.$removegrupo.' - fueron eliminados con exito.';
			
		}else{
				$user_id = get_current_user_id();  // Get current user Id
				$user_groups = wp_get_object_terms($user_id, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
				foreach($user_groups as $user_gro){		
					$vari= wp_get_object_terms( $user_id, $user_gro->taxonomy);
					foreach($vari as $user_gro1){
						$grupo = $user_gro1->slug;
					}
				}
			
				$role="usuario_conjunto";
				$result = get_users( 'role='.$role );

				foreach($result as $row){
					   // A lot of code for styling the mail-..
					   $user_id = $row->ID;  // Get current user Id
					$user_groups = wp_get_object_terms($user_id, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
					foreach($user_groups as $user_gro){		
						$vari= wp_get_object_terms( $user_id, $user_gro->taxonomy);
						foreach($vari as $user_gro1){
							$grupo2 = $user_gro1->slug;
						}
					}
					
					if($grupo==$grupo2){
					
						wp_delete_user( $user_id );
					}
				}
		}
		
		echo 'deleted_successfully';
        die();
}

function send_mails($post_ID)  {
     global $wpdb;
     $post = get_post($post_ID);
     if ( !wp_is_post_revision( $post_ID ) ) {
			$user_id = get_current_user_id();  // Get current user Id
			$user_groups = wp_get_object_terms($user_id, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
			foreach($user_groups as $user_gro){		
				$vari= wp_get_object_terms( $user_id, $user_gro->taxonomy);
				foreach($vari as $user_gro1){
					$grupo = $user_gro1->slug;
				}
			}
	 
		 $contenido1 = $post->post_content;
         $excerpt = substr($contenido,0,255);
         $permalink = get_permalink($post_ID);
         $authorURL = get_author_posts_url($post->post_author);
         $title = $post->post_title;
		 $role="usuario_conjunto";
         $result = get_users( 'role='.$role );
         $origen = " ";
			$header = "From: Convocar.net <convocatorias@convocar.net> \r\n";
			$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
			$header .= "Mime-Version: 1.0 \r\n";
			$header .= "Content-Type: text/html";
	
		
		foreach($result as $row){
               // A lot of code for styling the mail-..
			   $user_id = $row->ID;  // Get current user Id
			$user_groups = wp_get_object_terms($user_id, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
			foreach($user_groups as $user_gro){		
				$vari= wp_get_object_terms( $user_id, $user_gro->taxonomy);
				foreach($vari as $user_gro1){
					$grupo2 = $user_gro1->slug;
				}
			}
			
			if($grupo==$grupo2){
				$contenido = '<img class="site_logo" style="max-width:100%;" src="http://convocar.net/wp-content/uploads/2016/03/Nueva-Publicacion-CONVOCAR-1.png" alt="Convocar"><br/><br/>';
				$contenido .= $contenido1;
				$contenido .= '<br/><br/><img src="http://convocar.net/wp-content/uploads/2015/08/fv.png" alt="fv" width="16" height="16" class="CToWUd">
				Nueva publicación en la cartelera virtual. <br/><br/><div style="font-size:16px;">Ver publicación aquí <a href="'.$permalink.'?per='.encrypt_decrypt('encrypt', $row->user_email).'">'.$title.'</a>.</div>';
				try{
					wp_mail($row->user_email,$title,$contenido,$header);
				throw new Exception($usuario->user_email);
										}catch(Exception $e){
											
										}
			}
        }
     }
     return $post_ID;
}
add_action( 'publish_post', 'send_mails' );


function agregar_usuario($username, $email, $password, $first_name, $last_name, $bloint,$apca ) {
			
			$reg_errors = new WP_Error; 
			$user_id = get_current_user_id();  // Get current user Id
			$user_groups = wp_get_object_terms($user_id, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
			foreach($user_groups as $user_gro){		
				$vari= wp_get_object_terms( $user_id, $user_gro->taxonomy);
				foreach($vari as $user_gro1){
					$grupo = $user_gro1->slug;
				}
			}
			$name=$first_name.' '.$last_name;
			$userdata = array(
			'user_login'	=> 	$username,
			'user_email' 	=> 	$email,
			'first_name' 	=> 	$name
			);
			
				if ( username_exists( $username ) ){
					$reg_errors->add('user_name', 'El usuario ya existe.');
				}
				if ( !validate_username( $username ) ) {
					$reg_errors->add('username_invalid', 'El usuario ingresado es invalido.');
				}

				if ( !is_email( $email ) ) {
					$reg_errors->add('email_invalid', 'Email no valido.');
				}

				if ( email_exists( $email ) ) {
					$reg_errors->add('email', 'Email esta siendo usado ya.');
				}
				
				if ( is_wp_error( $reg_errors ) ) {

					foreach ( $reg_errors->get_error_messages() as $error ) {
						echo '<div>';
						echo '<strong>ERROR</strong> para usuario:'.$username.'<br/>';
						echo $error . '<br/>';

						echo '</div>';
					}
				}else{
					
					$user = wp_insert_user( $userdata );
					$the_user = get_user_by('email', $email);
					$the_user_id = $the_user->ID;
					
					wp_set_password( $password, $the_user_id );
					wp_update_user( array ('ID' => $the_user_id, 'role' => 'usuario_conjunto' ) ) ;
					wp_update_user( array ('ID' => $the_user_id, 'first_name' => $name ) ) ;
					update_user_meta($the_user_id, 'bloint', $bloint);
					update_user_meta($the_user_id, 'apca', $apca);
					$idc= term_exists($grupo);

					$term_taxonomy_ids = wp_set_object_terms( $the_user_id, intval($idc), 'user-group' );
				}
			 
}

// subir cvs
add_shortcode('importuser', 'cust12');
function cust12($atts, $content = null ) {
     extract( shortcode_atts( array(
	      'role' => '',
		  'titulo' => ''
     ), $atts ) );
	 

	 
	$out='';
	$out .=	'<form id="featured_upload" method="post" action="#" enctype="multipart/form-data">
			<input type="file" name="my_image_upload" id="my_image_upload"  multiple="false" />
			'.wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ).'
			<input id="submit_my_image_upload" name="submit_my_image_upload" type="submit" value="Subir usuarios" />
		</form>';
		
			// These files need to be included as dependencies when on the front end.
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			require_once( ABSPATH . 'wp-admin/includes/media.php' );
			
			// Let WordPress handle the upload.
			// Remember, 'my_image_upload' is the name of our file input in our form above.
			$attachment_id = media_handle_upload( 'my_image_upload',get_the_ID());
			
			if (isset( $_POST['my_image_upload_nonce'])) {				
							$row = 1;
			if (($handle = fopen(wp_get_attachment_url($attachment_id), "r")) !== FALSE) {
				
				while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
					if($row!=1){
						$num = count($data);
						$row++;
							agregar_usuario($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6]);
						
					}else{
						$row++;
					}
				}
				echo 'Registro completo!'; 
				fclose($handle);
			}
					
					if ( is_wp_error( $attachment_id ) ) {
						// There was an error uploading the image.
					} else {
						// The image was uploaded successfully!
					}

				} else {

					// The security check failed, maybe show the user an error.
				}	
	
		
    return $out;
}



function auto_log() {
    if (!is_user_logged_in()) {
        $user_login =encrypt_decrypt('decrypt', $_GET['per']) ;
		
        $user = get_user_by( 'email', $user_login ); 
        $user_id = $user->ID;

        wp_set_current_user($user_id, $user_login);
        wp_set_auth_cookie($user_id);
        do_action('wp_login', $user_login);
	}
}
add_action('init', 'auto_log');

function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'desen';
    $secret_iv = 'endes';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

add_filter('body_class','add_role_tobody');
function add_role_tobody($classes) {
    $current_user = new WP_User(get_current_user_id());
    $user_role = array_shift($current_user->roles);
    $classes[] = $user_role;
    return $classes;
}

add_action( 'show_user_profile', 'extra_profile' );
add_action( 'edit_user_profile', 'extra_profile' );

function extra_profile( $user ) { ?>

	<table class="form-table nomen">

		<tr>
			<th><label for="bloint">Bloque/Interior</label></th>

			<td>
				<input type="text" name="bloint" id="bloint" value="<?php echo esc_attr( get_the_author_meta( 'bloint', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Por favor ingresa tu Bloque/Interior.</span>
			</td>
		</tr>
		<tr>
			<th><label for="apca">Apartamento/Casa</label></th>

			<td>
				<input type="text" name="apca" id="apca" value="<?php echo esc_attr( get_the_author_meta( 'apca', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Por favor ingresa tu Apartamento/Casa.</span>
			</td>
		</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'save_extra_profile' );
add_action( 'edit_user_profile_update', 'save_extra_profile' );

function save_extra_profile( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'bloint' to the field ID. */
	update_usermeta( $user_id, 'bloint', $_POST['bloint'] );
	update_usermeta( $user_id, 'apca', $_POST['apca'] );
}


/*--Administradores conjuntos REGISTRO--*/
function custom_registration_function2() {
    if (isset($_POST['submit'])) {
        registration_validation2(
        $_POST['username'],
        $_POST['password'],
        $_POST['email'],
        $_POST['website'],
        $_POST['fname'],
        $_POST['lname'],
        $_POST['nickname'],
        $_POST['bio'],
		$_POST['role'],
		$_POST['bloint'],
		$_POST['apca'],
		$_POST['user-group']
		);
		
		// sanitize user form input
        global $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio, $role, $grupo,$bloint,$apca,$group,$nombreorazon, $nit, $direccion, $ciudad,$personaadmin,$personapres,$zona,$telefonos,$celular,$estrato,$terminos,$deseomail;
        $username	= 	sanitize_user($_POST['username']);
        $password 	= 	esc_attr($_POST['password']);
        $email 		= 	sanitize_email($_POST['email']);
        $website 	= 	esc_url($_POST['website']);
        $first_name = 	sanitize_text_field($_POST['fname']).' '.sanitize_text_field($_POST['lname']);
        $last_name 	= 	'';
        $nickname 	= 	sanitize_text_field($_POST['nickname']);
        $bio 		= 	esc_textarea($_POST['bio']);
		$role		= 	sanitize_text_field($_POST['role']);
		$grupo		=	sanitize_text_field($_POST['grupo']);
		$bloint		=	sanitize_text_field($_POST['bloint']);
		$apca		=	sanitize_text_field($_POST['apca']);
		$group		=   sanitize_text_field($_POST['user-group']);
		$nombreorazon=	$_POST['NOMBREORAZON'];
		$nit		=	$_POST['NIT'];
		$direccion	=	$_POST['DIRECCION'];
		$ciudad		=	$_POST['CIUDAD'];
		$personaadmin=	$_POST['PERSONAADMIN'];
		$personapres=	$_POST['PERSONAPRES'];
		$zona		=	$_POST['ZONA'];
		$telefonos	=	$_POST['TELEFONOS'];
		$celular	=	$_POST['CELULAR'];
		$estrato	=	$_POST['ESTRATO'];
		if (isset($_POST['TERMINOS'])) {
			$terminos	=	true;
		} else {
			$terminos	=	false;
		}
		if (isset($_POST['DESEOMAIL'])) {
			$deseomail	=	true;
		} else {
			$deseomail	=	false;
		}
		
		// call @function complete_registration2 to create the user
		// only when no WP_error is found
        complete_registration2(
        $username,
        $password,
        $email,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $bio,
		$role,
		$grupo,
		$bloint,
		$apca,
		$group,
		$nombreorazon,$nit,$direccion,$ciudad,$personaadmin,$personapres, $zona,$telefonos,$celular,$estrato,$terminos,$deseomail
		
		);
    }

    registration_form2(
    	$username,
        $password,
        $email,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $bio,
		$role,
		$grupo,
		$bloint,
		$apca,
		$group
		);
}

function registration_form2( $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio, $role, $grupo ,$bloint,$apca,$group ) {
    echo '
    <style>
	div {
		margin-bottom:2px;
	}
	
	input{
		margin-bottom:4px;
	}
	</style>
	';
	$pass= esc_attr( wp_generate_password( 10 ) );
    echo '
	<div class="nuevoadco propiedadhorizontal">
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
	<div>
	<label for="username">Cédula/Usuario (*)</label>
	<input type="text" name="username" value="' . $_POST['username'] . '">
	</div>
	
	<div>
	<label for="email">Correo electrónico (*)</label>
	<input type="text" name="email" value="' . $_POST['email'] . '">
	<label><span class="suave">A este correo le será enviada la respuesta de convocatorias y vacantes.<br>
	Importante: Revise su  bandeja de SPAM.  Al momento de recibir el primer correo enviado por CONVOCAR.NET,  favor incluirnos dentro de sus contactos para garantizar su recepción.
	</span></label>
	</div>
	<div>
	<p id="cimy_uef_p_field_3" class="NOMBREORAZON">
		<label for="cimy_uef_3">Conjunto(*)</label><input type="text" name="NOMBREORAZON" id="cimy_uef_3" class="cimy_uef_input_27" value="' . $_POST['NOMBREORAZON'] . '" maxlength="100" p="">
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_1" class="NIT">
		<label for="cimy_uef_1">Nit.(*)</label><input name="NIT" id="cimy_uef_1" class="cimy_uef_input_27" value="' . $_POST['NIT'] . '" maxlength="100"  type="text">
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_4" class="DIRECCION">
		<label for="cimy_uef_4">Dirección(*)</label><input name="DIRECCION" id="cimy_uef_4" class="cimy_uef_input_27" value="' . $_POST['DIRECCION'] . '" maxlength="100"  type="text">
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_5" class="CIUDAD">
		<label for="cimy_uef_5">Ciudad(*)</label><input name="CIUDAD" id="cimy_uef_5" class="cimy_uef_input_27" value="' . $_POST['CIUDAD'] . '" maxlength="100"  type="text">
	</p>
	</div>
	
	<div style="">
	<p id="cimy_uef_p_field_6" class="PERSONAADMIN">
		<label for="cimy_uef_6">Nombre Administrador(a)(*)</label><input name="PERSONAADMIN" id="cimy_uef_6" class="cimy_uef_input_27" value="' . $_POST['PERSONAADMIN'] . '" maxlength="100" type="text">
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_19" class="PERSONAPRES">
		<label for="cimy_uef_19">Nombre presidente(a) concejo</label><input name="PERSONAPRES" id="cimy_uef_19" class="cimy_uef_input_27" value="' . $_POST['PERSONAPRES'] . '" maxlength="50"  type="text">
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_desc_7" class="description des1 ZONA"><br>Número de zona de Ubicación para Bogotá(*)<a class="cboxElement" title="Clic en tu zona" rel="lightbox[test demo]" href="/wp-content/themes/increase/img/MAPA-CONVICAR.jpg" usemap="#MapC">    Clic aqui para ver zonas</a><map name="MapC"><area shape="rect" coords="598,398,600,400" alt="Image Map" style="outline:none;" title="Image Map"><area id="4" alt="" title="" href="javascript:selec(4);" shape="poly" coords="60,78,232,77,246,82,260,58,244,59,228,47,203,39,198,28,188,35,178,33,164,38,151,31,146,30,139,31,134,26,133,23,133,20,126,24,126,39,117,31,110,32,112,47,87,37,84,34,76,42,55,50,55,61,54,67" style="outline:none;"><area id="2" alt="" title="" href="javascript:selec(2);" shape="poly" coords="252,85,264,61,273,59,279,68,293,67,301,67,312,65,319,66,319,84,326,87,311,105,265,109,254,103" style="outline:none;"><area id="1" alt="" title="" href="javascript:selec(1);" shape="poly" coords="326,71,325,81,333,82,314,106,390,139,397,130,412,97,426,85,424,77,404,77,397,75,398,67,391,70,383,76,370,68,352,62" style="outline:none;"><area id="6" alt="" title="" href="javascript:selec(6);" shape="poly" coords="449,77,478,90,494,86,490,94,481,97,460,96,444,113,465,119,484,115,492,118,497,103,505,98,514,100,543,98,552,99,560,95,567,100,561,108,571,107,573,117,568,118,568,126,573,136,562,142,543,125,529,125,510,144,491,143,484,149,481,141,471,142,462,166,471,167,480,191,467,197,465,209,456,206,451,207,453,197,450,196,442,193,432,206,435,214,426,223,423,223,413,230,423,239,434,237,437,249,423,265,421,282,430,295,438,297,437,309,467,329,443,343,435,351,421,346,425,338,425,327,412,327,415,320,407,311,404,309,412,301,396,287,387,282,377,295,374,288,365,287,369,305,367,314,347,293,344,282,333,276,322,284,308,284,341,257,367,169,402,133,415,98" style="outline:none;"><area id="5" alt="" title="" href="javascript:selec(5);" shape="poly" coords="173,196,198,194,201,212,196,214,188,212,186,217,195,225,194,237,202,248,208,246,218,265,225,257,236,260,242,257,254,259,266,255,275,233,291,242,289,249,313,276,337,256,363,168,388,144,304,107,262,113,249,103,253,91,241,89,231,113,215,119,197,173" style="outline:none;"><area id="3" alt="" title="" href="javascript:selec(3);" shape="poly" coords="68,81,70,96,66,101,68,108,80,111,88,124,97,121,105,133,88,146,100,159,108,156,111,164,111,172,115,185,121,196,127,200,132,196,139,196,140,205,154,205,164,196,178,193,194,171,209,119,229,111,236,84,230,78" style="outline:none;"><area id="7" alt="" title="" href="javascript:selec(7);" shape="poly" coords="25,74,49,78,69,129,97,182,145,229,189,257,255,282,329,316,373,326,402,351,328,363,176,344,91,320,51,322,30,314" style="outline:none;"></map></p>
	<p id="cimy_uef_p_field_7" class="ZONA">
		<label for="cimy_uef_7"></label><select name="ZONA" id="cimy_uef_7" class="cimy_uef_input_27">
			<option value="Aqui">Aqui</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option></select>
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_9" class="TELEFONOS">
		<label for="cimy_uef_9">Telefono(*)</label><input name="TELEFONOS" id="cimy_uef_9" class="cimy_uef_input_27" value="' . $_POST['TELEFONOS'] . '" maxlength="30" type="text">
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_18" class="CELULAR">
		<label for="cimy_uef_18">Celular(*)</label><input name="CELULAR" id="cimy_uef_18" class="cimy_uef_input_27" value="' . $_POST['CELULAR'] . '" maxlength="30" type="text">
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_29" class="ESTRATO">
		<label for="cimy_uef_29">Estrato</label><select name="ESTRATO" id="cimy_uef_29" class="cimy_uef_input_27">
			<option value="Aqui">Aqui</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option></select>
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_22" class="TERMINOS">
		<input name="TERMINOS" id="cimy_uef_22" class="cimy_uef_checkbox" value="true" type="checkbox"> He leído y estoy de acuerdo con los <a href="http://convocar.net/terminos-y-condiciones/" class="colorbox-link cboxElement" title="Términos y condiciones"> Términos y condiciones generales</a>, <a href="http://convocar.net/terminos-internas/" class="colorbox-link cboxElement" title="Términos y condiciones">Términos y condiciones internas</a> y las <a href="http://convocar.net/politica-datos-pers-2/" class="colorbox-link cboxElement" title="Términos y condiciones">Políticas y tratamiento de datos personales</a>.<br>
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_27" class="DESEOMAIL">
		<input name="DESEOMAIL" id="cimy_uef_27" class="cimy_uef_checkbox" value="true" checked="checked" type="checkbox"> Deseo recibir correos de convocar.net.<br>
	</p>
	</div>

	
	<div style="display:none;">
	<label for="role">Role <strong>*</strong></label>
	<input type="text" name="role" value="administrador_conjunto">
	<input type="text" name="grupo" value="">
	</div>	
	
	
	<div>
	<p id="cimy_uef_wp_p_field_20" class="PASSWORD">
		<label for="cimy_uef_wp_20">Contraseña</label><input name="password" id="pass12" class="cimy_uef_input_27" value="" maxlength="100"  type="password">
	</p>
	<p id="cimy_uef_wp_p_field_21" class="PASSWORD2">
		<label for="cimy_uef_wp_21">Confirmar contraseña</label><input name="PASSWORD2" id="pass22" class="cimy_uef_input_27" value="" maxlength="100" type="password">
	</p>
		<div id="pass-strength-result">Indicador de seguridad</div>
		<p class="description indicator-hint">Sugerencia: La contraseña debe tener al menos siete caracteres. Para hacerlo más fuerte, use letras mayúsculas y minúsculas, números y símbolos como (! "? $% ^ &amp;).</p>
	</div>
	
	
	
	<input class="reg" type="submit" name="submit" value="Registrar"/>
	</form></div>
	';
}

function edit_user_user_group_section2() {

		$terms = get_terms( 'user-group', array( 'hide_empty' => false ) ); 
		
		$out='';
		$out .= '<h3 id="user-groups">Conjunto</h3>
				<table class="form-table">
					<tr>
						<td>
						<div style="overflow-y:auto; max-height: 250px;">';
			/* If there are any terms available, loop through them and display checkboxes. */
					if ( !empty( $terms ) ) {
						$out .= '<ul>';
						foreach ( $terms as $term ) { 
							
						$out .=	'<li><input type="radio" name="user-group" id="user-group-'.esc_attr( $term->slug ).'" value="'.esc_attr( $term->slug ).'"/> <label for="user-group-'.esc_attr( $term->slug ).'">'. $term->name.'</label></li>';
						}
						$out .=	 '</ul>';
					}
			$out .=	'</div>
					</td>
					
			</tr>
		</table>';		
					
		return $out;
	}

function registration_validation2( $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio, $role,$bloint,$apca)  {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field', 'Campo de formulario requerido no encontrado.');
    }

    if ( strlen( $username ) < 4 ) {
        $reg_errors->add('username_length', 'Debe tener al menos 4 caracteres.');
    }

    if ( username_exists( $username ) )
        $reg_errors->add('user_name', 'El usuario ya existe.');

    if ( !validate_username( $username ) ) {
        $reg_errors->add('username_invalid', 'El usuario ingresado es invalido.');
    }

    if ( strlen( $password ) < 5 ) {
        $reg_errors->add('password', 'Contraseña debe tener más de 5 letras.');
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add('email_invalid', 'Email no valido.');
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add('email', 'Email esta siendo usado ya.');
    }
    
    if ( !empty( $website ) ) {
        if ( !filter_var($website, FILTER_VALIDATE_URL) ) {
            $reg_errors->add('website', 'Url no valida.');
        }
    }

    if ( is_wp_error( $reg_errors ) ) {

        foreach ( $reg_errors->get_error_messages() as $error ) {
            echo '<div>';
            echo '<strong>ERROR</strong>:';
            echo $error . '<br/>';

            echo '</div>';
        }
    }
}

function complete_registration2() {
    global $reg_errors, $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio, $role, $grupo,$bloint,$apca,$group,$nombreorazon, $nit, $direccion, $ciudad,$personaadmin,$personapres,$zona,$telefonos,$celular,$estrato,$terminos,$deseomail;;
    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $userdata = array(
        'user_login'	=> 	$username,
        'user_email' 	=> 	$email,
        'user_pass' 	=> 	$password,
        'user_url' 		=> 	$website,
        'first_name' 	=> 	$first_name,
        'last_name' 	=> 	$last_name,
        'nickname' 		=> 	$nickname,
        'description' 	=> 	$bio,
		);
        $user = wp_insert_user( $userdata );
		$the_user = get_user_by('email', $email);
		$the_user_id = $the_user->ID;

		wp_set_password( $password, $the_user_id );
		wp_update_user( array ('ID' => $the_user_id, 'role' => $role ) ) ;
		wp_update_user( array ('ID' => $the_user_id, 'first_name' => $first_name ) ) ;
		update_user_meta($the_user_id, 'bloint', $bloint);
		update_user_meta($the_user_id, 'apca', $apca);
				
				set_cimyFieldValue($the_user_id, 'NOMBREORAZON', $nombreorazon);
				set_cimyFieldValue($the_user_id, 'NIT', $nit);
				set_cimyFieldValue($the_user_id, 'DIRECCION', $direccion);
				set_cimyFieldValue($the_user_id, 'CIUDAD', $ciudad);
				set_cimyFieldValue($the_user_id, 'PERSONAADMIN', $personaadmin);
				set_cimyFieldValue($the_user_id, 'PERSONAPRES', $personapres);
				set_cimyFieldValue($the_user_id, 'ZONA', $zona);
				set_cimyFieldValue($the_user_id, 'TELEFONOS', $telefonos);
				set_cimyFieldValue($the_user_id, 'CELULAR', $celular);
				set_cimyFieldValue($the_user_id, 'ESTRATO', $estrato);
				set_cimyFieldValue($the_user_id, 'TERMINOS', $terminos);
				set_cimyFieldValue($the_user_id, 'DESEOMAIL', $deseomail);
		addconjunto($nombreorazon);		
		$idc= term_exists($nombreorazon);

		$term_taxonomy_ids = wp_set_object_terms( $the_user_id, intval($idc), 'user-group' );
		try{
					wp_mail( $email, "Bienvenido a convocar", '


                              <div style="padding: 15px 0;">
								Bienvenido a Convocar <br/><br/>

								Tu nombre de usuario es: '.$username.'<br/>
								Tu contraseña: '.$password.'<br/>
								</div>
															  
													  ' );
				throw new Exception($usuario->user_email);
										}catch(Exception $e){
											
										}
		
		echo '<div style="width:100%; text-aling:center; font-size:20px;">Registro completo!</div>
			<style>
				.nuevoadco.propiedadhorizontal{
					display:none !important;
				}
			</style>
			<div class="vc_btn3-container vc_btn3-inline"><a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-classic vc_btn3-color-grey" href="http://convocar.net/usuarios-especificos-registro-administrador/" title="" target="_self">Agregar administrador de conjunto</a></div>';
	}
}



// Register a new shortcode: [cr_custom_registration_admin]
add_shortcode('cr_custom_registration_admin', 'custom_registration_shortcode2');

// The callback function that will replace [book]
function custom_registration_shortcode2() {
    ob_start();
    custom_registration_function2();
    return ob_get_clean();
}


add_shortcode('add_conjunto', 'custom22');
function custom22() {
		$out='';
		$grupo = $_POST["grupo"];
		if($grupo!=''){
			$term = term_exists($grupo, 'user-group');
				if ($term !== 0 && $term !== null) {
				  $out .='Conjunto: '.$grupo.' - ya existe.';
				}else{
				wp_insert_term( $grupo, 'user-group');
				$out .='Conjunto: '.$grupo.' - fue añadido con exito.';
			}
			
		}
		
		/*$out .='<form action="" method="post" id="">
            Conjunto: <input name="grupo" type="text" />
            <input name="mySubmit" type="submit" value="Añadir" />
        </form>';*/
		
		/*$removegrupo = $_POST["user-group"];
		if($removegrupo!=''){
		$term=get_term_by( 'slug', $removegrupo, 'user-group');
			 wp_delete_term( $term->term_id, 'user-group');
			$out .='Conjunto: '.$removegrupo.' - fue eliminado con exito.';
		}*/
		$out .= '<form action="" method="post" id="elimc">'.edit_user_user_group_section2().'
						
						<input class="delete_all" name="mySubmit" type="submit" value="Eliminar conjunto y usuarios" />
				</form>';
				
		
    return $out;
}


function addconjunto($grup) {
		$out='';
		$grupo = $grup;
		if($grupo!=''){
			$term = term_exists($grupo, 'user-group');
				if ($term !== 0 && $term !== null) {
				  $out .='Conjunto: '.$grupo.' - ya existe.';
				}else{
				wp_insert_term( $grupo, 'user-group');
				$out .='Conjunto: '.$grupo.' - fue añadido con exito.';
			}	
		}
}



/*--Proveedores REGISTRO--*/
function custom_registration_function3() {
    if (isset($_POST['submit'])) {
        registration_validation3(
        $_POST['username'],
        $_POST['password'],
        $_POST['email'],
        $_POST['website'],
        $_POST['fname'],
        $_POST['lname'],
        $_POST['nickname'],
        $_POST['bio'],
		$_POST['role'],
		$_POST['bloint'],
		$_POST['apca'],
		$_POST['user-group']
		);
		
		// sanitize user form input
        global $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio, $role, $grupo,$bloint,$apca,$group,$nombreorazon, $nit, $direccion, $ciudad,$zona,$telefonos,$celular,$terminos,$deseomail,$descripcion,$web,$categoria,$logo;
        $username	= 	sanitize_user($_POST['username']);
        $password 	= 	esc_attr($_POST['password']);
        $email 		= 	sanitize_email($_POST['email']);
        $website 	= 	esc_url($_POST['website']);
        $first_name = 	sanitize_text_field($_POST['fname']).' '.sanitize_text_field($_POST['lname']);
        $last_name 	= 	$_POST['PRIORIDAD'];;
        $nickname 	= 	sanitize_text_field($_POST['nickname']);
        $bio 		= 	esc_textarea($_POST['bio']);
		$role		= 	sanitize_text_field($_POST['role']);
		$grupo		=	sanitize_text_field($_POST['grupo']);
		$bloint		=	sanitize_text_field($_POST['bloint']);
		$apca		=	sanitize_text_field($_POST['apca']);
		$group		=   sanitize_text_field($_POST['user-group']);
		$nombreorazon=	$_POST['NOMBREORAZON'];
		$nit		=	$_POST['NIT'];
		$direccion	=	$_POST['DIRECCION'];
		$ciudad		=	$_POST['CIUDAD'];
		$zona		=	$_POST['ZONA'];
		$telefonos	=	$_POST['TELEFONOS'];
		$celular	=	$_POST['CELULAR'];
		$descripcion=	$_POST['DESCRIPCION'];
		$web		=	$_POST['WEB'];
		$categoria  = 	$_POST['CATEGORIA'];
		$logo  		= 	$_FILES['LOGO'];
		


		if (isset($_POST['TERMINOS'])) {
			$terminos	=	true;
		} else {
			$terminos	=	false;
		}
		if (isset($_POST['DESEOMAIL'])) {
			$deseomail	=	true;
		} else {
			$deseomail	=	false;
		}
		
		// call @function complete_registration2 to create the user
		// only when no WP_error is found
        complete_registration3(
        $username,
        $password,
        $email,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $bio,
		$role,
		$grupo,
		$bloint,
		$apca,
		$group,
		$nombreorazon,$nit,$direccion,$ciudad,$personaadmin,$personapres, $zona,$telefonos,$celular,$estrato,$terminos,$deseomail
		
		);
    }

    registration_form3(
    	$username,
        $password,
        $email,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $bio,
		$role,
		$grupo,
		$bloint,
		$apca,
		$group
		);
}

function registration_form3( $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio, $role, $grupo ,$bloint,$apca,$group ) {
    echo '
    <style>
	div {
		margin-bottom:2px;
	}
	
	input{
		margin-bottom:4px;
	}
	</style>
	';
		


	$allFields = get_cimyFields();

	if (count($allFields) > 0) {
		foreach ($allFields as $field) {
			if (cimy_uef_sanitize_content($field['NAME'])=='CATEGORIA'){

			$cadlab=preg_split("/,/", cimy_uef_sanitize_content($field['LABEL']));
			$salida='';
				foreach($cadlab as $lab){
					$salida .='<option value="'.$lab.'">'.$lab.'</option>';
				}

			}
		}
	}
	

    echo '
	<div class="nuevoadco proveedores">
    <form name="registerform" id="registerform" action="' . $_SERVER['REQUEST_URI'] . '" method="post">
	<div>
	<label for="username">Cédula/Usuario (*)</label>
	<input type="text" name="username" value="' . $_POST['username'] . '">
	</div>
	
	<div>
	<label for="email">Correo electrónico (*)</label>
	<input type="text" name="email" value="' . $_POST['email'] . '">
	<label><span class="suave">A este correo le será enviada la respuesta de convocatorias y vacantes.<br>
	Importante: Revise su  bandeja de SPAM.  Al momento de recibir el primer correo enviado por CONVOCAR.NET,  favor incluirnos dentro de sus contactos para garantizar su recepción.
	</span></label>
	</div>
	<div>
	<p id="cimy_uef_p_field_3" class="NOMBREORAZON">
		<label for="cimy_uef_3">Nombre ó Razón Social(*)</label><input type="text" name="NOMBREORAZON" id="cimy_uef_3" class="cimy_uef_input_27" value="' . $_POST['NOMBREORAZON'] . '" maxlength="100" p="">
	</p>
	</div>
	<div>
	<p id="cimy_uef_p_field_755" class="PRIORIDAD">
	<label for="cimy_uef_755">Prioridad</label>
		<select name="PRIORIDAD" id="cimy_uef_755" class="cimy_uef_input_2755">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option></select>
	</p>
	</div>
	<div>
	<p id="cimy_uef_p_field_1" class="NIT">
		<label for="cimy_uef_1">Nit.(*)</label><input name="NIT" id="cimy_uef_1" class="cimy_uef_input_27" value="' . $_POST['NIT'] . '" maxlength="100"  type="text">
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_4" class="DIRECCION">
		<label for="cimy_uef_4">Dirección(*)</label><input name="DIRECCION" id="cimy_uef_4" class="cimy_uef_input_27" value="' . $_POST['DIRECCION'] . '" maxlength="100"  type="text">
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_5" class="CIUDAD">
		<label for="cimy_uef_5">Ciudad(*)</label><input name="CIUDAD" id="cimy_uef_5" class="cimy_uef_input_27" value="' . $_POST['CIUDAD'] . '" maxlength="100"  type="text">
	</p>
	</div>
	
		
	<div>
	<p id="cimy_uef_p_desc_7" class="description des1 ZONA"><br>Número de zona de Ubicación para Bogotá(*)<a class="cboxElement" title="Clic en tu zona" rel="lightbox[test demo]" href="/wp-content/themes/increase/img/MAPA-CONVICAR.jpg" usemap="#MapC">    Clic aqui para ver zonas</a><map name="MapC"><area shape="rect" coords="598,398,600,400" alt="Image Map" style="outline:none;" title="Image Map"><area id="4" alt="" title="" href="javascript:selec(4);" shape="poly" coords="60,78,232,77,246,82,260,58,244,59,228,47,203,39,198,28,188,35,178,33,164,38,151,31,146,30,139,31,134,26,133,23,133,20,126,24,126,39,117,31,110,32,112,47,87,37,84,34,76,42,55,50,55,61,54,67" style="outline:none;"><area id="2" alt="" title="" href="javascript:selec(2);" shape="poly" coords="252,85,264,61,273,59,279,68,293,67,301,67,312,65,319,66,319,84,326,87,311,105,265,109,254,103" style="outline:none;"><area id="1" alt="" title="" href="javascript:selec(1);" shape="poly" coords="326,71,325,81,333,82,314,106,390,139,397,130,412,97,426,85,424,77,404,77,397,75,398,67,391,70,383,76,370,68,352,62" style="outline:none;"><area id="6" alt="" title="" href="javascript:selec(6);" shape="poly" coords="449,77,478,90,494,86,490,94,481,97,460,96,444,113,465,119,484,115,492,118,497,103,505,98,514,100,543,98,552,99,560,95,567,100,561,108,571,107,573,117,568,118,568,126,573,136,562,142,543,125,529,125,510,144,491,143,484,149,481,141,471,142,462,166,471,167,480,191,467,197,465,209,456,206,451,207,453,197,450,196,442,193,432,206,435,214,426,223,423,223,413,230,423,239,434,237,437,249,423,265,421,282,430,295,438,297,437,309,467,329,443,343,435,351,421,346,425,338,425,327,412,327,415,320,407,311,404,309,412,301,396,287,387,282,377,295,374,288,365,287,369,305,367,314,347,293,344,282,333,276,322,284,308,284,341,257,367,169,402,133,415,98" style="outline:none;"><area id="5" alt="" title="" href="javascript:selec(5);" shape="poly" coords="173,196,198,194,201,212,196,214,188,212,186,217,195,225,194,237,202,248,208,246,218,265,225,257,236,260,242,257,254,259,266,255,275,233,291,242,289,249,313,276,337,256,363,168,388,144,304,107,262,113,249,103,253,91,241,89,231,113,215,119,197,173" style="outline:none;"><area id="3" alt="" title="" href="javascript:selec(3);" shape="poly" coords="68,81,70,96,66,101,68,108,80,111,88,124,97,121,105,133,88,146,100,159,108,156,111,164,111,172,115,185,121,196,127,200,132,196,139,196,140,205,154,205,164,196,178,193,194,171,209,119,229,111,236,84,230,78" style="outline:none;"><area id="7" alt="" title="" href="javascript:selec(7);" shape="poly" coords="25,74,49,78,69,129,97,182,145,229,189,257,255,282,329,316,373,326,402,351,328,363,176,344,91,320,51,322,30,314" style="outline:none;"></map></p>
	<p id="cimy_uef_p_field_7" class="ZONA">
		<label for="cimy_uef_7"></label><select name="ZONA" id="cimy_uef_7" class="cimy_uef_input_27">
			<option value="Aqui">Aqui</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option></select>
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_9" class="TELEFONOS">
		<label for="cimy_uef_9">Telefono(*)</label><input name="TELEFONOS" id="cimy_uef_9" class="cimy_uef_input_27" value="' . $_POST['TELEFONOS'] . '" maxlength="30" type="text">
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_18" class="CELULAR">
		<label for="cimy_uef_18">Celular(*)</label><input name="CELULAR" id="cimy_uef_18" class="cimy_uef_input_27" value="' . $_POST['CELULAR'] . '" maxlength="30" type="text">
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_14" class="DESCRIPCION">
		<label for="cimy_uef_14">Descripción(*)</label><textarea name="DESCRIPCION" id="cimy_uef_14" class="cimy_uef_input_27" rows="3" cols="25">' . $_POST['DESCRIPCION'] . '</textarea>Digite la información a destacar (Máximo 300 caracteres), <strong>NO INCLUIR DATOS DE CONTACTO</strong>.
	</p>
	</div>
	
	<div>
	
		<p id="cimy_uef_p_field_15" class="CATEGORIA">
		<label for="cimy_uef_15">Categoría(*). Para elegir varias categorías mantener presionada la tecla Control.</label>
		<select name="CATEGORIA[]" multiple="multiple" size="6" id="cimy_uef_15" class="cimy_uef_input_27">
			'.$salida.'
		</select>
		</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_26" class="WEB">
		<label for="cimy_uef_26">Web(url)</label><input type="text" name="WEB" id="cimy_uef_26" class="cimy_uef_input_27" value="' . $_POST['WEB'] . '" maxlength="100" <="" p="">
	</p>
	</div>
	
	<div>
		<p id="cimy_uef_p_field_16" class="LOGO">
		<label for="cimy_uef_16">Logo(150px*100px)(*) </label><input type="file" name="LOGO" id="cimy_uef_16" class="cimy_uef_picture" value="" onchange="uploadFile('."'registerform', 'cimy_uef_16', 'Por favor suba la imagen con alguna de las siguientes extensiones', Array('jpg','jpeg','jpe','gif','png','bmp','tiff','tif','ico'));".'" >
	<br>
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_22" class="TERMINOS">
		<input name="TERMINOS" id="cimy_uef_22" class="cimy_uef_checkbox" value="true" type="checkbox"> He leído y estoy de acuerdo con los <a href="http://convocar.net/terminos-y-condiciones/" class="colorbox-link cboxElement" title="Términos y condiciones"> Términos y condiciones generales</a>, <a href="http://convocar.net/terminos-internas/" class="colorbox-link cboxElement" title="Términos y condiciones">Términos y condiciones internas</a> y las <a href="http://convocar.net/politica-datos-pers-2/" class="colorbox-link cboxElement" title="Términos y condiciones">Políticas y tratamiento de datos personales</a>.<br>
	</p>
	</div>
	
	<div>
	<p id="cimy_uef_p_field_27" class="DESEOMAIL">
		<input name="DESEOMAIL" id="cimy_uef_27" class="cimy_uef_checkbox" value="true" checked="checked" type="checkbox"> Deseo recibir correos de convocar.net.<br>
	</p>
	</div>

	
	<div style="display:none;">
	<label for="role">Role <strong>*</strong></label>
	<input type="text" name="role" value="proveedores">
	<input type="text" name="grupo" value="">
	</div>	
	
	
	<div>
	<p id="cimy_uef_wp_p_field_20" class="PASSWORD">
		<label for="cimy_uef_wp_20">Contraseña</label><input name="password" id="pass12" class="cimy_uef_input_27" value="" maxlength="100"  type="password">
	</p>
	<p id="cimy_uef_wp_p_field_21" class="PASSWORD2">
		<label for="cimy_uef_wp_21">Confirmar contraseña</label><input name="PASSWORD2" id="pass22" class="cimy_uef_input_27" value="" maxlength="100" type="password">
	</p>
		<div id="pass-strength-result">Indicador de seguridad</div>
		<p class="description indicator-hint">Sugerencia: La contraseña debe tener al menos siete caracteres. Para hacerlo más fuerte, use letras mayúsculas y minúsculas, números y símbolos como (! "? $% ^ &amp;).</p>
	</div>
	
	
	
	<input class="reg" type="submit" name="submit" value="Registrar"/>
	</form></div>
	';
}


function registration_validation3( $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio, $role,$bloint,$apca)  {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field', 'Campo de formulario requerido no encontrado.');
    }

    if ( strlen( $username ) < 4 ) {
        $reg_errors->add('username_length', 'Debe tener al menos 4 caracteres.');
    }

    if ( username_exists( $username ) )
        $reg_errors->add('user_name', 'El usuario ya existe.');

    if ( !validate_username( $username ) ) {
        $reg_errors->add('username_invalid', 'El usuario ingresado es invalido.');
    }

    if ( strlen( $password ) < 5 ) {
        $reg_errors->add('password', 'Contraseña debe tener más de 5 letras.');
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add('email_invalid', 'Email no valido.');
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add('email', 'Email esta siendo usado ya.');
    }
    
    if ( !empty( $website ) ) {
        if ( !filter_var($website, FILTER_VALIDATE_URL) ) {
            $reg_errors->add('website', 'Url no valida.');
        }
    }

    if ( is_wp_error( $reg_errors ) ) {

        foreach ( $reg_errors->get_error_messages() as $error ) {
            echo '<div>';
            echo '<strong>ERROR</strong>:';
            echo $error . '<br/>';

            echo '</div>';
        }
    }
}

function complete_registration3() {
    global $reg_errors, $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio, $role, $grupo,$bloint,$apca,$group,$nombreorazon, $nit, $direccion, $ciudad,$zona,$telefonos,$celular,$terminos,$deseomail,$descripcion,$web,$categoria,$logo;
    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $userdata = array(
        'user_login'	=> 	$username,
        'user_email' 	=> 	$email,
        'user_pass' 	=> 	$password,
        'user_url' 		=> 	$website,
        'first_name' 	=> 	$first_name,
        'last_name' 	=> 	$last_name,
        'nickname' 		=> 	$nickname,
        'description' 	=> 	$bio,
		);
        $user = wp_insert_user( $userdata );
		$the_user = get_user_by('email', $email);
		$the_user_id = $the_user->ID;
		
		wp_set_password( $password, $the_user_id );
		wp_update_user( array ('ID' => $the_user_id, 'role' => $role ) ) ;
		wp_update_user( array ('ID' => $the_user_id, 'first_name' => $first_name ) ) ;
		update_user_meta($the_user_id, 'bloint', $bloint);
		update_user_meta($the_user_id, 'apca', $apca);
				
				if ( ! function_exists( 'wp_handle_upload' ) ) {
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}

								$uploadedfile = $logo;
								$upload_overrides = array( 'test_form' => false );
								$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

								
				$cats='';
				foreach ($categoria as $a){
					$cats .=$a.',';
				}
				set_cimyFieldValue($the_user_id, 'CATEGORIA', $cats);
				set_cimyFieldValue($the_user_id, 'NOMBREORAZON', $nombreorazon);
				set_cimyFieldValue($the_user_id, 'NIT', $nit);
				set_cimyFieldValue($the_user_id, 'DIRECCION', $direccion);
				set_cimyFieldValue($the_user_id, 'CIUDAD', $ciudad);
				set_cimyFieldValue($the_user_id, 'ZONA', $zona);
				set_cimyFieldValue($the_user_id, 'TELEFONOS', $telefonos);
				set_cimyFieldValue($the_user_id, 'CELULAR', $celular);
				set_cimyFieldValue($the_user_id, 'DESCRIPCION', $descripcion);
				set_cimyFieldValue($the_user_id, 'WEB', $web);
							
				
				set_cimyFieldValue($the_user_id, 'LOGO', $movefile['url']);
				set_cimyFieldValue($the_user_id, 'TERMINOS', $terminos);
				set_cimyFieldValue($the_user_id, 'DESEOMAIL', $deseomail);
				
		$idc= term_exists($group);

		$term_taxonomy_ids = wp_set_object_terms( $the_user_id, intval($idc), 'user-group' );
		 try{
		 wp_mail( $email, "Bienvenido a convocar", '


                              <div style="padding: 15px 0;">
								Bienvenido a Convocar <br/><br/>

								Tu nombre de usuario es: '.$username.'<br/>
								Tu contraseña: '.$password.'<br/>
								</div>
															  
													  ' );
					  throw new Exception($usuario->user_email);
										}catch(Exception $e){
											
										}
        echo '<div style="width:100%; text-aling:center; font-size:25px; padding:20px;">Registro completo!</div>
			<style>
				.nuevoadco.proveedores{
					display:none !important;
				}
			</style>
			<div class="vc_btn3-container vc_btn3-inline"><a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-classic vc_btn3-color-grey" href="http://convocar.net/registro-proveedor/" title="" target="_self">Agregar nuevo proveedor</a></div>';     
	}
}



// Register a new shortcode: [cr_custom_registration_proveedor]
add_shortcode('cr_custom_registration_proveedor', 'custom_registration_shortcode3');

// The callback function that will replace [book]
function custom_registration_shortcode3() {
    ob_start();
    custom_registration_function3();
    return ob_get_clean();
}

/*Deshabilitar envio de email al cambio de contraseña wp-includes/user.php linea 2198-2199*/



function agregar_usuario2($username, $email, $password, $nombres, $apellidos, $cedula, $puntodeventa, $direccion, $ciudad, $telefono, $celular ) {
			
			$reg_errors = new WP_Error; 
			$userdata = array(
			'user_login'	=> 	$username,
			'user_email' 	=> 	$email
			);
			
				if ( username_exists( $username ) ){
					$reg_errors->add('user_name', 'El usuario ya existe.');
				}
				if ( !validate_username( $username ) ) {
					$reg_errors->add('username_invalid', 'El usuario ingresado es invalido.');
				}

				if ( !is_email( $email ) ) {
					$reg_errors->add('email_invalid', 'Email no valido.');
				}

				if ( email_exists( $email ) ) {
					$reg_errors->add('email', 'Email esta siendo usado ya.');
				}
				
				if ( is_wp_error( $reg_errors ) ) {

					foreach ( $reg_errors->get_error_messages() as $error ) {
						echo '<div>';
						echo '<strong>ERROR</strong> para usuario:'.$username.'<br/>';
						echo $error . '<br/>';

						echo '</div>';
					}
				}else{
			
					$user = wp_insert_user( $userdata );
					$the_user = get_user_by('email', $email);
					$the_user_id = $the_user->ID;
					
					wp_set_password( $password, $the_user_id );
					wp_update_user( array ('ID' => $the_user_id, 'role' => 'subscriber' ) ) ;
						set_cimyFieldValue($the_user_id, 'NOMBRES', $nombres);
						set_cimyFieldValue($the_user_id, 'APELLIDOS', $apellidos);
						set_cimyFieldValue($the_user_id, 'CEDULA', $cedula);
						set_cimyFieldValue($the_user_id, 'PUNTODEVENTA', $puntodeventa);
						set_cimyFieldValue($the_user_id, 'DIRECCIONEXACTA', $direccion);
						set_cimyFieldValue($the_user_id, 'CIUDAD', $ciudad);
						set_cimyFieldValue($the_user_id, 'TELEFONO', $telefono);
						set_cimyFieldValue($the_user_id, 'CELULAR', $celular);
				}
			 
}

// subir cvs
add_shortcode('importuser2', 'cust122');
function cust122($atts, $content = null ) {
     extract( shortcode_atts( array(
	      'role' => '',
		  'titulo' => ''
     ), $atts ) );
	 

	 
	$out='';
	$out .=	'<form id="featured_upload" method="post" action="#" enctype="multipart/form-data">
			<input type="file" name="my_image_upload" id="my_image_upload"  multiple="false" />
			'.wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ).'
			<input id="submit_my_image_upload" name="submit_my_image_upload" type="submit" value="Subir usuarios" />
		</form>';
		
			// These files need to be included as dependencies when on the front end.
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			require_once( ABSPATH . 'wp-admin/includes/media.php' );
			
			// Let WordPress handle the upload.
			// Remember, 'my_image_upload' is the name of our file input in our form above.
			$attachment_id = media_handle_upload( 'my_image_upload');
			
			if (isset( $_POST['my_image_upload_nonce'])) {				
							$row = 1;
			if (($handle = fopen(wp_get_attachment_url($attachment_id), "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
					if($row!=1){
						$num = count($data);
						$row++;
							agregar_usuario2($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8],$data[9],$data[10]);
						
					}else{
						$row++;
					}
				}
				echo 'Registro completo!'; 
				fclose($handle);
			}
					
					if ( is_wp_error( $attachment_id ) ) {
						// There was an error uploading the image.
					} else {
						// The image was uploaded successfully!
					}

				} else {

					// The security check failed, maybe show the user an error.
				}	
	
		
    return $out;
}

add_shortcode( 'conjuntousuario', conjuntouser1 );
function conjuntouser1( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'img' => '',
		  'titulo' => ''
     ), $atts ) );
	 $user_id = get_current_user_id();  // Get current user Id
			$user_groups = wp_get_object_terms($user_id, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
			foreach($user_groups as $user_gro){		
				$vari= wp_get_object_terms( $user_id, $user_gro->taxonomy);
				foreach($vari as $user_gro1){
					$grupo = $user_gro1->name;
				}
			}
			 $out='';
		$out .= '<h1 style="text-align: center;"><span style="color: #ffffff;">
		'. $grupo.'
		</span></h1>
		';
	 
     return do_shortcode($out);  
}
