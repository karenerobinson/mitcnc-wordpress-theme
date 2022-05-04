<?php
/* Template Name: MIT Event  Agenda */
get_header();
global $assets_uri,
    $post,
    $mit_ai_conference_2020_agenda_detail_page_id,
    $event_access_type_taxonomy,
    $login_page_id,
    $layout,
    $sold_out_flag,
    $end_on,
    $meta_data;

$postEvent = get_field('event', $post->ID);
$event_year = get_field('event_year', $post->ID);
$agendaObject = GetAgendaObject($event_year);
$d            = (isset($_GET['topic']) && !empty($_GET['topic'])) ? filter_var(wp_unslash($_GET['topic']), FILTER_SANITIZE_STRING) : null;

$healthcare_agenda_page_id = 7854;
$ai_conference_agenda_page_id = 6176;
if (isset($postEvent->ID)) {
    $meta_data = get_post_meta($postEvent->ID);
    $banner = get_the_post_thumbnail_url($postEvent->ID, 'thumbnail_1079_474');
    $banner_color = (isset($meta_data['banner_background_color'][0])) ? $meta_data['banner_background_color'][0] : '';
    $eventbrite_event_id = (isset($meta_data['registration_3_eventbrite_event_id'][0])) ? $meta_data['registration_3_eventbrite_event_id'][0] : '';
    $nonce = wp_create_nonce('agenda');
    $sold_out_flag = (isset($meta_data['sold_out'][0])) ? $meta_data['sold_out'][0] : false;
    $end_on = (isset($meta_data['date_time_date_time_end'][0])) ? $meta_data['date_time_date_time_end'][0] : '';
    $reserve_now_btn_text = (isset($meta_data['registration_3_reservation_text'][0]) && !empty($meta_data['registration_3_reservation_text'][0])) ? $meta_data['registration_3_reservation_text'][0] : 'Reserve Now';
    ?>
    <section class="single-events postid-5085">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article class="inner-page event-banner-section">
                    <div class="container event-banner-container">
                    <div class="row">
                            <?php
                            if ($post->ID == $ai_conference_agenda_page_id) :
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
                                        <a class="default-btn" href="<?php echo esc_url(get_permalink($ai_conference_agenda_page_id)); ?>">Agenda & Livestream</a>
                                    </li>
                                </ul>
                            </div> 
                                <?php
                            endif;
                            if ($post->ID == $healthcare_agenda_page_id) :
                                ?>
                            <div class="col-lg-18 col-md-16 col-sm-24 yearly-events top-btn" >
                                <ul>
                                <ul>
                                <li> <a href="<?php echo esc_url(get_permalink(7047)); ?>">Healthcare & Medicine</a> </li>
                                <li > <a href="#speaker-section">Speakers</a> </li>
                                <li>  <a href="<?php echo esc_url(get_permalink(7806)); ?>">Startups</a> </li>
                                <li> <a href="<?php echo esc_url(get_permalink(7818)); ?>">Sponsors</a> </li>
                                </ul>
                                </ul>
                            </div> 
                            <div class="col-lg-6 col-md-8 col-sm-24 top-btn Livestream-btn">
                                <ul>
                                    <li>
                                        <a class="default-btn" href="<?php echo esc_url(get_permalink($healthcare_agenda_page_id)); ?>">Agenda</a>
                                    </li>
                                </ul>
                            </div> 
                                <?php
                            endif;
                            if ($post->ID == $ai_conference_agenda_page_id) :
                                ?>
                            <div class="col-sm-24 evb-col">
                                <div class="event-banner custom-event-banner <?php echo !empty($banner) ? '' : 'no-img'; ?>" style="<?php echo !empty($banner) ? 'background-image: url(' . esc_html($banner) . ')' : 'background-color: ' . esc_html($banner_color); ?>">
                                </div>
                            </div>
                                <?php
                            endif;
                            if ($post->ID == $healthcare_agenda_page_id) :
                                if (!empty('banner_slider_image')) {
                                    ?>
                                        <div class="col-sm-24 p-0 evb-col banner-slider">
                                        <?php
                                        if (have_rows('custom_banner_slider')) :
                                            ?>
                                                <?php
                                                $slider_count = 1; while (have_rows('custom_banner_slider')) :
                                                    the_row();
                                                    ?>
                                                    <div class="event-banner" style="background-image: url('<?php the_sub_field('banner_slider_image'); ?>');">
                                                        <div class="slider-content-box">
                                                            <h1><?php the_sub_field('slider_heading'); ?></h1>
                                                            <p><?php the_sub_field('slider_content'); ?></p>
                                                            <img class="slider-icon" src="<?php the_sub_field('slider_icon'); ?>">
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $slider_count++;
                                                endwhile;
                                                ?>
                                        <?php endif; ?>    
                                        </div>
                                        <?php
                                }
                            endif;
                            ?>
                        </div>
                        <?php if (!empty($agendaObject) && is_array($agendaObject) && count($agendaObject) > 0) : ?>
                            <div class="row">
                                <div class="col-sm-24">
                                    <ul class="agenda-dates-tab">
                                        <?php foreach ($agendaObject as $key => $agenda) : ?>
                                            <?php
                                            if (isset($agenda['date']) && !empty($agenda['date']) && isset($agenda['agenda']) && !empty($agenda['agenda']) && count($agenda['agenda']) > 0) :
                                                $agenda_active_class = '';
                                                if (date('Y-m-d', strtotime($agenda['date']->name)) == date('Y-m-d')) {
                                                    $agenda_active_class = 'active';
                                                }
                                                if (empty($agenda_active_class)) {
                                                    if (isset($agendaObject[0]['date']->name) && strtotime(date('Y-m-d')) <= strtotime(date('Y-m-d', strtotime($agendaObject[0]['date']->name))) && 0 == $key) {
                                                        $agenda_active_class = 'active';
                                                    } else if (isset($agendaObject[count($agendaObject) - 1]['date']->name) && strtotime(date('Y-m-d')) >= strtotime(date('Y-m-d', strtotime($agendaObject[count($agendaObject) - 1]['date']->name))) && (count($agendaObject) - 1) == $key) {
                                                        $agenda_active_class = 'active';
                                                    }
                                                }

                                                $topicName = str_replace(' ', '-', strtolower(get_term_meta($agenda['date']->term_id, 'topic_name', true)));

                                                ?>
                                                <li class="<?php echo esc_attr((isset($d) && !empty($d)) ? (($d == $topicName) ? 'active' : '') : esc_attr($agenda_active_class)); ?>" data-banner="<?php echo esc_url(get_field('banner', 'events-agenda-dates_' . $agenda['date']->term_id)); ?>" data-name="agenda_id_<?php echo isset($agenda['date']->term_id) ? esc_html($agenda['date']->term_id) : ''; ?>" style="display: inline;">

                                                    <a href="javascript:void(0);" class="event-btns right" style="min-width: 150px;" data-name="agenda_id_<?php echo isset($agenda['date']->term_id) ? esc_html($agenda['date']->term_id) : ''; ?>">
                                                        <span class="agenda-tab-topic"><?php echo esc_html(date('d F Y', strtotime($agenda['date']->name))); ?></span>
                                                        <span class="agenda-tab-date"><?php echo esc_attr(get_term_meta($agenda['date']->term_id, 'topic_name', true)); ?></span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="col-lg-12 col-sm-24 pl-4">
                                    <h2 class="blue mb-4 mt-4 d-inline-block" style="margin: 0;">
                                        Agenda
                                    </h2>
                                </div>
                                <div class="col-lg-12 col-sm-24">
                                    <?php
                                    if ($post->ID == $healthcare_agenda_page_id) {
                                        ?>
                                        <ul class="ticket-button">
                                            <li>
                                            <span class="event-date"><?php echo esc_html(date('F d, Y', strtotime(get_post_meta(7047, 'date_time_date_time_start', true)))); ?></span>
                                            <a class="default-btn" href="#section--registration">Get tickets now</a>
                                            </li>
                                        </ul>
                                         <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        <?php endif; ?>
                    </div>
                    <?php if (!empty($agendaObject) && is_array($agendaObject) && count($agendaObject) > 0) : ?>
                        <?php foreach ($agendaObject as $key => $agenda) : ?>
                            <?php if (isset($agenda['date']) && !empty($agenda['date']) && isset($agenda['agenda']) && !empty($agenda['agenda']) && count($agenda['agenda']) > 0) : ?>
                                <?php
                                $agenda_active_class = 'style="display:none;"';
                                if (date('Y-m-d', strtotime($agenda['date']->name)) == date('Y-m-d')) {
                                    $agenda_active_class = '';
                                }

                                if (!empty($agenda_active_class)) {
                                    if (isset($agendaObject[0]['date']->name) && strtotime(date('Y-m-d')) <= strtotime(date('Y-m-d', strtotime($agendaObject[0]['date']->name))) && 0 == $key) {
                                        $agenda_active_class = '';
                                    } else if (isset($agendaObject[count($agendaObject) - 1]['date']->name) && strtotime(date('Y-m-d')) >= strtotime(date('Y-m-d', strtotime($agendaObject[count($agendaObject) - 1]['date']->name))) && (count($agendaObject) - 1) == $key) {
                                        $agenda_active_class = '';
                                    }
                                }

                                $topicName = str_replace(' ', '-', strtolower(get_term_meta($agenda['date']->term_id, 'topic_name', true)));

                                ?>

                                <div class="container agenda-container agenda_id_<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?> " <?php echo esc_attr((isset($d) && !empty($d)) ? (($d == $topicName) ? '' : 'style="display:none;"') : $agenda_active_class); ?>>
                                    <div class="row">
                                        <div class="col-sm-24">
                                            <div class="timeline-agenda">
                                                <?php if (isset($agenda['agenda']) && !empty($agenda['agenda']) && count($agenda['agenda']) > 0) : ?>
                                                    <ul class="timeline-agenda-list">
                                                        <?php foreach ($agenda['agenda'] as $keyy => $agd) : ?>
                                                            <?php $agenda_type = get_field('agenda_type', $agd->ID); ?>
                                                            <?php $schedule_time = get_field('schedule_time', $agd->ID); ?>
                                                            <?php $start_time = get_field('start_time', $agd->ID); ?>
                                                            <?php if (!empty($schedule_time) && !empty($start_time)) : ?>
                                                                <?php $time_in_24_schedule_time = date('H:i:s', strtotime($schedule_time)); ?>
                                                                <?php $time_in_24_start_time = date('H:i:s', strtotime($start_time)); ?>
                                                                <?php $SessionStatusClass = ' '; ?>
                                                                <?php if (strtotime(date('H:i:s')) >= strtotime($time_in_24_schedule_time) && strtotime(date('H:i:s')) <= strtotime($time_in_24_start_time) && strtotime(date('d-m-Y')) == strtotime(date('d-m-Y', strtotime($agenda['date']->name)))) : ?>
                                                                    <?php $SessionStatusClass = 'live'; ?>
                                                                <?php elseif (strtotime(date('H:i:s')) > strtotime($time_in_24_start_time) && strtotime(date('d-m-Y')) == strtotime(date('d-m-Y', strtotime($agenda['date']->name))) || strtotime(date('d-m-Y')) > strtotime(date('d-m-Y', strtotime($agenda['date']->name)))) : ?>
                                                                    <?php $SessionStatusClass = 'watch'; ?>
                                                                <?php else : ?>
                                                                    <?php $SessionStatusClass = 'join-now'; ?>
                                                                <?php endif; ?>

                                                                <li class="aglist <?php echo esc_attr($SessionStatusClass); ?>">

                                                                    <h4 class="date"><?php echo esc_html("{$schedule_time} - {$start_time}"); ?> <span style="font-size:12px;">(PT)</span></h4>
                                                                    <?php if ('Break' == $agenda_type) : ?>
                                                                        <?php $icon = get_field('icon', $agd->ID); ?>
                                                                        <p>
                                                                            <?php if (!empty($icon)) : ?>
                                                                                <img src="<?php echo esc_url($icon); ?>" alt="">
                                                                            <?php endif; ?>
                                                                            <?php echo esc_html($agd->post_title); ?>
                                                                            
                                                                        </p>
                                                                        <ul>
                                                                            <li class="join-now-field">
                                                                                <?php if ($post->ID != $healthcare_agenda_page_id) { ?>
                                                                                    <?php if (!empty($eventbrite_event_id)) : ?>
                                                                                        <?php $time_in_24_schedule_time = date('H:i:s', strtotime($schedule_time)); ?>
                                                                                        <?php $time_in_24_start_time = date('H:i:s', strtotime($start_time)); ?>

                                                                                        <?php if (strtotime(date('H:i:s')) >= strtotime($time_in_24_schedule_time) && strtotime(date('H:i:s')) <= strtotime($time_in_24_start_time) && strtotime(date('d-m-Y')) == strtotime(date('d-m-Y', strtotime($agenda['date']->name)))) : ?>
                                                                                            <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_event_id); ?>" data-agenda_date_id="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>" class="session-join-btn agenda-session-join-btn default-btn live" title='Join "<?php echo esc_html($agd->post_title); ?>"'>
                                                                                                <span class="live-icon">live</span>
                                                                                                Join Now
                                                                                            </a>
                                                                                        <?php elseif (strtotime(date('H:i:s')) > strtotime($time_in_24_start_time) && strtotime(date('d-m-Y')) == strtotime(date('d-m-Y', strtotime($agenda['date']->name))) || strtotime(date('d-m-Y')) > strtotime(date('d-m-Y', strtotime($agenda['date']->name)))) : ?>
                                                                                            <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_event_id); ?>" data-agenda_date_id="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>" class="session-join-btn agenda-session-join-btn default-btn watch" title='Join "<?php echo esc_html($agd->post_title); ?>"'>

                                                                                                Watch

                                                                                            </a>
                                                                                        <?php else : ?>
                                                                                            <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_event_id); ?>" data-agenda_date_id="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>" class="session-join-btn agenda-session-join-btn default-btn join-now" title='Join "<?php echo esc_html($agd->post_title); ?>"'>
                                                                                                Join Now
                                                                                            </a>
                                                                                        <?php endif; ?>


                                                                                        <form action="<?php echo esc_url(get_permalink($mit_ai_conference_2020_agenda_detail_page_id)); ?>" method="POST" class="form-inline agenda-session-join-form" style="display: none;justify-content: flex-end;">
                                                                                            <input class="form-control agenda-join-now" type="email" name="email" placeholder="johndoe@example.com" value="" required style="margin: 0 5px 0 10px; min-width: 250px;">
                                                                                            <input type="hidden" name="agenda_id" value="<?php echo esc_attr($agd->ID); ?>">
                                                                                            <input type="hidden" name="event_cms_id" value="<?php echo esc_attr($postEvent->ID); ?>">
                                                                                            <input type="hidden" name="eventbrite_id" value="<?php echo esc_attr($eventbrite_event_id); ?>">
                                                                                            <input type="hidden" name="agenda_topic" value="<?php echo esc_attr(get_term_meta($agenda['date']->term_id, 'topic_name', true)); ?>">
                                                                                            <input type="hidden" name="agenda_date" value="<?php echo esc_attr(esc_html(date('d F Y', strtotime($agenda['date']->name)))); ?>">
                                                                                            <input type="hidden" name="agenda_date_id" value="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>">
                                                                                            <input type="hidden" name="agenda_year_id" value="<?php echo (isset($event_year->term_id)) ? esc_html($event_year->term_id) : ''; ?>">
                                                                                            <input type="hidden" name="slack_channel_id" value="<?php echo (isset($event_year->term_id)) ? esc_html($event_year->term_id) : ''; ?>">
                                                                                            <input type="hidden" name="agenda_nonce" value="<?php echo esc_attr($nonce); ?>">
                                                                                            <button type="submit" title="Verify" class="submit-btn" style="border: none;font-size: 18px;color: #30b630;cursor: pointer;background: transparent;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                                                                                            <span class="join-error agenda-verification-msg " style="display: none; color: #f00; margin-left: 15px;">error</span>
                                                                                        </form>
                                                                                    <?php endif; ?>
                                                                                <?php } ?>
                                                                            <li>
                                                                        </ul>
                                                                    <?php endif; ?>
                                                                    <?php
                                                                        $disclaimer = get_field('disclaimer', $agd);
                                                                    ?>
                                                                    <?php
                                                                    if (!empty($disclaimer)) {
                                                                        ?>
                                                                        <p class="disclaimer-note"> <?php echo esc_html($disclaimer); ?> </p> 
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <?php if ('Event' == $agenda_type) : ?>
                                                                        <p style="display: inline-block">
                                                                            <?php
                                                                            echo esc_html($agd->post_title);
                                                                            $topic_cat_color = get_field('cat_color', $agd);
                                                                            $topic_cat_name = get_field('cat_name', $agd);
                                                                            ?>
                                                                            <span class="topic-cat" style="background-color: <?php echo esc_attr($topic_cat_color); ?>;"><?php echo esc_html($topic_cat_name); ?></span>
                                                                        </p>
                                                                        <?php $speakers = get_field('speakers', $agd->ID); ?>
                                                                        <?php $moderators = get_field('moderators', $agd->ID); ?>
                                                                        <ul>
                                                                            <?php
                                                                            if (null != $speakers) {
                                                                                foreach ($speakers as $speaker) {
                                                                                    ?>
                                                                                    <li>
                                                                                        <a href="<?php echo esc_url(home_url() . '/' . $speaker->user_nicename); ?>/">
                                                                                            <div>
                                                                                                <?php $profile_image = get_field('profile_image', 'user_' . $speaker->ID); ?>
                                                                                                <?php if (!empty($profile_image)) : ?>
                                                                                                    <img src="<?php echo esc_url($profile_image); ?>" alt="">
                                                                                                <?php endif; ?>
                                                                                                <div class="icon-mit">
                                                                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                                                                </div>
                                                                                            </div>
                                                                                            <span>
                                                                                                <?php echo esc_html(get_field('full_name', 'user_' . $speaker->ID) . ' ' . get_field('user_last_name', 'user_' . $speaker->ID)); ?>

                                                                                                <?php if (have_rows('positions', 'user_' . $speaker->ID)) : ?>
                                                                                                    <?php while (have_rows('positions', 'user_' . $speaker->ID)) : ?>
                                                                                                        <?php the_row(); ?>
                                                                                                        <span class="company"><?php echo esc_html(get_sub_field('company', 'user_' . $speaker->ID)); ?></span>
                                                                                                        <span class="title"><?php echo esc_html(get_sub_field('job_title', 'user_' . $speaker->ID)); ?></span>
                                                                                                        <?php break; ?>
                                                                                                    <?php endwhile; ?>
                                                                                                <?php endif; ?>
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            if (null != $moderators) {
                                                                                foreach ($moderators as $moderator) {
                                                                                    ?>
                                                                                    <li>
                                                                                        <a href="<?php echo esc_url(home_url() . '/' . $moderator->user_nicename); ?>/" >
                                                                                            <div>
                                                                                                <?php $profile_image = get_field('profile_image', 'user_' . $moderator->ID); ?>
                                                                                                <?php if (!empty($profile_image)) : ?>
                                                                                                    <img src="<?php echo esc_url($profile_image); ?>" alt="">
                                                                                                <?php endif; ?>
                                                                                                <div class="icon-mit">
                                                                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                                                                </div>
                                                                                            </div>
                                                                                            <span>
                                                                                                <?php echo esc_html(get_field('full_name', 'user_' . $moderator->ID) . ' ' . get_field('user_last_name', 'user_' . $moderator->ID)); ?>
                                                                                                <?php if (have_rows('positions', 'user_' . $moderator->ID)) : ?>
                                                                                                    <?php while (have_rows('positions', 'user_' . $moderator->ID)) : ?>
                                                                                                        <?php the_row(); ?>
                                                                                                        <span class="company"><?php echo esc_html(get_sub_field('company', 'user_' . $moderator->ID)); ?></span>
                                                                                                        <span class="title"><?php echo esc_html(get_sub_field('job_title', 'user_' . $moderator->ID)); ?></span>
                                                                                                        <?php break; ?>
                                                                                                    <?php endwhile; ?>
                                                                                                <?php endif; ?>
                                                                                                <span class="red-bg gray-bg">moderator</span>
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <li class="join-now-field">
                                                                                <?php if ($post->ID != $healthcare_agenda_page_id) { ?>
                                                                                    <?php if (!empty($eventbrite_event_id)) : ?>
                                                                                        <?php $time_in_24_schedule_time = date('H:i:s', strtotime($schedule_time)); ?>
                                                                                        <?php $time_in_24_start_time = date('H:i:s', strtotime($start_time)); ?>

                                                                                        <?php if (strtotime(date('H:i:s')) >= strtotime($time_in_24_schedule_time) && strtotime(date('H:i:s')) <= strtotime($time_in_24_start_time) && strtotime(date('d-m-Y')) == strtotime(date('d-m-Y', strtotime($agenda['date']->name)))) : ?>
                                                                                            <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_event_id); ?>" data-agenda_date_id="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>" class="session-join-btn agenda-session-join-btn default-btn live" title='Join "<?php echo esc_html($agd->post_title); ?>"'>
                                                                                                <span class="live-icon">live</span>
                                                                                                Join Now
                                                                                            </a>
                                                                                        <?php elseif (strtotime(date('H:i:s')) > strtotime($time_in_24_start_time) && strtotime(date('d-m-Y')) == strtotime(date('d-m-Y', strtotime($agenda['date']->name))) || strtotime(date('d-m-Y')) > strtotime(date('d-m-Y', strtotime($agenda['date']->name)))) : ?>
                                                                                            <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_event_id); ?>" data-agenda_date_id="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>" class="session-join-btn agenda-session-join-btn default-btn watch" title='Join "<?php echo esc_html($agd->post_title); ?>"'>

                                                                                                Watch

                                                                                            </a>
                                                                                        <?php else : ?>
                                                                                            <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_event_id); ?>" data-agenda_date_id="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>" class="session-join-btn agenda-session-join-btn default-btn join-now" title='Join "<?php echo esc_html($agd->post_title); ?>"'>
                                                                                                Join Now
                                                                                            </a>
                                                                                        <?php endif; ?>


                                                                                        <form action="<?php echo esc_url(get_permalink($mit_ai_conference_2020_agenda_detail_page_id)); ?>" method="POST" class="form-inline agenda-session-join-form" style="display: none;justify-content: flex-end;">
                                                                                            <input class="form-control agenda-join-now" type="email" name="email" placeholder="johndoe@example.com" value="" required style="margin: 0 5px 0 10px; min-width: 250px;">
                                                                                            <input type="hidden" name="agenda_id" value="<?php echo esc_attr($agd->ID); ?>">
                                                                                            <input type="hidden" name="event_cms_id" value="<?php echo esc_attr($postEvent->ID); ?>">
                                                                                            <input type="hidden" name="eventbrite_id" value="<?php echo esc_attr($eventbrite_event_id); ?>">
                                                                                            <input type="hidden" name="agenda_topic" value="<?php echo esc_attr(get_term_meta($agenda['date']->term_id, 'topic_name', true)); ?>">
                                                                                            <input type="hidden" name="agenda_date" value="<?php echo esc_attr(esc_html(date('d F Y', strtotime($agenda['date']->name)))); ?>">
                                                                                            <input type="hidden" name="agenda_date_id" value="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>">
                                                                                            <input type="hidden" name="agenda_year_id" value="<?php echo (isset($event_year->term_id)) ? esc_html($event_year->term_id) : ''; ?>">
                                                                                            <input type="hidden" name="slack_channel_id" value="<?php echo (isset($event_year->term_id)) ? esc_html($event_year->term_id) : ''; ?>">
                                                                                            <input type="hidden" name="agenda_nonce" value="<?php echo esc_attr($nonce); ?>">
                                                                                            <button type="submit" title="Verify" class="submit-btn" style="border: none;font-size: 18px;color: #30b630;cursor: pointer;background: transparent;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                                                                                            <span class="join-error agenda-verification-msg " style="display: none; color: #f00; margin-left: 15px;">error</span>
                                                                                        </form>
                                                                                    <?php endif; ?>
                                                                                <?php } ?>
                                                                            <li>
                                                                        </ul>
                                                                    <?php endif; ?>
                                                                </li>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
                </article>

                <?php
                if ($post->ID == $ai_conference_agenda_page_id) :
                    ?>
                <article>
                    <div class="container">
                        <div class="row get-help p-4 mt70" id="get-help">
                            <div class="col-lg-12">
                                <h2 class="white-border text-white mb-3 mt-2 ">
                                    GET HELP
                                </h2>
                                <p class="text-white">We're here to help whenever you need us...</p>
                            </div>
                            <div class="border-right col-lg-4 pt-4">
                                <a href="https://mitcnc-org.zoom.us/j/88328053823" target="_blank" class="text-white d-block text-center">
                                    <img class="mb-3 ml-auto mr-auto contant-icon d-block" src="<?php echo esc_url($assets_uri); ?>/images/zoom.png" alt="">
                                    Join our Zoom
                                </a>
                            </div>
                            <div class="border-right col-lg-4 pt-4">
                                <a href="https://join.slack.com/share/zt-fytd3yc1-7Sljm~wXFm1R0NU05YPp3g" target="_blank" class="text-white d-block text-center">
                                    <img class="mb-3 ml-auto mr-auto contant-icon d-block" src="<?php echo esc_url($assets_uri); ?>/images/Slack.png" alt="">
                                    Join Slack
                                </a>
                            </div>
                            <div class="col-lg-4 pl-3 pt-4">
                                <a href="mailto:clubadmin@mitcnc.org" class="text-white d-block text-center">
                                    <img class="mb-3 ml-auto mr-auto contant-icon d-block" src="<?php echo esc_url($assets_uri); ?>/images/email.png" alt="">
                                    clubadmin@mitcnc.org
                                </a>
                            </div>

                        </div>
                        <div class="row mt50">
                            <div class="col-sm-14">
                                <h2 class="yellow">
                                    Partners & Supporters
                                </h2>
                                <p>We've got an insanely smart group of folks who will discuss where they see the Future of AI and the opportunities that have them excited.</p>
                            </div>
                            <div class="col-sm-24 text-center mt50">
                                <div class="partners-supporters">
                                    <a href="https://www.mitcnc.org/mit-ai-2020-partners">
                                        <img src="<?php echo esc_url($assets_uri); ?>/images/new-partners-supporters.png" class="logos-images img-responsive" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                    <?php
                endif;
            endwhile;
        endif;
        ?>
    </section>
    <?php
}
get_footer();
