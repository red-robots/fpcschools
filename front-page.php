<?php
/**
 * The template for home page.
 *
 */
get_header();
global $post;
$post_id = $post->ID;
?>

<div id="primary" class="content-area full clear">
        
    <?php
    /* CONTENT 1 */
    $content1_title = get_field('section_1_title',$post_id);
    $content1_text = get_field('section_1_',$post_id);
    $content1_image = get_field('section_1_image',$post_id);
    ?>
    <section class="section section1 clear wow fadeIn" data-wow-duration="1s">
        <div class="wrapper clear">
            <?php if($content1_title) { ?>
            <div class="titlewrap"><h2 class="section-title"><?php echo $content1_title;?></h2></div>
            <?php } ?>

            <?php if($content1_text) { ?>
            <div class="text-column entry-content <?php echo ($content1_image) ? 'half':'full clear';?>">
                <?php echo $content1_text;?>
            </div>
            <?php } ?>

            <?php if($content1_image) { ?>
            <div class="image-column">
                <img src="<?php echo $content1_image['url'];?>" alt="<?php echo $content1_image['title'];?>" />
            </div>
            <?php } ?>
        </div>    
    </section>    

    <?php
    /* CONTENT 2 */
    $content2_title = get_field('section_2_title',$post_id);
    $content2_text = get_field('section_2',$post_id);
    $content2_highlight_text = get_field('section_2_highlight',$post_id);
    $content2_gallery = get_field('section_2_gallery',$post_id);
    ?>

    <section class="section section2 clear wow fadeIn" data-wow-duration="1s">
        <div class="wrapper clear">
            <?php if($content2_title) { ?>
            <div class="titlewrap"><h2 class="section-title"><?php echo $content2_title;?></h2></div>
            <?php } ?>

            <?php if($content2_text) { ?>
            <div class="text-column entry-content <?php echo ($content2_gallery) ? 'half':'full clear';?>">
                <?php echo $content2_text;?>

                <?php if($content2_highlight_text) { ?>
                <div class="highlight clear">
                    <?php echo $content2_highlight_text;?>
                </div>
                <?php } ?>
            </div>
            <?php } ?>

            <?php if($content2_gallery) { ?>
            <div class="image-column gallery-column">
                <div class="stretch clear">
                    <?php foreach($content2_gallery as $img) { ?>
                    <div class="sgallery">
                        <div class="pad clear"><img src="<?php echo $img['url'];?>" alt="<?php echo $img['title'];?>" /></div>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>


     <?php
    /* CONTENT 3 */
    $content3_title = get_field('section_3_title',$post_id);
    $school_name1 = get_field('school_1_name',$post_id);
    $school_logo1 = get_field('school_1_logo',$post_id);
    $school_name2 = get_field('school_2_name',$post_id);
    $school_logo2 = get_field('school_2_logo',$post_id);
        
    $schools[] = array(
                    'title'=>$school_name1,
                    'logo'=>$school_logo1,
                    'info'=>'cdc_information'
                );
    $schools[] = array(
                    'title'=>$school_name2,
                    'logo'=>$school_logo2,
                    'info'=>'wds_information'
                );
        
    $comparisons = get_field('comparison_chart',$post_id);
    ?>
    <section class="section section3 clear wow fadeIn" data-wow-duration="1s">
        <div class="wrapper clear">
            <?php if($content3_title) { ?>
            <div class="titlewrap"><h2 class="section-title"><?php echo $content3_title;?></h2></div>
            <?php } ?>
            
            <?php $i=1; foreach($schools as $sc) { 
                $school_logo = $sc['logo'];
                $school_name = $sc['title'];
                $comparison_field = $sc['info'];
            ?>
            <div class="info">
                <div class="imageCol">
                    <?php if($school_logo) { ?>
                    <div class="logodiv inline">
                        <img src="<?php echo $school_logo['url'];?>" alt="<?php echo $school_logo['title'];?>" />
                    </div>
                    <?php } ?>
                </div>
                <?php if($school_name) { ?>
                <div class="title-wrap clear">
                    <h3 class="schoolname"><?php echo $school_name;?></h3>
                </div>
                <?php } ?>
                
                <?php if($comparisons) { ?>
                <div class="list-wrapper clear">
                    <ul class="list">
                    <?php $j=1; foreach($comparisons as $com) { ?>
                        <li class="item <?php echo($j % 2 == 0) ? 'even':'odd';?>">
                            <div class="item-info clear"><?php echo $com[$comparison_field]; ?></div>
                        </li>
                    <?php $j++; } ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
            <?php $i++; } ?>
        </div>
    </section>


    <?php
    /* CONTENT 4 */
    $content4_text = get_field('section_4_text',$post_id);
    $c4_column1_image = get_field('s4_cdc_image',$post_id);
    $c4_column1_title = get_field('s4_cdc_image_title',$post_id);
    $c4_column2_image = get_field('s4_wds_image',$post_id);
    $c4_column2_title = get_field('s4_wds_image_title',$post_id);
    $c3_column1_link = get_field('cdc_url',$post_id);
    $c3_column2_link = get_field('wds_url',$post_id);

    $bottom_columns[] = array(
                    'title'=>$c4_column1_title,
                    'image'=>$c4_column1_image,
                    'url'=>$c3_column1_link
                );
    $bottom_columns[] = array(
                    'title'=>$c4_column2_title,
                    'image'=>$c4_column2_image,
                    'url'=>$c3_column2_link
                );
    ?>

    <section class="section section4 clear wow fadeIn" data-wow-duration="1s">
        <div class="wrapper clear">
            <?php if($content4_text) { ?>
            <div class="text-column full">
                <?php echo $content4_text;?>
            </div>
            <?php } ?>  

            <div class="columns-wrapper clear">
            <?php foreach($bottom_columns as $b) { 
                    $bImg = $b['image'];
                    $bTitle = $b['title'];
                    $link = ($b['url']) ? $b['url'] : '#';
                ?>
                <div class="bottomCol">
                    <?php if($bImg) { ?>
                    <div class="photowrap clear">
                        <a class="frame" href="<?php echo $link;?>">
                            <img src="<?php echo $bImg['url'];?>" alt="<?php echo $bImg['title'];?>" />
                        </a>
                    </div>
                    <?php } ?>

                    <?php if($bTitle) { ?>
                    <div class="bottom-title clear">
                        <a href="<?php echo $link;?>"><?php echo $bTitle;?></a>
                    </div>
                    <?php } ?>
                </div>    
            <?php } ?>
            </div>    
        </div>
    </section>
</div><!-- #primary -->

<?php
get_footer();
