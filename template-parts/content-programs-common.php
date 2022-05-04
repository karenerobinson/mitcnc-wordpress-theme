<?php
    global $assets_uri,
           $post,
           $speaker_col,
           $event_loop_cols,
           $event_program_taxonomy,
           $past_events,
           $speakers,
           $leaders,
           $contact_persons,
           $speakers_page_id,
           $upcoming_events,
           $event_listing_page_id,
           $leadership_team_page_id;
    $past_events = $speakers = $leaders = $contact_persons = $upcoming_events = $media_gallery = null;
    $event_loop_cols = 12;
    $speaker_col = 8;
    $event_program_term_id = get_field('programs_list', $post->ID);
    if($event_program_term_id != null && !empty($event_program_term_id)){
        $past_events = get_events(-1,null,null,[$event_program_term_id],null,true);
        $upcoming_events = get_events(-1, null, null, [$event_program_term_id]);
    }
    // GET SPEAKERS
    $speakers_by_page = get_field('speakers_list', $event_program_taxonomy . '_' . $event_program_term_id);
    $speakers = null;
    if(is_array($speakers_by_page)){
        $speakers = get_users_by_type('speakers', '', false, '', false, 'ASC', $speakers_by_page);
    }
    // GET LEADERS
    $leaders_by_page = get_field('team_list', $event_program_taxonomy . '_' . $event_program_term_id);
    $leaders = null;
    if(is_array($leaders_by_page)){
        $leaders = get_users_by_type('leadership_team', '', false, '', false, 'ASC', $leaders_by_page);
    }
    // GET CONTACT PERSONS
    $contact_persons = get_field('contact_persons', $event_program_taxonomy . '_' . $event_program_term_id);
    // GET MEDIA GALLERY
    $media_gallery = get_media_gallery(-1, false, $event_program_term_id);
?>

<?php if($upcoming_events != null) { ?>
    <div class="row mt40">
        <div class="col-sm-12">
            <h2><a href="<?php echo get_permalink($event_listing_page_id).'?event_program='.$event_program_term_id; ?>">Upcoming Events</a></h2>
        </div>
    </div>
    <div class="row card-container">
        <div class="card-slider2 clearfix">
            <?php get_template_part('template-parts/content', 'events-loop'); ?>
        </div>
    </div>
<?php } ?>

<?php if($speakers != null){ ?>

    <div class="row">
        <div class="col-sm-24">
            <h2><a href="<?php echo get_permalink($speakers_page_id).'?program='.$event_program_term_id; ?>">Recent Speakers</a></h2>
            <p class="blue-text">We feature topics of greatest demonstrated alumni interest.  In most cases, we will explore both science & technology as well as policy & economics in order to maintain a pragmatic viewpoint.</p>
        </div>

    </div>
    <?php get_template_part('template-parts/content', 'speakers'); ?>

<?php } ?>

<?php $upcoming_events = $past_events; if($upcoming_events != null){ ?>
    <div class="row mt40">
        <div class="col-sm-24">
            <h2><a href="<?php echo get_permalink($event_listing_page_id).'?event_program='.$event_program_term_id.'&is_past=1'; ?>">Past Events</a></h2>
        </div>
    </div>
    <div class="row card-container">
        <div class="card-slider2 clearfix">
            <?php get_template_part('template-parts/content', 'events-loop'); ?>
        </div>
    </div>
<?php } ?>

<?php $speakers = $leaders; if($speakers != null){ ?>

    <div class="row mt40">
        <div class="col-sm-24">
            <h2><a href="<?php echo get_permalink($leadership_team_page_id).'?program='.$event_program_term_id; ?>">Our Team</a></h2>
            <p class="blue-text">We feature topics of greatest demonstrated alumni interest.  In most cases, we will explore both science & technology as well as policy & economics in order to maintain a pragmatic viewpoint.</p>
        </div>

    </div>
    <?php get_template_part('template-parts/content', 'speakers'); ?>

<?php } ?>

<?php if($media_gallery != null){
    $photos = '';
    foreach ($media_gallery as $item) {
        if (!empty(strip_tags($item->post_content))) {
            $photos .= strip_tags($item->post_content);
        }
    }
    if(!empty($photos)){
        ?>
        <div class="row mt40">
            <div class="col-sm-24">
                <h2>Event Gallery</h2>
                <p class="blue-text">We believe that together technologists, innovators, entrepreneurs, industry leaders, researchers, developers, hackers, students and investors can help contribute in each others success.</p>
            </div>
        </div>
        <div class="row mt20 spotlight-gallery" id="gallery_wrapper">
            <?php
                echo do_shortcode($photos);
            ?>
        </div>
        <?php
    }
    ?>

    <div class="row mt40">
        <div class="col-sm-24">
            <h2>Watch</h2>
            <p class="blue-text">Get a taste of the last year’s The Future of AI Conference experience with a few selected talks.</p>
        </div>
    </div>

    <div class="row mt20">
        <?php
            foreach ($media_gallery as $key => $gallery){
                if (have_rows('videos', $gallery->ID)) {
                    while (have_rows('videos', $gallery->ID)){
                        the_row();
                        $video_url = get_sub_field('url', $gallery->ID);
                        $video_thumbnail = get_sub_field('thumbnail', $gallery->ID);
                        ?>
                        <div class="col-sm-24 col-md-12">
                            <a data-fancybox="gallery-video" href="<?php echo $video_url; ?>" class="media-card video-card">
                                <div class="media-img">
                                    <img src="<?php echo $video_thumbnail; ?>" alt="">
                                </div>
                                <div class="media-content">
                                    <div class="media-icon-container">
                                        <img src="<?php echo $assets_uri; ?>/images/play-icon2.png" alt="">
                                    </div>

                                    <h5 class="heading_4 white-text">
                                        <span class="date"><?php echo date('D, M d, Y', strtotime($gallery->post_date)); ?></span>
                                        <?php echo $gallery->post_title; ?></h5>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                }
            }
        ?>

    </div>
    <div class="row">
        <div class="col-sm-24 ">
            <a href="#" class="default-btn mt15 red-btn mr15">See all Video</a>
        </div>
    </div>
<?php }?>

<?php if($contact_persons != null && !empty($contact_persons)){ ?>
    <div class="row mt40">
        <div class="col-sm-24">
            <div class="get-in-touch-section">
                <h4 class="large-text"><span>@</span>Get in Touch</h4>
                <div class="row">
                    <?php get_template_part('template-parts/content', 'contact-persons'); ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>