<?php
/**
 * NOTE:
 *
 * @param $meta_data['registration_3_mit_alum'] is MITCNC Member
 * @param $meta_data['registration_3_mit_alumni_club'] is a member of any MIT Alumni Club
 * @param $meta_data['registration_3_mit_alumni'] is an MIT Alumni, who is not a member of any club
 * @param $meta_data['registration_3_non_alum'] is Non Alum
 *
 * These irrelevant name of the keys are because the members and alumni previously was managed through one field
 * And now it becomes different types, dated on: 18 Nov 2020
*/
global $meta_data,
        $end_on,
        $sold_out_flag,
        $assets_uri,
        $login_page_id,
        $layout,
        $event_access_type_taxonomy,
        $reserve_now_btn_text;

$current_user_id = get_current_user_id();
$eventbrite_event_id = (isset($meta_data['registration_3_eventbrite_event_id'][0])) ? $meta_data['registration_3_eventbrite_event_id'][0] : '';
$is_logged_in = is_user_logged_in();
$is_mitcnc_member_only_event = false;
$terms = get_the_terms($post->ID, $event_access_type_taxonomy);
$reservation_link_with_auth = (isset($meta_data['registration_3_authenticated_reservation_link'][0])) ? $meta_data['registration_3_authenticated_reservation_link'][0] : '';
$reservation_link_with_auth_for_alumni = (isset($meta_data['registration_3_authenticated_reservation_link_for_alum'][0])) ? $meta_data['registration_3_authenticated_reservation_link_for_alum'][0] : '';
$reservation_link_for_gen_adm = (isset($meta_data['registration_3_general_admission_reservation_link'][0])) ? $meta_data['registration_3_general_admission_reservation_link'][0] : '';

if ($terms && !is_wp_error($terms)) {
    foreach ($terms as $term) {
        if ('mitcnc-members-only' === $term->slug) {
            $is_mitcnc_member_only_event = true;
            break;
        }
    }
}

$no_of_registration_boxes = 0;
$no_of_registration_boxes = (isset($meta_data['registration_3_mit_alum'][0]) && $meta_data['registration_3_mit_alum'][0] > 0) ? ($no_of_registration_boxes + 1) : $no_of_registration_boxes;
$no_of_registration_boxes = (isset($meta_data['registration_3_mit_alumni_club'][0]) && $meta_data['registration_3_mit_alumni_club'][0] > 0) ? ($no_of_registration_boxes + 1) : $no_of_registration_boxes;
$no_of_registration_boxes = (isset($meta_data['registration_3_mit_alumni'][0]) && $meta_data['registration_3_mit_alumni'][0] > 0) ? ($no_of_registration_boxes + 1) : $no_of_registration_boxes;
$no_of_registration_boxes = (isset($meta_data['registration_3_non_alum'][0]) && $meta_data['registration_3_non_alum'][0] > 0) ? ($no_of_registration_boxes + 1) : $no_of_registration_boxes;

echo '<style>';
echo (('row' == $layout) ? '' : '.registration-box .default-btn{width: 100%}');
echo ($no_of_registration_boxes == 3) ? '.registration-box h4, .registration-box .registration-pricing-container{margin: 0 auto;} .registration-layout-column .registration-box .registration-pricing-container .pricing-button {position: inherit;bottom: auto;left: auto;right: auto;}' : '';
echo '</style>';

if (strtotime($end_on) >= time() && !$sold_out_flag) {
    $mit_divs_printed = false;
    $non_mit_divs_printed = false;
    $user_is_mitcnc_member = is_mitcnc_member($current_user_id);
    $user_is_mit_club_member = is_mit_club_member($current_user_id);
    ?>
        <div id="section--registration"></div>
        <hr class="mb60 mt60">
        <div class="row mb60 registration-layout-<?php echo esc_attr($layout); ?>" id="registration">
            <div class="col-sm-24 order-2">
            <?php echo ('row' == $layout) ? '' : '<div class="row">'; ?>
            <?php
            // For MITCNC members
            if (isset($meta_data['registration_3_mit_alum'][0]) && $meta_data['registration_3_mit_alum'][0] > 0) {
                for ($i = 0; $i < $meta_data['registration_3_mit_alum'][0]; $i++) {
                    // Help non-members join, or recent members get registered
                    $mitcnc_member_description = 'Please make sure you are a current member of any MIT local club before registering.';
                    // Show the custom message, if there is one
                    $mitcnc_member_description = isset($meta_data['registration_3_mit_alum_' . $i . '_description'][0]) ? $meta_data['registration_3_mit_alum_' . $i . '_description'][0] : $mitcnc_member_description;

                    if ($user_is_mitcnc_member && isset($meta_data['registration_3_mit_alum_' . $i . '_discount_code'][0])) {
                        $mit_discount_code =  $meta_data['registration_3_mit_alum_' . $i . '_discount_code'][0];
                    } else {
                        $mit_discount_code = '';
                    }
                    if (isset($meta_data['registration_3_mit_alum_' . $i . '_pricing'][0]) && $meta_data['registration_3_mit_alum_' . $i . '_pricing'][0] > 0) {
                        for ($j = 0; $j < $meta_data['registration_3_mit_alum_' . $i . '_pricing'][0]; $j++) {
                            $pricing_amount = isset($meta_data['registration_3_mit_alum_' . $i . '_pricing_' . $j . '_amount'][0]) ? $meta_data['registration_3_mit_alum_' . $i . '_pricing_' . $j . '_amount'][0] : '';
                            $pricing_start_date = isset($meta_data['registration_3_mit_alum_' . $i . '_pricing_' . $j . '_start_date'][0]) ? $meta_data['registration_3_mit_alum_' . $i . '_pricing_' . $j . '_start_date'][0] : '';
                            $pricing_end_date = isset($meta_data['registration_3_mit_alum_' . $i . '_pricing_' . $j . '_end_date'][0]) ? $meta_data['registration_3_mit_alum_' . $i . '_pricing_' . $j . '_end_date'][0] : '';
                            if (
                                strtotime(date('Y-m-d 00:00:00', strtotime($pricing_start_date))) <= time() &&
                                strtotime(date('Y-m-d 23:59:59', strtotime($pricing_end_date))) >= time()
                            ) {
                                echo (!$mit_divs_printed) ? (('row' == $layout) ? '<div class="row mb60">' : '') . '<div class="col-md-12 col-lg-' . (('row' == $layout) ? '24' : (($no_of_registration_boxes == 3) ? '8' : '12')) . '"><div class="registration-box ' . (('row' == $layout) ? '' : 'text-center') . '"><h4 class="red-text x-large-text"><i><img src="' . esc_url($assets_uri) . '/images/logo-mit-only.svg" width="50px" alt="MITCNC Members" /></i>MITCNC MEMBERS</h4>' : '';
                                $mit_divs_printed = true;
                                ?>
                                    <div class="registration-pricing-container">
                                        <div class="pricing-text two-price">
                                            <div class="price red-text"><?php echo esc_html($pricing_amount); ?></div>
                                            <p><span class="pricing-description"><?php echo esc_html($mitcnc_member_description); ?></span></p>
                                        </div>
                                        <div class="pricing-button">
                                        <?php
                                        if (strtotime($end_on) < time()) {
                                            ?>
                                            <a href="javascript:void(0);" class="default-btn gray-btn">
                                                Reservation Closed
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="" />
                                            </a>
                                            <?php
                                        } else if ($sold_out_flag) {
                                            ?>
                                            <a href="javascript:void(0);" class="default-btn gray-btn">
                                                Sold Out
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="">
                                            </a>
                                            <?php
                                        } else {
                                            if ($user_is_mitcnc_member && !empty($eventbrite_event_id)) {
                                                ?>
                                                <button 
                                                    class="default-btn"
                                                    id="MITCNC-MEMBER-Trigger"
                                                    type="button"
                                                    ev__checkout
                                                    ev__eventId="<?php echo esc_html($eventbrite_event_id); ?>"
                                                    <?php echo !empty($mit_discount_code) ? 'ev__discountCode="' . esc_html($mit_discount_code) . '"' : ''; ?>
                                                    >
                                                    <?php echo esc_html($reserve_now_btn_text); ?>
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"/>
                                                </button>
                                                <?php
                                            } else if ($is_logged_in) {
                                                if (!empty($reservation_link_with_auth)) {
                                                    ?>
                                                    <a class="default-btn gray-btn" href="<?php echo esc_url($reservation_link_with_auth); ?>" target="_blank">
                                                        <?php echo esc_html($reserve_now_btn_text); ?>
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"/>
                                                    </a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a class="default-btn gray-btn" href="/membership/join-or-renew/">
                                                        Join the Club
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"/>
                                                    </a>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <a class="default-btn gray-btn"
                                                    href="/login/">
                                                    Login
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"/>
                                                </a>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <?php
                                    break;
                            }
                        }
                    }
                }
                echo ($mit_divs_printed) ? (('row' == $layout) ? '</div>' : '') . '</div></div>' : '';
            }

            // For MIT club members (e.g., members of any MIT alumni club)
            if (isset($meta_data['registration_3_mit_alumni_club'][0]) && $meta_data['registration_3_mit_alumni_club'][0] > 0) {
                $mit_divs_printed = false;

                for ($i = 0; $i < $meta_data['registration_3_mit_alumni_club'][0]; $i++) {
                    // Help non-members join, or recent members get registered
                    $mit_club_member_description = 'Please make sure you are a current member of any MIT local club before registering.';
                    // Show the custom message, if there is one
                    $mit_club_member_description = isset($meta_data['registration_3_mit_alumni_club_' . $i . '_description'][0]) ? $meta_data['registration_3_mit_alumni_club_' . $i . '_description'][0] : $mit_club_member_description;

                    if ($user_is_mit_club_member && isset($meta_data['registration_3_mit_alumni_club_' . $i . '_discount_code'][0])) {
                        $mit_discount_code =  $meta_data['registration_3_mit_alumni_club_' . $i . '_discount_code'][0];
                    } else {
                        $mit_discount_code = '';
                    }
                    if (isset($meta_data['registration_3_mit_alumni_club_' . $i . '_pricing'][0]) && $meta_data['registration_3_mit_alumni_club_' . $i . '_pricing'][0] > 0) {
                        for ($j = 0; $j < $meta_data['registration_3_mit_alumni_club_' . $i . '_pricing'][0]; $j++) {
                            $pricing_amount = isset($meta_data['registration_3_mit_alumni_club_' . $i . '_pricing_' . $j . '_amount'][0]) ? $meta_data['registration_3_mit_alumni_club_' . $i . '_pricing_' . $j . '_amount'][0] : '';
                            $pricing_start_date = isset($meta_data['registration_3_mit_alumni_club_' . $i . '_pricing_' . $j . '_start_date'][0]) ? $meta_data['registration_3_mit_alumni_club_' . $i . '_pricing_' . $j . '_start_date'][0] : '';
                            $pricing_end_date = isset($meta_data['registration_3_mit_alumni_club_' . $i . '_pricing_' . $j . '_end_date'][0]) ? $meta_data['registration_3_mit_alumni_club_' . $i . '_pricing_' . $j . '_end_date'][0] : '';
                            if (
                                strtotime(date('Y-m-d 00:00:00', strtotime($pricing_start_date))) <= time() &&
                                strtotime(date('Y-m-d 23:59:59', strtotime($pricing_end_date))) >= time()
                            ) {
                                echo (!$mit_divs_printed) ? (('row' == $layout) ? '<div class="row mb60">' : '') . '<div class="col-md-12 col-lg-' . (('row' == $layout) ? '24' : (($no_of_registration_boxes == 3) ? '8' : '12')) . '"><div class="registration-box ' . (('row' == $layout) ? '' : 'text-center') . '"><h4 class="red-text x-large-text"><i><img src="' . esc_url($assets_uri) . '/images/logo-mit-only.svg" width="50px" alt="MIT Club Members" /></i>CLUB MEMBERS</h4>' : '';
                                $mit_divs_printed = true;
                                ?>
                                    <div class="registration-pricing-container">
                                        <div class="pricing-text two-price">
                                            <div class="price red-text"><?php echo esc_html($pricing_amount); ?></div>
                                            <p><span class="pricing-description"><?php echo esc_html($mit_club_member_description); ?></span></p>
                                        </div>
                                        <div class="pricing-button">
                                        <?php
                                        if (strtotime($end_on) < time()) {
                                            ?>
                                            <a href="javascript:void(0);" class="default-btn gray-btn">
                                                Reservation Closed
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="" />
                                            </a>
                                            <?php
                                        } else if ($sold_out_flag) {
                                            ?>
                                            <a href="javascript:void(0);" class="default-btn gray-btn">
                                                Sold Out
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="">
                                            </a>
                                            <?php
                                        } else {
                                            if ($user_is_mit_club_member && !empty($eventbrite_event_id)) {
                                                ?>
                                                <button 
                                                    class="default-btn"
                                                    id="MIT-Club-Member-Trigger"
                                                    type="button"
                                                    ev__checkout
                                                    ev__eventId="<?php echo esc_html($eventbrite_event_id); ?>"
                                                    <?php echo !empty($mit_discount_code) ? 'ev__discountCode="' . esc_html($mit_discount_code) . '"' : ''; ?>
                                                    >
                                                    <?php echo esc_html($reserve_now_btn_text); ?>
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"/>
                                                </button>
                                                <?php
                                            } else if ($is_logged_in) {
                                                if (!empty($reservation_link_with_auth)) {
                                                    ?>
                                                    <a class="default-btn gray-btn" href="<?php echo esc_url($reservation_link_with_auth); ?>" target="_blank">
                                                        <?php echo esc_html($reserve_now_btn_text); ?>
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"/>
                                                    </a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a class="default-btn gray-btn" href="/membership/join-or-renew/">
                                                        Join the Club
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"/>
                                                    </a>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <a class="default-btn gray-btn"
                                                    href="/login/">
                                                    Login
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"/>
                                                </a>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <?php
                                    break;
                            }
                        }
                    }
                }
                echo ($mit_divs_printed) ? (('row' == $layout) ? '</div>' : '') . '</div></div>' : '';
            }

            // For MIT Alums (e.g., who is not a member of any MIT alumni club)
            if (isset($meta_data['registration_3_mit_alumni'][0]) && $meta_data['registration_3_mit_alumni'][0] > 0) {
                $mit_divs_printed = false;

                for ($i = 0; $i < $meta_data['registration_3_mit_alumni'][0]; $i++) {
                    // Help non-members join, or recent members get registered
                    $mit_alumni_description = 'Please make sure you are a current member of any MIT local club before registering.';
                    // Show the custom message, if there is one
                    $mit_alumni_description = isset($meta_data['registration_3_mit_alumni_' . $i . '_description'][0]) ? $meta_data['registration_3_mit_alumni_' . $i . '_description'][0] : $mit_alumni_description;

                    if ($user_is_mitcnc_member && isset($meta_data['registration_3_mit_alum_' . $i . '_discount_code'][0])) {
                        $mit_discount_code =  $meta_data['registration_3_mit_alum_' . $i . '_discount_code'][0];
                    } else if ($user_is_mit_club_member && isset($meta_data['registration_3_mit_alumni_club_' . $i . '_discount_code'][0])) {
                        $mit_discount_code =  $meta_data['registration_3_mit_alumni_club_' . $i . '_discount_code'][0];
                    } else if (!$user_is_mitcnc_member && !$user_is_mit_club_member && isset($meta_data['registration_3_mit_alumni_' . $i . '_discount_code'][0])) {
                        $mit_discount_code =  $meta_data['registration_3_mit_alumni_' . $i . '_discount_code'][0];
                    } else {
                        $mit_discount_code = '';
                    }

                    if (isset($meta_data['registration_3_mit_alumni_' . $i . '_pricing'][0]) && $meta_data['registration_3_mit_alumni_' . $i . '_pricing'][0] > 0) {
                        for ($j = 0; $j < $meta_data['registration_3_mit_alumni_' . $i . '_pricing'][0]; $j++) {
                            $pricing_amount = isset($meta_data['registration_3_mit_alumni_' . $i . '_pricing_' . $j . '_amount'][0]) ? $meta_data['registration_3_mit_alumni_' . $i . '_pricing_' . $j . '_amount'][0] : '';
                            $pricing_start_date = isset($meta_data['registration_3_mit_alumni_' . $i . '_pricing_' . $j . '_start_date'][0]) ? $meta_data['registration_3_mit_alumni_' . $i . '_pricing_' . $j . '_start_date'][0] : '';
                            $pricing_end_date = isset($meta_data['registration_3_mit_alumni_' . $i . '_pricing_' . $j . '_end_date'][0]) ? $meta_data['registration_3_mit_alumni_' . $i . '_pricing_' . $j . '_end_date'][0] : '';
                            if (
                                strtotime(date('Y-m-d 00:00:00', strtotime($pricing_start_date))) <= time() &&
                                strtotime(date('Y-m-d 23:59:59', strtotime($pricing_end_date))) >= time()
                            ) {
                                echo (!$mit_divs_printed) ? (('row' == $layout) ? '<div class="row mb60">' : '') . '<div class="col-md-12 col-lg-' . (('row' == $layout) ? '24' : (($no_of_registration_boxes == 3) ? '8' : '12')) . '"><div class="registration-box ' . (('row' == $layout) ? '' : 'text-center') . '"><h4 class="red-text x-large-text"><i><img src="' . esc_url($assets_uri) . '/images/logo-mit-only.svg" width="50px" alt="MIT Alums" /></i>ALUMS</h4>' : '';
                                $mit_divs_printed = true;
                                ?>
                                    <div class="registration-pricing-container">
                                        <div class="pricing-text two-price">
                                            <div class="price red-text"><?php echo esc_html($pricing_amount); ?></div>
                                            <p><span class="pricing-description"><?php echo esc_html($mit_alumni_description); ?></span></p>
                                        </div>
                                        <div class="pricing-button">
                                        <?php
                                        if (strtotime($end_on) < time()) {
                                            ?>
                                            <a href="javascript:void(0);" class="default-btn gray-btn">
                                                Reservation Closed
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="" />
                                            </a>
                                            <?php
                                        } else if ($sold_out_flag) {
                                            ?>
                                            <a href="javascript:void(0);" class="default-btn gray-btn">
                                                Sold Out
                                                <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="">
                                            </a>
                                            <?php
                                        } else {
                                            if ($is_logged_in) {
                                                if (!empty($eventbrite_event_id)) {
                                                    ?>
                                                    <button 
                                                        class="default-btn"
                                                        id="MIT-Club-Member-Trigger"
                                                        type="button"
                                                        ev__checkout
                                                        ev__eventId="<?php echo esc_html($eventbrite_event_id); ?>"
                                                        <?php echo !empty($mit_discount_code) ? 'ev__discountCode="' . esc_html($mit_discount_code) . '"' : ''; ?>
                                                        >
                                                        <?php echo esc_html($reserve_now_btn_text); ?>
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"/>
                                                    </button>
                                                    <?php
                                                } else if (!empty($reservation_link_with_auth_for_alumni)) {
                                                    ?>
                                                    <a class="default-btn gray-btn" href="<?php echo esc_url($reservation_link_with_auth_for_alumni); ?>" target="_blank">
                                                        <?php echo esc_html($reserve_now_btn_text); ?>
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"/>
                                                    </a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a class="default-btn gray-btn" href="/membership/join-or-renew/">
                                                        Join the Club
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"/>
                                                    </a>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <a class="default-btn gray-btn"
                                                    href="/login/">
                                                    Login
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"/>
                                                </a>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <?php
                                    break;
                            }
                        }
                    }
                }
                echo ($mit_divs_printed) ? (('row' == $layout) ? '</div>' : '') . '</div></div>' : '';
            }

            // For General Admission
            if (isset($meta_data['registration_3_non_alum'][0]) && $meta_data['registration_3_non_alum'][0] > 0) {
                for ($i = 0; $i < $meta_data['registration_3_non_alum'][0]; $i++) {
                    $non_alum_description = isset($meta_data['registration_3_non_alum_' . $i . '_description'][0]) ? $meta_data['registration_3_non_alum_' . $i . '_description'][0] : '';
                    if (isset($meta_data['registration_3_non_alum_' . $i . '_pricing'][0]) && $meta_data['registration_3_non_alum_' . $i . '_pricing'][0] > 0) {
                        for ($j = 0; $j < $meta_data['registration_3_non_alum_' . $i . '_pricing'][0]; $j++) {
                            $pricing_amount = isset($meta_data['registration_3_non_alum_' . $i . '_pricing_' . $j . '_amount'][0]) ? $meta_data['registration_3_non_alum_' . $i . '_pricing_' . $j . '_amount'][0] : '';
                            $pricing_start_date = isset($meta_data['registration_3_non_alum_' . $i . '_pricing_' . $j . '_start_date'][0]) ? $meta_data['registration_3_non_alum_' . $i . '_pricing_' . $j . '_start_date'][0] : '';
                            $pricing_end_date = isset($meta_data['registration_3_non_alum_' . $i . '_pricing_' . $j . '_end_date'][0]) ? $meta_data['registration_3_non_alum_' . $i . '_pricing_' . $j . '_end_date'][0] : '';
                            if (
                                strtotime(date('Y-m-d 00:00:00', strtotime($pricing_start_date))) <= time() &&
                                strtotime(date('Y-m-d 23:59:59', strtotime($pricing_end_date))) >= time()
                            ) {
                                echo (!$non_mit_divs_printed) ? (('row' == $layout) ? '<div class="row mb60">' : '') . '<div class="col-md-12 col-lg-' . (('row' == $layout) ? '24' : (($no_of_registration_boxes == 3) ? '8' : '12')) . '"><div class="registration-box ' . (('row' == $layout) ? '' : 'text-center') . '"><h4 class="x-large-text">GENERAL ADMISSION</h4>' : '';
                                $non_mit_divs_printed = true;
                                ?>
                                        <div class="registration-pricing-container">
                                            <div class="pricing-text two-price">
                                                <div class="price red-text"><?php echo esc_html($pricing_amount); ?></div>
                                                <p><span class="pricing-description"><?php echo !empty($non_alum_description) ? esc_html($non_alum_description) : ''; ?></span></p>
                                            </div>
                                            <div class="pricing-button">
                                            <?php
                                            if (strtotime($end_on) < time()) {
                                                ?>
                                                <a href="javascript:void(0);" class="default-btn gray-btn">
                                                    Reservation Closed
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="" />
                                                </a>
                                                <?php
                                            } else if ($sold_out_flag) {
                                                ?>
                                                <a href="javascript:void(0);" class="default-btn gray-btn">
                                                    Sold Out
                                                    <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="" />
                                                </a>
                                                <?php
                                            } else {
                                                if (!empty($reservation_link_for_gen_adm)) {
                                                    ?>
                                                    <a target="_blank" href="<?php echo esc_url($reservation_link_for_gen_adm); ?>" class="default-btn">
                                                        <?php echo esc_html($reserve_now_btn_text); ?>
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="" />
                                                    </a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <button 
                                                        class="default-btn"
                                                        id="GeneralAdmission-Trigger" 
                                                        type="button"
                                                        ev__checkout
                                                        ev__eventId="<?php echo esc_html($eventbrite_event_id); ?>" 
                                                    >
                                                        <?php echo esc_html($reserve_now_btn_text); ?>
                                                        <img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg" alt="" />
                                                    </button>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </div>
                                        </div>
                                    <?php
                                    break;
                            }
                        }
                    }
                }
                echo ($non_mit_divs_printed) ? (('row' == $layout) ? '</div>' : '') . '</div></div>' : '';
            }
            ?>
                <?php echo ('row' == $layout) ? '' : '</div>'; ?>
            </div>
            <?php if ($mit_divs_printed || $non_mit_divs_printed) { ?>
                <div class="col-sm-24 mb30 order-1">
                    <h2>Registration</h2>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-sm-24 mt20">
                <div class="event-footer-banner">
                    <a href="https://securelb.imodules.com/s/1314/clubs-classes-interior.aspx?sid=1314&gid=25&pgid=3&cid=40">
                        <h2 class="white-border white-text">MIT Alums:</h2>
                        <p class="mt-4">Please make sure you are a current member of your local club before registering. If you are unsure please ask your club representative or if you would like to join MIT Club of Northern California, click here.</p>
                    </a>
                </div>
            </div>
        </div>
    <?php
}
