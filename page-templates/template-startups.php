<?php
/* Template Name:  Startups Page */
get_header();
global $assets_uri, $post;

$program_id = get_field('program', $post->ID);
$featured_image = get_the_post_thumbnail_url($post->ID);
?>
    <section>
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
                                <?php if (!empty($featured_image)) { ?>
                                <div class="feature-images-sec">
                                    <img width="792" height="298" src="<?php echo esc_url($featured_image); ?>" class="attachment-thumbnail_1079_474 size-thumbnail_1079_474 wp-post-image" />
                                </div>
                                <?php } ?>
                                <p style=" margin-top: 20px;"><?php echo filter_var(wpautop($post->post_content), FILTER_UNSAFE_RAW); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <?php
        if (get_field('show_upcoming_events', $post->ID)) {
            get_template_part(
                'template-parts/content',
                'upcoming-events',
                array(
                    'events' => get_events(
                    // TODO Reactivate this sniff once PHPCS supports PHP 8.x named arguments
                    // phpcs:ignore Generic.PHP.Syntax.PHPSyntax
                        limit: -1,
                        event_programs: array($program_id)
                    ),
                    'show_see_all_button' => false
                )
            );
        }
        ?>
        <?php if (get_field('show_resources', $post->ID)) { ?>
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
        <?php } ?>
        <?php if (get_field('show_airtable_form', $post->ID)) { ?>
            <article class="blog-area">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-15">
                            <div class="row">
                                <div class="volunteer">
                                    <div class="row get-involved-cards">
                                        <div class="col-sm-24">
                                            <script src="https://static.airtable.com/js/embed/embed_snippet_v1.js"></script><iframe class="airtable-embed airtable-dynamic-height" src="https://airtable.com/embed/shrejzhha4WQCTD2G?backgroundColor=red" frameborder="0" onmousewheel="" width="100%" height="771" style="background: transparent; border: 1px solid #ccc;"></iframe>                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        <?php } ?>
        <?php if (get_field('show_volunteers', $post->ID)) { ?>
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
                    <?php get_template_part('template-parts/content', 'speaker-container', array('speaker_ids' => get_field('volunteers', $post->ID))); ?>
                </div>
            </article>
        <?php } ?>
        <?php if (get_field('show_get_involved', $post->ID)) { ?>
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
        <?php } ?>
        <?php if (get_field('show_speakers', $post->ID)) { ?>
            <article class="speaker-list" >
                <div class="container">
                    <div class="row">
                        <div class="col-sm-24">
                            <h2><a href="<?php echo esc_url(get_permalink(203)); ?>">Speakers</a></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="">We are gathering the world's leading and most inspired thinkers from multiple disciplines to inspire your organization to build real-world solutions.</p>
                        </div>
                    </div> 
                    <?php get_template_part('template-parts/content', 'speaker-container', array('speaker_ids' => get_field('speakers_list', $post->ID))); ?>
                </div>
            </article>
        <?php } ?>
        <?php
        if (get_field('show_past_events', $post->ID)) {
            get_template_part(
                'template-parts/content',
                'upcoming-events',
                array(
                    'events' => get_events(
                    // TODO Reactivate this sniff once PHPCS supports PHP 8.x named arguments
                    // phpcs:ignore Generic.PHP.Syntax.PHPSyntax
                        limit: -1,
                        event_programs: array($program_id),
                        exclude: null,
                        show_past_events: true
                    ),
                    'show_see_all_button' => false,
                    'section_heading' => 'Past Events'
                )
            );
        }
        ?>
        <?php if (get_field('show_organizers', $post->ID)) { ?>
            <article class="speaker-list" >
                <div class="container">
                    <div class="row">
                        <div class="col-sm-24">
                            <h2><a href="<?php echo esc_url(get_permalink(203)); ?>">Organizers</a></h2>
                        </div>
                    </div>
                    <?php get_template_part('template-parts/content', 'speaker-container', array('speaker_ids' => get_field('organizers_list', $post->ID))); ?>
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


   
