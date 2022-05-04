<?php
global $upcoming_events, $event_loop_cols;

// NOTE: As of WordPress 5.5, we can pass args to get_template_part().
//  However, we are not doing this in all locations. This code allows us
//  to support both args and the existing global variable usage.
$defaults = array
(
    'events' => $upcoming_events,
    'column-size' => $event_loop_cols ?? 8,
);

$args = wp_parse_args($args, $defaults);
$events = $args['events'];
$column_size = $args['column-size'];


if (null != $events) {
    foreach ($events as $key => $event) {
        $event_permalink = get_permalink($event->ID);

        if (!is_unlisted_event($event->ID)) {
            $location_main = wp_get_post_terms($event->ID, MITCNC_Theme\Enums\EventTaxonomy::LOCATION)[0] ?? null;
            $event_type = wp_get_post_terms($event->ID, MITCNC_Theme\Enums\EventTaxonomy::CATEGORY)[0] ?? null;
            $start_on = get_post_meta($event->ID, 'date_time_date_time_start', true);
            $end_on = get_post_meta($event->ID, 'date_time_date_time_end', true);
            $start_on_date = date('D, M j', strtotime($start_on));
            $end_on_date = date('D, M j', strtotime($end_on));
            $start_on_time = date('g:i a', strtotime($start_on));
            $end_on_time = date('g:i a', strtotime($end_on));
            $event_address = get_field('location_address', $event->ID);
            $event_address_1 = get_field('location_address_1', $event->ID);
            $event_address_2 = get_field('location_address_2', $event->ID);
            $event_address_city = get_field('location_city', $event->ID);
            $event_address_state = get_field('location_state', $event->ID);
            $event_address_postal_code = get_field('location_postal_code', $event->ID);
            $banner_background_color = get_field('banner_background_color', $event->ID);
            $sold_out_flag = get_field('sold_out', $event->ID);
            ?>
        <div class="col-xl-<?php echo esc_attr($column_size); ?> col-lg-8 col-md-12 col-sm-12">
            <div class="card-box m-sm-1">
            <h6 class="mt0">
                <?php if (!empty($location_main)) { ?>
                    <?php echo esc_html($location_main->name); ?>
                <?php } ?>
            </h6>

        <a href="<?php echo esc_url($event_permalink); ?>" class="card-img"
           style="<?php echo !empty($banner_background_color) ? 'background-color:' . esc_attr($banner_background_color) : 'background-color:#A31F34'; ?>">
            <img src="<?php echo esc_url(get_event_image_uri($event)); ?>"
                 alt="">
            <?php if (!empty($event_type)) { ?>
                <span class="tag"
                      style="background-color: <?php echo esc_attr(get_field('color_type', MITCNC_Theme\Enums\EventTaxonomy::CATEGORY . '_' . $event_type->term_id)); ?>"><?php echo esc_html($event_type->name); ?></span>
                </a>
                <div class="card-details">
                    <h3>
                        <a href="<?php echo esc_url($event_permalink); ?>"><?php echo filter_var($event->post_title, FILTER_UNSAFE_RAW); ?></a>
                    </h3>
                </div>
                <span class="datebox">
                        <span class="date"><?php echo esc_html($start_on_date); ?> / <?php echo esc_html($start_on_time); ?> PT</span>
                    </span>
                <?php if (!empty($event_address_1) || !empty($event_address_2)) { ?>
                    <span class="location-box">
                            <span class="address">
                                <?php if (!empty($event_address)) { ?>
                                    <h6><?php echo esc_html($event_address); ?></h6>
                                <?php } ?>
                                <?php if (!empty($event_address_1)) { ?>
                                    <p><?php echo esc_html($event_address_1); ?></p>
                                <?php } ?>
                                <?php if (!empty($event_address_2)) { ?>
                                    <p><?php echo esc_html($event_address_2); ?></p>
                                <?php } ?>
                                <?php
                                if (
                                    isset($event_address_city['label']) ||
                                    !empty($event_address_city['label']) ||
                                    !empty($event_address_state) ||
                                    !empty($event_address_postal_code)
                                ) {
                                    ?>
                                    <p>
                                            <?php
                                            if (isset($event_address_city['label']) && !empty($event_address_city['label'])) {
                                                echo esc_html($event_address_city['label']);
                                            }
                                            if (isset($event_address_city['label']) && !empty($event_address_city['label']) && !empty($event_address_state)) {
                                                echo ', ';
                                            }
                                            if (!empty($event_address_state)) {
                                                echo esc_html($event_address_state);
                                            }
                                            if (!empty($event_address_state) && !empty($event_address_postal_code)) {
                                                echo ', ';
                                            }
                                            if (!empty($event_address_postal_code)) {
                                                echo esc_html($event_address_postal_code);
                                            }
                                            if (
                                                isset($event_address_city['label']) ||
                                                !empty($event_address_city['label']) ||
                                                !empty($event_address_state) ||
                                                !empty($event_address_postal_code)
                                            ) {
                                                echo '<br>';
                                            }
                                            ?>
                                            </p>
                                    <?php
                                }
                                ?>
                            </span>
                        </span>
                <?php } ?>
                <?php
                if (strtotime($end_on) < time() || $sold_out_flag) {
                    $text = 'View Details';
                } else {
                    $text = 'Info and Registration';
                }
                ?>
                <a href="<?php echo esc_url($event_permalink); ?>"
                   class="default-btn mt15 registration-btn"><?php echo esc_html($text); ?> <img
                            src="<?php echo esc_url(get_asset_uri('/images/arrow_right_white.svg')); ?>" alt=""></a>
                </div>
                </div>
                <?php
            }
        }
    }
} else {
    ?>
    <div class="col-md-24">
        <h5 style="font-size: 1.4285714286rem;margin-bottom: 36px;margin-top: 30px;font-weight: normal;">
            No upcoming event found in this section. If you want to subscribe this Calendar for future events,
            <form id="goto_calendar_form" action="<?php echo esc_url(get_permalink(3167)); ?>"
                  style="display: inline;"
                  method="post">
                <input type="hidden"
                       value="<?php echo (isset($_REQUEST['event_location'])) ? filter_var(wp_unslash($_REQUEST['event_location']), FILTER_SANITIZE_STRING) : ''; ?>"
                       name="loc">
                <input type="hidden"
                       value="<?php echo (isset($_REQUEST['event_program'])) ? filter_var(wp_unslash($_REQUEST['event_program']), FILTER_SANITIZE_STRING) : ''; ?>"
                       name="prog">
                <a href="javascript:void(0);" onclick="document.forms['goto_calendar_form'].submit();">click
                    here</a>
            </form>
        </h5>
    </div>
    <?php
}
?>
