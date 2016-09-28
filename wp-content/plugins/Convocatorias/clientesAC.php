<?php
/*
	Plugin Name: Convocatorias
	Description: Muestra un listado de las convocatorias realizadas por email
	Author: Jefferson Steven Casta�eda Guerrero
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
  // Extraemos el directorio en el que estamos para ir us�ndolo luego
	$pluginDir = pathinfo( __FILE__ );
	$pluginDir = $pluginDir['dirname'];
	
	
	//////// DECLARACION DEL MENU ////////////
	
	// titulo de la nueva secci�n:
	$page_title = "Convocatorias";

	// titulo en el men�
	$menu_title = "Convocatorias";

	// nivel necesario para poder ver el men� (admin:10, editores:8)
	// + info en: http://codex.wordpress.org/User_Levels
	$access_level = "8";

	// la p�gina que se cargar� al clickar en el men�
	$content_file = $pluginDir . '/panel.php';	

	// Funci�n para cargar dentro de la p�gina incluida para generar el men�
	// Si no se indica, se asume que al incluir el fichero ya se ha generado todo el
	// contenido necesario.
	$content_function = null;

	// url del icono para el men�
	$menu_icon_url = null;

	add_menu_page($page_title, $menu_title, $access_level, $content_file, $content_function, $menu_icon_url);
	
  // Declaramos tambi�n como primer submen� la misma p�gina con los mismos datos
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