<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/25/2019
 * Time: 3:29 PM
 */


class calls_helper
{
    public function call_terms($name, $args, $function)
    {

        if (empty($args) || $args==null) {
            $args = array('parent' => 0,
                'hide_empty' => false,
                'exclude' => '1'
            );
        }

        $categories = get_terms(
            $name,
            $args
        );

        foreach ($categories as $category) {
            // var_dump($category);
//                echo $category->name;
            //$image = get_field('image', "category_$category->term_id");
//                var_dump($image);
            $function($category);

            /* <div class="col-sm-3 brand_btn ">
                <a href="<?php echo get_term_link($category); ?>">
                    <div class="product_image text-center">
                        <img src="<?php echo $image ?>" class="img-responsive inline_block"/>
                    </div>
                    <div class="title_bg red_bg center">
                        <h5 class="white"><?php echo $category->name; ?> <span><img
                                        src="<?php echo get_template_directory_uri() ?>/images/arrow-white.png"
                                        class="no_margin no_padding" style="margin:0px; padding:0px;"/></span></h5>
                    </div>
                </a>
            </div>
            */

        }
    }

    public function call_Posts($type, $args, $function)
    {
        if ($type == null || $type=="") {
            $type = 'post';
        }
        if (empty($args) || $args==null) {
            $args = array(
                'post_type' => $type,
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'caller_get_posts' => 1);
        }

        $my_query = null;
        $my_query = new WP_Query($args);
        if ($my_query->have_posts()) {

            while ($my_query->have_posts()) : $my_query->the_post();
                $function();
            endwhile;
        }
        wp_reset_query();  // Restore global post data stomped by the_post().
    }
}