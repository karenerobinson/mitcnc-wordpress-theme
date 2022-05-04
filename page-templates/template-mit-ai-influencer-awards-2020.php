<?php
    /* Template Name: MIT AI Influencer Awards 2020 */
    get_header();
    global $assets_uri, $event_category_taxonomy, $event_location_taxonomy, $user_profile_page_id, $specific_event;
    $post = get_post(4604);
if (isset($post->ID)) {
    $meta_data = get_post_meta($post->ID);
    $banner = get_the_post_thumbnail_url(6174, 'thumbnail_1079_474');
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


    $ticket_registration = get_field('registration_2_mit_details', $post->ID);
    $ticket_link = get_field('registration_2_mit_link', $post->ID);
    $ticket_link_non_mit = get_field('registration_2_non_mit_link', $post->ID);
    $ticket_registration_non_mit = get_field('registration_2_non_mit_details', $post->ID);

    $platinum_sponsor = get_field('platinum_sponsor_platinum_details', $post->ID);
    $gold_sponsor = get_field('gold_sponsor_gold_details', $post->ID);


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
                                <div class="event-banner custom-event-banner <?php echo !empty($banner) ? '' : 'no-img'; ?>" style="<?php echo !empty($banner) ? 'background-image: url(' . esc_html($banner) . ')' : 'background-color: ' . esc_html($banner_color); ?>">
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
                                                    <a href="https://www.mitcnc.org/events/mit-ai-conference-2020/#section--registration" class="default-btn" target="_blank">Reserve Now<img
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
                                <?php echo filter_var(wpautop($post->post_content), FILTER_UNSAFE_RAW); ?>
                               
                                <h2 class="blue ai-blue-big-heading mb-5">AI Influencer Awards</h2>
                                
                                <p>
                                    MIT knows great ideas can change the world. Everyday,
                                    we are dedicated to finding solutions to the world’s most challenging problems 
                                    through science and technology. At MIT AI 2020, we will honor innovative and 
                                    passionate individuals who exemplify MIT’s mission to serve the nation and the 
                                    world through AI based technology. We want to hear and share the stories of 
                                    AI game-changers who are committed to creating meaningful change in today’s world.

                                </p>
                                <p>
                                    This year, we’ll honor influencers in four categories:                 
                                </p>
                                <ul>
                                    <li>
                                        Lifetime Achievement - Individual who already achieved several
                                        lifetimes’ worth of breakthroughs, founding or funding new
                                        innovations and launching new industries.
                                    </li>
                                    <li>
                                        Better World - Individual who demonstrates a real commitment to
                                        building a diverse and inclusive tech community and making a
                                        Better World.

                                    </li>
                                    <li>
                                        Trailblazer - This award recognizes individuals for their
                                        inspirational breakthroughs, and founding new fields of study.

                                    </li>
                                    <li>
                                        Rising Star - It’s never too early to invent groundbreaking
                                        technology, start a company, or bring innovations to market.
                                        This award recognizes someone under 35 who is already building
                                        solutions to create a new world.

                                    </li>
                                </ul>
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
                                        <a href="https://www.mitcnc.org/events/mit-ai-conference-2020/#section--registration" target="_blank" class="default-btn mb20">Reserve Now<img
                                                    src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                    alt=""></a>
                                    <?php } ?>
                                    <p>
                                        <b class="increase-font">Date and Time</b><br>
                                            Fri, Jul 17, 2020
                                        <br>
                                        12:00 - 1:00 PM  PT<br>
                                        <a target="_blank" href="<?php echo esc_url(get_permalink(2476)) . '?event_id=' . esc_html($post->ID); ?>" class="">
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
                                    <?php
                                        $speakers = (isset($meta_data['speakers_list_2'][0]) && !empty($meta_data['speakers_list_2'][0])) ? unserialize($meta_data['speakers_list_2'][0]) : null;
                                        $speakers_ids = '';
                                        $speakers_casting = null;
                                    if (null != $speakers) {
                                        $speakers_ids = implode(',', $speakers);
                                        foreach ($speakers as $key => $speaker) {
                                            if ($key >= 32) {
                                                break;
                                            }
                                            $speakers_casting[] = (object) array('ID' => $speaker);
                                        }
                                        $speakers = $speakers_casting;
                                    }
                                        $__total_count = (
                                            (!empty($speakers_ids) ? (int) count(explode(',', $speakers_ids)) : 0) +
                                            (!empty($moderators_ids) ? (int) count(explode(',', $moderators_ids)) : 0)
                                        );
                                    ?>
                     
                        <div class="row mt70">
                            <div class="col-sm-24">
                                <h2 class="blue">AI Influencer Award Winners</h2>
                                <p>Recognizing outstanding achievement and innovation in the field.</p>
                            </div>
                            <div class="col-sm-24 col-md-12 col-lg-8 col-xl-8">
                                <div class="speaker-card">
                                    <div class="card-img">
                                        <img src="https://www.mitcnc.org/app/media/2020/06/Sandy-Pentland-Profile.png">
                                        <div class="icon-mit">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <div class="name">
                                            <h3>Sandy Pentland</h3>
                                            <span class="code">MIT Media Lab</span>
                                        </div>
                                        <div class="company-name  border-dotted">
                                            <span>Founder</span>
                                        </div>
                                        <div class="tags-box">
                                            <span class="tag">LIFETIME ACHIEVEMENT<br> AWARD</span>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-sm-24 col-md-12 col-lg-8 col-xl-8">
                                <div class="speaker-card">
                                    <div class="card-img">
                                        <img src="https://www.mitcnc.org/app/media/2019/09/KV.png">
                                        <div class="icon-mit">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <div class="name">
                                            <h3>Kyle Vogt</h3>
                                            <span class="code">Cruise and Twitch</span>
                                        </div>
                                        <div class="company-name  border-dotted">
                                            <span>Founder</span>
                                        </div>
                                        <div class="tags-box">
                                            <span class="tag">TRAILBLAZER<br>
                                                AWARD
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-24 col-md-12 col-lg-8 col-xl-8">
                                <div class="speaker-card">
                                    <div class="card-img">
                                        <img src="https://www.mitcnc.org/app/media/2019/09/Ramesh-Raskar.png">
                                        <div class="icon-mit">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <div class="name">
                                            <h3>Ramesh Raskar</h3>
                                            <span class="code">MIT</span>
                                        </div>
                                        <div class="company-name  border-dotted">
                                            <span>Professor</span>
                                        </div>
                                        <div class="tags-box">
                                            <span class="tag">BETTER WORLD<br>
                                                AWARD
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-24 col-md-12 col-lg-8 col-xl-8">
                                <div class="speaker-card">
                                    <div class="card-img">
                                        <img src="https://www.mitcnc.org/app/media/2020/07/Joy-Boulamwini.png">
                                        <div class="icon-mit">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <div class="name">
                                            <h3>Joy Buolamwini</h3>
                                            <span class="code">Algorithmic Justice League</span>
                                        </div>
                                        <div class="company-name  border-dotted">
                                            <span>Founder</span>
                                        </div>
                                        <div class="tags-box">
                                            <span class="tag">BETTER WORLD<br>
                                                AWARD
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-24 col-md-12 col-lg-8 col-xl-8">
                                <div class="speaker-card">
                                    <div class="card-img">
                                        <img src="https://www.mitcnc.org/app/media/2020/07/Chazz-Sims-2.png">
                                        <div class="icon-mit">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <div class="name">
                                            <h3>Chazz Sims</h3>
                                            <span class="code">Wise Systems</span>
                                        </div>
                                        <div class="company-name  border-dotted">
                                            <span>Founder & CEO</span>
                                        </div>
                                        <div class="tags-box">
                                            <span class="tag">RISING STAR<br>
                                                AWARD
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-24 col-md-12 col-lg-8 col-xl-8">
                                <div class="speaker-card">
                                    <div class="card-img">
                                        <img src="https://www.mitcnc.org/app/media/2020/07/Leile-Pirhaji.png">
                                        <div class="icon-mit">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <div class="name">
                                            <h3>Leila Pirhaji</h3>
                                            <span class="code">ReviveMed</span>
                                        </div>
                                        <div class="company-name  border-dotted">
                                            <span>Founder</span>
                                        </div>
                                        <div class="tags-box">
                                            <span class="tag">RISING STAR<br>
                                                AWARD
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- <div class="idol-applynow-banner">
                                <a href="<?php echo esc_url(get_permalink(6167)); ?>" target="_blank">
                                    <h2 class="white-border white-text">APPLY NOW</h2>
                                    
                                    
                                    <i class="icon">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg">
                                    </i>
                                </a>
                            </div> -->
                            
                            <div class="col-lg-24 ">
                                <div class="idol-banner-two">
                                    <div class="banner-two-big-text"><h2><span>AI FOR A</span> <br> Better World</h2></div>
                                    <p class="white-text">Discover how AI is being used to uncover new opportunities, transforming industries, and creating massive new opportunities.</p>
                                </div>
                            </div>
                            <div class="row mb60">
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
                                        <h3>Future of Media & Entertainment</h3>
                                        <p>New forms of news, modes of entertainment, and what the future could look like according to science fiction</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- <div class="idol-applynow-banner">
                                <a href="<?php echo esc_url(get_permalink(6167)); ?>" target="_blank">
                                    <h2 class="white-border white-text">APPLY NOW</h2>
                                    
                                    <p>AI IDOL Application</p>
                                    <i class="icon">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg">
                                    </i>
                                </a>
                            </div> -->
                            
                        </div>

                        <a href="<?php echo esc_url(get_permalink(6019)); ?>" target="_blank">
                            <div class="page-idol-link-2020-2"> 
                            </div>
                        </a>
                    </div>        
                    <article class="">
                    <div class="container">
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
                                <a  href="https://join.slack.com/share/zt-fytd3yc1-7Sljm~wXFm1R0NU05YPp3g"  target="_blank"  class="text-white d-block text-center">
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
                        <div class="row mt-50">
                            <div class="col-sm-14">
                                <h2 class="blue">
                                    Partners & Supporters
                                </h2>
                                <p>We've got an insanely smart group of folks who will discuss where they see the Future of AI and the opportunities that have them excited.</p>
                            </div>
                            <div class="col-sm-24 text-center mt50">
                                <div class="partners-supporters" id="partners">
                                    <a href="https://www.mitcnc.org/mit-ai-2020-partners/">
                                        <img src="<?php echo esc_url($assets_uri); ?>/images/new-partners-supporters.png" class="logos-images img-responsive" alt="" >
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="mt50">
                    <div class="container">
                        <div class="row mb60">
                            <div class="col-sm-8">
                                <div class="white-boxes agenda-box">
                                    <h3>100+<small>AI Experts</small></h3>
                                    <p>Get the playbook from the best AI experts, data scientists, machine learning engineers, founders, execs, and investors.</p>
                                    <p class="agenda-link mt-5">
                                        No hype. No fluff.
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="white-boxes agenda-box">
                                    <h3>600+<small>Attendees</small></h3>
                                    <p>High density of high caliber engineers, machine learning experts, founders, executives & investors.</p>
                                    <p class="agenda-link mt-5">
                                        Unlike any other AI conference!
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="white-boxes agenda-box">
                                    <h3>33+<small>Speakers</small></h3>
                                    <p>Learn, Share and Play with AI experts!<br> It’s not a “ hype / love fest” with AI. </p>
                                    <p class="agenda-link mt-5">
                                        Deep learning - MIT Style - drink from a firehose!
                                    </p>
                                </div>
                            </div>
                        
                        </div>
                        </div>
                </article>
            
                    <div class="container">
                        <?php if (!empty($event_map)) { ?>
                            <div class="row event-map" id="map-container">
                                <div class="col-sm-14 mt60">
                                    <div class="new-mit">
                                        <h2 class="blue">New to the MIT Club of Northern California?</h2>
                                        <p>Enjoy access to members-only events, early access to popular events, member pricing, vote for board members, and other members-only benefits.</p>
                                    </div>
                                </div>
                                
                                <div class="col-sm-24 mt20">
                                    <div class="event-footer-banner">
                                        <a href="https://securelb.imodules.com/s/1314/clubs-classes-interior.aspx?sid=1314&gid=25&pgid=3&cid=40">
                                            <h2 class="white-border white-text">Join the MIT Club of Northern California
                                                today</h2>
                                            <h4 class="white-text">Membership is open to all MIT graduates.</h4>
                                            <p>Enjoy access to members-only events, early access to popular events, member
                                                pricing, vote for board members, and other members-only benefits.</p>
                                        </a>
                                    </div>
                                </div>
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
}
