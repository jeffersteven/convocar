<?php
switch($role)
{
	case "administrator":
		$user_role_permission = "manage_options";
		break;
	case "editor":
		$user_role_permission = "publish_pages";
		break;
	case "author":
		$user_role_permission = "publish_posts";
		break;
}

if (!current_user_can($user_role_permission))
{
	return;
}
else
{
	class save_data
	{
		function insert_data($email_setup)
		{
			global $wpdb;
			$wpdb->insert(wp_mail_bank(), $email_setup);
			die();
		}
		function update_email_data($update_email_data,$where)
		{
			global $wpdb;
			$wpdb->update(wp_mail_bank(),$update_email_data, $where);
			die();
		}
	}
	if(isset($_REQUEST["param"]))
		{
			global $wpdb;
			if($_REQUEST["param"] == "add_mail_detail")
			{
				$insert = new save_data();
				$email_setup = array();
				$email_setup["from_name"] = esc_attr($_REQUEST["ux_email_from_name"]);
				$email_setup["from_email"] = esc_attr($_REQUEST["ux_email_from_email"]);
				$email_setup["mailer_type"] = intval($_REQUEST["ux_rdl_ends"]);
				$email_setup["return_path"] = isset($_REQUEST["ux_chk_return_path"]) ? intval($_REQUEST["ux_chk_return_path"]) : 0;
				$email_setup["return_email"] = esc_attr($_REQUEST["ux_return_email"]);
				$email_setup["word_wrap"] = intval($_REQUEST["ux_word_wrap"]);
				$email_setup["smtp_host"] = esc_attr($_REQUEST["ux_smtp_host"]);
				$email_setup["smtp_port"] = esc_attr($_REQUEST["ux_smtp_port"]);
				$email_setup["encryption"] = intval($_REQUEST["ux_rdl_encrption"]);
				$email_setup["smtp_keep_alive"] = intval($_REQUEST["ux_rdl_smtp_alive"]);
				$email_setup["authentication"] = intval($_REQUEST["ux_rdl_authentication_bank"]);
				$email_setup["smtp_username"] = esc_attr($_REQUEST["ux_txt_username"]);
				$email_setup["smtp_password"] = htmlspecialchars_decode(esc_attr($_REQUEST["password"]));
				
				$count_direction = $wpdb->get_var
				(
					"SELECT count(id) FROM " .wp_mail_bank()
				);
				if($count_direction == 0)
				{
					$insert->insert_data($email_setup);
				}
				else 
				{
					$where = array();
					$where["id"] = 1;
					$insert->update_email_data($email_setup,$where);
				}
				die();
				
			}
			elseif($_REQUEST["param"] == "send_mail")
			{
				global $phpmailer;
				$logs = array();
				if ( !is_object( $phpmailer ) || !is_a( $phpmailer, 'PHPMailer' ) ) {
					require_once ABSPATH . WPINC . '/class-phpmailer.php';
					require_once ABSPATH . WPINC . '/class-smtp.php';
					$phpmailer = new PHPMailer( true );
				}
			
				$phpmailer->SMTPDebug = true;
				ob_start();
				
				$to = esc_attr($_REQUEST["ux_email_to"]);
				$subject=esc_attr($_REQUEST["ux_email_subject"]);
				$message=stripslashes(($_REQUEST["message"]));
				$result = wp_mail($to, $subject, $message);
				if($phpmailer->Mailer == "smtp")
				{
					echo $smtp_debug = ob_get_clean();
				}
				else
				{
					echo $result;
				}
				die();
			}
		}
	}
?>