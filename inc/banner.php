<?php
$args = array(
    'posts_per_page'   => 5,
    'orderby'          => 'menu_order',
    'order'            => 'ASC',
    'post_type'        => 'slide',
    'post_status'      => 'publish'
    );
$slideTotal = count( get_posts($args) );
$slides = new WP_Query($args);
?>

<?php if ( $slides->have_posts() ) { ?>
<div class="slides-wrapper full clear animated fadeIn <?php echo ($slideTotal>1) ? 'flexslider':'no-slideshow';?>">
    <ul class="slides">
    <?php while ( $slides->have_posts() ) : $slides->the_post();  
        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
        $img = wp_get_attachment_image_src($post_thumbnail_id,'large');
        $img_src = ($img) ? $img[0] : '';
        $content = get_the_content();
        if($img_src) { ?>
        <li class="slide">
            <?php if($content) { ?>
            <div class="caption">
                <div class="inner-wrap clear">
                    <div class="mid"><?php the_content(); ?></div>
                </div>
            </div>
            <?php } ?>
            <img src="<?php echo $img_src;?>" alt="<?php echo get_the_title();?>" />
        </li>
        <?php } ?>
    <?php endwhile; wp_reset_postdata(); ?>
    </ul>
</div>
<?php } ?>