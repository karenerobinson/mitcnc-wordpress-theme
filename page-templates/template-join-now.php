<?php
    /* Template Name: Join now Page */
    get_header();
    global $post, $login_page_id;
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
                                <h1><?php echo esc_html($post->post_title); ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                <div class="feature-images-sec">
                                    <?php echo get_the_post_thumbnail($post->ID, 'thumbnail_1079_474'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt10">
                            <div class="col-sm-24">
                                <a href="<?php echo esc_url(get_membership_url()); ?>" class="event-footer-banner" style="margin-bottom: 30px;display: block; text-decoration: none;">
                                    <h2 class="white-text">Membership status</h2>
                                    <p>Click here to get your membership status, join the club, or renew your membership.</p>
                                </a>

                                Your dues are usually tax-deductible (check with your personal tax advisor to confirm).
                                <h6>Thank you for your support of MIT and for helping keep our local club strong!
                                We look forward to seeing you at club events this year.</h6>
                                Any questions, please contact us at <a href="mailto:memberships@mitcnc.org">memberships@mitcnc.org</a>.
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 offset-sm-1">
                        <?php get_sidebar(); ?> 
                    </div>
                </div>
            </div>
        </article>
    </section>
<?php get_footer(); ?>
