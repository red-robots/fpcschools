<?php
/* 
 * Template Name: Testimonials
*/

$school_type = get_school_type_uri('key');
$current_term = get_school_type_uri();
$school_parent_id = get_post_id_by_slug($segment);
$is_sub_site_ii = get_school_type_uri();
global $post, $wp_query;
$post_id = (isset($post->ID)) ? $post->ID : 0;
$page_title = get_the_title($post_id);

if($school_type) {
    get_template_part( 'header_subsite');
    //get_template_part( 'inc/banner_subsite');
    
    $args = array(
        'post_type'         => array('testimonial'),
        'posts_per_page'    => -1,
        'orderby'			=> 'date',
        'order'				=> 'ASC',
        'post_status'       => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'schools', // your custom taxonomy
                'field' => 'slug',
                'terms' => array( $current_term ) // the terms (categories) you created
            )
        )
    );
    $testimonials = new WP_Query($args);

?>

<div id="primary" class="content-area full clear">
    <main id="main" class="site-main wrapper testimonial" role="main">
        <?php while ( have_posts() ) : the_post(); ?>
            <header class="section-title-wrap">
                <h1 class="page-title"><?php the_title();?></h1>
            </header>
            <div class="entry">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
        
        <?php if ( $testimonials->have_posts() ) { ?>
        <div class="testimonial-list grid">
            <?php $i=1; while ( $testimonials->have_posts() ) : $testimonials->the_post();  
            $seconds = $i;
            $postId = get_the_ID();
            $post_thumbnail_id = get_post_thumbnail_id( $postId );
            $img = wp_get_attachment_image_src($post_thumbnail_id,'large');
            ?>
            <div class="grid-sizer"></div>
            <div class="grid-item"></div>
            <div class="testimonial-post wow fadeIn grid-item grid-item--width2">
                <div class="inner clear">
                    <div class="pad clear">
                        <?php if($img) { ?>
                        <div class="photo clear"><img src="<?php echo $img[0];?>" alt="" /></div>
                        <?php } ?>
                        <h4 class="name clear"><?php the_title();?></h4>
                        <div class="copy clear"><?php the_content();?></div>
                    </div>
                </div>
            </div>
            <?php $i++; endwhile; wp_reset_postdata(); ?>
        </div>
        <?php } ?>
    </main>
</div>

<?php } ?>

<?php
get_footer();
