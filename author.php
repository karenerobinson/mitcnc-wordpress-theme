<?php
global $wp_query,
       $leadership_team_page_id,
       $volunteer_spotlight_page_id,
       $board_of_directors_page_id,
       $speakers_page_id,
       $past_presidents_page_id,
       $assets_uri,
       $event_post_type,
       $userobj;
$volunteer_questions = get_volunteer_questions();
$userobj = $wp_query->get_queried_object();
$current_user_id = '';
$through_back = '';

get_header();

if (isset($userobj->ID) && $userobj->ID > 0) {
    $current_user_id = $userobj->ID;
    $who_is_this = $userobj->who_is_this_from;
    if ((isset($_REQUEST['through_back']) && !empty($_REQUEST['through_back']))) {
        $through_back = sanitize_text_field(wp_unslash($_REQUEST['through_back']));
    } else if (is_array($who_is_this) && in_array('speakers', $who_is_this)) {
        $through_back = $speakers_page_id;
    } else if (is_array($who_is_this) && in_array('volunteer_spotlight', $who_is_this)) {
        $through_back = $volunteer_spotlight_page_id;
    } else if (is_array($who_is_this) && in_array('leadership_team', $who_is_this)) {
        $through_back = $leadership_team_page_id;
    } else if (is_array($who_is_this) && in_array('board_of_directors', $who_is_this)) {
        $through_back = $board_of_directors_page_id;
    } else if (is_array($who_is_this) && in_array('past_presidents', $who_is_this)) {
        $through_back = $past_presidents_page_id;
    }
}
if (!empty($current_user_id) && !empty($through_back)) {
    $is_speaker = false;
    $is_leader = false;
    $is_director = false;
    $is_spotlight = false;
    $team = null;
    $featured_team = null;
    $program = (isset($_REQUEST['program'])) ? strip_tags(sanitize_text_field(wp_unslash($_REQUEST['program']))) : '';
    if ($through_back == $speakers_page_id || '5' == $through_back) {
        $featured_team = get_field('speakers_list', $through_back);
        $team = get_users_by_type('speakers', '', false, $program, false, 'ASC', null, $featured_team);
        $featured_team = is_array($featured_team) ? get_users_by_type('speakers', '', false, $program, false, 'ASC', $featured_team, null) : null;
        $is_speaker = true;
    } else if ($through_back == $leadership_team_page_id) {
        $featured_team = get_field('team_list', $through_back);
        $team = get_users_by_type('leadership_team', '', false, $program, false, 'ASC', null, $featured_team);
        $featured_team = is_array($featured_team) ? get_users_by_type('leadership_team', '', false, $program, false, 'ASC', $featured_team, null) : null;
        $is_leader = true;
    } else if ($through_back == $volunteer_spotlight_page_id) {
        $featured_team = get_field('volunteer_list', $through_back);
        $team = get_users_by_type('volunteer_spotlight', '', false, $program, false, 'ASC', null, $featured_team);
        $featured_team = is_array($featured_team) ? get_users_by_type('volunteer_spotlight', '', false, $program, false, 'ASC', $featured_team, null) : null;
        $is_spotlight = true;
    } else if ($through_back == $board_of_directors_page_id) {
        $featured_team = get_field('directors_list', $through_back);
        $team = get_users_by_type('board_of_directors', '', false, $program, false, 'ASC', null, $featured_team);
        $featured_team = is_array($featured_team) ? get_users_by_type('board_of_directors', '', false, $program, false, 'ASC', $featured_team, null) : null;
        $is_director = true;
    }
}

$team = null;
$featured_team = null;

if (!empty($current_user_id)) {
    $associated_upcoming_events = get_events(-1, null, null, null, null, false, null, null, null, false, null, null, array($userobj->ID));
    $associated_past_events = get_events(-1, null, null, null, null, true, null, null, null, false, null, null, array($userobj->ID));
    ?>
    <section>
        <article class="inner-page user-profile">
            <div class="container">
                <?php
                if (!empty($through_back)) {
                    $back_link = get_permalink($through_back);
                    ?>
                    <div class="row">
                        <div class="col-sm-24">
                            <a href="<?php echo esc_url($back_link); ?>" class="back-btn"><img
                                        src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_red.svg">Back to
                                the <?php echo esc_html(get_the_title($through_back)); ?></a>
                            <a href="<?php echo esc_url($back_link); ?>" class="cancel-btn"><img
                                        src="<?php echo esc_url($assets_uri); ?>/images/cancel.svg"></a>
                        </div>
                    </div>
                <?php } ?>
                <div class="leader-ship-slider">
                    <?php
                    $who_is_this_from = get_field('who_is_this_from', 'user_' . $current_user_id);
                    $who_is_this_from = (is_array($who_is_this_from) && null != $who_is_this_from) ? implode(', ', $who_is_this_from) : $who_is_this_from;
                    $speaker_first_name = get_field('full_name', 'user_' . $current_user_id);
                    $speaker_last_name = get_field('user_last_name', 'user_' . $current_user_id);
                    $speaker_bio = get_field('bio', 'user_' . $current_user_id);
                    $affiliations = get_field('affiliations', 'user_' . $current_user_id);
                    $affiliation_groups = group_affiliations($affiliations);
                    $affiliations_mit = $affiliation_groups->mit;
                    $affiliations_other = $affiliation_groups->other;
                    $teams = array();

                    if (have_rows('teams', 'user_' . $current_user_id)) {
                        while (have_rows('teams', 'user_' . $current_user_id)) {
                            the_row();
                            $teams[] = get_sub_field('team_name', 'user_' . $current_user_id);
                        }
                    }
                    $speaker_img = get_field('profile_image', 'user_' . $current_user_id);
                    $speaker_img = !empty($speaker_img) ? $speaker_img : $assets_uri . '/images/placeholder.png';
                    $speaker_mit_status = is_mit_alum($current_user_id);
                    $speaker_linkedin_profile = get_field('linkedin_profile', 'user_' . $current_user_id);
                    $volunteer_qa = get_field('volunteer_qa', 'user_' . $current_user_id);
                    if ($volunteer_qa) {
                        foreach ($volunteer_qa as $kk => $value) {
                            $volunteer_questions[$kk]['answer'] = $value;
                        }
                    }
                    $speaker_facebook = get_field('facebook', 'user_' . $current_user_id);
                    $speaker_twitter = get_field('twitter', 'user_' . $current_user_id);
                    $speaker_linkedin = get_field('linkedin', 'user_' . $current_user_id);
                    ?>
                    <div class="leaders <?php echo ($current_user_id == $current_user_id) ? 'current_user_profile' : ''; ?>">
                        <div class="row info">
                            <div class="col-sm-24">
                                <h2 class="red-text"><?php echo esc_html($speaker_first_name . ' ' . $speaker_last_name); ?>
                                    <span><?php echo ($affiliations_mit != null) ? esc_html(implode(', ', $affiliations_mit)) : ''; ?> </span>
                                </h2>

                                <?php
                                if (have_rows('positions', 'user_' . $current_user_id)) {
                                    $in = 0;
                                    $positions_count = get_user_meta($current_user_id, 'positions');
                                    $positions_count = isset($positions_count[0]) ? $positions_count[0] : 0;
                                    while (have_rows('positions', 'user_' . $current_user_id)) {
                                        the_row();
                                        if ($in == 0) {
                                            ?>
                                            <h3><?php the_sub_field('job_title', 'user_' . $current_user_id); ?></h3>
                                                                                 <?php
                                        }
                                        if ($in == 0) {
                                            ?>
                                        <ul>
                                            <li><?php the_sub_field('company', 'user_' . $current_user_id); ?></li>
                                                                               <?php
                                        } else {
                                            ?>
                                            <li><?php the_sub_field('company', 'user_' . $current_user_id); ?>
                                                - <?php the_sub_field('job_title', 'user_' . $current_user_id); ?></li>
                                                <?php
                                        }
                                        if ($in == ($positions_count - 1)) {
                                            ?>
                                        </ul>
                                            <?php
                                        }
                                                $in++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-10">
                                <div class="speaker-card">
                                    <div class="card-img">
                                        <img src="<?php echo esc_url($speaker_img); ?>">
                                        <?php if ($speaker_mit_status) { ?>
                                            <div class="icon-mit">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="card-text">
                                        <div class="tags-box">
                                            <?php
                                            if (have_rows('designations', 'user_' . $current_user_id)) {
                                                while (have_rows('designations', 'user_' . $current_user_id)) {
                                                    the_row();
                                                    ?>
                                                    <span class="tag"><?php the_sub_field('designation_title', 'user_' . $current_user_id); ?></span>
                                                                                                               <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="team">
                                            <?php if ($teams != null) { ?>
                                                <p>Team : <span><?php echo esc_html(implode(', ', $teams)); ?></span></p>
                                            <?php } ?>

                                            <?php if ($affiliations_other != null) { ?>
                                                <p>Other Affiliations :
                                                    <span><?php echo esc_html(implode(', ', $affiliations_other)); ?></span></p>
                                            <?php } ?>
                                        </div>
                                        <ul class="social-icons">
                                            <?php if (!empty($speaker_facebook)) { ?>
                                                <li>
                                                    <a href="<?php echo esc_url($speaker_facebook); ?>" target="_blank">
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/fb.svg">
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            if (!empty($speaker_twitter)) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo esc_url($speaker_twitter); ?>" target="_blank">
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/tw.svg">
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            if (!empty($speaker_linkedin)) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo esc_url($speaker_linkedin); ?>" target="_blank">
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/in.svg">
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-18 col-md-14">
                                <p class="black-text"><?php echo wp_kses($speaker_bio, allowed_html()); ?></p>

                                <?php
                                if (!is_array($who_is_this_from) && strpos($who_is_this_from, 'volunteer_spotlight') !== false) {
                                    if (null != $volunteer_questions) {
                                        foreach ($volunteer_questions as $volunteer_question) {
                                            ?>
                                            <h4><?php echo wp_kses($volunteer_question['question'], allowed_html()); ?></h4>
                                            <p><?php echo wp_kses($volunteer_question['answer'], allowed_html()); ?></p>
    
                                            <?php
                                        }
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    

                </div>

            </div>
        </article>

        <?php
        if (null != $associated_upcoming_events) {
            $upcoming_events = $associated_upcoming_events;
            ?>
            <article class="upcoming-events">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Upcoming Events</h2>
                        </div>
                    </div>
                    <div class="row card-container">
                        <div class="card-slider clearfix">
                            <?php get_template_part('template-parts/content', 'events-loop'); ?>
                        </div>
                    </div>
                </div>
            </article>
            <?php
        }
        if ($associated_past_events != null) {
            $upcoming_events = $associated_past_events;
            ?>
            <article class="upcoming-events">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Past Events</h2>
                        </div>
                    </div>
                    <div class="row card-container">
                        <div class="card-slider clearfix">
                            <?php get_template_part('template-parts/content', 'events-loop'); ?>
                        </div>
                    </div>
                </div>
            </article>
            <?php
        }
        if ($team != null) {
            ?>
            <article class="inner-page energy">
                <div class="container">
                    <div class="row">

                        <div class="col-sm-24">
                            <div class="row">
                                <div class="col-sm-16">
                                    <h1><?php echo esc_html(($through_back == '5') ? 'Speakers' : get_the_title($through_back)); ?></h1>
                                </div>
                            </div>
                            <?php if ($through_back == $leadership_team_page_id) { ?>
                                <div class="row">
                                    <div class="col-sm-16">
                                        <p>Officers serving during FY 20<?php echo esc_html(date('y')); ?>
                                            /<?php echo((int) date('y') + 1); ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                            if ($team != null) {
                                ?>
                                <div class="row ">
                                    <?php
                                    $member_ids = array();
                                    if ($featured_team != null) {
                                        foreach ($featured_team as $member) {
                                            $member_ids[] = $member->ID;
                                        }
                                    }
                                    if ($team != null) {
                                        foreach ($team as $member) {
                                            $member_ids[] = $member->ID;
                                        }
                                    }
                                    $member_ids = implode(',', $member_ids);
                                    if ($featured_team != null) {
                                        foreach ($featured_team as $member) {
                                            $job_title = get_field('job_title', 'user_' . $member->ID);
                                            $member_img = get_field('profile_image', 'user_' . $member->ID);
                                            $member_img = !empty($member_img) ? $member_img : $assets_uri . '/images/placeholder.png';
                                            $member_mit_status = is_mit_alum($member->ID);
                                            $affiliations = get_field('affiliations', 'user_' . $member->ID);
                                            $affiliation_groups = group_affiliations($affiliations);
                                            $affiliations_mit = $affiliation_groups->mit;
                                            $affiliations_other = $affiliation_groups->other;

                                            $member_first_name = get_field('full_name', 'user_' . $member->ID);
                                            $member_last_name = get_field('user_last_name', 'user_' . $member->ID);
                                            $teams = get_field('teams', 'user_' . $member->ID);
                                            $companies = array();
                                            if (have_rows('companies', 'user_' . $member->ID)) {
                                                while (have_rows('companies', 'user_' . $member->ID)) {
                                                    the_row();
                                                    $companies[] = get_sub_field('company_name', 'user_' . $member->ID);
                                                }
                                            }
                                            $speaker_facebook = get_field('facebook', 'user_' . $member->ID);
                                            $speaker_twitter = get_field('twitter', 'user_' . $member->ID);
                                            $speaker_linkedin = get_field('linkedin', 'user_' . $member->ID);
                                            $speaker_link = get_author_posts_url($member->ID);
                                            ?>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="speaker-card">
                                                    <a href="<?php echo (!$is_director && !$is_leader) ? esc_url($speaker_link) : 'javascript:void(0)'; ?>">
                                                        <div class="card-img">
                                                            <img src="<?php echo esc_url($member_img); ?>">
                                                            <?php if ($member_mit_status) { ?>
                                                                <div class="icon-mit">
                                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg">
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="card-text">
                                                            <div class="name">
                                                                <h3><?php echo esc_html($member_first_name . ' ' . $member_last_name); ?></h3>
                                                                <span
                                                                        class="code"><?php echo ($affiliations_mit != null) ? esc_html(implode(', ', $affiliations_mit)) : ''; ?></span>
                                                            </div>
                                                            <div
                                                                    class="company-name <?php echo (empty($speaker_facebook) && empty($speaker_twitter) && empty($speaker_linkedin) && 0) ? 'no-border' : ''; ?>">
                                                                <?php
                                                                if (have_rows('positions', 'user_' . $member->ID)) {
                                                                    while (have_rows('positions', 'user_' . $member->ID)) {
                                                                        the_row();
                                                                        ?>
                                                                        <h4><?php the_sub_field('company', 'user_' . $member->ID); ?></h4>
                                                                        <span><?php the_sub_field('job_title', 'user_' . $member->ID); ?></span>
                                                                        <?php
                                                                        break;
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <?php if (!empty($speaker_facebook) || !empty($speaker_twitter) || !empty($speaker_linkedin) || ($teams != null && is_array($teams)) || $affiliations_other != null || (have_rows('designations', 'user_' . $member->ID) && !$is_spotlight && !$is_speaker)) { ?>
                                                                <div class="border-dotted"></div>

                                                            <?php } ?>
                                                            <div class="tags-box">
                                                                <?php
                                                                if (have_rows('designations', 'user_' . $member->ID) && !$is_spotlight && !$is_speaker) {
                                                                    while (have_rows('designations', 'user_' . $member->ID)) {
                                                                        the_row();
                                                                        ?>
                                                                        <span
                                                                                class="tag"><?php the_sub_field('designation_title', 'user_' . $member->ID); ?></span>
                                                                                                                                     <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <?php if (!$is_spotlight && !$is_speaker) { ?>
                                                                <div class="team">
                                                                    <?php if ($teams != null && is_array($teams)) { ?>
                                                                        <p>Team :
                                                                            <span><?php echo esc_html(implode(', ', $teams)); ?></span>
                                                                        </p>
                                                                    <?php } ?>


                                                                    <?php if ($affiliations_other != null) { ?>
                                                                        <p>Other Affiliations :
                                                                            <span><?php echo esc_html(implode(', ', $affiliations_other)); ?></span>
                                                                        </p>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>
                                                            <ul class="social-icons">
                                                                <?php if (!empty($speaker_facebook)) { ?>
                                                                    <li>
                                                                        <a href="<?php echo esc_url($speaker_facebook); ?>"
                                                                           target="_blank">
                                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/fb.svg"
                                                                                >
                                                                        </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                if (!empty($speaker_twitter)) {
                                                                    ?>
                                                                    <li>
                                                                        <a href="<?php echo esc_url($speaker_twitter); ?>"
                                                                           target="_blank">
                                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/tw.svg"
                                                                                >
                                                                        </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                if (!empty($speaker_linkedin)) {
                                                                    ?>
                                                                    <li>
                                                                        <a href="<?php echo esc_url($speaker_linkedin); ?>"
                                                                           target="_blank">
                                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/in.svg"
                                                                                >
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
                                    if ($team != null) {
                                        foreach ($team as $member) {
                                            $job_title = get_field('job_title', 'user_' . $member->ID);
                                            $member_img = get_field('profile_image', 'user_' . $member->ID);
                                            $member_img = !empty($member_img) ? $member_img : $assets_uri . '/images/placeholder.png';
                                            $member_mit_status = is_mit_alum($member->ID);
                                            $affiliations = get_field('affiliations', 'user_' . $member->ID);
                                            $affiliation_groups = group_affiliations($affiliations);
                                            $affiliations_mit = $affiliation_groups->mit;
                                            $affiliations_other = $affiliation_groups->other;

                                            $member_first_name = get_field('full_name', 'user_' . $member->ID);
                                            $member_last_name = get_field('user_last_name', 'user_' . $member->ID);
                                            $teams = get_field('teams', 'user_' . $member->ID);
                                            $companies = array();
                                            if (have_rows('companies', 'user_' . $member->ID)) {
                                                while (have_rows('companies', 'user_' . $member->ID)) {
                                                    the_row();
                                                    $companies[] = get_sub_field('company_name', 'user_' . $member->ID);
                                                }
                                            }
                                            $speaker_facebook = get_field('facebook', 'user_' . $member->ID);
                                            $speaker_twitter = get_field('twitter', 'user_' . $member->ID);
                                            $speaker_linkedin = get_field('linkedin', 'user_' . $member->ID);
                                            $speaker_link = get_author_posts_url($member->ID);
                                            ?>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="speaker-card">
                                                    <a href="<?php echo (!$is_director && !$is_leader) ? esc_url($speaker_link) : 'javascript:void(0)'; ?>">
                                                        <div class="card-img">
                                                            <img src="<?php echo esc_url($member_img); ?>">
                                                            <?php if ($member_mit_status) { ?>
                                                                <div class="icon-mit">
                                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg">
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="card-text">
                                                            <div class="name">
                                                                <h3><?php echo esc_html($member_first_name . ' ' . $member_last_name); ?></h3>
                                                                <span class="code"><?php echo ($affiliations_mit != null) ? esc_html(implode(', ', $affiliations_mit)) : ''; ?></span>
                                                            </div>
                                                            <div class="company-name <?php echo (empty($speaker_facebook) && empty($speaker_twitter) && empty($speaker_linkedin) && 0) ? 'no-border' : ''; ?>">
                                                                <?php
                                                                if (have_rows('positions', 'user_' . $member->ID)) {
                                                                    while (have_rows('positions', 'user_' . $member->ID)) {
                                                                        the_row();
                                                                        ?>
                                                                        <h4><?php the_sub_field('company', 'user_' . $member->ID); ?></h4>
                                                                        <span><?php the_sub_field('job_title', 'user_' . $member->ID); ?></span>
                                                                        <?php
                                                                        break;
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <?php if (!empty($speaker_facebook) || !empty($speaker_twitter) || !empty($speaker_linkedin) || ($teams != null && is_array($teams)) || $affiliations_other != null || (have_rows('designations', 'user_' . $member->ID) && !$is_spotlight && !$is_speaker)) { ?>
                                                                <div class="border-dotted"></div>

                                                            <?php } ?>
                                                            <div class="tags-box">
                                                                <?php
                                                                if (have_rows('designations', 'user_' . $member->ID) && !$is_spotlight && !$is_speaker) {
                                                                    while (have_rows('designations', 'user_' . $member->ID)) {
                                                                        the_row();
                                                                        ?>
                                                                        <span class="tag"><?php the_sub_field('designation_title', 'user_' . $member->ID); ?></span>
                                                                                                                                   <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <?php if (!$is_spotlight && !$is_speaker) { ?>
                                                                <div class="team">
                                                                    <?php if ($teams != null && is_array($teams)) { ?>
                                                                        <p>Team :
                                                                            <span><?php echo esc_html(implode(', ', $teams)); ?></span>
                                                                        </p>
                                                                    <?php } ?>


                                                                    <?php if (null != $affiliations_other) { ?>
                                                                        <p>Other Affiliations :
                                                                            <span><?php echo esc_html(implode(', ', $affiliations_other)); ?></span>
                                                                        </p>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>
                                                            <ul class="social-icons">
                                                                <?php if (!empty($speaker_facebook)) { ?>
                                                                    <li>
                                                                        <a href="<?php echo esc_url($speaker_facebook); ?>"
                                                                           target="_blank">
                                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/fb.svg"
                                                                                >
                                                                        </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                if (!empty($speaker_twitter)) {
                                                                    ?>
                                                                    <li>
                                                                        <a href="<?php echo esc_url($speaker_twitter); ?>"
                                                                           target="_blank">
                                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/tw.svg"
                                                                                >
                                                                        </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                if (!empty($speaker_linkedin)) {
                                                                    ?>
                                                                    <li>
                                                                        <a href="<?php echo esc_url($speaker_linkedin); ?>"
                                                                           target="_blank">
                                                                            <img src="<?php echo esc_url($assets_uri); ?>/images/in.svg"
                                                                                >
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
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </article>
        <?php } ?>
    </section>
    <?php
}
get_footer();
