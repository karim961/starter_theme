<?php

/////////////////////////RENAMING POSTS BUTTON///////////////////////

//add_action( 'admin_menu', 'caller_change_post_label' );
//function caller_change_post_label(){
//
//    change_post_label("bla", "blas") ;
//}
//
//add_action( 'init', 'caller_change_post_object' );
//function caller_change_post_object(){
//    change_post_object("bla","blas");
//}



function change_post_label($slug_name, $plural_name = "") {

    $single = $slug_name;
    $plural = "";
    if ($plural_name != "") {
        $plural = $plural_name;
    } else {
        $plural = $slug_name . "s";
    }
    $csingle = ucfirst($single);
    $cplural = ucfirst($plural);

    global $menu;
    global $submenu;
    $menu[5][0] = $cplural;
    $submenu['edit.php'][5][0] = $cplural;
    $submenu['edit.php'][10][0] = 'Add '.$cplural;
    $submenu['edit.php'][16][0] = $cplural.' Tags';
    echo '';
}
function change_post_object($slug_name, $plural_name = "") {

    $single = $slug_name;
    $plural = "";
    if ($plural_name != "") {
        $plural = $plural_name;
    } else {
        $plural = $slug_name . "s";
    }
    $csingle = ucfirst($single);
    $cplural = ucfirst($plural);

    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = $cplural;
    $labels->singular_name = $csingle;
    $labels->add_new = 'Add '.$csingle;
    $labels->add_new_item = 'Add '.$csingle;
    $labels->edit_item = 'Edit '.$csingle;
    $labels->new_item = $cplural;
    $labels->view_item = 'View '.$cplural;
    $labels->search_items = 'Search '.$cplural;
    $labels->not_found = 'No '.$csingle.' found';
    $labels->not_found_in_trash = 'No '.$csingle.' found in Trash';
    $labels->all_items = 'All '.$cplural;
    $labels->menu_name = $cplural;
    $labels->name_admin_bar = $cplural;
}
