<?php
$school_type = get_school_type_uri('key');
$segment = get_school_type_uri();
$school_parent_id = get_post_id_by_slug($segment);
$is_sub_site_ii = get_school_type_uri();
global $post, $wp_query;
$post_id = (isset($post->ID)) ? $post->ID : 0;
$is_sub_site = false;
if( $postInfo = get_post($post_id) ) {
    $parent_id = $postInfo->post_parent;
    if($parent_id>0) {
        $parent_post = get_post($parent_id);
        if($parent_post) {
            if( $parent_school = get_field('school_logo',$parent_id) ) {
                $is_sub_site = true;
            }
        }
    }
}
if($school_type) {
    get_template_part( 'header_subsite');
} else {
    get_header();   
} 

if($school_type) {
get_template_part('inc/banner_subsite'); 
get_template_part('page-interior'); ?>
<?php } else { ?>

    <div id="primary" class="content-area full clear">
        <main id="main" class="site-main wrapper" role="main">
            <?php
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/content', 'page' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </main>
    </div>
<?php } ?>
<?php
get_footer();
