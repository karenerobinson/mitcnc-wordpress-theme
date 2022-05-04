<?php

function isEventAvailable()
{
    $location_id = (isset($_REQUEST['location']) && !empty(strip_tags($_REQUEST['location'])) && is_numeric((int)strip_tags($_REQUEST['location']))) ? [(int)strip_tags($_REQUEST['location'])] : null;
    $program_id = (isset($_REQUEST['program']) && !empty(strip_tags($_REQUEST['program'])) && is_numeric((int)strip_tags($_REQUEST['program']))) ? [(int)strip_tags($_REQUEST['program'])] : null;
    $events = get_events(1, null, $location_id, $program_id);
    $output = ($events != null) ? true : false;
    echo json_encode($output);
    die();
}
add_action('wp_ajax_isEventAvailable', 'isEventAvailable');
add_action('wp_ajax_nopriv_isEventAvailable', 'isEventAvailable');

function update_slack_conversation()
{
    global $slack_host,
        $slack_conversation_history_end_point,
        $slack_user_details_end_point,
        $slack_date_from,
        $slack_date_to,
        $slack_limit,
        $user_info,
        $message;

    $channel_id = isset($_REQUEST['channel_id']) ? filter_var($_REQUEST['channel_id'], FILTER_SANITIZE_STRING) : '';

    if (!empty($channel_id)) {
        $response = slack_custom_curl("{$slack_host}{$slack_conversation_history_end_point}?channel={$channel_id}&oldest={$slack_date_from}&latest={$slack_date_to}&limit={$slack_limit}");
        $response = !empty($response) ? json_decode($response) : null;
        if (isset($response->messages) &&  null != $response->messages) {
            global $wpdb;
            foreach ($response->messages as $key => $message) {
                // get user details from DB
                $user_info = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}slack_users WHERE slack_user_id = '{$message->user}'");
                // if user not found in DB
                if ($user_info == null || !isset($user_info->slack_user_id)) {
                    // get user details from Slack
                    $user_info = slack_custom_curl("{$slack_host}{$slack_user_details_end_point}?user={$message->user}");
                    $user_info = !empty($user_info) ? json_decode($user_info) : null;
                    if ($user_info != null && isset($user_info->user->id)) {
                        // insert slack user details in DB
                        $user_info->slack_user_id = isset($user_info->user->id) ? $user_info->user->id : '';
                        $user_info->team_id = isset($user_info->user->team_id) ? $user_info->user->team_id : '';
                        $user_info->name = isset($user_info->user->name) ? $user_info->user->name : '';
                        $user_info->real_name = isset($user_info->user->real_name) ? $user_info->user->real_name : (isset($user_info->user->profile->real_name) ? $user_info->user->profile->real_name : '');
                        $user_info->image_48 = isset($user_info->user->profile->image_48) ? $user_info->user->profile->image_48 : '';
                        $wpdb->query(
                            "
                                INSERT INTO {$wpdb->prefix}slack_users (
                                    slack_user_id,
                                    team_id,
                                    name,
                                    real_name,
                                    image_48
                                ) VALUES (
                                    '" . str_replace(array("'", '"'), array("\'", '\"'), $user_info->slack_user_id) . "',
                                    '" . str_replace(array("'", '"'), array("\'", '\"'), $user_info->team_id) . "',
                                    '" . str_replace(array("'", '"'), array("\'", '\"'), $user_info->name) . "',
                                    '" . str_replace(array("'", '"'), array("\'", '\"'), $user_info->real_name) . "',
                                    '" . str_replace(array("'", '"'), array("\'", '\"'), $user_info->image_48) . "'
                                )
                            "
                        );
                    }
                        
                }
                get_template_part('template-parts/slack', 'conversation-loop');
            }
        }
    }
    die();
}
    add_action('wp_ajax_update_slack_conversation', 'update_slack_conversation');
    add_action('wp_ajax_nopriv_update_slack_conversation', 'update_slack_conversation');

function getIntroForEventReminder()
{
    $post_id = (isset($_POST['post_id'])) ? esc_html(strip_tags($_POST['post_id'])) : '';
    if (!empty($post_id)) {
        $zoom_link = get_field('event_zoom_link', $post_id);
        ?>
                <p>Dear ##First Name##,<p>
                <p>Thank you for registering for today's event, <?php echo get_the_title($post_id); ?>.</p>
                <p>Please join at <?php echo date('h:i A', strtotime(get_field('date_time_date_time_start', $post_id))); echo (!empty($zoom_link) ? ' via zoom: <a href="'.$zoom_link.'">'.$zoom_link.'</a>' : ''); ?></p>
                <p>We're looking forward to seeing you there!</p>
            <?php
    }
    die();
}
    add_action('wp_ajax_getIntroForEventReminder', 'getIntroForEventReminder');
    add_action('wp_ajax_nopriv_getIntroForEventReminder', 'getIntroForEventReminder');

function get_search_results_callback($search)
{
    global $assets_uri;
    $keyword = (isset($_POST['keyword'])) ? esc_html(strip_tags($_POST['keyword'])) : '';
    $users_html = '';
    $posts_html = '';
    if (!empty($keyword)) {
        $results = get_search_results($keyword);
        if ($results['count'] > 0) {
            if ($results['users'] != null) {
                foreach ($results['users'] as $key => $user) {
                    $user_img = get_field('profile_image', 'user_' . $user->ID);
                    $user_img = !empty($user_img) ? $user_img : $assets_uri . '/images/placeholder.png';
                    $user_mit_status = is_mit_alum($user->ID);
                    $first_name = get_field('full_name', 'user_' . $user->ID);
                    $last_name = get_field('user_last_name', 'user_' . $user->ID);
                    $affiliations_mit = array();
                    $affiliations_other = array();
                    $affiliations = get_field('affiliations', 'user_' . $user->ID);
                    if ($affiliations) {
                        foreach ($affiliations as $affiliation) {
                            if ($affiliation != null) {
                                $affiliation_count = count($affiliation);
                                for ($i = 0; $i < $affiliation_count; $i++) {
                                    if (isset($affiliation[$i]['mit_affiliation_title'])) {
                                        $affiliations_mit[] = $affiliation[$i]['mit_affiliation_title'];
                                    } else if (isset($affiliation[$i]['other_affiliation_title'])) {
                                        $affiliations_other[] = $affiliation[$i]['other_affiliation_title'];
                                    }
                                }
                            }
                        }
                    }
                    $whos = get_field('who_is_this_from', 'user_' . $user->ID);
                    ob_start();
                    ?>
                        <div data-team_member="<?php echo esc_html(strtolower(str_replace(array("'", '  '), array('', ' '), $first_name . ' ' . $last_name))); ?>" data-topic="" class="col-12 col-lg-12 col-md-8 col-sm-8 col-xl-8">
                            <div class="speaker-card">
                                <a href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>">
                                    <div class="card-img">
                                        <img src="<?php echo esc_url($user_img); ?>" alt="">
                                    <?php if ($user_mit_status) { ?>
                                            <div class="icon-mit">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                            </div>
                                    <?php } ?>
                                    </div>
                                    <div class="card-text">
                                        <div class="name">
                                            <h3><?php echo esc_html($first_name . ' ' . $last_name) ?></h3>
                                            <span class="code"><?php echo esc_html(($affiliations_mit != null) ? implode(', ', $affiliations_mit) : ''); ?></span>
                                        </div>
                                    <?php
                                    if ($whos != null) {
                                        for ($i = 0; $i < count($whos); $i++) {
                                            ?>
                                                <span class="tag"><?php echo ucfirst(str_replace(array('-', '_'), ' ', $whos[$i])); ?></span>
                                                <?php
                                                break; // remove this break if you want to show all of the tags
                                        }
                                    }
                                    ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                        $users_html .= ob_get_clean();
                }
            }
            if ($results['posts'] != null) {
                foreach ($results['posts'] as $key => $post) {
                    ob_start();
                    ?>
                        <li>
                            <span class="tag"><?php echo esc_html(ucfirst(str_replace('-', ' ', $post->post_type))); ?></span>
                            <h6><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo filter_var($post->post_title, FILTER_UNSAFE_RAW); ?></a></h6>
                            <span class="date"><?php echo esc_html(date('D, M j Y', strtotime(($post->post_type == 'events') ? get_field('date_time_date_time_start', $post->ID) : $post->post_date))); ?></span>
                        <?php if (!empty(strip_tags($post->post_content))) { ?>
                            <p><?php echo esc_html(substr(strip_tags(strip_shortcodes($post->post_content)), 0, 150)); ?>...</p>
                        <?php } ?>
                        </li>
                        <?php
                        $posts_html .= ob_get_clean();
                }
            }
        }
        $results['posts_html'] = trim($posts_html);
        $results['users_html'] = trim($users_html);
        echo json_encode($results);
    }
    die();
}
    add_action('wp_ajax_get_search_results_callback', 'get_search_results_callback');
    add_action('wp_ajax_nopriv_get_search_results_callback', 'get_search_results_callback');

function get_events_for_homepage_callback()
{
    get_template_part('template-parts/content', 'upcoming-events', array('events' => get_events(12)));
    die();
}
add_action('wp_ajax_get_events_for_homepage_callback', 'get_events_for_homepage_callback');
add_action('wp_ajax_nopriv_get_events_for_homepage_callback', 'get_events_for_homepage_callback');


function blog_area_for_homepage_callback()
{
    ?>
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
                            <? get_template_part('template-parts/content', 'get-involved-cards'); ?>
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
    <?php
    die();
}
add_action('wp_ajax_blog_area_for_homepage_callback', 'blog_area_for_homepage_callback');
add_action('wp_ajax_nopriv_blog_area_for_homepage_callback', 'blog_area_for_homepage_callback');
    
function banner_for_homepage_callback()
{
    $skyline_background_uri = get_asset_uri('/images/skyline.svg');
    $Banners = getHomeBanners();
    if (!empty($Banners) && is_array($Banners) && count($Banners) > 0) :
        ?>
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
                                                <p></p>
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
        <?php
    endif;
    die();
}
add_action('wp_ajax_banner_for_homepage_callback', 'banner_for_homepage_callback');
add_action('wp_ajax_nopriv_banner_for_homepage_callback', 'banner_for_homepage_callback');