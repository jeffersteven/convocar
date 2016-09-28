<?php
/*------------------------------------------------
*  QuickLogin Add Box
*-----------------------------------------------*/
function fql_add_box() {
	$options = get_option('fquicklogin'); ?>

	<!-- Start QuickLogin Box -->
	<div id="fql-box">
		<a href="#" class="fql-close" rel="fql-close"><?php _e('Close Box', 'ft-quicklogin'); ?></a>
		<?php if( $options[box_logo] !== "" && $options[box_logo] !== "http://" ) : ?>
		<img class="fql-logo" src="<?php echo $options[box_logo]; ?>" alt="<?php bloginfo('name'); ?>" />
		<?php endif; ?>

		<?php fql_box_login(); ?>

		<?php if ( get_option( 'users_can_register' ) )
			fql_box_register(); ?>

		<?php fql_box_lostpassword(); ?>

		<?php fql_box_message(); ?>
	</div>
	<!-- End QuickLogin Box -->
<?php }


/*------------------------------------------------
*  QuickLogin Login Box
*-----------------------------------------------*/
function fql_box_login() { ?>
	<div id="fql-box-login">
		<?php if ( is_user_logged_in() ) : ?>
			<p class="message"><?php _e('Usted ya está conectado!', 'ft-quicklogin'); ?></p>
		<?php else : ?>

		<form name="loginform" action="<?php echo site_url('/wp-login.php'); ?>" method="post">
			<input type="text" name="log" value="<?php _e('Usuario', 'ft-quicklogin'); ?>" size="20" tabindex="1000" />

			<input type="password" name="pwd" value="<?php _e('Contraseña', 'ft-quicklogin'); ?>" size="20" tabindex="1001" />

			<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" value="forever" tabindex="1002" /> <?php _e('Recordarme', 'ft-quicklogin'); ?></label></p>

			<p class="submit">
				<input type="submit" name="wp-submit" value="<?php _e('Entrar', 'ft-quicklogin'); ?>" tabindex="1003" />
				<input type="hidden" name="redirect_to" value="<?php echo fql_get_current_url() . '/afiliados/#fql-box-message-login'; ?>" />
				<input type="hidden" name="testcookie" value="1" />
			</p>

			<div class="clear"></div>
		</form>
		<?php endif; ?>

		<div class="fql-box-links">
			<?php if ( get_option( 'users_can_register' ) ) : ?><a rel="fql-box-register" href="<?php echo site_url('/wp-login.php?action=register'); ?>"><?php _e('Registro', 'ft-quicklogin'); ?></a> | <?php endif; ?><a rel="fql-box-lost-password" href="<?php echo site_url('/wp-login.php?action=lostpassword'); ?>"><?php _e('¿Contraseña perdida?', 'ft-quicklogin'); ?></a>
		</div>
	</div>
<?php }


/*------------------------------------------------
*  QuickLogin Register Box
*-----------------------------------------------*/
function fql_box_register() { ?>
	<div id="fql-box-register">
		<div style="text-align:center; width:80%; margin:0 auto;">
		<div class="log">
			<img src="/wp-content/uploads/2014/09/Activacion-convocar.png" />
		</div>
			<p class="submit">
				<a rel="fql-box-register" href="<?php echo site_url('/registrarse-como-propiedad-horizontal/'); ?>"><?php _e('Registrarse como Propiedad Horizontal', 'ft-quicklogin'); ?></a><br><br>
				<a rel="fql-box-register" href="<?php echo site_url('/registrarse-como-profesional/'); ?>"><?php _e('Registrarse como Profesional', 'ft-quicklogin'); ?></a>
			</p>

			<div class="clear"></div>
		</div>

		<div class="fql-box-links">
			<a rel="fql-box-login" href="<?php echo site_url('/wp-login.php'); ?>"><?php _e('Entrar', 'ft-quicklogin'); ?></a> | <a rel="fql-box-lost-password" href="<?php echo site_url('/wp-login.php?action=lostpassword'); ?>"><?php _e('¿Contraseña perdida?', 'ft-quicklogin'); ?></a>
		</div>
	</div>
<?php }


/*------------------------------------------------
*  QuickLogin Lost Password Box
*-----------------------------------------------*/
function fql_box_lostpassword() { ?>
	<div id="fql-box-lost-password">
		<form name="lostpasswordform" action="<?php echo site_url('/wp-login.php?action=lostpassword'); ?>" method="post">
			<p class="lost_passmail"><?php _e('Ingresa tu Usuario o Email.', 'ft-quicklogin'); ?><br /><?php _e('Recibiras un link para renovar tu contraseña via email.', 'ft-quicklogin'); ?></p>

			<input type="text" name="user_login" value="<?php _e('Usuario o Email', 'ft-quicklogin'); ?>" size="20" tabindex="1020" />

			<p class="submit">
				<input type="submit" name="wp-submit" value="<?php _e('Enviar Link', 'ft-quicklogin'); ?>" tabindex="1021" />
				<input type="hidden" name="redirect_to" value="<?php echo fql_get_current_url() . '#fql-box-message-lostpassword'; ?>" />
			</p>

			<div class="clear"></div>
		</form>

		<div class="fql-box-links">
			<a rel="fql-box-login" href="<?php echo site_url('/wp-login.php'); ?>">Entrar</a><?php if ( get_option( 'users_can_register' ) ) : ?> | <a rel="fql-box-register" href="<?php echo site_url('/registrarse-como-propiedad-horizontal/'); ?>"><?php _e('Registro'); ?></a><?php endif; ?>
		</div>
	</div>
<?php }


/*------------------------------------------------
*  QuickLogin Message Box
*-----------------------------------------------*/
function fql_box_message() { ?>
	<div id="fql-box-message">
		<p class="message" style="display:none;"></p>
		<div style="width:100%; text-align:center;">
		<img src="/wp-content/uploads/2014/09/BIENVENIDO-convocar.png" />
		</div>
		<div class="fql-box-links">
			<a rel="fql-box-login" href="<?php echo site_url('/wp-login.php'); ?>"><?php _e('Entrar', 'ft-quicklogin'); ?></a><?php if ( get_option( 'users_can_register' ) ) : ?> | <a rel="fql-box-register" href="<?php echo site_url('/wp-login.php?action=register'); ?>"><?php _e('Registro', 'ft-quicklogin'); ?></a><?php endif; ?> | <a rel="fql-box-lost-password" href="<?php echo site_url('/wp-login.php?action=lostpassword'); ?>"><?php _e('¿Contraseña perdida?', 'ft-quicklogin'); ?></a>
		</div>
	</div>
<?php } ?>