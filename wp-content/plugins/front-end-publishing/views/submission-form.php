<?php
	$post 		= false;
	$post_id 	= -1;
	$featured_img_html = '';
	if( isset($_GET['fep_id']) && isset($_GET['fep_action']) && $_GET['fep_action'] == 'edit' ){
		$post_id 			= $_GET['fep_id'];
		$p 					= get_post($post_id, 'ARRAY_A');
		if($p['post_author'] != $current_user->ID) return 'Tu no tienes permiso para editar esta publicación';
		$category 			= get_the_category($post_id);
		$tags 				= wp_get_post_tags( $post_id, array( 'fields' => 'names' ) );
		$featured_img 		= get_post_thumbnail_id( $post_id );
		$featured_img_html 	= (!empty($featured_img))?wp_get_attachment_image( $featured_img, array(200,200) ):'';
		$post 				= array(
								'title' 			=> $p['post_title'],
								'content' 			=> $p['post_content'],
								'about_the_author' 	=> get_post_meta($post_id, 'about_the_author', true)
							);
		if(isset($category[0]) && is_array($category))
			$post['category'] 	= $category[0]->cat_ID;
		if(isset($tags) && is_array($tags))
			$post['tags'] 		= implode(', ', $tags);
			
			
	}
	
	$user_id = get_current_user_id();  // Get current user Id
			$user_groups = wp_get_object_terms($user_id, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
			foreach($user_groups as $user_gro){		
				$vari= wp_get_object_terms( $user_id, $user_gro->taxonomy);
				foreach($vari as $user_gro1){
					$grupo = $user_gro1->slug;
				}
			}
	$author_posts 	= new WP_Query( array( 'posts_per_page' => $per_page, 'paged'=>$paged, 'orderby'=> 'DESC',  'post_status' => $status, 'category_name' => $grupo));
		$con=$author_posts->found_posts;	
		

	$user = new WP_User( $user_id );
	if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
		foreach ( $user->roles as $role )
			$rol= $role;
		}
if($con<21 || $rol=='administrator'){			
?>



<noscript><div id="no-js" class="warning">This form needs JavaScript to function properly. Please turn on JavaScript and try again!</div></noscript>
<div id="fep-new-post">
	<div id="fep-message" class="warning"></div>
	<form id="fep-submission-form">
		<label for="fep-post-title">Titulo</label><br/>
		<input type="text" name="post_title" id="fep-post-title" value="<?php echo ($post) ? $post['title']:''; ?>"><br/>
		<label for="fep-post-content">Contenido</label><br/>
		<span>El tamaño máximo de los archivos es de 8MB.</span><br/>
		<?php
			$enable_media = (isset($fep_roles['enable_media']) && $fep_roles['enable_media'])?current_user_can($fep_roles['enable_media']):1;
			wp_editor( $post['content'], 'fep-post-content', $settings = array('textarea_name'=>'post_content', 'textarea_rows'=> 7, 'media_buttons'=>true) );
			wp_nonce_field('fepnonce_action','fepnonce');
		?>
		<?php if(!$fep_misc['disable_author_bio']): ?>
			<label for="fep-about">Autor</label><br/>
			<textarea name="about_the_author" id="fep-about" rows="5"><?php echo ($post) ? $post['about_the_author']:''; ?></textarea><br/>
		<?php else: ?>
			<input type="hidden" name="about_the_author" id="fep-about" value="-1">
		<?php endif; ?>

		<input type="text" name="post_category" id="fep-category" value="<?php echo $grupo; ?>" style="display:none;">
		<input type="text" name="post_tags" id="fep-tags" value="tag" style="display:none;">
		<span>Puede tener un máximo de 500 palabras por noticia, si excede este número subir un archivo adjunto.</span><br/>
		<div id="fep-featured-image">
			<div id="fep-featured-image-container"><?php echo $featured_img_html; ?></div>
			<a id="fep-featured-image-link" href="#">Escoger imagen destacada</a>
			<input type="hidden" id="fep-featured-image-id" value="<?php echo (!empty($featured_img))?$featured_img:'-1'; ?>"/>
		</div>
		<input type="hidden" name="post_id" id="fep-post-id" value="<?php echo $post_id ?>">
		<button type="button" id="fep-submit-post" class="active-btn">Enviar</button><img class="fep-loading-img" src="<?php echo plugins_url( 'static/img/ajax-loading.gif', dirname(__FILE__) ); ?>"/>
	</form>
</div>

<?php
}else{
?>
<div id="fep-new-post">
	<div id="fep-message" class="warning"></div>
		<label for="fep-post-title">Puedes tener máximo 20 noticias, en el administrador de cartelera podras borrar noticias. (Sugerimos se borren las noticias más antiguas).</label>
	</div>
</div>
<?php
}
