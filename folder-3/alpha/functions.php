<?php

if(site_url() == "http://localhost/all/lwhh/") {
    define("VERSION",  time());
}else {
    define("VERSION", wp_get_theme() -> get("Version"));
}

function alpha_bootstraping() {
    load_theme_textdomain("alpha");
    add_theme_support("title-tag");
    add_theme_support("post-thumbnails");
    $alpha_custom_header_details = array(
        "custom-text"           => true,
        "default-text-color"    => "#222",
        "width"                 => '1200',
        "height"                => '600',
        "flex-width"            => true,
        "flex-height"           => true,
    );
    add_theme_support("custom-header", $alpha_custom_header_details);
    $alpha_custom_logo_details = array(
        "width"     => '100',
        "height"    => '100'
    );
    add_theme_support("custom-logo", $alpha_custom_logo_details);
    add_theme_support("custom-background");
    register_nav_menu("top-menu", __("Alpha Top Menu", "alpha"));
    register_nav_menu("footer-menu", __("Alpha Footer Menu", "alpha"));
}

add_action("after_setup_theme", "alpha_bootstraping");


function alpha_assets() {
    wp_enqueue_style("alpha", get_stylesheet_uri(), null, VERSION);
    wp_enqueue_style("bootstrap", "//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css");
    wp_enqueue_style("feather-light", "//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css");
    
    wp_enqueue_script("feather-light-js", "//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js", array("jquery"), "1.0", true);
}

add_action("wp_enqueue_scripts", "alpha_assets");


function alpha_sidebar() {
    register_sidebar(array(
        "name"              => __("single Post Sidebar", "alpha"),
        "id"                => "sidebar-1",
        "description"       => __("Right Sidebar", "alpha"),
        "before_widget"     => '<section id="%1$s" class="widget %2$s">',
        "after_widget"      => "</section>",
        "before_title"      => '<h2 class="widget-title">',
        "after_title"       => "</h2>",
    ));

    register_sidebar(array(
        "name"              => __("Left Footer Sidebar", "alpha"),
        "id"                => "footer-left",
        "description"       => __("Left widgets area on the footer", "alpha"),
        "before_widget"     => '<section id="%1$s" class="widget %2$s">',
        "after_widget"      => "</section>",
        "before_title"      => '<h2 class="widget-title">',
        "after_title"       => "</h2>",
    ));

    register_sidebar(array(
        "name"              => __("Right footer Sidebar", "alpha"),
        "id"                => "footer-right",
        "description"       => __("Right widgets area on the footer", "alpha"),
        "before_widget"     => '<section id="%1$s" class="widget %2$s">',
        "after_widget"      => "</section>",
        "before_title"      => '<h2 class="widget-title">',
        "after_title"       => "</h2>",
    ));
}

add_action("widgets_init", "alpha_sidebar");


function alpha_post_excerpt_change($excerpt) {
    if(!post_password_required()) {
        return $excerpt;
    } else {
       echo get_the_password_form();
    }
}

add_filter("the_excerpt", "alpha_post_excerpt_change");


function alpha_protected_title_change() {
    return "%s";
}

add_filter("protected_title_format", "alpha_protected_title_change");


function li_css_class($classes, $item) {
    $class[] = "list-inline-item";
    return $class;
}

add_filter("nav_menu_css_class", "li_css_class", 10, 2);



function alpha_custom_css() {
    if(is_page_template()) {
        $thumbnail_url = get_the_post_thumbnail_url(null, "large");
?>
    <style>
        .page-header {
            background-image:url(<?php echo $thumbnail_url?>);
        }
    </style>
<?php
    }

    if(is_front_page()) {
        if(current_theme_supports("custom-header")) {
        ?>

        <style>
        .header {
            background-image: url(<?php header_image(); ?>);
            background-size: cover;
            margin-bottom: 50px;
        }
        .header h3.tagline, h1.heading {
            color: #<?php echo get_header_textcolor(); ?>;
            <?php
            if(!display_header_text()) {
                echo "display: none;";
            }
            ?>
        }

        .header-logo {
            margin-top: 50px;
        }
        .header-logo img{
            border-radius: 50%;
        }
        </style>

        <?php   
        }
    }


}

add_action("wp_head", "alpha_custom_css", 11);


?>
