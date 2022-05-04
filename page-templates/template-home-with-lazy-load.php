<?php
/* Template Name: Home Page with Lazy Load */
get_header();
global $videos_page_id, $podcast_page_id, $post;

$media_gallery = get_media_gallery(3, true);

?>
<section id="hompage-banner"></section>

<section>
    
    <div id="hompage-upcoming-events"></div>

    <article class="join-mit">
        <div class="container">
            <div class="row watch-and-listen">
                <div class="col-xl-7 col-lg-8 col-sm-11 podcast-feed">
                    <h2 class="red-border">
                        <a href="<?php echo esc_url(site_url('podcasts')); ?>">Listen</a>
                    </h2>

                    <div>
                        <div class="home-listen">
                            <?php echo do_shortcode('[podcasts link="https://feeds.buzzsprout.com/615046.rss" limit="4"]'); ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-16 col-sm-13 col-xl-16 offset-xl-1 video-feed">
                    <?php if ($media_gallery != null) { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="red-border">
                                    <a href="<?php echo esc_url(site_url('/watch-learn/videos')); ?>">Watch</a>
                                </h2>
                            </div>
                        </div>
                        <div class="row mt20">
                            <?php echo do_shortcode('[yotuwp type="channel" id="UCu2dehvPe9e_ui_1HN7INxw" per_page="4"]'); ?>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-24 center-mobile">
                                <a href="<?php echo esc_url(get_permalink($videos_page_id)); ?>"
                                   class="default-btn event-btns right">
                                    See All Videos
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 center-mobile">
                    <a href="<?php echo esc_url(get_permalink($podcast_page_id)); ?>" class="default-btn event-btns">
                        See All Episodes
                    </a>
                </div>
            </div>
        </div>
    </article>

    <?php get_template_part('template-parts/content', 'program-divisions'); ?>

    <div id="homepage-blog-area"></div>
    
</section>

<?php
get_footer();
?>
