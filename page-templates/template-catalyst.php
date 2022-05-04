<?php
    /* Template Name: Catalyst */
    get_header();
    global $assets_uri, $post;
?>


<section>
    <article class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                <?php get_breadcrumb(); ?>
                </div>
                <div class="col-sm-24">
                    <div class="row mb15">
                        <div class="col-sm-24">
                            <h1><?php // echo $post->post_title; ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-24 podcast-banner-wrapper">
                            <div class="feature-images-sec">
                                <?php echo get_the_post_thumbnail($post->ID, 'thumbnail_1079_474'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mt10">
                        <?php echo do_shortcode($post->post_content); ?>
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>

<?php get_footer(); ?>
       
