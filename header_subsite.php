<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php 
get_template_part('inc/header_meta');
$is_sub_site_ii = get_school_type_uri();
foreach($parts as $p) {
    if( in_array($p,$schools) ) {
        $is_sub_site_ii = $p;
        break;
    }
}
    
    
global $post;
$is_home = ( is_home() || is_front_page() ) ? true:false;
$home_class = ($is_home) ? 'home':'subpage';
$post_id = (isset($post->ID)) ? $post->ID : 0;
    
if($is_sub_site_ii) {
    $post_id = get_post_id_by_slug($is_sub_site_ii);
}
    
$school_logo = get_field('school_logo',$post_id);
$logo_url = ($school_logo) ? $school_logo['url'] : '';
$logo_name = '';
$sub_site_class = '';
$sub_site_url = '';
$parent_id = '';
if( $postInfo = get_post($post_id) ) {
    $parent_id = $postInfo->post_parent;
    if($parent_id>0) {
        if( $parent_school = get_field('school_logo',$parent_id) ) {
            $parent_post = get_post($parent_id);
            $school_logo = $parent_school;
            $logo_url = ($school_logo) ? $school_logo['url'] : '';
            $logo_name = $parent_post->post_title;
            $sub_site_class = $parent_post->post_name;
            $sub_site_url = get_permalink($parent_id);
        }
    } else {
        $logo_name = $postInfo->post_title;
        $sub_site_class = $postInfo->post_name;
        $sub_site_url = get_permalink($post_id);
    }
}

$school_type = get_school_type_uri('key');
$classes = array($home_class,$sub_site_class,$school_type);
wp_head(); 
?>
</head>

<body <?php body_class($classes); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fpcschools' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="wrapper clear">
			
			<?php if( $logo_url ) { ?>
	            <div class="logo">
	            	<a href="<?php echo $sub_site_url; ?>" title="<?php echo $logo_name; ?>">
		            	<img src="<?php echo $logo_url; ?>" alt="<?php echo $logo_name; ?>">
		            </a>
	            </div>
	        <?php } else { ?>
	            <h1 class="logo">
		            <a href="<?php echo $sub_site_url; ?>" title="<?php echo $logo_name; ?>"><?php echo $logo_name; ?></a>
	            </h1>
	        <?php } ?>
            
            <span class="burger" id="mobile-menu"><span></span></span>
            <nav id="site-navigation" class="main-navigation" role="navigation">
				<div class="navwrap clear">
                    <?php if($is_sub_site_ii=='weekday-school') { ?>
                        <?php wp_nav_menu( array( 'menu' => 'WDS Menu') ); ?>
                    <?php } else { ?>
                        <?php wp_nav_menu( array( 'menu' => 'CDC Menu') ); ?>
                    <?php } ?>
                </div>
			</nav><!-- #site-navigation -->
	</div><!-- wrapper -->
	</header><!-- #masthead -->
    
    <?php if($is_home) { 
        get_template_part('inc/banner');
    } ?>

	<div id="content" class="site-content clear">
