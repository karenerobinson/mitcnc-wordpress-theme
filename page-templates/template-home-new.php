<?php
/* Template Name: Home Page New */
get_header();
global $videos_page_id, $podcast_page_id, $post;

$media_gallery = get_media_gallery(3, true);

// GET SPEAKERS
$speakers_by_page = get_field('speakers_list', $post->ID);
$speakers = null;
if (is_array($speakers_by_page)) {
    $speakers = get_users_by_type('speakers', '', false, '', false, 'ASC', $speakers_by_page);
}
$speakers_total_count = count(get_users_by_type('speakers'));

// GET VOLUNTEER
$volunteers_by_page = get_field('volunteer_list', $post->ID);
$volunteer_spotlight = null;
if (is_array($volunteers_by_page)) {
    $volunteer_spotlight = get_users_by_type('volunteer_spotlight', 1, false, '', false, 'ASC', $volunteers_by_page);
}

$Banners = getHomeBanners();

$skyline_background_uri = get_asset_uri('/images/skyline.svg');
?>

<?php if (!empty($Banners) && is_array($Banners) && count($Banners) > 0) : ?>
    <section>
        <article class="home-banner">
            <div class="container">
                <div class="slider-container">
                    <div id="slider_loader"
                         style="position: absolute;z-index: 1;bottom: 0; top: 0;right: 0;left: 0;background: rgb(163, 31, 52);">
                        <h2 style="color: #fff;margin-top: calc(100% / 6);text-align: center;">loading...</h2>
                    </div>
                    <div class="home-slider-container" style="visibility: hidden;">
                        <?php if (!empty($Banners) && is_array($Banners) && count($Banners) > 0) : ?>
                            <?php foreach ($Banners as $key => $Banner) : ?>
                                <?php if ($Banner['post_type'] == 'brass-rats') : ?>
                                    <div class="slide-<?php echo esc_attr($key); ?> brass-rats">
                                        <a href="<?php echo esc_url($Banner['get_permalink']); ?>">
                                            <div class="slide-item-container"
                                                 style="<?php echo (isset($Banner['image']) && !empty($Banner['image'])) ? 'background-image: url(' . esc_url($Banner['image']) . ');' : 'background: url(' . esc_url($skyline_background_uri) . ')  no-repeat;background-position: 0 104%;'; ?>">
                                                <div class="slide-info">
                                                    <p class="comic-title"><?php echo esc_html($Banner['post_title']); ?></p>
                                                    <p class="comic-author"><?php echo esc_html($Banner['author_name']); ?></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if ($Banner['post_type'] == 'podcast' || $Banner['post_type'] == 'covid') : ?>
                                    <div class="slide-<?php echo esc_attr($key); ?> podcast-slide"
                                         style="background-image: url('<?php echo esc_url($Banner['image']); ?>');">
                                        <a href="<?php echo esc_url($Banner['get_permalink']); ?>">
                                            <div class="slide-item-container">
                                                <p><?php echo $Banner['post_content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                                            </div>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if ($Banner['post_type'] == 'events') : ?>
                                    <div class="slide-<?php echo esc_attr($key); ?>">
                                        <div class="slide-item-container events-slider"
                                             style="<?php echo !empty($Banner['image']) ? 'background-image: url(' . esc_url($Banner['image']) . ');' : 'background: url(' . esc_url($skyline_background_uri) . ') ' . esc_attr($Banner['slide_color']) . ' no-repeat;background-position: 0 118%;'; ?>">
                                            <a href="<?php echo esc_url($Banner['get_permalink']); ?>"
                                               class="slide-info">
                                                <span class="tag">FEATURED <?php echo esc_html(strtoupper($Banner['post_type'])); ?></span>
                                                <h2><?php echo esc_html($Banner['post_title']); ?></h2>
                                                <p><?php echo esc_html(limit_words(strip_tags($Banner['post_content']), 17)); ?></p>
                                                <div class="default-btn event-btns">Learn More</div>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>


                                <?php if ($Banner['post_type'] == 'volunteer-spotlight') : ?>
                                    <div class="slide-<?php echo esc_attr($key); ?>">
                                        <div class="slide-item-container" style="background-color: #a41e37;">
                                            <a href="<?php echo esc_url($Banner['view_all']); ?>"
                                               class="slide-info volunteer-spotlight">
                                                <img class="volunteer-avatar"
                                                     src="<?php echo esc_url($Banner['image']); ?>">
                                                <div class="volunteer-info">
                                                    <span class="tag">Volunteer Spotlight</span>
                                                    <h2><?php echo esc_html($Banner['volunteer_full_name']); ?></h2>
                                                    <p><?php echo esc_html(limit_words(strip_tags($Banner['bio']), 17)); ?></p>
                                                    <div class="default-btn event-btns">See All Volunteer Spotlight
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="nav-slider-home">
                        <div class="slick-nav-slider">
                            <?php
                            foreach ($Banners as $key => $Banner) {
                                ?>
                                <div class="slide-content">
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
<?php endif; ?>

<section>
    <?php
    get_template_part('template-parts/content', 'upcoming-events', array('events' => get_events(12)));
    ?>
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

    <?php if ($speakers != null) { ?>
        <article class="speaker-list" style="display: none;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-24">
                        <h2><a href="<?php echo esc_url(get_permalink(203)); ?>">Speakers</a></h2>
                        <div class="speaker-more">
                            <a href="<?php echo esc_url(get_page_link(203)); ?>">
                                <span><?php echo esc_html($speakers_total_count); ?>+</span>
                                Talent Industry Experts</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p class="blue-text">We are gathering the world's leading and most inspired thinkers from
                            multiple disciplines to inspire your organization to build real-world solutions.</p>
                    </div>
                </div>
                <?php get_template_part('template-parts/content', 'speakers'); ?>
            </div>
        </article>
    <?php } ?>

    <?php get_template_part('template-parts/content', 'program-divisions'); ?>

    <article class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-15">
                    <div class="row">
                        <div class="volunteer">
                            <div class="row">
                                <div class="col-sm-24">
                                    <h2><a href="<?php echo esc_url(get_permalink(251)); ?>">Get Involved</a></h2>
                                </div>
                            </div>
                            <?php get_template_part('template-parts/content', 'get-involved-cards'); ?>
                        </div>
                    </div>

                    <?php get_template_part('template-parts/content', 'join-footer'); ?>
                </div>
                <div class="col-sm-8 offset-md-1 news">
                    <div class="row">
                        <div class="col-sm-24">
                            <h2><a href="http://news.mit.edu/" target="_blank">News</a></h2>
                        </div>
                        <div class="col-sm-24">
                            <ul class="blogs-list">
                                <?php GetHomePageNews(); ?>
                            </ul>
                            <a href="http://news.mit.edu/" target="_blank" class="view-btn gray">See All News <img
                                        src="<?php echo esc_url(get_asset_uri('/images/arrow_right_gray.svg')); ?>"
                                        alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>

<?php
get_footer();
?>
