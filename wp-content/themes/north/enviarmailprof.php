<?php
//cargamos todos los elementos de Wordpress necesarios para que funcione
include_once('../../../wp-load.php');
 
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$empresa = 'convocar.net';
$cargo =$_POST['carg'];
$descripcion=$_POST['mensaje'];
$direccion=$_POST['direccion'];
$zona=$_POST['zona'];
$tel=$_POST['telefonos'];
//supongamos que en la variable submit tenemos todos los datos de un formulario

$header = "From: Convocar.net <convocatorias@convocar.net> \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/html";


$usuarios = get_users('orderby=nicename&role=profesional');
$envios='';

        //Asunto del email
	$subject='Convocatoria profesionales (Convocar.net)';
 

 
 
     //El mensaje a enviar. Se puede incluir HTML si enviamos el email en modo HTML y no texto.
		
		$mensaje .= "<a href='convocar.net'><img style='max-width:100;' src='http://convocar.net/wp-content/themes/increase/img/emailbannerpf.png'></a><br><br>";
		$mensaje .= "Enviado el " . date('d/m/Y', time()) . " <br><br>\r\n \r\n";
		$mensaje .= "Este correo a sido enviado a trav&eacute;s de la plataforma " . $empresa . " <br><br>\r\n \r\n";
		
		
		$mensaje .="DATOS DEL SOLICITANTE DE LA CONVOCATORIA:<br> \r\n ";
		$mensaje .="RAZON SOCIAL : ". $nombre ."<br>\r\n ";
		$mensaje .="DIRECCION : ".$direccion."<br>\r\n ";
		$mensaje .="ZONA DE UBICACION : ".$zona."<br>\r\n ";
		$mensaje .="TELEFONO : ".$tel."<br>\r\n ";
		$mensaje .="CORREO : ". $email."<br><br><br>\r\n \r\n";
		
		$mensaje .='<p style="color:#501572; font-size:16px;">CONVOCATORIA EN EL CARGO : '.$cargo."<br>\r\n ";
		$mensaje .="DESCRIPCION DE LA CONVOCATORIA :<br> \r\n ".$descripcion. "<br><br></p>\r\n ";
		
		$mensaje .="Cordialmente,<br>
						Soporte CONVOCAR.NET<br>
						soporte@convocar.net<br>
						http://convocar.net/<br>

						<a href='convocar.net'><img src='http://convocar.net/wp-content/themes/increase/img/firma1.png'></a><br><br>

						Este correo ha sido enviado desde una cuenta autom&aacute;tica, por favor no conteste.<br>";
		
		
		
		$mensaje2  = '<p style="font-weight:bold; font-size:20px;">Mensaje de confirmaci&oacute;n de envio de la convocatoria a Profesionales </p><br><br>';
		$mensaje2 .= $mensaje;
		
	
 
	//Cambiamos el nombre del remitente del email que en Wordpress por defecto es "Wordpress"
    $cargo=str_replace(' ', '',$cargo);
	foreach ( $usuarios as $usuario ){
					if($cargo=='filtro'){
						$envios .= $usuario->user_email .', ';
					}else{
							if((strpos(str_replace(' ', '',cimy_uef_sanitize_content(get_cimyFieldValue($usuario->ID, 'CARGO'))),$cargo)!==false)){
								if( !(strpos($usuario->user_email,'@nohay.com') !== false)){
									if((get_cimyFieldValue($usuario->ID, 'DESEOMAIL'))=='YES'){
										$envios .= $usuario->user_email .', ';
										$mensaje3 = "Clic <a href='".get_home_url() .'/?per='.$usuario->user_login.'&key='.get_cimyFieldValue($usuario->ID, 'KEYREG').'&mail=r3turNf4l33'."'> aqu&iacute;</a> para no recibir m&aacute;s correos de convocar.net". "\r\n";
										
										wp_mail( $usuario->user_email, $subject, $mensaje.$mensaje3 , $header);
									}
								}
							}
					}		
				}
       
	//mail( $envios, $subject, utf8_decode($mensaje), $header);
	wp_mail( $email, $subject, $mensaje2, $header);
	  //Por último enviamos el email
	convohecha( '1000', $email,$nombre, $cargo, $descripcion, date('d/m/Y', time()));
 
header('Location: http://convocar.net/profesionales-via-e-mail/?mail=enviado');

?>