<?php
/**
 * Template Name: Child Development Center
 */
get_template_part( 'header_subsite');
global $post;
$post_id = $post->ID;
$bannerImg = get_field('school_banner_image',$post_id);
$bannerCaption = get_field('school_banner_caption',$post_id);
?>
<?php if($bannerImg) { ?>
<div class="slides-wrapper full clear">
    <ul class="slides">
        <li class="slide">
            <?php if($bannerCaption) { ?>
            <div class="caption">
                <div class="inner-wrap clear">
                    <div class="mid"><?php echo $bannerCaption; ?></div>
                </div>
            </div>
            <?php } ?>
            <img src="<?php echo $bannerImg['url'];?>" alt="<?php echo $bannerImg['title'];?>" />
        </li>
    </ul>
</div>
<?php } ?>


<?php
/* CONTENT 1 */
$content1_title = get_field('introduction_title',$post_id);
$content1_text = get_field('introduction_text',$post_id);
$content1_image = get_field('introduction_image',$post_id);
?>

<section class="section section1 clear wow fadeIn" data-wow-duration="1s">
    <div class="wrapper clear">
        
        <div class="text-column entry-content ss_textcolumn <?php echo ($content1_image) ? 'half':'full clear';?>">
            <?php if($content1_title) { ?>
            <div class="titlewrap ss_titlediv clear"><h2 class="section-title"><?php echo $content1_title;?></h2></div>
            <?php } ?>
            
            <?php if($content1_text) { ?>
            <div class="textwrap clear">
                <?php echo $content1_text;?>
            </div>
            <?php } ?>
        </div>
        
        <?php if($content1_image) { ?>
        <div class="image-column ss_image_column">
            <img src="<?php echo $content1_image['url'];?>" alt="<?php echo $content1_image['title'];?>" />
        </div>
        <?php } ?>
    </div>
</section>

<?php
/* CONTENT 2 */
$content2_title = get_field('section_box_title',$post_id);
$boxes = 4;
$boxes_data = array();
for($i=1; $i<=$boxes; $i++) {
    $box_title = get_field('box_'.$i.'_text');
    $box_link = get_field('box_'.$i.'_link');
    $box_image = get_field('box_'.$i.'_image');
    $boxes_data[] = array(
                    'title'=>$box_title,
                    'image'=>$box_image,
                    'link'=>$box_link
                );
} 
?>

<?php if($boxes_data) { ?>
<section class="section section2 clear pattern-blue wow fadeIn" data-wow-duration="1s">
    <div class="wrapper clear">
        <?php if($content2_title) { ?>
        <div class="titlewrap ss_titlediv clear"><h2 class="section-title"><?php echo $content2_title;?></h2></div>
        <?php } ?>
        <div class="textwrap clear full">
            <div class="row clear">
                <?php $j=1; foreach($boxes_data as $b) { 
                    $img_src = ($b) ? $b['image']['url'] : '';
                    $img_alt = ($b) ? $b['image']['title'] : '';
                    $bx_title = $b['title'];
                    $bx_link = $b['link'];
                    $link_after = '';
                    $link_before = '';
                    if($bx_link) {
                        $link_before = '<a href="'.$bx_link.'" class="clear">';
                        $link_after = '</a>';
                    }
                ?>
                <div id="sbox_<?php echo $j;?>" class="sbox">
                    <div class="pad clear">
                        <div class="sbox_image clear">
                            <?php if($img_src) { ?>
                            <?php echo $link_before;?><img src="<?php echo $img_src;?>" alt="<?php echo $img_alt;?>" /><?php echo $link_after;?>
                            <?php } else { ?>
                            <span class="no-image"><i class="dashicons dashicons-format-image"></i></span>
                            <?php } ?>
                        </div>
                        <div class="sbox_title clear">
                            <?php if($bx_title) { ?>
                            <div class="title"><?php echo $link_before;?><?php echo $bx_title;?><?php echo $link_after;?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php $j++; } ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php
get_footer();
