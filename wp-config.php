<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'convocar_db');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'convocar_user');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '854hfeQr4gev');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+/jtHhEGM9,6v.YbqQ7=6?c98(zMK|S-Q~gcg&{~G%~{g5+*L&)&1_:SAt2^SY C');
define('SECURE_AUTH_KEY',  ';Y^.N+$u6(zN|w9kr_$_gcQNvv&GRg$rX+$D(p6,6]> p3(-yZ./69P9T+P8h[y<');
define('LOGGED_IN_KEY',    '-#j&SsoFJfeb>dd53Q*J@)T;3:qG5z#_tS#UBwer|Q4|m$E6B|H(]]kJ2_.p_Sl ');
define('NONCE_KEY',        'QT_k;`*zg^_%6=Y3mS;OPp;Er0xC+.gjMw,6GL8[>/4+&:W`4[DE2-@<f_jO#`x+');
define('AUTH_SALT',        'd>B}_bDekj@x&Y?lxOT}D,?-?Rv$u-UiP-XR:Ky3^t5%`2MC$AMQ`(|1.zUx2?3<');
define('SECURE_AUTH_SALT', 'VmMI*p:P}-:!AGKcc0EUMx`I+/ p(cW!zVIuFwkbvc1~&-|?Z,3%+:|Fp>N;+vA}');
define('LOGGED_IN_SALT',   '5JcrOdY/z.>rjrmE^a!-pp*f*X{~/;dnx4#^-+A#,H1[*pU)`+TG}MGERSmMI|iA');
define('NONCE_SALT',       'Vml:#m#^5f(Uo&eSc.TCcJ8-(#3sUF3o30IO`z|MuL+lNis=M/^5_0szu]}e x4B');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como 'ca_ES'
 * para traducir WordPress al catalán.
 */
define('WPLANG', 'es_ES');

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

