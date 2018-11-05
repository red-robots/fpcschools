<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Delius" rel="stylesheet">
<script defer src="<?php bloginfo( 'template_url' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>
<?php 
    
$url      = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$validURL = str_replace("&", "&amp", $url);
$schools = array('weekday-school','child-development-center');
$parts = explode('/',$validURL);
$is_sub_site_ii = '';
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
    

    
$classes = array($home_class,$sub_site_class);
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
