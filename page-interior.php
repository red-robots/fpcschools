<?php
$school_type = get_school_type_uri('key');
$segment = get_school_type_uri();
$school_parent_id = get_post_id_by_slug($segment);
global $post, $wp_query;
$post_id = (isset($post->ID)) ? $post->ID : 0;
$page_title = get_the_title($post_id);
$sections = get_field('sections',$post_id);
$anchors = array();
if($sections) {
    foreach($sections as $ss) {
        $title = $ss['menu_title'];
        if($title) {
            $slug = sanitize_title_with_dashes($title);
            $links[] = array($slug,$title);
        }
    }
?>
<?php if( $links ) { ?>
<div id="interiornav" class="interior-navigation">
    <span id="subnavMobile"><span><i class="fa fa-chevron-down"></i></span></span>
    <div id="navActiveCon" class="wrapper clear"><span class="active-area"></span></div>
    
    <nav id="int_menu" class="wrapper navwrap">
         <ul class="intnav">
            <?php                   
            $i=1; foreach($links as $menu) { 
                $href = $menu[0];
                $menu_name = $menu[1];
            ?>
            <li class="link<?php echo ($i==1) ? ' first':''?>"><a href="#<?php echo $href;?>"><?php echo $menu_name;?></a></li>
            <?php $i++; } ?>
        </ul>
    </nav>
</div>
<?php } ?>

 <main id="main" class="site-main interior-info wrapper clear" role="main">
    
    <header class="section-title-wrap">
        <h1 class="page-title"><?php echo $page_title; ?></h1>
    </header>
    <?php  $j=1; 
    foreach($sections as $ss) { 
    $menu_title = $ss['menu_title'];
    $slug = sanitize_title_with_dashes($menu_title);
    $title = $ss['title'];
    $copy = $ss['copy'];
    $img = $ss['section_image'];
    $col_class = ($img) ? 'half':'full clear'; ?>
    <div id="<?php echo $slug;?>" class="interior entry clear<?php echo($j==1) ? ' first':''?>">
        <div class="textwrap <?php echo $col_class;?>">
            <?php if($title) { ?>
            <h3 class="title"><?php echo $title;?></h3>
            <?php } ?>
            <?php if($copy) { ?>
            <div class="copy">
                <?php echo $copy;?>
            </div>
            <?php } ?>
        </div>
        <?php if($img) { ?>
        <div class="imagecol">
            <img src="<?php echo $img['url'];?>" alt="<?php echo $img['title'];?>" />
        </div>
        <?php } ?>
    </div>
     <?php $j++; } ?>

</main>
<?php } ?>