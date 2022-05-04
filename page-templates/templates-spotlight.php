<?php
    /* Template Name: Spotlight */
    get_header();
    global $assets_uri;
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
                    <div class="row">
                        <div class="col-sm-24 mb20">
                            <h1 class="heading_8 mt0"><?php echo $post->post_title; ?></h1>
                        </div>
                        <div class="col-sm-24 mb30">
                            <div class="spotlight-banner">
                            <img src="<?php echo $assets_uri; ?>/images/spotlight-banner.jpg" alt="">
                        </div>
                        </div>
                        <div class="col-sm-24">
                            <p>Spotlight is an MIT tradition that combines a gala sit-down dinner with a presentation from a distinguished MIT alum, or member of the MIT community, who has truly embodied the MIT spirit “Mens et Manus” and made unparalleled contributions to make a Better World.</p>
                            <p>In 2018, Spotlight just gets bigger, better, and more fun. Polish your brass rats and join us a memorable evening.</p>
                        </div>
                        <div class="col-sm-24">
                            <div class="blog-area">
                                <div class="volunteer">
                                    <div class="row">
                                        <div class="col-sm-24">
                                            <h2>Keynote Speaker</h2>
                                        </div>
                                    </div>
                                    <div class="row mt50">
                                        <div class="col-sm-8">
                                            <div class="vol-img">
                                                <img src="<?php echo $assets_uri; ?>/images/Patrick-Collison.png" alt="">
                                                <div class="icon-mit">
                                                    <img src="<?php echo $assets_uri; ?>/images/mit-icon.svg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-16">
                                            <div class="vol-info">
                                                <h4 class="heading_6">Patrick Collison</h4>
                                                <span class="tag vol-tag gray">CEO of Stripe</span>
                                                <p>Patrick Collison is the CEO of Stripe, an online payment processing platform, which he co-founded back in 2010. Stripe is a technology company that builds economic infrastructure for businesses every<br> size—from new startups to public companies—using software to accept payments and manage their businesses online.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-24">
                            <a href="https://www.mitcnc.org/events/spotlight-2019/" style="display: block;" class="mt50 mb20 img-responsive">
                                <img src="<?php echo $assets_uri; ?>/images/spotlight-visit.png" alt="">
                            </a>
                        </div>
                        <div class="col-sm-24">
                            <h2>Gallery</h2>
                            <p>We believe that together technologists, innovators, entrepreneurs, industry leaders, researchers, developers, hackers, students and investors can help contribute in each others success.</p>
                            <div class="spotlight-gallery">
                                <?php
                                $gallery_post = get_post(3047);
                                echo do_shortcode($gallery_post->post_content); ?>

                                <?php
                                $gallery_post = get_post(3073);
                                echo do_shortcode($gallery_post->post_content); ?>
                                
                            </div>
                            
                        </div>
                        <div class="col-sm-24">
                            <h2>Previous SpotLight Honorees</h2>
                            <?php echo do_shortcode('[spotlights]'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 offset-sm-1">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </article>
    <?php endwhile; endif; ?>
</section>
<?php get_footer();