<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="login profile" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'profile' ); ?>
	<?php $template->the_errors(); ?>
	<form id="your-profile" action="<?php $template->the_action_url( 'profile' ); ?>" method="post">
		<?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>
		<p>
			<input type="hidden" name="from" value="profile" />
			<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />
		</p>

		<?php if ( has_action( 'personal_options' ) ) : ?>

		<h3><?php _e( 'Personal Options' ); ?></h3>

		<table class="form-table">
		<?php do_action( 'personal_options', $profileuser ); ?>
		</table>

		<?php endif; ?>

		<?php do_action( 'profile_personal_options', $profileuser ); ?>

		<h3><?php _e( 'Name' ); ?></h3>

		<table class="form-table">

		<tr class="tml-user-login-wrap">
			<th><label for="user_login"><?php _e( 'Nombre usuario', 'theme-my-login' ); ?></label></th>
			<td><input type="text" name="user_login" id="user_login" value="<?php echo esc_attr( $profileuser->user_login ); ?>" disabled="disabled" class="regular-text" /> <span class="description"><?php _e( 'Usernames cannot be changed.', 'theme-my-login' ); ?></span></td>
		</tr>
		<tr>		
			<th><label for="first_name">Nombres/Apellidos</label></th>
			<td><input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( $profileuser->first_name ); ?>" class="regular-text" /></td>
		</tr>
		<tr class="PRIORIDAD">		
			<th><label for="last_name">Prioridad</label></th>
			<td><input type="text" name="last_name" disabled="disabled" id="last_name" value="<?php echo esc_attr( $profileuser->last_name ); ?>" class="regular-text" /></td>
		</tr>

		</table>

		<h3><?php _e( 'Contact Info' ); ?></h3>

		<table class="tml-form-table">
		<tr class="tml-user-email-wrap">
			<th><label for="email"><?php _e( 'E-mail', 'theme-my-login' ); ?> <span class="description"><?php _e( '(required)', 'theme-my-login' ); ?></span></label></th>
			<td><input type="text" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ); ?>" class="regular-text" /></td>
			<?php
			$new_email = get_option( $current_user->ID . '_new_email' );
			if ( $new_email && $new_email['newemail'] != $current_user->user_email ) : ?>
			<div class="updated inline">
			<p><?php
				printf(
					__( 'There is a pending change of your e-mail to %1$s. <a href="%2$s">Cancel</a>', 'theme-my-login' ),
					'<code>' . $new_email['newemail'] . '</code>',
					esc_url( self_admin_url( 'profile.php?dismiss=' . $current_user->ID . '_new_email' ) )
			); ?></p>
			</div>
			<?php endif; ?>
		</tr>

		</table>

		

		<?php do_action( 'show_user_profile', $profileuser ); ?>

		<p class="submit">
			<input type="hidden" name="action" value="profile" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
			<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Update Profile' ); ?>" name="submit" />
		</p>
	</form>
</div>
