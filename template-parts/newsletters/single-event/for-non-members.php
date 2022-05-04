<?php
global $event_url,
       $assets_uri,
       $event,
       $event_banner,
       $event_start_on,
       $event_end_on,
       $event_start_on_date,
       $event_end_on_date,
       $event_start_on_day,
       $event_start_on_date_full,
       $event_start_on_time,
       $event_end_on_time,
       $event_agenda,
       $event_address,
       $event_address_1,
       $event_address_2,
       $event_address_city,
       $event_address_state,
       $event_address_postal_code,
       $event_primary_contact,
       $event_speakers,
       $event_moderators,
       $event_sold_out_flag,
       $mit_registration,
       $event_location,
       $virtual_cat_id,
       $dark_mode,
       $newsletter_display_mode,
       $non_mit_registration;
?>
<style type="text/css">
    body {
        background-color: #e4e4e4;
    }
</style>

<div style="background-color:<?php echo esc_attr($newsletter_display_mode['bg_color']); ?>; width:100%">
    <table border="0" width="640" cellspacing="0" cellpadding="0" align="center" bgcolor="<?php echo esc_attr($newsletter_display_mode['bg_color']); ?>">
        <tbody>
        <tr>
            <td style="padding: 20px;">
                <img src="<?php echo esc_attr($newsletter_display_mode['mit_logo']); ?>" width="200" alt="">
            </td>
        </tr>
        <tr>
            <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-radius: 4px;  box-shadow:1px 1px 1px #ccc;">
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                    <?php if (!empty($event_banner)) { ?>
                        <tr>
                            <td>
                                <a href="<?php echo esc_url($event_url); ?>">
                                    <img style="border-radius: 4px;" src="<?php echo esc_url($event_banner); ?>" alt="" width="600" />
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>
                            <p>&nbsp;<br>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top;">
                            <table border="0" width="100%" cellspacing="0" cellpadding="10">
                                <tbody>
                                <tr>
                                    <td style="color: <?php echo esc_attr($newsletter_display_mode['inner_content_color']); ?>; font-family:Helvetica, Arial, sans-serif; border-right-style:solid; border-right-color:#CCC; border-right-width:1px;">
                                        <?php
                                        if (!empty($event->post_content)) {
                                            ?>
                                            <?php echo filter_var(wpautop($event->post_content), FILTER_UNSAFE_RAW); ?>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td width="200" style="vertical-align:top;">
                                        <table border="0" width="200" cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr>
                                                <td style="background-color: <?php echo ($event_sold_out_flag || strtotime($event_end_on) < time()) ? '#333333' : '#30b630'; ?>; text-align: center; border-radius: 2px; padding: 10px 30px; display: block; ">
                                                    <?php if (strtotime($event_end_on) < time()) { ?>
                                                        <a style="color: #fff; font-family:Helvetica, Arial, sans-serif; text-decoration: none;" href="javascript:void(0);">
                                                            <strong>Event Closed</strong>
                                                        </a>
                                                    <?php } else if ($event_sold_out_flag) { ?>
                                                        <a style="color: #fff; font-family:Helvetica, Arial, sans-serif; text-decoration: none;" href="javascript:void(0);">
                                                            <strong>Sold Out</strong>
                                                        </a>
                                                    <?php } else { ?>
                                                        <a style="color: #fff; font-family:Helvetica, Arial, sans-serif; text-decoration: none;" href="<?php echo esc_url($event_url); ?>#section--registration">
                                                            <strong>Reserve Now</strong>
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 15px;font-family:Arial, Helvetica, sans-serif; color: <?php echo esc_attr($newsletter_display_mode['inner_content_color']); ?>; font-weight: bolder">
                                                    <strong title="">
                                                    Date and Time
                                                </strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; font-family:Arial, Helvetica, sans-serif; color: <?php echo esc_attr($newsletter_display_mode['inner_content_color']); ?>; font-weight: 500; line-height: 150%;">
                                                <?php echo esc_html($event_start_on_day); ?><br>
                                                    <?php echo esc_html($event_start_on_date_full); ?>
                                                    <br>
                                                    <?php echo esc_html($event_start_on_time); ?> - <?php echo esc_html($event_end_on_time); ?> PT
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php if (isset($event_location[0]->term_id) && $event_location[0]->term_id != $virtual_cat_id) { ?>
                                                        <p style="font-family:Helvetica, Arial, sans-serif; font-size: 15px; color: #555; padding-top:10px; line-height: 150%;">
                                                            <strong>LOCATION </strong><br>
                                                            <?php
                                                            echo !empty($event_address) ? '<span style="font-size: 15px; font-weight: 500; color: rgb(0, 0, 0);">' . esc_html($event_address) . '</span><br>' : '';
                                                            echo !empty($event_address_1) ? esc_html($event_address_1) . '<br>' : '';
                                                            echo !empty($event_address_2) ? esc_html($event_address_2) . '<br>' : '';
                                                            if (isset($event_address_city['label']) && !empty($event_address_city['label'])) {
                                                                echo esc_html($event_address_city['label']);
                                                            }
                                                            if (isset($event_address_city['label']) && !empty($event_address_city['label']) && !empty($event_address_state)) {
                                                                echo ', ';
                                                            }
                                                            if (!empty($event_address_state)) {
                                                                echo esc_html($event_address_state);
                                                            }
                                                            if (!empty($event_address_postal_code)) {
                                                                echo esc_html($event_address_postal_code);
                                                            }
                                                            if (
                                                                isset($event_address_city['label']) ||
                                                                !empty($event_address_city['label']) ||
                                                                !empty($event_address_state) ||
                                                                !empty($event_address_postal_code)
                                                            ) {
                                                                echo '<br>';
                                                            }
                                                            ?>
                                                            <a href="<?php echo esc_url($event_url); ?>#map-container" target="_blank" style="color: #81a6fb; text-decoration: none;">View  Map</a>
                                                        </p>
                                                    <?php } ?>
                                                    <?php
                                                    if (
                                                        (isset($event_primary_contact['name']) && !empty($event_primary_contact['name'])) ||
                                                        (isset($event_primary_contact['email']) && !empty($event_primary_contact['email']))
                                                    ) {
                                                        ?>
                                                        <p style="font-family:Helvetica, Arial, sans-serif; font-size: 15px; color: #555; padding-top:10px; line-height: 150%;">
                                                            <strong> Contacts  </strong><br>
                                                                    <?php echo (!empty($event_primary_contact['name'])) ? '<strong style="font-weight: normal; color: rgb(91, 91, 91);">' . esc_html($event_primary_contact['name']) . '</strong><br>' : ''; ?>
                                                                    <?php echo (!empty($event_primary_contact['email'])) ? '<a href="mailto:' . esc_url($event_primary_contact['email']) . '" style="font-size: 15px;  color: #81a6fb;  line-height: 150%; text-decoration: none; font-weight:400;">' . esc_url($event_primary_contact['email']) . '</a>' : ''; ?>
                                                        </p>
                                                                    <?php
                                                    }
                                                    ?>
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
                    </tbody>
                </table>
            </td>
        </tr>
        <?php if ($event_speakers != null) { ?>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; padding-bottom: 0px; border-top-left-radius: 4px;  border-top-right-radius: 4px; box-shadow:1px 1px 1px #ccc;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="font-family:Helvetica, Arial, sans-serif; font-size: 24px; color:<?php echo esc_attr($newsletter_display_mode['font_color']); ?>; font-weight: normal; padding-bottom: 15px;" colspan="2">
                                <?php
                                    echo 'Speaker' . ((count($event_speakers) > 1) ? 's' : '');
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php
            foreach ($event_speakers as $speaker_id) {
                $mit_affiliation = get_field('affiliations', 'user_' . $speaker_id);
                $image_for_newsletter = get_field('image_for_newsletter', 'user_' . $speaker_id);
                $linkedin = get_field('linkedin', 'user_' . $speaker_id);
                ?>
                <tr>
                    <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; padding-top: 0px; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px; border-top-left-radius: 0px; border-top-right-radius: 0px; box-shadow:1px 1px 1px #ccc; font-family: Helvetica, Arial, sans-serif; font-size: 14px;">
                        <table border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="left" valign="top">
                                        <a href="<?php echo esc_url(get_author_posts_url($speaker_id)); ?>" target="_blank" style="position:relative; display: block;">
                                        <?php if (!empty($image_for_newsletter)) { ?>
                                            <img src="<?php echo esc_url($image_for_newsletter); ?>" alt="" width="220" height="220" style="max-width: 220px; display: block;">
                                        <?php } else { ?>
                                            <img src="<?php echo esc_url(get_field('profile_image', 'user_' . $speaker_id)); ?>" alt="" width="220" height="220" style="max-width: 220px; display: block;">
                                        <?php } ?>
                                       </a>          
                                    <br><br>
                                </td>
                                <td  valign="top" style="padding-left: 20px; font-family: Helvetica, Arial, sans-serif; font-size: 14px;">
                                    <p style="font-family:Helvetica, Arial, sans-serif; font-size: 14px;">
                                        <span style="padding: 10px 0;">
                                            <span style="text-transform: uppercase; font-weight: bold; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: rgb(210, 16, 51);">
                                                <?php
                                                echo esc_html(get_field('full_name', 'user_' . $speaker_id));
                                                echo ' ';
                                                echo esc_html(get_field('user_last_name', 'user_' . $speaker_id));
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
                                                if (have_rows('positions', 'user_' . $speaker_id)) {
                                                    while (have_rows('positions', 'user_' . $speaker_id)) {
                                                        the_row();
                                                        ?>
                                                        <span style="font-size: 16px;font-family: Helvetica, Arial, sans-serif; color: <?php echo esc_attr($newsletter_display_mode['job_title_color']); ?>; display: block;"><?php echo esc_html(get_sub_field('job_title', 'user_' . $speaker_id)); ?></span>
                                                        <span style="font-size: 16px;  font-family: Helvetica, Arial, sans-serif; color: <?php echo esc_attr($newsletter_display_mode['company_color']); ?>; display: block;"><?php echo esc_html(get_sub_field('company', 'user_' . $speaker_id)); ?></span>
                                                        <?php
                                                        break;
                                                    }
                                                }
                                                ?>
                                                
                                            </span>
                                            <br>
                                            
                                        </span>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
            }
            ?>
            <?php
        }
        ?>
        <?php if ($event_moderators != null) { ?>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; padding-bottom: 0px; border-top-left-radius: 4px;  border-top-right-radius: 4px; box-shadow:1px 1px 1px #ccc;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="font-family:Helvetica, Arial, sans-serif; font-size: 24px; color:<?php echo esc_attr($newsletter_display_mode['font_color']); ?>; font-weight: normal; padding-bottom: 15px;" colspan="2">
                                <?php
                                    echo 'Moderator' . ((count($event_moderators) > 1) ? 's' : '');
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php
            foreach ($event_moderators as $moderators_id) {
                $mit_affiliation = get_field('affiliations', 'user_' . $moderators_id);
                $image_for_newsletter = get_field('image_for_newsletter', 'user_' . $moderators_id);
                $linkedin = get_field('linkedin', 'user_' . $moderators_id);
                ?>
                <tr>
                    <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; padding-top: 0px; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px; border-top-left-radius: 0px; border-top-right-radius: 0px; box-shadow:1px 1px 1px #ccc; font-family: Helvetica, Arial, sans-serif; font-size: 14px;">
                        <table border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="left" valign="top">
                            
                                        <a href="<?php echo esc_url(get_author_posts_url($moderators_id)); ?>" target="_blank" style="position:relative; display: block;">
                                    
                                        <?php if (!empty($image_for_newsletter)) { ?>
                                            <img src="<?php echo esc_url($image_for_newsletter); ?>" alt="" width="220" height="220" style="max-width: 220px; display: block;">
                                        <?php } else { ?>
                                            <img src="<?php echo esc_url(get_field('profile_image', 'user_' . $moderators_id)); ?>" alt="" width="220" height="220" style="max-width: 220px; display: block;">
                                        <?php } ?>
                                
                                        </a>
                                
                                    <br><br>
                                </td>
                                <td  valign="top" style="padding-left: 20px; font-family: Helvetica, Arial, sans-serif; font-size: 14px;">
                                    <p style="font-family:Helvetica, Arial, sans-serif; font-size: 14px;">
                                        <span style="padding: 10px 0;">
                                            <span style="text-transform: uppercase; font-weight: bold; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: rgb(210, 16, 51);">
                                                <?php
                                                echo esc_html(get_field('full_name', 'user_' . $moderators_id));
                                                echo ' ';
                                                echo esc_html(get_field('user_last_name', 'user_' . $moderators_id));
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
                                                if (have_rows('positions', 'user_' . $moderators_id)) {
                                                    while (have_rows('positions', 'user_' . $moderators_id)) {
                                                        the_row();
                                                        ?>
                                                        <span style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: <?php echo esc_attr($newsletter_display_mode['job_title_color']); ?>; display: block;"><?php echo esc_html(get_sub_field('job_title', 'user_' . $moderators_id)); ?></span>
                                                        <span style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: <?php echo esc_attr($newsletter_display_mode['company_color']); ?>; display: block;"><?php echo esc_html(get_sub_field('company', 'user_' . $moderators_id)); ?></span>
                                                        <?php
                                                        break;
                                                    }
                                                }
                                                ?>
                                                
                                            </span>
                                            <br>
                                            
                                        </span>
                                    </p>
                                
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
            }
            ?>
            <?php
        }
        ?>
        <?php
        if (
            (
                !empty($mit_registration['link']) ||
                (
                    !empty($non_mit_registration['embed_widget']) ||
                    !empty($non_mit_registration['link'])
                )
            ) &&
            (strtotime($event_end_on) >= time() && !$event_sold_out_flag)
        ) {
            ?>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td id="registration" style="background-color: #f8f8f8; padding: 20px; border-radius: 4px;  box-shadow:1px 1px 1px #ccc;">
                    <span style="font-weight: normal; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: rgb(0, 0, 0);">Registration</span>
                    <br>
                    <br>
                    <table width="100%" cellpadding="10" cellspacing="0">
                        <tbody>
                        <tr>
                            <?php if (!empty($mit_registration['link'])) { ?>
                                <td width="50%">
                                    <table width="100%" cellpadding="2" cellspacing="0">
                                        <tr>
                                            <td align="center" valign="bottom" style="background-color: #fff; padding:15px 0 0 0 ; color: #A31F34; font-size: 20px; font-weight: bold; font-family:Helvetica, Arial, sans-serif;">
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/logo-mit-only.svg" width="33" height="17" alt=""> ALUMS
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="middle" style="background-color: #fff; color: #fff; font-size: 14px; font-family:Helvetica, Arial, sans-serif;">
                                            
                                                <?php
                                                if (is_array($mit_registration['details']) && $mit_registration['details'] != null) {
                                                    foreach ($mit_registration['details'] as $key => $details) {
                                                        if ($details['description'] != null) {
                                                            if (($key % 2) == 0) {
                                                                ?>
                                                                </tr><tr>
                                                                <?php
                                                            }

                                                            foreach ($details['description'] as $description) {
                                                                if (
                                                                    strtotime(date('Y-m-d 00:00:00', strtotime($description['date_start']))) <= time() &&
                                                                    strtotime(date('Y-m-d 23:59:59', strtotime($description['date_end']))) >= time()
                                                                ) {
                                                                    ?>
                                                            <span style="font-size: 30px; font-weight: bold;color:#a31f34;"><?php echo !empty($description['price']) ? esc_html($description['price']) : '&nbsp;'; ?></span><br>
                                                                    <?php
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                        <span style="font-size: 30px; font-weight: bold;color:#a31f34;">&nbsp;</span><br>
                                                    <?php
                                                }
                                                ?>
                                                
                                                <span style="color: #666666;">MITCNC Members. Please log in for access to Registration
                                                    Link</span>
                        
                                                <br>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="background-color: #ffffff; padding: 10px 20px;">
                                                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                    <tr>
                                                        <td style="background-color: #30b630; text-align: center; border-radius: 2px; padding: 10px 30px; display: block;">
                                                            <a style="color: #ffffff; font-family:Helvetica, Arial, sans-serif; text-decoration: none;" href="<?php echo esc_url($mit_registration['link']); ?>" target="_blank">Reserve Now</a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            <?php } ?>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="10" align="center" valign="middle" style="padding:10px 0 ; color: #fff; font-size: 20px; font-weight: bold; font-family:Helvetica, Arial, sans-serif;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="middle" style="color: #FFF; font-size: 14px; font-family:Helvetica, Arial, sans-serif;"> &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <?php if (!empty($non_mit_registration['link'])) { ?>
                                <td width="50%">
                                    <table width="100%" cellpadding="2" cellspacing="0">
                                        <tr>
                                            <td align="center" valign="bottom" style="padding:15px 0 0 0 ; color: #000000; font-size: 20px; font-weight: bold; font-family:Helvetica, Arial, sans-serif;background-color: #FFF;">General Admission</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="middle" style="color: #666666; font-size: 14px; font-family:Helvetica, Arial, sans-serif;background-color: #fff;">
                                                
                                                <?php
                                                if (is_array($non_mit_registration['details']) && $non_mit_registration['details'] != null) {
                                                    foreach ($non_mit_registration['details'] as $key => $details) {
                                                        if ($details['description'] != null) {
                                                            foreach ($details['description'] as $description) {
                                                                if (
                                                                    strtotime(date('Y-m-d 00:00:00', strtotime($description['date_start']))) <= time() &&
                                                                    strtotime(date('Y-m-d 23:59:59', strtotime($description['date_end']))) >= time()
                                                                ) {
                                                                    ?>
                                                            <span style="font-size: 30px; font-weight: bold;color:#a31f34;"><?php echo !empty($description['price']) ? esc_html($description['price']) : '&nbsp;'; ?></span><br>
                                                                    <?php
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                        <span style="font-size: 30px; font-weight: bold;color:#a31f34;">&nbsp</span><br>
                                                    <?php
                                                }
                                                ?>
                                                
                                                
                                                <span style="color: #666666;">General Admission</span>
                                                <br>
                                                <span>&nbsp;</span>
                                                <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="background-color: #fff; padding: 10px 20px;">
                                                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                    <tr>
                                                        <td style="background-color: #30b630; text-align: center; border-radius: 2px; padding: 10px 30px; display: block;">
                                                            <a style="color: #fff; font-family:Helvetica, Arial, sans-serif; text-decoration: none;" href="<?php echo esc_url($non_mit_registration['link']); ?>" target="_blank">Reserve Now</a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            <?php } ?>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td>&nbsp; &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td style="background-color:<?php echo esc_attr($newsletter_display_mode['gray_bg']); ?>; padding: 20px; border-radius: 4px;  box-shadow:1px 1px 1px #ccc;"><span style="font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;"><strong style="font-size: 18px;">New to the MIT Club of Northern California? </strong><br>
                        Enjoy access to members-only events, early access to popular events, member pricing, vote for board members, and other members-only benefits.</span><br>
                <br>
                <table border="0" width="100%" cellspacing="20" cellpadding="20" style="background-color: <?php echo esc_attr($newsletter_display_mode['light_gray_bg']); ?>; text-align: center; border-radius: 4px;  box-shadow:1px 1px 1px #ccc; font-family:Helvetica, Arial, sans-serif;">
                    <tbody>
                    <tr>
                        <td style="border: 1px solid <?php echo esc_attr($newsletter_display_mode['gray_bg']); ?>; color: <?php echo esc_attr($newsletter_display_mode['gray_bg']); ?>; font-size: 16px;"><a style="color: #fff; font-family:Helvetica, Arial, sans-serif; text-decoration: none; font-size: 18px; font-weight: bold;" href="https://www.mitcnc.org/membership/join-or-renew/">Join the MIT Club of Northern California today <img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/arrow-right1.png" alt="" width="28" height="20"><br>
                            </a>Membership is open to all MIT graduates.</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp; &nbsp; &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td style="background-color: #121217; padding: 20px; border-radius: 4px;  box-shadow:1px 1px 1px #ccc;">
                <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-family:Helvetica, Arial, sans-serif; color: #adadb9;">
                    <tbody>
                    <tr>
                        <td style="padding-bottom: 10px;" width="60%"><img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/footer-logo.png" alt="" width="85" height="60"></td>
                        <td align="left" valign="middle" width="40%"><img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/logo-mitcnc-white.png" width="220" height="50" alt=""></td>
                    </tr>
                    <tr>
                        <td>
                        <p><strong>##Sender_Org##, ##Sender_Address##, ##Sender_City##, ##Sender_State##</strong></p>
                            <p style="font-size: 14px;"><a style="color: #adadb9; text-decoration: none" href="##Unsubscribe_URL##">##Unsubscribe##</a></p>
                        </td>
                        <td align="left" valign="top">
                            <p><a style="color: #adadb9; text-decoration: none" href="mailto:clubadmin@mitcnc.org">clubadmin@mitcnc.org</a>                </p>
                            <table width="100%" align="left" cellpadding="0" cellspacing="0">
                                <tbody>
                                <tr>
                                    <td colspan="5" style="font-family:Helvetica, Arial, sans-serif; color: #adadb9;">Connect with Us</td>
                                </tr>
                                <tr>
                                    <td width="20" height="30"><a href="https://www.facebook.com/groups/mitcnc/"> <img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/facebook.png" alt="" width="8" height="16"></a></td>
                                    <td width="30"><a href="http://www.twitter.com/mitcnc"> <img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/twitter.png" alt="" width="17" height="14"></a></td>
                                    <td width="30"><a href="https://www.linkedin.com/company/mitcnc/"> <img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/linkedin.png" alt="" width="17" height="16"></a></td>
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
        </tbody>
    </table>
</div>      
