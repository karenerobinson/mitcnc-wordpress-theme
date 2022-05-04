<?php
get_header();
global $assets_uri, $post, $event_category_taxonomy, $event_location_taxonomy, $user_profile_page_id, $specific_event, $login_page_id;
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
//    $client_info = file_get_contents('https://geoip.nekudo.com/api');
//    $client_info = !empty($client_info) ? json_decode($client_info) : null;
$sold_out_flag = (isset($meta_data['sold_out'][0])) ? $meta_data['sold_out'][0] : false;
$banner_color = (isset($meta_data['banner_background_color'][0])) ? $meta_data['banner_background_color'][0] : '';
$specific_event = true;
?>

<?php
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
    <section>
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
            <article class="inner-page event-banner-section">
                <div class="container event-banner-container">
                    <div class="row">
                        <?php get_template_part('template-parts/yearly', 'event-links'); ?>
                        <div class="col-sm-24 evb-col">
                            <div class="event-banner custom-event-banner <?php echo !empty($banner) ? '' : 'no-img'; ?>" style="<?php echo !empty($banner) ? 'background-image: url(' . esc_html($banner) . ')' : 'background-color: ' . esc_html($banner_color); ?>">
                            </div>
                            <div class="static-registration-bar">
                                <div class="row">
                                    <div class="col-14 col-sm-12">
                                        <div class="event-name">
                                            <?php echo esc_html($post->post_title); ?>
                                        </div>
                                        <div class="event-date-time">
                                            <?php echo esc_html(date('M d', strtotime($start_on))); ?><?php echo (isset($event_location[0])) ? ' - ' . esc_html($event_location[0]->name) : ''; ?>
                                        </div>
                                    </div>
                                    <div class="col-8 col-sm-12 text-right">
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
                                                <?php /* <a href="<?php echo !empty($reservation_link) ? $reservation_link : 'javascript:void(0);'; ?>" class="default-btn">Reserve Now<img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt=""></a> */ ?>
                                                
                                                <?php if (isset($meta_data['registration_3_affiliate_reservation_link']) && count($meta_data['registration_3_affiliate_reservation_link']) > 0 && !empty($meta_data['registration_3_affiliate_reservation_link'][0])) : ?>
                                                    <a href="<?php echo esc_attr($meta_data['registration_3_affiliate_reservation_link'][0]); ?>" target="_blank" class="default-btn">Reserve Now<img
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
                                        <a href="<?php echo esc_attr($meta_data['registration_3_affiliate_reservation_link'][0]); ?>" class="default-btn mb20">Reserve Now<img
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
                                        Add this event to Calendar
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
                                                        <b class="uppercase-font">Contacts</b><br>
                                                                <?php
                                                                while (have_rows('primary')) {
                                                                    the_row();
                                                                    echo '<p style="margin-bottom: -5px; margin-top: 10px;">' . esc_html(get_sub_field('name')) . '</p>';
                                                                    // echo '<br> ';
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
                                            /* if (
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
                                            } */
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
                                        $speakers_casting[] = (object) array('ID' => $speaker);
                                    }
                                    $speakers = $speakers_casting;
                                }
                                    $__total_count = (
                                        (!empty($speakers_ids) ? (int) count(explode(',', $speakers_ids)) : 0) +
                                        (!empty($moderators_ids) ? (int) count(explode(',', $moderators_ids)) : 0)
                                    );
                                ?>
                     
                    <a href="https://www.mitcnc.org/mit-ai-conference-2019-idol/"target="_blank">
                        <div class="page-idol-link"></div>
                    </a>
                    
                    <div class="row mt70">
                        <div class="col-sm-10">
                            <div class="white-boxes">
                                <h2 class="yellow">Agenda</h2>
                                <a href="https://www.mitcnc.org/mit-ai-conference-2019-agenda/"  class="agenda-link mt-3" target="_blank">View the full agenda here</a><br>
                                <a href="#" class="agenda-link mt70">
                                    Suggest a Topic
                                    <i class="icon">
                                        <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg">
                                    </i>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 offset-sm-1">
                            <div class="white-boxes">
                                <h3><?php echo esc_html($__total_count); ?>+<small>Speakers</small></h3>
                                <a href="https://airtable.com/shrMcGoCdUyOYGioe" target="_blank" class="agenda-link mt-5">
                                    Suggest a Speaker
                                    <i class="icon">
                                        <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg">
                                    </i>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 offset-sm-1">
                            <div class="white-boxes">
                                <h3>20+<small>Companies</small></h3>
                                <a href="#past_gallery" class="agenda-link mt-5">
                                    View 2018 Gallery
                                    <i class="icon">
                                        <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
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
                                <h2 class="yellow">Speaker<?php echo ($__total_count > 1) ? 's' : ''; ?></h2>
                                <p>We are gathering the world's leading and most inspired thinkers from multiple disciplines to inspire your organization to build real-world AI solutions.</p>
                            </div>
                            <div class="col-6 col-sm-8 text-right mt30">
                                <h3 class="green"><?php echo esc_html($__total_count); ?>+</h3>
                                <p class="black-text">Industry Experts</p>
                            </div>
                        </div>
                        <div class="row speaker-container">
                            <?php get_template_part('template-parts/content', 'speakers'); ?>
                            <div class="col-12 col-lg-6 col-md-12 mt40 ">
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
                            </div>
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
                                    <!-- <a href="https://airtable.com/shrMcGoCdUyOYGioe" target="_blank" class="agenda-link mt70">
                                        Suggest a Speaker
                                        <i class="icon">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg">
                                        </i>
                                    </a> -->
                                </div>
                            </div>
                        </div>
                                <?php } ?>
                    <div class="link-banner">
                        <a href="<?php bloginfo('url'); ?>/speakers/" target="_blank">
                            <img style="width:100%;" src="<?php echo esc_url($assets_uri); ?>/images/Past-Speaker-banner.png" />
                        </a>
                    </div>
                    <!-- <div class="row mt50">
                        <div class="col-sm-12">
                            <div class="sponcer-section">
                                <h2 class="yellow white-text mt-0">Interested in sponsoring?</h2>
                                <p>the sponsorship prospectus for the<br>MIT AI conference 2019</p>
                                <a href="https://www.mitcnc.org/app/media/2019/07/AI-Conference-2019-Future-of-Computing-Sponsors-Prospectus.pdf" class="default-btn download-btn mt20" target="_blank">
                                    Download
                                    <i class="icon">
                                        <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg">
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
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg">
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
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg">
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="link-banner">
                        <a href="https://www.mitcnc.org/mit-ai-conference-2019-idol/">
                            <img style="width:100%;" src="https://www.mitcnc.org/app/media/2019/08/idol-link-banner.jpg">
                        </a>
                    </div> -->
                </div>
                
                <article class="light-bg mt50">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-14">
                                <h2 class="yellow">
                                    The world's smartest minds
                                </h2>
                                <p>From Amazon to Zetta Venture Partners, we've got an insanely smart group of folks who will discuss where they see the Future of AI and the opportunities that have them excited.</p>
                            </div>
                            <div class="col-sm-24 text-center mt50">
                                <img  src="<?php echo esc_url($assets_uri); ?>/images/mind-logos.png" class="logos-images" alt="">
                            </div>
                        </div>
                    </div>
                </article>
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
                                ) {
                                    ?>
                        <div id="section--registration"></div>
                        <!--<hr class="mb60 mt60">-->
                        <div class="row">
                            <div class="col-sm-24 mb30 mt50">
                                <h2>Registration</h2>
                            </div>
                        </div>
                        <div class="row mb60">
                                        <?php if (is_mitcnc_member(get_current_user_id())) : ?>
                                            <?php
                                            if (!empty($mit_registration['link'])) {
                                                ?>
                                    <div class="col-sm-16">
                                        <div class="registration-box">
                                            <h4 class="red-text x-large-text">
                                                <i>
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/logo-mit-only.svg"
                                                        width="50px" alt="MIT Alums">
                                                </i>
                                                ALUMS
                                            </h4>
                                                <?php
                                                if (null != $ticket_registration) {
                                                    foreach ($ticket_registration as $tickets) {
                                                        $meta = $tickets['description'];
                                                        if (null != $meta) {
                                                            foreach ($meta as $details) {
                                                                if (
                                                                    strtotime(date('Y-m-d 00:00:00', strtotime($details['date_start']))) <= time() &&
                                                                    strtotime(date('Y-m-d 23:59:59', strtotime($details['date_end']))) >= time()
                                                                ) {
                                                                    ?>
                                                                <div class="two-price <?php echo (count($ticket_registration) > 1) ? 'tripple' : ''; ?>">
                                                                    <div class="price red-text"><?php echo esc_html($details['price']); ?></div>
                                                                    <p><?php echo !empty($tickets['title']) ? esc_html($tickets['title']) : 'Please log in for access to MITCNC member pricing'; ?></p>
                                                                </div>
                                                                    <?php
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                <div class="two-price">
                                                    <div class="price red-text">&nbsp;</div>
                                                    <p>&nbsp;</p>
                                                </div>
                                                <?php } ?>

                                                <?php if (isset($meta_data['registration_3_affiliate_reservation_link']) && count($meta_data['registration_3_affiliate_reservation_link']) > 0 && !empty($meta_data['registration_3_affiliate_reservation_link'][0])) : ?>
                                                <a class="default-btn"
                                            href="<?php echo esc_attr($meta_data['registration_3_affiliate_reservation_link'][0]); ?>"
                                            class="default-btn">Reserve Now<img
                                                        src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                        alt=""></a>
                                                <?php else : ?>
                                            <a class="default-btn"
                                            href="<?php echo (esc_attr(get_current_user_id()) > 0) ? (!empty($ticket_link) ? $ticket_link : 'javascript:void(0);') : esc_url(get_permalink($login_page_id)); ?>"
                                            class="default-btn">Reserve Now<img
                                                        src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                        alt=""></a>
                                            <p style="color: #555555; font-family: 'Poppins', sans-serif; font-weight: 500; margin: 10px 0 0 0;">Waitlist Tickets(Subject to final confirmation).</p>
                                                <?php endif; ?>
                                        </div>
                                    </div>
                                                <?php
                                            }
                                            ?>
                                        <?php else : ?>
                                            <?php
                                            if (!empty($mit_registration['link'])) {
                                                ?>
                                    <div class="col-sm-16">
                                        <div class="registration-box">
                                            <h4 class="red-text x-large-text">
                                                <i>
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/logo-mit-only.svg"
                                                        width="50px" alt="MIT Alums">
                                                </i>
                                                ALUMS
                                            </h4>
                                                <?php
                                                if (null != $ticket_registration) {
                                                    foreach ($ticket_registration as $tickets) {
                                                        $meta = $tickets['description'];
                                                        if (null != $meta) {
                                                            foreach ($meta as $details) {
                                                                if (
                                                                    strtotime(date('Y-m-d 00:00:00', strtotime($details['date_start']))) <= time() &&
                                                                    strtotime(date('Y-m-d 23:59:59', strtotime($details['date_end']))) >= time()
                                                                ) {
                                                                    ?>
                                                                <div class="two-price <?php echo (count($ticket_registration) > 1) ? 'tripple' : ''; ?>">
                                                                    <div class="price red-text"><?php echo esc_html($details['price']); ?></div>
                                                                    <p><?php echo !empty($tickets['title']) ? esc_html($tickets['title']) : 'Please log in for access to MITCNC member pricing'; ?></p>
                                                                </div>
                                                                    <?php
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                <div class="two-price">
                                                    <div class="price red-text">&nbsp;</div>
                                                    <p>&nbsp;</p>
                                                </div>
                                                <?php } ?>

                                                        <?php if (isset($meta_data['registration_3_affiliate_reservation_link']) && count($meta_data['registration_3_affiliate_reservation_link']) > 0 && !empty($meta_data['registration_3_affiliate_reservation_link'][0])) : ?>
                                                <a class="default-btn"
                                            href="<?php echo esc_attr($meta_data['registration_3_affiliate_reservation_link'][0]); ?>"
                                            class="default-btn">Reserve Now<img
                                                        src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                        alt=""></a>
                                                        <?php else : ?>
                                            <a class="default-btn"
                                            href="<?php echo (esc_attr(get_current_user_id()) > 0) ? (!empty($ticket_link) ? $ticket_link : 'javascript:void(0);') : esc_url(get_permalink($login_page_id)); ?>"
                                            class="default-btn">Reserve Now<img
                                                        src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                        alt=""></a>
                                            <p style="color: #555555; font-family: 'Poppins', sans-serif; font-weight: 500; margin: 10px 0 0 0;">Waitlist Tickets(Subject to final confirmation).</p>
                                                        <?php endif; ?>
                                        </div>
                                    </div>
                                                <?php
                                            }
                                            if (!empty($non_mit_registration['embed_widget']) || !empty($ticket_link_non_mit)) {
                                                ?>
                                    <div class="col-sm-8">
                                    <div class="registration-box ai-confer-registration">
                                        <h4 class="x-large-text">GENERAL ADMISSION</h4>

                                                    <?php
                                                    if (null != $ticket_registration_non_mit) {
                                                        foreach ($ticket_registration_non_mit as $tickets) {
                                                            $meta = $tickets['description'];
                                                            if (null != $meta) {
                                                                foreach ($meta as $details) {
                                                                    if (
                                                                        strtotime(date('Y-m-d 00:00:00', strtotime($details['date_start']))) <= time() &&
                                                                        strtotime(date('Y-m-d 23:59:59', strtotime($details['date_end']))) >= time()
                                                                    ) {
                                                                        ?>
                                                            <div class="two-price <?php echo (count($ticket_registration_non_mit) > 1) ? 'double' : ''; ?>">
                                                                <div class="price red-text"><?php echo esc_html($details['price']); ?></div>
                                                                <p style="margin-bottom: 3px;"><?php echo !empty($tickets['title']) ? esc_html($tickets['title']) : ''; ?></p>
                                                            </div>
                                                                        <?php
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        ?>
                                            <div class="two-price">
                                                <div class="price red-text">&nbsp;</div>
                                                <p>&nbsp;</p>
                                            </div>
                                            <br>
                                            <br>
                                                        <?php
                                                    }
                                                    if (strtotime($end_on) < time()) {
                                                        ?>
                                            <a href="javascript:void(0);" class="default-btn gray-btn">Reservation
                                                Closed<img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                        alt=""></a>
                                                    <?php } else if ($sold_out_flag) { ?>
                                            <a href="javascript:void(0);" class="default-btn gray-btn">Sold Out<img
                                                        src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                        alt=""></a>
                                                        <?php
                                                    } else {
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
                                                            echo filter_var($non_mit_registration['embed_widget'], FILTER_UNSAFE_RAW);
                                                        } else {
                                                            ?>
                                                <a class="default-btn"
                                                href="<?php echo (esc_attr(get_current_user_id()) > 0) ? (!empty($ticket_link_non_mit) ? $ticket_link_non_mit : 'javascript:void(0);') : esc_url(get_permalink($login_page_id)); ?>"
                                                class="default-btn gray-btn">Reserve Now<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    <?php } ?>
                                        <p style="color: #555555; font-family: 'Poppins', sans-serif; font-weight: 500; margin: 10px 0 0 0;">Waitlist Tickets <br>(Subject to final confirmation).</p>
                                    </div>
                                    </div>
                                            <?php } ?>
                                        <?php endif; ?>
                        </div>
                                    <?php
                                } if (isset($meta_data['media_gallery'][0]) && !empty($meta_data['media_gallery'][0])) {
                                    $meta_data['media_gallery'][0] = is_serialized($meta_data['media_gallery'][0]) ? unserialize($meta_data['media_gallery'][0]) : array($meta_data['media_gallery'][0]);
                                    if (null != $meta_data['media_gallery'][0] && count($meta_data['media_gallery'][0]) > 0) {
                                        $meta_data_media_galery_count = count($meta_data['media_gallery'][0]);
                                        for ($i = 0; $i < $meta_data_media_galery_count; $i++) {
                                            $event_gallery = get_post($meta_data['media_gallery'][0][$i]);
                                            if (null != $event_gallery) {
                                                ?>
                                                <?php if (!empty($event_gallery->post_content)) { ?>
                                        <div class="row" id="past_gallery">
                                            <div class="col-sm-20 mt30">
                                                <h2 class="yellow">Past Event gallery</h2>
                                            </div>
                                            <div class="col-sm-4 mt70 text-right">
                                                <a href="<?php bloginfo('url'); ?>/watch-learn/photos/" class="view-btn black">View All<img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg" alt=""></a>
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
                                                <a href="<?php bloginfo('url'); ?>/watch-learn/videos/" class="view-btn black">View All<img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg" alt=""></a>
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
                                                        <a data-fancybox="gallery-video" href="<?php echo esc_url($video_url); ?>"
                                                           class="media-card">
                                                            <div class="media-img">
                                                                <img src="<?php echo esc_url($video_thumbnail); ?>" alt="">
                                                            </div>
                                                            <div class="media-content">
                                                                <div class="media-icon-container">
                                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/play-icon.png" alt="">
                                                                </div>
                                                                
                                                                <h5 class="heading_4 white-text">
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
                                }
                                ?>
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
                                    <img src="<?php echo esc_url($assets_uri); ?>/images/partners-supporters.png" class="logos-images img-responsive" alt="" >
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
                                    <h2 class="yellow">New to the MIT Club of Northern California?</h2>
                                    <p>Enjoy access to members-only events, early access to popular events, member pricing, vote for board members, and other members-only benefits.</p>
                                </div>
                            </div>
                            <!--<div class="col-sm-24 mt30">
                                <a href="#" class="big-green-btn">
                                    <h4>Join the MIT Club of Northern California today</h4>
                                    <p>Membership is open to all MIT graduates.</p>
                                    <i class="icon">
                                        <img src="<?php /*echo $assets_uri; */ ?>/images/arrow_right_white.svg" alt="">
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
