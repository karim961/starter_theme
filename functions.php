<?php
require_once "utils/utils-class.php";

$theme_utils = new utils;
//var_dump($theme_utils->imgSizes);
//var_dump($theme_utils->imgs);
$theme_utils->addNavMenus([
    'main-menu' => ' Main Menu',
])
    ->addStyle("bootstrap4", "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css")
    ->addStyle('fontawesome', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css')
    ->addStyle('colors_css', get_template_directory_uri() . '/css/colors.css')
    ->addStyle('common_css', get_template_directory_uri() . '/css/common.css')
    ->addStyle('hamburger_css', get_template_directory_uri() . '/css/hamburgers-bs4.css')
    ->addStyle('theme-styles', get_stylesheet_uri())
    ->addScript('boot4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js')
    ->disable_comments()
    ->filter_title_separator("|")
    ->add_theme_options()
;

require_once "utils/calls_helper.php";
$wp_calls=new calls_helper();



//var_dump($theme_utils->imgSizes);