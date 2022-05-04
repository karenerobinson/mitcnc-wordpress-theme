<?php
/* Template Name: MIT Event Agenda Details */
get_header();
$nonce = isset($_POST['agenda_nonce']) ? filter_var(wp_unslash($_POST['agenda_nonce']), FILTER_SANITIZE_STRING) : '';
$agenda_title = 'Forbidden!';
if (wp_verify_nonce($nonce, 'agenda')) {
    $agenda_id = isset($_POST['agenda_id']) ? filter_var(wp_unslash($_POST['agenda_id']), FILTER_SANITIZE_NUMBER_INT) : '';
    $event_cms_id = isset($_POST['event_cms_id']) ? filter_var(wp_unslash($_POST['event_cms_id']), FILTER_SANITIZE_NUMBER_INT) : '';
    $eventbrite_id = isset($_POST['eventbrite_id']) ? filter_var(wp_unslash($_POST['eventbrite_id']), FILTER_SANITIZE_NUMBER_INT) : '';
    $agenda_topic = isset($_POST['agenda_topic']) ? filter_var(wp_unslash($_POST['agenda_topic']), FILTER_SANITIZE_STRING) : '';
    $agenda_date = isset($_POST['agenda_date']) ? filter_var(wp_unslash($_POST['agenda_date']), FILTER_SANITIZE_STRING) : '';
    $agenda_date_new_id = isset($_POST['agenda_date_id']) ? filter_var(wp_unslash($_POST['agenda_date_id']), FILTER_SANITIZE_STRING) : '';
    $agenda_year_id = isset($_POST['agenda_year_id']) ? filter_var(wp_unslash($_POST['agenda_year_id']), FILTER_SANITIZE_STRING) : '';


    $nonce = wp_create_nonce('agenda');
    if (!empty($eventbrite_id) && !empty($agenda_id)) {
        global $wpdb, $agenda_date_id;
        $agenda_date_id = $agenda_date_new_id;
        $agenda_title = get_the_title($agenda_id);
        $agenda_video_url = get_field('youtube_url', $agenda_id);
        $agenda_zoom_url = get_field('zoom_url', $agenda_id);
        $agenda_break_banner = get_field('break_banner', $agenda_id);
        $speakers = get_field('speakers', $agenda_id, true);
        $moderators = get_field('moderators', $agenda_id, true);
        $specific_event = true;
        $schedule_time = get_field('schedule_time', $agenda_id);
        $start_time = get_field('start_time', $agenda_id);
        $event_duration = get_field('total_duration', $agenda_id);

        $args = array(
            'post_type'           => 'events-agenda',
            'posts_per_page'      =>  1,
            'post__not_in'        =>  array($agenda_id),
            'meta_key'            => 'schedule_time',
            'meta_query' => array(
                array(
                    'key' => 'schedule_time',
                    'value' => date('H:i:s', strtotime($schedule_time)),
                    'compare' => '>='
                )
            ),
            'orderby'             => 'meta_value',
            'order'               => 'ASC',
            'tax_query'           => array(
                'relation' => 'AND',
                array(
                    'taxonomy'    => 'events-agenda-years',
                    'field'       => 'term_id',
                    'terms'       => $agenda_year_id
                ),
                array(
                    'taxonomy'    => 'events-agenda-dates',
                    'field'       => 'term_id',
                    'terms'       => $agenda_date_new_id
                )
            )
        );
        
        $NextAgenda = get_posts($args);
        
        ?>
        <section class="single-events postid-5085">
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
                    </div>
                    <div class="row">
                        <div class="col-sm-24">
                            <div class="agenda-heading">
                                <?php if (!empty($agenda_topic)) { ?>
                                    <h2 class="blue blue-heeading" style="margin-bottom: 0;"><?php echo esc_html($agenda_topic); ?></h2>
                                <?php } ?>
                                <h3 class="blue"><?php echo esc_html($agenda_title); ?></h3>
                                <span class="session-date"><?php echo esc_html(date('D, M d, Y', strtotime($agenda_date))); ?>   |   <?php echo esc_html($schedule_time); ?> - <span class="current-session-end-time"><?php echo esc_html($start_time); ?></span></span>
                                <?php if (!empty($event_duration)) : ?>
                                    <span class="event_duration" style="display:none;"><?php echo esc_html($event_duration); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-sm-24 mb-5">
                            <div class="event-banner custom-event-banner no-img m-0 " style="background-color: #000;" >
                                <?php if (!empty($agenda_break_banner) && !empty($agenda_zoom_url)) { ?>
                                    <a href="<?php echo esc_url($agenda_zoom_url); ?>" target="blank">
                                        <img src="<?php echo esc_url($agenda_break_banner); ?>"  style="height: 100%;width: 100%;position: absolute;left: 0; right: 0; top: 0; bottom: 0;">
                                    </a>
                                <?php }; ?>

                                <?php if (empty($agenda_break_banner) && empty($agenda_zoom_url) && !empty($agenda_video_url)) { ?>
                                <iframe style="position: absolute;left: 0; right: 0; top: 0; bottom: 0;" width="100%" height="100%" src="<?php echo esc_url($agenda_video_url); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <?php } ?>
                            </div>
                            <?php if (!empty($NextAgenda) && is_array($NextAgenda) && count($NextAgenda) > 0) : ?>
                                <?php foreach ($NextAgenda as $NextAd) : ?>
                                    <div class="agenda-heading next-session">

                                        <h2 class="blue blue-heeading">Next Session</h2>
                                        <h3 class="blue">
                                        <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_id); ?>" data-agenda_date_id="<?php echo (isset($agenda_date_new_id)) ? esc_html($agenda_date_new_id) : ''; ?>" class="session-join-btn agenda-session-join-btn-details" title='Join "<?php echo esc_html($NextAd->post_title); ?>"'>
                                            <?php echo esc_html($NextAd->post_title); ?>
                                        </a>
                                        </h3>
                                        <span class="session-date"><?php echo esc_html(date('D, M d, Y', strtotime($agenda_date))); ?>   |   <span class="next-session-start-time"><?php echo esc_html(get_field('schedule_time', $NextAd->ID)); ?></span> - <?php echo esc_html(get_field('start_time', $NextAd->ID)); ?></span>
                                        
                                        <p class="mt-3">
                                            <?php if (!empty($eventbrite_id)) : ?>
                                                <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_id); ?>" data-agenda_date_id="<?php echo (isset($agenda_date_new_id)) ? esc_html($agenda_date_new_id) : ''; ?>" class="session-join-btn agenda-session-join-btn-details default-btn" title='Join "<?php echo esc_html($NextAd->post_title); ?>"' style="display:none;">Join Now</i></a>
                                                <form action="<?php echo esc_url(get_permalink($mit_ai_conference_2020_agenda_detail_page_id)); ?>" method="POST" class="form-inline agenda-session-join-form-inner" style="display: none;justify-content: flex-end;">
                                                    <input class="form-control agenda-join-now" type="email" name="email" placeholder="johndoe@example.com" value=""  required style="margin: 0 5px 0 10px; min-width: 250px;">
                                                    <input type="hidden" name="agenda_id" value="<?php echo esc_attr($NextAd->ID); ?>">
                                                    <input type="hidden" name="event_cms_id" value="<?php echo esc_attr($event_cms_id); ?>">
                                                    <input type="hidden" name="eventbrite_id" value="<?php echo esc_attr($eventbrite_id); ?>">
                                                    <input type="hidden" name="agenda_topic" value="<?php echo esc_attr(get_term_meta($agenda_date_new_id, 'topic_name', true)); ?>">
                                                    <input type="hidden" name="agenda_date" value="<?php echo esc_attr(esc_html(date('d F Y', strtotime($agenda_date)))); ?>">
                                                    <input type="hidden" name="agenda_date_id" value="<?php echo (isset($agenda_date_new_id)) ? esc_html($agenda_date_new_id) : ''; ?>">
                                                    <input type="hidden" name="agenda_year_id" value="<?php echo (isset($agenda_year_id)) ? esc_html($agenda_year_id) : ''; ?>">
                                                    <input type="hidden" name="agenda_nonce" value="<?php echo esc_attr($nonce); ?>">
                                                    <button type="submit" title="Verify" class="submit-btn" style="border: none;font-size: 18px;color: #30b630;cursor: pointer;background: transparent;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                                                    <span class="join-error agenda-verification-msg " style="display: none; color: #f00; margin-left: 15px;">error</span>
                                                </form>
                                            <?php endif; ?>
                                        </p>
                                    </div>

                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-8 mb-5">
                            <iframe src="https://app.sli.do/event/icbtyvah" width="100%" height="100%" style="height: 560px; border: none;"></iframe>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row mt-5 mb-2">
                        <div class="col-lg-4 col-md-24 col-sm-24  text-center">
                            <img src="<?php echo esc_url($assets_uri); ?>/images/slack-logo.png" alt="" style="width: 158px;" >
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-24 slack-link">
                            <a href="javascript:void(0);" style="color:black; font-weight:bold; cursor: default;"> mitcnc.slack.com</a>
                        </div>
                        <div class="col-xl-9 col-lg-8 col-md-12 col-sm-24 hashtag-box">
                            <a href="javascript:void(0);" class="hashtag" style="cursor: default;">#ai-conference-lobby</a>
                            <a target="_blank" href="javascript:void(0);" class="hashtag" style="cursor: default;">#<?php echo esc_html(strtolower(str_replace(' ', '-', $agenda_topic))); ?></a>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-24  pink-btn">
                           
                            <a href="https://app.slack.com/client/T4KS7MQVC/<?php echo esc_html(get_field('slack_channel_id', 'events-agenda-dates_' . $agenda_date_new_id)); ?>" target="_blank" class="pink-link">Join conversation</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-24">
                            <div class="slack-conversation-history">
                                <?php get_template_part('template-parts/slack', 'conversation-history'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (null != $speakers || null != $moderators) { ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-24">
                                <h2 class="blue">Speakers</h2>
                            </div> 
                            <?php
                            if (null != $speakers) {
                                foreach ($speakers as $key => $speaker) {
                                    $speaker_img = esc_url(get_field('profile_image', 'user_' . $speaker->ID));
                                    $speaker_img = !empty($speaker_img) ? $speaker_img : $assets_uri . '/images/placeholder.png';
                                    $affiliations_mit = array();
                                    $affiliations_other = array();
                                    $affiliations = get_field('affiliations', 'user_' . $speaker->ID);
                                    if ($affiliations) {
                                        foreach ($affiliations as $affiliation) {
                                            if (null != $affiliation) {
                                                $affiliation_count = count($affiliation);
                                                for ($i = 0; $i < $affiliation_count; $i++) {
                                                    if (isset($affiliation[$i]['mit_affiliation_title'])) {
                                                        $affiliations_mit[] = $affiliation[$i]['mit_affiliation_title'];
                                                    } else if (isset($affiliation[$i]['other_affiliation_title'])) {
                                                        $affiliations_other[] = $affiliation[$i]['other_affiliation_title'];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                        <div class="col-sm-24 col-md-12 col-lg-8 col-xl-6">
                                            <div class="speaker-card" style="padding:33px !important;">
                                                <div class="card-img">
                                                    <img src="<?php echo esc_url($speaker_img); ?>">
                                                    <?php if (is_mit_alum($speaker->ID)) { ?>
                                                    <div class="icon-mit">
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="card-text">
                                                    <div class="name">
                                                        <h3><?php echo esc_html(get_field('full_name', 'user_' . $speaker->ID) . ' ' . get_field('user_last_name', 'user_' . $speaker->ID)); ?></h3>
                                                        <span class="code"><?php echo (null != $affiliations_mit) ? esc_html(implode(', ', $affiliations_mit)) : ''; ?></span>
                                                    </div>
                                                    <div class="company-name ">
                                                        <?php
                                                        if (have_rows('positions', 'user_' . $speaker->ID)) {
                                                            while (have_rows('positions', 'user_' . $speaker->ID)) {
                                                                the_row();
                                                                ?>
                                                                <h4><?php the_sub_field('company', 'user_' . $speaker->ID); ?></h4>
                                                                <?php
                                                                break;
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                            if (null != $moderators) {
                                foreach ($moderators as $key => $speaker) {
                                    $speaker_img = esc_url(get_field('profile_image', 'user_' . $speaker->ID));
                                    $speaker_img = !empty($speaker_img) ? $speaker_img : $assets_uri . '/images/placeholder.png';
                                    $affiliations_mit = array();
                                    $affiliations_other = array();
                                    $affiliations = get_field('affiliations', 'user_' . $speaker->ID);
                                    if ($affiliations) {
                                        foreach ($affiliations as $affiliation) {
                                            if (null != $affiliation) {
                                                $affiliation_count = count($affiliation);
                                                for ($i = 0; $i < $affiliation_count; $i++) {
                                                    if (isset($affiliation[$i]['mit_affiliation_title'])) {
                                                        $affiliations_mit[] = $affiliation[$i]['mit_affiliation_title'];
                                                    } else if (isset($affiliation[$i]['other_affiliation_title'])) {
                                                        $affiliations_other[] = $affiliation[$i]['other_affiliation_title'];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                        <div class="col-sm-24 col-md-12 col-lg-8 col-xl-6">
                                            <div class="speaker-card" style="padding:33px !important;">
                                                <div class="card-img">
                                                    <img src="<?php echo esc_url($speaker_img); ?>">
                                                    <?php if (is_mit_alum($speaker->ID)) { ?>
                                                    <div class="icon-mit">
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="card-text">
                                                    <div class="name">
                                                        <h3><?php echo esc_html(get_field('full_name', 'user_' . $speaker->ID) . ' ' . get_field('user_last_name', 'user_' . $speaker->ID)); ?></h3>
                                                        <span class="code"><?php echo (null != $affiliations_mit) ? esc_html(implode(', ', $affiliations_mit)) : ''; ?></span>
                                                    </div>
                                                    <?php
                                                    if (have_rows('positions', 'user_' . $speaker->ID)) {
                                                        echo '<div class="company-name ">';
                                                        while (have_rows('positions', 'user_' . $speaker->ID)) {
                                                            the_row();
                                                            ?>
                                                                <h4><?php the_sub_field('company', 'user_' . $speaker->ID); ?></h4>
                                                                <?php
                                                                break;
                                                        }
                                                        echo '</div>';
                                                    }
                                                    ?>
                                                    <div class="gray-bg">
                                                        Host
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </article>      
        </section>
        <?php
        // This below code is for repeated sections
        global $mit_ai_conference_2020_agenda_page_id,
        $event_access_type_taxonomy,
        $login_page_id,
        $layout,
        $sold_out_flag,
        $end_on,
        $meta_data;

        $postEvent = get_field('event', $mit_ai_conference_2020_agenda_page_id);
        $event_year = get_field('event_year', $mit_ai_conference_2020_agenda_page_id);
        $agendaObject = GetAgendaObject($event_year);
        
        if (isset($postEvent->ID)) {
            $meta_data = get_post_meta($postEvent->ID);
            $eventbrite_event_id = (isset($meta_data['registration_3_eventbrite_event_id'][0])) ? $meta_data['registration_3_eventbrite_event_id'][0] : '';
            $nonce = wp_create_nonce('agenda');
            $sold_out_flag = (isset($meta_data['sold_out'][0])) ? $meta_data['sold_out'][0] : false;
            $end_on = (isset($meta_data['date_time_date_time_end'][0])) ? $meta_data['date_time_date_time_end'][0] : '';
            ?>
            <section class="single-events postid-5085" style="padding-top: 0;" id="#agenda_section">
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        ?>
                        <article class="inner-page event-banner-section" style="background-color: #fff;padding-top: 0;">
                            <div class="container event-banner-container">
                                <div class="row">
                                    <?php if (!empty($agendaObject) && is_array($agendaObject) && count($agendaObject) > 0) : ?>
                                    <div class="col-sm-24">
                                        <ul class="agenda-dates-tab">
                                            <?php foreach ($agendaObject as $key => $agenda) : ?>
                                                <?php
                                                if (isset($agenda['date']) && !empty($agenda['date']) && isset($agenda['agenda']) && !empty($agenda['agenda']) && count($agenda['agenda']) > 0) :
                                                    $agenda_active_class = '';
                                                    if (strtotime($agenda_date) == strtotime($agenda['date']->name)) {
                                                        $agenda_active_class = 'active';
                                                    }
                                                    ?>
                                                    <li class="<?php echo esc_attr($agenda_active_class); ?>" data-banner="<?php echo esc_url(get_field('banner', 'events-agenda-dates_' . $agenda['date']->term_id)); ?>" data-name="agenda_id_<?php echo isset($agenda['date']->term_id) ? esc_html($agenda['date']->term_id) : ''; ?>" style="display: inline;">
                                                        <a href="javascript:void(0);" class="event-btns right" style="min-width: 150px;" data-name="agenda_id_<?php echo isset($agenda['date']->term_id) ? esc_html($agenda['date']->term_id) : ''; ?>">
                                                            <span class="agenda-tab-topic"><?php echo esc_html(date('d F Y', strtotime($agenda['date']->name))); ?></span>
                                                            <span class="agenda-tab-date"><?php echo esc_attr(get_term_meta($agenda['date']->term_id, 'topic_name', true)); ?></span>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-sm-24">
                                        <h2 class="blue mb-4 mt-4" style="margin: 0;">
                                            Agenda
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($agendaObject) && is_array($agendaObject) && count($agendaObject) > 0) : ?>
                                <?php foreach ($agendaObject as $key => $agenda) : ?>
                                    <?php if (isset($agenda['date']) && !empty($agenda['date']) && isset($agenda['agenda']) && !empty($agenda['agenda']) && count($agenda['agenda']) > 0) : ?>
                                        <div class="container agenda-container agenda_id_<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?> " <?php echo ($agenda['date']->term_id != $agenda_date_new_id) ? 'style="display:none;"' : ''; ?>>
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
                                                                           
                                                                            <h4 class="date"><?php echo esc_html("{$schedule_time} - {$start_time}"); ?></h4>
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
                                                                                        <?php if (!empty($eventbrite_event_id)) : ?>
                                                                                            <?php $time_in_24_schedule_time = date('H:i:s', strtotime($schedule_time)); ?>
                                                                                            <?php $time_in_24_start_time = date('H:i:s', strtotime($start_time)); ?>
                                                                                            
                                                                                                <?php if (strtotime(date('H:i:s')) >= strtotime($time_in_24_schedule_time) && strtotime(date('H:i:s')) <= strtotime($time_in_24_start_time) && strtotime(date('d-m-Y')) == strtotime(date('d-m-Y', strtotime($agenda['date']->name)))) : ?>
                                                                                                    <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_event_id); ?>"  data-agenda_date_id="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>" class="session-join-btn agenda-session-join-btn default-btn live" title='Join "<?php echo esc_html($agd->post_title); ?>"'>
                                                                                                             <span class="live-icon">live</span>
                                                                                                             Join Now
                                                                                                    </a>
                                                                                                <?php elseif (strtotime(date('H:i:s')) > strtotime($time_in_24_start_time) && strtotime(date('d-m-Y')) == strtotime(date('d-m-Y', strtotime($agenda['date']->name))) || strtotime(date('d-m-Y')) > strtotime(date('d-m-Y', strtotime($agenda['date']->name)))) : ?>
                                                                                                    <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_event_id); ?>"  data-agenda_date_id="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>" class="session-join-btn agenda-session-join-btn default-btn watch" title='Join "<?php echo esc_html($agd->post_title); ?>"'>
                                                                                                        Watch
                                                                                                    </a>
                                                                                                <?php else : ?>
                                                                                                    <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_event_id); ?>"  data-agenda_date_id="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>" class="session-join-btn agenda-session-join-btn default-btn join-now" title='Join "<?php echo esc_html($agd->post_title); ?>"'>
                                                                                                        Join Now
                                                                                                    </a>
                                                                                                <?php endif; ?>
                                                                                            
                                                                                            <form action="<?php echo esc_url(get_permalink($mit_ai_conference_2020_agenda_detail_page_id)); ?>" method="POST" class="form-inline agenda-session-join-form" style="display: none;justify-content: flex-end;">
                                                                                                <input class="form-control agenda-join-now" type="email" name="email" placeholder="johndoe@example.com" value=""  required style="margin: 0 5px 0 10px; min-width: 250px;">
                                                                                                <input type="hidden" name="agenda_id" value="<?php echo esc_attr($agd->ID); ?>">
                                                                                                <input type="hidden" name="event_cms_id" value="<?php echo esc_attr($postEvent->ID); ?>">
                                                                                                <input type="hidden" name="eventbrite_id" value="<?php echo esc_attr($eventbrite_event_id); ?>">
                                                                                                <input type="hidden" name="agenda_topic" value="<?php echo esc_attr(get_term_meta($agenda['date']->term_id, 'topic_name', true)); ?>">
                                                                                                <input type="hidden" name="agenda_date" value="<?php echo esc_attr(esc_html(date('d F Y', strtotime($agenda['date']->name)))); ?>">
                                                                                                <input type="hidden" name="agenda_date_id" value="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>">
                                                                                                <input type="hidden" name="agenda_year_id" value="<?php echo (isset($agenda_year_id)) ? esc_html($agenda_year_id) : ''; ?>">
                                                                                                <input type="hidden" name="agenda_nonce" value="<?php echo esc_attr($nonce); ?>">
                                                                                                <button type="submit" title="Verify" class="submit-btn" style="border: none;font-size: 18px;color: #30b630;cursor: pointer;background: transparent;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                                                                                                <span class="join-error agenda-verification-msg " style="display: none; color: #f00; margin-left: 15px;">error</span>
                                                                                            </form>
                                                                                        <?php endif; ?> 
                                                                                    <li>
                                                                                </ul>
                                                                            <?php endif; ?>
        
                                                                            <?php if ('Event' == $agenda_type) : ?>
                                                                                <p class="toggle-session-speakers" style="display: inline-block; cursor: pointer">
                                                                                    <?php echo esc_html($agd->post_title); ?>
                                                                                    
                                                                                </p>
                                                                                <?php $speakers = get_field('speakers', $agd->ID); ?>
                                                                                <?php $moderators = get_field('moderators', $agd->ID); ?>
                                                                                <ul>
                                                                                    <?php
                                                                                    if (null != $speakers) {
                                                                                        foreach ($speakers as $speaker) {
                                                                                            ?>
                                                                                                <li class="speaker" style="display: none;">
                                                                                                    <a href="<?php echo esc_url(site_url() . '/' . $speaker->user_nicename); ?>/" target="_blank">
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
                                                                                            <li class="speaker" style="display: none;">
                                                                                                <a href="<?php echo esc_url(site_url() . '/' . $moderator->user_nicename); ?>/" target="_blank">
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
                                                                                                        <span class="gray-bg">Host</span>
                                                                                                    </span>
                                                                                                </a>
                                                                                            </li>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                    <li class="join-now-field">
                                                                                        <?php if (!empty($eventbrite_event_id)) : ?>
                                                                                            <?php $time_in_24_schedule_time = date('H:i:s', strtotime($schedule_time)); ?>
                                                                                            <?php $time_in_24_start_time = date('H:i:s', strtotime($start_time)); ?>
                                                                                            
                                                                                                <?php if (strtotime(date('H:i:s')) >= strtotime($time_in_24_schedule_time) && strtotime(date('H:i:s')) <= strtotime($time_in_24_start_time) && strtotime(date('d-m-Y')) == strtotime(date('d-m-Y', strtotime($agenda['date']->name)))) : ?>
                                                                                                    <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_event_id); ?>"  data-agenda_date_id="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>" class="session-join-btn agenda-session-join-btn default-btn live" title='Join "<?php echo esc_html($agd->post_title); ?>"'>
                                                                                                             <span class="live-icon">live</span>
                                                                                                             Join Now
                                                                                                    </a>
                                                                                                <?php elseif (strtotime(date('H:i:s')) > strtotime($time_in_24_start_time) && strtotime(date('d-m-Y')) == strtotime(date('d-m-Y', strtotime($agenda['date']->name))) || strtotime(date('d-m-Y')) > strtotime(date('d-m-Y', strtotime($agenda['date']->name)))) : ?>
                                                                                                    <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_event_id); ?>"  data-agenda_date_id="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>" class="session-join-btn agenda-session-join-btn default-btn watch" title='Join "<?php echo esc_html($agd->post_title); ?>"'>
                                                                                                        Watch
                                                                                                    </a>
                                                                                                <?php else : ?>
                                                                                                    <a href="javascript:void(0);" data-event_id="<?php echo esc_html($eventbrite_event_id); ?>"  data-agenda_date_id="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>" class="session-join-btn agenda-session-join-btn default-btn join-now" title='Join "<?php echo esc_html($agd->post_title); ?>"'>
                                                                                                        Join Now
                                                                                                    </a>
                                                                                                <?php endif; ?>
                                                                                            
                                                                                            <form action="<?php echo esc_url(get_permalink($mit_ai_conference_2020_agenda_detail_page_id)); ?>" method="POST" class="form-inline agenda-session-join-form" style="display: none;justify-content: flex-end;">
                                                                                                <input class="form-control agenda-join-now" type="email" name="email" placeholder="johndoe@example.com" value=""  required style="margin: 0 5px 0 10px; min-width: 250px;">
                                                                                                <input type="hidden" name="agenda_id" value="<?php echo esc_attr($agd->ID); ?>">
                                                                                                <input type="hidden" name="event_cms_id" value="<?php echo esc_attr($postEvent->ID); ?>">
                                                                                                <input type="hidden" name="eventbrite_id" value="<?php echo esc_attr($eventbrite_event_id); ?>">
                                                                                                <input type="hidden" name="agenda_topic" value="<?php echo esc_attr(get_term_meta($agenda['date']->term_id, 'topic_name', true)); ?>">
                                                                                                <input type="hidden" name="agenda_date" value="<?php echo esc_attr(esc_html(date('d F Y', strtotime($agenda['date']->name)))); ?>">
                                                                                                <input type="hidden" name="agenda_date_id" value="<?php echo (isset($agenda['date']->term_id)) ? esc_html($agenda['date']->term_id) : ''; ?>">
                                                                                                <input type="hidden" name="agenda_year_id" value="<?php echo (isset($agenda_year_id)) ? esc_html($agenda_year_id) : ''; ?>">
                                                                                                <input type="hidden" name="agenda_nonce" value="<?php echo esc_attr($nonce); ?>">
                                                                                                <button type="submit" title="Verify" class="submit-btn" style="border: none;font-size: 18px;color: #30b630;cursor: pointer;background: transparent;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                                                                                                <span class="join-error agenda-verification-msg " style="display: none; color: #f00; margin-left: 15px;">error</span>
                                                                                            </form>
                                                                                        <?php endif; ?> 
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
                        </article>
                        <article style="background-color: #fff;padding-top: 0;">
                            <div class="container">
                            <div class="row get-help p-4 mt70">
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
                                <div class="row mt50">
                                    <div class="col-sm-14">
                                        <h2 class="yellow">
                                            Partners & Supporters
                                        </h2>
                                        <p>We've got an insanely smart group of folks who will discuss where they see the Future of AI and the opportunities that have them excited.</p>
                                    </div>
                                    <div class="col-sm-24 text-center mt50">
                                        <div class="partners-supporters">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/new-partners-supporters.png" class="logos-images img-responsive" alt="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article style="background-color: #fff;padding-top: 0;margin-top: -60px;">
                            <div class="container">
                                <?php
                                    $layout = (isset($meta_data['registration_3_mit_alum'][0]) && $meta_data['registration_3_mit_alum'][0] > 1) ? 'row' : 'column';
                                    $post->ID = $postEvent->ID;
                                    // get_template_part('template-parts/singular/content', 'registration-sso');
                                ?>
                            </div>
                        </article>
                        <?php
                    endwhile;
                endif;
                ?>
            </section>
            <?php
        }
    }
}
get_footer();
