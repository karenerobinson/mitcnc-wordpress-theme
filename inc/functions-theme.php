<?php
/* Theme settings */
add_action(
    'after_setup_theme',
    function () {
        global $site_text_domain;
        load_theme_textdomain($site_text_domain);
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_image_size('thumbnail_111_104', 111, 104, true);
        add_image_size('thumbnail_224_205', 224, 205, true);
        add_image_size('thumbnail_328_220', 328, 220, true);
        add_image_size('thumbnail_334_141', 334, 141, true);
        add_image_size('thumbnail_709_218', 709, 218, true);
        add_image_size('thumbnail_1079_474', 1079, 474, true);
        register_nav_menus(
            array(
                'menu-primary' => esc_html__('Primary', $site_text_domain),
                'menu-secondary' => esc_html__('Secondary', $site_text_domain),
            )
        );
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );
        add_post_type_support('page', 'excerpt');
    }
);

/* Hide admin bar from frontend */
add_filter('show_admin_bar', '__return_false');

/* Hide generator link */
add_filter(
    'the_generator',
    function () {
        return '';
    }
);


/* Remove unwanted links and tags from front-end */
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

function show_only_published_feed($query)
{
    if (!$query->is_main_query() || !is_feed())
        return;

    $query->set('post_status', 'publish');
}

add_action('pre_get_posts', 'show_only_published_feed', 1);


add_filter('xmlrpc_enabled', '__return_false');

add_filter('wp_headers', 'disable_x_pingback');
function disable_x_pingback($headers)
{
    unset($headers['X-Pingback']);
    return $headers;
}

add_action(
    'login_head',
    function () {
        ?>
        <style>
            #nav, #backtoblog {
                display: none
            }

            .forgetmenot {
                display: none;
            }

            .submit .button.button-primary.button-large {
                float: left
            }
        </style>
        <?php
    }
);

add_action('admin_bar_menu', 'remove_wp_logo', 999);
function remove_wp_logo($wp_admin_bar)
{
    $wp_admin_bar->remove_node('wp-logo');
}


add_action(
    'login_enqueue_scripts',
    function () {
        global $assets_uri;
        $image_url = "{$assets_uri}/images/mit-logo.png";
        ?>
        <style>
            #login h1 a, .login h1 a {
                background-image: url(<?php echo esc_url($image_url); ?>);
                background-repeat: no-repeat;
                background-size: contain;
                height: 47px;
                width: auto;
            }
        </style>
        <?php
    }
);

add_filter(
    'login_headerurl',
    function () {
        return home_url();
    }
);


function change_admin_footer()
{
    global $assets_uri;
    $image_url = "{$assets_uri}/images/mit-logo.png";
    ?>
    <span id="footer-note" style="position: absolute; right: 15px; bottom: 15px;">
        <a href="<?php echo home_url(); ?>" target="_blank">
            <img src="<?php echo esc_url($image_url); ?>" style="width: 150px;"/>
        </a>
    </span>
    <?php
}

add_filter('admin_footer_text', 'change_admin_footer');


add_action(
    'admin_menu',
    function () {
        remove_filter('update_footer', 'core_update_footer');
    }
);

add_filter('get_user_option_admin_color', 'update_user_option_admin_color', 5);

function update_user_option_admin_color($color_scheme)
{
    $color_scheme = 'fresh';
    return $color_scheme;
}


// block WP enum scans
// https://m0n.co/enum
if (!is_admin()) {
    // default URL format
    if (isset($_SERVER['QUERY_STRING']) && preg_match('/author=([0-9]*)/i', wp_unslash($_SERVER['QUERY_STRING']))) {
        die();
    }
    add_filter('redirect_canonical', 'shapeSpace_check_enum', 10, 2);
}

function shapeSpace_check_enum($redirect, $request)
{
    // permalink URL format
    if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
    else return $redirect;
}


/* remove wp version param from any enqueued scripts */
function vc_remove_wp_ver_css_js($src)
{
    if (strpos($src, 'ver=' . get_bloginfo('version')))
        $src = remove_query_arg('ver', $src);
    return $src;
}

add_filter('style_loader_src', 'vc_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'vc_remove_wp_ver_css_js', 9999);

/* prevent tags in comments */
function plc_comment_post($incoming_comment)
{
    $incoming_comment['comment_content'] = htmlspecialchars(strip_tags($incoming_comment['comment_content']));
    $incoming_comment['comment_content'] = str_replace("'", '&apos;', $incoming_comment['comment_content']);
    return ($incoming_comment);
}

function plc_comment_display($comment_to_display)
{
    $comment_to_display = str_replace('&apos;', "'", strip_tags($comment_to_display));
    return $comment_to_display;
}

add_filter('preprocess_comment', 'plc_comment_post', '', 1);
add_filter('comment_text', 'plc_comment_display', '', 1);
add_filter('comment_text_rss', 'plc_comment_display', '', 1);
add_filter('comment_excerpt', 'plc_comment_display', '', 1);

if (!is_admin()) {
    function add_defer_attribute($tag, $handle)
    {
        return str_replace(' src', ' defer="defer" src', $tag);
    }

    add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
}

if (!function_exists('wp_new_user_notification')) {
    function wp_new_user_notification($user_id, $deprecated = null, $notify = '')
    {
        return;
    }
}

// add media file type support
function my_myme_types($mime_types)
{
    $mime_types = array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif', 'doc' => 'application/msword', 'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'xls' => 'application/vnd.ms-excel', 'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'pdf' => 'application/pdf', 'rtf' => 'application/rtf', 'svg' => 'image/svg+xml');
    return $mime_types;
}

add_filter('upload_mimes', 'my_myme_types', 1, 1);

//    add_filter('acf/settings/show_admin', '__return_false');


add_filter(
    'single_template',
    function ($template) {
        global $post;
        if ($post->post_type === 'events') {
            $locate_template = locate_template("single-events-{$post->post_name}.php");
            if (!empty($locate_template)) {
                $template = $locate_template;
            }
        }
        return $template;
    }
);


// REMOVE USER AUTHOR BASE NAME FROM URL
// The first part //
add_filter('author_rewrite_rules', 'no_author_base_rewrite_rules');
function no_author_base_rewrite_rules($author_rewrite)
{
    global $wpdb;
    $author_rewrite = array();
    $authors = $wpdb->get_results("SELECT user_nicename AS nicename from $wpdb->users");
    foreach ($authors as $author) {
        $author_rewrite["({$author->nicename})/page/?([0-9]+)/?$"] = 'index.php?author_name=$matches[1]&paged=$matches[2]';
        $author_rewrite["({$author->nicename})/?$"] = 'index.php?author_name=$matches[1]';
    }
    return $author_rewrite;
}

// The second part //
add_filter('author_link', 'no_author_base', 1000, 2);
function no_author_base($link, $author_id)
{
    $link_base = trailingslashit(get_option('home'));
    $link = preg_replace("|^{$link_base}author/|", '', $link);
    return $link_base . $link;
}

add_action('user_register', 'myplugin_registration_save', 10, 1);
function myplugin_registration_save($user_id)
{
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}


add_action('rss2_item', 'events_rss2_item');
function events_rss2_item()
{
    if (get_post_type() == 'events') {
        global $event_category_taxonomy,
               $event_location_taxonomy;
        $post_id = get_the_ID();

        echo "<event_id>{$post_id}</event_id>\n";

        if ($value = get_the_post_thumbnail_url($post_id, 'full')) {
            echo "<banner>{$value}</banner>\n";
        }

        if ($value = date_default_timezone_get()) {
            echo "<timezone>{$value}</timezone>\n";
        }

        if ($value = get_field('date_time_date_time_start', $post_id)) {
            // 2019-08-05T08:21:00-07:00
            echo '<start_on>' . date('c', strtotime($value)) . "</start_on>\n";
        }

        if ($value = get_field('date_time_date_time_end', $post_id)) {
            echo '<end_on>' . date('c', strtotime($value)) . "</end_on>\n";
        }

        if ($value = wp_get_post_terms($post_id, $event_category_taxonomy)) {
            if (isset($value[0]->name)) {
                echo '<type>' . strip_tags(str_replace('&', '&amp;', $value[0]->name)) . "</type>\n";
            }
        }

        if ($value = wp_get_post_terms($post_id, $event_location_taxonomy)) {
            if (isset($value[0]->name)) {
                echo '<region>' . strip_tags(str_replace('&', '&amp;', $value[0]->name)) . "</region>\n";
            }
        }

        $add = '';
        $add .= '<venue>' . strip_tags(get_field('location_address', $post_id)) . "</venue>\n";
        $add .= '<address1>' . strip_tags(get_field('location_address_1', $post_id)) . "</address1>\n";
        $add .= '<address2>' . strip_tags(get_field('location_address_2', $post_id)) . "</address2>\n";
        $location_city = get_field('location_city', $post_id);
        $add .= '<city>' . (isset($location_city['label']) ? strip_tags($location_city['label']) : '') . "</city>\n";
        $add .= '<state>' . strip_tags(get_field('location_state', $post_id)) . "</state>\n";
        $add .= '<zipcode>' . strip_tags(get_field('location_postal_code', $post_id)) . "</zipcode>\n";
        if ($add) {
            echo "<location>\n" . str_replace('&', '&amp;', $add) . "</location>\n";
        }

        if (have_rows('contact_persons', $post_id)) {
            while (have_rows('contact_persons', $post_id)) {
                the_row();
                if (have_rows('primary', $post_id)) {
                    $primary_contact = '';
                    while (have_rows('primary', $post_id)) {
                        the_row();
                        $name = get_sub_field('name');
                        $email = get_sub_field('email');
                        $primary_contact .= "<contact>\n<name>{$name}</name>\n<email>{$email}</email>\n</contact>\n";
                    }
                    echo "<primary_contacts>\n" . str_replace('&', '&amp;', $primary_contact) . "</primary_contacts>\n";
                }
            }
        }
    }
}

// a user group filter added in users.php
function filter_users_by_group($which)
{
    $groups = get_field_object('field_5ba25d6caf375');
    $top = isset($_GET['who_is_this_from_top']) ? $_GET['who_is_this_from_top'] : '';
    $bottom = isset($_GET['who_is_this_from_bottom']) ? $_GET['who_is_this_from_bottom'] : '';
    $selected = !empty($top) ? $top : $bottom;
    $st = '
            <select name="who_is_this_from_%s">
                <option value="">%s</option>%s
            </select>';
    $options = '';
    if (null != $groups['choices']) {
        foreach ($groups['choices'] as $key => $value) {
            $options .= '<option value="' . $key . '" ' . (($selected == $key) ? 'selected' : '') . '>' . $value . '</option>';
        }
    }

    $select = sprintf($st, $which, __('User Group'), $options);
    echo '<div style="float: right; margin-left: 15px;">';
    echo $select;
    submit_button(__('Filter'), null, $which, false);
    echo '</div>';
}

add_action('restrict_manage_users', 'filter_users_by_group');
add_filter('pre_get_users', 'filter_users_by_job_role_section');

function filter_users_by_job_role_section($query)
{
    global $pagenow;
    if (is_admin() && 'users.php' == $pagenow) {
        $top = isset($_GET['who_is_this_from_top']) ? $_GET['who_is_this_from_top'] : null;
        $bottom = isset($_GET['who_is_this_from_bottom']) ? $_GET['who_is_this_from_bottom'] : null;
        if (!empty($top) || !empty($bottom)) {
            $section = !empty($top) ? $top : $bottom;
            $meta_query = array(array(
                'key' => 'who_is_this_from',
                'value' => $section,
                'compare' => 'LIKE'
            ));
            $query->set('meta_query', $meta_query);
        }
    }
}

// disable the Gutenberg editor and use classic
add_filter('use_block_editor_for_post', '__return_false');

/**
 * Prevent to open detail page of specific post type
 */
add_action('template_redirect', function () {
    $queried_post_type = get_query_var('post_type');
    if (is_single() && in_array($queried_post_type, array('newsletter-single', 'newsletter-beaver', 'newsletter-upcoming', 'event-reminder'))) {
        wp_redirect(home_url(), 301);
        exit;
    }
});
