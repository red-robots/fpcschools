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
        $content1_title = get_field('content1_title',$post_id);
        $content1_text = get_field('content1_text',$post_id);
        $content1_image = get_field('content1_image',$post_id);
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
        $content2_title = get_field('content2_title',$post_id);
        $content2_text = get_field('content2_text',$post_id);
        $content2_highlight_text = get_field('content2_highlight_text',$post_id);
        $content2_gallery = get_field('content2_gallery',$post_id);
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
        $content3_title = get_field('content3_title',$post_id);
        $c3_column1_image = get_field('c3_column1_image',$post_id);
        $c3_column1_title = get_field('c3_column1_title',$post_id);
        $c3_column1_list = get_field('c3_column1_list',$post_id);
        $c3_column1_link = get_field('c3_column1_link',$post_id);
            
        $c3_column2_image = get_field('c3_column2_image',$post_id);
        $c3_column2_title = get_field('c3_column2_title',$post_id);
        $c3_column2_list = get_field('c3_column2_list',$post_id);
        $c3_column2_link = get_field('c3_column2_link',$post_id);
            
        $column_contents[] = array(
                    'title'=>$c3_column1_title,
                    'url'=>$c3_column1_link,
                    'image'=>$c3_column1_image,
                    'list'=>$c3_column1_list
                );
        $column_contents[] = array(
                    'title'=>$c3_column2_title,
                    'url'=>$c3_column2_link,
                    'image'=>$c3_column2_image,
                    'list'=>$c3_column2_list
                );
        ?>
        <section class="section section3 clear wow fadeIn" data-wow-duration="1s">
            <div class="wrapper clear">
                <?php if($content3_title) { ?>
                <div class="titlewrap"><h2 class="section-title"><?php echo $content3_title;?></h2></div>
                <?php } ?>
                <?php $i=1; foreach($column_contents as $col) { 
                    $img = $col['image'];
                    $name = $col['title'];
                    $url = $col['url'];
                    $lists = $col['list'];
                ?>
                <div id="info<?php echo $i;?>" class="info">
                    <div class="imageCol clear">
                        <?php if($img) { ?>
                        <div class="logodiv inline">
                            <img src="<?php echo $img['url']?>" alt="<?php echo $img['title']?>" />
                        </div>
                        <?php } ?>
                    </div>
                    <?php if($name) { ?>
                    <div class="name clear"><a class="schoolname" href="<?php echo $url;?>"><?php echo $name;?></a></div>
                    <?php } ?>
                    
                    <?php if($lists) { ?>
                    <div class="list-wrapper clear">
                        <ul class="list">
                        <?php $j=1; foreach( $lists as $info ) { ?>
                            <li class="item <?php echo($j % 2 == 0) ? 'even':'odd';?>">
                                <div class="item-info clear"><?php echo $info['item']; ?></div>
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
        $content4_text = get_field('content4_text',$post_id);
        $c4_column1_image = get_field('c4_column1_image',$post_id);
        $c4_column1_title = get_field('c4_column1_title',$post_id);
        $c4_column2_image = get_field('c4_column2_image',$post_id);
        $c4_column2_title = get_field('c4_column2_title',$post_id);
            
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
                        $link = $b['url'];
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
