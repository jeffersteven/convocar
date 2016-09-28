<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />   
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">    
    
	
		
	<!-- End Back To Top Button -->
		<script src="/wp-content/themes/north/jsc/jquery.min.js" type="text/javascript"></script>
	<script src="/wp-content/themes/north/jsc/jquery.validate.js" type="text/javascript"></script>
	<script src="/wp-content/themes/north/jsc/jquery.dataTables.min.js"></script>
	<script src="/wp-content/themes/north/jsc/dataTables.bootstrap.min.js"></script>
	<script src="/wp-content/themes/north/jsc/jsc.js" type="text/javascript"></script>
	<script type="text/javascript" src="/wp-content/themes/north/jsc/jquery.autocomplete.pack.js"></script>
<link rel="stylesheet" type="text/css" href="/wp-content/themes/north/jsc/jquery.autocomplete.css" media="screen" />
	

<script type="text/javascript">
$(document).ready(function(){
var data = '<?php 
	$blogusers = get_users('orderby=nicename&role=profesional');
    foreach ($blogusers as $user) {
        echo $user->first_name;
		echo "  ";
    }
wp_reset_postdata();?>'.split("  ");
try{
$("input.buscar.prof").autocomplete(data);
}catch(e) {
    
}
});

// Change the selector if needed
var $table = $('.tabla'),
    $bodyCells = $table.find('.tabla tbody tr:first').children(),
    colWidth;

// Adjust the width of thead cells when window resizes
$(window).resize(function() {
    // Get the tbody columns width array
    colWidth = $bodyCells.map(function() {
        return $(this).width();
    }).get();
    
    // Set the width of thead columns
    $table.find('.tabla thead tr').children().each(function(i, v) {
        $(v).width(colWidth[i]);
    });    
}).resize(); // Trigger resize handler
</script>

<script type="text/javascript">
$(document).ready(function(){
var data = '<?php 
	$blogusers = get_users('orderby=nicename&role=proveedores');
    foreach ($blogusers as $user) {
        echo cimy_uef_sanitize_content(get_cimyFieldValue($user->ID, 'NOMBREORAZON'));
		echo "  ";
    }
wp_reset_postdata();?>'.split("  ");
try{
$("input.buscar.prov").autocomplete(data);
}catch(e) {
    
}

});
</script>
	
	
	

	
	
	
    <?php
    
    global $smof_data; 
    
    if(array_key_exists('vntd_custom_favicon', $smof_data)) {
	    if($smof_data['vntd_custom_favicon'] ) {
	    	echo '<link rel="shortcut icon" href="'.$smof_data['vntd_custom_favicon'].'" />';
	    }   
	}
	wp_head(); 
	
	?>        

</head>

<body <?php body_class(vntd_body_skin()); ?>>
	<div class="sesion" id="page"><!--?php fql_add_bar(); ?--></div>
	<section id="home"></section>
		<?php global $current_user;
		get_currentuserinfo();
		
		if ( is_user_logged_in() ) {
			echo '<div class="nombreu">Usuario: '.$current_user->user_firstname.get_cimyFieldValue($current_user->ID, 'NOMBREORAZON').'</div>';
		}
		?>
		
		
	<?php
	
	
	if(array_key_exists('vntd_loader', $smof_data)) { if($smof_data['vntd_loader'] || !isset($smof_data['vntd_loader'])) { 
	
		$loader_class = 'dark-border';
		if($smof_data['vntd_skin'] == 'dark') {
			$loader_class = 'colored-border';
		}
	
		?>
		<!-- Page Loader -->
		<section id="pageloader" class="white-bg">
			<div class="outter <?php echo $loader_class; ?>">
				<div class="mid <?php echo $loader_class; ?>"></div>
			</div>
		</section>
		<?php 
		
	}}
	
	if(vntd_navbar_style('style') != 'disable') {
	
	?>
	
	
	
	<nav id="navigation<?php echo vntd_navbar_style('id'); ?>" class="<?php echo vntd_navbar_style(); ?>">
	
		<div class="nav-inner">
			<div class="logo">
				<!-- Navigation Logo Link -->
				<a href="<?php vntd_logo_url(); ?>" class="scroll">
					<?php
					$navbar_color = '';
					if(array_key_exists('vntd_navbar_color', $smof_data)) {
						$navbar_color = $smof_data['vntd_navbar_color'];
					}
					if(array_key_exists('vntd_logo_url', $smof_data)) {
						if(vntd_navbar_style('style') == 'style2' && $smof_data['vntd_logo_light_url'] && get_post_meta(vntd_get_id(),'navbar_color',TRUE) != 'white' || $navbar_color == 'dark' && $smof_data['vntd_logo_light_url']) {
							$logo_url = $smof_data['vntd_logo_light_url'];
						} else {
							$logo_url = $smof_data['vntd_logo_url'];
						}
					
						echo '<img class="site_logo" src="'.$logo_url.'" alt="'.get_bloginfo().'">';
					}
					?>
				</a>
			</div>
			<!-- Mobile Menu Button -->
			<a class="mobile-nav-button colored"><i class="fa fa-bars"></i></a>
			<!-- Navigation Menu -->
			<div class="nav-menu clearfix semibold">
				 
				<?php 			
				
				if (has_nav_menu('primary')) {
					wp_nav_menu( array('theme_location' => 'primary','container' => false,'menu_class' => 'nav uppercase font-primary','walker' => new Vntd_Custom_Menu_Class())); 
				} else {
					echo '<span class="vntd-no-nav">No custom menu created!</span>';
				}	
				
				if(class_exists('Woocommerce') && $smof_data['vntd_topbar_woocommerce']) vntd_woo_nav_cart();			
				
				?>	

			</div>
		</div>
	</nav>
	
	<?php 
	
	}
	
	if(!is_front_page() && $smof_data['vntd_header_title'] != 0 && get_post_meta(vntd_get_id(), 'page_header', true) != 'no-header' && !is_404() && !is_page_template('template-onepager.php')) {
		vntd_print_page_title();
	}
	
	?>
	
	<div id="page-content">