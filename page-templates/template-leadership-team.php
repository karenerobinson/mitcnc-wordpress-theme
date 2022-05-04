<?php
    /* Template Name: Leadership Team Page */
    get_header();
    global $assets_uri,
        $post,
        $user_profile_page_id,
        $volunteer_spotlight_page_id,
        $board_of_directors_page_id,
        $mitaa_board_members_page_id,
        $mitaa_board_presidents_page_id,
        $mit_corporation_members_page_id,
        $leadership_team_page_id;
        $is_speaker = false;
        $is_leader = false;
        $is_director = false;
        $is_spotlight = false;
        $is_mitaa = false;
        $is_mit_corp = false;
        $team =  null;
        $featured_team = null;
        $program = (isset($_REQUEST['program'])) ? sanitize_text_field(wp_unslash($_REQUEST['program'])) : '';
if ($post->ID == $speakers_page_id) {
    $featured_team = get_field('speakers_list', $post->ID);
    $team = get_users_by_type('speakers', '', false, $program, false, 'ASC', null, $featured_team);
    $featured_team = is_array($featured_team) ? get_users_by_type('speakers', '', false, $program, false, 'ASC', $featured_team, null) : null;
    $is_speaker = true;
} else if ($post->ID == $leadership_team_page_id) {
    $featured_team = get_field('team_list', $post->ID);
    $team = get_users_by_type('leadership_team', '', false, $program, false, 'ASC', null, $featured_team);
    $featured_team = is_array($featured_team) ? get_users_by_type('leadership_team', '', false, $program, false, 'ASC', $featured_team, null) : null;
    $is_leader = true;
} else if ($post->ID == $volunteer_spotlight_page_id) {
    $featured_team = get_field('volunteer_list', $post->ID);
    $team = get_users_by_type('volunteer_spotlight', '', false, $program, false, 'ASC', null, $featured_team);
    $featured_team = is_array($featured_team) ? get_users_by_type('volunteer_spotlight', '', false, $program, false, 'ASC', $featured_team, null) : null;
    $is_spotlight = true;
} else if ($post->ID == $board_of_directors_page_id) {
    $featured_team = get_field('directors_list', $post->ID);
    $team = get_users_by_type('board_of_directors', '', false, $program, false, 'ASC', null, $featured_team);
    $featured_team = is_array($featured_team) ? get_users_by_type('board_of_directors', '', false, $program, false, 'ASC', $featured_team, null) : null;
    $is_director = true;
} else if ($post->ID == $mitaa_board_members_page_id) {
    $featured_team = '';
    $team = get_users_by_type('mitaa_board_members', '', false, $program, false, 'ASC', null, $featured_team);
    $featured_team = is_array($featured_team) ? get_users_by_type('mitaa_board_members', '', false, $program, false, 'ASC', $featured_team, null) : null;
    $is_director = true;
    $is_mitaa = true;
} else if ($post->ID == $mitaa_board_presidents_page_id) {
    $featured_team = '';
    $team = get_users_by_type('mitaa_board_presidents', '', false, $program, false, 'ASC', null, $featured_team);
    $featured_team = is_array($featured_team) ? get_users_by_type('mitaa_board_presidents', '', false, $program, false, 'ASC', $featured_team, null) : null;
    $is_director = true;
    $is_mitaa = true;
} else if ($post->ID == $mit_corporation_members_page_id) {
    $featured_team = '';
    $team = get_users_by_type('mit_corporation_members', '', false, $program, false, 'ASC', null, $featured_team);
    $featured_team = is_array($featured_team) ? get_users_by_type('mit_corporation_members', '', false, $program, false, 'ASC', $featured_team, null) : null;
    $is_director = true;
    $is_mit_corp = true;
}
    $desig_key = 'designations';
if ($is_mitaa) {
    $desig_key = 'mitaa_designations';
} else if ($is_mit_corp) {
    $desig_key = 'mit_corp_designations';
}

    $is_show_sidebar = (is_page($volunteer_spotlight_page_id) || is_page($board_of_directors_page_id) || is_page($leadership_team_page_id) || is_page($mit_corporation_members_page_id) || is_page($mitaa_board_presidents_page_id) || is_page($mitaa_board_members_page_id)) ? true : false;

?>
<section>
    <article class="inner-page energy">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <?php echo filter_var(wpd_nav_menu_breadcrumbs('header_main'), FILTER_UNSAFE_RAW); ?>
                </div>
                <div class="col-24 col-lg-<?php echo ($is_show_sidebar) ? '17' : '24'; ?> col-md-<?php echo ($is_show_sidebar) ? '17' : '24'; ?>">
                    <div class="row">
                        <div class="col-sm-16">
                            <h1><?php echo esc_html($post->post_title); ?></h1>
                            <?php echo filter_var(wpautop($post->post_content), FILTER_UNSAFE_RAW); ?>
                        </div>
                    </div>
                    <?php if ($post->ID == $leadership_team_page_id) { ?>
                        <div class="row">
                            <div class="col-sm-16">
                                <p>Officers serving during FY 20<?php echo esc_html(date('y')); ?>/<?php echo ((int) date('y') + 1); ?> </p>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-sm-<?php echo ($is_show_sidebar) ? '12' : '8'; ?>">
                            <div class="form--search-field-wrapper form-group" style="position: relative;">
                                <i class="fa fa-search" style="position: absolute;top: 10px;left: 10px;"></i>
                                <input class="form--search-field form-control" type="text" value="" placeholder="Search by Name or Company" style="padding-left: 27px;" />
                            </div>
                        </div>
                    </div>
                    <?php if ($team != null) { ?>
                        <div class="row users_list">
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
                                    $affiliations_mit = array();
                                    $affiliations_other = array();
                                    $affiliations = get_field('affiliations', 'user_' . $member->ID);
                                    if ($affiliations) {
                                        foreach ($affiliations as $affiliation) {
                                            if ($affiliation != null) {
                                                $count_affiliation = count($affiliation);
                                                for ($i = 0; $i < $count_affiliation; $i++) {
                                                    if (isset($affiliation[$i]['mit_affiliation_title'])) {
                                                        $affiliations_mit[] = $affiliation[$i]['mit_affiliation_title'];
                                                    } else if (isset($affiliation[$i]['other_affiliation_title'])) {
                                                        $affiliations_other[] = $affiliation[$i]['other_affiliation_title'];
                                                    }
                                                }
                                            }
                                        }
                                    }
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

                                    // for searching
                                    $speakerCompany = '';
                                    if (have_rows('positions', 'user_' . $member->ID)) {
                                        while (have_rows('positions', 'user_' . $member->ID)) {
                                            the_row();
                                            $speakerCompany .= strtolower(str_replace(array("'", '  '), array('', ' '), get_sub_field('company', 'user_' . $member->ID))) . ' ';
                                        }
                                    }


                                    ?>
                                    <div class="col-24 col-lg-<?php echo ($is_show_sidebar) ? '8' : '6'; ?> col-md-12 col-sm-<?php echo ($is_show_sidebar) ? '12' : '8'; ?>" data-team_member="<?php echo esc_attr($speakerCompany); ?> <?php echo esc_html(strtolower(str_replace(array("'", '  '), array('', ' '), $member_first_name . ' ' . $member_last_name))); ?>">
                                        <div class="speaker-card">
                                            <a href="<?php echo (!$is_director && !$is_leader) ? esc_url($speaker_link) : 'javascript:void(0)'; ?>">
                                                <div class="card-img">
                                                    <img src="<?php echo esc_attr($member_img); ?>" alt="">
                                                    <?php if ($member_mit_status) { ?>
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_attr($assets_uri); ?>/images/mit-icon.svg" alt="">
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="card-text">
                                                    <div class="name">
                                                        <h3><?php echo esc_attr($member_first_name) . ' ' . esc_attr($member_last_name); ?></h3>
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
                                                    <?php if (!empty($speaker_facebook) || !empty($speaker_twitter) || !empty($speaker_linkedin) || ($teams != null && is_array($teams)) || $affiliations_other != null || (have_rows($desig_key, 'user_' . $member->ID) && !$is_spotlight && !$is_speaker)) { ?>
                                                        <div class="border-dotted"></div>
                                                    <?php } ?>
                                                    <div class="tags-box">
                                                        <?php
                                                        if (have_rows($desig_key, 'user_' . $member->ID) && !$is_spotlight && !$is_speaker) {
                                                            while (have_rows($desig_key, 'user_' . $member->ID)) {
                                                                the_row();
                                                                ?>
                                                                <?php if (get_sub_field('designation_title', 'user_' . $member->ID) != 'Director') : ?>
                                                                <span class="tag"><?php the_sub_field('designation_title', 'user_' . $member->ID); ?>
                                                                </span>
                                                                <?php endif; ?>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <ul class="social-icons">
                                                        <?php if (!empty($speaker_facebook)) { ?>
                                                            <li>
                                                                <a href="<?php echo esc_url($speaker_facebook); ?>" target="_blank">
                                                                    <img src="<?php echo esc_attr($assets_uri); ?>/images/fb.svg" alt="">
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                        if (!empty($speaker_twitter)) {
                                                            ?>
                                                            <li>
                                                                <a href="<?php echo esc_url($speaker_twitter); ?>" target="_blank">
                                                                    <img src="<?php echo esc_attr($assets_uri); ?>/images/tw.svg" alt="">
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                        if (!empty($speaker_linkedin)) {
                                                            ?>
                                                            <li>
                                                                <a href="<?php echo esc_url($speaker_linkedin); ?>" target="_blank">
                                                                    <img src="<?php echo esc_attr($assets_uri); ?>/images/in.svg" alt="">
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
                                    $affiliations_mit = array();
                                    $affiliations_other = array();
                                    $affiliations = get_field('affiliations', 'user_' . $member->ID);
                                    if ($affiliations) {
                                        foreach ($affiliations as $affiliation) {
                                            if ($affiliation != null) {
                                                $count_affiliation = count($affiliation);
                                                for ($i = 0; $i < $count_affiliation; $i++) {
                                                    if (isset($affiliation[$i]['mit_affiliation_title'])) {
                                                        $affiliations_mit[] = $affiliation[$i]['mit_affiliation_title'];
                                                    } else if (isset($affiliation[$i]['other_affiliation_title'])) {
                                                        $affiliations_other[] = $affiliation[$i]['other_affiliation_title'];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    $member_first_name = get_field('full_name', 'user_' . $member->ID);
                                    $member_last_name = get_field('user_last_name', 'user_' . $member->ID);
                                    $teams =  get_field('teams', 'user_' . $member->ID);
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

                                    // for searching
                                    $speakerCompany = '';
                                    if (have_rows('positions', 'user_' . $member->ID)) {
                                        while (have_rows('positions', 'user_' . $member->ID)) {
                                            the_row();
                                            $speakerCompany .= strtolower(str_replace(array("'", '  '), array('', ' '), get_sub_field('company', 'user_' . $member->ID))) . ' ';
                                        }
                                    }
                                    ?>
                                <div class="col-lg-<?php echo ($is_show_sidebar) ? '8' : '6'; ?> col-md-12 col-sm-<?php echo ($is_show_sidebar) ? '12' : '8'; ?>" data-team_member="<?php echo esc_html($speakerCompany); ?> <?php echo esc_html(strtolower(str_replace(array("'", '  '), array('', ' '), $member_first_name . ' ' . $member_last_name))); ?>">
                                    <div class="speaker-card">
                                        <a href="<?php echo (!$is_director && !$is_leader) ?  esc_url($speaker_link) : 'javascript:void(0)'; ?>">
                                            <div class="card-img">
                                                <img src="<?php echo esc_attr($member_img); ?>" alt="">
                                                    <?php if ($member_mit_status) { ?>
                                                        <div class="icon-mit">
                                                            <img src="<?php echo esc_attr($assets_uri); ?>/images/mit-icon.svg" alt="">
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
                                                    <?php if (!empty($speaker_facebook) || !empty($speaker_twitter) || !empty($speaker_linkedin) || ($teams != null && is_array($teams)) ||  $affiliations_other != null || (have_rows($desig_key, 'user_' . $member->ID) && !$is_spotlight && !$is_speaker)) { ?>
                                                            <div class="border-dotted"></div>
                                                        <?php
                                                    }
                                                    ?>
                                                <div class="tags-box">
                                                    <?php
                                                    if (have_rows($desig_key, 'user_' . $member->ID) && !$is_spotlight && !$is_speaker) {
                                                        while (have_rows($desig_key, 'user_' . $member->ID)) {
                                                            the_row();
                                                            ?>
                                                            <span class="tag"><?php the_sub_field('designation_title', 'user_' . $member->ID); ?></span>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <?php if (!$is_spotlight && !$is_speaker) { ?>
                                                <?php } ?>
                                                <ul class="social-icons">
                                                    <?php if (!empty($speaker_facebook)) { ?>
                                                    <li>
                                                        <a href="<?php echo esc_url($speaker_facebook); ?>" target="_blank">
                                                            <img src="<?php echo esc_attr($assets_uri); ?>/images/fb.svg" alt="">
                                                        </a>
                                                    </li>
                                                    <?php } if (!empty($speaker_twitter)) { ?>
                                                    <li>
                                                        <a href="<?php echo esc_url($speaker_twitter); ?>" target="_blank">
                                                            <img src="<?php echo esc_attr($assets_uri); ?>/images/tw.svg" alt="">
                                                        </a>
                                                    </li>
                                                    <?php } if (!empty($speaker_linkedin)) { ?>
                                                    <li>
                                                        <a href="<?php echo esc_url($speaker_linkedin); ?>" target="_blank">
                                                            <img src="<?php echo esc_attr($assets_uri); ?>/images/in.svg" alt="">
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
                    <?php
                    if ($post->ID == $board_of_directors_page_id) {
                        get_template_part('template-parts/content', 'honorary-directors');
                    }
                    ?>
                </div>

                <?php if ($is_show_sidebar) : ?>
                    <div class="col-sm-6 offset-sm-1">
                        <?php get_sidebar(); ?>
                    </div>
                <?php endif; ?>
            
            </div>
        </div>
    </article>
</section>
<?php
get_footer();
?>
