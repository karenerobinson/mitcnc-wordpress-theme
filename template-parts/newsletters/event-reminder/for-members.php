<?php
global $post_id,
    $assets_uri,
    $output_html_for_members,
    $output_html_for_non_members,
    $output_html_for_non_alum,
    // following are the globalizations of dynamic variables which are being set up from DB
    $show_date,
    $show_newsletter_banner,
    $newsletter_banner,
    $newsletter_banner_link,
    $show_intro,
    $event_for_reminder,
    $event_for_reminder_date,
    $intro_heading,
    $intro,
    $show_get_involved,
    $get_involved_heading,
    $show_upcoming_events,
    $upcoming_events_heading,
    $upcoming_events,
    $show_join_the_conversation,
    $join_the_conversation_heading,
    $show_how_are_we_doing,
    $how_are_we_doing_heading,
    $show_footer,
    $show_volunteer,
    $volunteer_heading,
    $volunteer_list,
    $show_brass_rats,
    $brass_rats_heading,
    $brass_rats,
    $show_brain_teaser,
    $puzzles_heading,
    $puzzles,
    $show_membership_status,
    $dark_mode,
    $newsletter_display_mode,
    $show_donation;
?>
<style>
    html,
    body {
        background: #e4e4e4;
        margin: 0;
        padding: 0;
    }
</style>

<div style="background-color:<?php echo esc_attr($newsletter_display_mode['bg_color']); ?>; width:100%">
    <table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="<?php echo esc_attr($newsletter_display_mode['bg_color']); ?>" style="width: 680px; overflow: hidden;">
        <tbody>
        <?php if ($show_date) { ?>
            <tr>
                <td style="padding: 10px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>; font-size: 14px; font-family: Helvetica, Arial, sans-serif; text-align: right;">
                    <strong>
                        <?php echo !empty($event_for_reminder_date) ? esc_html(date('l, F j, Y', strtotime($event_for_reminder_date))) : get_the_date('l, F j, Y', $post_id); ?></strong>
                </td>
            </tr>
        <?php } ?>

        <?php if ($show_newsletter_banner && !empty($newsletter_banner)) { ?>
            <tr>
                <td>
                    <?php echo (!empty($newsletter_banner_link)) ? '<a href="' . esc_url($newsletter_banner_link) . '">' : ''; ?>
                        <img style="border-top-left-radius: 4px; border-top-right-radius: 4px;" width="680" src="<?php echo esc_url($newsletter_banner); ?>" />
                    <?php echo (!empty($newsletter_banner_link)) ? '</a>' : ''; ?>
                </td>
            </tr>
        <?php } else if ($show_intro && !empty($event_for_reminder)) { ?>
            <tr>
                <td>
                    <a href="<?php echo esc_url(get_permalink($event_for_reminder)); ?>">
                        <img style="border-top-left-radius: 4px; border-top-right-radius: 4px;" width="680" src="<?php echo esc_url(get_field('newsletter_event_image', $event_for_reminder)); ?>" />
                    </a>
                </td>
            </tr>
        <?php } ?>

        <?php if ($show_intro && !empty($intro)) { ?>
            <tr>
                <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-bottom-right-radius: 4px; border-bottom-left-radius: 4px;  box-shadow:1px 1px 1px #ccc;">
                    <?php if (!empty($intro_heading)) { ?>
                        <span style="padding: 6px 0px 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;"><?php echo esc_html($intro_heading); ?></span>
                    <?php } ?>
                    <table border="0" width="100%" cellspacing="0" cellpadding="0" <?php echo (!empty($intro_heading)) ? 'style="padding-top: 14px;"' : ''; ?>>
                        <tbody>
                        <tr>
                            <td style="font-family:Helvetica, Arial, sans-serif; font-size: 16px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;  padding: 0 0 20px 0; font-weight: normal; border-bottom: 1px dotted #adadb9;" colspan="2">
                                <?php echo filter_var(wpautop($intro), FILTER_UNSAFE_RAW); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php } ?>

        <?php if ($show_get_involved) { ?>
            <tr>
                <td> </td>
            </tr>
            <tr>
                <td style="background-color:<?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; ; box-shadow: 1px 1px 1px #ccc; border-radius: 4px;">
                    <table width="640" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td>
                                    <span style="padding: 6px 0px 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
                                        <?php echo (!empty($get_involved_heading)) ? esc_html($get_involved_heading) : 'Get Involved'; ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td> &nbsp; &nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" cellspacing="0" cellpadding="10" border="0">
                                        <tbody>
                                            <tr>
                                                <td style="font-family: Helvetica, Arial, sans-serif;background-color:<?php echo esc_attr($newsletter_display_mode['bg_green']); ?>;border: 3px solid #6e6f7b;text-align: center;font-size: 14px;" width="180">
                                                    <a style="text-decoration: none; color: #fff;" href="<?php echo esc_html(home_url('get-involved/volunteer')); ?>">Volunteer</a>
                                                </td>
                                                <td width="0"></td>
                                                <td style="font-family: Helvetica, Arial, sans-serif;background-color: <?php echo esc_attr($newsletter_display_mode['bg_green']); ?>;border: 3px solid #6e6f7b;text-align: center;;font-size: 14px;" width="180">
                                                    <a style="text-decoration: none; color: #fff;" href="<?php echo esc_html(home_url('get-involved/venue')); ?>eventspaces/">Host</a>
                                                </td>
                                                <td width="0"></td>
                                                <td style="font-family: Helvetica, Arial, sans-serif;background-color: <?php echo esc_attr($newsletter_display_mode['bg_green']); ?>;border: 3px solid #6e6f7b;text-align: center;font-size: 14px;" width="180">
                                                    <a style="text-decoration: none; color: #fff;" href="<?php echo esc_html(home_url('get-involved/speaker')); ?>">Speak</a>
                                                </td>
                                                <td width="0"></td>
                                                <td style="font-family: Helvetica, Arial, sans-serif;background-color: <?php echo esc_attr($newsletter_display_mode['bg_green']); ?>;border: 3px solid #6e6f7b;text-align: center;;font-size: 14px;" width="180">
                                                    <a style="text-decoration: none; color: #fff;" href="<?php echo esc_html(home_url('get-involved/sponsor')); ?>">Sponsor</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php } ?>

        <?php if ($show_upcoming_events && $upcoming_events != null) { ?>
            <tr>
                <td> </td>
            </tr>
            <tr>
                <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;" valign="top">
                    <span style="padding: 6px 0px 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
                        <?php echo !empty($upcoming_events_heading) ? esc_html($upcoming_events_heading) : 'Upcoming Events'; ?>
                    </span>
                    <p style="font-family: Helvetica, Arial, sans-serif; font-size: 16px;  padding: 5px 0 0px 0; font-weight: normal; display: block; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;"> See these and all our events at <a href="https://www.mitcnc.org/events-listing/"> mitcnc.org/events</a></p>
                    <table width="640" border="0" cellspacing="0" cellpadding="0" style="padding-top: 14px;">
                        <tbody>
                        <tr>
                            <td width="100%" valign="top">
                                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <?php
                                        foreach ($upcoming_events as $key => $upcoming_event) {
                                            $image = get_field('newsletter_event_image', $upcoming_event);
                                            if (!empty($image)) {
                                                ?>
                                                    <tr>
                                                        <td style="padding-bottom: 14px;">
                                                            <a href="<?php echo esc_url(get_permalink($upcoming_event)); ?>">
                                                                <img style="border-radius: 4px;" src="<?php echo esc_url($image); ?>" width="640" />
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php } ?>

        <?php if ($show_volunteer && $volunteer_list != null) { ?>
            <tr>
                <td> </td>
            </tr>
            <tr>
                <td style="background-color:<?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-radius: 4px;  box-shadow:1px 1px 1px #ccc;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="font-family:Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;  padding: 24px 0 16px 0px; font-weight: normal;" colspan="2"><?php echo !empty($volunteer_heading) ? esc_html($volunteer_heading) : 'Volunteer Spotlight'; ?></td>
                            </tr>
                            <?php
                            foreach ($volunteer_list as $volunteer) {
                                $mit_affiliation = get_field('affiliations', 'user_' . $volunteer);
                                $image_for_newsletter = get_field('image_for_newsletter', 'user_' . $volunteer);
                                $linkedin = get_field('linkedin', 'user_' . $volunteer);
                                ?>
                                    <tr>
                                        <td align="left" valign="top">
                                            <a href="<?php echo esc_url($linkedin); ?>" target="_blank" style="position:relative; display: block;">
                                            <?php if (!empty($image_for_newsletter)) { ?>
                                                    <img src="<?php echo esc_url($image_for_newsletter); ?>" alt="" width="220" height="220" style="max-width: 220px; display: block;">
                                            <?php } else { ?>
                                                    <img src="<?php echo esc_attr(get_field('profile_image', 'user_' . $volunteer)); ?>" alt="" width="220" height="220" style="max-width: 220px; display: block;">
                                            <?php } ?>
                                            </a>
                                            <br><br>
                                        </td>
                                        <td  valign="top" style="padding-left: 20px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
                                            <p style="font-family:Helvetica, Arial, sans-serif; font-size: 14px;">
                                                <span style="padding: 10px 0;">
                                                    <span style="text-transform: uppercase; font-weight: bold; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: rgb(210, 16, 51);">
                                                    <?php
                                                    echo esc_html(get_field('full_name', 'user_' . $volunteer));
                                                    echo ' ';
                                                    echo esc_html(get_field('user_last_name', 'user_' . $volunteer));
                                                    echo ' ';
                                                    if ($mit_affiliation != null) {
                                                        $affiliation_container_start = '<span style="font-family: Helvetica, Arial, sans-serif; font-weight: normal; font-size: 24px; color: rgb(173, 173, 185); text-transform:none;">';
                                                        $affiliation_container_end = '</span>';
                                                        $affiliation_output = '';
                                                        foreach ($mit_affiliation as $key => $affiliation) {
                                                            if (is_array($affiliation) && $affiliation != null) {
                                                                $count_affiliation = count($affiliation);
                                                                for ($i = 0; $i < $count_affiliation; $i++) {
                                                                    if (!empty($affiliation[$i]['mit_affiliation_title'])) {
                                                                        $affiliation_output .= (isset($affiliation[$i]['mit_affiliation_title']) ? esc_html($affiliation[$i]['mit_affiliation_title']) : '');
                                                                    } if (!empty($affiliation[$i]['other_affiliation_title'])) {
                                                                        $affiliation_output .= (isset($affiliation[$i]['other_affiliation_title']) ? esc_html($affiliation[$i]['other_affiliation_title']) : '');
                                                                    }
                                                                    $affiliation_output .=  ', ';
                                                                }
                                                            }
                                                        }
                                                        echo filter_var(($affiliation_container_start . rtrim($affiliation_output, ', ') . $affiliation_container_end), FILTER_UNSAFE_RAW);
                                                    }
                                                    ?>
                                                    </span>
                                                    <br>
                                                    <?php
                                                    if (have_rows('designations', 'user_' . $volunteer)) {
                                                        while (have_rows('designations', 'user_' . $volunteer)) {
                                                            the_row();
                                                            ?>
                                                            <span style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: rgb(85, 85, 95);">
                                                            <?php echo esc_html(get_sub_field('designation_title', 'user_' . $volunteer)); ?></span>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </p>
                                            <?php if (!empty(get_field('bio', 'user_' . $volunteer))) { ?>
                                                <?php echo filter_var(str_replace('<p>', '<p style="font-family:Helvetica, Arial, sans-serif; font-size: 14px;">', get_field('bio', 'user_' . $volunteer)), FILTER_UNSAFE_RAW); ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php } ?>

        <?php if ($show_brass_rats && $brass_rats != null) { ?>
            <tr>
                <td> </td>
            </tr>

            <tr>
                <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: bold; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>; padding: 0 0 10px 0;">
                                <?php echo !empty($brass_rats_heading) ? esc_html($brass_rats_heading) : 'Brass Rats'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $image = get_the_post_thumbnail_url($brass_rats, 'thumbnail_1079_474');
                                    $auth_name = get_field('author_name', $brass_rats);
                                    $auth_name = !empty($auth_name) ? explode(',', $auth_name) : $auth_name;
                                    ?>
                                    <img src="<?php echo esc_url($image); ?>" style="width: 640px;" />
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;" align="right">
                                    <span style="font-weight: bold; font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
                                        <?php
                                        echo esc_html((isset($auth_name[0])) ? $auth_name[0] : '');
                                        if ($auth_name != null && count($auth_name) >= 2) {
                                            $count_auth_name = count($auth_name);
                                            for ($j = 1; $j < $count_auth_name; $j++) {
                                                echo ', <span style="font-weight: normal;">' . esc_html($auth_name[$j]) . '</span>';
                                            }
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td> </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php } ?>

        <?php if ($show_brain_teaser && $puzzles != null) { ?>
            <tr>
                <td> </td>
            </tr>

            <tr>
                <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                        <?php if ($puzzles != null) { ?>
                            <tr>
                                <td style="font-family: 'Helvetica Neue', Helvetica, Arial; font-size: 18px; font-weight: bold; color:<?php echo esc_attr($newsletter_display_mode['font_color']); ?>; padding: 20px 0 10px 0;">
                                <?php echo !empty($puzzles_heading) ? esc_html($puzzles_heading) : 'Brain Teaser'; ?> <br>
                                    <?php
                                    $teaser = get_post($puzzles);
                                    $image = get_the_post_thumbnail_url($teaser->ID, 'full');
                                    $powered_by = get_field('powered_by', $teaser->ID);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" cellspacing="0" cellpadding="8" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="text-align:center;"><img src="<?php echo esc_url($image); ?>" alt="" width="250"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 11.0pt; font-family: 'Helvetica Neue', Helvetica, Arial; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;" valign="top">
                                                <?php echo filter_var(str_replace('<img ', '<img style="max-width: 100%;"', $teaser->post_content), FILTER_UNSAFE_RAW); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tbody>
                                                    <tr>
                                                        <td style="background-color: #63636e; text-align: center; border-radius: 2px; padding: 10px 30px; display: block;">
                                                            <a style="color: #fff; font-family: 'Helvetica Neue', Helvetica, Arial; text-decoration: none;" href="<?php echo esc_url(get_permalink($teaser->ID)); ?>">Check your Answer</a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" cellspacing="0" cellpadding="8" border="0">
                                        <tbody>
                                            <tr>
                                                <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; text-align: center; border-color:#333333; border-radius: 2px; border-width: 5px;  padding: 10px 30px;  display: block;">
                                                    <p style="font-family: Helvetica, Arial, sans-serif; font-size: 11.0pt; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
                                                        Like these puzzles? For a limited time, MIT alumni and friends can
                                                        get 20% off Brilliant Premium for access to daily challenges and
                                                        more. Go to <a style="color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;"
                                                            href="http://brilliant.org/mitcnc">http://brilliant.org/mitcnc</a>
                                                        to unlock the discount!
                                                    </p>
                                                    <a href="https://brilliant.org/">
                                                        <img src="<?php echo esc_url($powered_by); ?>" alt="" width="184">
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php } ?>

        <?php if ($show_membership_status) { ?>
            <tr>
                <td> </td>
            </tr>

            <tr>
                <td style="background-color: <?php echo esc_attr($newsletter_display_mode['gray_bg']); ?>; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                        <span style="padding: 6px 0px 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
                            MITCNC Membership Status
                        </span>
                    <p style="font-family: Helvetica, Arial, sans-serif; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
                        <strong>##Full Name## </strong>
                        <br />
                        Membership Level: <strong>##CNC Membership Level##</strong>
                        <br />
                        Membership Expiration Date: <strong style="color: #a31f34;">##CNC Membership Expiration
                            Date## </strong>
                    </p>
                    <p style="font-family: Helvetica, Arial, sans-serif; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
                        <strong> Renew early </strong> - MITCNC introduced an anniversary-based membership that
                        begins on the day you join, where a year is added to your membership expiration date if you
                        renew early. We also launched an auto-renewal option for easy renewals.
                    </p>
                    <table style="background-color: <?php echo esc_attr($newsletter_display_mode['light_gray_bg']); ?>; text-align: center; border-radius: 2px; font-family: Helvetica, Arial, sans-serif;" border="0" width="100%" cellspacing="20" cellpadding="20">
                        <tbody>
                        <tr>
                            <td style="border: 1px solid <?php echo esc_attr($newsletter_display_mode['gray_bg']); ?>; color: <?php echo esc_attr($newsletter_display_mode['gray_bg']); ?>; font-size: 16px;">
                            <a style="color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>; font-family: Helvetica, Arial, sans-serif; text-decoration: none; font-size: 18px; font-weight: bold;" href="<?php echo esc_url(get_membership_url()); ?>">
                                    Renew Your MITCNC Membership Today!! <img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/arrow-right1.png" alt="" width="28" height="20" />
                                    <br />
                                </a> Membership is open to all MIT graduates.
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php } ?>

        <?php if ($show_join_the_conversation) { ?>
            <tr>
                <td> </td>
            </tr>

            <tr>
                <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                    <table border="0" width="640" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td colspan="4" style="padding: 6px 0px 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color:<?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
                                <?php echo !empty($join_the_conversation_heading) ? esc_html($join_the_conversation_heading) : 'Join The Conversation...'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:25%;padding:0;border:1pt solid #EBEBEB;">
                                <p align="center" style="font-size:12pt;font-family:Times New Roman,serif;text-align:center;margin:0;">
                                    <a href="https://mitcnc.slack.com/join/signup" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable"><span style="text-decoration:none;"><img data-imagetype="External" src="<?php echo esc_attr($newsletter_display_mode['slack_logo']); ?>" width="150"  border="0" id="_x0000_i1051"></span></a>
                                </p>
                            </td>
                            <td style="width:25%;padding:0;border:1pt solid #EBEBEB;">
                                <p align="center" style="font-size:12pt;font-family:Times New Roman,serif;text-align:center;margin:0;">
                                    <a href="https://www.linkedin.com/company/mitcnc/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable"><span style="text-decoration:none;"><img data-imagetype="External" src="<?php echo esc_url($assets_uri); ?>/images/newsletter/LinkedIn-Logo.png" width="150" border="0" id="_x0000_i1052"></span></a>
                                </p>
                            </td>
                            <td style="width:25%;padding:0;border:1pt solid #EBEBEB;">
                                <p align="center" style="font-size:12pt;font-family:Times New Roman,serif;text-align:center;margin:0;">
                                    <a href="https://www.facebook.com/groups/mitcnc/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable"><span style="text-decoration:none;"><img data-imagetype="External" src="<?php echo esc_url($assets_uri); ?>/images/newsletter/facebook-logo.png" width="104"   border="0" id="_x0000_i1053"></span></a>
                                </p>
                            </td>
                            <td style="width:25%;padding:0;border-width:1pt;border-style:solid solid solid none;border-color:#EBEBEB;">
                                <p align="center" style="font-size:12pt;font-family:Times New Roman,serif;text-align:center;margin-right:0;margin-left:0;">
                                    <a href="https://twitter.com/mitcnc" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable"><span style="text-decoration:none;"><img data-imagetype="External" src="<?php echo esc_url($assets_uri); ?>/images/newsletter/twitter-icon-134pixel.png" width="62" height="50" border="0" id="_x0000_i1054"></span></a>
                                </p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php } ?>

        <?php if ($show_donation) { ?>
            <tr>
                <td> </td>
            </tr>
            
            <tr>
                <td>
                    <table style="background-color: #A31F34; text-align: center; border-radius: 2px; font-family: Helvetica, Arial, sans-serif;" border="0" width="100%" cellspacing="20" cellpadding="20">
                        <tbody>
                        <tr>
                            <td style="border: 1px solid #adadb9; color: #adadb9;"><a style="color: #fff; font-family: Helvetica, Arial, sans-serif; text-decoration: none; font-size: 18px; font-weight: bold;" href="https://www.mitcnc.org/covid-19/donate/">Make
                                    A Tax-Deductible Donation To Our Scholarship Fund <img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/arrow-right1.png" alt="" width="28" height="20" /><br /> </a><span style="font-size: 16px; color: #f1a3b1;">Membership is open to all MIT graduates.</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php } ?>

        <?php if ($show_how_are_we_doing) { ?>
            <tr>
                <td> </td>
            </tr>
            <tr>
                <td style="background-color: <?php echo esc_attr($newsletter_display_mode['gray_bg']); ?>; color: #121217; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                    <span style="padding: 6px 0px 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
                        <?php echo !empty($how_are_we_doing_heading) ? esc_html($how_are_we_doing_heading) : 'How Are We Doing?'; ?>
                    </span>
                    <p style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">How are we doing? Please send your suggestions & comments to me at <a style="color: #0072ff;" href="mailto:president@mitcnc.org">president@mitcnc.org </a>
                    </p>
                    <p style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">See you at our
                            next event!!</p>
                    <p style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;"><strong>Karen E. Robinson '02</strong><br />
                        President<br>
                        MIT Club of Northern California</p>
                </td>
            </tr>
        <?php } ?>

        <?php if ($show_footer) { ?>
            <tr>
                <td> </td>
            </tr>
            <tr>
                <td style="background-color: #121217; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                    <table style="font-family: Helvetica, Arial, sans-serif; color: #adadb9;" border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td style="padding-bottom: 10px;" width="60%"><img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/footer-logo.png" alt="" width="85" height="60" /></td>
                            <td align="left" valign="middle" width="40%"><img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/logo-mitcnc-white.png" alt="" width="220" height="50" /></td>
                        </tr>
                        <tr>
                            <td>
                                <p><strong>##Sender_Org##</strong> <br />##Sender_Address##, ##Sender_City## <br />
                                ##Sender_State##</p>
                                <p style="font-size: 14px;"><a style="color: #adadb9; text-decoration: none;" href="https://alum.mit.edu/about/privacy-statement">Privacy
                                        Policy</a> | <a style="color: #adadb9; text-decoration: none;" href="##Unsubscribe_URL##">##Unsubscribe##</a>
                                </p>
                            </td>
                            <td align="left" valign="top">
                                <p><a style="color: #adadb9; text-decoration: none;" href="mailto:clubadmin@mitcnc.org">clubadmin@mitcnc.org</a>
                                </p>
                                <table width="100%" cellspacing="0" cellpadding="0" align="left">
                                    <tbody>
                                    <tr>
                                        <td style="font-family: Helvetica, Arial, sans-serif; color: #adadb9;" colspan="5">Connect with Us
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20" height="30"><a href="https://www.facebook.com/groups/mitcnc/">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/facebook.png" alt="" width="8" height="16" /></a></td>
                                        <td width="30"><a href="http://www.twitter.com/mitcnc"> <img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/twitter.png" alt="" width="17" height="14" /></a></td>
                                        <td width="30"><a href="https://www.linkedin.com/company/mitcnc/"> <img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/linkedin.png" alt="" width="17" height="16" /></a></td>
                                        <td width="30"><a href="https://www.instagram.com/mitcnc/?hl=en"> <img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/insta-email-footer-icon.png" alt="" width="17" height="16" /></a></td>
                                        <td ><a href="https://mitcnc.slack.com/join/signup#/"> <img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/slack-gray-logo.png" alt="" width="17" height="16" /></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>    
