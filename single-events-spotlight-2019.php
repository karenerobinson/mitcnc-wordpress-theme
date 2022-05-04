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
        [$post->ID]
    );
    $speakers = (isset($meta_data['speakers_list'][0]) && !empty($meta_data['speakers_list'][0])) ? unserialize($meta_data['speakers_list'][0]) : null;
    $speakers_ids = '';
    $speakers_casting = null;
    if ($speakers != null) {
        $speakers_ids = implode(',', $speakers);
        foreach ($speakers as $speaker) {
            $speakers_casting[] = (object)['ID' => $speaker];
        }
        $speakers = $speakers_casting;
    }

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
    $table_of_purchase_registration = [
        'link' => (isset($meta_data['registration_2_table_purchase_link'][0])) ? $meta_data['registration_2_table_purchase_link'][0] : '',
        'details' => [],
    ];
    //    $client_info = file_get_contents('https://geoip.nekudo.com/api');
    //    $client_info = !empty($client_info) ? json_decode($client_info) : null;
    $sold_out_flag = (isset($meta_data['sold_out'][0])) ? $meta_data['sold_out'][0] : false;
    $banner_color = (isset($meta_data['banner_background_color'][0])) ? $meta_data['banner_background_color'][0] : '';

    $ticket_registration = get_field('registration_2_mit_details', $post->ID);
    $ticket_link = get_field('registration_2_mit_link', $post->ID);
    $ticket_link_non_mit = get_field('registration_2_non_mit_link', $post->ID);
    $ticket_registration_non_mit = get_field('registration_2_non_mit_details', $post->ID);
    $ticket_registration_table_purchase = get_field('registration_2_table_purchase_details', $post->ID);

    $platinum_sponsor = get_field('platinum_sponsor_platinum_details', $post->ID);
    $gold_sponsor = get_field('gold_sponsor_gold_details', $post->ID);

    //$color_palette = get_field('color_palette_color_list',$post->ID);
    //$cs_color_palette = get_field('colors',$post->ID);

    $after_content = get_field('after_content', $post->ID);
?>
    <style>
        .registration-box .two-price.four-col {
            width: calc(50% - 4px);
        }
        .registration-box .default-btn{
            font-size: 12px;
            min-width: auto;
        }
        @media(max-width: 640px){
            .registration-box .default-btn{
                margin-bottom: 15px;
            }
        }
    </style>
    <section>
        <?php if (have_posts()): while (have_posts()): the_post(); ?>
            <article class="inner-page event-banner-section">
                <div class="container event-banner-container">
                    <div class="row">
                        <?php
                            if( $post->ID == 1955 || $post->ID == 2576 ){
                                get_template_part('template-parts/yearly', 'event-links');
                            }
                        ?>
                        <div class="col-sm-24 evb-col">
                            <div class="event-banner <?php echo !empty($banner) ? '' : 'no-img'; ?>"
                                 style="<?php echo !empty($banner) ? 'background-image: url(' . $banner . ')' : 'background-color: ' . $banner_color; ?>">
                                <!-- <div class="event-info mit-event">
                                    <div class="event-tag">
                                        <?php //echo (isset($event_type[0])) ? $event_type[0]->name : ''; ?>
                                    </div>
                                    <div class="event-title">
                                        <?php //echo $post->post_title; ?>
                                    </div>
                                    <div class="event-date-loc" style="color: #ffffff;">
                                        <?php //echo date('M d', strtotime($start_on)); ?><?php //echo (isset($event_location[0])) ? ' - ' . $event_location[0]->name : ''; ?>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-sm-12 offset-sm-12">
                                        <ul class="banner-speakers">
                                            <?php
                                            if ($speakers != null) {
                                                foreach ($speakers as $keey => $speaker) {
                                                    $img = get_field('profile_image', 'user_' . $speaker->ID);
                                                    $img = !empty($img) ? $img : $assets_uri . '/images/placeholder.png';
                                                    $speaker_mit_status = is_mit_alum($speaker->ID);
                                                    $full_name = get_field('full_name', 'user_' . $speaker->ID);
                                                    $last_name = get_field('user_last_name', 'user_' . $speaker->ID);
                                                    $designation = [];
                                                    if (have_rows('designations', 'user_' . $speaker->ID)) {
                                                        while (have_rows('designations', 'user_' . $speaker->ID)) {
                                                            the_row();
                                                            $designation[] = get_sub_field('designation_title', 'user_' . $speaker->ID);
                                                        }
                                                    }
                                                    $team = [];
                                                    if (have_rows('teams', 'user_' . $speaker->ID)) {
                                                        while (have_rows('teams', 'user_' . $speaker->ID)) {
                                                            the_row();
                                                            $team[] = get_sub_field('company', 'user_' . $speaker->ID);
                                                        }
                                                    }

                                                    $companies = [];
                                                    if (have_rows('positions', 'user_' . $speaker->ID)) {
                                                        while (have_rows('companies', 'user_' . $speaker->ID)) {
                                                            the_row();
                                                            $companies[] = get_sub_field('company_name', 'user_' . $speaker->ID);
                                                        }
                                                    }
//                                                    $job_title = get_field('job_title', 'user_' . $speaker->ID);


                                                    ?>
                                                    <li style="width: 26%;">
                                                        <a href="<?php echo get_author_posts_url($speaker->ID); ?>"
                                                           class="speaker-box">
                                                            <span class="speaker-img">
                                                                <img src="<?php echo $img ?>" alt="">
                                                                <?php if ($speaker_mit_status) { ?>
                                                                    <div class="icon-mit"
                                                                         >
                                                                                <img src="<?php echo $assets_uri; ?>/images/mit-icon.svg" alt="">
                                                                            </div>
                                                                <?php } ?>
                                                            </span>
                                                            <span class="speaker-title-desg">
                                                                <?php echo $full_name . ' ' . $last_name; ?>
                                                                <h6 style="font-size: 13px;font-weight: normal;margin-top: 2px;">
                                                                    <?php echo ($companies != null) ? implode(', ', $companies) : ''; ?>
                                                                </h6>
                                                                <?php
                                                                    $job_title = get_field('positions','user_' . $speaker->ID);
                                                                    $company = get_field('positions','user_' . $speaker->ID);
                                                                    if($company != null){
                                                                    foreach($company as $company_name){ ?>
                                                                        <span class="designation"><?php echo $company_name['company']; ?></span><br>
                                                                <?php }} ?>

                                                            </span>
                                                        </a>

                                                    </li>
                                                    <?php
                                                }
                                            }
                                            if ($moderators != null) {
                                                foreach ($moderators as $keey => $moderator) {
                                                    $img = get_field('profile_image', 'user_' . $moderator->ID);
                                                    $img = !empty($img) ? $img : $assets_uri . '/images/placeholder.png';
                                                    $full_name = get_field('full_name', 'user_' . $moderator->ID);
                                                    $last_name = get_field('user_last_name', 'user_' . $moderator->ID);
                                                    $designation = [];
                                                    if (have_rows('designations', 'user_' . $moderator->ID)) {
                                                        while (have_rows('designations', 'user_' . $moderator->ID)) {
                                                            the_row();
                                                            $designation[] = get_sub_field('designation_title', 'user_' . $moderator->ID);
                                                        }
                                                    }
                                                    $team = [];
                                                    if (have_rows('teams', 'user_' . $moderator->ID)) {
                                                        while (have_rows('teams', 'user_' . $moderator->ID)) {
                                                            the_row();
                                                            $team[] = get_sub_field('team_name', 'user_' . $moderator->ID);
                                                        }
                                                    }

                                                    $companies = [];
                                                    if (have_rows('companies', 'user_' . $moderator->ID)) {
                                                        while (have_rows('companies', 'user_' . $moderator->ID)) {
                                                            the_row();
                                                            $companies[] = get_sub_field('company_name', 'user_' . $moderator->ID);
                                                        }
                                                    }
                                                    $job_title = get_field('job_title', 'user_' . $moderator->ID);

                                                    ?>
                                                    <li>
                                                        <a href="<?php echo get_author_posts_url($moderator->ID); ?>"
                                                           class="speaker-box">
                                                                    <span class="speaker-img">
                                                                        <img src="<?php echo $img ?>" alt="">
                                                                    </span>
                                                            <span class="speaker-title-desg">
                                                                        <?php echo $full_name. $last_name; ?>
                                                                        <?php if($companies != null){ ?>
                                                                            <h6>
                                                                                <?php echo ($companies != null) ? implode(', ', $companies) : ''; ?>
                                                                            </h6>
                                                                        <?php } ?>
                                                                <?php
                                                                $job_title = get_field('positions','user_' . $moderator->ID);
                                                                $company = get_field('positions','user_' . $moderator->ID);
                                                                if($company != null){
                                                                    foreach($company as $company_name){
                                                                        ?>
                                                                        <span class="designation"><?php echo $company_name['company']; ?></span><br>
                                                                    <?php }} ?>
                                                                        <span class="tags-box">
                                                                            <span class="tag">Moderator</span>
                                                                        </span>
                                                                    </span>
                                                        </a>

                                                    </li>
                                                    <?php
                                                }
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
                                                <?php if(isset($meta_data['registration_3_affiliate_reservation_link']) && count($meta_data['registration_3_affiliate_reservation_link']) > 0 && !empty($meta_data['registration_3_affiliate_reservation_link'][0])): ?>
                                                    <a href="<?php echo $meta_data['registration_3_affiliate_reservation_link'][0]; ?>" class="default-btn">Reserve Now<img
                                                            src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                <?php else: ?>
                                                <a href="#section--registration" class="default-btn">Reserve Now<img
                                                            src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
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
                            <?php echo wpautop($post->post_content); ?>
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
                                    <?php /* <a href="<?php echo !empty($reservation_link) ? $reservation_link : 'javascript:void(0);'; ?>" class="default-btn mb20">Reserve Now<img src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg" alt=""></a> */ ?>
                                    <?php if(isset($meta_data['registration_3_affiliate_reservation_link']) && count($meta_data['registration_3_affiliate_reservation_link']) > 0 && !empty($meta_data['registration_3_affiliate_reservation_link'][0])): ?>
                                        <a href="<?php echo $meta_data['registration_3_affiliate_reservation_link'][0]; ?>" target="_blank" class="default-btn mb20">Reserve Now<img
                                                src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                alt=""></a>

                                    <?php else: ?>
                                    <a href="#section--registration" class="default-btn mb20">Reserve Now<img
                                                src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                alt=""></a>
                                    <?php endif; ?>

                                <?php } ?>
                                <p>
                                    <b class="increase-font">Date and Time</b><br>
                                    <?php echo $start_on_date; ?> <?php echo ($start_on_date != $end_on_date) ? ' - ' . $end_on_date : ''; ?>
                                    <br>
                                    <?php echo $start_on_time; ?> - <?php echo $end_on_time; ?> PT<br>
                                    <a href="javascript:void(0);" class="addeventatc">
                                        Add to Calendar
                                        <span class="start"><?php echo date('m/d/Y h:i A', strtotime($start_on)); ?></span>
                                        <span class="end"><?php echo date('m/d/Y h:i A', strtotime($end_on)); ?></span>
                                        <span class="timezone">PKT<?php //echo ($client_info != null && isset($client_info->location->time_zone)) ? $client_info->location->time_zone : 'Asia/Karachi'; ?></span>
                                        <span class="title"><?php echo $post->post_title; ?></span>
                                        <span class="description">For details, click here: <?php echo get_permalink($post->ID); ?></span>
                                        <span class="location"><?php echo $event_address_1 . $event_address_2; ?></span>
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
                                                    <p>
                                                        <b class="increase-font">Primary Contact</b><br>
                                                        <?php
                                                            while ( have_rows('primary') ){
                                                                the_row(); 
                                                                echo get_sub_field('name'); 
                                                                echo '<br>';
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
                                        <b class="increase-font">Secondary Contact</b><br>
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
                    
                    <?php  if(!empty($after_content)){ ?>
                        <div class="row mt30">
                            <div class="col-sm-24">
                                <?php echo $after_content; ?>
                            </div>
                         
                        </div>
                    <?php } ?>
                    <?php if ($speakers != null || $moderators != null) {

                        $speaker_count = ($speakers != null) ? count($speakers) : 0;
                        $moderator_count = ($moderators != null) ? count($moderators) : 0;
                        ?>
                        <div class="row">
                            <div class="col-sm-24">
                                <h2>Speaker<?php echo ($speaker_count > 1 || $moderator_count > 1) ? 's' : ''; ?></h2>
                            </div>
                        </div>
                    <?php } ?>
                    <?php get_template_part('template-parts/content', 'speakers'); ?>
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
                        <hr class="mb60 mt60">
                        <div class="row">
                            <div class="col-sm-24 mb30">
                                <h2>Registration</h2>
                            </div>
                        </div>
                        <div class="row mb60">
                            <?php if(is_mitcnc_member(get_current_user_id())): ?>
                            <?php
                                if (!empty($mit_registration['link']) ) { ?>
                                    <div class="col-sm-9">
                                        <div class="registration-box spot-light-reg ">
                                            <h4 class="red-text x-large-text bottom-space">
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
                                                                <div class="two-price alums-price <?php echo (count($ticket_registration) > 1) ? 'four-col' : ''; ?>">
                                                                    <div style="font-size:31px" class="price red-text"><?php echo $details['price']; ?></div>
                                                                    <p style="width:100%;"><?php echo !empty($tickets['title']) ?   $tickets['title'] : ''; ?></p>
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

                                            <?php if(isset($meta_data['registration_3_affiliate_reservation_link']) && count($meta_data['registration_3_affiliate_reservation_link']) > 0 && !empty($meta_data['registration_3_affiliate_reservation_link'][0])): ?>
                                                <a class="default-btn"
                                            href="<?php echo $meta_data['registration_3_affiliate_reservation_link'][0]; ?>"
                                            class="default-btn">Reserve Now<img
                                                        src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                        alt=""></a>

                                            <?php else: ?>
                                            <a class="default-btn"
                                            href="<?php echo (get_current_user_id() > 0) ? (!empty($ticket_link) ? $ticket_link : 'javascript:void(0);') : get_permalink($login_page_id); ?>"
                                            class="default-btn">Reserve Now<img
                                                        src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                        alt=""></a>
                                                        <p class="login-registration">Please log in for access to MITCNC member pricing</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php else: ?>
                                <?php
                                if (!empty($mit_registration['link']) ) { ?>
                                    <div class="col-sm-9">
                                        <div class="registration-box spot-light-reg ">
                                            <h4 class="red-text x-large-text bottom-space">
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
                                                                <div class="two-price alums-price <?php echo (count($ticket_registration) > 1) ? 'four-col' : ''; ?>">
                                                                    <div style="font-size:31px" class="price red-text"><?php echo $details['price']; ?></div>
                                                                    <p style="width:100%;"><?php echo !empty($tickets['title']) ?   $tickets['title'] : ''; ?></p>
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

                                            <?php if(isset($meta_data['registration_3_affiliate_reservation_link']) && count($meta_data['registration_3_affiliate_reservation_link']) > 0 && !empty($meta_data['registration_3_affiliate_reservation_link'][0])): ?>
                                                <a class="default-btn" href="<?php echo $meta_data['registration_3_affiliate_reservation_link'][0]; ?>" class="default-btn">Reserve Now
                                                <img src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                        alt=""></a>

                                            <?php else: ?>
                                            <a class="default-btn"
                                            href="<?php echo (get_current_user_id() > 0) ? (!empty($ticket_link) ? $ticket_link : 'javascript:void(0);') : get_permalink($login_page_id); ?>"
                                            class="default-btn">Reserve Now<img
                                                        src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                        alt=""></a>
                                                        <p class="login-registration">Please log in for access to MITCNC member pricing</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php }
                                if (!empty($non_mit_registration['embed_widget']) || !empty($ticket_link_non_mit)) {
                                    ?>
                                    <div class="col-sm-6">
                                    <div class="registration-box spot-light-reg gen">
                                        <h4 class="x-large-text bottom-space-2">GENERAL<br> ADMISSION</h4>

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
                                                                <p style="width:100%;"><?php echo !empty($tickets['title']) ? $tickets['title'] : ''; ?></p>
                                                            </div>
                                                            <?php break;
                                                        }
                                                    }
                                                }
                                            }
                                        } else { ?>
                                            <div class="two-price">
                                                <div class="price red-text">&nbsp;</div>
                                                <p style="margin-bottom: -17px;">&nbsp;</p>
                                            </div>
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

                                                <?php if(isset($meta_data['registration_3_affiliate_reservation_link']) && count($meta_data['registration_3_affiliate_reservation_link']) > 0 && !empty($meta_data['registration_3_affiliate_reservation_link'][0])): ?>

                                                    <a class="default-btn"
                                                href="<?php echo $meta_data['registration_3_affiliate_reservation_link'][0]; ?>"
                                                class="default-btn gray-btn">Reserve Now<img
                                                            src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                <?php else: ?>
                                                <a class="default-btn"
                                                href="<?php echo (get_current_user_id() > 0) ? (!empty($ticket_link_non_mit) ? $ticket_link_non_mit : 'javascript:void(0);') : get_permalink($login_page_id); ?>"
                                                class="default-btn gray-btn">Reserve Now<img
                                                            src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                <?php endif; ?>
                                                <?php
                                            }
                                            ?>
                                        <?php } ?>
                                    </div>
                                    </div>
                                <?php } ?>
                                <?php
                                if (!empty($table_of_purchase_registration['link']) ) { ?>
                                <div class="col-sm-9">
                                    <div class="registration-box spot-light-reg ">
                                        <h4 class="x-large-text bottom-space-2">TABLE OF <br> PURCHASE</h4>
                                        <?php
                                        if($ticket_registration_table_purchase != null){
                                            foreach ($ticket_registration_table_purchase as $tickets) {
                                                $meta = $tickets['description'];
                                                if($meta != null){
                                                    foreach ($meta as $details) {
                                                        if (
                                                            strtotime(date('Y-m-d 00:00:00', strtotime($details['date_start']))) <= time() &&
                                                            strtotime(date('Y-m-d 23:59:59', strtotime($details['date_end']))) >= time()
                                                        ) {
                                                            ?>
                                                            <div class="two-price <?php echo (count($ticket_registration_table_purchase) > 1) ? 'four-col' : ''; ?>">
                                                                <div style="font-size:31px" class="price red-text"><?php echo $details['price']; ?></div>
                                                                <p style="width:100%;"><?php echo !empty($tickets['title']) ? $tickets['title'] : ''; ?></p>
                                                                <a class="default-btn  table-btn" href="<?php echo (get_current_user_id() > 0) ? (!empty($tickets['link']) ? $tickets['link'] : 'javascript:void(0);') : get_permalink($login_page_id); ?>" class="default-btn">Reserve Now<img src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg" alt=""></a>
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
                                        <!-- <a class="default-btn"
                                        href="<?php echo !empty($table_of_purchase_registration['link']) ? $table_of_purchase_registration['link'] : 'javascript:void(0);'; ?>"
                                        class="default-btn">Reserve Now<img
                                                src="<?php echo $assets_uri; ?>/images/arrow_right_white.svg"
                                                alt=""></a>
                                        <p class="login-registration">Please log in for access to MITCNC member pricing</p> -->
                                    </div>
                                </div>
                                <?php } ?>
                            <?php endif; ?>
                        </div>
                        <div class="row">
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
                        </div>
                    <?php }  if (isset($meta_data['media_gallery'][0]) && !empty($meta_data['media_gallery'][0])) {
                        $meta_data['media_gallery'][0] = is_serialized($meta_data['media_gallery'][0]) ? unserialize($meta_data['media_gallery'][0]) : [$meta_data['media_gallery'][0]];
                        if($meta_data['media_gallery'][0] != null && count($meta_data['media_gallery'][0]) > 0){
                            $has_photos = $has_videos = false;
                            // set settings for heading and rows
                            for ($i = 0; $i < count($meta_data['media_gallery'][0]); $i++){
                                $event_gallery = get_post($meta_data['media_gallery'][0][$i]);
                                if($event_gallery != null) {
                                    if(!empty($event_gallery->post_content)){
                                        $has_photos = true;
                                    }
                                    if (have_rows('videos', $event_gallery->ID)) {
                                        $has_videos = true;
                                    }
                                }
                            }
                            // print photos and videos
                            if($has_photos){
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
                                            for ($i = 0; $i < count($meta_data['media_gallery'][0]); $i++){
                                                $event_gallery = get_post($meta_data['media_gallery'][0][$i]);
                                                if($event_gallery != null){
                                                    if(!empty($event_gallery->post_content)){
                                                        echo do_shortcode($event_gallery->post_content);
                                                    }
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            if($has_videos){
                                ?>
                                <hr class="mb60 mt60">
                                <div class="row">
                                    <div class="col-sm-24 mb30">
                                        <h2>Watch</h2>
                                    </div>
                                </div>
                                <div class="row mb60">
                                    <?php
                                    for ($i = 0; $i < count($meta_data['media_gallery'][0]); $i++){
                                        $event_gallery = get_post($meta_data['media_gallery'][0][$i]);
                                        if($event_gallery != null){
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
                                                        <a data-fancybox="gallery-video" href="<?php echo $video_url; ?>"
                                                           class="media-card">
                                                            <div class="media-img">
                                                                <img src="<?php echo $video_thumbnail; ?>" alt="">
                                                            </div>
                                                            <div class="media-content">
                                                                <div class="media-icon-container">
                                                                    <img src="<?php echo $assets_uri; ?>/images/play-icon.png" alt="">
                                                                </div>
                                                                <h6 class="white-text">
                                                                    <span class="date"><?php echo $start_on_date; ?></span>
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
                    if (!empty($event_map)) { ?>
                        <div class="row event-map" id="map-container">
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