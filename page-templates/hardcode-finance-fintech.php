<?php
/*
Template Name: Hardcoded Finance and Fintech
Template Post Type: page, post, program-page
*/
get_header();
 global $assets_uri, $post, $program_energy_and_env, $event_program_taxonomy, $upcoming_events;

 /* not sure if this is needed or not */
 $program_id = get_field('program', $post->ID);
/* end lack of clarity */

$upcoming_events = get_events(6, null, null, $program_id);


$volunteers_by_page = get_field('volunteers', $post->ID);

$volunteers = null;
if (is_array($volunteers_by_page)) {
    $volunteers = get_users_by_type('volunteer_spotlight', '', false, '', false, 'ASC', $volunteers_by_page);
}
$volunteers_total_count = count(get_users_by_type('volunteer_spotlight'));


?>

<section>
    <article class="inner-page energy" style="padding-bottom:0">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <?php get_breadcrumb(); ?>
                </div>
                <div class="col-sm-17" style="padding-bottom:0">
                    <div class="row" style="padding-bottom:0">
                        <div class="col-sm-24">
                            <h1 class="heading_8">Finance &amp; FinTech</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    
    <article class="speaker-list" style="padding-top:0">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <h2>Volunteers</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-24">
                    <p class="">
                        Check out some of our Finance &amp; FinTech volunteers &mdash; bringing you over 3 events per month this quarter:
                    </p>
                </div>
            </div>
            <div class="row speaker-container" style="border-top:0">  
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="speaker-card" style="padding-top:0">
                        <a href="https://www.mitcnc.org/jason-escamilla/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2019/11/Jason-Escamilla.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Jason Escamilla, CFA</h3>
                                    <span class="code">MBA ’02</span>
                                </div>
                                <div class="company-name ">
                                    <h4>ImpactAdvisor </h4>
                                    <span>CEO</span>
                                </div>
                                
                                <div class="border-dotted"></div>

                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="twitter.com/JasonEscamilla" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/tw.svg" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/in/jescamilla/" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-6 col-md-12">

                    <div class="speaker-card" style="padding-top:0">
                        <a href="https://www.mitcnc.org/arnoldchu/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2020/10/Arnold-Chu.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Arnold  Chu</h3>
                                    <span class="code">SB '78</span>
                                </div>
                                <div class="company-name ">
                                    <h4> Federal Housing and Finance Agency</h4>
                                    <span>Principal Examiner</span>
                                </div>
                                
                                <div class="border-dotted"></div>

                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://www.linkedin.com/in/arnoldchu/" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    
                    <div class="speaker-card" style="padding-top:0">
                        <a href="https://www.mitcnc.org/gadieguez/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2020/10/Gregg-Dieguez.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Gregg Dieguez</h3>
                                    <span class="code">SB '69, SM ' 71</span>
                                </div>
                                <div class="company-name ">
                                    <h4></h4>
                                    <span></span>
                                </div>
                                
                                <div class="border-dotted"></div>
                                
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://www.linkedin.com/in/gregg-dieguez-32733a1" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    
                    <div class="speaker-card" style="padding-top:0">
                        <a href="https://www.mitcnc.org/yangr/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2020/10/Yang-Ruan.png" alt="Yang Ruan">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Yang Ruan</h3>
                                    <span class="code">SB '08</span>
                                </div>
                                <div class="company-name ">
                                    <h4>TrueValue Labs</h4>
                                    <span>Senior ESG Data Engineer</span>
                                </div>
                                
                                <div class="border-dotted"></div>
                                
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://www.linkedin.com/in/mirthbottle/" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="LinkedIn">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>


            </div>
    </article>

    
    <article class="upcoming-events" style="padding-bottom:0;padding-top:0;margin-bottom:0">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <h2>Upcoming Events</h2>
                </div>
            </div>
            
            <div class="row card-container">
                <div class="card-slider clearfix">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                        <div href="javascript:void(0);" class="card-box m-sm-1">
                            <h6 class="mt0">
                                
                                Virtual Event                                            
                            </h6>
                            <a href="https://www.mitcnc.org/events/founding-in-fintech-and-simplifying-estate-planning/" class="card-img" style="background-color:#a64d79">
                                <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/skyline.svg" alt="">
                                <span class="tag" style="background-color: #FFB303">MITCNC Event</span>
                            </a>
                            <div class="card-details">
                                <h3><a href="https://www.mitcnc.org/events/founding-in-fintech-and-simplifying-estate-planning/">
                                        Founding in Fintech and Simplifying Estate Planning
                                </a></h3>
                            </div>
                            <span class="datebox">
                                <span class="date">Thu, Nov 19 / 12:00 pm PT</span>
                            </span>
                            <a href="https://www.mitcnc.org/events/founding-in-fintech-and-simplifying-estate-planning/" class="default-btn mt15 registration-btn">Info and Registration <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/arrow_right_white.svg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <article class="upcoming-events" style="padding-bottom:0;padding-top:0;margin-bottom:0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2><a href="https://www.mitcnc.org/event/events-listing/">Past Events</a></h2>
                </div>
            </div>
            <div class="row card-container">
                <div class="card-slider clearfix">
                    <div class="col-lg-8 col-md-12">
                        <div href="javascript:void(0);" class="card-box"  style="padding-bottom:0;margin-bottom:0">
                            <h6 class="mt0">
                                Virtual Event                                            
                            </h6>
                            <a href="https://www.mitcnc.org/events/mit-finance-track-happy-hour/" class="card-img" style="background-color:#4c1130">
                                <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/skyline.svg" alt="">
                                <span class="tag" style="background-color: #FFB303">MITCNC Event</span>
                            </a>
                            <div class="card-details">
                                <h3><a href="https://www.mitcnc.org/events/mit-finance-track-happy-hour/">MIT FinTech Happy Hour</a></h3>
                            </div>
                            <span class="datebox">
                                <span class="date">Wed, Oct 28 / 5:00 pm PT</span>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div href="javascript:void(0);" class="card-box"  style="padding-bottom:0;margin-bottom:0">
                            <h6 class="mt0">
                                Virtual Event                                            
                            </h6>
                            <a href="https://www.mitcnc.org/events/current-state-of-real-estate-lunchtime-roundtable/" class="card-img" style="background-color:#45818e">
                                <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/skyline.svg" alt="">
                                <span class="tag" style="background-color: #FFB303">MITCNC Event</span>
                            </a>
                            <div class="card-details">
                                <h3><a href="https://www.mitcnc.org/events/current-state-of-real-estate-lunchtime-roundtable/">
                                        Current State of Real Estate: Lunchtime Roundtable
                                </a></h3>
                            </div>
                            <span class="datebox">
                                <span class="date">Thu, Oct 15 / 12:00 pm PT</span>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div href="javascript:void(0);" class="card-box"  style="padding-bottom:0;margin-bottom:0">
                            <h6 class="mt0">
                                Virtual Event                                            
                            </h6>
                            <a href="https://www.mitcnc.org/events/stock-market-investing-game-kids-9-13-edition-no-experience-necessary/"
                               class="card-img" style="background-color:#c27ba0">
                                <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/skyline.svg" alt="">
                                <span class="tag" style="background-color: #FFB303">MITCNC Event</span>
                            </a>
                            <div class="card-details">
                                <h3><a href="https://www.mitcnc.org/events/stock-market-investing-game-kids-9-13-edition-no-experience-necessary/">
                                        Stock Market Investing Game - Kids 9-13 Edition - No Experience Necessary
                                </a></h3>
                            </div>
                            <span class="datebox">
                                <span class="date">Mon, Aug 10 / 2:00 pm PT</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>


    
</section>


<?php

 get_footer();

?>
