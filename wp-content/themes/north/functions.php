<?php

//
// North Theme Functions
//
// Author: Veented
// URL: http://themeforest.net/user/Veented/
// Design: GoldEyes Themes
//
//

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Load Framework
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


require_once('framework/plugins/plugins-config.php'); 			// Plugins Manager
require_once('framework/functions/blog-functions.php'); 		// Blog related functions
require_once('framework/functions/page-functions.php'); 		// Page functions & metaboxes
require_once('framework/functions/header-functions.php'); 		// Header related functions
require_once('framework/functions/general-functions.php'); 		// General functions
require_once('framework/portfolio/portfolio-functions.php'); 	// Portfolio Post Type
require_once('framework/team/team-functions.php'); 				// Team Member Post Type
require_once('framework/testimonials/testimonials-functions.php'); // Testimonial Post Type
require_once('framework/services/services-functions.php'); 		// Services Post Type
require_once('framework/shortcodes/shortcodes.php'); 			// Shortcodes
require_once('framework/widgets/widgets.php'); 				// Widgets

if (!function_exists( 'optionsframework_admin_init')) { // Theme Options Panel
	require_once ('framework/theme-options/index.php');
} 

if(class_exists('Vc_Manager')) {	

	function vntd_extend_composer() {
		require_once locate_template('/wpbakery/vc-extend.php');
	}

	add_action('init', 'vntd_extend_composer', 20);	
}


// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Localization
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


function vntd_theme_setup() {
	load_theme_textdomain( 'vntd_north', get_template_directory() . '/lang' );
}
add_action( 'after_setup_theme', 'vntd_theme_setup' );


// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Theme Scripts & Styles
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


function vntd_custom() {
	if (!is_admin()) 
	{
	
		// Load jQuery scripts
			
		wp_register_script('custom', get_template_directory_uri() . '/js/jquery.custom.js', array('jquery'));	
		wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'));		
		wp_register_script('SmoothScroll', get_template_directory_uri() . '/js/SmoothScroll.js', array('jquery'));		
		wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'));		
		wp_register_script('vntdIsotope', get_template_directory_uri() . '/js/jquery.isotope.js', array('jquery'));	
		wp_register_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'));	
		wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'));	
		wp_register_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'));	
		wp_register_script('appear', get_template_directory_uri() . '/js/jquery.appear.js', array('jquery'));	
		wp_register_script('YTPlayer', get_template_directory_uri() . '/js/jquery.mb.YTPlayer.js', array('jquery'));	
		wp_register_script('sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'));	
		wp_register_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'));	
		wp_register_script('parallax', get_template_directory_uri() . '/js/jquery.parallax-1.1.3.js', array('jquery'));	
		wp_register_script('waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'));	
		wp_register_script('superslides', get_template_directory_uri() . '/js/jquery.superslides.js', array('jquery'));	
		wp_register_script('google-map', get_template_directory_uri() . '/js/google-map.js', array('jquery'));	
		wp_register_script('google-map-sensor', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'));	
		wp_register_script('magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'));	
		wp_register_script('rainyday', get_template_directory_uri() . '/js/rainyday.min.js', array('jquery'));	
		wp_register_script('vimeoBg', get_template_directory_uri() . '/js/fullscreen_background.js', array('jquery'));
		wp_register_script('jQueryUI', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js', array('jquery'));
		wp_register_script('portfolioExpand', get_template_directory_uri() . '/js/jquery.colio.js', array('jquery'));
								
		wp_enqueue_script('bootstrap', '', '', '', true);
		wp_enqueue_script('SmoothScroll', '', '', '', true);
		wp_enqueue_script('fitvids', '', '', '', true);
		wp_enqueue_script('waypoints', '', '', '', true);		
		wp_enqueue_script('flexslider', '', '', '', true);	
		wp_enqueue_script('vntdIsotope', '', '', '', true);
		wp_enqueue_script('sticky', '', '', '', true);
		wp_enqueue_script('appear', '', '', '', true);
		wp_enqueue_script('easing', '', '', '', true);
		wp_enqueue_script('parallax', '', '', '', true);	
		wp_enqueue_script('custom', '', '', '', true);
		wp_enqueue_script('superslides', '', '', '', true);
		wp_enqueue_script('owl-carousel', '', '', '', true);		
			
		
		// Load stylesheets				

		wp_register_style('style-dynamic', get_template_directory_uri() . '/css/style-dynamic.php');				
		wp_register_style('theme-styles', get_template_directory_uri() . '/style.css',array('bootstrap'));	
		wp_register_style('elements', get_template_directory_uri() . '/css/elements.css');	
		
		
		wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
		wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css');
		wp_register_style('animate', get_template_directory_uri() . '/css/scripts/animate.min.css');
		wp_register_style('owl-carousel', get_template_directory_uri() . '/css/scripts/owl.carousel.css');
		wp_register_style('flexslider', get_template_directory_uri() . '/css/scripts/flexslider.css');
		wp_register_style('socials', get_template_directory_uri() . '/css/socials.css');
		wp_register_style('YTPlayer', get_template_directory_uri() . '/css/scripts/YTPlayer.css');
		wp_register_style('magnific-popup', get_template_directory_uri() . '/css/scripts/magnific-popup.css');
		wp_register_style('prettyPhoto', get_template_directory_uri() . '/css/scripts/prettyPhoto.css');
		wp_register_style('north-responsive', get_template_directory_uri() . '/css/responsive.css');
		wp_register_style('vimeoBg', get_template_directory_uri() . '/css/scripts/fullscreen_background.css');
		wp_register_style('portfolioExpand', get_template_directory_uri() . '/css/scripts/colio.css');
		
		//wp_enqueue_style('bootstrap');			
		wp_enqueue_style('font-awesome');
		wp_enqueue_style('animate');
		wp_enqueue_style('elements');
		
		
		
		wp_enqueue_style('theme-styles'); // MAIN STYLESHEET
		wp_enqueue_style('socials');
		
		global $smof_data;
		if(array_key_exists('vntd_skin_overlay', $smof_data)) {
			if($smof_data['vntd_skin_overlay'] == 'night') {
				wp_enqueue_style('layout-tone', get_template_directory_uri() . '/css/skins/night.css');
			} else {
				wp_enqueue_style('layout-tone', get_template_directory_uri() . '/css/skins/dark.css');
			}		
		}
		wp_enqueue_style('style-dynamic');			
		if(array_key_exists('vntd_responsive', $smof_data)) {
			if($smof_data['vntd_responsive']) {
				wp_enqueue_style('north-responsive');	// Load responsive stylesheet
			}
		}
				
	}
}
add_action('wp_enqueue_scripts', 'vntd_custom');


// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// 		Custom Image Sizes & Post Formats
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


if (function_exists('add_theme_support')) { 
	
	// Post Formats	
	
	add_theme_support('post-formats', array('gallery', 'video')); 	
	
	// Image Sizes		
	
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(100, 100, true);
		
	add_image_size('bg-image', 1670, 9999);
	add_image_size('fullwidth-landscape', 1170, 500, true);
	add_image_size('sidebar-landscape', 880, 380, true);
	add_image_size('sidebar-auto', 880, 9999);	
	add_image_size('portfolio-square', 450, 350, true);	
	add_image_size('portfolio-auto', 450, 9999);
	add_image_size('square', 270, 270, true);
}

function vntd_image_sizes($sizes) {
	
    $sizes['fullwidth-landscape'] = __( 'Fullwidth Landscape', 'veented_backend');
    $sizes['sidebar-landscape'] = __( 'Content Landscape', 'veented_backend'); 
    $sizes['sidebar-auto'] = __( 'Content Portrait', 'veented_backend');
    $sizes['portfolio-auto'] = __( 'Portfolio Portrait', 'veented_backend');
    $sizes['portfolio-square'] = __( 'Portfolio Square', 'veented_backend');
    return $sizes;
}
add_filter('image_size_names_choose', 'vntd_image_sizes');

function vntd_editor_css() {

}
add_action( 'init', 'vntd_editor_css' );

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// 		Custom Menus
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


add_action('init', 'vntd_register_custom_menu');
 
function vntd_register_custom_menu() {
	register_nav_menu('primary', __('Primary Navigation','veented_backend'));
}

class Vntd_Custom_Menu_Class extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}
}

function mytheme_walk_nav_menu_items($output, $item, $depth, $args) {

	global $post;
	$front_id = get_option('page_on_front');
	
	if(is_object($post)) {
		$output = str_replace( 'http://frontpage_url/', get_permalink($front_id), $output);	
		$output = str_replace( get_permalink($post->ID).'#', '#', $output );
	}
    
    
    return $output;
}
add_filter( 'walker_nav_menu_start_el', 'mytheme_walk_nav_menu_items', 10, 4);

// Remove custom post type parent element

function remove_parent_classes($class)
{
	return ($class == 'current_page_item' || $class == 'current_page_parent' || $class == 'current_page_ancestor'  || $class == 'current-menu-item') ? FALSE : TRUE;
}

function add_class_to_wp_nav_menu($classes)
{
	//if(get_post_type() == 'portfolio') {
		$classes = array_filter($classes, "remove_parent_classes");
	//}	
	return $classes;
}
add_filter('nav_menu_css_class', 'add_class_to_wp_nav_menu');


// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// 		Sidebars
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


if (function_exists('register_sidebar')){
	register_sidebar(array(
        'name' => __('Default Sidebar','veented_backend'),
        'id' => 'default_sidebar',
        'before_widget' => '<div id="%1$s" class="bar %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));	
	register_sidebar(array(
        'name' => __('Archives/Search Sidebar','veented_backend'),
        'id' => 'archives',
        'before_widget' => '<div id="%1$s" class="bar %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));	
    
    register_sidebar(array(
        'name' => __('Footer Column 1','veented_backend'),
        'id' => 'footer1',
        'before_widget' => '<div class="bar footer-widget footer-widget-col-1">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Footer Column 2','veented_backend'),
        'id' => 'footer2',
        'before_widget' => '<div class="bar footer-widget footer-widget-col-2">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Footer Column 3','veented_backend'),
        'id' => 'footer3',
        'before_widget' => '<div class="bar footer-widget footer-widget-col-3">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Footer Column 4','veented_backend'),
        'id' => 'footer4',
        'before_widget' => '<div class="bar footer-widget footer-widget-col-4">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    
    if (class_exists('Woocommerce')) { // If WooCommerce is enabled, activate related sidebars 
    
    	register_sidebar(array(
    	    'name' => 'WooCommerce Shop Page',
    	    'id'	=> 'woocommerce_shop',
    	    'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
    	    'after_widget' => '</div>',
    	    'before_title' => '<h4>',
    	    'after_title' => '</h4>',
    	));   	
    }

	global $smof_data;
	
	if(!$smof_data) $smof_data = array();
	
	if(array_key_exists('sidebar_generator',$smof_data)) {
		if($smof_data['sidebar_generator'] > 0) {
			foreach($smof_data['sidebar_generator'] as $sidebar)  
			{  
				register_sidebar( array(  
					'name' => $sidebar['title'],
					'before_widget' => '<div id="%1$s" class="bar %2$s">',  
					'after_widget' => '</div>',
					'before_title' => '<h3>',
					'after_title' => '</h3>',
				) );  
			}
		}
	}
	
}

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Configure Tag Cloud
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

function vntd_tag_cloud($args = array()) {
   $args['smallest'] = 12;
   $args['largest'] = 12;
   $args['unit'] = 'px';
   return $args;
   
}
add_filter('widget_tag_cloud_args', 'vntd_tag_cloud', 90);
add_filter('widget_text', 'do_shortcode');


// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Print comment scripts
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


function vntd_comments() {
	if(is_singular() || is_page())
	wp_enqueue_script( 'comment-reply', '', '', '', true);
}
add_action('wp_enqueue_scripts', 'vntd_comments');


// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Set content width
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


function vntd_custom_content_width_embed_size($embed_size){
	global $content_width;
	$content_width = 1170;
}
add_filter('template_redirect', 'vntd_custom_content_width_embed_size');


// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		WooCommerce Support
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


add_theme_support('woocommerce');

if (class_exists('Woocommerce')) {
	require_once('woocommerce/config.php'); 	
}


// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Dashboard scripts & styles
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


function vntd_admin_scripts() {	
	wp_enqueue_media();
	wp_register_script('dashboard-jquery', get_template_directory_uri() . '/framework/theme-options/assets/js/jquery.dashboard.js');
	wp_register_script('media-uploader', get_template_directory_uri() . '/framework/theme-options/assets/js/media-uploader.js',array( 'jquery' ),true);
	
	wp_enqueue_script('dashboard-jquery', '', '', '', true);
	wp_enqueue_script('media-uploader', '', '', '', true);
	wp_enqueue_script('thickbox', '', '', '', true);	
	wp_localize_script('dashboard-jquery', 'WPURLS', array( 'themeurl' => get_template_directory_uri() ));	
}

function vntd_media_view_settings($settings, $post ) {
    if (!is_object($post)) return $settings;
    $shortcode = '[gallery ';
    $ids = get_post_meta($post->ID, 'gallery_images', TRUE);
    $ids = explode(",", $ids);
	
    if (is_array($ids))
        $shortcode .= 'ids = "' . implode(',',$ids) . '"]';
    else
        $shortcode .= "id = \"{$post->ID}\"]";
    $settings['shibaMlib'] = array('shortcode' => $shortcode);
    return $settings;

}

add_filter( 'media_view_settings','vntd_media_view_settings', 10, 2 );

function vntd_admin_styles() {
	wp_enqueue_style('vntd-admin', get_template_directory_uri() . '/framework/theme-options/assets/css/vntd-admin.css');		
	wp_enqueue_style('vntd-admin-dynamic', get_template_directory_uri() . '/framework/theme-options/assets/css/vntd-admin-dynamic.php');	
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css');
}

add_action( 'admin_enqueue_scripts', 'vntd_admin_scripts' );
add_action( 'admin_enqueue_scripts', 'vntd_admin_styles' );
add_theme_support( 'automatic-feed-links' );

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Theme Updates
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if(class_exists( 'Theme_Upgrader' )) { // Load only if Envato Toolkit plugin is activated
function envato_toolkit_admin_init() {
 
    // Include the Toolkit Library
    include_once( get_template_directory() . '/framework/theme-updates/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php' );
 
    // Add further code here
 
}
add_action( 'admin_init', 'envato_toolkit_admin_init' );
}

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Add Theme Options button to the WP Admin Bar
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


function vntd_options_button() {
	global $wp_admin_bar;
	if (!is_super_admin() || !is_admin_bar_showing())
		return;
	$wp_admin_bar->add_menu( array(
		'id' 	=> 'theme_options',
		'title' => __('Theme Options', 'veented_backend'),
		'href' 	=> admin_url( 'admin.php?page=optionsframework'),
	));
}
add_action('admin_bar_menu', 'vntd_options_button',35);


/*Shortcodes programador*/
if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}



function adda64( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'img' => '',
		  'titulo' => ''
     ), $atts ) );
     
    	
     $out='<div class="serv">
			<table width="100%" cellspacing="5" cellpadding="3">
			<tbody>
			<tr>
			<td style="width: 40px;">
			<div><img alt="" src="'.$img.'" width="32" height="32" /></div></td>
			<td>
			<h3>'.$titulo.'</h3>
			</td>
			</tr>
			<tr>
			<td></td>
			<td>'.$content.'</td>
			</tr>
			</tbody>
			</table>
			</div>';	
	 
     return $out;  
}
add_shortcode( 'servicio', adda64 );  


function adda75( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'img' => '',
		  'titulo' => ''
     ), $atts ) );
     
	 $out='';
	 
	 
	 
	 	$out.='<div class="profesionales">';

		
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
 
    $paged -= 1;
    $limit = 5; //Limite de 5 usuarios por página
    $offset = $paged * $limit;    
    $user_query = new WP_User_Query( array( 'number' => $limit, 'offset' => $offset, 'role' => 'propiedadhorizontal' ) ); 
    if ( ! empty( $user_query->results ) ) { 
        foreach ( $user_query->results as $usuario ){
            $out .= '<div class="filtro '. str_replace(' ', '',cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CATEGORIA'))).'">';
			
			$out .= '<div class="cmsms_cc">
					<div class="one_fourth first_column" data-type="" data-folder="column">
					<div data-type="" data-folder="text">';	
			
			$out .= '<a>Nombre o Razón social</a><br>'. cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'NOMBREORAZON')) . '<br>';
			
			if ((cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'LOGO')))!='') {
				$out .= '<img class="avlogo" src="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'LOGO')) . '"><br>';
			}
			
			$out .= '</div></div>';
			
			$out .= '<div class="one_fourth" data-type="" data-folder="column">
					 <div data-type="" data-folder="text">';
					
					
			$out .= '<a>Dirección</a><br>'. cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'DIRECCION')) . '<br>';
			$out .= '<a>Telefonos</a><br>'.cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'TELEFONOS')) . '<br>'; 
			$out .= '<a>Web</a><br>'.$usuario->user_url . '<br>';
			$out .= '<a>Ubicación</a><br>'.cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CIUDAD')) .  '<br>';
			$out .= '<a  href="mailto:'.$usuario->user_email.'">Correo</a><br><a  href="mailto:'.$usuario->user_email.'">'.$usuario->user_email . '</a><br>';
			
			$out .= '</div></div>';
			
			$out .= '<div class="one_half lineaiz" data-type="" data-folder="column">
						<div data-type="" data-folder="text">';	
						
			$out .= cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'DESCRIPCION')) ;
			
			
			$out .= '</div></div>';			
			$out .= '</div></div>';
        }
		if(function_exists('wp_pagenavi')) { wp_pagenavi( array('query' => $user_query, 'type' => 'users')); }
    }
	 $out .= '</div>';	
	 
     return $out;  
}
add_shortcode( 'propiedadhorizontal', adda75 );  


function adda68( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'link1' => '',
		  'link2' => '',
		  'frase1' => '',
		  'frase2' => ''
     ), $atts ) );
     
	 $out='';
	 
    	
     $out.='<div class="error"><img src="/wp-content/themes/north/img/imgafil.jpg" />
			
			</div>';	
	 
     return $out;  
}
add_shortcode( 'permiso', adda68 );  

function adda69( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'titulo' => '',
		  'descripcion' => '',
		  'link1' => '',
		  'link2' => '',
		  'sub1' => '',
		  'sub2' => '',
		  'cont1' => '',
		  'cont2' => ''
     ), $atts ) );
     
	 $out='';
	 
    	
     $out.='<div class="afil"><div class="cmsms_cc">
				<div data-type="" data-folder="column" class="one_first first_column">
					<div data-type="" data-folder="text"><h1 style="text-align: center;">'.$titulo.'</h1>';
		if($descripcion!=''){
		$out.='<p style="text-align: center;">'.$descripcion.'</p>';
		}
		$out.='</div>
				</div>
				
				<div data-type="" data-folder="column" class="one_half first_column afil2">
					<div data-type="" data-folder="text" class="caja"><h2 style="text-align: center;"><a href="'.$link1.'">'.$sub1.'</a></h2><p style="text-align: center;"><a href="'.$link1.'">'.$cont1.'</a></p>
					</div>
				</div>
				
				<div data-type="" data-folder="column" class="one_half afil2">
					<div data-type="" data-folder="text" class="caja"><h2 style="text-align: center;"><a href="'.$link2.'">'.$sub2.'</a></h2><p style="text-align: center;"><a href="'.$link2.'">'.$cont2.'</a></p>
					</div>
				</div>
			</div></div>';	
	 
     return $out;  
}
add_shortcode( 'afiliados', adda69 ); 
 
function adda691( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'titulo' => '',
		  'descripcion' => '',
		  'link1' => '',
		  'link2' => '',
		  'img1' => '',
		  'img2' => ''
     ), $atts ) );
     
	 $out='';
	 
	global $current_user;
	$user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);

	 
    	
     $out.='<div class="afil '. $user_role .' "><div class="cmsms_cc">
				<div data-type="" data-folder="column" class="one_first first_column">
					<div data-type="" data-folder="text"><h1 style="text-align: center;">'.$titulo.'</h1>';
		if($descripcion!=''){
		$out.='<p style="text-align: center;">'.$descripcion.'</p>';
		}
		$out.='</div>
				</div>
				
				<div data-type="" data-folder="column" class="one_half first_column afil2">
					<div data-type="" data-folder="text" class="caja"><h2 style="text-align: center;"><a href="'.$link1.'"><img src="'.$img1.'"/></a></h2>
					</div>
				</div>
				
				<div data-type="" data-folder="column" class="one_half afil2 afil3">
					<div data-type="" data-folder="text" class="caja"><h2 style="text-align: center;"><a href="'.$link2.'"><img src="'.$img2.'"/></a></h2>
					</div>
				</div>
			</div></div>';	
	 
     return $out;  
}
add_shortcode( 'afiliados2', adda691 );

function adda77( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'img' => '',
		  'titulo' => ''
     ), $atts ) );
     
	 $out='';
	 
	 $out .='<FORM id="contacto" name="contacto" action="/wp-content/themes/north/enviarmailprof.php" method="POST">';
	 
	 $usuarioa = wp_get_current_user();
	 
	  $user = new WP_User( $usuarioa->ID );


		if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
			foreach ( $user->roles as $role ){
				if( $role=='profesional'){
					$out .= '<a>Nombre</a><br><input name="nombre" type="hidden" value="'. $usuarioa->user_firstname .'"/><input name="email" disabled=true type="text" value="'. $usuarioa->user_firstname .'"/><br>'; 
				}
				if( $role=='administrador_conjunto'){
					$out .='<a>Nombre o Razón social</a><br><input name="nombre" type="hidden" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'NOMBREORAZON')) .'"/><input name="email" disabled=true type="text" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'NOMBREORAZON')) .'"/><br>'; 
				}
				if( $role=='proveedores'){
					$out .='<a>Nombre o Razón social</a><br><input name="nombre" type="hidden" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'NOMBREORAZON')) .'"/><input name="email" disabled=true type="text" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'NOMBREORAZON')) .'"/><br>'; 
				}
			}
		}
		
	 $out .= '<a>Dirección</a><br><input name="direccion" type="hidden" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'DIRECCION')) . '"/><input name="email" disabled=true type="text" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'DIRECCION')) . '"/><br>';
	 $out .= '<a>Zona de ubicación</a><br><input name="zona" type="hidden" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'ZONA')) . '"/><input name="email" disabled=true type="text" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'ZONA')) . '"/><br>'; 
	 $out .= '<a>Telefonos</a><br><input name="telefonos" type="hidden" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'TELEFONOS')) . '"/><input name="email" disabled=true type="text" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'TELEFONOS')) . '"/><br>'; 
	 $out .= '<a>Correo</a><br><input name="email" type="hidden" value="'.$usuarioa->user_email . '"/><input name="email" disabled=true type="text" value="'.$usuarioa->user_email . '"/><br>';
	 
	 
     $out.='<div class="selcargos">';
	 $usuarios = get_users('orderby=nicename&role=profesional'); 
	 
	 $out .= '<select id="carg" name="carg" class="carg">';
		$contar=0;
		$carg = array();
		/*$out .= '<option value="filtro">Categoría</option>';*/
		$allFields = get_cimyFields();

				if (count($allFields) > 0) {
					foreach ($allFields as $field) {
								if($field['NAME']=='CARGO'){
									$catego=cimy_uef_sanitize_content($field['LABEL']);
									$categ=explode(",", $catego);
								}

					}
				}
				
				
				foreach ($categ as $categor) {
							$out .= '<option value="'. str_replace(' ', ' ',$categor ).'">'. $categor . '</option>';
				}
		
		$out .= '</select>';
		
		
	 $out .= '</div>';	
	 
	 $out .='
				<p><label style="width: 60%;">Descripción de la convocatoria<br>
				<textarea class="tenvio" name="mensaje" cols="auto"></textarea>
			<p><input class="envi2" type="submit" name="Submit" value="Enviar"/></p>
			</FORM>';
	 

     return $out;  
}
add_shortcode( 'envioprofesionales', adda77 );  

function adda78( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'img' => '',
		  'titulo' => ''
     ), $atts ) );
     
	 $out='';
	 
	 $out .='<FORM id="contacto" name="contacto" action="/wp-content/themes/north/enviarmailprov.php" method="POST">';
	 
	 $usuarioa = wp_get_current_user();
	 $user = new WP_User( $usuarioa->ID );

		if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
			foreach ( $user->roles as $role ){
				if( $role=='profesional'){
					$out .= '<a>Nombre</a><br><input name="nombre" type="hidden" value="'. $usuarioa->user_firstname .'"/><input name="email" disabled=true type="text" value="'. $usuarioa->user_firstname .'"/><br>'; 
				}
				if( $role=='administrador_conjunto'){
					$out .='<a>Nombre o Razón social</a><br><input name="nombre" type="hidden" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'NOMBREORAZON')) .'"/><input name="email" disabled=true type="text" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'NOMBREORAZON')) .'"/><br>'; 
				}
				if( $role=='proveedores'){
					$out .='<a>Nombre o Razón social</a><br><input name="nombre" type="hidden" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'NOMBREORAZON')) .'"/><input name="email" disabled=true type="text" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'NOMBREORAZON')) .'"/><br>'; 
				}
			}
		}
	 
	 $out .= '<a>Dirección</a><br><input name="direccion" type="hidden" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'DIRECCION')) . '"/><input name="email" disabled=true type="text" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'DIRECCION')) . '"/><br>';
	 $out .= '<a>Zona de ubicación</a><br><input name="zona" type="hidden" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'ZONA')) . '"/><input name="email" disabled=true type="text" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'ZONA')) . '"/><br>'; 
	 $out .= '<a>Telefonos</a><br><input name="telefonos" type="hidden" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'TELEFONOS')) . '"/><input name="email" disabled=true type="text" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'TELEFONOS')) . '"/><br>'; 
	 $out .= '<a>Correo</a><br><input name="email" type="hidden" value="'.$usuarioa->user_email . '"/><input name="email" disabled=true type="text" value="'.$usuarioa->user_email . '"/><br>';
	 
	 
     $out.='<div class="selcargos">';
	 $usuarios = get_users('orderby=nicename&role=propiedadhorizontal'); 
		$out .= '<select id="carg" name="carg" class="carg">';
		$contar=0;
		$carg = array();
		$out .= '<option value="filtro">Categoría</option>';
		foreach ($usuarios as $usuario) {
			if (!(in_array((cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CATEGORIA'))), $carg))) {
				$out .= '<option value="'.  str_replace(' ', '',cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CATEGORIA'))) . '">'. cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CATEGORIA')) . '</option>';
				$carg[$contar]=(cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CATEGORIA')));
				$contar=$contar+1;
			}			
		}
		$out .= '</select>';
	 $out .= '</div>';	
	 
	 $out .='
				<p><label  style="width: 60%;">Descripción de la convocatoria<br>
				<textarea class="tenvio" name="mensaje" cols="auto"></textarea>
			<p><input type="submit" name="Submit" value="Enviar"/></p> 
			</FORM>';
	 

     return $out;  
}
add_shortcode( 'enviopropiedadhorizontal', adda78 );  

function adda80( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'img' => '',
		  'titulo' => ''
     ), $atts ) );
     
	 $out='';
	 
	 $out .='<FORM id="contacto" name="contacto" action="/wp-content/themes/north/enviarmailprov.php" method="POST">';
	 
	 $usuarioa = wp_get_current_user();
	 $user = new WP_User( $usuarioa->ID );

		if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
		
			foreach ( $user->roles as $role ){
				if( $role=='profesional'){
					$out .= '<a>Nombre</a><br><input name="nombre" type="hidden" value="'. $usuarioa->user_firstname .'"/><input name="email" disabled=true type="text" value="'. $usuarioa->user_firstname .'"/><br>'; 
				}
				if( $role=='administrador_conjunto'){
					$out .='<a>Nombre o Razón social</a><br><input name="nombre" type="hidden" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'NOMBREORAZON')) .'"/><input name="email" disabled=true type="text" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'NOMBREORAZON')) .'"/><br>'; 
				}
				if( $role=='proveedores'){
					$out .='<a>Nombre o Razón social</a><br><input name="nombre" type="hidden" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'NOMBREORAZON')) .'"/><input name="email" disabled=true type="text" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'NOMBREORAZON')) .'"/><br>'; 
				}
			}
		}
	 
	 $out .= '<a>Dirección</a><br><input name="direccion" type="hidden" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'DIRECCION')) . '"/><input name="email" disabled=true type="text" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'DIRECCION')) . '"/><br>';
	 $out .= '<a>Zona de ubicación</a><br><input name="zona" type="hidden" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'ZONA')) . '"/><input name="email" disabled=true type="text" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'ZONA')) . '"/><br>'; 
	 $out .= '<a>Telefonos</a><br><input name="telefonos" type="hidden" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'TELEFONOS')) . '"/><input name="email" disabled=true type="text" value="'.cimy_uef_sanitize_content(get_cimyFieldValue($usuarioa->ID, 'TELEFONOS')) . '"/><br>'; 
	 $out .= '<a>Correo</a><br><input name="email" type="hidden" value="'.$usuarioa->user_email . '"/><input name="email" disabled=true type="text" value="'.$usuarioa->user_email . '"/><br>';
	 
     $out.='<div class="selcargos">';
	 $usuarios = get_users('orderby=nicename&role=proveedores'); 
		$out .= '<select id="carg" name="carg" class="carg">';
		$contar=0;
		$carg = array();
		/*$out .= '<option value="filtro">Categoría</option>';*/
		$allFields = get_cimyFields();

				if (count($allFields) > 0) {
					foreach ($allFields as $field) {
								if($field['NAME']=='CATEGORIA'){
									$catego=cimy_uef_sanitize_content($field['LABEL']);
									$categ=explode(",", $catego);
								}

					}
				}
				
				
				foreach ($categ as $categor) {
							$out .= '<option value="'. str_replace(' ', ' ',$categor ).'">'. $categor . '</option>';
				}
		
		$out .= '</select>';
		
		
	 $out .= '</div>';	
	 
	 $out .='
				<p><label  style="width: 60%;">Descripción de la convocatoria<br>
				<textarea class="tenvio" name="mensaje" cols="auto"></textarea>
			<p><input class="envi" type="submit" name="Submit" value="Enviar"/></p> 
			</FORM>';
	 

     return $out;  
}
add_shortcode( 'envioproveedores', adda80 );  

function adda65( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'buscar' => '',
		  'cargo' => '',
		  'porpagina' => '5',
		  'vista' => ''
     ), $atts ) );
	 
     $out="";
	 
	
    	
     $out.='<div class="profesionales">';
	 
	function get_current_user_role() { 
    global $wp_roles; 
    $current_user = wp_get_current_user(); 
    $roles = $current_user->roles; 
    $role = array_shift($roles); 
    return isset($wp_roles->role_names[$role]) ? translate_user_role($wp_roles->role_names[$role] ) : false; 
}
 
	 
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$idno=array();

	$actual=get_current_user_role();

    $paged -= 1;
    $limit = $porpagina; //Limite de usuarios por página  
    $offset = $paged * $limit;    
	
	$user_query = new WP_User_Query( array('meta_key'=>'last_name', 'orderby'=>'meta_value','role' => 'profesional')); 
	
	
	if($buscar==''){
		if ( ! empty( $user_query->results ) ) { 
			$contar=0;
				foreach ( $user_query->results as $usuario ){
					if(!(strpos(str_replace(' ', '',cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CARGO'))),$cargo)!==false)){
						$idno[$contar]=$usuario->ID;
						$contar =$contar+1;
					}		
				}
		}
	}else{
		if ( ! empty( $user_query->results ) ) { 
			$contar=0;
				foreach ( $user_query->results as $usuario ){
				if(!(strstr(strtolower($usuario->first_name),strtolower($buscar)))){
						$idno[$contar]=$usuario->ID;
						$contar =$contar+1;
						
					}		
				}
		}
	}
	
	
    if($cargo!=''||$buscar!=''){
		$user_query = new WP_User_Query( array('meta_key'=>'last_name', 'orderby'=>'meta_value','role' => 'profesional','number' => $limit, 'offset' => $offset, 'exclude' =>$idno)); 
	}else{
		$user_query = new WP_User_Query( array('meta_key'=>'last_name', 'orderby'=>'meta_value','role' => 'profesional','number' => $limit, 'offset' => $offset)); 
	}
	
    if ( ! empty( $user_query->results ) ) { 
        foreach ( $user_query->results as $usuario ){
		
			$out .= '<div class="filtro '. str_replace(",", ", ",str_replace(' ', '',cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CARGO')))).' '.$vista.'">';
			
			$out .= '<div class="cmsms_cc">
					<div class="one_fourth first_column prove1" data-type="" data-folder="column">
					<div data-type="" data-folder="text">';	
			
			$out .= '<a>Titulo</a><br>'. cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'TITULO')) . '<br>';
			$out .= '<a>Cargo al que aspira</a><br>'. str_replace(",", ", ", cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CARGO')) ) . '<br>';
			$out .= '<a>Nombre</a><br>'. $usuario->first_name . '<br>';
			$out .= '<div class="profe2"><div>';
			if($actual!='profesional'){
					$out .= '<a>Telefonos</a><br>'.cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'TELEFONOS')) . '<br>'; 
					
			}
			$out .= '</div></div>';			
			$out .= '</div></div>';
			
			$out .= '<div class="one_fourth profe2" data-type="" data-folder="column">
					 <div data-type="" data-folder="text">';
		
			
			$out .= '</div></div>';
			
			
			$out .= '<div class="one_half lineaiz prove3" data-type="" data-folder="column">
						<div data-type="" data-folder="text">';	
						
			$out .= '<div class="descr prof">'.cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'DESCRIPCION')).'<br></div>' ;
			
			if($actual!='profesional'){
					if ((cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CURRICULUM')))!='') {
							$out .= '<br><a class="linkk" href="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CURRICULUM')) . '">Ver Curriculum</a>';
					}
					$out .= '<br><a class="linkk" href="/perfil-usuario/?iduser='.$usuario->ID.'">Ver perfil</a><br>';
					$out .= '<a class="mai">Correo</a><br><a class="mai">'.$usuario->user_email . '</a>';
			}
					
			$out .= '</div></div>';			
			$out .= '</div></div>';
		}
		if(function_exists('wp_pagenavi')) { wp_pagenavi( array('query' => $user_query, 'type' => 'users')); }
    }
	 $out .= '</div>';	
	 
	 
	 
     
	 return $out;
	 
}
add_shortcode( 'profesionales', adda65 );  


function adda82( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'buscar' => '',
		  'categoria' => '',
		  'porpagina'=> '5',
		  'vista' => ''
     ), $atts ) );
     
	 $out='';
	 
	 
	   $out.='<div class="profesionales">';
	 
	 	
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$idno=array();

	
    $paged -= 1;
    $limit = $porpagina; //Limite de usuarios por página  
    $offset = $paged * $limit;    
	
	$user_query = new WP_User_Query( array('meta_key'=>'last_name', 'orderby'=>'meta_value','role' => 'proveedores')); 
	if($buscar==''){
		if ( ! empty( $user_query->results ) ) {
			$contar=0;
				foreach ( $user_query->results as $usuario ){
					if(!(strpos(str_replace(' ', '',cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CATEGORIA'))),$categoria)!==false)){
						$idno[$contar]=$usuario->ID;
						$contar =$contar+1;
					}		
				}
		}
	}else{
		if ( ! empty( $user_query->results ) ) { 
			$contar=0;
				foreach ( $user_query->results as $usuario ){
				
					if(!(strstr(strtolower(cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'NOMBREORAZON'))),strtolower($buscar)))){
						$idno[$contar]=$usuario->ID;
						$contar =$contar+1;
						
					}		
				}
		}
	}
	
	
    if($categoria!=''||$buscar!=''){
		$user_query = new WP_User_Query( array('meta_key'=>'last_name', 'orderby'=>'meta_value','role' => 'proveedores','number' => $limit, 'offset' => $offset, 'exclude' =>$idno)); 
	}else{
		$user_query = new WP_User_Query( array('meta_key'=>'last_name', 'orderby'=>'meta_value','role' => 'proveedores','number' => $limit, 'offset' => $offset)); 
	}
	
					   
   if ( ! empty( $user_query->results  ) ) { 
		
		foreach ( $user_query->results  as $usuario ){ 
		
            $out .= '<div class="filtro '. str_replace(' ', '',cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CATEGORIA'))).' '.$vista.' ">';
			
			$out .= '<div class="cmsms_cc">
					<div class="one_fourth first_column prove1" data-type="" data-folder="column">
					<div data-type="" data-folder="text">';	
			
			$out .= '<a>Nombre o Razón social</a><br>'. cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'NOMBREORAZON')) . '<br>';
			
			if ((cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'LOGO')))!='') {
				$out .= '<img class="avlogo" src="'. cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'LOGO')) . '"><br>';
			}
			
			$out .= '</div></div>';
			
			$out .= '<div class="one_fourth prove2" data-type="" data-folder="column">
					 <div data-type="" data-folder="text">';
					
					
			$out .= '<a>Dirección</a><br>'. cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'DIRECCION')) . '<br>';
			$out .= '<a>Telefonos</a><br>'.cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'TELEFONOS')) . '<br>'; 
			$out .= '<a>Celular</a><br>'.cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CELULAR')) . '<br>';
			$out .= '<a>Ubicación</a><br>Zona: '.cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'ZONA')) .  '<br>';
			
			
			$out .= '</div></div>';
			
			$out .= '<div class="one_half lineaiz prove3" data-type="" data-folder="column">
						<div data-type="" data-folder="text">';	
						
			$out .= '<div class="descr prov">'.cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'DESCRIPCION')).'<br></div>' ;
			
			$out .= '<br><a class="linkk" href="/perfil-usuario/?iduser='.$usuario->ID.'">Ver perfil</a><br>';
			if(cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'WEB'))!=''){
				$out .= '<a class="linkk" target="_blank" href="http://'.cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'WEB')).'">Ver web</a><br>';
			}
			$out .= '<a  class="mai" href="mailto:'.$usuario->user_email.'">Correo</a><br class="mai"><a class="mai" href="mailto:'.$usuario->user_email.'">'.$usuario->user_email . '</a>';
			$out .= '</div></div>';			
			$out .= '</div></div>';
			
        }
		if(function_exists('wp_pagenavi')) { $out .=wp_pagenavi( array('query' => $user_query, 'type' => 'users')); }
    }
	 $out .= '</div>';	
	 
     return $out;  
}
add_shortcode( 'proveedores', adda82 );

function adda81( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'img' => '',
		  'titulo' => ''
     ), $atts ) );
     
	 $out='';
	 
    	
     $out.='<div class="selcargos">';
	 $usuarios = get_users('orderby=nicename&role=proveedores');
		$out .= '<select id="carg" name="carg" class="carg cate">';
		$contar=0;
		$carg = array();
		$out .= '<option value="filtro">Seleccionar una Categoría</option>';
		$allFields = get_cimyFields();

				if (count($allFields) > 0) {
					foreach ($allFields as $field) {
								if($field['NAME']=='CATEGORIA'){
									$catego=cimy_uef_sanitize_content($field['LABEL']);
									$categ=explode(",", $catego);
								}

					}
				}
				
				
				foreach ($categ as $categor) {
							$out .= '<option value="'. str_replace(' ', '',$categor ).'">'. $categor . '</option>';
				}
		
		/*
		foreach ($usuarios as $usuario) {			
			if (!(in_array((cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CATEGORIA'))), $carg))) {
				if((cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CATEGORIA'))) != 'Categoría'){
					$out .= '<option value="'.  str_replace(' ', '',cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CATEGORIA'))) . '">'. cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CATEGORIA')) . '</option>';
					$carg[$contar]=(cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CATEGORIA')));
					$contar=$contar+1;
				}
			}
			  			
		}*/
		
		
		$out .= '</select>';
	 $out .= '<article id="modo">
				<a href="javascript:RegresarEstilo()" id="Lista">
					<img alt="" src="/wp-content/themes/north/img/listaa.png">
				</a>
				<a href="javascript:CambiarEstilo()" id="Grid">
					<img alt="" src="/wp-content/themes/north/img/gridd.png">
				</a>
			</article>';
	 $out .= '<div class="botu"><input name="busc" class="buscar prov" placeholder="Buscar por nombre de la empresa"><input class="botbus prov" type="submit" value="Buscar"></div>
			';

	 $out .= '</div>';	
	
	 
     return $out;  
}
add_shortcode( 'categorias', adda81 );  

function adda67( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'img' => '',
		  'titulo' => ''
     ), $atts ) );
     
	 $out='';
	 
    	
     $out.='<div class="selcargos">';
	 $usuarios = get_users('orderby=nicename&role=profesional');
		$out .= '<select id="carg" name="carg" class="carg cargo">';
		$contar=0;
		$carg = array();
		$out .= '<option value="filtro">Seleccionar un Cargo</option>';
		
			$allFields = get_cimyFields();

				if (count($allFields) > 0) {
					foreach ($allFields as $field) {
								if($field['NAME']=='CARGO'){
									$catego=cimy_uef_sanitize_content($field['LABEL']);
									$categ=explode(",", $catego);
								}

					}
				}
				
				
				foreach ($categ as $categor) {
							$out .= '<option value="'. str_replace(' ', '',$categor ).'">'. $categor . '</option>';
				}
		
		/*
		foreach ($usuarios as $usuario) {
			if (!(in_array((cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CARGO'))), $carg))) {
				if((cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CARGO'))) != 'Cargo'){
					$out .= '<option value="'.  str_replace(' ', '',cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CARGO'))) . '">'. cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CARGO')) . '</option>';
					$carg[$contar]=(cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CARGO')));
					$contar=$contar+1;
				}
			}			
		}*/
		$out .= '</select>';
	 $out .= '<article id="modo">
				<a href="javascript:RegresarEstilo()" id="Lista">
					<img alt="" src="/wp-content/themes/north/img/listaa.png">
				</a>
				<a href="javascript:CambiarEstilo()" id="Grid">
					<img alt="" src="/wp-content/themes/north/img/gridd.png">
				</a>
			</article>';
	 $out .= '<div class="botu"><input name="busc" class="buscar prof" placeholder="Buscar por nombre del profesional"><input class="botbus prof" type="submit" value="Buscar"></div>
				';
	 $out .= '</div>';	
	
	 
     return $out;  
}
add_shortcode( 'cargos', adda67 );  


function admin_css()
{
 $url = get_option('siteurl');
    $url = get_bloginfo('template_directory') . '/css/jcss.css';
   
echo '<link rel="stylesheet" type="text/css" href="'.$url.'">';
}
add_action( 'admin_head', 'admin_css' );




function auto_login() {
    if (!is_user_logged_in()) {
		$user_k=$_GET['key'];
        $user_login = $_GET['per'];
		$user_m=$_GET['mail'];
		
        $user = get_user_by( 'email', $user_login );
        $user_id = $user->ID;
		$usk=get_cimyFieldValue($user_id, 'KEYREG');
		
		if($user_m=='r3turNf4l33'){

			global $wpdb;
				$field_id = $wpdb->get_var(
					"
					SELECT ID
					FROM wp_cimy_uef_fields
					WHERE NAME = 'DESEOMAIL'
					"
				);
				$update_status = $wpdb->update(
					'wp_cimy_uef_data', //table name
					array(
						'value' => $wpdb->escape('NO')//value to update
					),
					array(
						'field_id' => $field_id, //where clause
						'user_id' => $user_id
					)
				);
		}
		if($user_k==$usk){
        wp_set_current_user($user_id, $user_login);
        wp_set_auth_cookie($user_id);
        do_action('wp_login', $user_login);
		}
	}
}
add_action('init', 'auto_login');


function desacepto() {
		$user_k=$_GET['key'];
        $user_login = $_GET['per'];
        $user = get_user_by( 'email', $user_login );
        $user_id = $user->ID;
		$usk=get_cimyFieldValue($user_id, 'KEYREG');
		
		$user_con=$_GET['conacept'];
		if($user_con=='nO434c3pto'){

			global $wpdb;
				$field_id = $wpdb->get_var(
					"
					SELECT ID
					FROM wp_cimy_uef_fields
					WHERE NAME = 'TERMINOS'
					"
				);
				$update_status = $wpdb->update(
					'wp_cimy_uef_data', //table name
					array(
						'value' => $wpdb->escape('NO')//value to update
					),
					array(
						'field_id' => $field_id, //where clause
						'user_id' => $user_id
					)
				);
		}
		if($user_con=='434c3pto'){

			global $wpdb;
				$field_id = $wpdb->get_var(
					"
					SELECT ID
					FROM wp_cimy_uef_fields
					WHERE NAME = 'TERMINOS'
					"
				);
				$update_status = $wpdb->update(
					'wp_cimy_uef_data', //table name
					array(
						'value' => $wpdb->escape('YES')//value to update
					),
					array(
						'field_id' => $field_id, //where clause
						'user_id' => $user_id
					)
				);
		}

 }
add_action('init', 'desacepto');



/*Cargamos estilos CSS propios
function cssDashboard1() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/admin-css/estilo.css' );
	
}
add_action('admin_print_styles', 'cssDashboard1' );

function cssDashboard2() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/admin-css/adminbar.css' );
	
}
add_action('admin_print_styles', 'cssDashboard2' );*/

/**
 * Add additional custom field
 */
 
add_action('admin_head-user-edit.php', 'setup_user_edit');

function setup_user_edit() {

    add_filter('gettext', 'change_profile_labels');
}

function change_profile_labels($input) {

    if ('Last Names' == $input)
        return 'Prioridad';

    if ('Apellidos' == $input)
        return 'Prioridad';

    return $input;
}
 
 
 
 


// Add role class to body
function add_role_to_body($classes) {
	
	global $current_user;
	$user_role = array_shift($current_user->roles);
	
	$classes .= $user_role;
	return $classes;
}
add_filter('admin_body_class', 'add_role_to_body');



function adda811( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'img' => '',
		  'titulo' => ''
     ), $atts ) );
     
	 $out='';
	 $cate=$_GET["tipo"];
	 $busc=$_GET["buscar"];
    	
     $out.='[cargos]';
			
			if($cate==""&&$busc==""){
		 $out.='	<img src="http://convocar.net/wp-content/uploads/2014/07/categoria-seleccion.png" alt="categoria-seleccion" class="alignnone size-full wp-image-404" />';
			}else{
			$out.='[profesionales buscar="'.$busc.'" cargo="'.$cate.'" porpagina="9" vista=""]';
			}
			
	 
	 
	
	 
     return do_shortcode($out);  
}
add_shortcode( 'proflis', adda811 ); 

function adda812( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'img' => '',
		  'titulo' => ''
     ), $atts ) );
     
	 $out='';
	 $cate=$_GET["cat"];
	 $busc=$_GET["buscar"];
    	
     $out.="[categorias]";

		if($cate==""&&$busc==""){
		$out.= '<img src="http://convocar.net/wp-content/uploads/2014/07/categoria-seleccion.png" alt="categoria-seleccion" class="alignnone size-full wp-image-404" />';
		}else{
		$out.= "[proveedores buscar='".$busc."' categoria='".$cate."' porpagina='15' vista='']";
		if($cate!=""){
		$out.= "
		<style>
		.public.".$cate." {
			display:block !important;
		   }
		.public.paute1 {
			display:none !important;
		   }
		</style>";
		}
		}
			
	 
	 
	
	 
     return do_shortcode($out);  
}
add_shortcode( 'provlis', adda812 );



function adda8121( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'img' => '',
		  'titulo' => ''
     ), $atts ) );
			 
			$id =  $_GET["iduser"];
			$profileuser = get_userdata( $id );
			$role = implode(', ', $profileuser->roles);
		$out ='';
		$out .= '<div class="login profile " id="theme-my-login">';
	


		
		$out .= '<div class="form-table">';
		
		
				if( $role=='profesional'){
					$out .= '<a>Nombre</a><br><input name="nombre" type="hidden" value="'. $profileuser->user_firstname .'"/><input name="email" disabled=true type="text" value="'. $profileuser->user_firstname .'"/><br>'; 
				}
				if( $role=='proveedores'){
					$out .= '<a>Nombre o Razón social</a><br><input name="email" disabled=true type="text" value="'. cimy_uef_sanitize_content(get_cimyFieldValue($profileuser->ID, 'NOMBREORAZON')) .'"/><br>'; 
				}
		
		$out .= '
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

		$out .= '</div>';
	 
     return do_shortcode($out);  
}
add_shortcode( 'perfilusuario', adda8121 );

	
function adda8122( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'img' => '',
		  'titulo' => ''
     ), $atts ) );
			 $out='';
			
		$out .= '<table id="tablaor" data-page-length="10" class="table table-striped table-bordered" cellspacing="0">
						<thead>
							<tr>
								<th>Categoría</th>
								<th>Convocatoria</th>
								<th style="width:15%;">Fecha</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Categoría</th>
								<th>Convocatoria</th>
								<th>Fecha</th>
							</tr>
						</tfoot>
			

			<tbody>';
			

				$clientes = getListaClientes();
				foreach ($clientes as $cliente) { 

			
			$out .='
			<tr>
				<td>
					'. $cliente->apellido2 .'
				</td>
				<td>
					<div style="max-height: 55px !important; overflow: auto;">'. $cliente->web .'</div>
				</td>
				<td>
					'.$cliente->fechaAlta .'
				</td>
			</tr>';
			

			
			
			}	
		$out .='</tbody></table>';
	 
     return do_shortcode($out);  
}
add_shortcode( 'convocatorias', adda8122 );


add_action( 'user_register', 'myplugin_registration_save', 10, 1 );
function myplugin_registration_save( $user_id ) {

    if ( isset( $_POST['cimy_uef_ROLES'] ) ){
        if($_POST['cimy_uef_ROLES']=='Profesional'){
			wp_update_user( array ('ID' => $user_id, 'role' => 'profesional' ) ) ;
			wp_set_current_user($user_id, $_POST['user_email']);
			wp_set_auth_cookie($user_id);
			do_action('wp_login', $_POST['user_email']);
		}
	}
}


function adda81221( $atts, $content = null ) {
     extract( shortcode_atts( array(
	      'img' => '',
		  'titulo' => ''
     ), $atts ) );
			 $out='';
			$url=get_template_directory_uri();
		$out .= '<div style="width:100%; text-align:center;">
					<img src="'.$url.'/img/restri.png"><a href="/contactos/"><h1>Ir a pagina de contacto</h1></a>
				</div>
			';
	 
     return do_shortcode($out);  
}
add_shortcode( 'restringir', adda81221 );



function my_files_only( $wp_query ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/upload.php' ) !== false ) {
        if ( !current_user_can( 'level_5' ) ) {
            global $current_user;
            $wp_query->set( 'author', $current_user->id );
        }
    }
}

add_filter('parse_query', 'my_files_only' );