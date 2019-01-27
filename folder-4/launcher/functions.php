<?php

function launcher_custom_theme()
{


    load_theme_textdomain("lancher");
    add_theme_support("title-tag");
    add_theme_support("post-thumbnail");
}

add_action("after_setup_theme", "launcher_custom_theme");


function lancher_assets()
{


    if (is_page()) {
        $launcher_template_name = basename(get_page_template());
        if ($launcher_template_name == "launcher.php") {
            wp_enqueue_style("animate", get_theme_file_uri("/assets/css/animate.css"));
            wp_enqueue_style("icomoon", get_theme_file_uri("/assets/css/icomoon.css"));
            wp_enqueue_style("bootstrap", get_theme_file_uri("/assets/css/bootstrap.css"));
            wp_enqueue_style("style", get_theme_file_uri("/assets/css/style.css"));
            wp_enqueue_style("launcher-style", get_stylesheet_uri(), null, time());

            wp_enqueue_script("easing-jquery-js", get_theme_file_uri("/assets/js/jquery.easing.1.3.js"), array("jquery"), null, true);
            wp_enqueue_script("bootstrap-jquery-js", get_theme_file_uri("/assets/js/bootstrap.min.js"), array("jquery"), null, true);
            wp_enqueue_script("waypoints-jquery-js", get_theme_file_uri("/assets/js/jquery.waypoints.min.js"), array("jquery"), null, true);
            wp_enqueue_script("countdown-jquery-js", get_theme_file_uri("/assets/js/simplyCountdown.js"), array("jquery"), null, true);
            wp_enqueue_script("main-jquery-js", get_theme_file_uri("/assets/js/main.js"), array("jquery"), null, true);
        } else {
            wp_enqueue_style("bootstrap", get_theme_file_uri("/assets/css/bootstrap.css"));
            wp_enqueue_style("launcher-style", get_stylesheet_uri(), null, time());
        }
    }

    $lancher_year = get_post_meta(get_the_ID(), "year", true);
    $lancher_month = get_post_meta(get_the_ID(), "month", true);
    $lancher_day = get_post_meta(get_the_ID(), "day", true);

    wp_localize_script("main-jquery-js", "dateCount", array(
        "year"=> $lancher_year,
        "month"=> $lancher_month,
        "day"=> $lancher_day
    ));
}

add_action("wp_enqueue_scripts", "lancher_assets");

function launcher_widgets()
{
    register_sidebar(array(
        'name' => __('Left footer widget', 'launcher'),
        'id' => 'left-sidebar',
        'description' => __('Left footer Sidebar', 'launcher'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section >',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Right footer widget', 'launcher'),
        'id' => 'right-sidebar',
        'description' => __('Right footer Sidebar', 'launcher'),
        'before_widget' => '<section id="%1$s" class="text-right widget %2$s">',
        'after_widget' => '</section >',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action("widgets_init", "launcher_widgets");


function leancher_home_side_image()
{
    if (is_page()) {
        $thumbnail_url = get_the_post_thumbnail_url(null, "large");
        ?>
        <style>
            .home-side-image {
                background-image: url(<?php echo $thumbnail_url?>);
            }
        </style>
        <?php
    }
}

add_action("wp_head", "leancher_home_side_image", 11);


?>