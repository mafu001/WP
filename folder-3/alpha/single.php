<?php get_header(); ?>
<?php get_template_part("/template-parts/common/hero"); ?>
<div class="posts">
<?php 
while(have_posts()):the_post();
?>
    <div class="post">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="post-title text-center"><?php the_title(); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="col-md-12">
                        <p class="text-center">
                            <strong><?php the_author(); ?></strong><br/>
                            <?php echo get_the_date("jS M, Y"); ?>
                        </p>
                        <?php the_posts_pagination("<ul class=\"list-unstyled\"><li>", "</li><li>", "</li></ul>"); ?>
                    </div>
                    <div class="col-md-12">
                        <p>
                            <?php 
                                if(has_post_thumbnail()) {
                                    $thumbnail_url = get_the_post_thumbnail_url(null, "large");
                                    // echo '<a href="' . $thumbnail_url . '" data-featherlight="image">';
                                    printf('<a href="%s" data-featherlight="image">', $thumbnail_url);
                                    the_post_thumbnail("large", array("class" => "img-fluid"));
                                    echo '</a>';
                                }
                            ?>
                        </p>
                        <?php 
                        the_content(); 

                        next_post_link();
                        echo "<br />";
                        previous_post_link();
                        
                        ?>

                    </div>
                </div>
                <div class="col-md-3 offset-md-1">
                <?php
                    if(is_active_sidebar("sidebar-1")) {
                        dynamic_sidebar("sidebar-1");
                    }
                ?>
                </div>
            </div>

        </div>
    </div>
<?php endwhile; ?>
</div>
<?php get_footer(); ?>