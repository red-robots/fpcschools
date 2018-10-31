<?php
$args = array(
    'posts_per_page'   => 5,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post_type'        => 'slide',
    'post_status'      => 'publish'
    );
$slides = new WP_Query($args);
?>

<?php if ( $slides->have_posts() ) { ?>
<div class="slides-wrapper full clear">
    <?php while ( $slides->have_posts() ) : $slides->the_post();  
        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
        $img = wp_get_attachment_image_src($post_thumbnail_id,'large');
        $img_src = ($img) ? $img[0] : '';
        if($img_src) { ?>
        <div class="slide">
            <img src="<?php echo $img_src;?>" alt="<?php echo get_the_title();?>" />
        </div>
        <?php } ?>
    <?php endwhile; wp_reset_postdata(); ?>
</div>
<?php } ?>