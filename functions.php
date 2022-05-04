<?php
require_once 'inc/globals-theme.php';
require_once 'inc/functions-nav-walker.php';
require_once 'inc/functions-theme.php';
require_once 'inc/functions-custom.php';
require_once 'inc/functions-ajax-callbacks.php';
require_once 'inc/functions-cpt-extra.php';
require_once 'inc/functions-enqueue.php';
require_once 'inc/functions-duplicate-posts.php';
require_once 'inc/functions-custom-statuses.php';
require_once 'partials/catalysts/catalysts.php';

function allowed_html()
{
    return array(
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'br' => array(),
        'em' => array(),
        'p' => array(),
        'strong' => array(),
    );
}


/**
 * Indicates if the user is a member of *any* MITAA club.
 *
 * @param $user_id integer
 * @param $refresh_from_server boolean
 *
 * @return boolean
 */
function is_mit_club_member(int $user_id, bool $refresh_from_server = true)
{
    // Check the custom capability
    if (user_can($user_id, 'read_mit_club')) {
        return true;
    }

    // Check the custom meta data set by the MITAA SSO plugin,
    // and fallback to the data from the MITCNC theme.
    $is_member = boolval(get_user_meta($user_id, 'mitaa-is_club_member', true)) ||
        is_mitcnc_member($user_id);

    if ($is_member) {
        return $is_member;
    }

    if ($refresh_from_server) {
        do_action('mitaa_sso_refresh_user_details', $user_id);
        return is_mit_club_member($user_id, false);
    }

    return false;
}


/**
 * Indicates if the user is an MIT alum.
 *
 * @param $user_id int
 *
 * @return bool
 */
function is_mit_alum(int $user_id): bool
{
    return boolval(get_field('user_type', 'user_' . $user_id));
}


/**
 * Indicates if the user a member of *MITCNC*.
 *
 * @param $user_id integer
 *
 * @return boolean
 */
function is_mitcnc_member(int $user_id)
{
    // Check the custom capability
    if (user_can($user_id, 'read_mitcnc')) {
        return true;
    }

    // Check the custom meta data set by the MITAA SSO plugin.
    $memberships = get_user_meta($user_id, 'mitaa-club_memberships', true);

    if (!empty($memberships)) {
        foreach ($memberships as $membership) {
            if ('SK' === $membership['club']) {
                return true;
            }
        }
    }

    return !!get_active_subscription($user_id);
}

/**
 * Returns the user's active subscription (from Stripe).
 *
 * @param $user_id integer
 *
 * @return \Stripe\Subscription | null
 */
function get_active_subscription($user_id)
{
    $stripe_customer = apply_filters('wp_stripe_customer', $user_id);

    if (is_wp_error($stripe_customer)) {
        return null;
    }

    if (isset($stripe_customer->subscriptions) && $stripe_customer->subscriptions->count() > 0) {
        return $stripe_customer->subscriptions->data[0];
    }

    return null;
}

/**
 * Returns the URL of the membership page where alumni can join the club.
 *
 * @return string
 */
function get_membership_url()
{
    return get_permalink(6629);
}

function get_volunteer_questions()
{
    $volunteer_questions = array();

    $volunteer_questions_field = get_field_object('field_5ba25e2eaf376');
    if (isset($volunteer_questions_field['sub_fields']) && null != $volunteer_questions_field['sub_fields']) {
        $sub_field_count = count($volunteer_questions_field['sub_fields']);
        for ($i = 0; $i < $sub_field_count; $i++) {
            $volunteer_questions[$volunteer_questions_field['sub_fields'][$i]['name']]['question'] = $volunteer_questions_field['sub_fields'][$i]['label'];
            $volunteer_questions[$volunteer_questions_field['sub_fields'][$i]['name']]['answer'] = '';
        }
    }

    return $volunteer_questions;
}

class AffiliationGroups
{
    public $mit = array();
    public $other = array();
}

/**
 * Group affiliations by MIT vs. Other.
 *
 * @param $affiliations
 * @return AffiliationGroups
 */
function group_affiliations($affiliations)
{
    $affiliation_set = new AffiliationGroups();

    if ($affiliations) {
        foreach ($affiliations as $affiliation) {
            if ($affiliation != null) {
                $count = count($affiliation);
                for ($i = 0; $i < $count; $i++) {
                    if (isset($affiliation[$i]['mit_affiliation_title'])) {
                        $affiliation_set->mit[] = $affiliation[$i]['mit_affiliation_title'];
                    } else if (isset($affiliation[$i]['other_affiliation_title'])) {
                        $affiliation_set->other[] = $affiliation[$i]['other_affiliation_title'];
                    }
                }
            }
        }
    }

    return $affiliation_set;
}

// Redirect to the homepage after the user logs out
// This ensures the user does not end up on the WordPress
// login page, which is not normally visible, given we use SSO.
add_action('wp_logout', 'redirect_to_home');
function redirect_to_home()
{
    wp_redirect(get_home_url());
    exit();
}

function get_asset_uri($path)
{
    $path = ltrim($path, '/');
    $theme_uri = get_template_directory_uri();
    return "${theme_uri}/assets/${path}";
}

function get_event_image_uri($event): string
{
    $path = null;
    switch ($event->ID) {
        case 2501:
            $path = '/images/mit-ai-conf-2019-thumb.jpg';
            break;
        case 3369:
            $path = '/images/spotlight-2019-thumb.png';
            break;
        case 3922:
            $path = '/images/BOS-event-thumb.png';
            break;
        default:
            $path = null;
            break;
    }

    if ($path) {
        return get_asset_uri($path);
    }

    return get_image_by_post_id($event->ID, 'thumbnail_334_141', true);
}
