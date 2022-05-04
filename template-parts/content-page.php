<?php
global $post, $aboutus_page_id, $club_history_page_id, $speaker_awards_page_id;
$thumbnail_in_bottom = isset($args['thumbnail_in_bottom']) ? $args['thumbnail_in_bottom'] : false;
?>
<section>
    <article class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <?php echo filter_var(wpd_nav_menu_breadcrumbs('header_main'), FILTER_UNSAFE_RAW); ?>
                </div>
                <div class="col-24 col-lg-17 col-md-17">
                    <div class="row mb15">
                        <div class="col-sm-24">
                            <h1 class="heading_8"><?php echo esc_html($post->post_title); ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-24">
                            <?php if (!$thumbnail_in_bottom) { ?>
                            <div class="feature-images-sec">
                                <?php echo get_the_post_thumbnail($post->ID, 'thumbnail_1079_474'); ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row mt10">
                        <div class="col-sm-24">
                            <?php echo filter_var(wpautop(do_shortcode($post->post_content)), FILTER_UNSAFE_RAW); ?>
                        </div>
                    </div>
                    <?php if ($thumbnail_in_bottom) { ?>
                    <div class="row mt50">
                        <div class="col-sm-24">
                            <div class="feature-images-sec">
                                <?php echo get_the_post_thumbnail($post->ID, 'thumbnail_1079_474'); ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="container--block-content">
                        <?php echo esc_html(wpautop(str_replace('<br>', '', get_field('block_content', $post->ID)))); ?>
                    </div>
                    <?php
                    if (get_field('show_common_section', $post->ID)) {
                        get_template_part('template-parts/content', 'programs-common');
                    }
                    ?>
                </div>
                <div class="col-sm-6 offset-sm-1">
                    <?php
                        // sidebar menu will display only if parent page is about us
                    if (isset($post->post_parent) && in_array($post->post_parent, array($aboutus_page_id, $club_history_page_id, $speaker_awards_page_id))) {
                        get_sidebar();
                    }
                    ?>
                </div>
            </div>
        </div>
    </article>
</section>
