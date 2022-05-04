<?php
    global $user_profile_page_id,
        $newsletter_type_non_members,
        $post_id,
        $newsletter_type,
        $assets_uri,
        $volunteer_list,
        $featured_event,
        $upcoming_event,
        $member_event,
        $brass_rats,
        $newsletter_banner,
        $newsletter_banner_link,
        $brain_teaser,
        $intro,
        $dark_mode,
        $newsletter_display_mode,
        $output_html_for_members,
        $output_html_for_non_members,
        $output_html_for_non_alum;
    $volunteer_list = get_field('volunteer_list', $post_id);
    $volunteer_list = is_array($volunteer_list) ? $volunteer_list : array($volunteer_list);
    $featured_event = get_field('featured_event', $post_id);
    $featured_event = is_array($featured_event) ? $featured_event : array($featured_event);
    $upcoming_event = get_field('event_list', $post_id);
    $member_event = get_field('member_event', $post_id);
    $brass_rats = get_field('brass_rats', $post_id);
    $newsletter_banner = get_field('newsletter_banner', $post_id);
    $newsletter_banner = $assets_uri . '/images/newsletter/banner-beaver-bulletin.png';
    $newsletter_banner_link = get_field('newsletter_banner_link', $post_id);
    $brain_teaser = get_field('puzzles', $post_id);
    $intro = get_field('intro', $post_id);
    $dark_mode = get_field('dark_mode', $post_id);
    $newsletter_display_mode = array();
if ($dark_mode) {
    $newsletter_display_mode['bg_color']                    = '#36383c';
    $newsletter_display_mode['inner_bg_color']              = '#1f2125';
    $newsletter_display_mode['font_color']                  = '#fff';
    $newsletter_display_mode['affiliation_font_color']      = '#f5f5f5';
    $newsletter_display_mode['mit_title_color']             = '#aeaeaf';
    $newsletter_display_mode['featured_event_bg_color']     = '#d3d4e3';
    $newsletter_display_mode['featured_event_font_color']   = '#21222b';
    $newsletter_display_mode['featured_event_date_color']   = '#717180';
    $newsletter_display_mode['bg_green']                    = '#5a9a45';
    $newsletter_display_mode['gray_bg']                     = '#545356';
    $newsletter_display_mode['light_gray_bg']               = '#adadb9';
    $newsletter_display_mode['slack_logo']                    = $assets_uri . '/images/newsletter/slack.png';
} else {
    $newsletter_display_mode['bg_color']                    = '#e4e4e4';
    $newsletter_display_mode['font_color']                  = '#000000';
    $newsletter_display_mode['inner_bg_color']              = '#fff';
    $newsletter_display_mode['affiliation_font_color']      = '#adadb9';
    $newsletter_display_mode['mit_title_color']             = '#55555f';
    $newsletter_display_mode['featured_event_bg_color']     = '#282936';
    $newsletter_display_mode['featured_event_font_color']   = '#ffffff';
    $newsletter_display_mode['featured_event_date_color']   = '#adadb9';
    $newsletter_display_mode['bg_green']                    = '#008000';
    $newsletter_display_mode['gray_bg']                     = '#d2d2da';
    $newsletter_display_mode['light_gray_bg']               = '#63636e';
    $newsletter_display_mode['slack_logo']                    = $assets_uri . '/images/newsletter/logo-slack-new.png';
}

    ob_start();
    get_template_part('template-parts/newsletters/beaver-bulletin/for', 'members');
    $output_html_for_members = ob_get_clean();


    ob_start();
    get_template_part('template-parts/newsletters/beaver-bulletin/for', 'non-members');
    $output_html_for_non_members = ob_get_clean();
