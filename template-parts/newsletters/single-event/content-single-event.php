<?php
global $post_id,
       $assets_uri,
       $event,
       $output_html_for_members,
       $output_html_for_non_members,
       $dark_mode,
       $newsletter_display_mode,
       $output_html_for_non_alum;
$event_id = get_field('featured_event', $post_id);
$dark_mode = get_field('dark_mode', $post_id);
$newsletter_display_mode = array();
if ($dark_mode) {
    $newsletter_display_mode['bg_color']                    = '#36383c';
    $newsletter_display_mode['inner_bg_color']              = '#1f2125';
    $newsletter_display_mode['font_color']                  = '#fff';
    $newsletter_display_mode['inner_content_color']         = '#fff';
    $newsletter_display_mode['job_title_color']             = '#cccccc';
    $newsletter_display_mode['company_color']               = '#797979';
    $newsletter_display_mode['gray_bg']                     = '#545356';
    $newsletter_display_mode['light_gray_bg']               = '#adadb9';
    $newsletter_display_mode['mit_logo']                    = $assets_uri . '/images/mit-white-logo.png';
} else {
    $newsletter_display_mode['bg_color']                    = '#e4e4e4';
    $newsletter_display_mode['inner_bg_color']              = '#fff';
    $newsletter_display_mode['font_color']                  = '#000000';
    $newsletter_display_mode['inner_content_color']         = '#555555';
    $newsletter_display_mode['job_title_color']             = '#55555f';
    $newsletter_display_mode['company_color']               = '#040404';
    $newsletter_display_mode['gray_bg']                     = '#d2d2da';
    $newsletter_display_mode['light_gray_bg']               = '#63636e';
    $newsletter_display_mode['mit_logo']                    = $assets_uri . '/images/logo.png';
}


$event = (!empty($event_id)) ? get_post((int) $event_id) : null;
if ($event != null) {
    global $event_url,
           $event_banner,
           $event_start_on,
           $event_end_on,
           $event_start_on_date,
           $event_start_on_date_full,
           $event_end_on_date,
           $event_start_on_day,
           $event_start_on_time,
           $event_end_on_time,
           $event_agenda,
           $event_address,
           $event_address_1,
           $event_address_2,
           $event_address_city,
           $event_address_state,
           $event_address_postal_code,
           $event_primary_contact,
           $event_speakers,
           $event_moderators,
           $event_sold_out_flag,
           $mit_registration,
           $event_location,
           $event_location_taxonomy,
           $virtual_cat_id,
           $non_mit_registration,
           $show_upcoming_events,
           $upcoming_events_heading,
           $upcoming_events;
    $event_banner = get_field('newsletter_event_image', $event->ID);
    $event_url = get_permalink($event->ID);
    $event_start_on = get_field('date_time_date_time_start', $event->ID);
    $event_end_on = get_field('date_time_date_time_end', $event->ID);
    $event_start_on_date = date('D, F j, Y', strtotime($event_start_on));
    $event_start_on_day = date('l', strtotime($event_start_on));
    $event_start_on_date_full = date('F j, Y', strtotime($event_start_on));
    $event_end_on_date = date('D, F j, Y', strtotime($event_end_on));
    $event_start_on_time = date('h:i A', strtotime($event_start_on));
    $event_end_on_time = date('h:i A', strtotime($event_end_on));
    $event_agenda = get_field('agenda', $event->ID);
    $event_address = get_field('location_address', $event->ID);
    $event_address_1 = get_field('location_address_1', $event->ID);
    $event_address_2 = get_field('location_address_2', $event->ID);
    $event_address_city = get_field('location_city', $event->ID);
    $event_address_state = get_field('location_state', $event->ID);
    $event_address_postal_code = get_field('location_postal_code', $event->ID);
    $event_location = wp_get_post_terms($event->ID, $event_location_taxonomy);
    $event_primary_contact = array(
        'name' => get_field('contact_persons_contact_persons_primary_contact_persons_primary_name', $event->ID),
        'email' => get_field('contact_persons_contact_persons_primary_contact_persons_primary_email', $event->ID),
    );
    $event_speakers = get_field('speakers_list', $event->ID);
    $event_speakers = (isset($event_speakers[0]) && !empty($event_speakers[0])) ? $event_speakers : null;
    $event_moderators = get_field('moderators_list', $event->ID);
    $event_moderators = (isset($event_moderators[0]) && !empty($event_moderators[0])) ? $event_moderators : null;
    $event_sold_out_flag = get_field('sold_out', $event->ID);
    $mit_registration = array(
        'link' => get_field('registration_2_mit_link', $event->ID),
        'details' => get_field('registration_2_mit_details', $event->ID),
    );
    $non_mit_registration = array(
        'link' => get_field('registration_2_non_mit_link', $event->ID),
        'details' => get_field('registration_2_non_mit_details', $event->ID),
        'embed_widget' => get_field('registration_2_non_mit_embed_widget', $event->ID),
    );

    $show_upcoming_events = get_field('show_upcoming_events', $post_id);
    if ($show_upcoming_events) {
        $upcoming_events_heading = get_field('upcoming_events_heading', $post_id);
        $upcoming_events = get_field('event_list', $post_id);
    }

    ob_start();
    get_template_part('template-parts/newsletters/single-event/for', 'members');
    $output_html_for_members = ob_get_clean();


    ob_start();
    get_template_part('template-parts/newsletters/single-event/for', 'non-members');
    $output_html_for_non_members = ob_get_clean();


    ob_start();
    get_template_part('template-parts/newsletters/single-event/for', 'non-alum');
    $output_html_for_non_alum = ob_get_clean();
}
