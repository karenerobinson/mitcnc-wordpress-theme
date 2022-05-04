<?php

use MITCNC_Theme\Enums;

$defaults = array
(
    'event-slider' => null,
    'is-past' => false,
);

$args = wp_parse_args($args, $defaults);
$event_slider = $args['event-slider'];
$is_past = $args['is-past'];

$event_categories = get_terms(
    Enums\EventTaxonomy::CATEGORY,
    array(
        'hide_empty' => false,
        'order' => 'DESC'
    )
);
$event_locations = get_terms(
    Enums\EventTaxonomy::LOCATION,
    array(
        'hide_empty' => false
    )
);
$event_programs = get_terms(
    Enums\EventTaxonomy::PROGRAM,
    array(
        'hide_empty' => false
    )
);
$event_audience = get_terms(
    Enums\EventTaxonomy::AUDIENCE,
    array(
        'hide_empty' => false
    )
);

$date_filters = array(
    array(
        'label' => '(Any)',
        'value' => 'all',
    ),
    array(
        'label' => 'Today',
        'value' => Enums\DateFilter::TODAY,
    ),
    array(
        'label' => 'Tomorrow',
        'value' => Enums\DateFilter::TOMORROW,
    ),
    array(
        'label' => 'This Week',
        'value' => Enums\DateFilter::THIS_WEEK,
    ),
    array(
        'label' => 'This Weekend',
        'value' => Enums\DateFilter::THIS_WEEKEND,
    ),
    array(
        'label' => 'This Month',
        'value' => Enums\DateFilter::THIS_MONTH,
    ),
    array(
        'label' => 'Next Month',
        'value' => Enums\DateFilter::NEXT_MONTH,
    ),
    array(
        'label' => 'Next Three Months',
        'value' => Enums\DateFilter::NEXT_THREE_MONTHS,
    ),
    array(
        'label' => 'Past',
        'value' => Enums\DateFilter::PAST,
    ),
);

if (!$is_past && $event_slider != null) {
    ?>
    <div class="row">
        <div class="col-sm-24">
            <div class="upcoming-events-banner">
                <?php
                foreach ($event_slider as $slide) {
                    $slide_img = get_the_post_thumbnail_url($slide->ID, 'thumbnail_1079_474');
                    $has_image = !empty($slide_img);
                    $event_slider_categories = wp_get_post_terms($slide->ID, Enums\EventTaxonomy::CATEGORY);
                    $event_location = wp_get_post_terms($slide->ID, Enums\EventTaxonomy::LOCATION);
                    $start_on = get_field('date_time_date_time_start', $slide->ID);

                    $date_and_location = date('D, M j', strtotime($start_on));
                    if ($event_location != null) {
                        $date_and_location .= ' - ' . $event_location[0]->name;
                    }
                    ?>
                    <div class="event-slides <?php echo ($has_image) ? '' : 'no-img'; ?>">
                        <?php if ($has_image) { ?>
                            <img src="<?php echo esc_attr($slide_img); ?>" alt="">
                        <?php } ?>
                        <a href="<?php echo esc_attr(get_permalink($slide->ID)); ?>"
                           class="event-info <?php echo (($has_image)) ? 'mit-event' : ''; ?>">
                            <?php if ($event_slider_categories != null) { ?>
                                <div class="event-tag">
                                    <?php echo esc_html($event_slider_categories[0]->name); ?>
                                </div>
                            <?php } ?>
                            <div class="event-title">
                                <?php echo esc_html($slide->post_title); ?>
                            </div>
                            <div class="event-date-loc">
                                <?php echo esc_html($date_and_location); ?>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="upcoming-event-nav">
                <?php
                foreach ($event_slider as $slide) {
                    $slide_img = get_image_by_post_id($slide->ID, 'thumbnail_111_104');
                    ?>
                    <div class="event-slides">
                        <div class="img-part">
                            <img src="<?php echo esc_attr($slide_img); ?>" alt="">
                        </div>
                        <div class="content-part">
                            <span><?php echo esc_html(date('D, M d, Y', strtotime($slide->post_date))); ?></span>
                            <p><?php echo wp_kses(limit_words($slide->post_title, 6), allowed_html()); ?></p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>

<div class="row">
    <div class="col-sm-24">
        <div id="locations--list" class="locations--list">
            <ul>
                <li class="<?php echo (isset($_REQUEST['event_location']) && $_REQUEST['event_location'] == 'all') ? 'active' : ''; ?>">
                    <a href="javascript:void(0);" data-value="all">All</a>
                    <?php
                    if ($event_locations != null) {
                        foreach ($event_locations as $event_location) {
                            $is_selected = isset($_REQUEST['event_location']) && $_REQUEST['event_location'] == $event_location->term_id;
                            ?>
                <li class="<?php echo $is_selected ? 'active' : ''; ?>">
                    <a href="javascript:void(0);"
                       data-value="<?php echo esc_attr($event_location->term_id); ?>">
                            <?php echo esc_html($event_location->name); ?>
                    </a>
                </li>
                            <?php
                        }
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-24">
        <div class="event-filter">
            <form id="event_filters_form"
                  action="<?php echo esc_attr(get_permalink(Enums\PageID::EVENT_LISTING) . ($is_past ? '?is_past=1' : '')); ?>"
                  method="post">
                <ul>
                    <li style="display: none;">
                        <label>By Category</label>
                        <select name="event_category" onchange="this.form.submit();">
                            <option></option>
                            <option value="all" <?php echo (isset($_REQUEST['event_category']) && $_REQUEST['event_category'] == 'all') ? 'selected' : ''; ?>>
                                All
                            </option>
                            <?php
                            if ($event_categories != null) {
                                foreach ($event_categories as $event_category) {
                                    $is_selected = isset($_REQUEST['event_category']) && $_REQUEST['event_category'] == $event_category->term_id;
                                    ?>
                                    <option
                                            value="<?php echo esc_attr($event_category->term_id); ?>" <?php echo $is_selected ? 'selected' : ''; ?>>
                                        <?php echo esc_html($event_category->name); ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </li>
                    <li>
                        <label>By Programs</label>
                        <select name="event_program" onchange="this.form.submit();">
                            <option></option>
                            <option value="all" <?php echo (isset($_REQUEST['event_program']) && $_REQUEST['event_program'] == 'all') ? 'selected' : ''; ?>>
                                All
                            </option>
                            <?php
                            if ($event_programs != null) {
                                foreach ($event_programs as $event_program) {
                                    $is_selected = isset($_REQUEST['event_program']) && $_REQUEST['event_program'] == $event_program->term_id;
                                    ?>
                                    <option value="<?php echo esc_attr($event_program->term_id); ?>" <?php echo $is_selected ? 'selected' : ''; ?>>
                                        <?php echo esc_html($event_program->name); ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </li>
                    <li>
                        <label>By Date</label>
                        <select name="event_date" onchange="this.form.submit();">
                            <option value=""></option>
                            <?php
                            foreach ($date_filters as $date_filter) {
                                $value = $date_filter['value'];
                                $label = $date_filter['label'];
                                $is_selected = isset($_REQUEST['event_date']) && $_REQUEST['event_date'] == $value;
                                ?>
                                <option value="<?php echo esc_attr($value); ?>" <?php echo $is_selected ? 'selected' : ''; ?>>
                                    <?php echo esc_html($label); ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </li>
                    <li style="display: none;">
                        <label>By Location</label>
                        <select name="event_location" onchange="this.form.submit();">
                            <option value=""></option>
                            <option value="all" <?php echo (isset($_REQUEST['event_location']) && $_REQUEST['event_location'] == 'all') ? 'selected' : ''; ?>>
                                All
                            </option>
                            <?php
                            if ($event_locations != null) {
                                foreach ($event_locations as $event_location) {
                                    $is_selected = isset($_REQUEST['event_location']) && $_REQUEST['event_location'] == $event_location->term_id;
                                    ?>
                                    <option value="<?php echo esc_attr($event_location->term_id); ?>" <?php echo $is_selected ? 'selected' : ''; ?>>
                                        <?php echo esc_html($event_location->name); ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </li>
                    <li style="display: none;">
                        <label>By Audience</label>
                        <select name="event_audience" onchange="this.form.submit();">
                            <option value=""></option>
                            <option value="all" <?php echo (isset($_REQUEST['event_audience']) && $_REQUEST['event_audience'] == 'all') ? 'selected' : ''; ?>>
                                All
                            </option>
                            <?php
                            if ($event_audience != null) {
                                foreach ($event_audience as $audience) {
                                    $is_selected = isset($_REQUEST['event_audience']) && $_REQUEST['event_audience'] == $audience->term_id;
                                    ?>
                                    <option value="<?php echo esc_attr($audience->term_id); ?>" <?php echo $is_selected ? 'selected' : ''; ?>>
                                        <?php echo esc_html($audience->name); ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
