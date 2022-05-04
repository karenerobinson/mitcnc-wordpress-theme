<?php
/* Template Name: Google Photos */
get_header();
global $assets_uri, $post, $frequently_asked_questions_page_id;
$block_content = get_field('block_content', $post->ID);
$is_show_sidebar = false;
?>
<style>
    .google-photos--container .grid {
        max-width: 100%;
    }

    .google-photos--container .grid figure {
        margin-bottom: 0;
    }

    .google-photos--container .grid figure img {
        width: 100%;
        height: auto;
        border-radius: 5px;
    }

    .grid.js-masonry {
        width: 100% !important;
        margin: 0;
    }

    .google-photos--container .grid .thumbnail a {
        display: block;
    }

    .google-photos--container .grid .thumbnail {
        border-radius: 5px;
    }

    .google-photos--container .grid .thumbnail .details {
        padding: 5px;
    }

    .google-photos--container .grid .thumbnail .details ul, .google-photos--container .grid .thumbnail .details li {
        padding-left: 0;
    }
</style>
<section>
    <article class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <?php get_breadcrumb(); ?>
                </div>
                <div class="col-sm-<?php echo $is_show_sidebar ? '17' : '24'; ?>">
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
                <?php if ($is_show_sidebar) { ?>
                    <div class="col-sm-6 offset-sm-1">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </article>
</section>
<?php get_footer(); ?>
