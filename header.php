<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package panch
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<nav class="main-nav">
		<div class="nav-wrapper">
			<div class="grid-container">
				<div class="grid-x">
					<div class="cell medium-8 small-6 left-menu">
						<ul class="menu menu-social">
							<li class="hamburger-li">
								<div class="hamburger">
									<span></span>
									<span></span>
									<span></span>
								</div>
							</li>
							<li class="social">
								<a href="https://twitter.com/drpanch" title="twitter" target="_blank"><span class="twitter">
									<i class="fab fa-twitter"></i>
								</span></a>
							</li>
							<li class="social">
								<a href="https://www.linkedin.com/in/sethuraman-panchanathan-1292531" title="linkedin" target="_blank"><span class="linkedin">
									<i class="fab fa-linkedin-in"></i>
								</span></a>
							</li>
						</ul>
						<?php
							wp_nav_menu( array(
								'container'		 => 'ul',
								'menu_class'     => 'menu menu-nav',
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							) );
						?>
					</div>
					<div class="cell medium-4 small-6 right-menu">
						<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					</div>
				</div>

			</div>
		</div>
		<div class="mobile-menu">
			<?php
				wp_nav_menu( array(
					'container'		 => 'ul',
					'menu_class'     => 'menu menu-nav',
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
			?>
			<div class="close"></div>
		</div>
	</nav>
	<main>
