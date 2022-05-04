<?php
    global $user_profile_page_id,
        $newsletter_type_event_listing,
        $post_id,
        $newsletter_type,
        $assets_uri,
        $event_location_taxonomy,
        $event_post_type,
        $featured_event,
        $upcoming_event,
        $member_event,
        $event_list,
        $event_list_bay_area,
        $event_list_east_bay,
        $event_list_north_bay,
        $event_list_peninsula,
        $event_list_sacramento,
        $event_list_san_francisco,
        $event_list_south_bay,
        $all_event_locations,
        $newsletter_banner,
        $newsletter_banner_link,
        $intro,
        $output_html_for_members,
        $output_html_for_non_members,
        $output_html_for_non_alum;
    $featured_event = get_field('featured_event', $post_id);
    $all_event_locations = get_terms($event_location_taxonomy, [
        'hide_empty' => false,
    //    'orderby' => 'name',
    //    'order' => 'ASC',
        'fields' => 'ids'
    ]);
    $newsletter_banner = get_field('newsletter_banner', $post_id);
    $newsletter_banner = $assets_uri.'/images/newsletter/upcoming_events.png';
    $newsletter_banner_link = get_field('newsletter_banner_link', $post_id);
    $newsletter_banner_link = home_url();
    $intro = get_field('intro', $post_id);
    function array_swapping($arr){
        $temp = $arr;
        if($arr != null && count($arr) > 0){
            $j = 0;
            for ($i = (count($arr) - 1); $i >= 0 ; $i--){
                $temp[$j] = $arr[$i];
                $j++;
            }
        }
        return $temp;
    }

    $member_event = get_field('member_event', $post_id);
    $event_list = get_field('event_list', $post_id);
    $event_list_bay_area = get_field('event_list_bay_area', $post_id);
    $event_list_east_bay = get_field('event_list_east_bay', $post_id);
    $event_list_north_bay = get_field('event_list_north_bay', $post_id);
    $event_list_peninsula = get_field('event_list_peninsula', $post_id);
    $event_list_sacramento = get_field('event_list_sacramento', $post_id);
    $event_list_san_francisco = get_field('event_list_san_francisco', $post_id);
    $event_list_south_bay = get_field('event_list_south_bay', $post_id);


    ob_start();
    get_template_part('template-parts/newsletters/weekly-upcoming/for', 'members');
    $output_html_for_members = ob_get_clean();


    ob_start();
    get_template_part('template-parts/newsletters/weekly-upcoming/for', 'non-members');
    $output_html_for_non_members = ob_get_clean();


    ob_start();
    get_template_part('template-parts/newsletters/weekly-upcoming/for', 'non-alum');
    $output_html_for_non_alum = ob_get_clean();