<?php


require_once "utils/utils-class.php";

$theme_utils = new utils;

$theme_utils->addNavMenus([
    'main-menu' => ' Main Menu'
])
    ->addStyle("bootstrap4", "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css")
    ->addStyle('colors_css',get_template_directory_uri() . '/css/colors.css')
    ->addStyle('common_css',get_template_directory_uri() . '/css/common.css')
    ->addStyle('theme-styles', get_stylesheet_uri())
    ->addScript('boot4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js')
    ->disable_comments()
    ->filter_title_separator("|");




