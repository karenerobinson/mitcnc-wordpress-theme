<?php
    /* Template Name: AI Influencer Awards form 2020 */
    get_header();
    global $assets_uri, $event_category_taxonomy, $event_location_taxonomy, $user_profile_page_id, $specific_event;
    $eventObject = get_post(4604);
if (isset($eventObject->ID)) {
    $meta_data = get_post_meta($eventObject->ID);
    $banner = get_the_post_thumbnail_url(6167, 'thumbnail_1079_474');
    $event_type = wp_get_post_terms($eventObject->ID, $event_category_taxonomy);
    $event_location = wp_get_post_terms($eventObject->ID, $event_location_taxonomy);
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
        array($eventObject->ID)
    );

    $moderators = (isset($meta_data['moderators_list'][0]) && !empty($meta_data['moderators_list'][0])) ? unserialize($meta_data['moderators_list'][0]) : null;
    $moderators_ids = '';
    $moderators_casting = null;
    if (null != $moderators) {
        $moderators_ids = implode(',', $moderators);
        foreach ($moderators as $moderator) {
            $moderators_casting[] = (object) array('ID' => $moderator);
        }
        $moderators = $moderators_casting;
    }

    $reservation_link = (isset($meta_data['reservation_link'][0])) ? $meta_data['reservation_link'][0] : '';
    $event_address = (isset($meta_data['location_address'][0])) ? $meta_data['location_address'][0] : '';
    $event_address_1 = (isset($meta_data['location_address_1'][0])) ? $meta_data['location_address_1'][0] : '';
    $event_address_2 = (isset($meta_data['location_address_2'][0])) ? $meta_data['location_address_2'][0] : '';
    $event_address_city = get_field('location_city', $eventObject->ID);
    $event_address_state = get_field('location_state', $eventObject->ID);
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
    $mit_registration = array(
        'link' => (isset($meta_data['registration_2_mit_link'][0])) ? $meta_data['registration_2_mit_link'][0] : '',
        'details' => array(),
    );
    $non_mit_registration = array(
        'link' => (isset($meta_data['registration_2_non_mit'][0])) ? $meta_data['registration_2_non_mit'][0] : '',
        'details' => array(),
        'embed_widget' => (isset($meta_data['registration_2_non_mit_embed_widget'][0])) ? $meta_data['registration_2_non_mit_embed_widget'][0] : '',
    );
        
    $sold_out_flag = (isset($meta_data['sold_out'][0])) ? $meta_data['sold_out'][0] : false;
    $banner_color = (isset($meta_data['banner_background_color'][0])) ? $meta_data['banner_background_color'][0] : '';
    $specific_event = true;


    $ticket_registration = get_field('registration_2_mit_details', $eventObject->ID);
    $ticket_link = get_field('registration_2_mit_link', $eventObject->ID);
    $ticket_link_non_mit = get_field('registration_2_non_mit_link', $eventObject->ID);
    $ticket_registration_non_mit = get_field('registration_2_non_mit_details', $eventObject->ID);

    $platinum_sponsor = get_field('platinum_sponsor_platinum_details', $eventObject->ID);
    $gold_sponsor = get_field('gold_sponsor_gold_details', $eventObject->ID);


    ?>

        <style>
            h2:after {
                background-color: #ff8a00;
            }
        </style>


        <section class="single-events postid-5085">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article class="inner-page event-banner-section" style="background-color: #fff;">
                    <div class="container event-banner-container">
                        <div class="row">
                            <?php get_template_part('template-parts/yearly', 'event-links'); ?>
                            <div class="col-sm-24 evb-col">
                                <div class="event-banner custom-event-banner <?php echo !empty($banner) ? '' : 'no-img'; ?>" style="<?php echo !empty($banner) ? 'background-image: url(' . esc_url($banner) . ')' : 'background-color: ' . esc_attr($banner_color); ?>">
                                </div>
                                <div class="static-registration-bar">
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <div class="event-name">
                                                <?php echo esc_html($eventObject->post_title); ?>
                                            </div>
                                            <div class="event-date-time">
                                                <?php echo esc_html(date('M d', strtotime($start_on))); ?><?php echo (isset($event_location[0])) ? ' - ' . esc_html($event_location[0]->name) : ''; ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 text-right">
                                            <div class="event-reg-btn">
                                                <?php if (strtotime($end_on) < time()) { ?>
                                                    <a href="javascript:void(0);" class="default-btn disabled">Event
                                                        Closed<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                <?php } else if ($sold_out_flag) { ?>
                                                    <a href="javascript:void(0);" class="default-btn disabled">Sold Out<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                <?php } else { ?>
                                                    <a href="<?php echo esc_url(get_permalink(6174)); ?>" class="default-btn" target="_blank">Visit The Page<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container" id="ai-idol-2020">
                        <div class="row">
                            <div class="col-sm-15" style="font-family: apercu-regular,sans-serif;">
                                <?php echo filter_var(wpautop($eventObject->post_content), FILTER_UNSAFE_RAW); ?>
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
                                        <a href="<?php echo esc_url(get_permalink(6174)); ?>" target="_blank" class="default-btn mb20">Visit The Page<img
                                                    src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                    alt=""></a>
                                    <?php } ?>
                                    <p>
                                        <b class="increase-font">Date and Time</b><br>
                                            Fri, Jul 17, 2020
                                        <br>
                                        12:00 - 1:00 PM PT<br>
                                        <a target="_blank" href="<?php echo esc_url(get_permalink(2476) . '?event_id=' . $eventObject->ID); ?>" class="">
                                            Add this event to Calendar
                                        </a>
                                    </p>

                                    <?php if (isset($meta_data['agenda'][0]) && $meta_data['agenda'][0] > 0) { ?>
                                        <p>
                                            <b class="increase-font">Agenda</b><br>
                                            <?php for ($i = 0; $i < $meta_data['agenda'][0]; $i++) { ?>
                                                <span style="display: block;">
                                            <b class="rside-agenda-info"><?php echo esc_html($meta_data['agenda_' . $i . '_agenda_title'][0]); ?></b>
                                                    <?php echo '<br>'; ?>
                                                    <?php echo esc_html(date('h:i A', strtotime($meta_data['agenda_' . $i . '_agenda_from'][0]))); ?>
                                                    - <?php echo esc_html(date('h:i A', strtotime($meta_data['agenda_' . $i . '_agenda_to'][0]))); ?>
                                        </span>
                                            <?php } ?>
                                        </p>
                                    <?php } ?>

                                    <p>
                                        <b class="increase-font">Location</b><br>
                                        <?php echo !empty($event_address) ? '<b class="rside-agenda-info">' . esc_html($event_address) . '</b><br>' : ''; ?>

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
                                            <p class="m-bottom">
                                                <b class="increase-font">Contacts</b><br>
                                                        <?php
                                                        while (have_rows('primary')) {
                                                            the_row();
                                                            echo '<p style="margin-bottom: -5px; margin-top: 10px;">' . esc_html(get_sub_field('name')) . '</p>';
                                                            echo '<a href="mailto:' . esc_attr(get_sub_field('email')) . '">' . esc_html(get_sub_field('email')) . '</a>';
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
                                            <b>Secondary Contact</b><br>
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
                   
                </article>
                        <?php
            endwhile;
        endif;
        ?>
        </section>
        <?php
        get_footer();
}
