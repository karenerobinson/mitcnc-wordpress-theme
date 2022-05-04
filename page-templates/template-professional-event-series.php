<?php
     /* Template Name: Professional Event Series Page */
    get_header();
    global $assets_uri, $post;
    $block_content = get_field('block_content', $post->ID);
?>
    <section>
        <article class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-sm-24">
                        <?php get_breadcrumb(); ?>
                    </div>
                    <div class="col-sm-17">
                        <div class="row mb15">
                            <div class="col-sm-24">
                                <h1 class="heading_8"><?php echo $post->post_title; ?></h1>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-sm-24">
                                <div class="feature-images-sec">
                                    <?php echo get_the_post_thumbnail($post->ID, 'thumbnail_1079_474'); ?>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="row mt40">
                            <div class="col-sm-24">
                                <?php echo wpautop($post->post_content); ?>
                            </div>
                        </div> -->
                        <!-- <div class="container--block-content">
                            <?php echo wpautop(str_replace('<br>', '', $block_content)); ?>
                        </div> -->

                        <div class="row ">

                            <div class="col-sm-24">
                                <h2 class="black-text bordered heading_1">Explore Trends &amp; Themes</h2>
                               <p>We feature topics of greatest demonstrated alumni interest. In most cases, we will explore emerging and frontier technologies from the perspective of ground breaking research, application of technology to transform industries, public policy and its impact, commercialization and financing.</p>
                            </div>
                            
                            <div class="row clearfix mt40">
                                <div class="col-lg-8 col-md-12">
                                    <div class="simple-box">
                                        <div class="img-box">
                                            <img src="<?php echo $assets_uri; ?>/images/icons/artificial-intelligence.svg" alt="" />
                                        </div>
                                        <h4>Artificial Intelligence</h4>
                                        AI, Machine Learning, Machine Vision, Smart Robots, Gesture Controls, NLP, Deep Learning
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-12">
                                    <div class="simple-box">
                                    <div class="img-box">
                                        <img src="<?php echo $assets_uri; ?>/images/icons/arvr.svg" alt="" />
                                    </div>
                                    <h4>AR / VR</h4>
                                   <p> Augment Reality, Virtual Reality, Human Machine Interaction</p>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-12">
                                    <div class="simple-box">
                                    <div class="img-box">
                                        <img src="<?php echo $assets_uri; ?>/images/icons/connected-devices.svg" alt="" />
                                    </div>
                                    <h4>Connected Devices</h4>
                                   <p> Smart Machines, Drones, Autonomous Agents and Things, Robotics</p>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-12">
                                    <div class="simple-box">
                                     <div class="img-box">
                                         <img src="<?php echo $assets_uri; ?>/images/icons/digital-health.svg" alt="" />
                                     </div>
                                    <h4>Digital Health</h4>
                                    <p>Wearables, Digital Fitness</p>
                                    </div>
                                </div>

                                <div class="col-lg-8 col-md-12">
                                    <div class="simple-box">
                                    <div class="img-box">
                                       <img src="<?php echo $assets_uri; ?>/images/icons/ed-tech.svg" alt="" /> 
                                    </div>
                                    <h4>Ed Tech</h4>
                                   <p> Digital Learning, Personalized learning, Gamification</p>
                                    </div>
                                </div>

                                <div class="col-lg-8 col-md-12">
                                    <div class="simple-box">
                                    <div class="img-box">
                                        <img src="<?php echo $assets_uri; ?>/images/icons/fin-tech.svg" alt="" />
                                    </div>
                                    <h4>Fin Tech</h4>
                                   <p> Cryptocurrency, Blockchain Technology, Digital Commerce, Digital Payments</p>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-12">
                                    <div class="simple-box height-big">
                                    <div class="img-box">
                                       <img src="<?php echo $assets_uri; ?>/images/icons/software-services.svg" alt="" /> 
                                    </div>
                                    <h4>Software &amp; Services</h4>
                                    <p>Enterprise, Consumer, Mobile, Social, SaaS</p>
                                    </div>
                                </div>

                                <div class="col-lg-8 col-md-12">
                                    <div class="simple-box height-big">
                                    <div class="img-box">
                                        <img src="<?php echo $assets_uri; ?>/images/icons/security.svg" alt="" /> 
                                    </div>
                                    <h4>Security</h4>
                                   <p> Cyber Security, Security Architecture, Vulnerability Exploits, Digital Identity Systems, Autonomous Hacking, Breaking Connected Devices and Vehicles</p>
                                    </div>
                                </div>
                                
                                <div class="col-lg-8 col-md-12">
                                   <div class="simple-box height-big">
                                    <div class="img-box">
                                        <img src="<?php echo $assets_uri; ?>/images/icons/compute.svg" alt="" />
                                    </div>
                                   <h4>Compute</h4>
                                  <p> Quantum Computing, Neuromorphic Computing, Biological Computing, Cloud Computing, Edge / Mesh Computing, Systems Architecture, Data Centers, Storage, Virtualization, Data Centers, DevOps, DevTools</p>

                                   </div>
                                </div>
                          
                            </div>

                             <p>For questions regarding the Tech Track, community building initiatives, event content, suggestions for future topics or if you are interested in volunteering, please contact us at <a href="mailto:volunteer@mitcnc.org">volunteer@mitcnc.org</a></p>
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