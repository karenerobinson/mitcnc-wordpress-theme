<?php
    /* Template Name: Calendar */
    get_header();
    global $assets_uri, $post, $event_location_taxonomy, $event_program_taxonomy;
    $event_locations = get_terms(
        $event_location_taxonomy,
        array('hide_empty' => false)
    );
    $event_programs = get_terms(
        $event_program_taxonomy,
        array('hide_empty' => false)
    );
    $loc = (isset($_REQUEST['loc'])) ? filter_var(wp_unslash($_REQUEST['loc']), FILTER_SANITIZE_NUMBER_INT) : '';
    $prog = (isset($_REQUEST['prog'])) ? filter_var(wp_unslash($_REQUEST['prog']), FILTER_SANITIZE_NUMBER_INT) : '';
    $url = home_url('add-to-calendar') . '?loc=' . $loc . '&prog=' . $prog . '&noCache';
    ?>
    <section>
        <article class="inner-page upcoming-events">
            <div class="container">
                <div class="row">
                    <div class="col-sm-24">
                        <?php get_breadcrumb(); ?>
                    </div>
                    <div class="col-sm-24 mb20 event-switch desktop-version">
                        <h1 class="heading_8 mt0">Calendar Subscription</h1>
                    </div>
                    <div class="col-sm-24 mobile-nopad">
                        <p>A Calendar Subscription is a calendar that you can view online or download and view on your PC, Mac or handheld device. Calendar Subscriptions are updated automatically.</p>
                        <p>To set up a Calendar Subscription to MITCNC events updates by geographic area, tracks or all events, select from the options below, copy the link and add it your calendar.</p>
                        <div class="step-block step--1" id="step--1">
                            <h3>Step 1</h3>
                            <p>Please choose one of the following event calendar you would like to subscribe to:</p>
                            <h2>All MITCNC Events</h2>
                            <ul class="calendar-btns-list" style="margin-bottom: 36px; margin-top: 30px;">
                                <li>
                                    <a href="javascript:void(0);" class="btn--location calendar-btn" data-id="">
                                        All Events
                                    </a>
                                </li>
                            </ul>
                            <?php if ($event_locations != null) { ?>
                                <h2>By Geo Location</h2>
                                <ul class="calendar-btns-list">
                                    <?php foreach ($event_locations as $key => $location) { ?>
                                        <li>
                                            <a href="javascript:void(0);" class="btn--location calendar-btn <?php echo ($loc == $location->term_id) ? 'active' : ''; ?>" data-id="<?php echo esc_attr($location->term_id); ?>">
                                                <?php echo esc_html($location->name); ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                            <?php if ($event_programs != null) { ?>
                                <h2>By Programs</h2>
                                <ul class="calendar-btns-list">
                                    <?php foreach ($event_programs as $key => $program) { ?>
                                        <li>
                                            <a href="javascript:void(0);" class="btn--program calendar-btn <?php echo ($prog == $program->term_id) ? 'active' : ''; ?>" data-id="<?php echo esc_attr($program->term_id); ?>">
                                                <?php echo esc_html($program->name); ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </div>
                        <div class="step-block step--2" id="step--2" style="padding-bottom: 100px; <?php echo (empty($loc) && empty($prog)) ? 'display: none;' : ''; ?>">
                            <h3>Step 2</h3>
<!--                            <p>In order to get event updates for a specific region or program, select from the options above, copy the link and add it your calendar.</p>-->
                            <p>Please copy the URL</p>

                            <div class="input-link">
                                <input type="text" id="add_to_calendar_url" value="<?php echo esc_url($url); ?>">
                                <a href="javascript:void(0);" id="copy_the_url">Copy</a>
                            </div>
                            <div id="alert--no-events" style="color: #d31f35;padding-left: 25px;padding-top: 5px;font-size: 18px;"></div>

                        </div>

                        <div class="step-block step--3" id="step--3" style="<?php echo (empty($loc) && empty($prog)) ? 'display: none;' : ''; ?>">
                            <h3>Step 3</h3>
                            <h2 class="no-border">Select your calendar program</h2>

                            <ul class="calendar-btns-list tabs-list">
                                <li>
                                    <a href="javascript:void(0);" id="tab-1" class="active calendar-btn no-icon">
                                        Apple iCal
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" id="tab-2" class="calendar-btn no-icon">
                                        Microsoft Outlook
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" id="tab-3" class="calendar-btn no-icon">
                                        Google Calendar
                                    </a>
                                </li>
                                <!--<li>
                                    <a href="javascript:void(0);" id="tab-4" class="calendar-btn no-icon">
                                        Lotus Notes
                                    </a>
                                </li>-->
                            </ul>

                            <div class="tabs-data">
                                <div class="single-tab tab-1">
                                    <p>To subscribe to an iCalendar feed using Apple's iCal program:</p>
                                    <ol>
                                        <li>Open the Calendar program (in Applications)</li>
                                        <li>From the Calendar menu select <strong>File - New Calendar
                                                Subscription</strong></li>
                                        <li>Type or paste the calendar URL copied from the <a href="#">list of
                                                countries</a> into the Calendar URL field then click Subscribe
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/calendar/tab-img-1.jpg" alt="">
                                        </li>
                                        <li style="margin-top: 30px">
                                            If you want, you can change the calendar name and colour and change the
                                            <strong>Auto-refresh</strong> frequency to <strong>Every day</strong><br>from
                                            <strong>Every week</strong>, then click OK.
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/calendar/tab-img-2.jpg" alt="">
                                        </li>
                                        <li style="margin-top: 30px">
                                            The events should now appear in your calendar
                                        </li>
                                    </ol>
                                </div>
                                <div class="single-tab tab-2" style="display: none;">
                                    <p>To subscribe to an iCalendar feed using Outlook:</p>
                                    <ol>
                                        <li>In the Outlook calendar view, click on the Add menu and select <strong>From Internet</strong> from the drop down menu</li>
                                        <li>Click the <strong>New</strong> button</li>
                                        <li>Type or paste one of the calendar URLs above then click <strong>OK</strong>
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/calendar/tab-img-3.jpg" alt="">
                                        </li>
                                        <li style="margin-top: 30px;">
                                            To add the calendar with default settings, click <strong>Yes</strong> on the next dialog. If you wish to edit the setting, click
                                            <strong>'Advanced'</strong><br>and go to step 6
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/calendar/tab-img-4.jpg" alt="">
                                        </li>
                                        <li style="margin-top: 30px;">
                                            In the Advanced dialog box, you can optionally rename the calendar.  Ensure the box is checked in the Update<br>Limit section.
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/calendar/tab-img-5.jpg" alt="">
                                        </li>
                                    </ol>
                                </div>
                                <div class="single-tab tab-3" style="display: none;">
                                    <p>To subscribe to an iCalendar feed using Outlook:</p>
                                    <ol>
                                        <li>In the left column, click on the <strong>down arrow to the left</strong> in the
                                            <strong>Other Calendars</strong> section.
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/calendar/tab-img-6a.jpg" alt="">
                                        </li>
                                        <li style="margin-top: 30px;">
                                            From the menu select <strong>Add by URL.</strong>
                                        </li>
                                        <li>
                                            Enter the feed URL in the dialog box then click <strong>Add
                                                Calendar.</strong>
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/calendar/tab-img-7.jpg" alt="">
                                        </li>
                                        <li style="margin-top: 30px;">
                                            NB. You cannot set how often the calendar refreshes.
                                        </li>
                                    </ol>
                                </div>
                                <div class="single-tab tab-4" style="display: none;">
                                    <p>To subscribe to an iCalendar feed using Lotus Notes:</p>
                                    <ol>
                                        <li>In the <strong>calendar view</strong>, on the left side under the views section, click
                                            <strong>Add a Calendar</strong>'
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/calendar/tab-img-8.jpg" alt="">
                                        </li>
                                        <li style="margin-top: 30px;">
                                            From the add drop down choose <strong>'iCalendar feed'</strong> and select the
                                            <strong>'A public calendar'</strong> option.
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/calendar/tab-img-9.jpg" alt="">
                                        </li>
                                        <li style="margin-top: 30px;">
                                            paste the link to the calendar in the <strong>URL field</strong>
                                        </li>
                                        <li>Change the <strong>Label (name) and colours</strong> as required.</li>
                                        <li>Click <strong>'OK'</strong></li>
                                    </ol>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </article>
    </section>
<?php get_footer(); ?>
