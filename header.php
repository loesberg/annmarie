<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php 
		if (is_front_page()) {
			echo "Welcome to Ann Marie Therapy";
		} else {
			wp_title( " | ", true, 'right' ); 
		}
		?>
</title>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>?ver=<?php echo time(); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
<div id="main-box" <?php amd_set_background_image(get_the_ID()); ?>>
<header id="header" role="banner">
<section id="branding">
<?php if (is_front_page()) : ?>
<div id="contact-info">
	<a href="mailto:amd@annmarietherapy.com">amd@annmarietherapy.com</a><br />
	415.409.9023	
</div>
<?php endif; ?>
<img id="logo" src="<?php echo get_template_directory_uri() . "/images/logo.png"; ?>" alt="Ann Marie Therapy" width="505" height="69" />
</section>
<nav id="nav" role="navigation">
<?php wp_nav_menu( array( 'theme_location' => 'custom', 'menu_class' => 'nav-menu' ) ); ?>
</nav>
<div id="nav-arrow">&#9660;</div>
 <?php 	// $image_url = wp_get_attachment_image_src( get_post_thumbnail(get_the_ID()), "Full"); ?>

</header>
