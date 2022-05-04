<?php
    /* Template Name: Full Width */
    get_header();
    global $post;
?>
    <style type="text/css">
        .yotu-column-4 li {
            width: calc(100%/4.2) !important;
        }
    </style>
    <section>
        <article class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-sm-24">
                        <?php echo filter_var(wpd_nav_menu_breadcrumbs('header_main'), FILTER_UNSAFE_RAW); ?>
                    </div>
                    <div class="col-sm-24">
                        <div class="row mb15">
                            <div class="col-sm-24">
                                <h1 class="heading_8"><?php echo esc_html($post->post_title); ?></h1>
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
                            <?php echo esc_html(wpautop(str_replace('<br>', '', get_field('block_content', $post->ID)))); ?>
                        </div>
                        <?php
                        if (get_field('show_common_section', $post->ID)) {
                            get_template_part('template-parts/content', 'programs-common');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </article>
    </section>
    <?php

    get_footer();
