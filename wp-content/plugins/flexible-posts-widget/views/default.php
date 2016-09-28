<?php
/**
 * Flexible Posts Widget: Default widget template
 * 
 * @since 3.4.0
 *
 * This template was added to overcome some often-requested changes
 * to the old default template (widget.php).
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

echo $before_widget;

if ( ! empty( $title ) )
	echo $before_title . $title . $after_title;

if ( $flexible_posts->have_posts() ):
?>
<div class="vc_col-sm-12 wpb_column vc_column_container">
		<div class="wpb_wrapper">
			<!-- vc_grid start -->
<div class="vc_grid-container-wrapper vc_clearfix">
	<?php while ( $flexible_posts->have_posts() ) : $flexible_posts->the_post(); global $post; 
	
					if( $thumbnail == true ) {
						// If the post has a feature image, show it
						if( has_post_thumbnail() ) {
							$urlimg= wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
						// Else if the post has a mime type that starts with "image/" then show the image directly.
						} elseif( 'image/' == substr( $post->post_mime_type, 0, 6 ) ) {
							 wp_get_attachment_image( $post->ID, $thumbsize );
						}
					}?>
	
		<div class="vc_grid-item vc_clearfix vc_col-sm-6 vc_grid-item-zone-c-bottom vc_visible-item zoomIn animated fadeInLeft visible">
			<div class="vc_grid-item-mini vc_clearfix vc_is-hover">
			<div class="vc_gitem-animated-block">
<div class="vc_gitem-zone vc_gitem-zone-a vc-gitem-zone-height-mode-auto vc-gitem-zone-height-mode-auto-1-1 vc_gitem-is-link" style="background-image: url(<?php echo $urlimg; ?>) !important;">
	<a href="<?php echo the_permalink(); ?>" title="<?php the_title(); ?>" class="vc_gitem-link vc-zone-link"></a>	
	<img src="<?php echo $urlimg ?>" class="vc_gitem-zone-img">	
	<div class="vc_gitem-zone-mini">
			</div>
</div>
</div>
<div class="vc_gitem-zone vc_gitem-zone-c vc_custom_1419240516480">
	<div class="vc_gitem-zone-mini">
		<div class="vc_gitem_row vc_row vc_gitem-row-position-top"><div class="vc_col-sm-12 vc_gitem-col vc_gitem-col-align-left"><div class="vc_custom_heading vc_gitem-post-data vc_gitem-post-data-source-post_title"><h4 style="text-align: left"><?php the_title(); ?></h4></div><div class="vc_custom_heading vc_gitem-post-data vc_gitem-post-data-source-post_excerpt"><p style="text-align: left"></p><p><?php echo get_the_excerpt(); ?> </p>
<p></p></div><div class="vc_btn3-container vc_btn3-left"><a href="<?php echo the_permalink(); ?>" class="vc_gitem-link vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-color-juicy-pink" title="Leer más">Leer más</a></div>
</div></div>	</div>
</div>
</div><div class="vc_clearfix"></div></div>

	<?php endwhile; ?>
	
	</div></div></div><!-- .dpe-flexible-posts -->
<?php	
endif; // End have_posts()
	
echo $after_widget;





