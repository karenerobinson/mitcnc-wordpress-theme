<?php
/* Template Name: Tech Track Page */
    get_header();
    global $assets_uri, $post, $program_tech_track, $event_program_taxonomy, $speaker_col;

    $media_gallery = get_media_gallery_for_videos(3);
    $media_gallery = get_media_gallery(3, false, 22);

?>
    <section >
        <article class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-sm-24">
                        <?php get_breadcrumb(); ?>
                    </div>
                    <div class="col-sm-17">
                        <div class="row mb15">
                            <div class="col-sm-24">
                                <h1><?php echo $post->post_title; ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                <div class="feature-images-sec">
                                    <?php echo get_the_post_thumbnail($post->ID, 'thumbnail_1079_474'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt40">
                            <div class="col-sm-24">
                                <h2>Mission</h2>
                                <p class="double-quotes">“</p>
                                <p>Produce unique experiences that brings together leaders and influencers in the MIT community who are at the forefront of solving world’s most challenging problems through creative applications of technologies.
<br><br>
Through events and community building initiatives, we hope to create an active network of MIT professionals in tech who leverage their time, talent, resources and connections to help each other. Our programs are OPEN TO ALL.</p>
                            </div>
                        </div>


                            <div class="row mt40">
                                <div class="col-sm-24">
                                    <h2>Watch</h2>
                                    <p class="blue-text">Get a taste of the last year’s The Future of AI Conference experience with a few selected talks.</p>
                                </div>
                            </div>

                            <div class="row mt20">
                                    <?php
                                     $i = 1;
                                        foreach ($media_gallery as $key => $gallery){
                                            if (have_rows('videos', $gallery->ID)) {
                                               
                                                while (have_rows('videos', $gallery->ID)){
                                                    the_row();
                                                    $video_url = get_sub_field('url', $gallery->ID);
                                                    $video_thumbnail = get_sub_field('thumbnail', $gallery->ID);
                                                    ?>
                                                    <div class="col-sm-12">
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
                                                    <?php $i++;
                                                    if ($i > 3) {
                                                        break;
                                                    }
                                                }
                                            }

                                            if ($i > 3) {
                                                break;
                                            }
                                        }
                                    ?>

                            </div>
                            <div class="row">
                                <div class="col-sm-24 ">
                                      <a href="#" class="default-btn mt15 red-btn mr15">See all Video</a>
                                </div>
                            </div>


                            <div class="row mt40">
                                <div class="col-sm-12 ">
                                    <h2>Explore Trends <br> & Themes</h2>
                                    <ul class="simple-list">
                                        <li>Artificial Intelligence</li>
                                        <li>AR / VR</li>
                                        <li>Connected Devices</li>
                                        <li> Digital Health</li>
                                        <li>Ed Tech</li>
                                        <li>Fin Tech</li>
                                        <li>Security</li>
                                        <li>Software & Services</li>
                                        <li>Compute</li>
                                    </ul>
                                    <a href="<?php echo  get_permalink(1241); ?>" class="view-btn gray">See All <img src="<?php echo $assets_uri; ?>/images/arrow_right_gray.svg" alt=""></a>
                                </div>

                                <div class="col-sm-12 ">
                                    <h2>Some of our <br> Programs</h2>
                                    <ul class="simple-list">
                                        <li> Shared Co-Working Spaces</li>
                                        <li> AskTIM - mailing list to ask questions</li>
                                        <li> AHackathons, workshops, demo days</li>
                                        <li>Faciliatated Introductions</li>
                                        <li>AI Connect </li>
                                        <li>AI Office Hours</li>
                                        <li>AI Idol</li>
                                        <li>Demo Days</li>
                                        <li>Career Mentoring</li>
                                    </ul>
                                    <a href="#" class="view-btn gray">See All <img src="<?php echo $assets_uri; ?>/images/arrow_right_gray.svg" alt=""></a>
                                </div>
                            </div>
                            <?php if($media_gallery != null){ ?>
                            <div class="row mt40">
                                <div class="col-sm-24">
                                    <h2>Event Gallery</h2>
                                    <p class="blue-text">We believe that together technologists, innovators, entrepreneurs, industry leaders, researchers, developers, hackers, students and investors can help contribute in each others success.</p>
                                </div>
                            </div>

                            <div class="row mt20 spotlight-gallery">
                               <?php
                                   $photos_found = false;
                                   foreach ($media_gallery as $item) {
                                       if (!empty(strip_tags($item->post_content))) {
                                           ?>
                                               
                                                   <?php echo do_shortcode(strip_tags($item->post_content)); ?>
                                          
                                           <?php
                                           $photos_found = true;
                                           break;
                                       }
                                   }?>

                            </div>
                            <?php }?>
                            <div class="row mt40">
                                <div class="col-sm-24">
                                   <div class="get-involved-box">
                                       <div class="left-box">
                                           <h2>Get Involved</h2>
                                           <h4>I want to:</h4>
                                           <ul>
                                               <li><a href="#">Volunteer</a></li>
                                               <li><a href="#">Sponsor</a></li>
                                               <li><a href="#">Mentor</a></li>
                                               <li><a href="#">Host</a></li>
                                           </ul>
                                       </div>
                                       <div class="right-box">
                                           <h2 class="mb30">Explore opportunities to be involved.</h2>
                                           <p>
                                             To get involved as Press or a Media Partner, please contact please contact Media Team.
                                           </p>

                                           <p>
                                               <a href="#" class="default-btn mt15 red-btn mr15">See all Speakers </a>
                                           </p>
                                           <p>
                                               <a href="#" class="default-btn mt15 red-btn-border">Recommend a Speaker </a>
                                           </p>

                                       </div>
                                   </div>
                                </div>
                              
                            </div>

                            <div class="row mt40">
                                <div class="col-sm-24">
                                    <h2>Get Connected</h2>
                                    <p class="blue-text">We've got an insanely smart group of folks who will discuss where they see the Future of AI and the opportunities that have them excited.</p>
                                </div>
                                <div class="col-sm-24">
                                    <img src="<?php echo $assets_uri; ?>/images/get-connected.png" alt="" class="img-responsive">
                                </div>
                            </div>



                            <div class="row mt40">
                                <div class="col-sm-24">
                                    <h2>Our Partners & Supporters</h2>
                                    <p class="blue-text">We've got an insanely smart group of folks who will discuss where they see the Future of AI and the opportunities that have them excited.</p>
                                </div>
                                <div class="col-sm-24">
                                    <img src="<?php echo $assets_uri; ?>/images/partner-supporters-logos.png" class="img-responsive" alt="">
                                </div>
                            </div>

                        <?php get_template_part('template-parts/content', 'programs-common'); ?>

                    </div>
                    <div class="col-sm-6 offset-sm-1">
                        <?php get_sidebar(); ?> 
                    </div>
                </div>

            </div>
        </article>
    </section>
<?php get_footer(); ?>


   