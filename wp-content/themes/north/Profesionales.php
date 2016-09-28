<?php
include_once('../../../wp-load.php');

if(isset($_POST["servicio"])){
		do_shortcode('[cargos]');
		do_shortcode('[profesionales cargo='.$_POST["cargo"].']');
		} 	
    	
     
	 