<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
    <header id="header" role="banner">
        <div class="container-fluid head relative padding_top_30">

            <div class="row">
                <div class="col text-center">
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                            $image = get_field('logo', 'option');
                            $size = 'medium'; // (thumbnail, medium, large, full or custom size)

                            if ($image) {
                                echo wp_get_attachment_image($image, $size);
                            }
                            ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-2"></div>
                <div class="col menu_container">
                    <nav class="navbar navbar-expand-md padding_vertical_20" role="navigation">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>

                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <?php
                            $menu_class = "nav navbar-nav mx-auto";

                            $defaults = array(
                                'theme_location' => 'main-menu',
                                'menu' => '',
                                'container' => '',
                                'container_class' => 'collapse navbar-collapse',
                                'container_id' => 'bs-example-navbar-collapse-1',
                                'menu_class' => $menu_class,
                                'menu_id' => '',
                                'echo' => true,
                                'fallback_cb' => 'wp_page_menu',
                                'before' => '',
                                'after' => '',
                                'link_before' => '',
                                'link_after' => '',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth' => 0,
                                'walker' => new WP_Bootstrap_Navwalker()
                            );

                            wp_nav_menu($defaults); ?>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

    </header>
    <div id="container">