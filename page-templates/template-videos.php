<?php
    /* Template Name: Videos Page */
    get_header();
    global $assets_uri, $post;
    $media_gallery = get_media_gallery_for_videos();
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
                            <div class="row mb15">
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
                            <div class="row mt10">
                                <?php
                                    foreach ($media_gallery as $key => $gallery){
                                        if (have_rows('videos', $gallery->ID)) {
                                            $video_count = get_post_meta($gallery->ID, 'videos', true);
                                            $inn = 1;
                                            while (have_rows('videos', $gallery->ID)){
                                                the_row();
                                                $video_url = get_sub_field('url', $gallery->ID);
                                                $video_thumbnail = get_sub_field('thumbnail', $gallery->ID);
                                                $video_title = get_sub_field('title', $gallery->ID);
                                                ?>
                                                <div class="col-sm-8">
                                                    <a data-fancybox="<?php echo "gallery-video-$gallery->ID";?>" href="<?php echo $video_url; ?>" class="media-card video-card">
                                                        <div class="media-img">
                                                            <img src="<?php echo $video_thumbnail; ?>" alt="">
                                                        </div>
                                                        <div class="media-content">
                                                            <div class="media-icon-container">
                                                                <img src="<?php echo $assets_uri; ?>/images/play-icon2.png" alt="">
                                                            </div>
                                                            <h6 class="white-text">
                                                                <span class="date"><?php echo date('D, M d, Y', strtotime($gallery->post_date)); ?></span>
                                                                <?php
                                                                    if(!empty($video_title)){
                                                                        echo $video_title;
                                                                    } else{
                                                                        echo $gallery->post_title;
                                                                        if($video_count > 1){
                                                                            echo ' - Part '.$inn;
                                                                            $inn++;
                                                                        }
                                                                    }
                                                                ?>
                                                            </h6>
                                                        </div>
                                                    </a>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>

<?php } get_footer();
