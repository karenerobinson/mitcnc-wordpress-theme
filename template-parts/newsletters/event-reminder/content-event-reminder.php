<?php
global $post_id,
    $assets_uri,
    $output_html_for_members,
    $output_html_for_non_members,
    $output_html_for_non_alum,
    // following are the globalizations of dynamic variables which are being set up from DB
    $show_date,
    $show_newsletter_banner,
    $newsletter_banner,
    $newsletter_banner_link,
    $show_intro,
    $event_for_reminder,
    $event_for_reminder_date,
    $intro_heading,
    $intro,
    $show_get_involved,
    $get_involved_heading,
    $show_upcoming_events,
    $upcoming_events_heading,
    $upcoming_events,
    $show_join_the_conversation,
    $join_the_conversation_heading,
    $show_how_are_we_doing,
    $how_are_we_doing_heading,
    $show_footer,
    $show_volunteer,
    $volunteer_heading,
    $volunteer_list,
    $show_brass_rats,
    $brass_rats_heading,
    $brass_rats,
    $show_brain_teaser,
    $puzzles_heading,
    $puzzles,
    $show_membership_status,
    $dark_mode,
    $newsletter_display_mode,
    $show_donation;

$dark_mode = get_field('dark_mode', $post_id);
$newsletter_display_mode = array();
if ($dark_mode) {
    $newsletter_display_mode['bg_color']                    = '#36383c';
    $newsletter_display_mode['inner_bg_color']              = '#1f2125';
    $newsletter_display_mode['font_color']                  = '#fff';
    $newsletter_display_mode['affiliation_font_color']      = '#f5f5f5';
    $newsletter_display_mode['mit_title_color']             = '#aeaeaf';
    $newsletter_display_mode['bg_green']                    = '#5a9a45';
    $newsletter_display_mode['gray_bg']                     = '#545356';
    $newsletter_display_mode['light_gray_bg']               = '#adadb9';
    $newsletter_display_mode['slack_logo']                  = $assets_uri . '/images/newsletter/slack.png';
} else {
    $newsletter_display_mode['bg_color']                    = '#e4e4e4';
    $newsletter_display_mode['font_color']                  = '#000000';
    $newsletter_display_mode['inner_bg_color']              = '#fff';
    $newsletter_display_mode['affiliation_font_color']      = '#adadb9';
    $newsletter_display_mode['mit_title_color']             = '#55555f';
    $newsletter_display_mode['bg_green']                    = '#008000';
    $newsletter_display_mode['gray_bg']                     = '#d2d2da';
    $newsletter_display_mode['light_gray_bg']               = '#63636e';
    $newsletter_display_mode['slack_logo']                  =  $assets_uri . '/images/newsletter/logo-slack-new.png';
}


$show_date = get_field('show_date', $post_id);
$event_for_reminder_date = '';

$show_newsletter_banner = get_field('show_banner', $post_id);
if ($show_newsletter_banner) {
    $newsletter_banner = get_field('banner_image', $post_id);
    $newsletter_banner_link = get_field('banner_link', $post_id);
}

$show_intro = get_field('show_intro', $post_id);
if ($show_intro) {
    $event_for_reminder = get_field('event_for_reminder', $post_id);
    $intro_heading = get_field('intro_heading', $post_id);
    $intro = get_field('intro', $post_id);
    if ($show_date) {
        $event_for_reminder_date =  get_field('date_time_date_time_start', $event_for_reminder);
    }
}

$show_get_involved = get_field('show_get_involved', $post_id);
if ($show_get_involved) {
    $get_involved_heading = get_field('get_involved_heading', $post_id);
}

$show_upcoming_events = get_field('show_upcoming_events', $post_id);
if ($show_upcoming_events) {
    $upcoming_events_heading = get_field('upcoming_events_heading', $post_id);
    $upcoming_events = get_field('event_list', $post_id);
}

$show_join_the_conversation = get_field('show_join_the_conversation', $post_id);
if ($show_join_the_conversation) {
    $join_the_conversation_heading = get_field('join_the_conversation_heading', $post_id);
}

$show_how_are_we_doing = get_field('show_how_are_we_doing', $post_id);
if ($show_how_are_we_doing) {
    $how_are_we_doing_heading = get_field('how_are_we_doing_heading', $post_id);
}

$show_footer = get_field('show_footer', $post_id);

$show_volunteer = get_field('show_volunteer', $post_id);
if ($show_volunteer) {
    $volunteer_heading = get_field('volunteer_heading', $post_id);
    $volunteer_list = get_field('volunteer_list', $post_id);
    $volunteer_list = is_array($volunteer_list) ? $volunteer_list : array($volunteer_list);
}

$show_brass_rats = get_field('show_brass_rats', $post_id);
if ($show_brass_rats) {
    $brass_rats_heading = get_field('brass_rats_heading', $post_id);
    $brass_rats = get_field('brass_rats', $post_id);
}

$show_brain_teaser = get_field('show_brain_teaser', $post_id);
if ($show_brain_teaser) {
    $puzzles_heading = get_field('puzzles_heading', $post_id);
    $puzzles = get_field('puzzles', $post_id);
}

$show_membership_status = get_field('show_membership_status', $post_id);

$show_donation = get_field('show_donation', $post_id);

ob_start();
get_template_part('template-parts/newsletters/event-reminder/for', 'members');
$output_html_for_members = ob_get_clean();
