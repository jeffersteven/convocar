<?php
/**
 * Template Name: Perfil usuarios
 * 
 */


get_header();


$cmsms_layout = get_post_meta(get_the_ID(), 'cmsms_layout', true);

if (!$cmsms_layout) {
    $cmsms_layout = 'r_sidebar';
}


echo '<!--_________________________ Start Content _________________________ -->' . "\n";

if ($cmsms_layout == 'r_sidebar') {
	echo '<section id="content" role="main">' . "\n\t";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo '<section id="content" class="fr" role="main">' . "\n\t";
} else {
	echo '<section id="middle_content" role="main">' . "\n\t";
}

	$id =  $_GET["iduser"];
	$profileuser = get_userdata( $id );
	$role = implode(', ', $profileuser->roles);
echo '<div class="login profile " id="theme-my-login">';
	


		
		echo '<div class="form-table">';
		
		
				if( $role=='profesional'){
					echo '<a>Nombre</a><br><input name="nombre" type="hidden" value="'. $profileuser->user_firstname .'"/><input name="email" disabled=true type="text" value="'. $profileuser->user_firstname .'"/><br>'; 
				}
				if( $role=='proveedores'){
					echo '<a>Nombre o Razón social</a><br><input name="email" disabled=true type="text" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($profileuser->ID, 'NOMBREORAZON')) .'"/><br>'; 
				}
		
		echo '
		<a>Email</a><br>
			<input type="text" disabled="true" name="email" id="email" value="'. esc_attr( $profileuser->user_email ) .'" class="regular-text" /><br>
		<a>Dirección</a><br>
		<input name="email" disabled=true type="text" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($profileuser->ID, 'DIRECCION')) . '"/><br>
		<a>Zona de ubicación</a><br>
		<input name="email" disabled=true type="text" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($profileuser->ID, 'ZONA')) . '"/><br>
		<a>Telefonos</a><br><input name="email" disabled=true type="text" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($profileuser->ID, 'TELEFONOS')) . '"/><br>
		
		<a>Descripción</a><br>
			<textarea disabled="true" class="regular-text"/>'. cimy_uef_sanitize_content(get_cimyFieldValue($profileuser->ID, 'DESCRIPCION')) .'</textarea><br>
		<br>
		<a class="botwid" href="/afiliados/">Ir a Afiliados</a><br><br>
		<a class="botwid" onclick="history.back()">Regresar</a>
		
		</div>';

echo '</div>';


echo '</section>' . "\n" . 
'<!-- _________________________ Finish Content _________________________ -->' . "\n\n";


if ($cmsms_layout == 'r_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<section id="sidebar" role="complementary">' . "\n";
	
	get_sidebar();
	
	echo "\n" . '</section>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<section id="sidebar" class="fl" role="complementary">' . "\n";
	
	get_sidebar();
	
	echo "\n" . '</section>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
}


get_footer();

