<?php
    /* Template Name: Partners & Supporters */
    get_header();
    global $assets_uri, $event_category_taxonomy, $post, $event_location_taxonomy, $user_profile_page_id, $section_heading, $specific_event;
if (isset($post->ID)) {
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

    $section_heading = get_field('section_heading', $post->ID);

    $heading = get_field('heading', $post->ID);
    $block_content = get_field('block_content', $post->ID);
    ?>

        <style>
            h2:after {
                background-color: #ff8a00;
            }
        </style>


        <section class="single-events postid-7047">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article class="inner-page event-banner-section" style="background-color: #fff;">
                    <div class="container event-banner-container">
                        <div class="row">
                            <?php
                            if ($post->ID == 6526) :
                                ?>
                            <div class="col-lg-18 col-md-16 col-sm-24 yearly-events top-btn" >
                                <ul>
                                    <li> <a href="<?php echo esc_url(get_permalink(5470)); ?>">MIT AI 2020</a></li>
                                    <li><a href="#speaker-section">Speakers</a></li>
                                    <li><a href="<?php echo esc_url(get_permalink(6019)); ?>">AI Idol</a></li>
                                    <li><a href="<?php echo esc_url(get_permalink(6174)); ?>">AI Awards</a></li>
                                    <li><a href="<?php echo esc_url(get_permalink(6205)); ?>">Research Slam</a></li>
                                    <li><a href="https://www.mitcnc.org/mit-ai-2020-partners">Partners & Supporters</a></li>
                                    <li><a href="#get-help">Get Help</a></li>
                                </ul>
                            </div>    
                            <div class="col-lg-6 col-md-8 col-sm-24 top-btn Livestream-btn">
                                <ul>
                                    <li>
                                        <a class="default-btn" href="<?php echo esc_url(get_permalink(6176)); ?>">Agenda & Livestream</a>
                                    </li>
                                </ul>
                            </div> 
                                <?php
                            endif;
                            if ($post->ID == 7806) :
                                ?>
                            <div class="col-lg-18 col-md-16 col-sm-24 yearly-events top-btn" >
                                <ul>
                                    <li> <a href="<?php echo esc_url(get_permalink(7047)); ?>">Healthcare & Medicine</a> </li>
                                    <li> <a href="#startup-exhibitor">Startup Exhibitor</a></li>
                                    <li><a href="#past">Past exhibitors</a></li>
                                    <li><a href="#current">Startups '21</a></li>
                                </ul>
                            </div> 
                            <div class="col-lg-6 col-md-8 col-sm-24 top-btn Livestream-btn">
                                <ul>
                                    <li>
                                        <a class="default-btn" href="<?php echo esc_url(get_permalink(7854)); ?>">Agenda</a>
                                    </li>
                                </ul>
                            </div> 
                                <?php
                            endif;
                            if ($post->ID == 7818) :
                                ?>
                                 <div class="col-lg-18 col-md-16 col-sm-24 yearly-events top-btn" >
                                    <ul>
                                        <li> <a href="<?php echo esc_url(get_permalink(7047)); ?>">Healthcare & Medicine</a> </li>
                                        <li> <a href="#corporate-sponsorship">Corporate Sponsorship</a></li>
                                        <li><a href="#past">Past Participants</a></li>
                                        <li><a href="#current">Sponsors '21</a></li>
                                    </ul>
                                </div> 
                                <div class="col-lg-6 col-md-8 col-sm-24 top-btn Livestream-btn">
                                    <ul>
                                        <li>
                                            <a class="default-btn" href="<?php echo esc_url(get_permalink(7854)); ?>">Agenda</a>
                                        </li>
                                    </ul>
                                </div> 
                            <?php endif; ?>
                            <div class="col-sm-24 evb-col">
                                <div class="event-banner custom-event-banner <?php echo !empty($banner) ? '' : 'no-img'; ?>" style="<?php echo !empty($banner) ? 'background-image: url(' . esc_html($banner) . ')' : 'background-color: ' . esc_html($banner_color); ?>">
                                </div>
                                
                            </div>
                        </div>
                    </div> 
                    <?php
                    if (!empty($heading) || !empty($block_content)) {
                        ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-15" style="font-family: apercu-regular,sans-serif;">
                                    <?php echo filter_var(wpautop($post->post_content), FILTER_UNSAFE_RAW); ?>
                            
                                </div>
                                <div class="col-sm-7 offset-sm-2">
                                    <div class="event-reserve">
                                    <?php
                                    if ($post->ID == 7806) {
                                        ?>
                                        <a href="https://airtable.com/shrqEnoabAd0Frglh" target="_blank" class="default-btn mb20">Apply Now<img
                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                        alt=""></a>
                                        <?php
                                    }
                                    if ($post->ID == 7818) {
                                        ?>
                                        <a href="mailto:lisawalz@alum.mit.edu" target="_blank" class="default-btn mb20">Contact Us<img
                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                        alt=""></a>
                                        <?php
                                    }
                                    ?>
                                        <p>
                                            <b class="uppercase-font">Date and Time</b><br>
                                            Wednesday, January 27, 2021<br>
                                            01:30 PM - 07:30 PM PT<br>
                                            <a target="_blank" href="<?php echo esc_attr(site_url()); ?>/add-to-calendar/?event_id=7047" class="link">
                                                Add to Calendar
                                            </a>
                                        </p>

                                        <?php if (isset($meta_data['agenda'][0]) && $meta_data['agenda'][0] > 0) { ?>
                                            <p>
                                                <b class="uppercase-font">Agenda</b><br>
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
                                            <b class="uppercase-font">Location</b><br>
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

                                        <p>
                                            <b class="uppercase-font">Primary Contact</b><br>
                                            Christian Ulstrup<br><a href="mailto:culstrup@alum.mit.edu" class="link">culstrup@alum.mit.edu</a>                                                  
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
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-24">
                                    <h2 id="past"><?php echo esc_html($heading); ?></h2>
                                    <p>
                                        <?php
                                        echo filter_var($block_content, FILTER_UNSAFE_RAW);
                                        ?>
                                    </p>
                                </div>
                            <div>
                        </div>
                        <?php
                    }
                    if (!empty($section_heading)) {
                        ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-24">
                                <h2 id="current"><?php echo esc_html($section_heading); ?></h2>
                            </div>
                        <div>
                    </div>
                        <?php
                    }
                    if ((!empty('company_logo') || !empty('company_description')) && !empty('company_url')) {
                        ?>
                            <div class="container" id="ai-idol-2020">
                                <div class="row">
                                    <div class="col-sm-24" style="font-family: apercu-regular,sans-serif;">
                                       
                                        <?php
                                        if (have_rows('company_info')) :
                                            $company_count = 1; while (have_rows('company_info')) :
                                                the_row();
                                                ?>
                                            <div class="row company-details">
                                                <div class="col-lg-6 col-md-8 col-sm-24 mb-5">
                                                    <img src=" <?php the_sub_field('company_logo'); ?>" alt=""  class="company-logo">
                                                </div>
                                                <div class="col-lg-18 col-md-16 col-sm-24">
                                                    <p>
                                                        <?php the_sub_field('company_description'); ?>
                                                    </p>
                                                    <a href="<?php the_sub_field('company_url'); ?>">
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/web-icon.svg" alt="" class="contant-icon">
                                                        <?php the_sub_field('company_url'); ?>
                                                    </a>
                                                </div>
                                            </div>
                                                <?php
                                                $company_count++;
                                            endwhile;
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    if ($post->ID == 6526) {
                        ?>
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
                        </div>
                        <?php
                    }
                    if ($post->ID == 7806) {
                        ?>
                         <div class="container">   
                            <div class="row get-help p-4 mt70" id="get-help">
                                <div class="ccol-sm-24">
                                    <a href="https://airtable.com/shrqEnoabAd0Frglh">
                                        <h2 class="white-border text-white mb-3 mt-2 ">
                                            Are you a founder building the future of Health & Medicine?
                                        </h2>
                                        <p class="text-white">Apply now to join 100 of the top startups showcasing their work! </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    if ($post->ID == 7818) {
                        ?>
                         <div class="container">   
                            <div class="row get-help p-4 mt70" id="get-help">
                                <div class="col-sm-24">
                                    <a href="mailto:lisawalz@alum.mit.edu">
                                    <h2 class="white-border text-white mb-3 mt-2 ">
                                        Contact Us
                                    </h2>
                                    <p class="text-white">Help ensure the success of our conference by becoming a corporate sponsor </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </article>
                <?php
            endwhile;
        endif;
        ?>
        </section>
        <?php
        get_footer();
}
