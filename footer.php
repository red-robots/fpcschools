<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fpcschools
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper">
			<?php wp_nav_menu( array( 'menu' => 'Footer Menu', 'menu_id' => 'footer-menu' ) ); ?> 
	   </div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<a href="#" class="scrollup"><span><i class="fa fa-chevron-up"></i></span></a></a>
<?php wp_footer(); ?>

</body>
</html>
