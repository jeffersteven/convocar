<?php
/*
	Plugin Name: Convocatorias
	Description: Muestra un listado de las convocatorias realizadas por email
	Author: Jefferson Steven Castañeda Guerrero
	Version: 1.0
	Author URI: http://www.webjef.co
*/


function convocatorialist_install()
{
   global $wpdb;
   $table_name = $wpdb->prefix . "convocatorialist";
   
   $sql = " CREATE TABLE $table_name(
		IDCliente int(11) NOT NULL AUTO_INCREMENT ,
		nombre char(50) NOT NULL ,		
		apellido1 char(50) NOT NULL ,
		apellido2 char(50),
		web varchar(999),		
		fechaAlta varchar(100) ,		
		PRIMARY KEY ( `IDCliente` )	
	) ;";
	
   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);
   
   //Cargamos datos iniciales
   cargaDatosIniciales();
}

function cargaDatosIniciales()
{
	/*global $wpdb;
    $table_name = $wpdb->prefix . "convocatorialist";
	
	$arrayDatos = array('nombre' => 'Antonio', 'apellido1' => 'Carvajal', 'apellido2' => 'Carmona', 'web' => 'http://www.antoniocarvajal.com muchsisisisisimo texto para el ejemplor', 'fechaAlta' => current_time('mysql'));
	$wpdb->insert($table_name,$arrayDatos);
	
	$arrayDatos = array('nombre' => 'Emmanuelle', 'apellido1' => 'Bergougnoux', 'web' => 'http://www.servipubli.es', 'fechaAlta' => current_time('mysql'));
	$wpdb->insert($table_name,$arrayDatos);*/
}

function convohecha( $ids, $email,$razon, $cargo, $descri, $fecha)
{
	global $wpdb;
    $table_name = $wpdb->prefix . "convocatorialist";
	
	$arrayDatos = array('nombre' => $email, 'apellido1' => $razon, 'apellido2' => $cargo, 'web' => $descri, 'fechaAlta' => current_time('mysql'));
	$wpdb->insert($table_name,$arrayDatos);
	
}
register_activation_hook(__FILE__,'convocatorialist_install');


function convocatorialist_uninstall()
{
	global $wpdb; 
	$table_name = $wpdb->prefix . "convocatorialist";
	
	$sql = "DROP TABLE $table_name";
	$wpdb->query($sql);
}
register_deactivation_hook(__FILE__,'convocatorialist_uninstall');



add_action('admin_menu', 'convocatorialist_menu');

function convocatorialist_panel()
{  		
  include('panel.php');	
}

function convocatorialist_menu()
{
  // Extraemos el directorio en el que estamos para ir usándolo luego
	$pluginDir = pathinfo( __FILE__ );
	$pluginDir = $pluginDir['dirname'];
	
	
	//////// DECLARACION DEL MENU ////////////
	
	// titulo de la nueva sección:
	$page_title = "Convocatorias";

	// titulo en el menú
	$menu_title = "Convocatorias";

	// nivel necesario para poder ver el menú (admin:10, editores:8)
	// + info en: http://codex.wordpress.org/User_Levels
	$access_level = "8";

	// la página que se cargará al clickar en el menú
	$content_file = $pluginDir . '/panel.php';	

	// Función para cargar dentro de la página incluida para generar el menú
	// Si no se indica, se asume que al incluir el fichero ya se ha generado todo el
	// contenido necesario.
	$content_function = null;

	// url del icono para el menú
	$menu_icon_url = null;

	add_menu_page($page_title, $menu_title, $access_level, $content_file, $content_function, $menu_icon_url);
	
  // Declaramos también como primer submenú la misma página con los mismos datos
	add_submenu_page($content_file,$page_title, $menu_title, $access_level, $content_file, 'convocatorialist_panel');

}

function getListaClientes(){
	global $wpdb; 
	$table_name = $wpdb->prefix . "convocatorialist";
	$listaClientes = $wpdb->get_results("SELECT IDCliente,nombre,apellido1,apellido2,web,fechaAlta FROM $table_name order by fechaAlta DESC; " );
	return $listaClientes;
}

function borrarConvo($pborrar){
	global $wpdb; 
	$table_name = $wpdb->prefix . "convocatorialist";
	$listaClientes = $wpdb->get_results("Delete From $table_name Where IDCliente='$pborrar';" );
	$wpdb->query($sql);
}





?>