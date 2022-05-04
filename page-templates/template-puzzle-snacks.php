<?php
    /* Template Name: Puzzle Snacks */
    get_header();
    global $assets_uri;
?>
<section>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <?php get_breadcrumb(); ?>
                </div>
                <div class="col-sm-24 mb20">
                    <h1 class="heading_8 mt0"><?php echo $post->post_title; ?></h1>
                </div>
            </div>
            <div class="row">
                <?php
                    $args_puzzle = array( 'post_type' => 'puzzle-snacks', 'posts_per_page' => -1 );
                    $loop_puzzle = new WP_Query( $args_puzzle );
                    if ( $loop_puzzle->have_posts() ) : while ( $loop_puzzle->have_posts() ) : $loop_puzzle->the_post();

                    ?>
                    <div class="col-sm-8">
                        <div class="puzzle-box">
                            <div class="img-container">
                                <?php
                                if ( has_post_thumbnail() ) { ?>

                                    <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url() ?>" alt=""></a>
                                <?php } else {
                                ?>
                               <a href="<?php the_permalink(); ?>"> <img src="<?php echo $assets_uri; ?>/images/puzzle-img.png" alt=""></a>
                                <?php } ?>
                            </div>
                            <div class="content-btn">
                                <p><?php
                                    $excerpt = get_the_excerpt();
                                    $excerpt = substr($excerpt, 0, 130);
                                    echo $excerpt;
                                ?></p>
                                <a href="<?php echo get_permalink(get_the_ID()); ?>" class="default-btn registration-btn">Solve <img src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <?php
                    endwhile;
                    endif;
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </article>
    <?php endwhile; endif; ?>
</section>
<?php get_footer();