<?php
    /* Template Name: MIT AI Conference 2019 idol new */
    get_header();
    global $assets_uri, $event_category_taxonomy, $event_location_taxonomy, $user_profile_page_id, $specific_event;
    $post = get_post(2501);
    if(isset($post->ID)){
        $meta_data = get_post_meta($post->ID);
        $banner = get_the_post_thumbnail_url(3893, 'thumbnail_1079_474');
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
            [$post->ID]
        );

        $moderators = (isset($meta_data['moderators_list'][0]) && !empty($meta_data['moderators_list'][0])) ? unserialize($meta_data['moderators_list'][0]) : null;
        $moderators_ids = '';
        $moderators_casting = null;
        if ($moderators != null) {
            $moderators_ids = implode(',', $moderators);
            foreach ($moderators as $moderator) {
                $moderators_casting[] = (object)['ID' => $moderator];
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
        $primary_contact = [
            'name' => (isset($meta_data['contact_persons_contact_persons_primary_contact_persons_primary_name'][0])) ? $meta_data['contact_persons_contact_persons_primary_contact_persons_primary_name'][0] : '',
            'email' => (isset($meta_data['contact_persons_contact_persons_primary_contact_persons_primary_email'][0])) ? $meta_data['contact_persons_contact_persons_primary_contact_persons_primary_email'][0] : '',
        ];
        $secondary_contact = [
            'name' => (isset($meta_data['contact_persons_contact_persons_secondary_contact_persons_secondary_name'][0])) ? $meta_data['contact_persons_contact_persons_secondary_contact_persons_secondary_name'][0] : '',
            'email' => (isset($meta_data['contact_persons_contact_persons_secondary_contact_persons_secondary_email'][0])) ? $meta_data['contact_persons_contact_persons_secondary_contact_persons_secondary_email'][0] : '',
        ];
        $mit_registration = [
            'link' => (isset($meta_data['registration_2_mit_link'][0])) ? $meta_data['registration_2_mit_link'][0] : '',
            'details' => [],
        ];
        $non_mit_registration = [
            'link' => (isset($meta_data['registration_2_non_mit'][0])) ? $meta_data['registration_2_non_mit'][0] : '',
            'details' => [],
            'embed_widget' => (isset($meta_data['registration_2_non_mit_embed_widget'][0])) ? $meta_data['registration_2_non_mit_embed_widget'][0] : '',
        ];
        //    $client_info = file_get_contents('https://geoip.nekudo.com/api');
        //    $client_info = !empty($client_info) ? json_decode($client_info) : null;
        $sold_out_flag = (isset($meta_data['sold_out'][0])) ? $meta_data['sold_out'][0] : false;
        $banner_color = (isset($meta_data['banner_background_color'][0])) ? $meta_data['banner_background_color'][0] : '';
        $specific_event = true;


        $ticket_registration = get_field('registration_2_mit_details', $post->ID);
        $ticket_link = get_field('registration_2_mit_link', $post->ID);
        $ticket_link_non_mit = get_field('registration_2_non_mit_link', $post->ID);
        $ticket_registration_non_mit = get_field('registration_2_non_mit_details', $post->ID);

        $platinum_sponsor = get_field('platinum_sponsor_platinum_details', $post->ID);
        $gold_sponsor = get_field('gold_sponsor_gold_details', $post->ID);

        //$color_palette = get_field('color_palette_color_list',$post->ID);
        //$cs_color_palette = get_field('colors',$post->ID);

        ?>

        <style>
            h2:after {
                background-color: #ff8a00;
            }
        </style>


        <section class="single-events postid-3893">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                <article class="inner-page event-banner-section">
                    <div class="container event-banner-container">
                        <div class="row">
                            <?php get_template_part('template-parts/yearly', 'event-links'); ?>
                            <div class="col-sm-24 evb-col">
                                <div class="event-banner custom-event-banner <?php echo !empty($banner) ? '' : 'no-img'; ?>" style="<?php echo !empty($banner) ? 'background-image: url(' . $banner . ')' : 'background-color: ' . $banner_color; ?>">
                                </div>
                                <div class="static-registration-bar">
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <div class="event-name">
                                                <?php echo $post->post_title; ?>
                                            </div>
                                            <div class="event-date-time">
                                                <?php echo date('M d', strtotime($start_on)); ?><?php echo (isset($event_location[0])) ? ' - ' . $event_location[0]->name : ''; ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 text-right">
                                            <div class="event-reg-btn">
                                                <?php if (strtotime($end_on) < time()) { ?>
                                                    <a href="javascript:void(0);" class="default-btn disabled">Event
                                                        Closed<img
                                                            src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                <?php } else if ($sold_out_flag) { ?>
                                                    <a href="javascript:void(0);" class="default-btn disabled">Sold Out<img
                                                            src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                <?php } else { ?>
                                                    <?php /* <a href="<?php echo !empty($reservation_link) ? $reservation_link : 'javascript:void(0);'; ?>" class="default-btn">Reserve Now<img src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg" alt=""></a> */ ?>
                                                    <a href="#section--registration" class="default-btn">Reserve Now<img
                                                            src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
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
                            <?php echo wpautop($post->post_content); ?>
                            <h2 class="yellow">AI Idol</h2>
                            <h4 style="line-height: 1.4; margin-bottom: 20px;">
                                Back by popular demand<br>
                                AI Idol Competition<br>
                                @ MIT AI Conference 2019
                            </h4>
                            <p>
                                Come to experience MIT AI Conference on 14th September in Palo Alto and present your company at the AI Idol.                 
                            </p>

                            <p>
                                <a href="https://airtable.com/shrt1YtljA1dvvDrp">Apply today</a> to participate and get a chance to showcase your company at the 3rd annual AI Idol by pitching to a panel of judges made up of leading investors, angles, and entrepreneurs at MIT 2019.                 
                            </p>
                            <p>
                                AI Idol offers innovative startups a unique platform to present their companies and mingle with a high-caliber audience of VCs, angel investors, strategic partners, corporate investors, and industry experts.                 
                            </p>
                            <p>
                                Past Participants of AI Idol have met investors, found great talent to recruit,  and formed industry partnerships and relationships at the event. Our past AI Idol participants have subsequently raised over $200m of capital from some of the leading investors:                 
                            </p>

                        </div>
                        <div class="col-sm-7 offset-sm-2">
                            <div class="event-reserve">
                                <?php if (strtotime($end_on) < time()) { ?>
                                    <a href="javascript:void(0);" class="default-btn disabled mb20">Event Closed<img
                                                src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                alt=""></a>
                                <?php } else if ($sold_out_flag) { ?>
                                    <a href="javascript:void(0);" class="default-btn disabled mb20">Sold Out<img
                                                src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                alt=""></a>
                                <?php } else { ?>
                                    <a href="#section--registration" class="default-btn mb20">Reserve Now<img
                                                src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                alt=""></a>
                                <?php } ?>
                                <p>
                                    <b class="increase-font">Date and Time</b><br>
                                    <?php echo $start_on_date; ?> <?php echo ($start_on_date != $end_on_date) ? ' - ' . $end_on_date : ''; ?>
                                    <br>
                                    <?php echo $start_on_time; ?> - <?php echo $end_on_time; ?> PT<br>
                                    <a target="_blank" href="<?php echo get_permalink(2476).'?event_id='.$post->ID; ?>" class="">
                                        Add this event to Calendar
                                    </a>
                                </p>

                                <?php if (isset($meta_data['agenda'][0]) && $meta_data['agenda'][0] > 0) { ?>
                                    <p>
                                        <b class="increase-font">Agenda</b><br>
                                        <?php for ($i = 0; $i < $meta_data['agenda'][0]; $i++) { ?>
                                            <span style="display: block;">
                                        <b class="rside-agenda-info"><?php echo $meta_data['agenda_' . $i . '_agenda_title'][0]; ?></b>
                                                <?php echo '<br>'; ?>
                                                <?php echo date('h:i A', strtotime($meta_data['agenda_' . $i . '_agenda_from'][0])); ?>
                                                - <?php echo date('h:i A', strtotime($meta_data['agenda_' . $i . '_agenda_to'][0])); ?>
                                    </span>
                                        <?php } ?>
                                    </p>
                                <?php } ?>

                                <p>
                                    <b class="increase-font">Location</b><br>
                                    <?php echo !empty($event_address) ? '<b class="rside-agenda-info">'.$event_address.'</b><br>' : '' ?>

                                    <?php echo !empty($event_address_1) ? $event_address_1.'<br>' : '' ?>

                                    <?php echo !empty($event_address_2) ? $event_address_2.'<br>' : '' ?>


                                    <?php
                                        if(isset($event_address_city['label']) && !empty($event_address_city['label'])){
                                            echo $event_address_city['label'];
                                        }
                                        if(isset($event_address_city['label']) && !empty($event_address_city['label']) && !empty($event_address_state)){
                                            echo ', ';
                                        }
                                        if(!empty($event_address_state)){
                                            echo $event_address_state;
                                        }
                                        if(!empty($event_address_state) && !empty($event_address_postal_code)){
                                            echo ', ';
                                        }
                                        if(!empty($event_address_postal_code)){
                                            echo $event_address_postal_code;
                                        }
                                        if(
                                            isset($event_address_city['label']) ||
                                            !empty($event_address_city['label']) ||
                                            !empty($event_address_state) ||
                                            !empty($event_address_postal_code)
                                        ){
                                            echo '<br>';
                                        }
                                    ?>

                                    <?php if (!empty($event_map)) { ?>
                                        <a href="#map-container">View Map</a>
                                    <?php } ?>
                                </p>

                                <?php if($platinum_sponsor != null){ ?>
                                    <p>
                                        <b>Platinum Sponsors</b><br>
                                        <?php foreach ($platinum_sponsor as $platinum){
                                         ?>
                                        <b>
                                            <a style="color: #A31F34" href="<?php echo $platinum['link'] ; ?>"><?php echo $platinum['title'] ; ?></a>
                                        </b><br>

                                        <?php } ?>
                                    </p>
                                <?php } ?>

                                <?php if($gold_sponsor != null){ ?>
                                    <p>
                                        <b>Gold Sponsors</b><br>
                                        <?php foreach ($gold_sponsor as $gold){
                                        ?>
                                        <b>
                                            <a style="color: #A31F34;" href="<?php echo $gold['link'] ; ?>"><?php echo $gold['title'] ; ?></a>
                                        </b><br>
                                        <?php } ?>
                                    </p>
                                <?php } ?>

                                <?php
                                    if( have_rows('contact_persons') ){ 
                                        while ( have_rows('contact_persons') ){
                                            the_row(); 
                                            if( have_rows('primary') ){
                                                ?>
                                                    <p class="m-bottom">
                                                        <b class="increase-font">Contacts</b><br>
                                                        <?php
                                                            while ( have_rows('primary') ){
                                                                the_row(); 
                                                                echo '<p style="margin-bottom: -5px; margin-top: 10px;">'.get_sub_field('name'). '</p>'; 
                                                                // echo '<br> ';
                                                                echo '<a href="mailto:'.get_sub_field('email').'">'.get_sub_field('email').'</a>'; 
                                                                echo '<br>';
                                                            }
                                                        ?>
                                                    </p>
                                                <?php      
                                            }
                                        }
                                    }
                                ?>

                                <?php /* if (
                                    (isset($primary_contact['name']) && !empty($primary_contact['name'])) ||
                                    (isset($primary_contact['email']) && !empty($primary_contact['email']))
                                ) {
                                    ?>
                                    <p>
                                        <b>Primary Contact</b><br>
                                        <?php echo (!empty($primary_contact['name'])) ? $primary_contact['name'] . '<br>' : ''; ?>
                                        <?php echo (!empty($primary_contact['email'])) ? '<a href="mailto:' . $primary_contact['email'] . '">' . $primary_contact['email'] . '</a>' : ''; ?>
                                    </p>
                                    <?php
                                } */ ?>

                                <?php if (
                                    (isset($secondary_contact['name']) && !empty($secondary_contact['name'])) ||
                                    (isset($secondary_contact['email']) && !empty($secondary_contact['email']))
                                ) {
                                    ?>
                                    <p>
                                        <b>Secondary Contact</b><br>
                                        <?php echo (!empty($secondary_contact['name'])) ? $secondary_contact['name'] . '<br>' : ''; ?>
                                        <?php echo (!empty($secondary_contact['email'])) ? '<a href="mailto:' . $secondary_contact['email'] . '">' . $secondary_contact['email'] . '</a>' : ''; ?>
                                    </p>
                                    <?php
                                } ?>
                                <div class="calendar-page-link">
                                    <a href="<?php bloginfo('url') ?>/calendar">
                                        <i class="calendar-icon">
                                            <img src="<?php echo $assets_uri; ?>/images/icons/calendar-icon.svg" alt="">
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
						if ($speakers != null) {
						    $speakers_ids = implode(',', $speakers);
						    foreach ($speakers as  $key => $speaker) {
						        if($key >= 32){
						            break;
						        }
						        $speakers_casting[] = (object)['ID' => $speaker];

						    }
						    $speakers = $speakers_casting;
						}
						$__total_count = (
                            (!empty($speakers_ids) ? (int)count(explode(',', $speakers_ids)) : 0) +
                            (!empty($moderators_ids) ? (int)count(explode(',', $moderators_ids)) : 0)
                        );
                    ?>
                    <div class="row mt70">
                        <div class="col-lg-12 col-md-24 col-sm-24"> 
                            <div class="idol-section left-section" >
                                <h2><strong>2018</strong> AI Idol winners are</h2>
                                <div class="idol-winner-box left-box">
                                    <div>
                                        <strong>Dashbot</strong>
                                        <p class="idol-btn">Raised $6M</p>
                                        <p>Bessemer Ventures, Samsung NEXT, ff Venture, Bertelsmann, Runa Capital</p>
                                    </div>
                                    <br>
                                    <div>
                                        <strong>Fireflies.ai</strong>
                                        <p class="idol-btn">Raised $5M</p>
                                        <p>from Canaan, Right Side Capital, Acceleprise</p>
                                    </div>
                                
                                </div>
                                <div class="idol-winner-box right-box">
                                    <div>
                                        <strong>Proven</strong>
                                        <p class="idol-btn" style="width: 162px;">Raised seed round</p>
                                        <p>Belcorp, UpHonest,FJ Labs, YC</p>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <div>
                                        <strong>Skyline.ai</strong>
                                        <p class="idol-btn">Raised $25M</p>
                                        <p>Sequoia, JLL Spark, TLV Partners</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-24 col-sm-24">
                            <div class="idol-section ">
                                <h2><strong>2017</strong> AI Idol winners are</h2>
                                <div class="idol-winner-box left-box">
                                    <div>
                                        <strong>RealWear </strong>
                                        <p class="idol-btn">Raised $6M</p>
                                        <p>Qualcomm Ventures, Bose Ventures, Teradyne, MentorsFund, JP Morgan</p>
                                    </div>
                                    <br>
                                    <br>
                                    <div>
                                        <strong>UnifyID</strong>
                                        <p class="idol-btn">Raised $20m</p>
                                        <p>NEA, Andreessen Horowitz</p>
                                    </div>
                                    <br>
                                </div>
                                <div class="idol-winner-box right-box">    
                                    <div>
                                        <strong>Voicea</strong>
                                        <p class="idol-btn">Raised $20m</p>
                                        <p>GV, Battery Ventures, GGV Capital, Salesforce Ventures - Acquired by Cisco!</p>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="idol-applynow-banner">
                            <a href="https://airtable.com/shrt1YtljA1dvvDrp">
                                <h2 class="white-border white-text">APPLY NOW</h2>
                                
                                <p>Last date to apply August 31st, 2019</p>
                                <i class="icon">
                                        <img src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg">
                                </i>
                            </a>
                        </div>
                        <div class="col-sm-24">
                            <p>AI Idol is open to MIT alumni-founded start-up companies applying AI, deep learning, machine learning algorithms and techniques to disrupt industries. Applicants may be pre-seed to Series B stage.</p>
                            <p>Deadline is approaching! Don’t miss the chance to showcase your startup to an amazing panel of judges. Also, grab the opportunity to mingle with high-caliber audience and engage with the MIT AI community. </p>
                        </div>    
                        <div class="col-lg-24 ">
                            <div class="idol-banner-two">
                                <div class="banner-two-img"></div>
                                <p class="white-text">This year our AI Conference will focus on the Future of Computing - the rise of Artificial Intelligence and how innovators are leveraging AI to drive new use cases and achieve better outcomes across industries. In particular, we will focus on the following AI areas:</p> -->
                                <!-- <p><img class="alignnone size-full wp-image-3461" src="https://www.mitcnc.org/app/media/2019/05/Vector-Smart-Object.png" alt="" width="50" height="21"></p> -->
                            </div>
                        </div>
                        <div class="row mb60">
                            <div class="col-lg-4 col-md-12 col-sm-24">
                                <div class="conference-topic">
                                    <h4>Future of Computing</h4>
                                    <p>how hardware and infrastructure innovations are enabling AI</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-24">
                                <div class="conference-topic">
                                    <h4>AI-driven Applications</h4>
                                    <p>how AI is being deployed in new use cases across industries</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-24">
                                <div class="conference-topic">
                                    <h4>Autonomous Vehicles</h4>
                                    <p>how AV companies are driving innovation with AI</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-24">
                                <div class="conference-topic">
                                    <h4>AI in Healthcare</h4>
                                    <p>how AI is being used to improve healthcare outcomes</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-24">
                                <div class="conference-topic">
                                    <h4>AI for Social Good</h4>
                                    <p>how AI is being used to create a better world</p>
                                </div>
                            </div>  
                        </div>
                        <div class="col-sm-24">
                            <h5>Experience a unique event:</h5>
                            <ul>
                                <li>Meet with like-minded founders, leaders, experts, and VCs</li>
                                <li>Learn from leading expert speakers who will show you how to apply AI in your organizations</li>
                            </ul>
                            <h5>Come for limitless, high-quality networking and learn from those who've done it!</h5>
                        </div>
                        <div class="idol-applynow-banner">
                            <a href="https://airtable.com/shrt1YtljA1dvvDrp">
                                <h2 class="white-border white-text">APPLY NOW</h2>
                                
                                <p>AI IDOL Application</p>
                                <i class="icon">
                                        <img src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg">
                                </i>
                            </a>
                        </div>
                        
                    </div>
                        <!-- SPEAKERS LIST 2 START -->
                        <?php

                        $speakers = (isset($meta_data['speakers_list_2'][0]) && !empty($meta_data['speakers_list_2'][0])) ? unserialize($meta_data['speakers_list_2'][0]) : null;
                        $speakers_ids = '';
                        $speakers_casting = null;
                        if ($speakers != null) {
                            $speakers_ids = implode(',', $speakers);
                            foreach ($speakers as  $key => $speaker) {
                                $speakers_casting[] = (object)['ID' => $speaker];
                            }
                            $speakers = $speakers_casting;
                        }

                        if ($speakers != null || $moderators != null) {
                            $speaker_count = ($speakers != null) ? count($speakers) : 0;
                            $moderator_count = ($moderators != null) ? count($moderators) : 0;
                            
                            $__total_count = (
                                (!empty($speakers_ids) ? (int)count(explode(',', $speakers_ids)) : 0) +
                                (!empty($moderators_ids) ? (int)count(explode(',', $moderators_ids)) : 0)
                            );
                            ?>
                            <!-- <div class="row mt30">
                                <div class="col-sm-16">
                                    <h2 class="yellow">Speaker<?php echo ($__total_count > 1) ? 's' : ''; ?></h2>
                                    <p>We are gathering the world's leading and most inspired thinkers from multiple disciplines to inspire your organization to build real-world AI solutions.</p>
                                </div>
                                <div class="col-sm-8 text-right mt30">
                                    <h3 class="green"><?php echo $__total_count; ?>+</h3>
                                    <p class="black-text">Talent Industry Experts</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form--search-field-wrapper form-group" style="position: relative;">
                                        <i class="fa fa-search" style="position: absolute;top: 10px;left: 10px;"></i>
                                        <input class="form--search-field form-control" type="text" value="" placeholder="Search by Name" style="padding-left: 27px;" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form--search-field-wrapper form-group" style="position: relative;">
                                    <?php global $event_topics_taxonomy; ?>
                                    <?php if(!empty($event_topics_taxonomy)): ?>
                                        <?php $topics = get_terms($event_topics_taxonomy,array('hide_empty'=>false)); ?>
                                        <?php if(sizeof($topics)): ?>
                                            <select class="form-control" id="topics">
                                                <option value='all'>All Topic</option>
                                                <?php foreach($topics as $topic): ?>
                                                    <option value='<?php echo $topic->term_id; ?>'><?php echo $topic->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row speaker-container">
                                <?php get_template_part('template-parts/content', 'speakers'); ?>
                            </div> -->
                        <?php } ?>
                        <!-- SPEAKERS LIST 2 END -->
                    </div>
                    <!-- <div class="container">
                        <?php

                        $speakers = (isset($meta_data['speakers_list'][0]) && !empty($meta_data['speakers_list'][0])) ? unserialize($meta_data['speakers_list'][0]) : null;
                        $speakers_ids = '';
                        $speakers_casting = null;
                        if ($speakers != null) {
                            $speakers_ids = implode(',', $speakers);
                            foreach ($speakers as  $key => $speaker) {
                                $speakers_casting[] = (object)['ID' => $speaker];
                            }
                            $speakers = $speakers_casting;
                        }

                        if (($speakers != null || $moderators != null) && false) {

                            $speaker_count = ($speakers != null) ? count($speakers) : 0;
                            $moderator_count = ($moderators != null) ? count($moderators) : 0;
                            ?>
                            <div class="row mt30">
                                <div class="col-sm-16">
                                    <h2 class="yellow">Past Speaker<?php echo ($speaker_count > 1 || $moderator_count > 1) ? 's' : ''; ?></h2>
                                    <p>We are gathering the world's leading and most inspired thinkers from multiple disciplines to inspire your organization to build real-world AI solutions.</p>
                                </div>
                                <div class="col-sm-8 text-right mt30">
                                    <h3 class="green">250+</h3>
                                    <a href="<?php bloginfo('url') ?>/speakers/" class="black-text">Talent Industry Experts</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form--search-field-wrapper form-group" style="position: relative;">
                                        <i class="fa fa-search" style="position: absolute;top: 10px;left: 10px;"></i>
                                        <input class="form--search-field form-control" type="text" value="" placeholder="Search by Name" style="padding-left: 27px;" />
                                    </div>
                                </div>
                            </div>
                            <div class="row speaker-container">
                                <?php get_template_part('template-parts/content', 'speakers'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="container">
                        <div class="row mt50">
                            <div class="col-sm-12">
                                <div class="sponcer-section">
                                    <h2 class="yellow white-text mt-0">Interested in sponsoring?</h2>
                                    <p>the sponsorship prospectus for the<br>MIT AI conference 2019</p>
                                    <a href="https://www.mitcnc.org/app/media/2019/04/AI-Conference-2019-Future-of-Computing-Sponsors-Prospectus.pdf" class="default-btn download-btn mt20" target="_blank">
                                        Download
                                        <i class="icon">
                                            <img src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg">
                                        </i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-11 offset-sm-1">
                                <div class="row">
                                    <div class="col-sm-24">
                                        <div class="white-boxes">
                                            <h2 class="yellow">Become an exhibitor</h2>
                                            <p>More then 40 keynote and friends sessions, and over<br>50 exhibiting startups, this is MIT’s largest event ever.</p>
                                            <a href="https://goo.gl/forms/uQIU94a8DGsWapxr2" target="_blank" class="agenda-link mt70">
                                                Submit an Application
                                                <i class="icon">
                                                    <img src="<?php echo $assets_uri; ?>/images/arrow_right_red.svg">
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-24 mt70">
                                        <div class="white-boxes">
                                            <h2 class="yellow">Become a sponsor</h2>
                                            <p>Inspired thinkers from multiple disciplines to inspire<br>your organization to build real-world AI solutions.</p>
                                            <a href="https://goo.gl/forms/uQIU94a8DGsWapxr2" target="_blank" class="agenda-link mt70">
                                                Get in Touch with us
                                                <i class="icon">
                                                    <img src="<?php echo $assets_uri; ?>/images/arrow_right_red.svg">
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <article class="light-bg mt50">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-14">
                                    <h2 class="yellow">
                                        The world's smartest minds
                                    </h2>
                                    <p>From Amazon to Zeta Venture Partners, we've got an insanely smart group of folks who will discuss where they see the Future of AI and the opportunities that have them excited.</p>
                                </div>
                                <div class="col-sm-24 text-center mt50">
                                    <img  src="<?php echo $assets_uri; ?>/images/mind-logos.png" class="logos-images" alt="">
                                </div>
                            </div>
                        </div>
                    </article> -->
                    <div class="container">
                        <?php
                        if (
                            (
                                (isset($mit_registration['link']) && !empty($mit_registration['link'])) ||
                                (
                                    (
                                        isset($non_mit_registration['embed_widget']) && !empty($non_mit_registration['embed_widget'])
                                    ) ||
                                    !empty($ticket_link_non_mit)
                                )
                            ) &&
                            (strtotime($end_on) >= time() && !$sold_out_flag)
                        ){
                            ?>
                            <div id="section--registration"></div>
                            <!--<hr class="mb60 mt60">-->
                            <div class="row">
                                <div class="col-sm-24 mb30 mt50">
                                    <h2>Registration</h2>
                                </div>
                            </div>
                            <div class="row mb60">
                                <?php
                                if (!empty($mit_registration['link']) ) { ?>
                                    <div class="col-sm-16">
                                        <div class="registration-box">
                                            <h4 class="red-text x-large-text">
                                                <i>
                                                    <img src="<?php echo $assets_uri; ?>/images/logo-mit-only.svg"
                                                         width="50px" alt="MIT Alums">
                                                </i>
                                                ALUMS
                                            </h4>
                                            <?php
                                            if($ticket_registration != null){
                                                foreach ($ticket_registration as $tickets) {
                                                    $meta = $tickets['description'];
                                                    if($meta != null){
                                                        foreach ($meta as $details) {
                                                            if (
                                                                strtotime(date('Y-m-d 00:00:00', strtotime($details['date_start']))) <= time() &&
                                                                strtotime(date('Y-m-d 23:59:59', strtotime($details['date_end']))) >= time()
                                                            ) {
                                                                ?>
                                                                <div class="two-price <?php echo (count($ticket_registration) > 1) ? 'tripple' : ''; ?>">
                                                                    <div class="price red-text"><?php echo $details['price']; ?></div>
                                                                    <p><?php echo !empty($tickets['title']) ? $tickets['title'] : 'Please log in for access to MITCNC member pricing'; ?></p>
                                                                </div>
                                                                <?php break;
                                                            }
                                                        }
                                                    }
                                                }
                                            } else { ?>
                                                <div class="two-price">
                                                    <div class="price red-text">&nbsp;</div>
                                                    <p>&nbsp;</p>
                                                </div>
                                            <?php } ?>
                                            <a class="default-btn"
                                               href="<?php echo !empty($ticket_link) ? $ticket_link : 'javascript:void(0);'; ?>"
                                               class="default-btn">Reserve Now<img
                                                    src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                    alt=""></a>
                                            <p style="color: #555555; font-family: 'Poppins', sans-serif; font-weight: 500; margin: 10px 0 0 0;">Waitlist Tickets (Subject to final confirmation).</p>
                                        </div>
                                    </div>
                                <?php }
                                if (!empty($non_mit_registration['embed_widget']) || !empty($ticket_link_non_mit)) {
                                    ?>
                                    <div class="col-sm-8">
                                        <div class="registration-box ai-confer-registration">
                                            <h4 class="x-large-text">GENERAL ADMISSION</h4>

                                            <?php
                                            if($ticket_registration_non_mit != null) {
                                                foreach ($ticket_registration_non_mit as $tickets) {
                                                    $meta = $tickets['description'];
                                                    if($meta != null){
                                                        foreach ($meta as $details) {
                                                            if (
                                                                strtotime(date('Y-m-d 00:00:00', strtotime($details['date_start']))) <= time() &&
                                                                strtotime(date('Y-m-d 23:59:59', strtotime($details['date_end']))) >= time()
                                                            ) {
                                                                ?>
                                                                <div class="two-price <?php echo (count($ticket_registration_non_mit) > 1) ? 'double' : ''; ?>">
                                                                    <div class="price red-text"><?php echo $details['price']; ?></div>
                                                                    <p style="margin-bottom: 3px;"><?php echo !empty($tickets['title']) ? $tickets['title'] : ''; ?></p>
                                                                </div>
                                                                <?php break;
                                                            }
                                                        }
                                                    }
                                                }
                                            } else { ?>
                                                <div class="two-price">
                                                    <div class="price red-text">&nbsp;</div>
                                                    <p>&nbsp;</p>
                                                </div>
                                                <br>
                                                <br>
                                            <?php }
                                            if (strtotime($end_on) < time()) { ?>
                                                <a href="javascript:void(0);" class="default-btn gray-btn">Reservation
                                                    Closed<img src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                               alt=""></a>
                                            <?php } else if ($sold_out_flag) { ?>
                                                <a href="javascript:void(0);" class="default-btn gray-btn">Sold Out<img
                                                        src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                        alt=""></a>
                                            <?php } else {

                                                if (!empty($non_mit_registration['embed_widget'])) {
                                                    ?>
                                                    <style type="text/css">
                                                        .registration-box button {
                                                            min-width: 205px;
                                                            padding: 14px 20px;
                                                            background-color: #30b630;
                                                            border: 1px solid #30b630;
                                                            text-decoration: none;
                                                            text-transform: uppercase;
                                                            text-align: center;
                                                            color: #ffffff;
                                                            display: inline-block;
                                                            position: relative;
                                                            font-size: 1rem;
                                                            letter-spacing: 2px;
                                                            border-radius: 2px;
                                                            width: 100%;
                                                        }
                                                    </style>
                                                    <?php
                                                    echo $non_mit_registration['embed_widget'];
                                                } else {
                                                    ?>
                                                    <a class="default-btn"
                                                       href="<?php echo !empty($ticket_link_non_mit) ? $ticket_link_non_mit : 'javascript:void(0);'; ?>"
                                                       class="default-btn gray-btn">Reserve Now<img
                                                            src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                    <?php
                                                }
                                                ?>
                                            <?php } ?>
                                            <p style="color: #555555; font-family: 'Poppins', sans-serif; font-weight: 500; margin: 10px 0 0 0;">Waitlist Tickets<br> (Subject to final confirmation).</p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } if (isset($meta_data['media_gallery'][0]) && !empty($meta_data['media_gallery'][0])) { 
                            $meta_data['media_gallery'][0] = is_serialized($meta_data['media_gallery'][0]) ? unserialize($meta_data['media_gallery'][0]) : [$meta_data['media_gallery'][0]];
                            if($meta_data['media_gallery'][0] != null && count($meta_data['media_gallery'][0]) > 0){
                                for ($i = 0; $i < count($meta_data['media_gallery'][0]); $i++){
                                    $event_gallery = get_post($meta_data['media_gallery'][0][$i]);
                                    if($event_gallery != null){
                                        ?>
                                        <?php if(!empty($event_gallery->post_content)){ ?>
                                            <!--<hr class="mb60 mt60">-->
                                            <div class="row" id="past_gallery">
                                                <div class="col-sm-20 mt30">
                                                    <h2 class="yellow">Past Event gallery</h2>
                                                </div>
                                                <div class="col-sm-4 mt70 text-right">
                                                    <a href="<?php bloginfo('url') ?>/watch-learn/photos/" class="view-btn black">View All<img src="<?php echo $assets_uri; ?>/images/arrow_right_red.svg" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-24">
                                                    <?php echo do_shortcode(wpautop($event_gallery->post_content)); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if (have_rows('videos', $event_gallery->ID)) { ?>
                                            <!--<hr class="mb60 mt60">-->
                                            <div class="row">
                                                <div class="col-sm-20 mb40">
                                                    <h2 class="yellow">Past Talks</h2>
                                                </div>
                                                <div class="col-sm-4 mt40 text-right">
                                                    <a href="<?php bloginfo('url') ?>/watch-learn/videos/" class="view-btn black">View All<img src="<?php echo $assets_uri; ?>/images/arrow_right_red.svg" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <?php
                                                $video_count = get_post_meta($event_gallery->ID, 'videos', true);
                                                $inn = 1;
                                                while (have_rows('videos', $event_gallery->ID)) {
                                                    the_row();
                                                    $video_url = get_sub_field('url', $event_gallery->ID);
                                                    $video_thumbnail = get_sub_field('thumbnail', $event_gallery->ID);
                                                    $video_title = get_sub_field('title', $event_gallery->ID);
                                                    ?>
                                                    <div class="col-sm-8">
                                                        <a data-fancybox="gallery-video" href="<?php echo $video_url; ?>"
                                                           class="media-card">
                                                            <div class="media-img">
                                                                <img src="<?php echo $video_thumbnail; ?>" alt="">
                                                            </div>
                                                            <div class="media-content">
                                                                <div class="media-icon-container">
                                                                    <img src="<?php echo $assets_uri; ?>/images/play-icon.png" alt="">
                                                                </div>
                                                                <span class="date"><?php echo $start_on_date; ?></span>
                                                                <h5 class="heading_4 white-text">
                                                                    <?php
                                                                    if(!empty($video_title)){
                                                                        echo $video_title;
                                                                    } else{
                                                                        echo $post->post_title;
                                                                        if($video_count > 1){
                                                                            echo ' - Part '.$inn;
                                                                            $inn++;
                                                                        }
                                                                    }
                                                                    ?>
                                                                </h5>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                            }
                        } ?>
                    </div>
                    <article class="light-bg mt50">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-14">
                                <h2 class="yellow">
                                    Our Partners & Supporters
                                </h2>
                                <p>We've got an insanely smart group of folks who will discuss where they see the Future of AI and the opportunities that have them excited.</p>
                            </div>
                            <div class="col-sm-24 text-center mt50">
                                <div class="partners-supporters">
                                    <img src="<?php echo $assets_uri; ?>/images/partners-supporters.png" class="logos-images img-responsive" alt="" >
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                    <article class="mt50">
                        <div class="container">
                            <div class="row mb60">
                                <div class="col-sm-8">
                                    <div class="white-boxes">
                                        <h3>100+<small>AI Experts</small></h3>
                                        <p>Get the playbook from the best AI experts, data scientists, machine learning engineers, founders, execs, and investors.</p>
                                        <p class="agenda-link mt-5">
                                            No hype. No fluff.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="white-boxes">
                                        <h3>600+<small>Attendees</small></h3>
                                        <p>High density of high caliber engineers, machine learning experts, founders, executives & investors.</p>
                                        <p class="agenda-link mt-5">
                                            Unlike any other AI conference!
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="white-boxes">
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
                    <!-- <article class="light-bg mt50">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-14">
                                    <h2 class="yellow">
                                        Our Partners & Supporters
                                    </h2>
                                    <p>We've got an insanely smart group of folks who will discuss where they see the Future of AI and the opportunities that have them excited.</p>
                                </div>
                                <div class="col-sm-24 text-center mt50">
                                    <img src="<?php echo $assets_uri; ?>/images/partners-logos2.png" class="logos-images img-responsive" alt="" style="max-width: 600px;width: 100%;margin: 0 auto;">
                                </div>
                            </div>
                        </div>
                    </article> -->
                    <div class="container">
                        <?php if (!empty($event_map)) { ?>
                            <div class="row event-map" id="map-container">
                                <div class="col-sm-14 mt60">
                                    <div class="new-mit">
                                        <h2 class="yellow">New to the MIT Club of Northern California?</h2>
                                        <p>Enjoy access to members-only events, early access to popular events, member pricing, vote for board members, and other members-only benefits.</p>
                                    </div>
                                </div>
                                <!--<div class="col-sm-24 mt30">
                                <a href="#" class="big-green-btn">
                                    <h4>Join the MIT Club of Northern California today</h4>
                                    <p>Membership is open to all MIT graduates.</p>
                                    <i class="icon">
                                        <img src="<?php /*echo $assets_uri; */?>/images/arrow_right_white.svg" alt="">
                                    </i>
                                </a>
                            </div>-->
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
                                        <?php echo $event_map; ?>
                                    </div>
                                    <div class="map-details">
                                        <p><?php echo $post->post_title; ?>
                                            <small>at</small>
                                            <?php echo $event_address; ?>
                                            <small><?php echo $event_address_1; ?></small>
                                            <?php if (!empty($event_address_2)) {?>
                                                <small><?php echo $event_address_2; ?></small>
                                            <?php } ?>

                                            <small style="display: inline;">
                                                <?php
                                                if(isset($event_address_city['label']) && !empty($event_address_city['label'])){
                                                    echo $event_address_city['label'];
                                                }
                                                if(isset($event_address_city['label']) && !empty($event_address_city['label']) && !empty($event_address_state)){
                                                    echo ', ';
                                                }
                                                if(!empty($event_address_state)){
                                                    echo $event_address_state;
                                                }
                                                if(!empty($event_address_state) && !empty($event_address_postal_code)){
                                                    echo ', ';
                                                }
                                                if(!empty($event_address_postal_code)){
                                                    echo $event_address_postal_code;
                                                }
                                                ?>
                                            </small>

                                        </p>
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <img src="<?php echo $assets_uri; ?>/images/by-car-icon.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <img src="<?php echo $assets_uri; ?>/images/by-walk-icon.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <img src="<?php echo $assets_uri; ?>/images/by-bus-icon.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <img src="<?php echo $assets_uri; ?>/images/by-cycle-icon.jpg" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        get_template_part('template-parts/content', 'upcoming-events'); ?>
                    </div>
                </article>
            <?php endwhile;endif; ?>
        </section>
        <?php get_footer();
    }