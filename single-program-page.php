<?php

use MITCNC_Theme\Enums;

get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();
        $organizer_ids = get_field('field_organizers');
        $volunteer_ids = get_field('field_volunteers');
        $event_programs = get_field('field_event_programs');
        if (!$event_programs) {
            $event_programs = array();
        }

        // NOTE: The over-use of globals means we cannot use the variable name $upcoming_events.
        //  Doing so results in both template parts rendering past events.
        $current_events = get_events(
            // TODO Reactivate this sniff once PHPCS supports PHP 8.x named arguments
            // phpcs:ignore Generic.PHP.Syntax.PHPSyntax
            limit: 12,
            event_programs: $event_programs,
            date_filter: Enums\DateFilter::NEXT_THREE_MONTHS,
        );
        $past_events = get_events(
            limit: 12,
            event_programs: $event_programs,
            show_past_events: true,
        );
        ?>
        <section>
            <article class="inner-page">
                <div class="container">
                    <div class="row mb15">
                        <div class="col-sm-24">
                            <?php the_title('<h1>', '</h1>'); ?>
                        </div>
                    </div>
                    <div class="row mb15">
                        <div class="col-sm-24">
                            <div class="feature-images-sec">
                                <?php the_post_thumbnail('thumbnail_1079_474'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-24">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-24">
                                <h2>
                                    <a href="<?php echo esc_url(get_permalink(Enums\PageID::GET_INVOLVED)); ?>">
                                        Get Involved
                                    </a>
                                </h2>
                            </div>
                        </div>
                        <?php get_template_part('template-parts/content', 'get-involved-cards'); ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-24">
                            <?php
                            // TODO Add an empty state for when there are no events.
                            get_template_part(
                                'template-parts/content',
                                'upcoming-events',
                                array('events' => $current_events)
                            );
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-24">
                            <?php
                            // TODO Add an empty state for when there are no events.
                            get_template_part(
                                'template-parts/content',
                                'upcoming-events',
                                array('events' => $past_events, 'section_heading' => 'Past Events')
                            );
                            ?>
                        </div>
                    </div>
                    <?php if (!empty($organizer_ids)) { ?>
                        <div class="row">
                            <div class="col-sm-24">
                                <h2>Organizers</h2>
                                <p>Here are the track leads responsible for this track's programming.</p>
                                <?php
                                get_template_part('template-parts/content', 'speaker-container', array('speaker_ids' => $organizer_ids));
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($volunteer_ids)) { ?>
                        <div class="row">
                            <div class="col-sm-24">
                                <h2>Volunteers</h2>
                                <p>Here are the volunteers that make this track a success.</p>
                                <?php
                                get_template_part('template-parts/content', 'speaker-container', array('speaker_ids' => $volunteer_ids));
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="volunteer">
                        <?php
                        // TODO Add speaker cards for past presenters.
                        //      This can be hard-coded or pulled from tagged events.
                        get_template_part('template-parts/content', 'join-footer');
                        ?>
                    </div>
                </div>
            </article>
        </section>
        <?php
    }
} else {
    echo 'Sorry, no pages matched your criteria.';
}

get_footer();
?>
