<?php
    get_header();
    global $assets_uri, $post, $event_category_taxonomy, $event_location_taxonomy, $user_profile_page_id, $login_page_id;
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
        null, //((isset($event_type[0])) ? [$event_type[0]->term_id] : null),
        null,
        null,
        array($post->ID)
    );
    $speakers = (isset($meta_data['speakers_list'][0]) && !empty($meta_data['speakers_list'][0])) ? unserialize($meta_data['speakers_list'][0]) : null;
    $speakers_ids = '';
    $speakers_casting = null;
    if (null != $speakers) {
        $speakers_ids = implode(',', $speakers);
        foreach ($speakers as $speaker) {
            $speakers_casting[] = (object) array('ID' => $speaker);
        }
        $speakers = $speakers_casting;
    }

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
    
    //    $client_info = file_get_contents('https://geoip.nekudo.com/api');
    //    $client_info = !empty($client_info) ? json_decode($client_info) : null;
    $sold_out_flag = (isset($meta_data['sold_out'][0])) ? $meta_data['sold_out'][0] : false;
    $banner_color = (isset($meta_data['banner_background_color'][0])) ? $meta_data['banner_background_color'][0] : '';

    $specific_event = true;

    $platinum_sponsor = get_field('platinum_sponsor_platinum_details', $post->ID);
    $gold_sponsor = get_field('gold_sponsor_gold_details', $post->ID);

    //$color_palette = get_field('color_palette_color_list',$post->ID);
    //$cs_color_palette = get_field('colors',$post->ID);

    $after_content = get_field('after_content', $post->ID);
    ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
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
                                <li>
                                    <a href="<?php echo esc_url(get_permalink(5470)); ?>">MIT AI 2020</a>
                                </li>
                                
                                <li >
                                    <a href="#speaker-section">Speakers</a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(get_permalink(6019)); ?>">AI Idol</a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(get_permalink(6174)); ?>">AI Awards</a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(get_permalink(6205)); ?>">Research Slam</a>
                                </li>
                                <li>
                                    <a href="https://www.mitcnc.org/mit-ai-2020-partners">Partners & Supporters</a>
                                </li>
                                <li>
                                    <a href="#get-help">Get Help</a>
                                </li>
                            </ul>
                        </div>    
                        <div class="col-lg-6 col-md-8 col-sm-24 top-btn Livestream-btn">
                            <ul>
                                <li>
                                    <a class="default-btn" href="<?php echo esc_url(get_permalink(6176)); ?>">Agenda & Livestream</a>
                                </li>
                            </ul>
                        </div>    
                        <?php // get_template_part('template-parts/yearly', 'event-links'); ?>
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
                                                <a href="javascript:void(0);" class="default-btn disabled">Event
                                                    Closed<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                            <?php } else if ($sold_out_flag) { ?>
                                                <a href="javascript:void(0);" class="default-btn disabled">Sold Out<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                            <?php } else { ?>
                                                <?php if (isset($meta_data['registration_3_affiliate_reservation_link']) && count($meta_data['registration_3_affiliate_reservation_link']) > 0 && !empty($meta_data['registration_3_affiliate_reservation_link'][0])) : ?>
                                                    <a href="<?php echo esc_attr($meta_data['registration_3_affiliate_reservation_link'][0]); ?>" class="default-btn">Reserve Now<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                <?php else : ?>
                                                    <a href="#section--registration" class="default-btn">Reserve Now<img
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
                                        <a href="<?php echo esc_attr($meta_data['registration_3_affiliate_reservation_link'][0]); ?>" target="_blank" class="default-btn mb20">Reserve Now<img
                                                src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                alt=""></a>
                                    <?php else : ?>
                                    <a href="#section--registration" class="default-btn mb20">Reserve Now<img
                                                src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                alt=""></a>
                                    <?php endif; ?>
                                <?php } ?>
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
                                                                    echo '<a href="mailto:' . esc_html(get_sub_field('email')) . '">' . esc_html(get_sub_field('email')) . '</a>';
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
                                <?php
                                    $speakers = (isset($meta_data['speakers_list_2'][0]) && !empty($meta_data['speakers_list_2'][0])) ? unserialize($meta_data['speakers_list_2'][0]) : null;
                                    $speakers_ids = '';
                                    $speakers_casting = null;
                                if (null != $speakers) {
                                    $speakers_ids = implode(',', $speakers);
                                    foreach ($speakers as $key => $speaker) {
                                        $speakers_casting[] = (object) array('ID' => $speaker);
                                    }
                                    $speakers = $speakers_casting;
                                }
                                    $__total_count = (
                                        (!empty($speakers_ids) ? (int) count(explode(',', $speakers_ids)) : 0) +
                                        (!empty($moderators_ids) ? (int) count(explode(',', $moderators_ids)) : 0)
                                    );
                                ?>
                    
                 
                    <!-- SPEAKERS LIST 2 START -->
                                <?php
                                if (null != $speakers || null != $moderators) {
                                    $speaker_count = (null != $speakers) ? count($speakers) : 0;
                                    $moderator_count = (null != $moderators) ? count($moderators) : 0;
                        
                                    $__total_count = (
                                    (!empty($speakers_ids) ? (int) count(explode(',', $speakers_ids)) : 0) +
                                    (!empty($moderators_ids) ? (int) count(explode(',', $moderators_ids)) : 0)
                                    );
                                    ?>
                        <div class="row mt30">
                            <div class="col-17 col-sm-16">
                                <h2 class="yellow" id="speaker-section">Speaker<?php echo ($__total_count > 1) ? 's' : ''; ?></h2>
                                <p>We are gathering the world's leading and most inspired thinkers from multiple disciplines to inspire your organization to build real-world AI solutions.</p>
                            </div>
                            <div class="col-6 col-sm-8 text-right mt30">
                                <h3 class="green" style="color:#6855ff;"><?php echo esc_html($__total_count); ?>+</h3>
                                <p class="black-text">Industry Experts</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form--search-field-wrapper form-group" style="position: relative;">
                                    <i class="fa fa-search" style="position: absolute;top: 10px;left: 10px;"></i>
                                    <input class="form--search-field form-control" type="text" value="" placeholder="Search by Name" style="padding-left: 27px;" />
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form--search-field-wrapper form-group" style="position: relative;">
                                    <?php global $event_topics_taxonomy; ?>
                                    <?php if (!empty($event_topics_taxonomy)) : ?>
                                        <?php $topics = get_terms($event_topics_taxonomy, array('hide_empty' => false, 'parent' => 90)); ?>
                                        <?php if (count($topics) > 0) : ?>
                                        <select class="form-control" id="topics">
                                            <option value='all'>All Topic</option>
                                            <?php foreach ($topics as $topic) : ?>
                                                <option value='<?php echo esc_attr($topic->term_id); ?>'><?php echo esc_html($topic->name); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row speaker-container users_list">
                                    <?php get_template_part('template-parts/content', 'speakers'); ?>
                            <!-- <div class="col-12 col-lg-6 col-md-12 mt40 ">
                                <div class="white-boxes view-more" >
                                    <h2 class="yellow mt40">Speakers</h2>
                                    <a href="<?php echo esc_url(get_permalink(3707)); ?>" class="agenda-link mt-3">View Additional 2019 Speakers</a><br>
                                    <a href="https://airtable.com/shrMcGoCdUyOYGioe" target="_blank" class="agenda-link mt70">
                                        Suggest a Speaker
                                        <i class="icon">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg">
                                        </i>
                                    </a>
                                </div>
                            </div> -->
                        </div>
                                <?php } ?>
                    <!-- SPEAKERS LIST 2 END -->
                    <?php

                        $speakers = (isset($meta_data['speakers_list'][0]) && !empty($meta_data['speakers_list'][0])) ? unserialize($meta_data['speakers_list'][0]) : null;
                        $speakers_ids = '';
                        $speakers_casting = null;
                    if (null != $speakers) {
                        $speakers_ids = implode(',', $speakers);
                        foreach ($speakers as $key => $speaker) {
                            if ($key >= 11) {
                                break;
                            }
                            $speakers_casting[] = (object) array('ID' => $speaker);
                        }
                        $speakers = $speakers_casting;
                    }

                    if ((null != $speakers || null != $moderators) && false) {
                        $speaker_count = (null != $speakers) ? count($speakers) : 0;
                        $moderator_count = (null != $moderators) ? count($moderators) : 0;
                        ?>
                        <div class="row mt30">
                            <div class="col-sm-16">
                                <h2 class="yellow">Past Speaker<?php echo ($speaker_count > 1 || $moderator_count > 1) ? 's' : ''; ?></h2>
                                <p>We are gathering the world's leading and most inspired thinkers from multiple disciplines to inspire your organization to build real-world AI solutions.</p>
                            </div>
                            <div class="col-sm-8 text-right mt30">
                                <h3 class="green">250+</h3>
                                <a href="<?php bloginfo('url'); ?>/speakers/" class="black-text">Talent Industry Experts</a>
                            </div>
                        </div>
                        <div class="row speaker-container">
                        <?php get_template_part('template-parts/content', 'speakers'); ?>
                            <div class="col-lg-6 col-md-12 mt40">
                                <div class="white-boxes" style="height: 330px;">
                                    <h2 class="yellow mt40">Past Speakers</h2>
                                    <a href="<?php bloginfo('url'); ?>/speakers/" class="agenda-link mt-3">View 250+ Talent Industry Experts</a><br>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div>        

                    <div class="row mb60">
                       <div class="col-sm-24">
                            <h2>Themes</h2>
                       </div>
                       <div class="col-lg-12 col-md-12 col-sm-24">
                            <div class="conference-topic six">
                                <h3>Future of Infrastructure</h3>
                                <p>With machine learning, design systems that could learn I-O patterns to enable storage optimization and make intelligent decisions</p>
                            </div>
                        </div> 
                        <div class="col-lg-12 col-md-12 col-sm-24">
                            <div class="conference-topic one">
                                <h3>Future of Work</h3>
                                <p>The changing job landscape, remote and on-demand work, and technologies that enhance productivity</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-24">
                            <div class="conference-topic two">
                                <h3>Future of Health</h3>
                                <p>Drug discovery, personalized medicine, telehealth, and mental health</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-24">
                            <div class="conference-topic four">
                                <h3>Future of Learning</h3>
                                <p>New modes of education and emerging technologies that enable deeper engagement</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-24">
                            <div class="conference-topic five">
                                <h3>Future of Economy</h3>
                                <p>Fintech and the economic forces and that are affecting and affected by technology and what this means for you</p>
                            </div>
                        </div> 
                        <div class="col-lg-12 col-md-12 col-sm-24">
                            <div class="conference-topic three">
                                <h3>Future of Media & Entertainment </h3>
                                <p>New forms of news, modes of entertainment, and what the future could look like according to science fiction</p>
                            </div>
                        </div>
                       
                       
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-24">
                            <a href="<?php echo esc_url(get_permalink(6019)); ?>" target="_blank">
                                <div class="page-idol-link-2020"> 
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-24">
                            <a href="<?php echo esc_url(get_permalink(6174)); ?>" target="_blank">
                                <div class="page-awards-link-2020"> 
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-24">
                            <a href="<?php echo esc_url(get_permalink(6205)); ?>" target="_blank">
                                <div class="page-slam-link-2020"> 
                                </div>
                            </a>
                        </div>
                    </div>
                  
                </div>

                <article>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-14">
                                <h2>MIT COVID-19 Response Funds</h2>
                                <p>In exchange for the value you receive from this event, we ask that you make a donation (in an amount of your choosing) to the <a class="link" href="https://www.mitcnc.org/covid-19/donate/" target="_blank" rel="noopener">MIT Covid-19 Response Funds</a>.</p>
                                <div style="text-align: center;margin-top: 50px;"><script src="https://donorbox.org/widget.js" paypalExpress="false"><span data-mce-type="bookmark" style="display: inline-block; width: 0px; overflow: hidden; line-height: 0;" class="mce_SELRES_start"></span></script>
                            </div>
                        </div>
                    </div>
                </article>

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
                                        <h2>Event Gallery</h2>
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
                                        <h2>Watch</h2>
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
                   
                <div class="row get-help p-4 mt70" id="get-help">
                    <div class="col-lg-12">
                        <h2 class="white-border text-white mb-3 mt-2 ">
                            GET HELP
                        </h2>
                        <p class="text-white">We're here to help whenever you need us...</p>
                    </div>
                    <div class="border-right col-lg-4 pt-4">
                        <a href="https://mitcnc-org.zoom.us/j/88328053823"  target="_blank"   class="text-white d-block text-center">
                            <img class="mb-3 ml-auto mr-auto contant-icon d-block" src="<?php echo esc_url($assets_uri); ?>/images/zoom.png" alt="" >
                            Join our Zoom
                        </a>
                    </div>
                    <div class="border-right col-lg-4 pt-4">
                        <a href="https://join.slack.com/share/zt-fytd3yc1-7Sljm~wXFm1R0NU05YPp3g"  target="_blank"   class="text-white d-block text-center">
                            <img class="mb-3 ml-auto mr-auto contant-icon d-block" src="<?php echo esc_url($assets_uri); ?>/images/Slack.png" alt="">
                            Join Slack
                        </a>
                    </div>
                    <div class="col-lg-4 pl-3 pt-4">
                        <a href="mailto:clubadmin@mitcnc.org" class="text-white d-block text-center">
                            <img class="mb-3 ml-auto mr-auto contant-icon d-block" src="<?php echo esc_url($assets_uri); ?>/images/email.png" alt="" >
                            clubadmin@mitcnc.org
                        </a>
                    </div>

                </div>
                <article class="mt50">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-14">
                                <h2 class="yellow">
                                    Partners & Supporters
                                </h2>
                                <p>We've got an insanely smart group of folks who will discuss where they see the Future of AI and the opportunities that have them excited.</p>
                            </div>
                            <div class="col-sm-24 text-center mt50">
                                <div class="partners-supporters" id="partners">
                                    <a href="<?php echo esc_url(get_permalink(6526)); ?>"><img src="<?php echo esc_url($assets_uri); ?>/images/new-partners-supporters.png" class="logos-images img-responsive" alt="" ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
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
