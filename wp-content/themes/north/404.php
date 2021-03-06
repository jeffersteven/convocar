<?php 
get_header();


?>

<div class="page-content page-content-404 container">

	<section id="home" class="container relative">
			
		<div class="inner t-center">
			
			<div class="vntd-special-heading">
				<h1 class="header font-secondary"><?php _e('Ooops! Page Not Available.','vntd_north'); ?></h1>
				<div class="header-strips-one"></div>
				<h2 class="description normal"><?php _e('Sorry, but the requested resource was not found on this site. Please try again or contact the administrator for assistance.','vntd_north'); ?></h2>
			</div>		

			<!-- Contact Form -->
			<form id="search-form" name="sform" class="clearfix t-center" action="<?php echo home_url(); ?>/">
				
				<div>
					<h5 class="gray font-secondary"><?php _e('Are you looking for something?','vntd_north'); ?></h5>
					<input name="s" id="s" type="text" value="" class="search-form form font-secondary light" placeholder="<?php _e('Quick Search..','vntd_north') ?>" />
					<button type="submit" id="submit" name="submit" class="form search-form-button colored-bg white light"><?php _e('Search','vntd_north'); ?></button>
				</div>
	
				<div>
					
				</div>
			</form>
			<!-- End Form -->

	</div><!-- End Inner -->

	</section><!-- End Home Section -->
	
	<?php
	
	$extra_page = $smof_data['vntd_404_content'];
	
	if($extra_page) {
		$page_data = get_page_by_path($extra_page);
		
		$content = apply_filters('the_content', $page_data->post_content);
		
		echo $content;
	}
	
	?>

</div>	

<?php get_footer(); ?>