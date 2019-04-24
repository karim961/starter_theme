<?php

/////////////////big banner///////////////////////////

//add_action('init', 'custom_post_call', 0);
//
//function custom_post_call(){
//    create_custom_post_type("bla","bla");
//}


function create_custom_post_type($slug_name, $plural_name = "", $supports = null)
{


    $single = $slug_name;
    $plural = "";
    if ($plural_name != "") {
        $plural = $plural_name;
    } else {
        $plural = $slug_name . "s";
    }
    $Csingle = ucfirst($single);
    $cplural = ucfirst($plural);

    if ($supports == null) {
        $supports = array(
            'title',
            'editor',
            'custom-fields',
            'revisions',
            'thumbnail',
        );
    }

    $labels = array(
        'name' => _x($cplural, 'post type general name'),
        'singular_name' => _x($Csingle, 'post type singular name'),
        'add_new' => _x('Add New', 'Custom Module'),
        'add_new_item' => __('Add New ' . $Csingle),
        'edit_item' => __('Edit ' . $Csingle),
        'new_item' => __('New ' . $Csingle),
        'view_item' => __('View ' . $Csingle),
        'search_items' => __('Search ' . $cplural),
        'not_found' => __('No ' . $Csingle . ' found'),
        'not_found_in_trash' => __('No ' . $Csingle . ' found in Trash'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'show_ui' => true,
        'rewrite' => array('slug' => $single, 'with_front' => true),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => $supports,
        'taxonomies' => array('group'),
        'has_archive' => true
    );
    register_post_type($single, $args);
}