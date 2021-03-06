<section class="all-section">
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    if(current_theme_supports("custom-logo")):
                ?>
                <div class="header-logo text-center">
                    <?php the_custom_logo(); ?>
                </div>
                <?php endif; ?>
                <h3 class="tagline"><?php bloginfo("description"); ?></h3>
                <a href="<?php echo site_url(); ?>"><h1 class="align-self-center display-1 text-center heading"><?php bloginfo("name"); ?></h1></a>
            </div>
            <div class="col-md-12">
                <div class="navigation">
                <?php
                wp_nav_menu(array(
                    "theme_location"    => "top-menu",
                    "menu_id"           => "top-menu-container",
                    "menu_class"        => "list-inline text-center"
                ));
                ?>
                </div>
            </div>
        </div>
    </div>
</div>