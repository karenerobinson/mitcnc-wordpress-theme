<?php
/* Template Name: Events Listing */

get_header();

function parse_filters(string $key): array
{
    $values = array();
    if (
        isset($_REQUEST[$key]) &&
        !empty($_REQUEST[$key]) &&
        $_REQUEST[$key] != 'all' &&
        is_numeric($_REQUEST[$key])
    ) {
        $values[] = sanitize_text_field(wp_unslash($_REQUEST[$key]));
    }

    return $values;
}

$event_category = parse_filters('event_category');
$event_program = parse_filters('event_program');
$event_location = parse_filters('event_location');
$audience = parse_filters('event_audience');
$event_date = isset($_REQUEST['event_date']) && !empty($_REQUEST['event_date']) && $_REQUEST['event_date'] != 'all' ? sanitize_text_field(wp_unslash($_REQUEST['event_date'])) : null;
$is_past = $event_date == 'past';

$upcoming_events = get_events(
// TODO Reactivate this sniff once PHPCS supports PHP 8.x named arguments
// phpcs:ignore Generic.PHP.Syntax.PHPSyntax
    limit: -1,
    event_types: $event_category,
    event_locations: $event_location,
    event_programs: $event_program,
    show_past_events: $is_past,
    date_filter: $event_date,
    event_audience: $audience
);
$event_slider = $is_past ? null : get_slider(10, array('events'))['events'];
$event_loop_cols = 8;
?>
    <section>
        <article class="inner-page upcoming-events">
            <div class="container">
                <div class="row">
                    <div class="col-sm-24">
                        <?php get_breadcrumb(); ?>
                    </div>
                    <div class="col-sm-24 mb20 event-switch desktop-version">
                        <h1 class="heading_8 mt0">Events List</h1>
                    </div>
                    <div class="col-sm-24 mobile-nopad">
                        <?php
                        get_template_part(
                            'template-parts/header',
                            'event-listing',
                            array(
                                'event-slider' => $event_slider,
                                'is-past' => $is_past,)
                        );
                        ?>
                    </div>

                    <div class="col-sm-24">
                        <div class="row card-container">
                            <?php
                            get_template_part(
                                'template-parts/content',
                                'events-loop',
                                array(
                                    'events' => $upcoming_events,
                                    'column-size' => $event_loop_cols,)
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
<?php
get_footer();
