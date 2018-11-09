<?php
/**
 * Template Name: Contact Us
 */
get_header();  
global $post;
$post_id = (isset($post->ID)) ? $post->ID : 0;
?>
<div id="primary" class="content-area full clear">
    <main id="main" class="site-main wrapper" role="main">
        <?php
        while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content', 'page' );
        endwhile; // End of the loop.
        
        if( $form = get_field('contact_form_shortcode',$post_id) ) { 
            if( $contact_form = do_shortcode($form) ) {  ?>
            <div class="contact-form-wrapper">
                <?php echo $contact_form; ?>
            </div>
            <?php } ?>
        <?php } ?>
    </main>
</div>

<?php
get_footer();
