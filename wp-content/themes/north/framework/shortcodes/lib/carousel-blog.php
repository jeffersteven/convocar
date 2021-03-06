<?php

// Recent Work Shortcode


function vntd_blog_carousel($atts, $content = null) {
	extract(shortcode_atts(array(
		"cats" => '',
		"posts_nr" => '',
		"thumb_style" => ''
	), $atts));
	
	wp_enqueue_script('prettyPhoto', '', '', '', true);
	wp_enqueue_style('prettyPhoto');
	
	wp_enqueue_script('owl-carousel', '', '', '', true);
	wp_enqueue_style('owl-carousel');

	ob_start();

	echo '<div class="vntd-portfolio-carousel blog-carousel"><div class="works white">';
	
	$size = 'portfolio-square';
				
	wp_reset_postdata();
	
		$user_id = get_current_user_id();  // Get current user Id
		$user_groups = wp_get_object_terms($user_id, 'user-group', array('fields' => 'all_with_object_id'));  // Get user group detail
		foreach($user_groups as $user_gro){		
			$vari= wp_get_object_terms( $user_id, $user_gro->taxonomy);
			foreach($vari as $user_gro1){
				$grupo = $user_gro1->slug;
			}
		}
	
	$args = array(
		'posts_per_page' => $posts_nr,
		'category_name'		=> $grupo,
		'orderby'	=> 'slug'
	);
	$the_query = new WP_Query($args); 
	
	if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
	
	$img_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size);
	$thumb_url = $img_url[0];
	
	?>
		
		<!-- Item -->
		<div class="item">
			<!-- Image, Buttons -->
			<?php if($thumb_url) { ?>
			<div class="f-image">
				<!-- Image -->
				<div class="carousel-image-wrap">
					<img src="<?php echo $thumb_url; ?>" alt="<?php echo the_title(); ?>">
				</div>
				
				<!-- Hover Tags, Link -->
				<div class="f-button first">
					<a href="<?php echo get_permalink(); ?>" class="featured-ball first ex-link" >
						<i class="fa fa-link"></i>
					</a>
				</div>
				<!-- End Link -->

				<!-- Detail -->
				<div class="f-button second">
					<a href="<?php echo $thumb_url; ?>" data-rel="prettyPhoto[featured-work]" class="featured-ball second">
						<i class="fa fa-plus"></i>
					</a>
				</div>
				<!-- End Detail -->
			</div>
			<!-- End Image, Buttons -->
			<?php } ?>

			<!-- Texts -->
			<div class="texts">
				<!-- Item Header -->
				<h1 class="f-head font-primary normal uppercase">
					<a href="<?php echo get_permalink(); ?>" class="ex-link" >
						<?php the_title(); ?>
					</a>
				</h1>
				
				<div class="post-info">
					<!-- Post Item -->
					<a href="<?php echo get_the_author_meta( 'user_url'); ?>" class="post-item">
						<?php the_author(); ?>
						
					</a>
					<span>on</span>
					<span class="post-item"><?php the_time('F d, Y'); ?></span>
				</div>

				<!-- Item Description -->
				<p>
					<?php echo vntd_excerpt_plain(20); ?>
				</p>
			</div>
			<!-- End Texts -->
		</div>
		<!-- End Item -->
	
	<?php
	
	
	endwhile; endif; wp_reset_postdata();		
	
	echo '</div>';
	
	$content = ob_get_contents();
	ob_end_clean();
	
	return $content;
	
}
remove_shortcode('blog_carousel');
add_shortcode('blog_carousel', 'vntd_blog_carousel');