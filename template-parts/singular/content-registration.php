<?php
    global $meta_data,
        $end_on,
        $ticket_link_non_mit,
        $sold_out_flag,
        $assets_uri,
        $ticket_registration,
        $ticket_link,
        $login_page_id,
        $ticket_registration_non_mit,
        $reserve_now_btn_text;

    $mit_registration = array(
        'link' => (isset($meta_data['registration_2_mit_link'][0])) ? $meta_data['registration_2_mit_link'][0] : '',
        'details' => array(),
    );
    $non_mit_registration = array(
        'link' => (isset($meta_data['registration_2_non_mit'][0])) ? $meta_data['registration_2_non_mit'][0] : '',
        'details' => array(),
        'embed_widget' => (isset($meta_data['registration_2_non_mit_embed_widget'][0])) ? $meta_data['registration_2_non_mit_embed_widget'][0] : '',
    );
    $reservation_link = (isset($meta_data['reservation_link'][0])) ? $meta_data['reservation_link'][0] : '';
    $ticket_registration = get_field('registration_2_mit_details', $post->ID);
    $ticket_link = get_field('registration_2_mit_link', $post->ID);
    $ticket_link_non_mit = get_field('registration_2_non_mit_link', $post->ID);
    $ticket_registration_non_mit = get_field('registration_2_non_mit_details', $post->ID);

    if (
        (
            (isset($mit_registration['link']) && !empty($mit_registration['link'])) ||
            (
                (
                    isset($non_mit_registration['embed_widget']) && !empty($non_mit_registration['embed_widget'])
                ) ||
                !empty($ticket_link_non_mit)
            )
        ) &&
        (strtotime($end_on) >= time() && !$sold_out_flag)
    ) {
        ?>
        <div id="section--registration"></div>
        <hr class="mb60 mt60">
        <div class="row">
            <div class="col-sm-24 mb30">
                <h2>Registration</h2>
            </div>
        </div>
        <div class="row mb60">
            <?php if (!empty($mit_registration['link'])) { ?>
                <div class="col-sm-12">
                    <div class="registration-box text-center" style="min-height: 450px;">
                        <h4 class="red-text x-large-text">
                            <i>
                                <img src="<?php echo esc_url($assets_uri); ?>/images/logo-mit-only.svg"
                                    width="50px" alt="MIT Alums">
                            </i>
                            ALUMS
                        </h4>
                        <?php
                        if (null != $ticket_registration) {
                            foreach ($ticket_registration as $tickets) {
                                $meta = $tickets['description'];
                                if (null != $meta) {
                                    foreach ($meta as $details) {
                                        if (
                                            strtotime(date('Y-m-d 00:00:00', strtotime($details['date_start']))) <= time() &&
                                            strtotime(date('Y-m-d 23:59:59', strtotime($details['date_end']))) >= time()
                                        ) {
                                            ?>
                                            <div class="two-price <?php echo (count($ticket_registration) > 1) ? 'double' : ''; ?>">
                                                <div class="price red-text"><?php echo esc_html($details['price']); ?></div>
                                                <p><?php echo !empty($tickets['title']) ? esc_html($tickets['title']) : 'Please make sure you are a current member of any MIT local club before registering.'; ?></p>
                                            </div>
                                            <?php
                                            break;
                                        }
                                    }
                                }
                            }
                        } else {
                            ?>
                            <div class="two-price">
                                <div class="price red-text">&nbsp;</div>
                                <p style="margin-bottom: -16px;">&nbsp;</p>
                            </div>
                        <?php } ?>
                        <a href="<?php echo !empty($ticket_link) ? esc_url($ticket_link) : 'javascript:void(0);'; ?>"
                        style="position: absolute;bottom: 30px;left: 30px;right: 30px;" class="default-btn" style="width: 100%;"><?php echo esc_html($reserve_now_btn_text); ?><img
                                    src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                    alt=""></a>
                                    <!-- <p class="login-registration"> Please log in for member registration</p> -->
                    </div>
                </div>
            <?php } ?>
            <?php if (!empty($non_mit_registration['embed_widget']) || !empty($ticket_link_non_mit)) { ?>
                <div class="col-sm-12">
                <div class="registration-box text-center" style="min-height: 450px;">
                    <h4 class="x-large-text">GENERAL ADMISSION</h4>

                    <?php
                    if (null != $ticket_registration_non_mit) {
                        foreach ($ticket_registration_non_mit as $tickets) {
                            $meta = $tickets['description'];
                            if (null != $meta) {
                                foreach ($meta as $details) {
                                    if (
                                        strtotime(date('Y-m-d 00:00:00', strtotime($details['date_start']))) <= time() &&
                                        strtotime(date('Y-m-d 23:59:59', strtotime($details['date_end']))) >= time()
                                    ) {
                                        ?>
                                        <div class="two-price <?php echo (count($ticket_registration_non_mit) > 1) ? 'double' : ''; ?>">
                                            <div class="price red-text"><?php echo esc_html($details['price']); ?></div>
                                            <p><?php echo !empty($tickets['title']) ? esc_html($tickets['title']) : ''; ?></p>
                                        </div>
                                        <?php
                                        break;
                                    }
                                }
                            }
                        }
                    } else {
                        ?>
                        <div class="two-price">
                            <div class="price red-text">&nbsp;</div>
                            <p>&nbsp;</p>
                        </div>
                        <?php
                    }
                    if (strtotime($end_on) < time()) {
                        ?>
                        <a href="javascript:void(0);" style="position: absolute;bottom: 30px;left: 30px;right: 30px;" class="default-btn gray-btn">Reservation
                            Closed<img src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                    alt=""></a>
                    <?php } else if ($sold_out_flag) { ?>
                        <a href="javascript:void(0);" style="position: absolute;bottom: 30px;left: 30px;right: 30px;" class="default-btn gray-btn">Sold Out<img
                                    src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                    alt=""></a>
                        <?php
                    } else {
                        if (!empty($non_mit_registration['embed_widget'])) {
                            ?>
                            <style type="text/css">
                                .registration-box button {
                                    min-width: 205px;
                                    padding: 14px 20px;
                                    background-color: #30b630;
                                    border: 1px solid #30b630;
                                    text-decoration: none;
                                    text-transform: uppercase;
                                    text-align: center;
                                    color: #ffffff;
                                    display: inline-block;
                                    position: relative;
                                    font-size: 1rem;
                                    letter-spacing: 2px;
                                    border-radius: 2px;
                                    width: 100%;
                                }
                            </style>
                            <?php
                            echo filter_var($non_mit_registration['embed_widget'], FILTER_UNSAFE_RAW);
                        } else {
                            ?>
                            <a href="<?php echo !empty($ticket_link_non_mit) ? esc_url($ticket_link_non_mit) : 'javascript:void(0);'; ?>"
                            style="position: absolute;bottom: 30px;left: 30px;right: 30px;" class="default-btn" style="width: 100%;"><?php echo esc_html($reserve_now_btn_text); ?><img
                                        src="<?php echo esc_url($assets_uri); ?>/images/arrow_right_white.svg"
                                        alt=""></a> 
                            <?php
                        }
                        ?>
                    <?php } ?>
                </div>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-sm-24 mt20">
                <div class="event-footer-banner">
                    <a href="https://securelb.imodules.com/s/1314/clubs-classes-interior.aspx?sid=1314&gid=25&pgid=3&cid=40">
                        <h2 class="white-border white-text">Join the MIT Club of Northern California
                            today</h2>
                        <h4 class="white-text">Membership is open to all MIT graduates.</h4>
                        <p>Enjoy access to members-only events, early access to popular events, member
                            pricing, vote for board members, and other members-only benefits.</p>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
