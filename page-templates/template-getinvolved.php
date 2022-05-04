<?php
    /* Template Name: Get Involved Page */
    get_header();
    global $assets_uri, $post;
    $block_content = get_field('block_content', $post->ID);

?>
    <section>
        <article class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-sm-24">
                        <?php get_breadcrumb();?>
                    </div>
                    <div class="col-sm-17">
                        <div class="row mb15">
                            <div class="col-sm-24">
                                <h1 class="heading_8"><?php echo $post->post_title; ?></h1>
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
                                <?php echo do_shortcode($post->post_content); ?>
                            </div>
                        </div>
                        <div class="container--block-content">
                            <?php echo wpautop(str_replace('<br>', '', $block_content)); ?>
                        </div>
                        <?php
if (get_field('show_common_section', $post->ID)) {
    get_template_part('template-parts/content', 'programs-common');
}
?>
                    </div>
                    <div class="col-sm-6 offset-sm-1">
                        <div class="get-inv-menu">
                            <h3>I WANT TO</h3>
                            <ul>
                                <li><a href="https://www.mitcnc.org/get-involved/volunteer/" >Volunteer</a></li>
                                <li><a href="https://www.mitcnc.org/get-involved/speaker/" >Speak</a></li>
                                <li><a href="https://www.mitcnc.org/get-involved/venue-eventspaces/" >Host</a></li>
                                <li><a href="https://www.mitcnc.org/get-involved/sponsor/" >Sponsor</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </article>
    </section>


<?php get_footer(); ?>