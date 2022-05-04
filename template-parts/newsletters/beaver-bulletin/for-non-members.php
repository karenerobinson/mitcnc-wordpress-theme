<?php
global $user_profile_page_id,
       $newsletter_type_non_members,
       $post_id,
       $newsletter_type,
       $assets_uri,
       $volunteer_list,
       $featured_event,
       $upcoming_event,
       $member_event,
       $brass_rats,
       $newsletter_banner,
       $newsletter_banner_link,
       $brain_teaser,
       $dark_mode,
       $newsletter_display_mode,
       $intro;
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
    <tr>
        <td style="padding: 10px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>; font-size: 14px; font-family: Helvetica, Arial, sans-serif; text-align: right;">
            <strong>
                <?php echo get_the_date('l, F j, Y', $post_id); ?></strong>
        </td>
    </tr>
    <?php if (!empty($newsletter_banner)) { ?>
        <tr>
            <td>
                <?php
                if (!empty($newsletter_banner_link)) {
                    ?>
                    <a href="<?php echo esc_url($newsletter_banner_link); ?>">
                <?php } ?>
                    <img style="border-radius: 4px;" width="680" src="<?php echo esc_url($newsletter_banner); ?>" />
                    <?php
                    if (!empty($newsletter_banner_link)) {
                        ?>
                        </a>
                    <?php } ?>
            </td>
        </tr>
    <?php } ?>
     <tr>
        <td> </td>
    </tr>
    <tr>
        <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-radius: 4px;  box-shadow:1px 1px 1px #ccc;">
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td style="font-family:Helvetica, Arial, sans-serif; font-size: 16px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;  padding: 0 0 20px 0; font-weight: normal; border-bottom: 1px dotted #adadb9;" colspan="2">
                        Hi ##First Name##
                        <br><br>
                        <p style="font-family:Helvetica, Arial, sans-serif; font-size: 16px;">Check out our events in the upcoming weeks! </p> 
                    </td>
                </tr>
                
                </tbody>
            </table>
        </td>
    </tr>
    <?php if (!empty($intro)) { ?>
    <tr>
        <td> </td>
    </tr>
    <tr>
        <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-radius: 4px;  box-shadow:1px 1px 1px #ccc;">
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
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
    <tr>
        <td> </td>
    </tr>
    <tr>
        <td style="background-color:<?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-radius: 4px;  box-shadow:1px 1px 1px #ccc;">
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
               
                <?php if ($volunteer_list != null) { ?>
                    <tr>
                        <td style="font-family:Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;  padding: 0 0 10px 0; font-weight: normal;" colspan="2">Volunteer Spotlight
                        </td>
                    </tr>
                    <?php
                    foreach ($volunteer_list as $volunteer) {
                        $user_data = get_user_by('id', $volunteer);
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
                                        <img src="<?php echo esc_url(get_field('profile_image', 'user_' . $volunteer)); ?>" alt="" width="220" height="220" style="max-width: 220px; display: block;">
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
                }
                ?>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td> </td>
    </tr>
    <?php if ($brass_rats != null || $brain_teaser != null) { ?>
        <tr>
            <td style="background-color:  <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                    <?php
                    if ($brass_rats != null) {
                        $rats = get_post($brass_rats);
                        ?>
                        
                        <tr>
                            <td style="font-family:Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;  padding: 0 0 10px 0; font-weight: normal;">
                                Brass Rats
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $image = get_the_post_thumbnail_url($rats->ID, 'thumbnail_1079_474');
                                $auth_name = get_field('author_name', $rats->ID);
                                $auth_name = !empty($auth_name) ? explode(',', $auth_name) : $auth_name;
                                ?>
                                <img src="<?php echo esc_url($image); ?>" style="width: 640px;" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;" align="right">
                                <span style="font-weight: bold; font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
                                    <?php echo (isset($auth_name[0])) ? esc_html($auth_name[0]) : ''; ?>
                                    <?php
                                    if ($auth_name != null && count($auth_name) >= 2) {
                                        $count_auth_name = count($auth_name);
                                        for ($j = 1; $j < $count_auth_name; $j++) {
                                            ?>
                                            , <span style="font-weight: normal;">
                                            <?php echo esc_html($auth_name[$j]); ?></span>
                                        <?php } ?>
                                    <?php } ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td> </td>
                        </tr>
                    <?php } ?>
                    
                    </tbody>
                </table>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td> </td>
    </tr>
    <?php if ($brass_rats != null || $brain_teaser != null) { ?>
        <tr>
            <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                    <?php if ($brain_teaser != null) { ?>
                        <tr>
                            <td style="font-family:Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;  padding: 0 0 10px 0; font-weight: normal;">
                                Brain Teaser <br>
                                <?php
                                $teaser = get_post($brain_teaser);
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
                                        <td style="font-size: 11.0pt; font-family: 'Helvetica Neue', Helvetica, Arial; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;" valign="top">
                                            <?php echo filter_var($teaser->post_content, FILTER_UNSAFE_RAW); ?>
                                        </td>
                                        <td  style="text-align:center;"><img src="<?php echo esc_url($image); ?>" alt="" width="250"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                    <tr>
                                        <td style="background-color: #63636e; text-align: center; border-radius: 2px; padding: 10px 30px; display: block;">
                                            <a style="color: #fff; font-family: 'Helvetica Neue', Helvetica, Arial; text-decoration: none;" href="<?php echo esc_url(get_permalink($teaser->ID)); ?>#brain-teaser">Check
                                                your Answer</a></td>
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
                                            <td
                                                style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; text-align: center; border-color:#333333; border-radius: 2px; border-width: 5px;  padding: 10px 30px;  display: block;">

                                                <p
                                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 11.0pt; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
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
    <tr>
        <td> </td>
    </tr>
    <?php if (isset($featured_event[0]) && !empty($featured_event[0])) { ?>
        <tr>
            <td style="background-color: <?php echo esc_attr($newsletter_display_mode['featured_event_bg_color']); ?>; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td style="font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['featured_event_font_color']); ?>; padding: 0 0 10px 0; font-weight: normal;">
                            Featured Event
                        </td>
                    </tr>
                    <?php
                    foreach ($featured_event as $data) {
                        $data = get_post($data);
                        $city = get_field('location_city', $data->ID);
                        $city = (isset($city['label']) ? $city['label'] : '');
                        $image = get_field('newsletter_event_image', $data);
                        ?>
                        <tr>
                            <td style="color: #adadb9; padding-bottom: 10px; font-family: Helvetica, Arial, sans-serif; font-weight: bold; text-transform: uppercase;">
                                <?php echo esc_html($city); ?>
                            </td>
                        </tr>
                        <?php if (!empty($image)) { ?>
                            <tr>
                                <td>
                                    <a href="<?php echo esc_url(get_permalink($data->ID)); ?>#featured-event">
                                        <img style="border-radius: 4px;" src="<?php echo esc_url($image); ?>" width="640" alt="" />
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td>
                                <table border="0" width="100%" cellspacing="0" cellpadding="10">
                                    <tbody>
                                    <tr>
                                        <td width="30">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/icon-calendar.png" alt="" width="30" height="30" />
                                        </td>
                                        <td style="color: <?php echo esc_attr($newsletter_display_mode['featured_event_font_color']); ?>; font-family: Helvetica, Arial, sans-serif;">
                                            <?php
                                            echo esc_html(date('l - F j, Y | ', strtotime(get_field('date_time_date_time_start', $data->ID))));
                                            echo esc_html(date('h:iA', strtotime(get_field('date_time_date_time_start', $data->ID)))) . ' - ' . esc_html(date('h:iA', strtotime(get_field('date_time_date_time_end', $data->ID))));
                                            ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #adadb9; padding: 10px 0; font-family: Helvetica, Arial, sans-serif; border-bottom: 1px dotted #adadb9; border-top: 1px dotted #adadb9;">
                                <span style="font-size: 22px; font-weight: bold; color: <?php echo esc_attr($newsletter_display_mode['featured_event_font_color']); ?>;">
                                    <?php echo esc_html(get_the_title($data->ID)); ?></span>
                                <p style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: <?php echo esc_attr($newsletter_display_mode['featured_event_font_color']); ?>;">
                                    <?php echo esc_html(substr(strip_tags($data->post_content), 0, 300)) . '...'; ?>
                                </p>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td> </td>
        </tr>
    <?php } ?>
    <tr>
        <td
            style="padding: 20px; background-color:<?php echo esc_attr($newsletter_display_mode['gray_bg']); ?>; border-radius: 4px; box-shadow: rgb(204, 204, 204) 1px 1px 1px;">
            <span
                style="padding: 0 0 10px 0; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">MITCNC
                Membership Status</span>
            <p style="font-family: Helvetica, Arial, sans-serif;  color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;"><strong>##Full Name##</strong><br>
                Membership Status:&nbsp;<strong style="color: rgb(163, 31, 52);">NOT ACTIVE&nbsp;</strong></p>
            <p style="font-family: Helvetica, Arial, sans-serif;"><strong style="color: rgb(163, 31, 52);"><br>
                </strong></p>
            <table border="0" width="100%" cellspacing="20" cellpadding="20"
                style="background-color: <?php echo esc_attr($newsletter_display_mode['bg_green']); ?>; text-align: center; border-radius: 2px; font-family: Helvetica, Arial, sans-serif;">
                <tbody>
                    <tr>
                        <td
                            style="border: 1px solid rgb(173, 173, 185); text-decoration-line: none; font-size: 18px;  font-weight: bold;">
                            <a href="<?php echo esc_url(get_membership_url()); ?>#active-membership-status1"
                                style="color: rgb(255, 255, 255); text-decoration-line: none; font-size: 18px; font-weight: bold;">Activate
                                Your MITCNC Membership</a><a
                                href="<?php echo esc_url(get_membership_url()); ?>#active-membership-status1"
                                style="color: rgb(255, 255, 255); font-size: 18px; text-decoration-line: none; font-weight: bold;">!&nbsp;<img
                                    src="<?php echo esc_url($assets_uri); ?>/images/newsletter/arrow-right1.png"
                                    alt="" width="28" height="20"></a>&nbsp;<br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td> </td>
    </tr>
    <tr>
        <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; ; box-shadow: 1px 1px 1px #ccc; border-radius: 4px;">
            <table width="640" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr>
                        <td>
                            <span style="padding: 0 0 10px 0; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
                                Get Involved
                            </span></td>
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
                                            <a style="text-decoration: none; color: #fff;" href="https://www.mitcnc.org/get-involved/volunteer/#get-involved">Volunteer</a>
                                        </td>
                                        <td width="0"></td>
                                        <td style="font-family: Helvetica, Arial, sans-serif;background-color:<?php echo esc_attr($newsletter_display_mode['bg_green']); ?>;border: 3px solid #6e6f7b;text-align: center;;font-size: 14px;" width="180">
                                            <a style="text-decoration: none; color: #fff;" href="https://www.mitcnc.org/get-involved/host/#get-involved">Host</a>
                                        </td>
                                        <td width="0"></td>
                                        <td style="font-family: Helvetica, Arial, sans-serif;background-color:<?php echo esc_attr($newsletter_display_mode['bg_green']); ?>;border: 3px solid #6e6f7b;text-align: center;font-size: 14px;" width="180">
                                            <a style="text-decoration: none; color: #fff;" href="https://www.mitcnc.org/get-involved/speaker/#get-involved">Speak</a>
                                        </td>
                                        <td width="0"></td>
                                        <td style="font-family: Helvetica, Arial, sans-serif;background-color: <?php echo esc_attr($newsletter_display_mode['bg_green']); ?>;border: 3px solid #6e6f7b;text-align: center;;font-size: 14px;" width="180">
                                            <a style="text-decoration: none; color: #fff;" href="https://www.mitcnc.org/get-involved/sponsor/#get-involved">Sponsor</a>
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
    <tr>
        <td> </td>
    </tr>
    <?php if ($upcoming_event != null) { ?>
        <tr>
            <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;"
                valign="top">
                                <span
                                    style="padding: 0 0 10px 0; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">Upcoming Events</span>
                <table width="640" border="0" cellspacing="0" cellpadding="0" style="padding-top: 14px;">
                    <tbody>
                    <tr>
                        <td width="100%" valign="top">
                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                <tbody>
                        <?php
                        foreach ($upcoming_event as $key => $upcoming) {
                            $upcoming = get_post($upcoming);
                            $image = get_field('newsletter_event_image', $upcoming->ID);
                            $banner_color = get_field('banner_background_color', $upcoming->ID);
                            $city = get_field('location_city', $upcoming->ID);
                            $city = (isset($city['label']) ? $city['label'] : '&nbsp;');
                            $event_locations = wp_get_post_terms($upcoming->ID, 'event-locations');
                            $event_locations = (isset($event_locations[0]->name) ? $event_locations[0]->name : '&nbsp;');
                            $event_address = get_field('location_address', $upcoming->ID);
                            $event_address_1 = get_field('location_address_1', $upcoming->ID);
                            $event_address_2 = get_field('location_address_2', $upcoming->ID);
                            $event_address_city = get_field('location_city', $upcoming->ID);
                            $event_address_state = get_field('location_state', $upcoming->ID);
                            $event_address_postal_code = get_field('location_postal_code', $upcoming->ID);
                            ?>
                        <tr>
                            <td style="padding-bottom: 14px;">
                                <a href="<?php echo esc_url(get_permalink($upcoming->ID)); ?>#upcoming-event"><img style="border-radius: 4px;" src="<?php echo esc_url($image); ?>" width="640" /></a>
                            </td>
                        </tr>
                        <?php } ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    <?php } ?>
   
    <?php if ($member_event != null) { ?>
        <tr>
            <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                <span style="padding: 0 0 10px 0; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">Members Only Events & Save The Date</span><br><br>
                <table style="font-family: Helvetica, Arial, sans-serif; padding-top: 20px;" border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                    <?php
                    foreach ($member_event as $members) {
                        $members = get_post($members);
                        $event_locations = wp_get_post_terms($members->ID, 'event-locations');
                        $event_locations = (isset($event_locations[0]->name) ? $event_locations[0]->name : '&nbsp;');
                        $city = get_field('location_city', $members->ID);
                        $city = (isset($city['label']) ? $city['label'] : '');
                        ?>
                        <tr>
                            <td style="border-bottom: 1px dotted #adadb9; font-size: 20px; text-align: center; background-color: #ebebf1; color: #000; font-weight: bold; padding: 6px 10px;" align="center">
                                <?php echo esc_html(date('d', strtotime(get_field('date_time_date_time_start', $members->ID)))); ?>
                            </td>
                            <td style="border-bottom: 1px dotted #adadb9; padding: 6px 15px;" colspan="3">
                                <a href="<?php echo esc_url(get_permalink($members->ID)); ?>" style="font-family: Helvetica, Arial, sans-serif; font-size: 18px; text-align: left; color: #000; font-weight: bold; text-decoration: none; display: block;">
                                    <?php echo esc_html($members->post_title); ?></a>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px; text-align: center; background-color: #d2d2da; color: #000; font-weight: bold; padding: 4px 5px;" align="center">
                                <?php echo esc_html(date('M', strtotime(get_field('date_time_date_time_start', $members->ID)))); ?>
                            </td>
                            <td style="color: #63636e; font-family: Helvetica, Arial, sans-serif; font-size: 14px; text-transform: uppercase; font-weight: bold; padding: 4px 15px;">
                                <?php echo esc_html($event_locations); ?>
                            </td>
                            <td style="padding: 4px;"><img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/icon-calendar.png" alt="" width="20" height="20" /></td>
                            <td style="color: #63636e; font-family: Helvetica, Arial, sans-serif; font-size: 14px; padding: 4px 10px;">
                                <?php echo esc_html(date('l, F j, Y | ', strtotime(get_field('date_time_date_time_start', $members->ID)))); ?>
                                <?php echo esc_html(date('g:i A', strtotime(get_field('date_time_date_time_start', $members->ID)))) . ' - ' . esc_html(date('g:i A', strtotime(get_field('date_time_date_time_end', $members->ID)))); ?>
                            </td>
                        </tr>
                        <?php if (count($member_event) > 1) { ?>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td> </td>
    </tr>
    <tr>
            <td
                style="padding: 20px; background-color: <?php echo esc_attr($newsletter_display_mode['gray_bg']); ?>; border-radius: 4px; box-shadow: rgb(204, 204, 204) 1px 1px 1px;">
                <span
                    style="padding: 0 0 10px 0; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color:  <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">MITCNC
                    Membership Status</span>
                <p style="font-family: Helvetica, Arial, sans-serif; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>"><strong>##Full Name##</strong><br>
                    Membership Status:&nbsp;<strong style="color: rgb(163, 31, 52);">NOT ACTIVE&nbsp;</strong></p>
                <p style="font-family: Helvetica, Arial, sans-serif;"><strong style="color: rgb(163, 31, 52);"><br>
                    </strong></p>
                <table border="0" width="100%" cellspacing="20" cellpadding="20"
                    style="background-color: <?php echo esc_attr($newsletter_display_mode['bg_green']); ?>; text-align: center; border-radius: 2px; font-family: Helvetica, Arial, sans-serif;">
                    <tbody>
                        <tr>
                            <td
                                style="border-right: 1px solid rgb(173, 173, 185); border-bottom: 1px solid rgb(173, 173, 185); border-top-style: solid; border-left-style: solid; border-top-color: rgb(173, 173, 185); border-left-color: rgb(173, 173, 185); border-image: initial; color: rgb(173, 173, 185); font-size: 16px;">
                                <a href="<?php echo esc_url(get_membership_url()); ?>#active-membership-status2"
                                    style="color: rgb(255, 255, 255); text-decoration-line: none; font-size: 18px; font-weight: bold;">Activate
                                    Your MITCNC Membership</a><a
                                    href="<?php echo esc_url(get_membership_url()); ?>#active-membership-status2"
                                    style="color: rgb(255, 255, 255); font-size: 18px; text-decoration-line: none; font-weight: bold;">!&nbsp;<img
                                        src="<?php echo esc_url($assets_uri); ?>/images/newsletter/arrow-right1.png"
                                        alt="" width="28" height="20"></a>&nbsp;<br>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    <tr>
        <td> </td>
    </tr>
   
    <tr>
        <td style="background-color: <?php echo esc_attr($newsletter_display_mode['inner_bg_color']); ?>; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
            <table border="0" width="640" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td colspan="4" style="padding: 0 0 10px 0; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">
                        Join The Conversation...
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
                                <a href="https://www.linkedin.com/company/mitcnc/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable"><span style="text-decoration:none;"><img data-imagetype="External" src="<?php echo esc_url($assets_uri); ?>/images/newsletter/LinkedIn-Logo.png" width="150"  border="0" id="_x0000_i1052"></span></a>
                            </p>
                        </td>
                        <td style="width:25%;padding:0;border:1pt solid #EBEBEB;">
                            <p align="center" style="font-size:12pt;font-family:Times New Roman,serif;text-align:center;margin:0;">
                                <a href="https://www.facebook.com/groups/mitcnc/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable"><span style="text-decoration:none;"><img data-imagetype="External" src="<?php echo esc_url($assets_uri); ?>/images/newsletter/facebook-logo.png" width="104"  border="0" id="_x0000_i1053"></span></a>
                            </p>
                        </td>
                        <td style="width:25%;padding:0;border-width:1pt;border-style:solid solid solid none;border-color:#EBEBEB;">
                            <p align="center" style="font-size:12pt;font-family:Times New Roman,serif;text-align:center;margin-right:0;margin-left:0;">
                                <a href="https://twitter.com/mitcnc" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable"><span style="text-decoration:none;"><img data-imagetype="External" src="<?php echo esc_url($assets_uri); ?>/images/newsletter/twitter-icon-134pixel.png" width="62"  border="0" id="_x0000_i1054"></span></a>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td> </td>
    </tr>
    <tr>
        <td>
            <table style="background-color: #A31F34; text-align: center; border-radius: 2px; font-family: Helvetica, Arial, sans-serif;" border="0" width="100%" cellspacing="20" cellpadding="20">
                <tbody>
                <tr>
                    <td style="border: 1px solid #adadb9; color: #adadb9;"><a style="color: #fff; font-family: Helvetica, Arial, sans-serif; text-decoration: none; font-size: 18px; font-weight: bold;" href="https://www.mitcnc.org/donate/#donation-section">Make
                            A Tax-Deductible Donation To Our Scholarship Fund <img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/arrow-right1.png" alt="" width="28" height="20" /><br /> </a><span style="font-size: 16px; color: #f1a3b1;">Membership is open to all MIT graduates.</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td> </td>
    </tr>
    <tr>
        <td style="background-color: <?php echo esc_attr($newsletter_display_mode['gray_bg']); ?>; color: #121217; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
            <span style="padding: 0 0 10px 0; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color:<?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">How Are We Doing?</span>
            <p style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">How are we doing? Please send your suggestions & comments to me at <a style="color: #0072ff;" href="mailto:president@mitcnc.org">president@mitcnc.org </a>
            </p>
            <p style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color:<?php echo esc_attr($newsletter_display_mode['font_color']); ?>;">See you at our
                    next event!!</p>
            <p style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: <?php echo esc_attr($newsletter_display_mode['font_color']); ?>;"><strong>Karen E. Robinson &rsquo;02</strong><br />
                President<br>
                MIT Club of Northern California</p>
        </td>
    </tr>
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
    </tbody>
</table>
</div>
