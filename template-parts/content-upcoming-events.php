<?php
global $post, $events_page_id, $upcoming_events;

use MITCNC_Theme\Enums;

// NOTE: As of WordPress 5.5, we can pass args to get_template_part().
//  However, we are not doing this in all locations. This code allows us
//  to support both args and the existing global variable usage.
$defaults = array(
    'events' => $upcoming_events,
);

$args = wp_parse_args($args, $defaults);
$upcoming_events = $args['events'];

if (null != $upcoming_events) {
    $show_see_all_button = isset($args['show_see_all_button']) ? $args['show_see_all_button'] : true;
    $section_heading = isset($args['section_heading']) ? $args['section_heading'] : 'Upcoming Events';
    if (is_active_sidebar('event_see_all_exclude_for') && $show_see_all_button) {
        ob_start();
        dynamic_sidebar('event_see_all_exclude_for');
        $page_ids = ob_get_clean();
        $page_ids = str_replace(' ', '', $page_ids);
        $page_ids = !empty($page_ids) ? explode(',', $page_ids) : array();
        $show_see_all_button = (isset($post->ID) && in_array($post->ID, $page_ids)) ? false : $show_see_all_button;
    }
    ?>
    <article class="upcoming-events">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2>
                        <a href="<?php echo esc_url(get_permalink(Enums\PageID::EVENT_LISTING)); ?>">
                            <?php echo esc_html($section_heading); ?>
                        </a>
                    </h2>
                </div>
            </div>
            <div class="row card-container">
                <div class="card-slider clearfix">
                    <?php
                    get_template_part(
                        'template-parts/content',
                        'events-loop',
                        array('events' => $upcoming_events)
                    );
                    ?>
                </div>
                <?php if ($show_see_all_button) { ?>
                    <div class="col-sm-24 center-mobile">
                        <a href="<?php echo esc_url(get_permalink($events_page_id)); ?>"
                           class="default-btn event-btns right">
                            See All Events
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </article>
<?php } ?>
