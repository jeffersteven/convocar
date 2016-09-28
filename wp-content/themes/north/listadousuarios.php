<?php
/*
Template Name: Listado Usuarios
*/

// Get all users order by amount of posts
$allUsers = get_users('orderby=post_count&order=DESC');

$users = array();

// Remove subscribers from the list as they won't write any articles
foreach($allUsers as $currentUser)
{
	if(!in_array( 'subscriber', $currentUser->roles ))
	{
		$users[] = $currentUser;
	}
}

?>

<?php get_header(); ?>

<section class="content" role="main">
	<?php
		printf('<h1>%s</h1>', the_title());

		foreach($users as $user)
		{
			?>
			<div class="author">
				<div class="authorAvatar">
					<?php echo get_avatar( $user->user_email, '128' ); ?>
				</div>
				<div class="authorInfo">
					<h2 class="authorName"><?php echo $user->display_name; ?></h2>
					<p class="authorDescrption"><?php echo get_user_meta($user->ID, 'description', true); ?></p>
					<p class="authorLinks"><a href="<?php echo get_author_posts_url( $user->ID ); ?>">View Author Links</a></p>

					<p class="socialIcons">
						<ul>
							<?php
								$website = $user->user_url;
								if($user->user_url != '')
								{
									printf('<li><a href="%s">%s</a></li>', $user->user_url, 'Website');
								}

								$twitter = get_user_meta($user->ID, 'twitter_profile', true);
								if($twitter != '')
								{
									printf('<li><a href="%s">%s</a></li>', $twitter, 'Twitter');
								}

								$facebook = get_user_meta($user->ID, 'facebook_profile', true);
								if($facebook != '')
								{
									printf('<li><a href="%s">%s</a></li>', $facebook, 'Facebook');
								}

								$google = get_user_meta($user->ID, 'google_profile', true);
								if($google != '')
								{
									printf('<li><a href="%s">%s</a></li>', $google, 'Google');
								}

								$linkedin = get_user_meta($user->ID, 'linkedin_profile', true);
								if($linkedin != '')
								{
									printf('<li><a href="%s">%s</a></li>', $linkedin, 'LinkedIn');
								}
							?>
						</ul>
					</p>
				</div>
			</div>
			<?php
		}
	?>
</section>

<?php get_footer(); ?>