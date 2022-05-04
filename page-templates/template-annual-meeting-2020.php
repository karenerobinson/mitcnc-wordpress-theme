<?php
    /* Template Name: MITCNC 2020 Annual Meeting*/
    get_header();
    global $assets_uri, $event_category_taxonomy, $event_location_taxonomy, $user_profile_page_id, $specific_event;
    $postObject = get_post(2501);
if (isset($postObject->ID)) {
    $meta_data = get_post_meta($postObject->ID);
    $banner = get_the_post_thumbnail_url($postObject->ID, 'thumbnail_1079_474');
    $event_type = wp_get_post_terms($postObject->ID, $event_category_taxonomy);
    $event_location = wp_get_post_terms($postObject->ID, $event_location_taxonomy);
    $start_on = (isset($meta_data['date_time_date_time_start'][0])) ? $meta_data['date_time_date_time_start'][0] : '';
    $end_on = (isset($meta_data['date_time_date_time_end'][0])) ? $meta_data['date_time_date_time_end'][0] : '';
    $start_on_date = date('l, F d, Y', strtotime($start_on));
    $end_on_date = date('l, F d, Y', strtotime($end_on));
    $start_on_time = date('h:i A', strtotime($start_on));
    $end_on_time = date('h:i A', strtotime($end_on));
    $upcoming_events = get_events(
        10,
        null,
        null,
        null,
        array($postObject->ID)
    );

    $reservation_link = (isset($meta_data['reservation_link'][0])) ? $meta_data['reservation_link'][0] : '';
    $event_address = (isset($meta_data['location_address'][0])) ? $meta_data['location_address'][0] : '';
    $event_address_1 = (isset($meta_data['location_address_1'][0])) ? $meta_data['location_address_1'][0] : '';
    $event_address_2 = (isset($meta_data['location_address_2'][0])) ? $meta_data['location_address_2'][0] : '';
    $event_address_city = get_field('location_city', $postObject->ID);
    $event_address_state = get_field('location_state', $postObject->ID);
    $event_address_postal_code = (isset($meta_data['location_postal_code'][0])) ? $meta_data['location_postal_code'][0] : '';
    $event_map = (isset($meta_data['location_location_map'][0])) ? $meta_data['location_location_map'][0] : '';
    $primary_contact = array(
        'name' => (isset($meta_data['contact_persons_contact_persons_primary_contact_persons_primary_name'][0])) ? $meta_data['contact_persons_contact_persons_primary_contact_persons_primary_name'][0] : '',
        'email' => (isset($meta_data['contact_persons_contact_persons_primary_contact_persons_primary_email'][0])) ? $meta_data['contact_persons_contact_persons_primary_contact_persons_primary_email'][0] : '',
    );
    $secondary_contact = array(
        'name' => (isset($meta_data['contact_persons_contact_persons_secondary_contact_persons_secondary_name'][0])) ? $meta_data['contact_persons_contact_persons_secondary_contact_persons_secondary_name'][0] : '',
        'email' => (isset($meta_data['contact_persons_contact_persons_secondary_contact_persons_secondary_email'][0])) ? $meta_data['contact_persons_contact_persons_secondary_contact_persons_secondary_email'][0] : '',
    );
    $mit_registration = array(
        'link' => (isset($meta_data['registration_2_mit_link'][0])) ? $meta_data['registration_2_mit_link'][0] : '',
        'details' => array(),
    );
    $non_mit_registration = array(
        'link' => (isset($meta_data['registration_2_non_mit'][0])) ? $meta_data['registration_2_non_mit'][0] : '',
        'details' => array(),
        'embed_widget' => (isset($meta_data['registration_2_non_mit_embed_widget'][0])) ? $meta_data['registration_2_non_mit_embed_widget'][0] : '',
    );
    //    $client_info = file_get_contents('https://geoip.nekudo.com/api');
    //    $client_info = !empty($client_info) ? json_decode($client_info) : null;
    $sold_out_flag = (isset($meta_data['sold_out'][0])) ? $meta_data['sold_out'][0] : false;
    $banner_color = (isset($meta_data['banner_background_color'][0])) ? $meta_data['banner_background_color'][0] : '';
    $specific_event = true;

    ?>

        <style>
            h2:after {
                background-color: #ff8a00;
            }
        </style>


        <section class="single-events postid-2501">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article class="inner-page event-banner-section">
                    <div class="container event-banner-container">
                        <div class="row">
                            <div class="col-sm-24 evb-col">
                                <div class="event-banner custom-event-banner annual-meeting-banner" style="background-image:url(<?php echo esc_url($assets_uri); ?>/images/awards2020-header.jpg)">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container">
                        <div class="col-sm-14">
                            <h2 class="yellow">Main Session</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                <div class="timeline-agenda">
                                    <ul class="timeline-agenda-list">
                                        <li class="aglist">
                                            <h4 class="date">1:00 PM - 2:00 PM</h4>
                                            <p class="meeting-title">Club status, board elections, plans for 2020</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/83118112318" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">2:00 PM - 3:00 PM</h4>
                                            <p class="meeting-title">Q&A about joining other rooms</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/83118112318" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-14">
                            <h2 class="yellow">Children's & Family Room</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                <div class="timeline-agenda">
                                    <ul class="timeline-agenda-list">
                                        <li class="aglist">
                                            <h4 class="date">1:00 PM - 2:00 PM</h4>
                                            <p class="meeting-title">Make satellite paper models with Anna Porter '95</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/87897134659" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>

                                            <p class="meeting-description">Join alum Anna Porter, a satellite mechanisms engineer, for a children's or adult's satellite paper model making tutorial.<br><br>
                                                Prior to the session: <br>
                                                <span style="margin-left:2em">1.     Print out the template found <a href="https://drive.google.com/file/d/1ApXPG6vKaf8RdDbtnbf_7_jaiKssQWOw/view?usp=sharing">here</a> on cardstock (or paper, if cardstock not available) <br></span>
                                                <span style="margin-left:2em">2.     Gather supplies: <br></span>
                                                <div style="margin-left:4em; margin-top: -1em;">
                                                    a.     Scissors <br>
                                                    b.     Clear tape <br>
                                                    c.     8 large paper clips <br>
                                                    d.     X-Acto knife (optional) <br>
                                                    e.     Glue stick (optional) <br>
                                                </div>
                                            </p>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">2:00 PM - 2:20 PM</h4>
                                            <p class="meeting-title">Kids Session with PBS Design Squad host Nate Ball '05</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/87897134659" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>
                                        </li>
                                        
                                        <li class="aglist">
                                            <h4 class="date">2:20 PM - 3:00 PM</h4>
                                            <p class="meeting-title">Virtual Board Game: Jackbox with Katia Paramonova '13</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/87897134659" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>

                                            <p class="meeting-description">Miss those Boggle and Pictionary game nights? The giggles from pin the tail on the donkey? Join us for JackBox games with simple and funny games to play with up to 8 people (and additional audience members). The game screen will be shared via Zoom and all you will need is your phone to participate! When we start the game, we will share the game code for you to enter into Jackbox's website to use your phone as your game control. <strong>Everyone will need a phone to participate.</strong></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-14">
                            <h2 class="yellow">Tech & Startup Room</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                <div class="timeline-agenda">
                                    <ul class="timeline-agenda-list">
                                        <li class="aglist">
                                            <h4 class="date">2:00 PM - 2:20 PM</h4>
                                            <p class="meeting-title">Club tech stack brainstorming, led by Clinton Blackburn '08</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/83118112318" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>
                                            <div class="container">
                                                <p class="meeting-description">Have comments on the website we've developed, mitcnc.org?  Are you as excited as we are about signing in to the website (and events) being easier?  Come talk about what fuels our tech stack and what could make it even better.</p>
                                            </div>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">2:20 PM - 2:40 PM</h4>
                                            <p class="meeting-title">Tech Track Brainstorming, led by Teddy Lee MBA '17</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/89283673013" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>

                                            <p class="meeting-description">Come talk about the recent AI Conference, meet other alums in tech, and think about what topics are really interesting in tech right now.</p>
                                        </li>
                                        
                                        <li class="aglist">
                                            <h4 class="date">2:40 PM - 3:00 PM</h4>
                                            <p class="meeting-title">Startup Track Brainstorming, led by Anvisha Pai '14 & Bruno Faviero '15</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/89283673013" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>   

                                            <p class="meeting-description">Our startup track is on fire with ideas - a forum for asking & answering questions easily, ways to meet other alums in startup life.  Come meet other startup alums and talk about startup life in the bay area!</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-14">
                            <h2 class="yellow">Product & Podcast Room</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                <div class="timeline-agenda">
                                    <ul class="timeline-agenda-list">
                                        <li class="aglist">
                                            <h4 class="date">2:00 PM - 2:20 PM</h4>
                                            <p class="meeting-title">Product Management Chat, led by Alekhya Reddy '16</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/83118112318" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>

                                            <p class="meeting-description">Informal chat for product managers.  What's important for a PM in the bay area to know?  What was your path to becoming a PM?  Meet other MIT PMs over these topics, in our initial PM chat!</p>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">2:20 PM - 2:40 PM</h4>
                                            <p class="meeting-title">Catalyst Podcast Discussion, led by Irena Fischer-Hwang '11 & Julia Yoo '10</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/83118112318" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>

                                            <p class="meeting-description">What are your favorite MIT-alum success stories, that would make good feature interviews for our podcast, Catalyst?  Tell us what inspires you or what stories can be a model for other alums.</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-14">
                            <h2 class="yellow">Professional Track Room</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                <div class="timeline-agenda">
                                    <ul class="timeline-agenda-list">
                                        <li class="aglist">
                                            <h4 class="date">2:00 PM - 2:20 PM</h4>
                                            <p class="meeting-title">Health & Life Sciences Track Info & Discussion, led by<br> Shannon Dahl '99, Afsana Akhter '98, and Christian Ulstrup MBA '19</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/86955408396" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>

                                            <p class="meeting-description">What are the most interesting topics in Health & Life Sciences right now?  Is covid crowding out other work and life science news?</p>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">2:20 PM - 2:40 PM</h4>
                                            <p class="meeting-title">Energy & Environment Track Info & Discussion, led by Doug Spreng '650</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/86955408396" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>
                                            
                                            <p class="meeting-description">What are the most interesting topics in Energy & Environment right now?  Join us as we seize the current opportunity to virtually feature high-level speakers who would otherwise be hard to schedule.</p>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">2:40 PM - 3:00 PM</h4>
                                            <p class="meeting-title">FinTech & Finance Brainstorming & Discussion, led by Jason Escamilla MBA '02</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a style="margin-left:0;" href="https://mitcnc-org.zoom.us/j/86955408396" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>

                                            <p class="meeting-description">What's most interesting right now in finance and fintech?</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-14">
                            <h2 class="yellow">Impact & Engaging through Learning Room</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                <div class="timeline-agenda">
                                    <ul class="timeline-agenda-list">
                                        <li class="aglist">
                                            <h4 class="date">2:00 PM - 2:20 PM</h4>
                                            <p class="meeting-title">K-12 Track with Wilson Tsang '89 and Katharine Xiao '16</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/87573494539" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>

                                            <p class="meeting-description">Discuss club initiatives around mentoring students, volunteering for K-12 programs, and events and programming for families with K-12 kids</p>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">2:20 PM - 2:40 PM</h4>
                                            <p class="meeting-title">Book Recommendations and Book Club Brainstorming, with Li Sun MNG '09</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/87573494539" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>

                                            <p class="meeting-description">So far we've discussed Michelle Obama's Becoming and Stanley McChrystal's Team of Teams (with a fireside chat with the author!)  Help us replicate those successes - come ready to say what you've loved about a few favorite books.</p>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">2:40 PM - 3:00 PM</h4>
                                            <p class="meeting-title">Lifelong Learning brainstorming, with Wendi Zhang '09</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/87573494539" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>

                                            <p class="meeting-description">Do you want to see lightning talks by club members?  More skill-share opportunities?  Small-group intense sessions on a topic not related to your field?  Come share ideas on what to learn.
                                            Do you want to see lightning talks by club members?  More skill-share opportunities?  Small-group intense sessions on a topic not related to your field?  Come share ideas on what to learn.</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-14">
                            <h2 class="yellow">Social & Cross-Cutting Room</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                <div class="timeline-agenda">
                                    <ul class="timeline-agenda-list">
                                        <li class="aglist">
                                            <h4 class="date">2:00 PM - 2:20 PM</h4>
                                            <p class="meeting-title">Women's Track, led by Patricia Liu '95</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/85748705055" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>

                                            <p class="meeting-description">The women's track is about informal women's events, and about women coming together to put on great panels & events.  Come add your energy, and learn more!</p>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">2:20 PM - 2:40 PM</h4>
                                            <p class="meeting-title">Social Track, led by Patricia Liu  '95</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/85748705055" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>

                                            <p class="meeting-description">Our Social track has hosted virtual events from exercise to learning about cooking.  It's a big change from our usual focus on large in-person events - come talk about plans & ideas for virtual events over the next year.</p>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">3:00 PM - 3:30 PM</h4>
                                            <p class="meeting-title">Post-event</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/85748705055" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>

                                            <p class="meeting-description">Informal non-bay geography chat: North Bay, Far-north California, Sacramento/Davis, Santa Cruz, hosted by Patricia Liu</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-14">
                            <h2 class="yellow">Skillshare Room</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                <div class="timeline-agenda">
                                    <ul class="timeline-agenda-list">
                                        <li class="aglist">
                                            <h4 class="date">2:00 PM - 2:20 PM</h4>
                                            <p class="meeting-title">Intro to Cryptography with Raymond Cheng '09</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/81580997630" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">2:20 PM - 2:40 PM</h4>
                                            <p class="meeting-title">Intro to Beatboxing with Arun Saigal '13</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/81580997630" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>
                                        </li>
                                        <li class="aglist">
                                            <h4 class="date">2:40 PM - 3:00 PM</h4>
                                            <p class="meeting-title">Intro to Beatboxing with Arun Saigal '13</p>

                                            <ul class="join-annual-meeting">
                                                <li class="join-now-field">
                                                    <a href="https://mitcnc-org.zoom.us/j/81580997630" class="session-join-btn agenda-session-join-btn default-btn watch">
                                                        Join Now
                                                    </a>
                                                <li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="container">
                        <div class="link-banner">
                            <a href="https://www.mitcnc.org/events/spotlight-2019/" target="_blank">
                                <img src="<?php echo esc_url($assets_uri); ?>/images/spotlight-ticket-banner.png" class="logos-images img-responsive" alt="" style="width:100%" >
                            </a>
                        </div> 
                    </div>
                    
                    <div class="container">
                        <?php
                        if (
                            (
                                (isset($mit_registration['link']) && !empty($mit_registration['link'])) ||
                                (
                                    (
                                        isset($non_mit_registration['embed_widget']) && !empty($non_mit_registration['embed_widget'])
                                    ) ||
                                    !empty($ticket_link_non_mit)
                                )
                            ) &&
                            (strtotime($end_on) >= time() && !$sold_out_flag)
                        ) {
                            ?>
                            <div id="section--registration"></div>
                            <!--<hr class="mb60 mt60">-->
                            <div class="row">
                                <div class="col-sm-24 mb30 mt50">
                                    <h2>Registration</h2>
                                </div>
                            </div>
                            <div class="row mb60">
                                <?php
                                if (!empty($mit_registration['link'])) {
                                    ?>
                                    <div class="col-sm-16">
                                        <div class="registration-box">
                                            <h4 class="red-text x-large-text">
                                                <i>
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/logo-mit-only.svg"
                                                         width="50px" alt="MIT Alums">
                                                </i>
                                                ALUMS
                                            </h4>
                                            <?php
                                            if (null != $ticket_registration) {
                                                foreach ($ticket_registration as $tickets) {
                                                    $meta = $tickets['description'];
                                                    if (null != $meta) {
                                                        foreach ($meta as $details) {
                                                            if (
                                                                strtotime(date('Y-m-d 00:00:00', strtotime($details['date_start']))) <= time() &&
                                                                strtotime(date('Y-m-d 23:59:59', strtotime($details['date_end']))) >= time()
                                                            ) {
                                                                ?>
                                                                <div class="two-price <?php echo (count($ticket_registration) > 1) ? 'tripple' : ''; ?>">
                                                                    <div class="price red-text"><?php echo esc_html($details['price']); ?></div>
                                                                    <p><?php echo !empty($tickets['title']) ? esc_html($tickets['title']) : 'Please make sure you are a current member of any MIT local club before registering.'; ?></p>
                                                                </div>
                                                                <?php
                                                                break;
                                                            }
                                                        }
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <div class="two-price">
                                                    <div class="price red-text">&nbsp;</div>
                                                    <p>&nbsp;</p>
                                                </div>
                                            <?php } ?>
                                            <a class="default-btn"
                                               href="<?php echo !empty($ticket_link) ? esc_url($ticket_link) : 'javascript:void(0);'; ?>"
                                               class="default-btn">Reserve Now<img
                                                    src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                    alt=""></a>
                                            <p style="color: #555555; font-family: 'Poppins', sans-serif; font-weight: 500; margin: 10px 0 0 0;">Waitlist Tickets (Subject to final confirmation).</p>
                                        </div>
                                    </div>
                                    <?php
                                }
                                if (!empty($non_mit_registration['embed_widget']) || !empty($ticket_link_non_mit)) {
                                    ?>
                                    <div class="col-sm-8">
                                        <div class="registration-box ai-confer-registration">
                                            <h4 class="x-large-text">GENERAL ADMISSION</h4>

                                            <?php
                                            if (null != $ticket_registration_non_mit) {
                                                foreach ($ticket_registration_non_mit as $tickets) {
                                                    $meta = $tickets['description'];
                                                    if (null != $meta) {
                                                        foreach ($meta as $details) {
                                                            if (
                                                                strtotime(date('Y-m-d 00:00:00', strtotime($details['date_start']))) <= time() &&
                                                                strtotime(date('Y-m-d 23:59:59', strtotime($details['date_end']))) >= time()
                                                            ) {
                                                                ?>
                                                                <div class="two-price <?php echo (count($ticket_registration_non_mit) > 1) ? 'double' : ''; ?>">
                                                                    <div class="price red-text"><?php echo esc_html($details['price']); ?></div>
                                                                    <p style="margin-bottom: 3px;"><?php echo !empty($tickets['title']) ? esc_html($tickets['title']) : ''; ?></p>
                                                                </div>
                                                                <?php
                                                                break;
                                                            }
                                                        }
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <div class="two-price">
                                                    <div class="price red-text">&nbsp;</div>
                                                    <p>&nbsp;</p>
                                                </div>
                                                <br>
                                                <br>
                                                <?php
                                            }
                                            if (strtotime($end_on) < time()) {
                                                ?>
                                                <a href="javascript:void(0);" class="default-btn gray-btn">Reservation
                                                    Closed<img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                               alt=""></a>
                                            <?php } else if ($sold_out_flag) { ?>
                                                <a href="javascript:void(0);" class="default-btn gray-btn">Sold Out<img
                                                        src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                        alt=""></a>
                                                <?php
                                            } else {
                                                if (!empty($non_mit_registration['embed_widget'])) {
                                                    ?>
                                                    <style type="text/css">
                                                        .registration-box button {
                                                            min-width: 205px;
                                                            padding: 14px 20px;
                                                            background-color: #30b630;
                                                            border: 1px solid #30b630;
                                                            text-decoration: none;
                                                            text-transform: uppercase;
                                                            text-align: center;
                                                            color: #ffffff;
                                                            display: inline-block;
                                                            position: relative;
                                                            font-size: 1rem;
                                                            letter-spacing: 2px;
                                                            border-radius: 2px;
                                                            width: 100%;
                                                        }
                                                    </style>
                                                    <?php
                                                    echo filter_var($non_mit_registration['embed_widget'], FILTER_UNSAFE_RAW);
                                                } else {
                                                    ?>
                                                    <a class="default-btn"
                                                       href="<?php echo !empty($ticket_link_non_mit) ? esc_url($ticket_link_non_mit) : 'javascript:void(0);'; ?>"
                                                       class="default-btn gray-btn">Reserve Now<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                    <?php
                                                }
                                                ?>
                                            <?php } ?>
                                            <p style="color: #555555; font-family: 'Poppins', sans-serif; font-weight: 500; margin: 10px 0 0 0;">Waitlist Tickets <br>(Subject to final confirmation).</p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="container">
                       <?php get_template_part('template-parts/content', 'upcoming-events'); ?>
                    </div>
                </article>
                        <?php
            endwhile;
        endif;
        ?>
        </section>
        <?php
        get_footer();
}
