<?php
/**
 * Template Name: Historial convocatorias
 */
$post = $wp_query->post;
get_header(); 
$layout = get_post_meta(vntd_get_id(), 'page_layout', true);
$page_width = get_post_meta(vntd_get_id(), 'page_width', true);
if(!$page_width) $page_width = 'content';
$page_links = '';
?>

<div class="page-holder page-layout-<?php echo $layout; ?>">
		
	<?php 		
	
	if($page_width != 'fullwidth') {
		echo '<div class="inner clearfix">';
	}
	
	if($layout != "fullwidth") {
		echo '<div class="page_inner">';
	}

echo '
		<div style="font-weight:bold; float:left; width: 25%;">
      		Categoría
    	</div>
    	<div style="font-weight:bold; float:left; width: 55%;">
      		Convocatoria
    	</div>
		<div style="font-weight:bold; float:left; width: 20%;">
			Fecha
    	</div>

<div class="histab">
<table class="histo widefat post " cellspacing="0" style="width:95%;">
	
	
	<tbody>';
	

		$clientes = getListaClientes();
		foreach ($clientes as $cliente) { 
 	 echo'
 	<tr id="" class="alternate author-self status-publish iedit" valign="top">
    	<td class="categories column-apellido2" style="width: 25%;">
      		'. $cliente->apellido2 .'
    	</td>
    	<td class="categories column-web" style="width: 55%;">
      		<div style="max-height: 55px !important; overflow: auto;">'. $cliente->web .'</div>
    	</td>
		<td class="categories column-fechaAlta" style="width: 20%;">
      		'.$cliente->fechaAlta .'
    	</td>
	</tr>';
    

	
	
    }	
	echo'</tbody></table></div>
	<div style="font-weight:bold; float:left; width: 25%;">
      		Categoría
    	</div>
    	<div style="font-weight:bold; float:left; width: 55%;">
      		Convocatoria
    	</div>
		<div style="font-weight:bold; float:left; width: 20%;">
			Fecha
    	</div>
	';
	
	if($layout != "fullwidth") { 
		echo '</div>';
		get_sidebar();    		
	}
	
	if($page_width != 'fullwidth') {
		echo '</div>';
	}
	
	if($page_links == 'yes') {
		wp_link_pages();
	}
	
	?>

</div>

<?php get_footer(); ?>
	