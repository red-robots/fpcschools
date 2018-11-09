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
$school_type = get_school_type_uri('key');
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer clear" role="contentinfo">
		<div class="wrapper clear">
            <?php if($school_type=='wds') { ?>
                <?php if ( is_active_sidebar( 'footer-wds' ) ) { ?>
                <div class="footwidget">
                    <?php dynamic_sidebar( 'footer-wds' ); ?>
                </div>    
                <?php } ?>
            <?php } ?>
            <?php if($school_type=='cdc') { ?>
                <?php if ( is_active_sidebar( 'footer-cdc' ) ) { ?>
                <div class="footwidget">
                    <?php dynamic_sidebar( 'footer-cdc' ); ?>
                </div>    
                <?php } ?>
            <?php } ?>
	   </div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<a href="#" class="scrollup"><span><i class="fa fa-chevron-up"></i></span></a></a>
<?php wp_footer(); ?>

</body>
</html>
