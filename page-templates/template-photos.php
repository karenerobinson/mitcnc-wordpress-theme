<?php
    /* Template Name: Photos Page */
    get_header();
    global $assets_uri, $post;
    $media_gallery = get_media_gallery();
    if($media_gallery != null){
        ?>
        <section>
            <article class="inner-page">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-24">
                            <?php get_breadcrumb(); ?>
                        </div>
                        <div class="col-sm-24">
                            <div class="row">
                                <div class="col-sm-24">
                                    <h1><?php echo $post->post_title; ?></h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-24">
                                    <div class="feature-images-sec">
                                        <?php echo get_the_post_thumbnail($post->ID, 'thumbnail_1079_474'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-24" id="gallery_wrapper">
                                    <?php
                                        foreach ($media_gallery as $gallery) {
                                            if(!empty(strip_tags($gallery->post_content))){
                                                echo do_shortcode($gallery->post_content);
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </article>
        </section>
<?php } get_footer();


