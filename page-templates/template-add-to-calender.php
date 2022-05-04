<?php
/* Template Name: Add to calender */
$include = null;
$file_name = 'mitcnc-events.ics';
$event_id = isset($_REQUEST['event_id']) ? filter_var(wp_unslash($_REQUEST['event_id']), FILTER_SANITIZE_NUMBER_INT) : '';
$loc = isset($_REQUEST['loc']) ? filter_var(wp_unslash($_REQUEST['loc']), FILTER_SANITIZE_NUMBER_INT) : '';
$prog = isset($_REQUEST['prog']) ? filter_var(wp_unslash($_REQUEST['prog']), FILTER_SANITIZE_NUMBER_INT) : '';
if (!empty($event_id) && is_numeric($event_id)) {
    $file_name = get_post_field('post_name', $event_id) . '.ics';
    $include = array($event_id);
}

include get_template_directory() . '/inc/ICS.php';
header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $file_name);

$limit = -1;
$event_types = null;
$event_locations = null;
$event_programs = null;
$exclude = null;
$show_past_events = false;
$gallery = null;
$date_filter = null;
$event_audience = null;
$use_wp_query = false;
$event_access_type = null;

if (!empty($loc) && is_numeric($loc)) {
    $event_locations = array($loc);
}

if (!empty($prog) && is_numeric($prog)) {
    $event_programs = array($prog);
}

$the_event = get_events($limit, $event_types, $event_locations, $event_programs, $exclude, $show_past_events, $gallery, $date_filter, $event_audience, $use_wp_query, $event_access_type, $include);

$events = array();
if ($the_event != null) {
    foreach ($the_event as $key => $event) {
        if (!is_unlisted_event($event->ID)) {
            $venue = get_field('location_address', $event->ID);
            $address_1 = get_field('location_address_1', $event->ID);
            $address_2 = get_field('location_address_2', $event->ID);
            $city = get_field('location_city', $event->ID);
            $city = isset($city['label']) ? $city['label'] : '';
            $state = get_field('location_state', $event->ID);
            $postal_code = get_field('location_postal_code', $event->ID);
            $event_start = get_field('date_time_date_time_start', $event->ID);
            $event_end = get_field('date_time_date_time_end', $event->ID);
            $events[] = array(
                'UID'   => $event->ID,
                'DTSTAMP'  =>  date('Ymd\THis', strtotime($event_start)),
                'location' => str_replace(array("\n", "\t", "\r", '&nbsp;'), array('', '', '', ''), "$venue $address_1 $address_2 $city, $state, $postal_code"),
                'description' => str_replace(array("\n", "\t", "\r", '&nbsp;'), array('', '', '', ''), strip_tags($event->post_content, '<a>')) . "\\n\\n<a href='" . get_permalink($event->ID) . "'>" . get_permalink($event->ID) . '</a>',
                'dtstart' => date('Y-m-d\THis', strtotime($event_start)),
                'dtend' => date('Y-m-d\THis', strtotime($event_end)),
                'summary' => strip_tags($event->post_title),
                'url' => get_permalink($event->ID)
            );
        }
    }
    $ICS = new ICS($events);
    echo filter_var($ICS->prepare(), FILTER_UNSAFE_RAW);
    unset($ICS);
} else {
    $ICS = new ICS($events);
    echo filter_var($ICS->prepare(), FILTER_UNSAFE_RAW);
    unset($ICS);
}
exit;
