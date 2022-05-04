<?php
/*
Template Name:  Half-hardcoded Startups Page
Template Post Type: page, post, program-page
 */
    get_header();
    global $assets_uri, $post, $program_tech_track, $event_program_taxonomy, $speaker_col, $upcoming_events;

    $media_gallery = get_media_gallery_for_videos(3);
    $media_gallery = get_media_gallery(3, false, 22);
    $program_id = get_field('program', $post->ID);

    $upcoming_events = get_events(6, null, null, $program_id);
    $speakers_by_page = get_field('speakers_list', $post->ID);
    $speakers = null;
if (is_array($speakers_by_page)) {
        $speakers = get_users_by_type('speakers', '', false, '', false, 'ASC', $speakers_by_page);
}
    $speakers_total_count = count(get_users_by_type('speakers'));


    $volunteers_by_page = get_field('volunteers', $post->ID);
    $volunteers = null;
if (is_array($volunteers_by_page)) {
        $volunteers = get_users_by_type('volunteer_spotlight', '', false, '', false, 'ASC', $volunteers_by_page);
}
    $volunteers_total_count = count(get_users_by_type('volunteer_spotlight'));

?>
    <section >
        <article class="inner-page" style="padding-bottom: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-24">
                        <?php get_breadcrumb(); ?>
                    </div>
                    <div class="col-sm-24">
                        <div class="row mb15">
                            <div class="col-sm-24">
                                <h1><?php echo esc_html($post->post_title); ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                <div class="feature-images-sec">
                                    <img width="792" height="298" src="<?php echo esc_url(get_the_post_thumbnail_url($post->ID)); ?>" class="attachment-thumbnail_1079_474 size-thumbnail_1079_474 wp-post-image" />
                                </div>
                                <p style=" margin-top: 20px;"><?php echo filter_var(wpautop($post->post_content), FILTER_UNSAFE_RAW); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
<!--
        <?php get_template_part('template-parts/content', 'upcoming-events'); ?>
-->
    <article class="speaker-list" >
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <h2>Resources</h2>
                </div>
            </div>
            
            
            <a href="https://www.linkedin.com/groups/4177485/" style="text-decoration:none">
                
                <span style="font-weight:500;color:inherit;font-size:1.75rem;font-family:'Poppins', sans-serif;vertical-align:text-bottom;">
                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg"
                         style="width:1.5rem;margin-bottom:0.3em" alt="LinkedIn">
                    
                    &nbsp;&nbsp;&nbsp; MIT Founders on LinkedIn
                    
                </span>
            </a>
            
            <br><br>
            
            <a href="https://www.facebook.com/groups/MITFounders" style="text-decoration:none">
                
                <span style="font-weight:500;color:inherit;font-size:1.75rem;font-family:'Poppins', sans-serif;vertical-align:text-bottom;">
                    <img src="<?php echo esc_url($assets_uri); ?>/images/fb.svg"
                         style="height:1.5rem;margin-left:0.5rem;margin-bottom:0.3em" alt="facebook">
                    &nbsp;&nbsp;&nbsp; MIT Founders facebook group
                </span>
            </a>
            
            <br><br>
            
            <a href="https://mitcnc.slack.com/" style="text-decoration:none">
                <span style="font-weight:500;color:inherit;font-size:1.75rem;font-family:'Poppins', sans-serif;vertical-align:text-bottom;">
                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/slack.svg"
                         style="width:1.5rem;margin-bottom:0.3em" alt="slack">
                    &nbsp;&nbsp;&nbsp; MITCNC Slack
                </span>
                <br>
                <span>Join with your @alum.mit.edu or write to us to request access</span>
            </a>
            
            <br><br>
            
            <a href="https://www.mitcnc.org/podcasts/" style="text-decoration:none">
                
                <span style="font-weight:500;color:inherit;font-size:1.75rem;font-family:'Poppins', sans-serif;vertical-align:text-bottom;">
                    <img src="https://www.mitcnc.org/app/uploads/2020/08/catalysts-quick.png"
                         style="width:1.5rem;margin-bottom:0.3em" alt="Catalysts Podcast">
                    &nbsp;&nbsp;&nbsp; MIT Catalysts Podcast
                </span>
            </a>
            
            <br><br>
            
            
            <a href="https://www.mitalumniangelsnorcal.com/" style="text-decoration:none">
                <span style="font-weight:500;color:inherit;font-size:1.75rem;font-family:'Poppins', sans-serif;vertical-align:text-bottom;">
                    <img src="https://www.mitcnc.org/app/uploads/2020/08/mitangelsnorcal.png"
                         style="width:1.5rem;margin-bottom:0.3em" alt="MIT Angels">
                    &nbsp;&nbsp;&nbsp; MIT Angels of Northern California
                </span>
            </a>
            
            <br><br>
            
            
        </div>
    </article>

    <article class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-15">
                    <div class="row">
                        <div class="volunteer">
                            <div class="row">
                                <div class="col-sm-24">
                                    <h2 ><a href="<?php echo esc_url(get_permalink(251)); ?>">Stay up to date on startup events</a></h2>
                                </div>
                            </div>
                            <div class="row get-involved-cards">
                                <div class="col-sm-24">
                                    <h6>I’m a:</h6>
                                    <form action="">
                                        <div class="row">
                                            <div class="col-sm-24">
                                                <div class="form-group">
                                                    <div class="form-list">
                                                        <input type="radio" name="ima" value="Founder" id="Founder">
                                                        <label for="Founder">Founder</label>
                                                    </div>
                                                    
                                                    <div class="form-list">
                                                        <input type="radio" value="investor" name="ima" id="investor">
                                                        <label for="investor">Investor</label>
                                                    </div>
                                                    
                                                    <div class="form-list">
                                                        <input type="radio" value="other" name="ima" id="other"> 
                                                        <label for="other">Other</label>
                                                    </div>
                                                    
                                                    <div class="form-list" id="other-field" style="display:none;">
                                                        <input class="form-control ext-w" type="text" name="other" id="" placeholder="Please Specify"> 
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-sm-24">
                                                <div class="form-list">
                                                    <input class="form-control ext-w" type="text" name="name" id="Name" placeholder="Name"> 
                                                </div>
                                                
                                                <div class="form-list">
                                                    <input class="form-control ext-w" type="text" name="email" id="Email" placeholder="Email"> 
                                                </div>
                                                
                                                <div class="form-list">
                                                    <button type="submit" class="submit-btn">Submit</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </article>
    
    <?php if (!empty($volunteers)) { ?>
    <article class="speaker-list">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <h2>Volunteers</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p class="">
                        Check out some of the active volunteers on the startup track:
                    </p>
                </div>
            </div>
            <?php
            get_template_part('template-parts/content', 'speaker-container', array('speaker_ids' => wp_list_pluck($volunteers, 'ID')));
            ?>
        </div>
    </article>
    <?php } ?>
    
    <article class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-15">
                    <div class="row">
                        <div class="volunteer">
                            <div class="row">
                                <div class="col-sm-24">
                                    <h2 ><a href="<?php echo esc_url(get_permalink(251)); ?>">
                                            Get Involved
                                    </a></h2>
                                </div>
                            </div>
                            <?php get_template_part('template-parts/content', 'get-involved-cards'); ?>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </article>
    <?php if (!empty($speakers)) { ?>
    <article class="speaker-list" >
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <h2><a href="<?php echo esc_url(get_permalink(203)); ?>">Speakers</a></h2>
                </div>
                
            </div>
            <div class="row">
                <div class="col-sm-16">
                    <p class="">We are gathering the world's leading and most inspired thinkers from multiple disciplines to inspire your organization to build real-world solutions.</p>
                </div>
            </div> 
            <div class="row users_list">
                
                <div class="col-lg-6 col-md-12" data-team_member="cowboy ventures kleiner perkins caufield & byers  aileen lee">
                    <div class="speaker-card">
                        <a href="https://www.mitcnc.org/aileenlee/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2018/10/aileen-lee-e1544599857678.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Aileen  Lee</h3>
                                    <span
                                        class="code">SB '92</span>
                                </div>
                                <div
                                    class="company-name ">
                                    <h4>Cowboy Ventures</h4>
                                    <span>Founder & Managing Partner</span>
                                </div>
                                
                                <div class="border-dotted"></div>
                                
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://twitter.com/aileenlee" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/tw.svg" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/in/aileenwlee/" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12" data-team_member="color genomics pinterest esi group  othman laraki">
                    <div class="speaker-card">
                        <a href="https://www.mitcnc.org/othmanlaraki/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2018/11/Othman-Laraki.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Othman  Laraki</h3>
                                    <span
                                        class="code">SM '04, </span>
                                </div>
                                <div
                                    class="company-name ">
                                    <h4>Color Genomics</h4>
                                    <span> CEO & Co-Founder</span>
                                </div>
                                
                                <div class="border-dotted"></div>
                                
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://twitter.com/othman?lang=en" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/tw.svg" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/in/othmanlaraki/" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12" data-team_member="stripe  patrick collison">
                    <div class="speaker-card">
                        <a href="https://www.mitcnc.org/patrickcollison/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2019/04/Patrick-Collison.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Patrick Collison</h3>
                                    <span
                                        class="code"></span>
                                </div>
                                <div
                                    class="company-name ">
                                    <h4>Stripe</h4>
                                    <span>Founder & CEO</span>
                                </div>
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-12" data-team_member="ngp capital  rohini chakravarthy">
                    <div class="speaker-card">
                        <a href="https://www.mitcnc.org/rohinichakravarthy/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2020/07/Rohini-Chakravarthy.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Rohini Chakravarthy</h3>
                                    <span
                                        class="code">MBA '99</span>
                                </div>
                                <div
                                    class="company-name ">
                                    <h4>NGP Capital</h4>
                                    <span>Partner</span>
                                </div>
                                
                                <div class="border-dotted"></div>
                                
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://www.linkedin.com/in/rohinichakravarthy/" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12" data-team_member="ixledger  cristina dolan">
                    <div class="speaker-card">
                        <a href="https://www.mitcnc.org/cristinadolan/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2018/11/cristina-dolan-.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Cristina  Dolan</h3>
                                    <span
                                        class="code">SM '94</span>
                                </div>
                                <div
                                    class="company-name ">
                                    <h4>iXledger</h4>
                                    <span>Co-Founder & COO</span>
                                </div>
                                
                                <div class="border-dotted"></div>
                                
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://twitter.com/CristinaDolan" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/tw.svg" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/in/cdolan/" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>

                
                
                <div class="col-lg-6 col-md-12" data-team_member="general catalyst  hemant taneja">
                    <div class="speaker-card">
                        <a href="https://www.mitcnc.org/hemanttaneja/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2018/11/Hemant-Taneja.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Hemant Taneja</h3>
                                    <span
                                        class="code">SB '97, SM '99, MNG '99</span>
                                </div>
                                <div
                                    class="company-name ">
                                    <h4>General Catalyst</h4>
                                    <span>Managing Director</span>
                                </div>
                                
                                <div class="border-dotted"></div>
                                
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://twitter.com/htaneja?lang=en" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/tw.svg" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/in/hemanttaneja/" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12" data-team_member="openwater  mary lou jepsen">
                    <div class="speaker-card">
                        <a href="https://www.mitcnc.org/maryloujepsen/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2018/11/mary-lou-jepsen.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Mary  Lou Jepsen</h3>
                                    <span
                                        class="code">SM '89</span>
                                </div>
                                <div
                                    class="company-name ">
                                    <h4>Openwater</h4>
                                    <span> CEO and Founder</span>
                                </div>
                                
                                <div class="border-dotted"></div>
                                
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://twitter.com/mljmljmlj?lang=en" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/tw.svg" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/in/majepsen/" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-12" data-team_member="gfycat  richard rabbat">
                    <div class="speaker-card">
                        <a href="https://www.mitcnc.org/richardrabbat/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2018/11/Richard-Rabbat.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Richard  Rabbat</h3>
                                    <span
                                        class="code">PhD '01, SM '98</span>
                                </div>
                                <div
                                    class="company-name ">
                                    <h4>Gfycat</h4>
                                    <span>Co-Founder & CEO</span>
                                </div>
                                
                                <div class="border-dotted"></div>
                                
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://twitter.com/richardrabbat?lang=en" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/tw.svg" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/in/richard-rabbat-42ba" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12" data-team_member="foundation capital tubi tv  tonkean  joanne chen">
                    <div class="speaker-card">
                        <a href="https://www.mitcnc.org/joannechen/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2018/11/Joanne-Chen-2.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Joanne  Chen</h3>
                                    <span
                                        class="code"></span>
                                </div>
                                <div
                                    class="company-name ">
                                    <h4>Foundation capital</h4>
                                    <span>Partner</span>
                                </div>
                                
                                <div class="border-dotted"></div>
                                
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://twitter.com/joannezchen?lang=en" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/tw.svg" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/in/joanne-chen-8486677/" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12" data-team_member="segment  industrial angel investors  peter reinhardt ">
                    <div class="speaker-card">
                        <a href="https://www.mitcnc.org/peter/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2018/12/Peter-Reinhardt-1.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Peter  Reinhardt </h3>
                                    <span
                                        class="code">BS' 11</span>
                                </div>
                                <div
                                    class="company-name ">
                                    <h4>Segment</h4>
                                    <span>Co-Founder & CEO</span>
                                </div>
                                
                                <div class="border-dotted"></div>
                                
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://twitter.com/reinpk?lang=en" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/tw.svg" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/in/peterreinhardt/" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12" data-team_member="transposit sutter hill ventures  winnie  tina huang">
                    <div class="speaker-card">
                        <a href="https://www.mitcnc.org/tina-huang/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2018/12/Tina-Huang.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Tina Huang</h3>
                                    <span
                                        class="code">BS ' 01  EECS ' 01</span>
                                </div>
                                <div
                                    class="company-name ">
                                    <h4>Transposit</h4>
                                    <span>Co-Founder & CTO</span>
                                </div>
                                
                                <div class="border-dotted"></div>
                                
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://www.linkedin.com/in/tinahuang2/" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                
                
                <div class="col-lg-6 col-md-12" data-team_member="cruise automation twitch  justin.tv, inc.  kyle vogt">
                    <div class="speaker-card">
                        <a href="https://www.mitcnc.org/kylevogt/">
                            <div class="card-img">
                                <img src="https://www.mitcnc.org/app/uploads/2019/09/KV.png" alt="">
                                <div class="icon-mit">
                                    <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/mit-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3>Kyle Vogt</h3>
                                    <span
                                        class="code">SB  ' 08</span>
                                </div>
                                <div
                                    class="company-name ">
                                    <h4>Cruise Automation</h4>
                                    <span>CTO</span>
                                </div>
                                
                                <div class="border-dotted"></div>
                                
                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://twitter.com/kvogt?lang=en" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/tw.svg" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/in/kylevogt/" target="_blank">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/in.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <?php } ?>
    <article>
        <div class="container">
            <?php get_template_part('template-parts/content', 'join-footer'); ?>
        </div>
    </article>
</section>
<?php get_footer(); ?>


   
