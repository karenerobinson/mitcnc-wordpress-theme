<?php
    get_header();
    global $assets_uri, $post, $event_category_taxonomy, $event_location_taxonomy, $user_profile_page_id, $reserve_now_btn_text, $login_page_id;
    $meta_data = get_post_meta($post->ID);
    $banner = get_the_post_thumbnail_url($post->ID, 'thumbnail_1079_474');
    $event_type = wp_get_post_terms($post->ID, $event_category_taxonomy);
    $event_location = wp_get_post_terms($post->ID, $event_location_taxonomy);
    $start_on = (isset($meta_data['date_time_date_time_start'][0])) ? $meta_data['date_time_date_time_start'][0] : '';
    $end_on = (isset($meta_data['date_time_date_time_end'][0])) ? $meta_data['date_time_date_time_end'][0] : '';
    $start_on_date = date('l, F d, Y', strtotime($start_on));
    $end_on_date = date('l, F d, Y', strtotime($end_on));
    $start_on_time = date('h:i A', strtotime($start_on));
    $end_on_time = date('h:i A', strtotime($end_on));
    $upcoming_events = get_events(
        10,
        null,
        null,
        null,
        array($post->ID)
    );
    $event_address = (isset($meta_data['location_address'][0])) ? $meta_data['location_address'][0] : '';
    $event_address_1 = (isset($meta_data['location_address_1'][0])) ? $meta_data['location_address_1'][0] : '';
    $event_address_2 = (isset($meta_data['location_address_2'][0])) ? $meta_data['location_address_2'][0] : '';
    $event_address_city = get_field('location_city', $post->ID);
    $event_address_state = get_field('location_state', $post->ID);
    $event_address_postal_code = (isset($meta_data['location_postal_code'][0])) ? $meta_data['location_postal_code'][0] : '';
    $event_map = (isset($meta_data['location_location_map'][0])) ? $meta_data['location_location_map'][0] : '';
    $primary_contact = array(
        'name' => (isset($meta_data['contact_persons_contact_persons_primary_contact_persons_primary_name'][0])) ? $meta_data['contact_persons_contact_persons_primary_contact_persons_primary_name'][0] : '',
        'email' => (isset($meta_data['contact_persons_contact_persons_primary_contact_persons_primary_email'][0])) ? $meta_data['contact_persons_contact_persons_primary_contact_persons_primary_email'][0] : '',
    );
    $secondary_contact = array(
        'name' => (isset($meta_data['contact_persons_contact_persons_secondary_contact_persons_secondary_name'][0])) ? $meta_data['contact_persons_contact_persons_secondary_contact_persons_secondary_name'][0] : '',
        'email' => (isset($meta_data['contact_persons_contact_persons_secondary_contact_persons_secondary_email'][0])) ? $meta_data['contact_persons_contact_persons_secondary_contact_persons_secondary_email'][0] : '',
    );
    $sold_out_flag = (isset($meta_data['sold_out'][0])) ? $meta_data['sold_out'][0] : false;
    $banner_color = (isset($meta_data['banner_background_color'][0])) ? $meta_data['banner_background_color'][0] : '';
    $reserve_now_btn_text = (isset($meta_data['registration_3_reservation_text'][0]) && !empty($meta_data['registration_3_reservation_text'][0])) ? $meta_data['registration_3_reservation_text'][0] : 'Reserve Now';
    $specific_event = true;

    $platinum_sponsor = get_field('platinum_sponsor_platinum_details', $post->ID);
    $gold_sponsor = get_field('gold_sponsor_gold_details', $post->ID);

    $after_content = get_field('after_content', $post->ID);
    ?>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130796301-2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-130796301-2');
    </script>
    <section>
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
            <article class="inner-page event-banner-section">
                <div class="container event-banner-container">
                    <div class="row">
                        <div class="col-lg-18 col-md-16 col-sm-24 yearly-events top-btn" >
                            <ul>
                                <li> <a href="<?php echo esc_url(get_permalink(7047)); ?>">Healthcare & Medicine</a> </li>
                                <li > <a href="#panels">Panels and Speakers</a> </li>
                                <li>  <a href="<?php echo esc_url(get_permalink(7806)); ?>">Startups</a> </li>
                                <li> <a href="<?php echo esc_url(get_permalink(7818)); ?>">Sponsors</a> </li>
                            </ul>
                        </div>    
                        <div class="col-lg-6 col-md-8 col-sm-24 top-btn Livestream-btn">
                            <ul>
                                <li> <a class="default-btn purple-btn" href="<?php echo esc_url(get_permalink(7854)); ?>">Agenda</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-24 evb-col">
                            <div class="event-banner <?php echo !empty($banner) ? '' : 'no-img'; ?>"
                                 style="<?php echo !empty($banner) ? 'background-image: url(' . esc_attr($banner) . ')' : 'background-color: ' . esc_attr($banner_color); ?>">
                                <div class="event-info mit-event">
                                    <div class="event-tag">
                                        <?php echo (isset($event_type[0])) ? esc_html($event_type[0]->name) : ''; ?>
                                    </div>
                                    <div class="event-title">
                                        <?php echo esc_html($post->post_title); ?>
                                    </div>
                                    <div class="event-date-loc" style="color: #ffffff;">
                                        <?php echo esc_html(date('M d', strtotime($start_on))); ?><?php echo (isset($event_location[0])) ? ' - ' . esc_html($event_location[0]->name) : ''; ?>
                                    </div>
                                </div>
                              
                            </div>
                            <div class="static-registration-bar">
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="event-name">
                                            <?php echo esc_html($post->post_title); ?>
                                        </div>
                                        <div class="event-date-time">
                                            <?php echo esc_html(date('M d', strtotime($start_on))); ?><?php echo (isset($event_location[0])) ? ' - ' . esc_html($event_location[0]->name) : ''; ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 text-right">
                                        <div class="event-reg-btn">
                                            <?php if (strtotime($end_on) < time()) { ?>
                                                <a href="javascript:void(0);" class="default-btn disabled ">Event
                                                    Closed<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                            <?php } else if ($sold_out_flag) { ?>
                                                <a href="javascript:void(0);" class="default-btn disabled">Sold Out<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                            <?php } else { ?>
                                                <?php if (isset($meta_data['registration_3_affiliate_reservation_link']) && count($meta_data['registration_3_affiliate_reservation_link']) > 0 && !empty($meta_data['registration_3_affiliate_reservation_link'][0])) : ?>
                                                    <a href="<?php echo esc_attr($meta_data['registration_3_affiliate_reservation_link'][0]); ?>" class="default-btn purple-btn">Reserve Now<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                <?php else : ?>
                                                    <a href="#section--registration" class="default-btn purple-btn">Reserve Now<img
                                                                src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                                alt=""></a>
                                                <?php endif; ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-15">
                            <?php echo filter_var(wpautop($post->post_content), FILTER_UNSAFE_RAW); ?>
                        </div>
                        <div class="col-sm-7 offset-sm-2">
                            <div class="event-reserve">
                                <?php if (strtotime($end_on) < time()) { ?>
                                    <a href="javascript:void(0);" class="default-btn disabled mb20">Event Closed<img
                                                src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                alt=""></a>
                                <?php } else if ($sold_out_flag) { ?>
                                    <a href="javascript:void(0);" class="default-btn disabled mb20">Sold Out<img
                                                src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                alt=""></a>
                                <?php } else { ?>
                                    <?php if (isset($meta_data['registration_3_affiliate_reservation_link']) && count($meta_data['registration_3_affiliate_reservation_link']) > 0 && !empty($meta_data['registration_3_affiliate_reservation_link'][0])) : ?>
                                        <a href="<?php echo esc_attr($meta_data['registration_3_affiliate_reservation_link'][0]); ?>" target="_blank" class="default-btn mb20 purple-btn">Reserve Now<img
                                                src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                alt=""></a>
                                    <?php else : ?>
                                    <a href="#section--registration" class="default-btn mb20 purple-btn">Reserve Now<img
                                                src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                alt=""></a>
                                    <?php endif; ?>
                                <?php } ?>
                                <p>
                                    <b class="uppercase-font">Date and Time</b><br>
                                    <?php echo esc_html($start_on_date); ?> <?php echo ($start_on_date != $end_on_date) ? ' - ' . esc_html($end_on_date) : ''; ?>
                                    <br>
                                    <?php echo esc_html($start_on_time); ?> - <?php echo esc_html($end_on_time); ?> PT<br>
                                     <a target="_blank" href="<?php echo esc_url(get_permalink(2476)) . '?event_id=' . esc_html($post->ID); ?>" class="link">
                                        Add to Calendar
                                    </a>
                                </p>

                                <?php if (isset($meta_data['agenda'][0]) && $meta_data['agenda'][0] > 0) { ?>
                                    <p>
                                        <b class="uppercase-font">Agenda</b><br>
                                        <?php for ($i = 0; $i < $meta_data['agenda'][0]; $i++) { ?>
                                            <span  style="display: block;">
                                        <b><?php echo esc_html($meta_data['agenda_' . $i . '_agenda_title'][0]); ?></b>
                                                <?php echo '<br>'; ?>
                                                <?php echo esc_html(date('h:i A', strtotime($meta_data['agenda_' . $i . '_agenda_from'][0]))); ?>
                                                - <?php echo esc_html(date('h:i A', strtotime($meta_data['agenda_' . $i . '_agenda_to'][0]))); ?>
                                    </span>
                                        <?php } ?>
                                    </p>
                                <?php } ?>

                                <p>
                                    <b class="uppercase-font">Location</b><br>
                                    <?php echo !empty($event_address) ? '<b>' . esc_html($event_address) . '</b><br>' : ''; ?>

                                    <?php echo !empty($event_address_1) ? esc_html($event_address_1) . '<br>' : ''; ?>

                                    <?php echo !empty($event_address_2) ? esc_html($event_address_2) . '<br>' : ''; ?>


                                    <?php
                                    if (isset($event_address_city['label']) && !empty($event_address_city['label'])) {
                                        echo esc_html($event_address_city['label']);
                                    }
                                    if (isset($event_address_city['label']) && !empty($event_address_city['label']) && !empty($event_address_state)) {
                                        echo ', ';
                                    }
                                    if (!empty($event_address_state)) {
                                        echo esc_html($event_address_state);
                                    }
                                    if (!empty($event_address_state) && !empty($event_address_postal_code)) {
                                        echo ', ';
                                    }
                                    if (!empty($event_address_postal_code)) {
                                        echo esc_html($event_address_postal_code);
                                    }
                                    if (
                                            isset($event_address_city['label']) ||
                                            !empty($event_address_city['label']) ||
                                            !empty($event_address_state) ||
                                            !empty($event_address_postal_code)
                                    ) {
                                        echo '<br>';
                                    }
                                    ?>

                                    <?php if (!empty($event_map)) { ?>
                                        <a href="#map-container">View Map</a>
                                    <?php } ?>
                                </p>

                                <?php if (null != $platinum_sponsor) { ?>
                                    <p>
                                        <b>Platinum Sponsors</b><br>
                                                <?php
                                                foreach ($platinum_sponsor as $platinum) {
                                                    ?>
                                        <b>
                                            <a style="color: #A31F34" href="<?php echo esc_url($platinum['link']); ?>"><?php echo esc_html($platinum['title']); ?></a>
                                        </b><br>

                                                <?php } ?>
                                    </p>
                                <?php } ?>

                                <?php if (null != $gold_sponsor) { ?>
                                    <p>
                                        <b>Gold Sponsors</b><br>
                                                <?php
                                                foreach ($gold_sponsor as $gold) {
                                                    ?>
                                        <b>
                                            <a style="color: #A31F34;" href="<?php echo esc_url($gold['link']); ?>"><?php echo esc_html($gold['title']); ?></a>
                                        </b><br>
                                                <?php } ?>
                                    </p>
                                <?php } ?>

                                            <?php
                                            if (have_rows('contact_persons')) {
                                                while (have_rows('contact_persons')) {
                                                    the_row();
                                                    if (have_rows('primary')) {
                                                        ?>
                                                    <p>
                                                        <b class="uppercase-font">Primary Contact</b><br>
                                                                <?php
                                                                while (have_rows('primary')) {
                                                                    the_row();
                                                                    echo esc_html(get_sub_field('name'));
                                                                    echo '<br>';
                                                                    echo '<a class="link" href="mailto:' . esc_html(get_sub_field('email')) . '">' . esc_html(get_sub_field('email')) . '</a>';
                                                                    echo '<br>';
                                                                }
                                                                ?>
                                                    </p>
                                                            <?php
                                                    }
                                                }
                                            }
                                            ?>

                                            

                                <?php
                                if (
                                    (isset($secondary_contact['name']) && !empty($secondary_contact['name'])) ||
                                    (isset($secondary_contact['email']) && !empty($secondary_contact['email']))
                                ) {
                                    ?>
                                    <p>
                                        <b class="uppercase-font">Secondary Contact</b><br>
                                        <?php echo (!empty($secondary_contact['name'])) ? esc_html($secondary_contact['name']) . '<br>' : ''; ?>
                                        <?php echo (!empty($secondary_contact['email'])) ? '<a href="mailto:' . esc_attr($secondary_contact['email']) . '">' . esc_html($secondary_contact['email']) . '</a>' : ''; ?>
                                    </p>
                                    <?php
                                }
                                ?>
                                <div class="calendar-page-link">
                                    <a href="<?php bloginfo('url'); ?>/calendar">
                                        <i class="calendar-icon">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/icons/calendar-icon.svg" alt="">
                                        </i>

                                        <span>
                                            Subscribe to our
                                            <strong>events calendar</strong>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                    
                 
                    <!-- SPEAKERS LIST 2 START -->
                            
                    
                        <div class="row">
                           
                            <div class="col-sm-24">
                                <h2 id="panels">Panels and Speakers</h2>
                                <div class="" style="position: relative;">
                                    <?php global $event_topics_taxonomy; ?>
                                    <?php if (!empty($event_topics_taxonomy)) : ?>
                                        <?php $topics = get_terms($event_topics_taxonomy, array('hide_empty' => false, 'parent' => 119)); ?>
                                        <?php if (count($topics) > 0) : ?>
                                        <div id="topics">
                                           
                                            <?php
                                            foreach ($topics as $topic) :
                                                $topic_banner = get_field('topic_banner', $topic);
                                                $speakers_ids = get_field('speakers_list', $topic);
                                                if ($speakers_ids != null) {
                                                    $speakers = get_users_by_type('speakers',  '',  false, '',  false,  'DESC',  $speakers_ids,  null, $topic->term_id);
                                                } else {
                                                    $speakers = null;
                                                }
                                                $topic_start_time = get_field('topic_start_time', $topic);
                                                $topic_close_time = get_field('topic_close_time', $topic);
                                                $topic_logo = get_field('topic_logo', $topic);
                                                ?>
                                                <div class="conference-topic" style="background-image: url('<?php echo esc_attr($topic_banner); ?>');">
                                                    <h3><?php echo esc_html($topic->name); ?></h3>
                                                    <p><?php echo esc_html($topic->description); ?></p>
                                                    <?php if (!empty($topic_start_time) && !empty($topic_close_time)) { ?>
                                                    <p><?php echo esc_html("{$topic_start_time} - {$topic_close_time}"); ?></p>
                                                        <?php
                                                    }
                                                    ?>
                                                    <img class="topic-logo" src="<?php echo esc_attr($topic_logo); ?>">
                                                </div>
                                                <div class="row speaker-container users_list">
                                                    <?php get_template_part('template-parts/content', 'speakers'); ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <div>        
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-24">
                            <a href="<?php echo esc_url(get_permalink(7818)); ?>" target="_blank">
                                <div class="page-idol-link-2020"> 
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-24">
                            <a href="<?php echo esc_url(get_permalink(7806)); ?>" target="_blank">
                                <div class="page-awards-link-2020"> 
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="container">
                    
                                <?php
                                $layout = (isset($meta_data['registration_3_mit_alum'][0]) && $meta_data['registration_3_mit_alum'][0] > 1) ? 'row' : 'column';
                                get_template_part('template-parts/singular/content', 'registration-sso');
                                ?>
                                <?php
                                if (isset($meta_data['media_gallery'][0]) && !empty($meta_data['media_gallery'][0])) {
                                    $meta_data['media_gallery'][0] = is_serialized($meta_data['media_gallery'][0]) ? unserialize($meta_data['media_gallery'][0]) : array($meta_data['media_gallery'][0]);
                                    if (null != $meta_data['media_gallery'][0] && count($meta_data['media_gallery'][0]) > 0) {
                                        $has_photos = false;
                                        $has_videos = false;
                                        // set settings for heading and rows
                                        $meta_data_media_galery_count = count($meta_data['media_gallery'][0]);
                                        for ($i = 0; $i < $meta_data_media_galery_count; $i++) {
                                            $event_gallery = get_post($meta_data['media_gallery'][0][$i]);
                                            if (null != $event_gallery) {
                                                if (!empty($event_gallery->post_content)) {
                                                    $has_photos = true;
                                                }
                                                if (have_rows('videos', $event_gallery->ID)) {
                                                    $has_videos = true;
                                                }
                                            }
                                        }
                                        // print photos and videos
                                        if ($has_photos) {
                                            ?>
                                <hr class="mb60 mt60">
                                <div class="row" id="past_gallery">
                                    <div class="col-sm-24 mb30">
                                        <h2 class="purple">Event Gallery</h2>
                                    </div>
                                </div>
                                <div class="row mb60">
                                    <div class="col-sm-24" id="gallery_wrapper">
                                                    <?php
                                                    $mediagalery_count = count($meta_data['media_gallery'][0]);
                                                    for ($i = 0; $i < $mediagalery_count; $i++) {
                                                        $event_gallery = get_post($meta_data['media_gallery'][0][$i]);
                                                        if (null != $event_gallery) {
                                                            if (!empty($event_gallery->post_content)) {
                                                                echo do_shortcode($event_gallery->post_content);
                                                            }
                                                        }
                                                    }
                                                    ?>
                                    </div>
                                </div>
                                            <?php
                                        }
                                        if ($has_videos) {
                                            ?>
                                <hr class="mb60 mt60">
                                <div class="row">
                                    <div class="col-sm-24 mb30">
                                        <h2 class="purple">Watch</h2>
                                    </div>
                                </div>
                                <div class="row mb60">
                                                <?php
                                                $media_galery_count = count($meta_data['media_gallery'][0]);
                                                for ($i = 0; $i < $media_galery_count; $i++) {
                                                    $event_gallery = get_post($meta_data['media_gallery'][0][$i]);
                                                    if (null != $event_gallery) {
                                                        if (have_rows('videos', $event_gallery->ID)) {
                                                            $video_count = get_post_meta($event_gallery->ID, 'videos', true);
                                                            $inn = 1;
                                                            while (have_rows('videos', $event_gallery->ID)) {
                                                                the_row();
                                                                $video_url = get_sub_field('url', $event_gallery->ID);
                                                                $video_thumbnail = get_sub_field('thumbnail', $event_gallery->ID);
                                                                $video_title = get_sub_field('title', $event_gallery->ID);
                                                                ?>
                                                    <div class="col-sm-8">
                                                        <a data-fancybox="gallery-video" href="<?php echo esc_url($video_url); ?>"
                                                           class="media-card">
                                                            <div class="media-img">
                                                                <img src="<?php echo esc_url($video_thumbnail); ?>" alt="">
                                                            </div>
                                                            <div class="media-content">
                                                                <div class="media-icon-container">
                                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/play-icon.png" alt="">
                                                                </div>
                                                                <h6 class="white-text">
                                                                    <span class="date"><?php echo esc_html($start_on_date); ?></span>
                                                                    <?php
                                                                    if (!empty($video_title)) {
                                                                        echo esc_html($video_title);
                                                                    } else {
                                                                        echo esc_html($post->post_title);
                                                                        if ($video_count > 1) {
                                                                            echo ' - Part ' . esc_html($inn);
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
                                                }
                                                ?>
                                </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                </div> 
                   
                <div class="container">
                    <?php
                    if (!empty($event_map)) {
                        ?>
                        <div class="row event-map" id="map-container">
                            <div class="col-sm-24 mt60">
                                <div class="map-area">
                                    <?php echo filter_var($event_map, FILTER_UNSAFE_RAW); ?>
                                </div>
                                <div class="map-details">
                                    <p><?php echo esc_html($post->post_title); ?>
                                        <small>at</small>
                                        <?php echo esc_html($event_address); ?>
                                        <small><?php echo esc_html($event_address_1); ?></small>
                                        <?php if (!empty($event_address_2)) { ?>
                                            <small><?php echo esc_html($event_address_2); ?></small>
                                        <?php } ?>

                                        <small style="display: inline;">
                                            <?php
                                            if (isset($event_address_city['label']) && !empty($event_address_city['label'])) {
                                                echo esc_html($event_address_city['label']);
                                            }
                                            if (isset($event_address_city['label']) && !empty($event_address_city['label']) && !empty($event_address_state)) {
                                                echo ', ';
                                            }
                                            if (!empty($event_address_state)) {
                                                echo esc_html($event_address_state);
                                            }
                                            if (!empty($event_address_state) && !empty($event_address_postal_code)) {
                                                echo ', ';
                                            }
                                            if (!empty($event_address_postal_code)) {
                                                 echo esc_html($event_address_postal_code);
                                            }
                                            ?>
                                        </small>

                                    </p>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/by-car-icon.jpg" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/by-walk-icon.jpg" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/by-bus-icon.jpg" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/by-cycle-icon.jpg" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
               
                            <?php get_template_part('template-parts/content', 'upcoming-events'); ?>
            </article>
                    <?php
            endwhile;
        endif;
        ?>
    </section>
<?php
get_footer();
