<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package fpcschools
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function fpcschools_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'fpcschools_body_classes' );

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

function generate_sitemap() {
    global $wpdb;
    $lists = array();
    $menus = wp_get_nav_menu_items('main-menu');
    $news_ID = 112;
    $cat_args = array('hide_empty' => 1, 'parent' => 0);
    $menu_orders = array();
    $menu_with_children = array();
    if($menus) {
        $i=0;
        foreach($menus as $m) {
            $page_id = $m->object_id;
            $menu_title = $m->title;
            $page_url = $m->url;
            $post_parent = $m->post_parent;
            $submenu = array();
            if($post_parent) {
                $submenu = array(
                        'id'=>$page_id,
                        'title'=>$menu_title,
                        'url'=>$page_url
                    );
                $menu_with_children[$post_parent][$page_id] = $submenu;
            } else {
                $menu_orders[$page_id] = $menu_title;
            } 
            $i++;
        }
    }
    
    $results = $wpdb->get_results( "SELECT ID,post_title FROM {$wpdb->prefix}posts WHERE post_type = 'page' AND post_status='publish' AND post_parent=0 ORDER BY post_title ASC", OBJECT );
    $childPages = $wpdb->get_results( "SELECT ID,post_title,post_parent as parent_id FROM {$wpdb->prefix}posts WHERE post_type = 'page' AND post_status='publish' AND post_parent>0 ORDER BY post_title ASC", OBJECT );
    $childrenList = array();
    $childrenAll = array();
    /* child pages */
    if($childPages) {
        foreach($childPages as $cp) {
            $pId = $cp->parent_id;
            $iD = $cp->ID;
            $childrenAll[$iD] = array(
                                'id'=>$cp->ID,
                                'title'=>$cp->post_title,
                                'url'=>get_permalink($iD)
                            );
            $childrenList[$pId][] = array(
                                'id'=>$cp->ID,
                                'title'=>$cp->post_title,
                                'url'=>get_permalink($cp->ID)
                            );
        }
    }

    if($results) {
        foreach($results as $row) {
            $id = $row->ID;
            $page_title = $row->post_title;
            $page_link = get_permalink($id);
            if(array_key_exists($id,$menu_orders)) {
                $page_title = $menu_orders[$id];
            }
            
            $lists[$id]['parent_id'] = $id;
            $lists[$id]['parent_title'] = $page_title;
            $lists[$id]['parent_url'] = $page_link;
            
            if($menu_with_children) {

                $ii_childrens = array();
                if(array_key_exists($id,$menu_with_children)) {
                    $ii_childrens = $menu_with_children[$id];
                    $lists[$id]['children'] = $ii_childrens;
                }

                /* Show children page even if does not exist on Menu dropdown */
                if($childrenList && array_key_exists($id, $childrenList)) {
                    $cc_children = $childrenList[$id];
                    $exist_children = $lists[$id]['children'];
                    
                    foreach($cc_children as $cd) {
                        $x_id = $cd['id'];
                        if(!array_key_exists($x_id, $ii_childrens)) {
                            $addon[$x_id] = $cd;
                            $exist_children[$x_id] = $cd;
                        }
                    } 

                    $lists[$id]['children'] = $exist_children;
                }

            } else {
                if($childrenList && array_key_exists($id, $childrenList)) {
                    $c_obj = $childrenList[$id];
                    $lists[$id]['children'] = $c_obj;
                }
            }



            
            if($id == $news_ID) {
                $lists[$id]['categories'] = get_categories($cat_args);
            }
        }
    }
    
    return $lists;
    
}

