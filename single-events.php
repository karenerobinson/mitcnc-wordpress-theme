<?php
    get_header();
    global $assets_uri,
        $post,
        $event_category_taxonomy,
        $event_location_taxonomy,
        $user_profile_page_id,
        $login_page_id,
        $layout,
        $reserve_now_btn_text,
        $speakers_view_in,
        $moderators_view_in,
        $organizers_view_in;
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

    $speakers_view_in = (isset($meta_data['speakers_view_in'][0]) && !empty($meta_data['speakers_view_in'][0])) ? $meta_data['speakers_view_in'][0] : 'both';
    $speakers = (isset($meta_data['speakers_list'][0]) && !empty($meta_data['speakers_list'][0])) ? unserialize($meta_data['speakers_list'][0]) : null;
    $speakers_ids = '';
    $speakers_casting = null;
    if (!empty($speakers)) {
        $speakers_ids = implode(',', $speakers);
        foreach ($speakers as $speaker) {
            $speakers_casting[] = (object) array('ID' => $speaker);
        }
        $speakers = $speakers_casting;
    }

    $moderators_view_in = (isset($meta_data['moderators_view_in'][0]) && !empty($meta_data['moderators_view_in'][0])) ? $meta_data['moderators_view_in'][0] : 'both';
    $moderators = (isset($meta_data['moderators_list'][0]) && !empty($meta_data['moderators_list'][0])) ? unserialize($meta_data['moderators_list'][0]) : null;
    $moderators_ids = '';
    $moderators_casting = null;
    if (!empty($moderators)) {
        $moderators_ids = implode(',', $moderators);
        foreach ($moderators as $moderator) {
            $moderators_casting[] = (object) array('ID' => $moderator);
        }
        $moderators = $moderators_casting;
    }

    $organizers_view_in = (isset($meta_data['organizers_view_in'][0]) && !empty($meta_data['organizers_view_in'][0])) ? $meta_data['organizers_view_in'][0] : 'both';
    $organizers = (isset($meta_data['organizers_list'][0]) && !empty($meta_data['organizers_list'][0])) ? unserialize($meta_data['organizers_list'][0]) : null;
    $organizers_ids = '';
    $organizers_casting = null;
    if (!empty($organizers)) {
        $organizers_ids = implode(',', $organizers);
        foreach ($organizers as $organizer) {
            $organizers_casting[] = (object) array('ID' => $organizer);
        }
        $organizers = $organizers_casting;
    }

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
    $platinum_sponsor = get_field('platinum_sponsor_platinum_details', $post->ID);
    $gold_sponsor = get_field('gold_sponsor_gold_details', $post->ID);
    $after_content = get_field('after_content', $post->ID);
    $reserve_now_btn_text = (isset($meta_data['registration_3_reservation_text'][0]) && !empty($meta_data['registration_3_reservation_text'][0])) ? $meta_data['registration_3_reservation_text'][0] : 'Reserve Now';
    ?>
    <section>
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
            <article class="inner-page event-banner-section">
                <div class="container event-banner-container">
                    <div class="row">
                        <?php
                        if (1955 == $post->ID || 2576 == $post->ID) {
                                get_template_part('template-parts/yearly', 'event-links');
                        }
                        ?>
                        <div class="col-sm-24 evb-col">
                            <div class="event-banner <?php echo !empty($banner) ? '' : 'no-img'; ?>"
                                 style="<?php echo !empty($banner) ? 'background-image: url(' . esc_url($banner) . ')' : 'background-color: ' . esc_url($banner_color); ?>">
                                <div class="event-info mit-event">
                                    <?php
                                        $track_content  = get_field('track_details_track_content', $post->ID);
                                        $track_color    = get_field('track_details_track_color', $post->ID);
                                    ?>
                                    <?php if (!empty($track_content)) { ?>
                                        <div class="mit-track-details">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/logo.svg" alt="">
                                            
                                            <h3 style="color: <?php echo esc_attr($track_color); ?>;">
                                                <?php echo esc_html($track_content); ?>
                                            </h3>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="event-tag" style="background-color: <?php echo isset($event_type[0]->term_id) ? esc_attr(get_term_meta($event_type[0]->term_id, 'color_type', true)) : '#FFB303'; ?>">
                                        <?php echo (isset($event_type[0])) ? esc_html($event_type[0]->name) : ''; ?>
                                    </div>
                                    <div class="event-title">
                                        <?php echo filter_var($post->post_title, FILTER_UNSAFE_RAW); ?>
                                    </div>
                                    <?php
                                    if (isset($meta_data['series_of_sessions'][0]) && $meta_data['series_of_sessions'][0] > 0) {
                                        for ($i = 0; $i < $meta_data['series_of_sessions'][0]; $i++) {
                                            ?>
                                            <div class="event-date-loc" style="color: #ffffff;">
                                                <?php
                                                    echo esc_html(date('M d', strtotime($meta_data['series_of_sessions_' . $i . '_session_date'][0])));
                                                    echo !empty($meta_data['series_of_sessions_' . $i . '_session_title'][0]) ? ' - ' . esc_html($meta_data['series_of_sessions_' . $i . '_session_title'][0]) : '';
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="event-date-loc" style="color: #ffffff;">
                                            <?php echo esc_html(date('M d', strtotime($start_on))); ?><?php echo (isset($event_location[0])) ? ' - ' . esc_html($event_location[0]->name) : ''; ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 offset-sm-12">
                                        <ul class="banner-speakers">
                                            <?php
                                            if (null != $speakers && in_array($speakers_view_in, array('banner', 'both'))) {
                                                $is_large_speaker = (count($speakers) == 1 && (null == $moderators || $moderators_view_in == 'inside-page') && (null == $organizers || $organizers_view_in == 'inside-page')) ? true : false;
                                                banner_speakers($speakers, $is_large_speaker, false);
                                            }
                                            if (null != $moderators && in_array($moderators_view_in, array('banner', 'both'))) {
                                                $is_large_moderator = (count($moderators) == 1 && (null == $speakers || $speakers_view_in == 'inside-page') && (null == $organizers || $organizers_view_in == 'inside-page')) ? true : false;
                                                banner_speakers($moderators, $is_large_moderator, true);
                                            }
                                            if (null != $organizers && in_array($organizers_view_in, array('banner', 'both'))) {
                                                $is_large_organizer = (count($organizers) == 1 && (null == $speakers || $speakers_view_in == 'inside-page') && (null == $moderators || $moderators_view_in == 'inside-page')) ? true : false;
                                                banner_speakers($organizers, $is_large_organizer, false, true);
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="static-registration-bar">
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="event-name">
                                            <?php echo filter_var($post->post_title, FILTER_UNSAFE_RAW); ?>
                                        </div>
                                        <div class="event-date-time">
                                            <?php echo esc_html(date('M d', strtotime($start_on))); ?><?php echo (isset($event_location[0])) ? ' - ' . esc_html($event_location[0]->name) : ''; ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 text-right">
                                        <div class="event-reg-btn">
                                            <?php /* This will generate the reservation link and it also contains the conditions */ ?>
                                            <?php get_reservation_button($end_on, $sold_out_flag, $reserve_now_btn_text, $meta_data); ?>
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
                                <?php /* This will generate the reservation link and it also contains the conditions */ ?>
                                <?php get_reservation_button($end_on, $sold_out_flag, $reserve_now_btn_text, $meta_data, 'mb20'); ?>
                                <p>
                                    <b class="uppercase-font">Date and Time</b><br>
                                    <?php echo esc_html($start_on_date); ?> <?php echo ($start_on_date != $end_on_date) ? ' - ' . esc_html($end_on_date) : ''; ?>
                                    <br>
                                    <?php echo esc_html($start_on_time); ?> - <?php echo esc_html($end_on_time); ?> PT<br>
                                     <a target="_blank" href="<?php echo esc_url(get_permalink(2476)) . '?event_id=' . esc_html($post->ID); ?>" class="">
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
                                    <?php if (!empty($event_address) || !empty($event_address_1) || !empty($event_address_2)) { ?>
                                        <b class="uppercase-font">Location</b><br>
                                        <?php
                                            echo !empty($event_address) ? '<b>' . esc_html($event_address) . '</b><br>' : '';
                                        ?>
                                        <?php
                                            echo !empty($event_address_1) ? esc_html($event_address_1) . '<br>' : '';
                                        ?>
                                        <?php
                                            echo !empty($event_address_2) ? esc_html($event_address_2) . '<br>' : '';
                                        ?>
                                    <?php } ?>


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
                                                <p style="line-height: 130%;">
                                                    <b class="uppercase-font">Primary Contact</b><br>
                                                    <?php
                                                    while (have_rows('primary')) {
                                                        the_row();
                                                        $p_affiliate = get_sub_field('affiliate');
                                                        $p_name = get_sub_field('name');
                                                        $p_email = get_sub_field('email');
                                                        echo !empty($p_affiliate) ? esc_html($p_affiliate) . '<br>' : '';
                                                        echo !empty($p_name) ? '<span>' . esc_html(get_sub_field('name')) . '</span><br>' : '';
                                                        echo !empty($p_email) ? '<a href="mailto:' . esc_attr($p_email) . '">' . esc_html($p_email) . '</a>' : '';
                                                    }
                                                    ?>
                                                </p>
                                            <?php
                                        }
                                    }
                                }
                                if (
                                    (isset($secondary_contact['name']) && !empty($secondary_contact['name'])) ||
                                    (isset($secondary_contact['email']) && !empty($secondary_contact['email']))
                                ) {
                                    ?>
                                    <p>
                                        <b class="uppercase-font">Secondary Contact</b><br>
                                        <?php echo (!empty($secondary_contact['name'])) ? esc_html($secondary_contact['name']) . '<br>' : ''; ?>
                                        <?php echo (!empty($secondary_contact['email'])) ? '<a href="mailto:' . filter_var($secondary_contact['email'], FILTER_SANITIZE_EMAIL) . '">' . filter_var($secondary_contact['email'], FILTER_SANITIZE_EMAIL) . '</a>' : ''; ?>
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
                    <?php
                    if (!empty($after_content)) {
                        ?>
                        <div class="row mt30">
                            <div class="col-sm-24">
                                <?php echo filter_var(wpautop($after_content), FILTER_UNSAFE_RAW); ?>
                            </div>
                         
                        </div>
                    <?php } ?>
                    <?php
                    if (
                        (
                            null != $speakers ||
                            null != $moderators ||
                            null != $organizers
                        ) &&
                        (
                            in_array($speakers_view_in, array('inside-page', 'both')) ||
                            in_array($moderators_view_in, array('inside-page', 'both')) ||
                            in_array($organizers_view_in, array('inside-page', 'both'))
                        )
                    ) {
                        $speaker_count = (null != $speakers) ? count($speakers) : 0;
                        $moderator_count = (null != $moderators) ? count($moderators) : 0;
                        $organizer_count = (null != $organizers) ? count($organizers) : 0;
                        ?>
                        <div class="row">
                            <div class="col-sm-24">
                                <h2>Speaker<?php echo ($speaker_count > 1 || $moderator_count > 1) ? 's' : ''; ?></h2>
                            </div>
                        </div>
                    <?php } ?>
                    <?php get_template_part('template-parts/content', 'speakers'); ?>
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
                            $gallery_count = count($meta_data['media_gallery'][0]);
                            for ($i = 0; $i < $gallery_count; $i++) {
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
                            if ($has_photos) {
                                ?>
                                <hr class="mb60 mt60">
                                <div class="row">
                                    <div class="col-sm-24 mb30">
                                        <h2>Event Gallery</h2>
                                    </div>
                                </div>
                                <div class="row mb60">
                                    <div class="col-sm-24" id="gallery_wrapper">
                                        <?php
                                            $gallery_count = count($meta_data['media_gallery'][0]);
                                        for ($i = 0; $i < $gallery_count; $i++) {
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
                                        <h2>Watch</h2>
                                    </div>
                                </div>
                                <div class="row mb60">
                                    <?php
                                    $media_gallery_count = count($meta_data['media_gallery'][0]);
                                    for ($i = 0; $i < $media_gallery_count; $i++) {
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
                                                                        echo filter_var($post->post_title, FILTER_UNSAFE_RAW);
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
                    if (!empty($event_map)) {
                        ?>
                        <div class="row event-map" id="map-container">
                            <div class="col-sm-24 mt60">
                                <div class="map-area">
                                    <?php echo filter_var(wpautop($event_map), FILTER_UNSAFE_RAW); ?>
                                </div>
                                <div class="map-details">
                                    <p><?php echo filter_var(wpautop($post->post_title), FILTER_UNSAFE_RAW); ?>
                                        <small>at</small>
                                        <?php echo filter_var(wpautop($event_address), FILTER_UNSAFE_RAW); ?>
                                        <small><?php echo filter_var(wpautop($event_address_1), FILTER_UNSAFE_RAW); ?></small>
                                        <?php
                                        if (!empty($event_address_2)) {
                                            ?>
                                            <small><?php echo filter_var(wpautop($event_address_2), FILTER_UNSAFE_RAW); ?></small>
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
                        <?php
                    }
                    get_template_part('template-parts/content', 'upcoming-events');
                    ?>
                </div>
            </article>
                <?php
            endwhile;
        endif;
        ?>
    </section>
<?php
get_footer();
