<?php
global $post;
$post_id = (isset($post->ID)) ? $post->ID : 0;
$school_type = get_school_type_uri('key');
$segment = get_school_type_uri();
$school_parent_id = get_post_id_by_slug($segment);
if($school_type) { 
    $banner = get_field('banner_image',$post_id); 
    $img_src = ($banner) ? $banner['url'] : '';
    if($img_src) { ?>
    <div class="slides-wrapper full clear">
        <ul class="slides">
            <li class="slide">
                <img src="<?php echo $img_src;?>" alt="<?php echo $banner['title'];?>" />
            </li>
        </ul>
    </div>
    <?php } ?>
<?php } ?>