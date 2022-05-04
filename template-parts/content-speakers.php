<?php
    global $assets_uri,
        $speakers,
        $user_profile_page_id,
        $post,
        $speakers_ids,
        $moderators,
        $moderators_ids,
        $speaker_col,
        $specific_event,
        $speakers_view_in,
        $moderators_view_in,
        $organizers,
        $organizers_ids,
        $organizers_view_in;
if ($specific_event !== true) {
    echo '<div class="row speaker-container">';
}
if (
    null != $speakers &&
    (
        in_array($speakers_view_in, array('inside-page', 'both')) ||
        !isset($speakers_view_in) ||
        $speakers_view_in == null
    )
) {
    if (empty($speakers_ids)) {
        $speakers_ids = array();
        foreach ($speakers as $speaker) {
            $speakers_ids[] = $speaker->ID;
        }
        $speakers_ids = implode(',', $speakers_ids);
    }
    foreach ($speakers as $speaker) {
        $speaker_img = get_field('profile_image', 'user_' . $speaker->ID);
        $speaker_img = !empty($speaker_img) ? $speaker_img : $assets_uri . '/images/placeholder.png';
        $speaker_mit_status = is_mit_alum($speaker->ID);
        $speaker_first_name = get_field('full_name', 'user_' . $speaker->ID);
        $speaker_last_name = get_field('user_last_name', 'user_' . $speaker->ID);
        $designations = array();
        if (have_rows('designations', 'user_' . $speaker->ID)) {
            while (have_rows('designations', 'user_' . $speaker->ID)) {
                the_row();
                $designations[] = get_sub_field('designation_title', 'user_' . $speaker->ID);
            }
        }
        $teams = get_field('teams', 'user_' . $speaker->ID);
        $affiliations_mit = array();
        $affiliations_other = array();
        $affiliations = get_field('affiliations', 'user_' . $speaker->ID);
        if ($affiliations) {
            foreach ($affiliations as $affiliation) {
                if (null != $affiliation) {
                    $affiliation_count = count($affiliation);
                    for ($i = 0; $i < $affiliation_count; $i++) {
                        if (isset($affiliation[$i]['mit_affiliation_title'])) {
                            $affiliations_mit[] = $affiliation[$i]['mit_affiliation_title'];
                        } else if (isset($affiliation[$i]['other_affiliation_title'])) {
                            $affiliations_other[] = $affiliation[$i]['other_affiliation_title'];
                        }
                    }
                }
            }
        }
        $speaker_facebook = get_field('facebook', 'user_' . $speaker->ID);
        $speaker_twitter = get_field('twitter', 'user_' . $speaker->ID);
        $speaker_linkedin = get_field('linkedin', 'user_' . $speaker->ID);

        // Topics
        $array_topics  = get_field('event_topics', 'user_' . $speaker->ID);
        $topics = '';

        if ($array_topics != null) {
            foreach ($array_topics as $topic) {
                $topics .= ' ' . $topic;
            }
        }


        if (!empty($speaker_first_name) || !empty($speaker_last_name)) {
            ?>
                    <div data-team_member="<?php echo esc_html(strtolower(str_replace(array("'", '  '), array('', ' '), $speaker_first_name . ' ' . $speaker_last_name))); ?>" data-topic="<?php echo esc_html($topics); ?>"class="col-12 col-lg-<?php echo esc_attr($speaker_col); ?> col-md-12">
                        <div class="speaker-card">
                            <a href="<?php echo esc_url(get_author_posts_url($speaker->ID)); ?>" class="speaker--click">
                                <form action="<?php echo esc_url(get_author_posts_url($speaker->ID)); ?>" method="post"><input type="hidden" name="through_back" value="<?php echo esc_attr($post->ID); ?>" /></form>
                                <div class="card-img">
                                    <img src="<?php echo esc_url($speaker_img); ?>" alt="">
                            <?php if ($speaker_mit_status) { ?>
                                        <div class="icon-mit">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                        </div>
                            <?php } ?>
                                </div>
                                <div class="card-text">
                                    <div class="name">
                                        <h3><?php echo esc_html($speaker_first_name . ' ' . $speaker_last_name); ?></h3>
                                        <span class="code"><?php echo esc_html(($affiliations_mit != null) ? implode(', ', $affiliations_mit) : ''); ?></span>
                                    </div>
                            <?php if (have_rows('positions', 'user_' . $speaker->ID)) { ?>
                                        <div class="company-name <?php echo (empty($speaker_facebook) && empty($speaker_twitter) && empty($speaker_linkedin) && 0) ? 'no-border' : ''; ?>">
                                            <?php
                                            if (have_rows('positions', 'user_' . $speaker->ID)) {
                                                while (have_rows('positions', 'user_' . $speaker->ID)) {
                                                    the_row();
                                                    ?>
                                                    <h4><?php the_sub_field('company', 'user_' . $speaker->ID); ?></h4>
                                                    <span><?php the_sub_field('job_title', 'user_' . $speaker->ID); ?></span>
                                                    <?php
                                                    break;
                                                }
                                            }
                                            ?>

                                        </div>
                            <?php } ?>
                                    <?php if (!empty($speaker_facebook) || !empty($speaker_twitter) || !empty($speaker_linkedin)) { ?>
                                        <div class="border-dotted"></div>

                                    <?php } ?>
                                    <ul class="social-icons">
                                        <?php if (!empty($speaker_facebook)) { ?>
                                            <li>
                                                <a href="<?php echo esc_url($speaker_facebook); ?>" target="_blank">
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/fb.svg" alt="">
                                                </a>
                                            </li>
                                        <?php } if (!empty($speaker_twitter)) { ?>
                                            <li>
                                                <a href="<?php echo esc_url($speaker_twitter); ?>" target="_blank">
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/tw.svg" alt="">
                                                </a>
                                            </li>
                                        <?php } if (!empty($speaker_linkedin)) { ?>
                                            <li>
                                                <a href="<?php echo esc_url($speaker_linkedin); ?>" target="_blank">
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
if (is_singular('events')) {
    if (null != $moderators && in_array($moderators_view_in, array('inside-page', 'both'))) {
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
                    if ($affiliation != null) {
                        $affiliation_count = count($affiliation);
                        for ($i = 0; $i < $affiliation_count; $i++) {
                            if (isset($affiliation[$i]['mit_affiliation_title'])) {
                                $affiliations_mit[] = $affiliation[$i]['mit_affiliation_title'];
                            } else if (isset($affiliation[$i]['other_affiliation_title'])) {
                                $affiliations_other[] = $affiliation[$i]['other_affiliation_title'];
                            }
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
                                    <form action="<?php echo esc_url(get_author_posts_url($moderator->ID)); ?>" method="post"><input type="hidden" name="through_back" value="<?php echo esc_attr($post->ID); ?>" /></form>
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
                                            <h3><?php echo esc_html($moderator_first_name . ' ' . $moderator_last_name); ?></h3>
                                            <span
                                                class="code"><?php echo esc_html(($affiliations_mit != null) ? implode(', ', $affiliations_mit) : ''); ?></span>
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
                                        <div class="tags-box">
                                            <span class="tag">Moderator</span>
                                        </div>
                                        <ul class="social-icons">
                                    <?php if (!empty($moderator_facebook)) { ?>
                                                <li>
                                                    <a href="<?php echo esc_url($moderator_facebook); ?>">
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/fb.svg" alt="">
                                                    </a>
                                                </li>
                                            <?php
                                    }
                                    if (!empty($moderator_twitter)) {
                                        ?>
                                                <li>
                                                    <a href="<?php echo esc_url($moderator_twitter); ?>">
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/tw.svg" alt="">
                                                    </a>
                                                </li>
                                            <?php
                                    }
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
if (is_singular('events')) {
    if (null != $organizers && in_array($organizers_view_in, array('inside-page', 'both'))) {
        if (empty($organizers_ids)) {
            $organizers_ids = array();
            foreach ($organizers as $organizer) {
                $organizers_ids[] = $organizer->ID;
            }
            $organizers_ids = implode(',', $organizers_ids);
        }
        foreach ($organizers as $organizer) {
            $organizer_img = get_field('profile_image', 'user_' . $organizer->ID);
            $organizer_img = !empty($organizer_img) ? $organizer_img : $assets_uri . '/images/placeholder.png';
            $organizer_mit_status = is_mit_alum($organizer->ID);
            $organizer_first_name = get_field('full_name', 'user_' . $organizer->ID);
            $organizer_last_name = get_field('user_last_name', 'user_' . $organizer->ID);
            $designations = array();
            if (have_rows('designations', 'user_' . $organizer->ID)) {
                while (have_rows('designations', 'user_' . $organizer->ID)) {
                    the_row();
                    $designations[] = get_sub_field('designation_title', 'user_' . $organizer->ID);
                }
            }
            $teams = get_field('teams', 'user_' . $organizer->ID);

            $affiliations_mit = array();
            $affiliations_other = array();
            $affiliations = get_field('affiliations', 'user_' . $organizer->ID);
            if ($affiliations) {
                foreach ($affiliations as $affiliation) {
                    if ($affiliation != null) {
                        $affiliation_count = count($affiliation);
                        for ($i = 0; $i < $affiliation_count; $i++) {
                            if (isset($affiliation[$i]['mit_affiliation_title'])) {
                                $affiliations_mit[] = $affiliation[$i]['mit_affiliation_title'];
                            } else if (isset($affiliation[$i]['other_affiliation_title'])) {
                                $affiliations_other[] = $affiliation[$i]['other_affiliation_title'];
                            }
                        }
                    }
                }
            }
            $organizer_facebook = get_field('facebook', 'user_' . $organizer->ID);
            $organizer_twitter = get_field('twitter', 'user_' . $organizer->ID);
            $organizer_linkedin = get_field('linkedin', 'user_' . $organizer->ID);
            if (!empty($organizer_first_name) || !empty($organizer_last_name)) {
                ?>
                        <div data-team_member="<?php echo esc_html(strtolower(str_replace(array("'", '  '), array('', ' '), $organizer_first_name . ' ' . $organizer_last_name))); ?>" class="col-12 col-lg-<?php echo esc_attr($speaker_col); ?> col-md-12">
                            <div class="speaker-card">
                                <a href="<?php echo esc_url(get_author_posts_url($organizer->ID)); ?>" class="speaker--click">
                                    <form action="<?php echo esc_url(get_author_posts_url($organizer->ID)); ?>" method="post"><input type="hidden" name="through_back" value="<?php echo esc_attr($post->ID); ?>" /></form>
                                    <div class="card-img">
                                        <img src="<?php echo esc_url($organizer_img); ?>" alt="">
                                <?php if ($organizer_mit_status) { ?>
                                            <div class="icon-mit">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="">
                                            </div>
                                <?php } ?>
                                    </div>
                                    <div class="card-text">
                                        <div class="name">
                                            <h3><?php echo esc_html($organizer_first_name . ' ' . $organizer_last_name); ?></h3>
                                            <span
                                                class="code"><?php echo esc_html(($affiliations_mit != null) ? implode(', ', $affiliations_mit) : ''); ?></span>
                                        </div>
                                        <div
                                            class="company-name <?php echo (empty($organizer_facebook) && empty($organizer_twitter) && empty($organizer_linkedin) && 0) ? 'no-border' : ''; ?>">
                                    <?php
                                    if (have_rows('positions', 'user_' . $organizer->ID)) {
                                        while (have_rows('positions', 'user_' . $organizer->ID)) {
                                            the_row();
                                            ?>
                                                    <h4><?php the_sub_field('company', 'user_' . $organizer->ID); ?></h4>
                                                    <span><?php the_sub_field('job_title', 'user_' . $organizer->ID); ?></span>
                                                    <?php
                                                    break;
                                        }
                                    }
                                    ?>
                                        </div>
                                        <div class="tags-box">
                                            <span class="tag">Organizer</span>
                                        </div>
                                        <ul class="social-icons">
                                    <?php if (!empty($organizer_facebook)) { ?>
                                                <li>
                                                    <a href="<?php echo esc_url($organizer_facebook); ?>">
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/fb.svg" alt="">
                                                    </a>
                                                </li>
                                            <?php
                                    }
                                    if (!empty($organizer_twitter)) {
                                        ?>
                                                <li>
                                                    <a href="<?php echo esc_url($organizer_twitter); ?>">
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/tw.svg" alt="">
                                                    </a>
                                                </li>
                                            <?php
                                    }
                                    if (!empty($organizer_linkedin)) {
                                        ?>
                                                <li>
                                                    <a href="<?php echo esc_url($organizer_linkedin); ?>">
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
if ($specific_event !== true) {
    echo '</div>';
}
?>
