<?php
$speaker_id = $args['speaker_id'];

$volunteer_img = get_field('profile_image', 'user_' . $speaker_id);
$volunteer_img = !empty($volunteer_img) ? $volunteer_img : get_asset_uri('/images/placeholder.png');
$volunteer_mit_status = is_mit_alum($speaker_id);
$volunteer_first_name = get_field('full_name', 'user_' . $speaker_id);
$volunteer_last_name = get_field('user_last_name', 'user_' . $speaker_id);
$designations = array();
if (have_rows('designations', 'user_' . $speaker_id)) {
    while (have_rows('designations', 'user_' . $speaker_id)) {
        the_row();
        $designations[] = get_sub_field('designation_title', 'user_' . $speaker_id);
    }
}
$teams = get_field('teams', 'user_' . $speaker_id);
$affiliations_mit = array();
$affiliations_other = array();
$affiliations = get_field('affiliations', 'user_' . $speaker_id);
if ($affiliations) {
    foreach ($affiliations as $affiliation) {
        if (!empty($affiliation)) {
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
$volunteer_facebook = get_field('facebook', 'user_' . $speaker_id);
$volunteer_twitter = get_field('twitter', 'user_' . $speaker_id);
$volunteer_linkedin = get_field('linkedin', 'user_' . $speaker_id);

if (!empty($volunteer_first_name) || !empty($volunteer_last_name)) {
    ?>
    <div class="col-12 col-lg-6 col-md-12"
         data-team_member="<?php echo esc_html(strtolower(str_replace(array("'", '  '), array('', ' '), $volunteer_first_name . ' ' . $volunteer_last_name))); ?>">

        <div class="speaker-card">
            <a href="<?php echo esc_url(get_author_posts_url($speaker_id)); ?>">
                <div class="card-img">
                    <img src="<?php echo esc_url($volunteer_img); ?>" alt="">
                    <div class="icon-mit">
                        <img src="<?php echo esc_url(get_asset_uri('/images/mit-icon.svg')); ?>" alt="">
                    </div>
                </div>
                <div class="card-text">
                    <div class="name">
                        <h3><?php echo esc_html($volunteer_first_name) . ' ' . esc_html($volunteer_last_name); ?></h3>
                        <span class="code"><?php echo esc_html((!empty($affiliations_mit)) ? implode(', ', $affiliations_mit) : ''); ?></span>
                    </div>
                    <?php if (have_rows('positions', 'user_' . $speaker_id)) { ?>
                        <div class="company-name <?php echo (empty($volunteer_facebook) && empty($volunteer_twitter) && empty($volunteer_linkedin) && 0) ? 'no-border' : ''; ?>">
                            <?php
                            if (have_rows('positions', 'user_' . $speaker_id)) {
                                while (have_rows('positions', 'user_' . $speaker_id)) {
                                    the_row();
                                    ?>
                                    <h4><?php the_sub_field('company', 'user_' . $speaker_id); ?></h4>
                                    <span><?php the_sub_field('job_title', 'user_' . $speaker_id); ?></span>
                                    <?php
                                    break;
                                }
                            }
                            ?>

                        </div>
                    <?php } ?>
                    <?php if (!empty($volunteer_facebook) || !empty($volunteer_twitter) || !empty($volunteer_linkedin)) { ?>
                        <div class="border-dotted"></div>
                        <div class="tags-box"></div>

                    <?php } ?>
                    <ul class="social-icons">
                        <?php if (!empty($volunteer_facebook)) { ?>
                            <li>
                                <a href="<?php echo esc_url($volunteer_facebook); ?>" target="_blank">
                                    <img src="<?php echo esc_url(get_asset_uri('/images/fb.svg')); ?>"
                                         alt="Facebook logo">
                                </a>
                            </li>
                            <?php
                        }
                        if (!empty($volunteer_twitter)) {
                            ?>
                            <li>
                                <a href="<?php echo esc_url($volunteer_twitter); ?>" target="_blank">
                                    <img src="<?php echo esc_url(get_asset_uri('/images/tw.svg')); ?>"
                                         alt="Twitter logo">
                                </a>
                            </li>
                            <?php
                        }
                        if (!empty($volunteer_linkedin)) {
                            ?>
                            <li>
                                <a href="<?php echo esc_url($volunteer_linkedin); ?>" target="_blank">
                                    <img src="<?php echo esc_url(get_asset_uri('/images/in.svg')); ?>"
                                         alt="LinkedIn logo">
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
