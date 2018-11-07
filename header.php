<?php
/**
 * The header for theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fpcschools
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php 
get_template_part('inc/header_meta');
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logoImg = wp_get_attachment_image_src($custom_logo_id,'large');
$logo_name = get_field('logo_name','option');
$is_home = ( is_home() || is_front_page() ) ? true:false;
$is_home_class = ($is_home) ? 'home':'subpage';
wp_head(); 
?>
</head>

<body <?php body_class($is_home_class); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fpcschools' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="wrapper clear">
			
			<?php if( $logoImg ) { ?>
	            <div class="logo">
	            	<a href="<?php bloginfo('url'); ?>">
		            	<img src="<?php echo $logoImg[0]; ?>" alt="<?php bloginfo('name'); ?>">
		            </a>
	            </div>
	        <?php } else { ?>
	            <h1 class="logo">
		            <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
	            </h1>
	        <?php } ?>
            
            <span class="burger" id="mobile-menu"><span></span></span>
            <nav id="site-navigation" class="main-navigation" role="navigation">
				<div class="navwrap clear"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?></div>
			</nav><!-- #site-navigation -->
	</div><!-- wrapper -->
	</header><!-- #masthead -->
    
    <?php if($is_home) { 
        get_template_part('inc/banner');
    } ?>

	<div id="content" class="site-content clear">
