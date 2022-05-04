<?php
// TODO Namespace these to avoid conflicts
// namespace MITCNC_Theme\Functions;
require_once __DIR__ . '/../enums.php';

use MITCNC_Theme\Enums;

/* -----------------------   GENERIC METHODS   -------------------------*/
/* Create custom post types callback */
function createPostType($params)
{
    if (isset($params['slug'])) {
        $labels = array(
            'name' => $params['label_plural'],
            'singular_name' => $params['label'],
            'menu_name' => $params['label_plural'],
            'name_admin_bar' => $params['label'],
            'add_new' => 'Add New ' . $params['label'],
            'add_new_item' => 'Add New ' . $params['label'],
            'new_item' => 'New ' . $params['label'],
            'edit_item' => 'Edit ' . $params['label'],
            'view_item' => 'View ' . $params['label'],
            'all_items' => 'All ' . $params['label_plural'],
            'search_items' => 'Search ' . $params['label_plural'],
            'parent_item_colon' => 'Parent ' . $params['label_plural'] . ':',
            'not_found' => 'No ' . strtolower($params['label_plural']) . ' found.',
            'not_found_in_trash' => 'No ' . strtolower($params['label_plural']) . ' found in Trash.'
        );
        $args = [
            'labels' => $labels,
            'description' => 'Description.',
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => $params['rewrite'],
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => true,
            'menu_position' => 5,
            'supports' => $params['supports'],
            'menu_icon' => $params['menu_icon']
        ];
        register_post_type($params['slug'], $args);
    }
}

/* Create custom taxonomies callback */
function createTaxonomy($params)
{
    if (isset($params['slug'])) {
        $labels = [
            'name' => $params['label_plural'],
            'singular_name' => $params['label'],
            'search_items' => 'Search ' . $params['label_plural'],
            'all_items' => 'All ' . $params['label_plural'],
            'parent_item' => 'Parent ' . $params['label_plural'],
            'parent_item_colon' => 'Parent ' . $params['label_plural'],
            'edit_item' => 'Edit ' . $params['label'],
            'update_item' => 'Update ' . $params['label'],
            'add_new_item' => 'Add New ' . $params['label'],
            'new_item_name' => 'New ' . $params['label'] . ' Name',
            'menu_name' => $params['label_plural'],
            'not_found' => 'No ' . strtolower($params['label_plural']) . ' found.',
            'not_found_in_trash' => 'No ' . strtolower($params['label_plural']) . ' found in Trash.'
        ];
        register_taxonomy($params['slug'], $params['post_type'], [
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => $params['rewrite']
        ]);
    }
}

/* Execute custom post types and taxonomies */
function execCustomPostTypeAndTaxonomy($args = null)
{
    if ($args != null) {
        foreach ($args as $key => $value) {
            if ($value != null) {
                createPostType($value);
                if (isset($value['taxonomy'])) {
                    createTaxonomy($value['taxonomy']);
                }
            }
        }
    }
}

/* Return current logined user role */
function get_current_user_role()
{
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $role = ( array )$user->roles;
        return $role[0];
    } else {
        return false;
    }
}

/* limit the string */
function limit_words($string = '', $word_limit = 75)
{
    $words = explode(' ', $string);
    if (count($words) > $word_limit):
        return implode(' ', array_slice($words, 0, $word_limit)) . "...";
    else:
        return implode(' ', array_slice($words, 0, $word_limit));
    endif;
}

/* get image by post_id by check - placeholder */
function get_image_by_post_id($post_id = 0, $size = 'full', $is_event = false)
{
    global $assets_uri;
    $output = (!$is_event) ? $assets_uri . '/images/placeholder.jpg' : $assets_uri . '/images/skyline.svg';
    if ($post_id != 0) {
        $img = get_the_post_thumbnail_url($post_id, $size);
        $output = !empty($img) ? $img : $output;
    }
    return $output;
}

/* strip specific tag */
function strip_specific_tag($str = '', $tag = '')
{
    if (!empty($str) && !empty($tag)) {
        $str = preg_replace('/<' . $tag . '[^>]*>/i', '', $str);
        $str = preg_replace('/<\/' . $tag . '>/i', '', $str);
    }
    return $str;
}

/* -----------------------   SPECIFIC METHODS   -------------------------*/

function get_breadcrumb()
{
    global $assets_uri, $home;
    $post_id = '';
    if (is_singular('puzzles')) {
        global $puzzle_page_id;
        $post_id = $puzzle_page_id;
    } else {
        $current_page = get_queried_object();
        if ($current_page->post_parent == 0) {
        } else {
            $post_id = $current_page->ID;
        }
    }
    if (!empty($post_id)) {
        $hierarchy = get_ancestors($post_id, 'page');
        echo '<a href="' . $home . '" class="home-icon"><img src="' . $assets_uri . '/images/home-icon.png" alt=""></a>';
        if ($hierarchy != null) {
            $hierarchy = array_reverse($hierarchy);
            echo '<ul class="inner-breadcrumbs">';
            for ($i = 0; $i < count($hierarchy); $i++) {
                echo '<li><a href="' . get_permalink($hierarchy[$i]) . '">' . get_the_title($hierarchy[$i]) . '</a></li>';
            }
            echo '</ul>';
        }
    }
}

function get_slider($limit = -1, $post_types = ['stories', 'events'])
{
    $events = get_posts([
        'post_status' => 'publish',
        'post_type' => 'events',
        'posts_per_page' => $limit,
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => [
            [
                'key' => 'is_it_featured',
                'value' => '1',
                'compare' => '=',
            ],
            [
                'key' => 'date_time_date_time_end',
                'value' => date('Y-m-d H:i:s'),
                'compare' => '>=',
                'type' => 'DATETIME',
            ],
        ],
    ]);
    $stories = get_posts([
        'post_status' => 'publish',
        'post_type' => 'stories',
        'posts_per_page' => $limit,
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => [
            [
                'key' => 'is_it_featured',
                'value' => '1',
                'compare' => '=',
            ],
        ],
    ]);
    return (['events' => $events, 'stories' => $stories]);
}

function get_brass_rats($limit = -1)
{
    return get_posts([
        'post_status' => 'publish',
        'post_type' => ['brass-rats'],
        'posts_per_page' => $limit,
        'orderby' => 'date',
        'order' => 'DESC'
    ]);
}

function get_blogs($limit = -1)
{
    return get_posts([
        'post_status' => 'publish',
        'post_type' => ['blogs'],
        'posts_per_page' => $limit,
        'orderby' => 'date',
        'order' => 'DESC'
    ]);
}

function get_media_gallery($limit = -1, $is_featured = false, $program = '')
{
    $args = [
        'post_status' => 'publish',
        'post_type' => ['media-gallery'],
        'posts_per_page' => $limit,
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => []
    ];

    if ($is_featured) {
        $args['meta_query'][] = [
            'key' => 'is_it_featured',
            'value' => '1',
            'compare' => '='
        ];
    }

    if (!empty($program)) {
        $args['meta_query'][] = [
            'key' => 'programs_list',
            'value' => '"' . $program . '"',
            'compare' => 'LIKE'
        ];
    }

    return get_posts($args);
}

function get_media_gallery_for_videos($limit = -1)
{
    return get_posts([
        'post_type' => 'media-gallery',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => 'videos',
                'value' => 1,
                'compare' => '>=',
                'type' => 'NUMERIC'
            ]
        ]
    ]);
}

/**
 * @param int $limit Maximum number of events to return. Defaults to -1, no limit.
 * @param array|null $event_types
 * @param array|null $event_locations
 * @param array|null $event_programs
 * @param array|null $exclude
 * @param bool $show_past_events
 * @param string|null $gallery
 * @param string|null $date_filter
 * @param array|null $event_audience
 * @param bool $use_wp_query
 * @param array|null $event_access_type
 * @param array|null $include
 * @param array|null $speakers
 * @return WP_Post[]
 */
function get_events(
    int $limit = -1,
    // TODO Make the array fields non-nullable and update all callers
    ?array $event_types = array(),
    ?array $event_locations = array(),
    ?array $event_programs = array(),
    ?array $exclude = array(),
    bool $show_past_events = false,
    string $gallery = null,
    string $date_filter = null,
    ?array $event_audience = array(),
    // TODO Remove the $use_wp_query parameter and update all callers
    bool $use_wp_query = false,
    ?array $event_access_type = array(),
    ?array $include = array(),
    ?array $speakers = array()
): array
{
    $from = null;
    $to = null;

    if ($date_filter) {
        switch ($date_filter) {
            case Enums\DateFilter::TODAY:
                $from = date('Y-m-d H:i:s', strtotime('today 00:00:00'));
                $to = date('Y-m-d H:i:s', strtotime('today 23:59:59'));
                break;
            case Enums\DateFilter::TOMORROW:
                $from = date('Y-m-d H:i:s', strtotime('tomorrow 00:00:00'));
                $to = date('Y-m-d H:i:s', strtotime('tomorrow 23:59:59'));
                break;
            case Enums\DateFilter::THIS_WEEK:
                $from = date('Y-m-d H:i:s');
                $to = date('Y-m-d H:i:s', strtotime('next Sunday 23:59:59'));
                break;
            case Enums\DateFilter::THIS_WEEKEND:
                $from = date('Y-m-d H:i:s', strtotime('next Saturday 00:00:00'));
                $to = date('Y-m-d H:i:s', strtotime('next Sunday 23:59:59'));
                break;
            case Enums\DateFilter::THIS_MONTH:
                $from = date('Y-m-d H:i:s');
                $to = date('Y-m-d H:i:s', strtotime('last day of this month 23:59:59'));
                break;
            case Enums\DateFilter::NEXT_MONTH:
                $from = date('Y-m-d H:i:s', strtotime('first day of next month 00:00:00'));
                $to = date('Y-m-d H:i:s', strtotime('last day of next month 23:59:59'));
                break;
            case Enums\DateFilter::NEXT_THREE_MONTHS:
                $from = date('Y-m-d H:i:s');
                $to = date('Y-m-d H:i:s', strtotime('last day of +3 month 23:59:59'));
                break;
            case Enums\DateFilter::PAST_THREE_MONTHS:
                $from = date('Y-m-d H:i:s', strtotime('last day of -3 month 23:59:59'));
                $to = date('Y-m-d H:i:s');
                break;
            default:
                break;
        }
    }
    $args = [
        'post_status' => 'publish',
        'post_type' => ['events'],
        'posts_per_page' => $limit,
        'orderby' => 'meta_value',
        'meta_key' => $show_past_events ? 'date_time_date_time_end' : 'date_time_date_time_start',
        'order' => $show_past_events ? 'DESC' : 'ASC',
        'meta_query' => [
            'relation' => 'AND',
            ($from && $to) ? [
                'key' => 'date_time_date_time_start',
                'value' => [$from, $to],
                'compare' => 'BETWEEN',
                'type' => 'DATETIME'
            ] : [
                'key' => 'date_time_date_time_end',
                'value' => date('Y-m-d H:i:s'),
                'compare' => $show_past_events ? '<=' : '>=',
                'type' => 'DATETIME'
            ]
        ],
        'tax_query' => [
            'relation' => 'AND'
        ],
    ];

    if (!empty($exclude)) {
        $args['post__not_in'] = $exclude;
    }

    if (!empty($include)) {
        $args['post__in'] = $include;
    }

    $taxonomy_map = array(
        Enums\EventTaxonomy::ACCESS_TYPE => $event_access_type,
        Enums\EventTaxonomy::AUDIENCE => $event_audience,
        Enums\EventTaxonomy::CATEGORY => $event_types,
        Enums\EventTaxonomy::LOCATION => $event_locations,
        Enums\EventTaxonomy::PROGRAM => $event_programs,
    );

    // NOTE: This query will return events that have any of the given taxonomy terms, rather than
    //  all of the given terms. It's an OR, not an AND. For example, when passed an array of
    //  program IDs--[1, 2, 3]--the query will return any event associated with any of the three
    //  programs.
    foreach ($taxonomy_map as $taxonomy => $terms) {
        if (!empty($terms)) {
            $args['tax_query'][] = [
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => $terms,
            ];
        }
    }

    if ($gallery != null) {
        $args['meta_query'][] = [
            'key' => 'media_gallery',
            'value' => $gallery,
            'compare' => '='
        ];
    }

    if (!empty($speakers)) {
        $temp = [
            'relation' => 'OR'
        ];
        for ($i = 0; $i < count($speakers); $i++) {
            $speaker_data = get_user_by('ID', $speakers[$i]);
            $speaker_email = (isset($speaker_data->user_email) && !empty($speaker_data->user_email)) ? str_replace(' ', '', trim($speaker_data->user_email)) : '';
            $temp[] = [
                'key' => 'speakers_list',
                'value' => '\:\"' . $speakers[$i] . '\"',
                'compare' => 'REGEXP'
            ];
            $temp[] = [
                'key' => 'speakers_list_2',
                'value' => '\:\"' . $speakers[$i] . '\"',
                'compare' => 'REGEXP'
            ];
            $temp[] = [
                'key' => 'moderators_list',
                'value' => '\:\"' . $speakers[$i] . '\"',
                'compare' => 'REGEXP'
            ];
            $temp[] = [
                'key' => 'organizers_list',
                'value' => '\:\"' . $speakers[$i] . '\"',
                'compare' => 'REGEXP'
            ];
            if (!empty($speaker_email)) {
                $temp[] = [
                    'key' => 'contact_persons_contact_persons_secondary_contact_persons_secondary_email',
                    'value' => $speaker_email,
                    'compare' => '='
                ];
                // this is a hack because add_filter('posts_where') is not working with get_posts()
                for ($i = 0; $i < 10; $i++) {
                    $temp[] = [
                        'key' => 'contact_persons_primary_' . $i . '_email',
                        'compare' => '=',
                        'value' => $speaker_email
                    ];
                }
            }
        }
        $args['meta_query'][] = $temp;
    }
    return (($use_wp_query) ? new WP_Query($args) : get_posts($args));
}

function get_users_by_type($user_from = '', $limit = '', $is_mit = false, $program = '', $is_featured = false, $order = 'ASC', $include = null, $exclude = null, $topics = '')
{

    if (!empty($user_from)) {
        $args = [];
        $args['meta_query'] = [];
        $args['order'] = $order;
        if (!empty($limit)) {
            $args['number'] = $limit;
        }

        if ($user_from != 'awards') {
            $args['meta_query'][] = [
                'key' => 'who_is_this_from',
                'value' => $user_from,
                'compare' => 'LIKE'
            ];
        } else{
            $args['meta_query']['relation'] = 'AND';
            if($user_from == 'awards'){
                $args['meta_query'][] = [
                    'key' => 'award',
                    'value' => 0,
                    'compare' => '>'
                ];
            } else{
                $args['meta_query'][] = [
                    'relation' => 'OR',
                    [
                        'key' => 'who_is_this_from',
                        'value' => $user_from,
                        'compare' => 'LIKE'
                    ],
                    [
                        'key' => 'who_is_this_from',
                        'value' => 'speakers',
                        'compare' => 'LIKE'
                    ],
                    [
                        'key' => 'who_is_this_from',
                        'value' => 'leadership_team',
                        'compare' => 'LIKE'
                    ],
                    [
                        'key' => 'who_is_this_from',
                        'value' => 'board_of_directors',
                        'compare' => 'LIKE'
                    ],
                    [
                        'key' => 'who_is_this_from',
                        'value' => 'past_presidents',
                        'compare' => 'LIKE'
                    ]
                ];
            }

        }

        if ($is_mit === true) {
            $args['meta_query'][] = [
                'key' => 'user_type',
                'value' => '1',
                'compare' => 'LIKE'
            ];
        }
        if (!empty($program)) {
            $args['meta_query'][] = [
                'key' => 'programs_list',
                'value' => '"' . $program . '"',
                'compare' => 'LIKE'
            ];
        }
        if (!empty($topics)) {
            $args['meta_query'][] = [
                'key' => 'event_topics',
                'value' => '"' . $topics . '"',
                'compare' => 'LIKE'
            ];
        }
        if ($is_featured) {
            $args['meta_query'][] = [
                'key' => 'is_featured',
                'value' => '1',
                'compare' => 'LIKE'
            ];
        }
        if (is_array($include)) {
            $args['include'] = $include;
            $args['orderby'] = 'include';
        } else {
            $args['orderby'] = 'registered';
        }
        if (is_array($exclude)) {
            $args['exclude'] = $exclude;
        }
        return get_users($args);
    } else {
        return null;
    }
}

if (isset($_REQUEST['post'])) {
    add_action('post_submitbox_start', 'wpse248883_new_button');
    function wpse248883_new_button(){
        global $current_screen, $newletter_post_type;
        if ($newletter_post_type != $current_screen->post_type)
            return;
        ?>
        <div style="display: inline">
            <input type="button" id="copy" class="button-large button-primary" value="copy html"
                   style="position: absolute; right: 90px;"/>
        </div>
        <script>
            jQuery('#copy').on('click', function () {
                var html_copied = jQuery('#acf-editor-60').val(),
                    html_copied_localhost = jQuery('#acf-editor-58').val();
                html_copied = (typeof html_copied !== 'undefined' && html_copied != '') ? html_copied : html_copied_localhost
                jQuery('<input>').val(html_copied).appendTo('body').select();
                document.execCommand("copy");
                alert('Html Copied');
            });
        </script>
        <?php
    }
}

function wpb_list_child_pages(){
    global $post;
    $string = '';
    if (is_page() && $post->post_parent){
        $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0');
    } else{
        $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0');
    }
    if ($childpages) {
        $string = '
            <div class="sidebar-nav">
                <ul>
                    <li><a href="' . get_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a></li>' . $childpages . '
                </ul>
            </div>
        ';
    }
    return $string;
}
add_shortcode('wpb_childpages', 'wpb_list_child_pages');

function past_spotlights(){
    ob_start();
    get_template_part('template-parts/past', 'spotlights');
    return ob_get_clean();
}
add_shortcode('spotlights', 'past_spotlights');

function past_presidents(){
    ob_start();
    get_template_part('template-parts/past', 'presidents');
    return ob_get_clean();
}
add_shortcode('presidents', 'past_presidents');

function ai_idol_winners(){
    ob_start();
    get_template_part('template-parts/mit', 'ai-idol-winners');
    return ob_get_clean();
}
add_shortcode('ai-idol-winners', 'ai_idol_winners');

function ai_influencer_awards(){
    ob_start();
    get_template_part('template-parts/mit', 'ai-influencer-awards');
    return ob_get_clean();
}
add_shortcode('ai-influencer-awards', 'ai_influencer_awards');

function vip_volunteer_awards(){
    ob_start();
    get_template_part('template-parts/vip', 'volunteer-awards');
    return ob_get_clean();
}
add_shortcode('volunteer-awards', 'vip_volunteer_awards');

function output_newsletter_html($output_html){
    $Search = [
        '/(\n|^)(\x20+|\t)/',
        '/(\n|^)\/\/(.*?)(\n|$)/',
        '/\n/',
        '/\<\!--.*?-->/',
        '/(\x20+|\t)/',
        '/\>\s+\</',
        '/(\"|\')\s+\>/',
        '/=\s+(\"|\')/'
    ];
    $Replace = [
        "\n",
        "\n",
        " ",
        "",
        " ",
        "><",
        "$1>",
        "=$1"
    ];

    return $output_html;
}

add_action('save_post', 'create_html');
function create_html($post_id){
    global $newletter_post_type,
           $newsletter_post_type_single_event,
           $newsletter_post_type_beaver_bulletin,
           $newsletter_post_type_upcoming_events,
           $newsletter_post_type_event_reminder,
           $output_html_for_members,
           $output_html_for_non_members,
           $output_html_for_non_alum;
    $post_type = get_post_type($post_id);
    if (
        $post_type == in_array($post_type, [
            $newletter_post_type,
            $newsletter_post_type_single_event,
            $newsletter_post_type_beaver_bulletin,
            $newsletter_post_type_upcoming_events,
            $newsletter_post_type_event_reminder]
        ) &&
        isset($_REQUEST['post_ID']) &&
        !empty($_REQUEST['post_ID']) &&
        is_numeric($post_id) && !empty($post_id)
    ) {
        if($post_type == $newsletter_post_type_single_event){
            get_template_part('template-parts/newsletters/single-event/content', 'single-event');
            update_post_meta($post_id, 'preview_for_members', output_newsletter_html($output_html_for_members));
            update_post_meta($post_id, 'preview_for_non_members', output_newsletter_html($output_html_for_non_members));
            update_post_meta($post_id, 'preview_for_non_alum', output_newsletter_html($output_html_for_non_alum));
        } else if($post_type == $newsletter_post_type_beaver_bulletin){
            get_template_part('template-parts/newsletters/beaver-bulletin/content', 'beaver');
            update_post_meta($post_id, 'preview_for_members', output_newsletter_html($output_html_for_members));
            update_post_meta($post_id, 'preview_for_non_members', output_newsletter_html($output_html_for_non_members));
        } else if($post_type == $newsletter_post_type_upcoming_events){
            get_template_part('template-parts/newsletters/weekly-upcoming/content', 'weekly-upcoming');
            update_post_meta($post_id, 'preview_for_members', output_newsletter_html($output_html_for_members));
            update_post_meta($post_id, 'preview_for_non_members', output_newsletter_html($output_html_for_non_members));
            update_post_meta($post_id, 'preview_for_non_alum', output_newsletter_html($output_html_for_non_alum));
        } else if($post_type == $newsletter_post_type_event_reminder){
            get_template_part('template-parts/newsletters/event-reminder/content', 'event-reminder');
            update_post_meta($post_id, 'preview_for_members', output_newsletter_html($output_html_for_members));
        }
    }
}



function current_location()
{
    if (isset($_SERVER['HTTPS']) &&
        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        $protocol = 'https://';
    } else {
        $protocol = 'http://';
    }

    $current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
     return $current_url;
}




function wpd_get_menu_item( $field, $object_id, $items ){
    foreach( $items as $item ){
        if( $item->$field == $object_id ) return $item;
    }
    return false;
}


// breadcrumbs from menu
function wpd_nav_menu_breadcrumbs( $menu ){
    global $assets_uri;
    // get menu items by menu id, slug, name, or object
    $items = wp_get_nav_menu_items( $menu );
    if( false === $items ){
        return null;
    }
    // get the menu item for the current page
    $item = wpd_get_menu_item( 'object_id', get_queried_object_id(), $items );
    if( false === $item ){
        return null;
    }
    // start an array of objects for the crumbs
    $menu_item_objects = array( $item );
    // loop over menu items to get the menu item parents
    while( 0 != $item->menu_item_parent ){
        $item = wpd_get_menu_item( 'ID', $item->menu_item_parent, $items );
        array_unshift( $menu_item_objects, $item );
    }
    // output crumbs
    $crumbs = array();
    foreach( $menu_item_objects as $kkey => $menu_item ){
        if($kkey == (count($menu_item_objects) - 1)){
            break;
        }
        if(is_array($crumbs) && !empty($crumbs) && count($crumbs) > 0){
            $link = '<a class="breadcrumb-nav" href="%s">%s</a>';
        }else{
            $link = '<a class="breadcrumb-nav" href="%s">%s</a>';
        }

        $crumbs[] = sprintf( $link, $menu_item->url, $menu_item->title );
    }
    return (!empty(join( ' > ', $crumbs)) ? '<a href="'.home_url().'" class="home-icon"><img src="'.$assets_uri.'/images/home-icon.png" alt=""></a>'.join( '  ', $crumbs) : '');
}


function getHomeBanners(){
        global $assets_uri, $brass_post_type,$podcast_page_id,$covid_19_page_id,$home_page_id;
        $posts = array();

        $events = get_posts([
            'post_status' => 'publish',
            'post_type' => 'events',
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
            'meta_query' => [
                [
                    'key' => 'is_it_featured',
                    'value' => '1',
                    'compare' => '=',
                ],
                [
                    'key' => 'date_time_date_time_end',
                    'value' => date('Y-m-d H:i:s'),
                    'compare' => '>=',
                    'type' => 'DATETIME',
                ],
            ],
        ]);

        if(!empty($events)){
            foreach($events as $event){
                array_push(
                    $posts,
                    array(
                        "ID"            => $event->ID,
                        "post_date"     => $event->post_date,
                        "post_title"    => $event->post_title,
                        "post_content"  => $event->post_content,
                        "post_type"     => 'events',
                        "author_name"   => '',
                        "get_permalink" => get_permalink($event->ID),
                        "image"         => ($event->ID == '5470') ? $assets_uri . '/images/MIT-AI2020-Banner.png' : get_the_post_thumbnail_url($event->ID,'thumbnail_1079_474'),
                        "slide_color"   => get_field('banner_background_color', $event->ID)
                    )
                );
            }
        }

        $rats = new WP_Query(
            array(
                "post_type" => $brass_post_type,
                "posts_per_page"   => 1
            )
        );

        while ( $rats->have_posts() ) {
            $rats->the_post();
            array_push(
                $posts,
                array(
                    "post_title"    => get_the_title(),
                    "post_content"  => get_the_content(),
                    "post_type"     => $brass_post_type,
                    "author_name"   => get_field('author_name',get_the_ID()),
                    "get_permalink" => get_permalink(677),
                    "image"         => get_the_post_thumbnail_url(get_the_ID(),'full')
                )
            );
        }


        array_push(
            $posts,
            array(
                "post_title"    => '',
                "post_content"  => get_the_content(null,null,$podcast_page_id),
                "post_type"     => 'podcast',
                "author_name"   => '',
                "get_permalink" => get_permalink($podcast_page_id),
                "image"         => get_the_post_thumbnail_url($podcast_page_id,'full')
            )
        );

        array_push(
            $posts,
            array(
                "post_title"    => '',
                "post_content"  => get_the_content(null,null,$covid_19_page_id),
                "post_type"     => 'covid',
                "author_name"   => '',
                "get_permalink" => get_permalink($covid_19_page_id),
                "image"         => get_the_post_thumbnail_url($covid_19_page_id,'full')
            )
        );

        if(!empty($home_page_id) && $home_page_id > 0){
            $volunteers_by_page = get_field('volunteer_list', $home_page_id);
            $volunteer_spotlight = null;
            if(is_array($volunteers_by_page)) {
                $volunteer_spotlight = get_users_by_type('volunteer_spotlight', 1, false, '', false, 'ASC', $volunteers_by_page);
            }
            if($volunteer_spotlight != null){
                $volunteer = $volunteer_spotlight[0];
                $volunteer_full_name = get_field('full_name', 'user_'.$volunteer->ID);
                $volunteer_last_name = get_field('user_last_name', 'user_'.$volunteer->ID);
                $volunteer_affiliations = get_field('affiliations', 'user_'.$volunteer->ID);
                $affiliation_groups = group_affiliations($volunteer_affiliations);
                $volunteer_affiliations_mit = $affiliation_groups->mit;
                $volunteer_affiliations_other = $affiliation_groups->other;
                $volunteer_designations = [];
                if (have_rows('designations', 'user_'.$volunteer->ID)) {
                    while (have_rows('designations', 'user_'.$volunteer->ID)) {
                        the_row();
                        $volunteer_designations[] = get_sub_field('designation_title', 'user_'.$volunteer->ID);
                    }
                }
                $volunteer_teams = [];
                if (have_rows('teams', 'user_'.$volunteer->ID)) {
                    while (have_rows('teams', 'user_'.$volunteer->ID)) {
                        the_row();
                        $volunteer_teams[] = get_sub_field('team_name', 'user_'.$volunteer->ID);
                    }
                }
                $volunteer_bio = get_field('bio', 'user_'.$volunteer->ID);
                $volunteer_img = get_field('profile_image', 'user_'.$volunteer->ID);
                $volunteer_img = !empty($volunteer_img) ? $volunteer_img : $assets_uri.'/images/placeholder.png';
                $volunteer_mit_status = is_mitcnc_member($volunteer->ID);

                array_push(
                    $posts,
                    array(
                        "volunteer_full_name"   => $volunteer_full_name. ' ' . $volunteer_last_name,
                        "affiliations"          => (($volunteer_affiliations_mit != null) ? implode(', ', $volunteer_affiliations_mit) : '').(($volunteer_affiliations_other != null) ? ', '.implode(', ', $volunteer_affiliations_other) : ''),
                        "post_type"             => 'volunteer-spotlight',
                        "designations"          => (($volunteer_designations != null) ? implode(', ', $volunteer_designations) : '').(($volunteer_teams != null) ? implode(', ', $volunteer_teams) : ''),
                        "bio"                   => strip_tags($volunteer_bio),
                        "author_url"            => get_author_posts_url($volunteer->ID),
                        "volunteer_mit_status"  => $volunteer_mit_status,
                        "view_all"              => get_permalink(206),
                        "image"                 => $volunteer_img
                    )
                );
            }
        }

        return $posts;
}

if(!function_exists('url_get_contents')){
    function url_get_contents ($url, $bypass_cache=false) {
        $cache_key = md5("url_get_contents_${url}");
        $cache_group = '';
        $cache_expire = 3600;

        if(!$bypass_cache) {
            $output = wp_cache_get($cache_key, $cache_group);

            if ($output) {
                return $output;
            }

            error_log("Failed to pull ${url} from cache!");
        }

        if (!extension_loaded('curl')){
            die('CURL is not installed!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);

        wp_cache_set($cache_key, $output, $cache_group, $cache_expire);

        return $output;
    }
}



function GetHomePageNews(){
    $output = [];
    $urls = ['https://news.mit.edu/rss/feed', 'https://news.mit.edu/rss/research', 'https://news.mit.edu/rss/campus', 'https://news.mit.edu/rss/topic/alumni', 'https://news.mit.edu/rss/topic/mit-community'];
    $tmpp = [];
    foreach($urls as $url){
        $contents = url_get_contents($url);
        $xml = simplexml_load_string($contents);
        if ($xml === false) {
            echo "Failed loading XML: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        } else {
            if (isset($xml->channel->item) && count($xml->channel->item) > 0) {
                foreach ($xml->channel->item as $data) {
                    if(!in_array((string)$data->guid, $tmpp)){
                        $output[strtotime($data->pubDate)] = $data;
                        $tmpp[] = (string)$data->guid;
                        break;
                    }
                }
            }
        }
    }

    if($output != null){
        krsort($output);
        foreach ($output as $data) {
            ?>
                <li>
                    <a href="<?php echo $data->guid; ?>" target="_blank" >
                        <span class="date"><?php echo date('F j, Y', strtotime($data->pubDate)); ?></span>
                        <h5><?php echo $data->title; ?></h5>
                    </a>
                </li>
            <?php
        }
    }
}



function GetAgendaObject($event_year = null){
    $agendaObject = array();
    $dates = get_terms('events-agenda-dates');
    if($event_year != null && isset($event_year->term_id)){
        if(!empty($dates) && is_array($dates) && count($dates) > 0 ){
            foreach($dates as $key => $d){
                $args = array(
                    'post_type'           => 'events-agenda',
                    'posts_per_page'      => -1,
                    'meta_key'            => 'schedule_time',
                    'orderby'             => 'meta_value',
                    'order'               => 'ASC',
                    'tax_query'           => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy'    => 'events-agenda-years',
                            'field'       => 'term_id',
                            'terms'       => $event_year->term_id
                        ),
                        array(
                            'taxonomy'    => 'events-agenda-dates',
                            'field'       => 'term_id',
                            'terms'       => $d->term_id
                        )
                    )
                );
                $my_query = get_posts($args);
                if(!empty($my_query) && is_array($my_query) && count($my_query)){
                    $agendaObject[$key]["date"] = $d;
                    $agendaObject[$key]['agenda'] = $my_query;
                }
            }
        }
    }

    return $agendaObject;
}


function slack_parse_text_key($string)
{
    $output = preg_replace("<@([;\s\w\"\=\,\:\./\~\{\}\?\!\-\%\&\#\$\^\(\)]*?)>", "", $string);
    if (!empty($string)) {
        $regex = '/<\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]>/i';
        preg_match_all($regex, $string, $matches);
        if (isset($matches[0]) && null != $matches[0]) {
            foreach ($matches[0] as $key => $match) {
                $match = str_replace(array('<', '>'), '', $match);
                $match_text = explode('|', $match);
                $match_text = isset($match_text[1]) ? $match_text[1] : $match_text[0];
                $output = str_replace("<{$match}>", "<a target='_blank' href='{$match}'>{$match_text}</a>", $output);
                $output = str_replace("\n", '<br>', $output);
            }
        }
    }
    return $output;
}

function slack_custom_curl($url)
{
    global $slack_token;
    $curl = curl_init();
    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer {$slack_token}",
                'Content-Type: application/x-www-form-urlencoded',
                'cache-control: no-cache'
            ),
        )
    );

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return esc_html("cURL Error #: $err");
    } else {
        return $response;
    }
}

function is_unlisted_event($post_id)
{
    $output = false;
    if(!empty($post_id)) {
        global $event_category_taxonomy;
        $post_terms_list = wp_get_post_terms($post_id, $event_category_taxonomy, array( 'fields' => 'ids' ));
        if(in_array(107, $post_terms_list)) {
            $output = true;
        }
    }
    return $output;
}

function banner_speakers($speakers = null, $is_large_speaker = false, $is_moderator = false, $is_organizer = false)
{
    if (null != $speakers) {
        global $assets_uri;
        foreach ($speakers as $keey => $speaker) {
            $img = get_field('profile_image', 'user_' . $speaker->ID);
            $img = !empty($img) ? $img : $assets_uri . '/images/placeholder.png';
            $speaker_mit_status = is_mit_alum($speaker->ID);
            $full_name = get_field('full_name', 'user_' . $speaker->ID);
            $last_name = get_field('user_last_name', 'user_' . $speaker->ID);
            $team = array();
            if (have_rows('teams', 'user_' . $speaker->ID)) {
                while (have_rows('teams', 'user_' . $speaker->ID)) {
                    the_row();
                    $team[] = get_sub_field('company', 'user_' . $speaker->ID);
                }
            }
            ?>
            <li style="width: <?php echo ($is_large_speaker) ? '50' : '26'; ?>%;" <?php echo ($is_large_speaker) ? 'id="one-speaker"' : ''; ?>>
                <a href="<?php echo esc_url(get_author_posts_url($speaker->ID)); ?>"
                   class="speaker-box">
                    <span class="speaker-img" <?php echo ($is_large_speaker) ? 'style="height: auto;"' : ''; ?>>
                        <img src="<?php echo esc_url($img); ?>" alt="">
                        <?php if ($speaker_mit_status) { ?>
                            <div class="icon-mit" <?php echo ($is_large_speaker) ? 'style="left: 20px; width:40px;"' : ''; ?>>
                                <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                            </div>
                        <?php } ?>
                    </span>
                    <span class="speaker-title-desg">
                        <?php
                        echo ($is_large_speaker) ? '<h4 class="text-white" style="font-size: 24px; margin-top: 0;">' : '';
                        echo esc_html($full_name) . ' ' . esc_html($last_name);
                        echo ($is_large_speaker) ? '</h4>' : '';
                        if ($is_large_speaker && have_rows('positions', 'user_' . $speaker->ID)) {
                            while (have_rows('positions', 'user_' . $speaker->ID)) {
                                the_row();
                                ?>
                                    <span class="designation company_name" style="line-height: 1.3;display: block;"><?php the_sub_field('company', 'user_' . $speaker->ID); ?></span>
                                    <span class="designation" style="line-height: 1.3;display: block;"><?php the_sub_field('job_title', 'user_' . $speaker->ID); ?></span>
                                <?php
                                break;
                            }
                        }
                        if($is_moderator){
                            ?>
                                <span class="tags-box" style="display: block;">
                                    <span class="tag" style="font-weight: 100; opacity: 1; display: inline-block;">Moderator</span>
                                </span>
                            <?php
                        }
                        if($is_organizer){
                            ?>
                                <span class="tags-box" style="display: block;">
                                    <span class="tag" style="font-weight: 100; opacity: 1; display: inline-block;">Organizer</span>
                                </span>
                            <?php
                        }
                        ?>
                    </span>
                </a>
            </li>
            <?php
        }
    }
}

function get_reservation_button($end_on = '', $sold_out_flag = false, $reserve_now_btn_text = 'Reserve Now', $meta_data = null, $css_class = '') {
    global $assets_uri;
    $current_user_id = get_current_user_id();
    $is_logged_in = $current_user_id > 0;
    if (strtotime($end_on) < time()) { ?>
        <a href="javascript:void(0);" class="default-btn disabled <?php echo $css_class; ?>">
            Event Closed
            <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="" />
        </a>
    <?php } else if ($sold_out_flag) { ?>
        <a href="javascript:void(0);" class="default-btn disabled <?php echo $css_class; ?>">
            Sold Out
            <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="" />
        </a>
        <?php
    } else {
        if (
            isset($meta_data['registration_3_affiliate_reservation_link'][0]) &&
            !empty($meta_data['registration_3_affiliate_reservation_link'][0]) &&
            isset($meta_data['registration_3_mit_alum'][0]) && // MITCNC Member
            ($meta_data['registration_3_mit_alum'][0] == 0 || empty($meta_data['registration_3_mit_alum'][0])) &&
            isset($meta_data['registration_3_mit_alumni_club'][0]) && // a member of any MIT Alumni Club
            ($meta_data['registration_3_mit_alumni_club'][0] == 0 || empty($meta_data['registration_3_mit_alumni_club'][0])) &&
            isset($meta_data['registration_3_mit_alumni'][0]) && // an MIT Alumni, who is not a member of any club
            ($meta_data['registration_3_mit_alumni'][0] == 0 || empty($meta_data['registration_3_mit_alumni'][0])) &&
            isset($meta_data['registration_3_non_alum'][0]) && // Non Alum
            ($meta_data['registration_3_non_alum'][0] == 0 || empty($meta_data['registration_3_non_alum'][0]))
        ) {
            ?>
            <a href="<?php echo esc_url($meta_data['registration_3_affiliate_reservation_link'][0]); ?>" target="_blank" class="default-btn <?php echo $css_class; ?>">
                <?php echo esc_html($reserve_now_btn_text); ?>
                <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="" />
            </a>
        <?php }  else { ?>
            <a href="#section--registration" class="default-btn <?php echo $css_class; ?>">
                <?php echo esc_html($reserve_now_btn_text); ?>
                <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="" />
            </a>
            <?php
        }
    }
}

function get_search_results($keyword = '')
{
    global $wpdb;
    $sql_posts = "
        SELECT
            p.ID,
            p.post_author,
            p.post_date,
            p.post_title,
            p.post_content,
            p.post_status,
            p.post_name,
            p.post_type
        FROM
            wp_posts AS p
        WHERE
            p.post_status = 'publish' AND(
                p.post_title LIKE '%{$keyword}%' OR p.post_content LIKE '%{$keyword}%'
            ) AND p.post_type IN(
                'brass-rats',
                'events',
                'events-agenda',
                'media-gallery',
                'page',
                'post',
                'puzzle-snacks',
                'puzzles'
            )
        ORDER BY
            p.post_date
        DESC;
    ";

    $sql_users = "
        SELECT
            u.ID,
            u.user_email,
            u.display_name,
            um.meta_value as first_name
        FROM
            wp_users AS u
        LEFT JOIN wp_usermeta AS um
        ON
            u.ID = um.user_id
        WHERE
            um.meta_value <> '' AND um.meta_value IS NOT NULL AND (
                (um.meta_key = 'full_name' AND um.meta_value LIKE '%{$keyword}%') OR
                (um.meta_key = 'user_last_name' AND um.meta_value LIKE '%{$keyword}%')
            ) AND um.user_id IN (
                SELECT um2.user_id FROM wp_usermeta AS um2 WHERE um2.meta_key = 'who_is_this_from' AND (
                    um2.meta_value LIKE '%speakers%' OR 
                    um2.meta_value LIKE '%leadership_team%' OR 
                    um2.meta_value LIKE '%board_of_directors%' OR 
                    um2.meta_value LIKE '%volunteer_spotlight%' OR 
                    um2.meta_value LIKE '%past_presidents%' OR 
                    um2.meta_value LIKE '%mitaa_board_members%' OR 
                    um2.meta_value LIKE '%mitaa_board_presidents%' OR 
                    um2.meta_value LIKE '%mit_corporation_members%' 
                ) AND um2.meta_value <> '' AND um2.meta_value IS NOT NULL
            );
    ";

    $output['posts'] = $wpdb->get_results($sql_posts);
    $output['users'] = $wpdb->get_results($sql_users);
    $output['count'] = (($output['posts'] != null) ? count($output['posts']) : 0) + (($output['users'] != null) ? count($output['users']) : 0);

    return $output;
}
