<?php
    global $assets_uri, $speakers, $user_profile_page_id, $post, $speakers_ids, $moderators, $moderators_ids, $speaker_col, $specific_event;
if (true !== $specific_event) {
    echo '<div class="row speaker-container">';
}

if (is_singular('events')) {
    if (null != $moderators) {
        if (empty($moderators_ids)) {
            $moderators_ids = array();
            foreach ($moderators as $moderator) {
                $moderators_ids[] = $moderator->ID;
            }
            $moderators_ids = implode(',', $moderators_ids);
        }
        foreach ($moderators as $moderator) {
            $moderator_img = get_field('profile_image', 'user_' . $moderator->ID);
            $moderator_img = !empty($moderator_img) ? $moderator_img : $assets_uri . '/images/placeholder.png';
            $moderator_mit_status = is_mit_alum($moderator->ID);
            $moderator_first_name = get_field('full_name', 'user_' . $moderator->ID);
            $moderator_last_name = get_field('user_last_name', 'user_' . $moderator->ID);
            $designations = array();
            if (have_rows('designations', 'user_' . $moderator->ID)) {
                while (have_rows('designations', 'user_' . $moderator->ID)) {
                    the_row();
                    $designations[] = get_sub_field('designation_title', 'user_' . $moderator->ID);
                }
            }
            $teams = get_field('teams', 'user_' . $moderator->ID);
        
            $affiliations_mit = array();
            $affiliations_other = array();
            $affiliations = get_field('affiliations', 'user_' . $moderator->ID);
            if ($affiliations) {
                foreach ($affiliations as $affiliation) {
                    if (null != $affiliation) {
                        $affiliation_count = count($affiliation);
                        for ($i = 0; $i < $affiliation_count; $i++) {
                            if (isset($affiliation[$i]['mit_affiliation_title'])) :
                                $affiliations_mit[] = $affiliation[$i]['mit_affiliation_title'];
                            else :
                                if (isset($affiliation[$i]['other_affiliation_title'])) :
                                    $affiliations_other[] = $affiliation[$i]['other_affiliation_title'];
                                endif;
                            endif;
                        }
                    }
                }
            }
            $moderator_facebook = get_field('facebook', 'user_' . $moderator->ID);
            $moderator_twitter = get_field('twitter', 'user_' . $moderator->ID);
            $moderator_linkedin = get_field('linkedin', 'user_' . $moderator->ID);
            if (!empty($moderator_first_name) || !empty($moderator_last_name)) {
                ?>
                <div data-team_member="<?php echo esc_html(strtolower(str_replace(array("'", '  '), array('', ' '), $moderator_first_name . ' ' . $moderator_last_name))); ?>" class="col-12 col-lg-<?php echo esc_attr($speaker_col); ?> col-md-12">
                    <div class="speaker-card">
                        <a href="<?php echo esc_url(get_author_posts_url($moderator->ID)); ?>" class="speaker--click">
                            <form action="<?php echo esc_url(get_author_posts_url($moderator->ID)); ?>" method="post"><input type="hidden" name="through_back" value="<?php echo esc_html($post->ID); ?>" /></form>
                            <div class="card-img">
                                <img src="<?php echo esc_url($moderator_img); ?>" alt="">
                                <?php if ($moderator_mit_status) { ?>
                                    <div class="icon-mit">
                                        <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="card-text">
                                <div class="name">
                                    <h3><?php echo esc_html($moderator_first_name) . ' ' . esc_html($moderator_last_name); ?></h3>
                                    <span
                                        class="code"><?php echo esc_html((null != $affiliations_mit) ? implode(', ', $affiliations_mit) : ''); ?></span>
                                </div>
                                <div
                                    class="company-name <?php echo (empty($moderator_facebook) && empty($moderator_twitter) && empty($moderator_linkedin) && 0) ? 'no-border' : ''; ?>">
                                    <?php
                                    if (have_rows('positions', 'user_' . $moderator->ID)) {
                                        while (have_rows('positions', 'user_' . $moderator->ID)) {
                                            the_row();
                                            ?>
                                            <h4><?php the_sub_field('company', 'user_' . $moderator->ID); ?></h4>
                                            <span><?php the_sub_field('job_title', 'user_' . $moderator->ID); ?></span>
                                            <?php
                                            break;
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="border-dotted"></div>
                                <ul class="social-icons">
                                    <?php if (!empty($moderator_facebook)) { ?>
                                        <li>
                                            <a href="<?php echo esc_url($moderator_facebook); ?>">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/fb.svg" alt="">
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    if (!empty($moderator_twitter)) {
                                        ?>
                                        <li>
                                            <a href="<?php echo esc_url($moderator_twitter); ?>">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/tw.svg" alt="">
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if (!empty($moderator_linkedin)) {
                                        ?>
                                        <li>
                                            <a href="<?php echo esc_url($moderator_linkedin); ?>">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/in.svg" alt="">
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
            }
        }
    }
}
if (true !== $specific_event) {
    echo '</div>';
}
?>
