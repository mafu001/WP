<?php get_header(); ?>

<body <?php body_class(); ?>>
<?php get_template_part("/template-parts/common/hero");?>


<div class="posts">
    <?php
    while(have_posts()):
        the_post();
    ?>
    <div class="post" <?php post_class(); ?>>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="post-title text-center"><?php the_title(); ?></h2></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-2">
                    <p class="text-center">
                        <strong><?php the_author(); ?></strong><br/>
                        <?php echo get_the_date("jS M, Y"); ?>
                    </p>
                </div>
                <div class="col-md-8 offset-2">
                    <p>
                        <?php
                        if(has_post_thumbnail()) {
                            the_post_thumbnail("large", array("class" => "img-fluid"));
                        }
                        
                        ?>
                    </p>

                    <p>
                    <?php 
                    the_excerpt();
                    // if(!post_password_required()) {
                    //     the_excerpt(); 
                    // }else {
                    //   echo get_the_password_form();
                    // }
                    ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php
    endwhile;
    ?>
    <div class="containar">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <?php
                the_posts_pagination(array(
                    "screen_reader_text"    => " ",
                    "prev_text"             => "old text",
                    "next_text"             => "new text"
                ));
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>