<?php
/**
 * fpcschools functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fpcschools
 */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/theme-setup.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Post Pagination
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Social
 */
require get_template_directory() . '/inc/social-media-links.php';

/**
 * Theme Specific additions.
 */
require get_template_directory() . '/inc/theme.php';

/**
 * Block & Disable All New User Registrations & Comments Completely.
 * Description:  This simple plugin blocks all users from being able to register no matter what, 
 *				 this also blocks comments from being able to be inserted into the database.
 */
require get_template_directory() . '/inc/block-all-registration-and-comments.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/* Fixed Gravity Form Conflict Js */
add_filter("gform_init_scripts_footer", "init_scripts");
function init_scripts() {
    return true;
}

function get_post_id_by_slug($slug) {
    global $wpdb;
    $row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}posts WHERE post_name='".$slug."' AND post_status='publish'", OBJECT );
    return ($row) ? $row->ID : 0;
}

function get_school_type_uri($type=null) {
    $url      = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $validURL = str_replace("&", "&amp", $url);
    //$schools = array('weekday-school','child-development-center');
    $schools = array('wds'=>'weekday-school','cdc'=>'child-development-center');
    $parts = explode('/',$validURL);
    $school_slug = '';
    $arrs = array();
    foreach($parts as $p) {
        foreach($schools as $k=>$sc) {
            if($p==$sc) {
                $arrs[$k]=$sc;                
            }
        }
    }
    
    if($type) {
        if( $type=='key' ) {
            return key($arrs);
        }
    } else {
        return end($arrs);
    }
}

/* shortcode to wrap content in a div */
function do_shortcode_contact_information($atts, $content = null) {
    extract(shortcode_atts(array(
      'post_id' => "",
      'class' => "",
    ), $atts));
    
    $output = '';
    if($post_id) {
        $details = get_field('contact_sections',$post_id);
        $count = count($details);
        $colClass = '';
        if($count==2) {
            $colClass = ' cols_2 padded';
        }
        else if($count==3) {
            $colClass = ' cols_3 padded';
        }
        else if($count>3) {
            $colClass = ' cols_4 padded';
        }
        if($details) {
            $output = '<div class="contact_data '.$class.'"><div class="row clear">';
            foreach($details as $d) {
                $output .= '<div class="text'.$colClass.'"><div class="pad clear">'.$d['contact_section_text'].'</div></div>';
            }
            $output .= '</div></div>';
        }
    }
    return $output;
}
add_shortcode('contact_information', 'do_shortcode_contact_information');
