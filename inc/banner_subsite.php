<?php
global $post;
$post_id = (isset($post->ID)) ? $post->ID : 0;
$banner = get_field('banner_image',$post_id); 
if($banner) { 
    $img_src = ($banner) ? $banner['url'] : '';
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