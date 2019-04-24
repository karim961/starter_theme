<?php

//add_action('init', 'custom_category_call', 0);
//
//function custom_category_call(){
//    create_category_taxonomies("bla","blas");
//}

/////////////////////////add category///////////////////////

function create_category_taxonomies($slug_name, $plural_name = "",$post_types= array("post"))
{

    $single = $slug_name;
    $plural = "";
    if ($plural_name != "") {
        $plural = $plural_name;
    } else {
        $plural = $slug_name . "s";
    }
    $csingle = ucfirst($single);
    $cplural = ucfirst($plural);


    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => _x($cplural, 'taxonomy general name'),
        'singular_name' => _x($csingle, 'taxonomy singular name'),
        'search_items' => __('Search '.$cplural),
        'all_items' => __('All '.$cplural),
        'parent_item' => __('Parent '.$csingle),
        'parent_item_colon' => __('Parent '.$csingle.':'),
        'edit_item' => __('Edit '.$csingle),
        'update_item' => __('Update '.$csingle),
        'add_new_item' => __('Add New '.$csingle),
        'new_item_name' => __('New Type '.$csingle),
        'menu_name' => __($cplural),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => $plural),
    );

    register_taxonomy($single, $post_types, $args);
}