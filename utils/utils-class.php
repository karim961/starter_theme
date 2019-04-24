<?php


require_once "custom_category.php";
require_once "renaming_post.php";
require_once "wp_bootstrap_navwalker.php";


class utils
{

    public function add_post_type($slug, $plural = "", $support = null)
    {
        add_action('init', function () use ($slug, $plural, $support) {
            create_custom_post_type($slug, $plural, $support);
        });
        return $this;
    }

    public function add_taxonomy_type($slug, $plural = "", $post_types = array("post"))
    {
        add_action('init', function () use ($slug, $plural, $post_types) {
            create_category_taxonomies($slug, $plural, $post_types);
        });
        return $this;
    }

    public function rename_post($singular, $plural = "")
    {
        add_action('admin_menu', function () use ($singular, $plural) {
            change_post_label($singular, $plural);
        });

        add_action('init', function () use ($singular, $plural) {
            change_post_object($singular, $plural);
        });
        return $this;
    }

    public function disable_comments()
    {
        require_once "disable_comments.php";
        return $this;
    }


    public function add_acf()
    {
        define('MY_ACF_PATH', get_stylesheet_directory() . '/includes/acf/');
        define('MY_ACF_URL', get_stylesheet_directory_uri() . '/includes/acf/');

// Include the ACF plugin.
        include_once(MY_ACF_PATH . 'acf.php');

// Customize the url setting to fix incorrect asset URLs.
        add_filter('acf/settings/url', function ($url) {
            return MY_ACF_URL;
        });
//        if (!defined('WP_LOCAL_DEV') || !WP_LOCAL_DEV) {
//            add_filter('acf/settings/show_admin', '__return_false');
//        }
        return $this;
    }

    public function add_theme_options($page_title = "Theme General Settings", $menu_title = "Theme Settings", $menu_slug = 'theme-general-settings', $capability = 'edit_posts', $redirect = false)
    {
        if (function_exists('acf_add_options_page')) {

            acf_add_options_page(array(
                'page_title' => $page_title,
                'menu_title' => $menu_title,
                'menu_slug' => $menu_slug,
                'capability' => $capability,
                'redirect' => $redirect
            ));
        }
        return $this;
    }


    public function add_device_class()
    {
        add_action('wp_footer', function () {
            ?>
            <script>
                jQuery(document).ready(function ($) {
                    var deviceAgent = navigator.userAgent.toLowerCase();
                    if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
                        $("html").addClass("ios");
                        $("html").addClass("mobile");
                    }
                    if (navigator.userAgent.search("MSIE") >= 0) {
                        $("html").addClass("ie");
                    } else if (navigator.userAgent.search("Chrome") >= 0) {
                        $("html").addClass("chrome");
                    } else if (navigator.userAgent.search("Firefox") >= 0) {
                        $("html").addClass("firefox");
                    } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
                        $("html").addClass("safari");
                    } else if (navigator.userAgent.search("Opera") >= 0) {
                        $("html").addClass("opera");
                    }
                });
            </script>
            <?php
        });

        return $this;
    }

    private function actionAfterSetup($function)
    {
        add_action('after_setup_theme', function () use ($function) {
            $function();
        });
    }

    private function actionEnqueueScripts($function)
    {
        add_action('wp_enqueue_scripts', function () use ($function) {
            $function();
        });
    }


    public function __construct()
    {
        $this->addSupport('title-tag')
//            ->addSupport('custom-logo')
            ->addSupport('post-thumbnails')
//            ->addSupport('customize-selective-refresh-widgets')
            ->addSupport('html5', [
                'search-form',
//                'comment-form',
//                'comment-list',
//                'gallery',
//                'caption'
            ])
            ->addScript("jquery")
            ->add_device_class()
            ->add_acf();

        global $content_width;
        if (!isset($content_width)) {
            $content_width = 1920;
        }
    }

    public function addSupport($feature, $options = null)
    {
        $this->actionAfterSetup(function () use ($feature, $options) {
            if ($options) {
                add_theme_support($feature, $options);
            } else {
                add_theme_support($feature);
            }
        });
        return $this;
    }

    public function removeSupport($feature)
    {
        $this->actionAfterSetup(function () use ($feature) {
            remove_theme_support($feature);
        });
        return $this;
    }

    public function loadTextDomain($domain, $path = false)
    {
        $this->actionAfterSetup(function () use ($domain, $path) {
            load_theme_textdomain($domain, $path);
        });
        return $this;
    }

    public function addImageSize($name, $width = 0, $height = 0, $crop = false)
    {
        $this->actionAfterSetup(function () use ($name, $width, $height, $crop) {
            add_image_size($name, $width, $height, $crop);
        });
        return $this;
    }

    public function removeImageSize($name)
    {
        $this->actionAfterSetup(function () use ($name) {
            remove_image_size($name);
        });
        return $this;
    }

    public function addStyle($handle, $src = '', $deps = array(), $ver = false, $media = 'all')
    {
        $this->actionEnqueueScripts(function () use ($handle, $src, $deps, $ver, $media) {
            wp_enqueue_style($handle, $src, $deps, $ver, $media);
        });
        return $this;
    }

    public function addScript($handle, $src = '', $deps = array(), $ver = false, $in_footer = false)
    {
        $this->actionEnqueueScripts(function () use ($handle, $src, $deps, $ver, $in_footer) {
            wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
        });
        return $this;
    }

//    public function addCommentScript()
//    {
//        $this->actionEnqueueScripts(function(){
//            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
//                wp_enqueue_script( 'comment-reply' );
//            }
//        });
//        return $this;
//    }

    public function removeStyle($handle)
    {
        $this->actionEnqueueScripts(function () use ($handle) {
            wp_dequeue_style($handle);
            wp_deregister_style($handle);
        });
        return $this;
    }

    public function removeScript($handle)
    {
        $this->actionEnqueueScripts(function () use ($handle) {
            wp_dequeue_script($handle);
            wp_deregister_script($handle);
        });
        return $this;
    }

    public function addNavMenus($locations = array())
    {
        $this->actionAfterSetup(function () use ($locations) {
            register_nav_menus($locations);
        });
        return $this;
    }

    public function addNavMenu($location, $description)
    {
        $this->actionAfterSetup(function () use ($location, $description) {
            register_nav_menu($location, $description);
        });
        return $this;
    }

    public function removeNavMenu($location)
    {
        $this->actionAfterSetup(function () use ($location) {
            unregister_nav_menu($location);
        });
        return $this;
    }

//////////////////////////////////////////////////FILTERS//////////////////////////////////////////////
    public function filter_title_separator($sep)
    {
        add_filter('document_title_separator', function () use ($sep) {
            return $sep;
        });
        return $this;
    }

}
