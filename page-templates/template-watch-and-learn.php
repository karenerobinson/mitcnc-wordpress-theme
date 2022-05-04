<?php
    /* Template Name: Watch and Learn Page */
    get_header();

global $assets_uri, $post;
    $brass_rats = get_brass_rats(3);

?>
<section>
  <?php  
  $media_gallery = get_media_gallery_for_videos(6);
    if($media_gallery != null){
        ?>

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
                                    <h2>Videos</h2>
                                </div>
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
                                                    ?>
                                                    <div class="col-sm-8">
                                                        <a data-fancybox="gallery-video" href="<?php echo $video_url; ?>" class="media-card video-card">
                                                            <div class="media-img">
                                                                <img src="<?php echo $video_thumbnail; ?>" alt="">
                                                            </div>
                                                            <div class="media-content">
                                                                <div class="media-icon-container">
                                                                    <img src="<?php echo $assets_uri; ?>/images/play-icon2.png" alt="">
                                                                </div>
                                                                <h6 class="white-text">
                                                                    <span class="date"><?php echo date('D, M d, Y', strtotime($gallery->post_date)); ?></span>
                                                                    <?php echo $gallery->post_title; ?>
                                                                    <?php
                                                                        // if($video_count > 1){
                                                                        //     echo ' - Part '.$inn;
                                                                        // }
                                                                    ?>
                                                                </h6>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <?php
                                                    $inn++;
                                                    break;
                                                }
                                            }
                                        }
                                    ?>

                                    <div class="col-sm-24 ">
                                        <a href="<?php echo get_permalink(245) ?>" class="default-btn mt15 red-btn mr15">See all Video</a>
                                    </div>

                            </div>
                        </div>
                        <!-- <div class="col-sm-6 offset-sm-1">
                            <?php //get_sidebar(); ?>
                        </div> -->
                    </div>
                </div>
            </article>


            <?php } 
            $media_gallery = get_media_gallery();
            if($media_gallery != null){
            ?>
            <article class="inner-page">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-sm-24">
                            <div class="row">
                                <div class="col-sm-24">
                                    <h2>Photos</h2>
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
                        <div class="col-sm-24 ">
                            <a href="<?php echo get_permalink(247) ?>" class="default-btn mt15 red-btn mr15">See all Photos</a>
                        </div>
                    </div>

                </div>
            </article>

            <?php } 

            ?>


            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="inner-page">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-sm-24 mb20">
                            <h2>Brain Teaser</h2>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $args_puzzle = array( 'post_type' => 'puzzles', 'posts_per_page' => 6 );
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
                                    <a href="<?php the_permalink(); ?>" class="default-btn registration-btn">Solveout <img src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <?php
                        endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                        <div class="col-sm-24 ">
                            <a href="<?php echo get_permalink(786) ?>" class="default-btn mt15 red-btn mr15">See all Brain Teaser</a>
                        </div>
                    </div>
                </div>
            </article>
            <?php endwhile; endif; ?>


                <article class="brass-rats-container">
                <div class="container">
                    
                    <?php if($brass_rats != null){ ?>
                        <div class="row">
                            <div class="col-sm-24">
                                <h2>MIT Alumni - Brass Rats</h2>
                                <p>Albert and Newton '99 in the Bay Area</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                    <?php
                                        foreach ($brass_rats as $brass_rat){
                                            $brass_rat_img = get_image_by_post_id($brass_rat->ID, 'full');
                                            ?>
                                            <div class="col-sm-24">
                                                <div class="mt15">
                                                    <div class="item-brass">
                                                        <img src="<?php echo $brass_rat_img; ?>" alt="">
                                                        <div class="info">
                                                            <h6><?php echo get_field('author_name', $brass_rat->ID); ?></h6>
                                                            <h4><?php echo $brass_rat->post_title ?></h4>
                                                        </div>
                                                        <!--<ul>
                                                            <li><a href="#"><img src="<?php /*echo $assets_uri; */?>/images/valentines-heart.svg" alt=""></a></li>

                                                            <li><a href="#"><img src="<?php /*echo $assets_uri; */?>/images/share-symbol.svg" alt=""></a></li>
                                                        </ul>-->
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    ?>
                            </div>
                           <div class="col-sm-24 ">
                               <a href="<?php echo get_permalink(677) ?>" class="default-btn mt15 red-btn mr15">See all Brass Rats</a>
                           </div>
                        </div>
                            <?php
                        }
                    ?>
                </div>
            </article>
</section>


  <?php get_footer(); ?>