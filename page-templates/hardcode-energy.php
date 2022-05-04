<?php
/*
Template Name: Hardcoded Energy and Env
Template Post Type: page, post, program-page
*/
get_header();
global $assets_uri, $post, $program_energy_and_env, $event_program_taxonomy;
?>
<section>
    <article class="inner-page energy">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <?php get_breadcrumb(); ?>
                </div>
                <div class="col-sm-17">
                    <div class="row">
                        <div class="col-sm-24">
                            <h1 class="heading_8">Energy & Environment</h1>
                        </div>
                    </div>

                    <div class="row mt40">
                        <div class="col-sm-24">

                            <h2 style="margin-top:0">Mission</h2>
                            <p class="double-quotes">        &ldquo;</p>
                            <p>
                                Actively inform and engage MIT alumni and their colleagues in Northern California in a broad area of highly important topics relating to the replacement of fossil fuels for energy generation and transportation and other aspects of protecting the environment and sustaining our critical natural resources.  Our programs are OPEN TO ALL. 
                            </p>
                        </div>
                    </div>
                    
                    <div class="row mt40">
                        <div class="col-sm-24">
                            <div>
                                <h2 style="margin-top:0">Primary Topics</h2>
                                <p class="mt30 mb50">We feature topics of greatest demonstrated alumni interest.  In most cases, we will explore both science & technology as well as policy & economics in order to maintain a pragmatic viewpoint.</p>
                                
                                <div class="row">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="simple-box">
                                            <div class="img-box">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/p-icon1.png" alt="Electric Power icon">
                                            </div>
                                            <h4>Electric Power &amp; Grid</h4>
                                            <p>both distributed and utility - class</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-8 col-md-12">
                                        <div class="simple-box">
                                            <div class="img-box">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/p-icon2.png" alt="">
                                            </div>
                                            <h4>Storage</h4>
                                            <p>both grid-level and distributed, for renewable energy sources</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-8 col-md-12">
                                        <div class="simple-box">
                                            <div class="img-box">
                                                <img src="https://www.mitcnc.org/app/uploads/2020/10/p-food-water-tmp.png"
                                                     alt="food and water">
                                            </div>
                                            <h4>Food &amp; Water</h4>
                                            <p>challenges & opportunities</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-8 col-md-12">
                                        <div class="simple-box">
                                            <div class="img-box">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/p-icon4.png" alt="">
                                            </div>
                                            <h4>Transportation</h4>
                                            <p>Electric Vehicles & Biofuels</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-8 col-md-12">
                                        <div class="simple-box">
                                            <div class="img-box">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/p-icon5.png" alt="">
                                            </div>
                                            <h4>Climate        Change</h4>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-8 col-md-12">
                                        <div class="simple-box">
                                            <div class="img-box">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/p-icon6.png" alt="">
                                            </div>
                                            <h4>Entrepreneurship &amp; Investing</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt40">
                        <div class="col-sm-15">
                            <h2 style="margin-top:0">Panel Discussions & Guest Speakers</h2>
                            <p class="text-pad-right">

                                We feature high profile, experienced and knowledgeable participants in our panel discussions
                                in the same topical areas as MITEI on the Road, so as to provide both a research and a
                                commercial perspective.  These discussions are intended to be informative and thought-provoking
                                and should provide many attendees with important new contacts in their areas of interest.  Most
                                panel discussions include executives from relatively new companies in order to maintain our e
                                ntrepreneurial orientation.

                                <br>
                                
                                We also feature prominent speakers from the energy industry, typically CEOs or founders of
                                important companies, to comment on a wide range of issues and provide a glimpse of things to come. 
                            </p>
                        </div>
                        
                        <div class="col-sm-9">
                            <h2 style="margin-top:0">MITEI* on the Road</h2>
                            <p>
                                This program features visiting MIT professors who are experts in their fields and will
                                describe their most innovative and promising energy research, much of which may be commercializable within a few years.
                            </p>
                            <p class="note">
                                Note: *MITEI stands for “MIT Energy initiative”, which now encompasses 25% of the MIT faculty.
                            </p>
                        </div>
                    </div>
                </div>
                    <article class="upcoming-events" style="padding-bottom:0;padding-top:0;margin-bottom:0">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h2><a href="https://www.mitcnc.org/event/events-listing/">Upcoming Events</a></h2>
                                </div>
                            </div>
                            <div class="row card-container">
                                <div class="card-slider clearfix">
                                    <div class="col-lg-8 col-md-12">
                                        <div href="javascript:void(0);" class="card-box"  style="padding-bottom:0;margin-bottom:0">
                                            <h6 class="mt0">
                                                Virtual Event                                            
                                            </h6>
                                            <a href="https://www.mitcnc.org/events/climate-policy-what-it-needs-to-be/"
                                               class="card-img"
                                               style="background-color:#3f8934">
                                                <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/skyline.svg" alt="">
                                                <span class="tag" style="background-color: #FFB303">MITCNC Event</span>
                                            </a>
                                            <div class="card-details">
                                                <h3><a href="https://www.mitcnc.org/events/climate-policy-what-it-needs-to-be/">
                                                        Tom Steyer on Climate Change Policy
                                                </a></h3>
                                            </div>
                                            <span class="datebox">
                                                <span class="date">Mon, Sep 28 / 4:00 pm PT</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-12">
                                        <div href="javascript:void(0);" class="card-box"  style="padding-bottom:0;margin-bottom:0">
                                            <h6 class="mt0">
                                                Virtual Event                                            
                                            </h6>
                                            <a href="https://www.mitcnc.org/events/sunrise-from-the-west-californias-clean-energy-future/"
                                               class="card-img"
                                               style="background-color:#3f8934">
                                                <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/skyline.svg" alt="">
                                                <span class="tag" style="background-color: #FFB303">MITCNC Event</span>
                                            </a>
                                            <div class="card-details">
                                                <h3><a href="https://www.mitcnc.org/events/sunrise-from-the-west-californias-clean-energy-future/">
                                                        David Hochschild on California's Clean Energy Future
                                                </a></h3>
                                            </div>
                                            <span class="datebox">
                                                <span class="date">Tue, Oct 20 / 6:00 pm PT</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

            </div>
            
        </div>
    </article>
</section>


<?php

    get_footer();

?>
