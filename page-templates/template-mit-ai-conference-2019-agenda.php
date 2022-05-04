<?php
    /* Template Name: MIT AI Conference 2019 Agenda */
    get_header();
    global $assets_uri, $event_category_taxonomy, $event_location_taxonomy, $user_profile_page_id, $specific_event;
    $post = get_post(2501);
if (isset($post->ID)) {
    $meta_data = get_post_meta($post->ID);
    $banner = get_the_post_thumbnail_url($post->ID, 'thumbnail_1079_474');
    $event_type = wp_get_post_terms($post->ID, $event_category_taxonomy);
    $event_location = wp_get_post_terms($post->ID, $event_location_taxonomy);
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
        array($post->ID)
    );

    $moderators = (isset($meta_data['moderators_list'][0]) && !empty($meta_data['moderators_list'][0])) ? unserialize($meta_data['moderators_list'][0]) : null;
    $moderators_ids = '';
    $moderators_casting = null;
    if (null != $moderators) {
        $moderators_ids = implode(',', $moderators);
        foreach ($moderators as $moderator) {
            $moderators_casting[] = (object) array('ID' => $moderator);
        }
        $moderators = $moderators_casting;
    }

    $reservation_link = (isset($meta_data['reservation_link'][0])) ? $meta_data['reservation_link'][0] : '';
    $event_address = (isset($meta_data['location_address'][0])) ? $meta_data['location_address'][0] : '';
    $event_address_1 = (isset($meta_data['location_address_1'][0])) ? $meta_data['location_address_1'][0] : '';
    $event_address_2 = (isset($meta_data['location_address_2'][0])) ? $meta_data['location_address_2'][0] : '';
    $event_address_city = get_field('location_city', $post->ID);
    $event_address_state = get_field('location_state', $post->ID);
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
    $sold_out_flag = (isset($meta_data['sold_out'][0])) ? $meta_data['sold_out'][0] : false;
    $banner_color = (isset($meta_data['banner_background_color'][0])) ? $meta_data['banner_background_color'][0] : '';
    $specific_event = true;


    $ticket_registration = get_field('registration_2_mit_details', $post->ID);
    $ticket_link = get_field('registration_2_mit_link', $post->ID);
    $ticket_link_non_mit = get_field('registration_2_non_mit_link', $post->ID);
    $ticket_registration_non_mit = get_field('registration_2_non_mit_details', $post->ID);

    $platinum_sponsor = get_field('platinum_sponsor_platinum_details', $post->ID);
    $gold_sponsor = get_field('gold_sponsor_gold_details', $post->ID);

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
                            <?php get_template_part('template-parts/yearly', 'event-links'); ?>
                            <div class="col-sm-24 evb-col">
                                <div class="event-banner custom-event-banner <?php echo !empty($banner) ? '' : 'no-img'; ?>" style="<?php echo !empty($banner) ? 'background-image: url(' . esc_html($banner) . ')' : 'background-color: ' . esc_html($banner_color); ?>">
                                </div>
                                <div class="static-registration-bar">
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <div class="event-name">
                                                <?php echo esc_html($post->post_title); ?>
                                            </div>
                                            <div class="event-date-time">
                                                <?php echo esc_html(date('M d', strtotime($start_on))); ?><?php echo esc_html((isset($event_location[0])) ? ' - ' . $event_location[0]->name : ''); ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 text-right">
                                            <div class="event-reg-btn">
                                                <?php if (strtotime($end_on) < time()) { ?>
                                                    <a href="javascript:void(0);" class="default-btn disabled">Event
                                                        Closed<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                <?php } else if ($sold_out_flag) { ?>
                                                    <a href="javascript:void(0);" class="default-btn disabled">Sold Out<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                <?php } else { ?>
                                                    <?php /* <a href="<?php echo !empty($reservation_link) ? $reservation_link : 'javascript:void(0);'; ?>" class="default-btn">Reserve Now<img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt=""></a> */ ?>
                                                    <a href="#section--registration" class="default-btn">Reserve Now<img
                                                            src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                                            alt=""></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container">
                        
                        <div class="col-sm-14">
                            <h2 class="yellow">
                               Agenda
                            </h2>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                <div class="timeline-agenda">
                                    <ul class="timeline-agenda-list">
                                        <li class="aglist">
                                            <h4 class="date">8:00 AM - 9:00 AM</h4>
                                            <p><img src="<?php echo esc_url($assets_uri); ?>/images/breakfast.svg" alt="">Breakfast</p>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">9:00 AM - 9:15 AM</h4>
                                            <p>Opening Fireside</p>
                                            <ul>
                                                <li>
                                                    <a href="https://www.mitcnc.org/hemanttaneja/" target="_blank">
                                                        <div>
                                                            <img src="https://www.mitcnc.org/app/media/2018/11/Hemant-Taneja.png" alt="">
                                                            <div class="icon-mit">
                                                                <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                            </div>
                                                        </div>
                                                        <span>
                                                            Hemant Taneja
                                                            <span class="company">General Catalyst</span>
                                                            <span class="title">Managing Director</span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/shuja-keen/" target="_blank">
                                                        <div>
                                                            <img src="https://www.mitcnc.org/app/media/2018/10/shuja-keen-1.png" alt="">
                                                            <div class="icon-mit">
                                                                <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                            </div>
                                                        </div>
                                                        <span>
                                                            Shuja Keen
                                                            <span class="company">The Resource Group</span>
                                                            <span class="title">Managing Director</span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/teddy/" target="_blank">
                                                        <div>
                                                            <img src="https://www.mitcnc.org/app/media/2019/09/Teddy-Lee.png" alt="">
                                                            <div class="icon-mit">
                                                                <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                            </div>
                                                        </div>
                                                        <span>
                                                            Teddy Lee
                                                            <span class="company">OneSignal</span>
                                                             <span class="title">Growth</span>
                                                             <span class="red-bg" style="width: 103px;">Session Host</span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </li>  
                                            </ul>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">9:15 AM - 9:45 AM</h4>
                                            <p>Keynote</p>
                                            <ul>
                                                
                                                <li>
                                                    <a href="https://www.mitcnc.org/kylevogt/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/KV.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>
                                                    <span>
                                                        Kyle Vogt
                                                        <span class="company">Cruise</span>
                                                        <span class="title">CTO</span>
                                                    </span>
                                                </a></li>
                                            </ul>
                                        </li>

                                       <li class="aglist">
                                            <h4 class="date">9:45 AM - 10:15 AM</h4>
                                            <p><span class="font-weight">Transportation:</span> Driving Innovation with AI</p>
                                            <ul>
                                                <li>
                                                    
                                                    <a href="https://www.mitcnc.org/mattpark/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Matt-park.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>    
                                                    <span>
                                                        Matt Park
                                                        <span  class="company">Scale AI</span>
                                                        <span class="title">Head of Business</span>
                                                        <span class="red-bg"> Moderator </span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/ashu-rege/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/08/Ashu-Rege.png" alt="">
                                                    </div>    
                                                    <span>
                                                        Ashu Rege 
                                                        <span class="company">Zoox</span>
                                                        <span class="title">SVP of Software</span>
                                                    </span>
                                                </a></li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/zoubin-ghahramani/" target="_blank">
                                                        <div>
                                                            <img src="https://www.mitcnc.org/app/media/2019/09/Zoubin-Ghahramani.png" alt="">
                                                            <div class="icon-mit">
                                                                <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                            </div>
                                                        </div>    
                                                        <span>Zoubin<br> Ghahramani
                                                            <span class="company">Uber</span>
                                                            <span class="title">Chief Research <br>Scientist</span>
                                                        </span>
                                                    </a>
                                             </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/luc-vincent/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Luc-Vincent.png" alt="">
                                                    </div>
                                                    <span>
                                                        Luc Vincent
                                                        <span class="company">Lyft</span>
                                                        <span class="title">EVP, Autonomous <br> Driving Tech </span>
                                                    </span>
                                                    </a>
                                                </li>
                                               
                                            </ul>
                                        </li>


                                      <li class="aglist">
                                            <h4 class="date">10:15 AM - 10:35 AM</h4>
                                            <p> Reverse Engineering Human Visual Intelligence</p>
                                            <ul>
                                                <li>
                                                    <a href="https://www.mitcnc.org/jamesdicarlo/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/James-DiCarlo.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>
                                                    <span>
                                                        James DiCarlo
                                                        <span class="company">MIT</span>
                                                        <span class="title">Department <br>Head -Brain and <br>Cognitive Sciences</span>
                                                    </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">10:35 AM - 10:50 AM</h4>
                                             <p class="red-text"> <img src="<?php echo esc_url($assets_uri); ?>/images/break.svg" alt="">Break</p>
                                            <!-- <ul>
                                                <li><a href="#" target="_blank">Jim DiCarlo (MIT)</a></li>
                                            </ul> -->
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">10:50 AM - 11:20 AM</h4>
                                            <p>The Rise of AI Hardware </p>
                                            <ul>
                                                <li>
                                                    <a href="https://www.mitcnc.org/morgan-lai/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/05/Morgan-Lai-profile-img.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>    
                                                    <span>
                                                        Morgan  Lai
                                                        
                                                        <span  class="company">Foundation Capital</span>
                                                        <span class="title">Partner</span>
                                                        <span class="red-bg" style="width: 103px;">Session Host</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/stevevassallo/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Steve-Vassallo.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>    
                                                    <span>
                                                        Steve Vassallo
                                                        
                                                        <span  class="company">Foundation Capital</span>
                                                        <span class="title">General Partner</span>
                                                        <span class="red-bg">Moderator</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/andrew-feldman/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Andre-Feldman.png" alt="">
                                                    </div>    
                                                    <span>
                                                        Andrew Feldman
                                                        <span class="company">Cerebras Systems</span>
                                                        <span class="title">CEO & Co-Founder</span>
                                                    </span>
                                                    </a>
                                                </li>
                                               
                                            </ul>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">11:20 AM - 11:50 AM</h4>
                                            <p><span class="font-weight">Data Revolution:</span> Applying AI to the Enterprise</p>
                                            <ul>
                                                <li>
                                                    <a href="https://www.mitcnc.org/bindureddy/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Bindu-Reddy.png" alt="">
                                                    </div>
                                                    <span>
                                                        Bindu Reddy
                                                        <span class="company">RealityEngines.AI</span>
                                                        <span class="title">CEO</span>
                                                        <span class="red-bg">Moderator</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/anant-bhardwaj/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Anant-Bhardwaj.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>    
                                                    <span>
                                                       Anant Bhardwaj
                                                        <span class="company">Instabase</span>
                                                        <span class="title">Founder & CEO</span>
                                                    </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="https://www.mitcnc.org/sriram-raghavan/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Sriram-Raghavan.png" alt="">
                                                        <span>
                                                        Sriram Raghavan
                                                            <span class="company">IBM</span>
                                                            <span class="title">Vice President, <br>IBM Research AI</span>
                                                        </span>
                                                    </div>
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">11:50 AM - 12:00 PM</h4>
                                            <p>Building a Model-Driven Business</p>
                                            <ul>
                                              
                                                <li>
                                                    <a href="https://www.mitcnc.org/matthew-granade/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Matthew-Granade.png" alt="">
                                                    </div>
                                                    <span>
                                                       Matthew Granade
                                                        <span class="company">Point72</span>
                                                        <span class="title">Chief Market Intelligence Officer,<br> Point72 Asset Management;<br> Managing Partner,<br> Point72 Ventures</span>
                                                    </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">12:00 PM - 1:40 PM</h4>
                                            <p class="red-text"><img src="<?php echo esc_url($assets_uri); ?>/images/knife-fork-and-plate.svg" alt="">Lunch</p>
                                        </li>
                                        <li class="aglist">
                                            <h4 class="date">1:40 PM - 2:00 PM</h4>
                                            <p><span class="font-weight">Fireside Chat:</span> AI at the Cutting Edge </p>
                                            <ul>
                                                <li>
                                                    <a href="https://www.mitcnc.org/adam/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Adam-DAngelo.png" alt="">
                                                    </div>
                                                    <span>
                                                        Adam D'Angelo
                                                        <span class="company">Quora</span>
                                                        <span class="title">CEO</span>
                                                        <span class="red-bg">Moderator</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/gregbrockman/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Greg-Brockman.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>    
                                                    <span>
                                                        Greg Brockman
                                                        <span class="company">OpenAI</span>
                                                        <span class="title">Chairman & CTO</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/jesusbolivar/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2018/10/jesus-bolivar.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>    
                                                    <span>
                                                        Jesus  Bolivar
                                                        <span class="company">McKinsey</span>
                                                        <span class="title">Platform Product<br> Manager - Fuel</span>
                                                        <span class="red-bg" style="width: 103px;">Session Host</span>
                                                    </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>    

                                        <li class="aglist">
                                            <h4 class="date">2:00 PM - 2:20 PM</h4>
                                            <p>Practical Quantum Computing </p>
                                            <ul>
                                                
                                                <li>
                                                    <a href="https://www.mitcnc.org/vern-brownell/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Vern-Brownell.png" alt="">
                                                    </div>
                                                    <span>
                                                        Vern Brownell
                                                        <span class="company">D-Wave</span>
                                                        <span class="title">CEO</span>
                                                    </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>  

                                        <li class="aglist">
                                            <h4 class="date">2:20 PM - 2:40 PM</h4>
                                            <p><span class="font-weight">Health AI:</span> AI Research in Healthcare</p>
                                            <ul>
                                                
                                                <li>
                                                    <a href="https://www.mitcnc.org/monaflores/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Mona-Flores.png" alt="">
                                                    </div>
                                                    <span>
                                                    Mona  Flores
                                                        <span class="company">NVIDIA</span>
                                                        <span class="title">Global Lead for Hospitals <br>and Clinical Partnerships</span>
                                                        <span class="red-bg">Moderator</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/rameshraskar/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Ramesh-Raskar.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>
                                                    <span>
                                                    Ramesh Raskar
                                                        <span class="company">MIT Media Lab</span>
                                                        <span class="title">Associate Professor <br>of Media Arts <br>and Sciences</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/kristenyeom/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Kristen-Yeom.png" alt="">
                                                    </div>    
                                                    <span>
                                                    Kristen Yeom
                                                        <span class="company">Stanford University</span>
                                                        <span class="title">Associate Professor </span>
                                                    </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>  
                                        <li class="aglist">
                                            <h4 class="date">2:40 PM - 2:50 PM</h4>
                                            <p><span class="font-weight">Health AI:</span> AI Applications in Healthcare </p>
                                            <ul>
                                                
                                                <li>
                                                    <a href="https://www.mitcnc.org/monaflores/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Mona-Flores.png" alt="">
                                                    </div>
                                                    <span>
                                                    Mona  Flores
                                                        <span class="company">NVIDIA</span>
                                                        <span class="title">Global Lead for Hospitals <br>and Clinical Partnerships</span>
                                                        <span class="red-bg">Moderator</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/zeenatpatrawala/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Zeenat.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>
                                                    <span>
                                                    Zeenat Patrawala 
                                                        <span class="company">Google</span>
                                                        <span class="title">Partner & Business<br> Development <br>- Google Brain</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </li>    

                                        <li class="aglist">
                                            <h4 class="date">2:50 PM - 3:05 PM</h4>
                                            <p class="red-text"><img src="<?php echo esc_url($assets_uri); ?>/images/Networking- Break.png" alt="">Espresso Bar & Ice Cream Social</p>
                                            <!-- <ul>
                                                <li><a href="#" target="_blank">Matthew Granade (Domino Data Lab & Point72)</a></li>
                                            </ul> -->
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">3:05 PM - 3:25 PM</h4>
                                            <p>Shaping Work of the Future</p>
                                            <ul>
                                                
                                                <li>
                                                    <a href="https://www.mitcnc.org/tom-kochan/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Tomas-Kochan.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>   
                                                    <span>
                                                    Tom Kochan
                                                        <span class="company">MIT Sloan School<br> of Management </span>
                                                        <span class="title">Professor</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/gailegordon/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Gaile.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>   
                                                    <span>
                                                    Gaile Gordon
                                                        <span class="company">Air Street Capital</span>
                                                        <span class="title">Operating Partner </span>
                                                        <span class="red-bg" style="width: 103px;">Session Host</span>
                                                    </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">3:25 PM - 3:55 PM</h4>
                                            <p><span class="font-weight">Healthcare:</span> Improving Health with AI</p>
                                            <ul>
                                                <li>
                                                    <a href="https://www.mitcnc.org/afsanaakther/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2018/10/afsana-akhter.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div> 
                                                    <span>
                                                    Afsana Akhter
                                                        <span class="company">SkinIQ</span>
                                                        <span class="title">Co-founder</span>
                                                        <span class="red-bg">Moderator</span> 
                                                        </span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/anmol-madan/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Anmol-Madan.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>    
                                                    <span>
                                                      Anmol Madan
                                                        <span class="company">Livongo</span>
                                                        <span class="title">Chief Data Scientist</span>
                                                    </span>
                                                    </a>
                                                </li>
                                               
                                                <li>
                                                    <a href="https://www.mitcnc.org/mathai-mammen/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Mathai-Mammen.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>
                                                    <span>
                                                     Mathai Mammen
                                                        <span class="company">Johnson & Johnson</span>
                                                        <span class="title">Global Head of R&D</span>
                                                    </span>
                                                    </a>
                                                </li>
                                              
                                                <li>
                                                    <a href="https://www.mitcnc.org/ted-goldstein/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Ted-Goldstein.png" alt="">
                                                    </div>
                                                    <span>
                                                     Ted Goldstein 
                                                        <span class="company">Anthem.AI</span>
                                                        <span class="title">VP Chief AI Officer</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">3:55 PM - 4:15 PM</h4>
                                            <p><span class="font-weight">Machine learning in Genomics:</span> Dissecting Disease Circuitry at <br>Single-Cell Resolution</p>
                                            <ul>
                                                <li>
                                                    <a href="https://www.mitcnc.org/manolis-kellis/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/08/Manolis-Kellis-New.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>   
                                                    <span>
                                                       Manolis Kellis
                                                        <span class="company">MIT</span>
                                                        <span class="title">Professor</span>
                                                    </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">4:15 PM- 4:30 PM</h4>
                                            <p class="red-text"> <img src="<?php echo esc_url($assets_uri); ?>/images/break.svg" alt="">Espresso Bar & Ice Cream Social</p>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">4:30 PM - 4:50 PM</h4>
                                            <p><span class="font-weight">Enabling AI Products with ML Infrastructure:</span> From Repeatable Inputs to Explainable Outputs</p>
                                            <ul>
                                               
                                                <li>
                                                    <a href="https://www.mitcnc.org/kelleyrivoire/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/08/kelley-rivoire.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>    
                                                    <span>
                                                       Kelley Rivoire
                                                        <span class="company">Stripe</span>
                                                        <span class="title">Head of Data</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/daniekwak/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Daniel-Kwak.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>    
                                                    <span>
                                                        Daniel Kwak
                                                        <span class="company">Point72 Ventures</span>
                                                        <span class="title">Vice President </span>
                                                        <span class="red-bg" style="width: 103px;">Session Host</span>
                                                    </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="aglist">
                                            <h4 class="date">4:50 PM - 5:10 PM</h4>
                                            <p>Applying AI to Real World Use Cases </p>
                                            <ul>
                                               
                                                <li>
                                                    <a href="https://www.mitcnc.org/juliechoi/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Julie-Choi.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>    
                                                    <span>
                                                        Julie Choi
                                                        <span class="company">Intel Corportion </span>
                                                        <span class="title">VP of Artificial <br>Intelligence Products <br>and Research Marketing</span>
                                                    </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="aglist">  
                                            <h4 class="date">5:10 PM - 5:40 PM</h4>
                                            <p><span class="font-weight">AI and Ethics:</span> Using AI to Create a Better World</p>
                                            <ul>
                                                <li>
                                                    <a href="https://www.mitcnc.org/jakeseid/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2018/10/jake-seid.png" alt="">
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    </div>
                                                    <span>
                                                        Jake Seid
                                                        <span class="company">Stone Bridge Ventures</span>
                                                        <span class="title">Managing Director</span>
                                                        <span class="red-bg">Moderator</span>
                                                    </span>
                                                    </a>
                                                </li>   
                                                <li>
                                                    <a href="https://www.mitcnc.org/paulagoldman/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Paula-Golman.png" alt="">
                                                    </div>
                                                    <span>
                                                    Paula Goldman
                                                        <span class="company">Salesforce</span>
                                                        <span class="title">Chief Ethical <br>and Humane Use Officer</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/timnit-gebru/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Timnit-Gebru.png" alt="">
                                                    </div>    
                                                    <span>
                                                    Timnit Gebru
                                                        <span class="company">Google</span>
                                                        <span class="title">Senior Research Scientist</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                
                                                <li>
                                                    <a href="https://www.mitcnc.org/eddan-katz/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/Eddan-Katz.png" alt="">
                                                    </div>
                                                    <span>
                                                    Eddan Katz
                                                        <span class="company">WEF</span>
                                                        <span class="title">Project Lead, <br>AI & Machine Learning</span>
                                                    </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="https://www.mitcnc.org/apoorvsaxena/" target="_blank">
                                                    <div>
                                                        <img src="https://www.mitcnc.org/app/media/2019/09/apoorv-saxena.png" alt="">
                                                    </div>
                                                    <span>
                                                    
                                                        Apoorv Saxena
                                                        <span class="company">JPMorgan Chase & Co</span>
                                                        <span class="title">Global Head <br>of AI (Technology), <br>Managing Director</span>
                                                    </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>           
                                        

                                        <li class="aglist">
                                            <h4 class="date">5:40 PM - 6:25 PM</h4>
                                            <p>AI Idol</p>
                                            <ul>
                                                 <li  class="finalist">
                                                    <a href="https://www.mitcnc.org/jasonscott/">
                                                        <div>
                                                            <img src="https://www.mitcnc.org/app/media/2019/09/Jason-Scott.png" alt="">
                                                        </div>
                                                        <span>
                                                            Jason  Scott
                                                            <span class="company">Google</span>
                                                            <span class="title">Global  <br>Startup Programs</span>
                                                        </span>
                                                    </a>
                                                 </li>
                                                <li   class="judges">
                                                    <a href="https://www.mitcnc.org/darianshirazi/" target="_blank">
                                                        <div>
                                                            <img src="https://www.mitcnc.org/app/media/2019/09/Darian.png" alt="">
                                                        </div>
                                                        <span>
                                                            Darian Shirazi
                                                            <span class="company">Gradient Ventures</span>
                                                            <span class="title">General Partner</span>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="https://www.mitcnc.org/rohinichakravarthy/" target="_blank">
                                                        <div>
                                                            <img src="https://www.mitcnc.org/app/media/2019/09/Rohini.png" alt="">
                                                            <div class="icon-mit">
                                                                <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                            </div>
                                                        </div>    
                                                        <span>
                                                        Rohini <br>Chakravarthy
                                                            <span class="company">NGP Capital</span>
                                                            <span class="title">Partner</span>
                                                        </span>
                                                    </a>
                                                </li>
                                                    
                                                <li>
                                                    <a href="https://www.mitcnc.org/ravirajjain/" target="_blank">
                                                        <div>
                                                            <img src="https://www.mitcnc.org/app/media/2019/09/Raviraj.png" alt="">
                                                        </div>
                                                        <span>
                                                        Raviraj Jain
                                                            <span class="company">Lightspeed<br> Venture Partners</span>
                                                            <span class="title">Partner</span>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="https://www.mitcnc.org/ashugarg/" target="_blank">
                                                        <div>
                                                            <img src="https://www.mitcnc.org/app/media/2019/09/Ashu-Garg.png" alt="">
                                                        </div>
                                                        <span>
                                                        Ashu Garg
                                                            <span class="company">Foundation Capital</span>
                                                            <span class="title">General Partner</span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/markcramer/" target="_blank">
                                                        <div>
                                                            <img src="https://www.mitcnc.org/app/media/2018/10/mark-kramer.png" alt="">
                                                            <div class="icon-mit">
                                                                <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                            </div>
                                                        </div>
                                                        <span>
                                                        Mark Cramer
                                                            <span class="company">PARC, <br>a Xerox Company</span>
                                                            <span class="title">Applied AI <br>Product Management </span>
                                                            <span class="red-bg" style="width: 103px;">Session Host</span>
                                                        </span>
                                                    </a>
                                                </li>    

                                            </ul>         

                                               
                                            
                                        </li>            

                                        <li class="aglist">
                                            <h4 class="date">6:25 PM - 6:40 PM</h4>
                                            <p>Closing Fireside</p>
                                            <ul>
                                                <li>
                                                    <a href="https://www.mitcnc.org/teddy/" target="_blank">
                                                        <div>
                                                            <img src="https://www.mitcnc.org/app/media/2019/09/Teddy-Lee.png" alt="">
                                                            <div class="icon-mit">
                                                                <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                            </div>
                                                        </div>
                                                        <span>
                                                            Teddy Lee
                                                            <span class="company">OneSignal</span>
                                                             <span class="title">Growth</span>
                                                             <span class="red-bg">Moderator</span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </li>     
                                                <li>
                                                    <a href="https://www.mitcnc.org/jocelyngoldfein/" target="_blank">
                                                        <div>
                                                            <img src="https://www.mitcnc.org/app/media/2019/02/zetta-joycelyn-goldfein.png" alt="">
                                                            <div class="icon-mit">
                                                                <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                            </div>
                                                        </div>
                                                        <span>
                                                            Jocelyn Goldfein
                                                            <span class="company">Zetta Venture <br> Partners</span>
                                                            <span class="title">Managing Director</span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.mitcnc.org/markgorenberg/" target="_blank">
                                                        <div>
                                                            <img src="https://www.mitcnc.org/app/media/2018/10/mark-gorenberg-e1544598998759.png" alt="">
                                                            <div class="icon-mit">
                                                                <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                            </div>
                                                        </div>
                                                        <span>
                                                            Mark Gorenberg
                                                            <span class="company">Zetta Venture<br> Partners</span>
                                                            <span class="title">Managing Director</span>
                                                            
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                       <li class="aglist">
                                            <h4 class="date">6:40 PM - 7:40 PM</h4>
                                            <p class="red-text">Cocktail Hour</p>
                                            
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
                                <!-- <i class="icon">
                                    <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg">
                                </i> -->
                            </a>
                        </div> 
                        <div class="row mt50">
                            <div class="col-sm-12">
                                                 
                                <div class="sponcer-section">
                                    <h2 class="yellow white-text mt-0">Interested in sponsoring?</h2>
                                    <p>the sponsorship prospectus for the<br>MIT AI conference 2019</p>
                                    <a href="https://www.mitcnc.org/app/media/2019/07/AI-Conference-2019-Future-of-Computing-Sponsors-Prospectus.pdf" class="default-btn download-btn mt20" target="_blank">
                                        Download
                                        <i class="icon">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg">
                                        </i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-11 offset-sm-1">
                                <div class="row">
                                    <div class="col-sm-24">
                                        <div class="white-boxes">
                                            <h2 class="yellow">Become an exhibitor</h2>
                                            <p>More then 40 keynote and friends sessions, and over<br>50 exhibiting startups, this is MIT’s largest event ever.</p>
                                            <a href="https://goo.gl/forms/uQIU94a8DGsWapxr2" target="_blank" class="agenda-link mt70">
                                                Submit an Application
                                                <i class="icon">
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg">
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-24 mt70">
                                        <div class="white-boxes">
                                            <h2 class="yellow">Become a sponsor</h2>
                                            <p>Inspired thinkers from multiple disciplines to inspire<br>your organization to build real-world AI solutions.</p>
                                            <a href="https://goo.gl/forms/uQIU94a8DGsWapxr2" target="_blank" class="agenda-link mt70">
                                                Get in Touch with us
                                                <i class="icon">
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg">
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <article class="light-bg mt50">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-14">
                                    <h2 class="yellow">
                                        The world's smartest minds
                                    </h2>
                                    <p>From Amazon to Zetta Venture Partners, we've got an insanely smart group of folks who will discuss where they see the Future of AI and the opportunities that have them excited.</p>
                                </div>
                                <div class="col-sm-24 text-center mt50">
                                    <img  src="<?php echo esc_url($assets_uri); ?>/images/mind-logos.png" class="logos-images" alt="">
                                </div>
                            </div>
                        </div>
                    </article>
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
                        } if (isset($meta_data['media_gallery'][0]) && !empty($meta_data['media_gallery'][0])) {
                            $meta_data['media_gallery'][0] = is_serialized($meta_data['media_gallery'][0]) ? unserialize($meta_data['media_gallery'][0]) : array($meta_data['media_gallery'][0]);
                            if (null != $meta_data['media_gallery'][0] && count($meta_data['media_gallery'][0]) > 0) {
                                $meta_data_media_gallery_count = count($meta_data['media_gallery'][0]);
                                for ($i = 0; $i < $meta_data_media_gallery_count; $i++) {
                                    $event_gallery = get_post($meta_data['media_gallery'][0][$i]);
                                    if (null != $event_gallery) {
                                        ?>
                                        <?php if (!empty($event_gallery->post_content)) { ?>
                                            <div class="row" id="past_gallery">
                                                <div class="col-sm-20 mt30">
                                                    <h2 class="yellow">Past Event gallery</h2>
                                                </div>
                                                <div class="col-sm-4 mt70 text-right">
                                                    <a href="<?php bloginfo('url'); ?>/watch-learn/photos/" class="view-btn black">View All<img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-24">
                                                    <?php echo do_shortcode(wpautop($event_gallery->post_content)); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if (have_rows('videos', $event_gallery->ID)) { ?>
                                            <!--<hr class="mb60 mt60">-->
                                            <div class="row">
                                                <div class="col-sm-20 mb40">
                                                    <h2 class="yellow">Past Talks</h2>
                                                </div>
                                                <div class="col-sm-4 mt40 text-right">
                                                    <a href="<?php bloginfo('url'); ?>/watch-learn/videos/" class="view-btn black">View All<img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <?php
                                                $video_count = get_post_meta($event_gallery->ID, 'videos', true);
                                                $inn = 1;
                                                while (have_rows('videos', $event_gallery->ID)) {
                                                    the_row();
                                                    $video_url = get_sub_field('url', $event_gallery->ID);
                                                    $video_thumbnail = get_sub_field('thumbnail', $event_gallery->ID);
                                                    $video_title = get_sub_field('title', $event_gallery->ID);
                                                    ?>
                                                    <div class="col-sm-8">
                                                        <a data-fancybox="gallery-video" href="<?php echo esc_url($video_url); ?>"
                                                           class="media-card">
                                                            <div class="media-img">
                                                                <img src="<?php echo esc_url($video_thumbnail); ?>" alt="">
                                                            </div>
                                                            <div class="media-content">
                                                                <div class="media-icon-container">
                                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/play-icon.png" alt="">
                                                                </div>
                                                                <span class="date"><?php echo esc_html($start_on_date); ?></span>
                                                                <h5 class="heading_4 white-text">
                                                                    <?php
                                                                    if (!empty($video_title)) {
                                                                        echo esc_html($video_title);
                                                                    } else {
                                                                        echo esc_html($post->post_title);
                                                                        if ($video_count > 1) {
                                                                            echo ' - Part ' . esc_html($inn);
                                                                            $inn++;
                                                                        }
                                                                    }
                                                                    ?>
                                                                </h5>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                    <article class="light-bg mt50">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-14">
                                    <h2 class="yellow">
                                        Our Partners & Supporters
                                    </h2>
                                    <p>We've got an insanely smart group of folks who will discuss where they see the Future of AI and the opportunities that have them excited.</p>
                                </div>
                                <div class="col-sm-24 text-center mt50">
                                <div class="partners-supporters">
                                    <img src="<?php echo esc_url($assets_uri); ?>/images/partners-supporters.png" class="logos-images img-responsive" alt="" >
                                </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <div class="container">
                        <?php if (!empty($event_map)) { ?>
                            <div class="row event-map" id="map-container">
                                <div class="col-sm-14 mt60">
                                    <div class="new-mit">
                                        <h2 class="yellow">New to the MIT Club of Northern California?</h2>
                                        <p>Enjoy access to members-only events, early access to popular events, member pricing, vote for board members, and other members-only benefits.</p>
                                    </div>
                                </div>
                                <!--<div class="col-sm-24 mt30">
                                <a href="#" class="big-green-btn">
                                    <h4>Join the MIT Club of Northern California today</h4>
                                    <p>Membership is open to all MIT graduates.</p>
                                    <i class="icon">
                                        <img src="<?php /*echo $assets_uri; */ ?>/images/arrow_right_white.svg" alt="">
                                    </i>
                                </a>
                            </div>-->
                                <div class="col-sm-24 mt20">
                                    <div class="event-footer-banner">
                                        <a href="https://securelb.imodules.com/s/1314/clubs-classes-interior.aspx?sid=1314&gid=25&pgid=3&cid=40">
                                            <h2 class="white-border white-text">Join the MIT Club of Northern California
                                                today</h2>
                                            <h4 class="white-text">Membership is open to all MIT graduates.</h4>
                                            <p>Enjoy access to members-only events, early access to popular events, member
                                                pricing, vote for board members, and other members-only benefits.</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-24 mt60">
                                    <div class="map-area">
                                        <?php echo filter_var($event_map, FILTER_UNSAFE_RAW); ?>
                                    </div>
                                    <div class="map-details">
                                        <p><?php echo esc_html($post->post_title); ?>
                                            <small>at</small>
                                            <?php echo esc_html($event_address); ?>
                                            <small><?php echo esc_html($event_address_1); ?></small>
                                            <?php if (!empty($event_address_2)) { ?>
                                                <small><?php echo esc_html($event_address_2); ?></small>
                                            <?php } ?>

                                            <small style="display: inline;">
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
                                                ?>
                                            </small>

                                        </p>
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/by-car-icon.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/by-walk-icon.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/by-bus-icon.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/by-cycle-icon.jpg" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        get_template_part('template-parts/content', 'upcoming-events');
                        ?>
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
