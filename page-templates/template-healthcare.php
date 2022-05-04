<?php
    /* Template Name: Healthcare Page */
    get_header();
    global $assets_uri, $program_healthcare, $event_program_taxonomy;

?>
    <section>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="inner-page">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-24">
                            <?php get_breadcrumb(); ?>
                        </div>
                        <div class="col-sm-17">
                            <div class="row mb15">
                                <div class="col-sm-24">
                                    <h1 class="heading_8"><?php the_title(); ?></h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-24">
                                    <div class="feature-images-sec">
                                        <?php if ( has_post_thumbnail() ) {
                                            the_post_thumbnail();
                                        }  ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt40">
                                <div class="col-sm-24">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                            <div class="row mt40">
                                <div class="col-sm-24">
                                    <div class="primary-topics ">
                                        <h2>Topics</h2>
                                        <p class="mt30 mb50">For 2014-2015, LSF will showcase technologies and innovations that will change <br> the fields of:</p>
                                        <div class="row">
                                             <div class="col-lg-8 col-md-12">
                                                <div class="simple-box">
                                                    <div class="img-box">
                                                        <img src="<?php echo $assets_uri; ?>/images/icons/personalized-medicine.svg" alt="">
                                                    </div>
                                                    <h4>Personalized medicine</h4>
                                                </div>
                                            </div>

                                             <div class="col-lg-8 col-md-12">
                                                <div class="simple-box">
                                                    <div class="img-box">
                                                        <img src="<?php echo $assets_uri; ?>/images/icons/genomics.svg" alt="">
                                                    </div>
                                                    <h4>Genomics</h4>
                                                </div>
                                            </div>

                                             <div class="col-lg-8 col-md-12">
                                                <div class="simple-box">
                                                    <div class="img-box">
                                                        <img src="<?php echo $assets_uri; ?>/images/icons/bioinformatics.svg" alt="">
                                                    </div>
                                                    <h4>Bioinformatics</h4>
                                                </div>
                                            </div>

                                             <div class="col-lg-8 col-md-12">
                                                <div class="simple-box">
                                                    <div class="img-box">
                                                        <img src="<?php echo $assets_uri; ?>/images/icons/digital-health.svg" alt="">
                                                    </div>
                                                    <h4>Digital health</h4>
                                                </div>
                                            </div>

                                             <div class="col-lg-8 col-md-12">
                                                <div class="simple-box">
                                                    <div class="img-box">
                                                        <img src="<?php echo $assets_uri; ?>/images/icons/microfluidics.svg" alt="">
                                                    </div>
                                                    <h4>Microfluidics</h4>
                                                </div>
                                            </div>

                                            

                                             <div class="col-lg-8 col-md-12">
                                                <div class="simple-box">
                                                    <div class="img-box">
                                                        <img src="<?php echo $assets_uri; ?>/images/icons/tissue-engineering.svg" alt="">
                                                    </div>
                                                    <h4>Tissue engineering</h4>
                                                </div>
                                            </div>

                                             <div class="col-lg-8 col-md-12">
                                                <div class="simple-box">
                                                    <div class="img-box">
                                                        <img src="<?php echo $assets_uri; ?>/images/icons/synthetic-biology.svg" alt="">
                                                    </div>
                                                    <h4>Synthetic biology</h4>
                                                </div>
                                            </div>

                                             <div class="col-lg-8 col-md-12">
                                                <div class="simple-box">
                                                    <div class="img-box">
                                                        <img src="<?php echo $assets_uri; ?>/images/icons/health-care-economics-and-policy.svg" alt="">
                                                    </div>
                                                    <h4>Health care economics and policy</h4>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt40">
                                <div class="col-sm-24">
                                    <p class="text-center">For questions regarding event content, suggestions for future topics, or if you are interested in volunteering, please contact Nelson Lin at <a href="mailto:lsf@mitcnc.org">lsf@mitcnc.org</a>  and join our <a href="http://www.linkedin.com/groups/MIT-Club-Northern-California-Life-5064727/about">MIT Club of Northern California Life Sciences Network</a>
 on LinkedIn.</p>
                                </div>
                            </div>

                            
<div class="row mt40">
                                <div class="col-sm-24">
                                        <h2 class="black-text">Steering Committee</h2>
                                    <div class="steering-committee">
                                        <ul>
                                            <li><h5>Nelson Lin, PhD</h5></li>
                                            <li><h5>Kelley Liu, PhD</h5></li>
                                            <li><h5>William Murray</h5></li>
                                            <li><h5>Elizabeth Ng</h5></li>
                                            <li><h5>Geetha Rao, PhD</h5></li>
                                            <li><h5>Sooji Lee Rugh, MD</h5></li>
                                            <!-- <li>
                                                <div class="content">
                                                    <h5 class="mt0">Nelson Lin, PhD</h5>
                                                    <p>nelsonlin@abc.com</p>
                                                </div>
                                                <div class="social-link">
                                                    <a href="#"><img src="<?php echo $assets_uri; ?>/images/in.png" alt=""></a>
                                                    <a href="#"><img src="<?php echo $assets_uri; ?>/images/tw.png" alt=""></a>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="content">
                                                    <h5 class="mt0">Kelley Liu, PhD</h5>
                                                    <p>nelsonlin@abc.com</p>
                                                </div>
                                                <div class="social-link">
                                                    <a href="#"><img src="<?php echo $assets_uri; ?>/images/in.png" alt=""></a>
                                                    <a href="#"><img src="<?php echo $assets_uri; ?>/images/tw.png" alt=""></a>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="content">
                                                    <h5 class="mt0">William Murray</h5>
                                                    <p>nelsonlin@abc.com</p>
                                                </div>
                                                <div class="social-link">
                                                    <a href="#"><img src="<?php echo $assets_uri; ?>/images/in.png" alt=""></a>
                                                    <a href="#"><img src="<?php echo $assets_uri; ?>/images/tw.png" alt=""></a>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="content">
                                                    <h5 class="mt0">Elizabeth Ng</h5>
                                                    <p>nelsonlin@abc.com</p>
                                                </div>
                                                <div class="social-link">
                                                    <a href="#"><img src="<?php echo $assets_uri; ?>/images/in.png" alt=""></a>
                                                    <a href="#"><img src="<?php echo $assets_uri; ?>/images/tw.png" alt=""></a>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="content">
                                                    <h5 class="mt0">Geetha Rao, PhD</h5>
                                                    <p>nelsonlin@abc.com</p>
                                                </div>
                                                <div class="social-link">
                                                    <a href="#"><img src="<?php echo $assets_uri; ?>/images/in.png" alt=""></a>
                                                    <a href="#"><img src="<?php echo $assets_uri; ?>/images/tw.png" alt=""></a>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="content">
                                                    <h5 class="mt0">Sooji Lee Rugh, MD</h5>
                                                    <p>nelsonlin@abc.com</p>
                                                </div>
                                                <div class="social-link">
                                                    <a href="#"><img src="<?php echo $assets_uri; ?>/images/in.png" alt=""></a>
                                                    <a href="#"><img src="<?php echo $assets_uri; ?>/images/tw.png" alt=""></a>
                                                </div>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row mt40">
                                <div class="col-sm-24">
                                    <h2>Past Events</h2>
                                </div>
                                <div class="col-sm-24 mt20 ">
                                    <h4 class="heading_9"> <img src="<?php echo $assets_uri; ?>/images/chat-icon.png" alt="" class="pr10">Panel Discussions</h4>
                                </div>
                            </div>
                            <div class="row mt20">
                                <div class="col-md-12">
                                    <a href="https://vimeo.com/58134620" target="_blank" class="media-card">
                                        <div class="media-img">
                                           <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/58134620?color=ffffff&title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
                                            <div class="media-content">
                                                <div class="media-icon-container">
                                                    <img src="<?php echo $assets_uri; ?>/images/play-icon2.png" alt="">
                                                </div>
                                                <h6 class="white-text">Novel Devices and Tools <br> for Cancer Management</h6>
                                            </div>
                                        </div>
                                        
                                        <div class="text-content">
                                            <span class="date">January 23, 2013</span>
                                            <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt="">Prof. Michael Cima</h6>
                                            <p>MIT</p>

                                             <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt="">Dr. Kevin Knopf</h6>
                                            <p>California Pacific Medical Center</p>


                                             <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt="">Frederick Middleton</h6>
                                            <p>Managing Director at Sanderling Venture</p>

                                             <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt=""> Wendy Hutton</h6>
                                            <p>General Partner at Canaan Partners</p>
                                            
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-12">
                                    <a href="#" class="media-card">
                                        <div class="media-img">
                                            <img src="<?php echo $assets_uri; ?>/images/media-1.jpg" alt="">
                                            <div class="media-content">
                                                <div class="media-icon-container">
                                                    <img src="<?php echo $assets_uri; ?>/images/play-icon2.png" alt="">
                                                </div>
                                                <h6 class="white-text">Phones, Sensors and Textiles: Can Wearable Computing Change Healthcare</h6>
                                            </div>
                                        </div>
                                        
                                        <div class="text-content">
                                            <span class="date">December 11, 2012</span>
                                            <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt="">Sonny Vu, Founder</h6>
                                            <p> CEO of Misfit Wearables</p>

                                             <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt="">Julia Hu</h6>
                                            <p>Founder and CEO  of Lark</p>


                                             <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt="">Amar Kendale</h6>
                                            <p>VP of Strategy at MC10</p>

                                             <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt=""> Dirk Lammerts</h6>
                                            <p>Managing Director of Burrill & Co</p>

                                            <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt=""> Alexander Grey</h6>
                                            <p>Founder and CEO of Somaxis</p>

                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-12">
                                    <a href="#" class="media-card">
                                        <div class="media-img">
                                            <img src="<?php echo $assets_uri; ?>/images/media-1.jpg" alt="">
                                            <div class="media-content">
                                                <div class="media-icon-container">
                                                    <img src="<?php echo $assets_uri; ?>/images/play-icon2.png" alt="">
                                                </div>
                                                <h6 class="white-text">Rewiring the Brain: Insights into Autism Spectrum Disorders</h6>
                                            </div>
                                        </div>
                                        
                                        <div class="text-content">
                                            <span class="date">November 1, 2012</span>
                                            <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt="">Prof. Mriganka Sur</h6>
                                            <p> MIT</p>

                                             <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt="">Prof. Randi Hagerman</h6>
                                            <p>UC Davis MIND Institute</p>


                                             <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt="">Prof. Robert Hendren</h6>
                                            <p>UCSF</p>

                                             <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt=""> Associate Prof. Antonio Hardan</h6>
                                            <p>Stanford</p>

                                            <h6><img src="<?php echo $assets_uri; ?>/images/check-red.svg" alt=""> Assistant Prof. Joachim Hallmayer</h6>
                                            <p>Stanford</p>

                                        </div>
                                    </a>
                                </div>

                                
                            </div>

                            <div class="row mt40">
                                <div class="col-sm-24">
                                    <h4 class="heading_9"> <img src="<?php echo $assets_uri; ?>/images/talk-icon.png" alt="" class="pr10">Talks/Presentations</h4>
                                </div>
                            </div>

                            <div class="row mt40">
                                <div class="col-sm-24">
                                    <ul class="event-list-style">
                                        <li>
                                            <a href="#">
                                                <span class="date-box">
                                                    <span class="num">17</span>
                                                    <span class="month">Oct 13</span>
                                                </span>
                                                <div class="content">
                                                    <h5 class="mt0">With/in/sight Lecture Series - Cancer Genetics and Precision Cancer Therapy</h5>
                                                    <p>Tyler Jacks, Director of MIT's Koch Institute of Integrative Cancer Research</p>
                                                    <span class="arrow">
                                                        <img src="<?php echo $assets_uri; ?>/images/arrow_right_gray.svg" alt="" height="12px">
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="date-box">
                                                    <span class="num">17</span>
                                                    <span class="month">Oct 13</span>
                                                </span>
                                                <div class="content">
                                                    <h5 class="mt0">WThe New Science of Radical Life Extension</h5>
                                                    <p>David Duncan</p>
                                                    <span class="arrow">
                                                        <img src="<?php echo $assets_uri; ?>/images/arrow_right_gray.svg" alt="" height="12px">
                                                    </span>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <span class="date-box">
                                                    <span class="num">23</span>
                                                    <span class="month">Sept 13</span>
                                                </span>
                                                <div class="content">
                                                    <h5 class="mt0">With/in/sight Lecture Series - Cancer Genetics and Precision Cancer Therapy</h5>
                                                    <p>Tyler Jacks, Director of MIT's Koch Institute of Integrative Cancer Research</p>
                                                    <span class="arrow">
                                                        <img src="<?php echo $assets_uri; ?>/images/arrow_right_gray.svg" alt="" height="12px">
                                                    </span>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <span class="date-box">
                                                    <span class="num">17</span>
                                                    <span class="month">Oct 13</span>
                                                </span>
                                                <div class="content">
                                                    <h5 class="mt0">With/in/sight Lecture Series - Cancer Genetics and Precision Cancer Therapy</h5>
                                                    <p>Tyler Jacks, Director of MIT's Koch Institute of Integrative Cancer Research</p>
                                                    <span class="arrow">
                                                        <img src="<?php echo $assets_uri; ?>/images/arrow_right_gray.svg" alt="" height="12px">
                                                    </span>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <span class="date-box">
                                                    <span class="num">17</span>
                                                    <span class="month">Oct 13</span>
                                                </span>
                                                <div class="content">
                                                    <h5 class="mt0">WESCAPE FIRE - The Fight to Rescue American Healthcare</h5>
                                                 <!--    <p>Tyler Jacks, Director of MIT's Koch Institute of Integrative Cancer Research</p> -->
                                                    <span class="arrow">
                                                        <img src="<?php echo $assets_uri; ?>/images/arrow_right_gray.svg" alt="" height="12px">
                                                    </span>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <span class="date-box">
                                                    <span class="num">23</span>
                                                    <span class="month">May 13</span>
                                                </span>
                                                <div class="content">
                                                    <h5 class="mt0">Healthy, Wealthy and Wise?  FAT Chance</h5>
                                                    <p>Dr. Robert Lustig, UCSF</p>
                                                    <span class="arrow">
                                                        <img src="<?php echo $assets_uri; ?>/images/arrow_right_gray.svg" alt="" height="12px">
                                                    </span>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <span class="date-box">
                                                    <span class="num">13</span>
                                                    <span class="month">Mar 13</span>
                                                </span>
                                                <div class="content">
                                                    <h5 class="mt0">HCan Financial Engineering Cure Cancer?</h5>
                                                    <p>Prof. Andrew Lo, MIT </p>
                                                    <span class="arrow">
                                                        <img src="<?php echo $assets_uri; ?>/images/arrow_right_gray.svg" alt="" height="12px">
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <a href="#" class="view-btn gray mt15 mb30">View More <img src="<?php echo $assets_uri; ?>/images/arrow_right_red.svg" alt=""></a>
                                </div>
                            </div>

                            <div class="row mt50">
                                <div class="col-sm-24">
                                    <h4 class="heading_9"> <img src="<?php echo $assets_uri; ?>/images/talk-icon.png" alt="" class="pr10">Lectures/Tours</h4>
                                </div>
                            </div>

                            <div class="row mt20">
                                <div class="col-md-12">
                                    <a href="#" class="media-card">
                                        <div class="media-img">
                                            <img src="<?php echo $assets_uri; ?>/images/media-1.jpg" alt="">
                                        </div>
                                        <div class="media-content">
                                            <div class="media-icon-container">
                                                <img src="<?php echo $assets_uri; ?>/images/play-icon2.png" alt="">
                                            </div>
                                            <h6 class="white-text">"The Future" of AI <br> Kids Day 2018</h6>
                                        </div>
                                        
                                    </a>
                                </div>

                                <div class="col-md-12">
                                    <a href="#" class="media-card">
                                        <div class="media-img">
                                            <img src="<?php echo $assets_uri; ?>/images/media-1.jpg" alt="">
                                        </div>
                                        <div class="media-content">
                                            <div class="media-icon-container">
                                                <img src="<?php echo $assets_uri; ?>/images/play-icon2.png" alt="">
                                            </div>
                                            <h6 class="white-text">"The Future" of AI <br> Kids Day 2018</h6>
                                        </div>
                                        
                                    </a>
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
        <?php endwhile; endif; ?>
    </section>


<?php get_footer(); ?>