<?php
/**
 * Template Name: Contact Us
 */
get_header();  
global $post;
$post_id = (isset($post->ID)) ? $post->ID : 0;
$banner = get_field('banner_image',$post_id); 
$img_src = ($banner) ? $banner['url'] : '';
if($img_src) { 
    if($img_src) { ?>
    <div class="slides-wrapper full clear animated fadeIn">
        <ul class="slides">
            <li class="slide">
                <img src="<?php echo $img_src;?>" alt="<?php echo $banner['title'];?>" />
            </li>
        </ul>
    </div>
    <?php } ?>
<?php } ?>

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
