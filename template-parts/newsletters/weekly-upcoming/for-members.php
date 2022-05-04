<?php
global $user_profile_page_id,
    $newsletter_type_event_listing,
    $post_id,
    $newsletter_type,
    $assets_uri,
    $event_location_taxonomy,
    $event_post_type,
    $featured_event,
    $event_list,
    $event_list_bay_area,
    $event_list_east_bay,
    $event_list_north_bay,
    $event_list_peninsula,
    $event_list_sacramento,
    $event_list_san_francisco,
    $event_list_south_bay,
    $all_event_locations,
    $newsletter_banner,
    $newsletter_banner_link,
    $intro;
$upcoming_event = $event_list;
?>
<style>
    html,
    body {
        background: #e4e4e4;
        margin: 0;
        padding: 0;
    }
</style>

<table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#e4e4e4" style="width: 640px; overflow: hidden;">
    <tbody>
        <tr>
            <td style="padding: 10px; 20px; color: #3c3c42; font-size: 14px; font-family: Helvetica, Arial, sans-serif; text-align: right;"><strong><?php echo get_the_date("l, F j, Y", $post_id); ?></strong></td>
        </tr>

        <?php if (!empty($newsletter_banner)) : ?>
            <tr>
                <td>
                    <?php if (!empty($newsletter_banner_link)) : ?>
                        <a href="<?php echo $newsletter_banner_link; ?>">
                            <img style="border-radius: 4px;" width="640" src="<?php echo $newsletter_banner; ?>">
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endif; ?>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="background-color: #fff;padding: 20px 20px 0; box-shadow:1px 1px 1px #ccc;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td style="font-family:Helvetica, Arial, sans-serif; font-size: 16px; color: #000000; padding: 0 0 20px 0; font-weight: normal;"
                                colspan="2"> Hi ##First Name## <br>
                                <br>
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <?php if ($upcoming_event != null) : ?>
            <tr>
                <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;"><span style="padding: 30px 0 16px; font-family: Helvetica, Arial, sans-serif;  color: #000000;">Here are some upcoming events we thought you wouldn't want to miss in 2020: </span><br><br>
                    <table style="font-family: Helvetica, Arial, sans-serif; padding-top: 20px;" border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <?php foreach ($upcoming_event as $event) {
                                $event = get_post($event);
                                $event_locations = wp_get_post_terms($event->ID, 'event-locations');
                                $event_locations = (isset($event_locations[0]->name) ? $event_locations[0]->name : '&nbsp;');
                                $city = get_field('location_city', $event->ID);
                                $city = (isset($city['label']) ? $city['label'] : '');
                                $date_time_start = get_field('date_time_date_time_start', $event->ID);
                                $date_time_end = get_field('date_time_date_time_end', $event->ID);
                            ?>
                                <tr>
                                    <td style="border-bottom: 1px dotted #ebebf1; font-size: 20px; text-align: center; background-color: #ebebf1; color: #000; font-weight: bold; padding: 6px 10px;" align="center"><?php echo date('j', strtotime($date_time_start)); ?></td>
                                    <td style="border-bottom: 1px dotted #adadb9; padding: 6px 15px;" colspan="3">
                                        <a href="<?php echo get_permalink($event->ID); ?>" style="font-family: Helvetica, Arial, sans-serif; font-size: 18px; text-align: left; color: #000; font-weight: bold; text-decoration: none; display: block;"><?php echo $event->post_title; ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px; text-align: center; background-color: #d2d2da; color: #000; font-weight: bold; padding: 4px 5px; text-transform: uppercase;" align="center"><?php echo date('M', strtotime($date_time_start)); ?></td>
                                    <td style="color: #63636e; font-family: Helvetica, Arial, sans-serif; font-size: 14px; text-transform: uppercase; font-weight: bold; padding: 4px 15px;">
                                        <?php echo $event_locations; ?>
                                    </td>
                                    <td style="padding: 4px;"><img src="<?php echo $assets_uri; ?>/images/newsletter/icon-calendar.png" alt="" width="20" height="20"></td>
                                    <td style="color: #63636e; font-family: Helvetica, Arial, sans-serif; font-size: 14px; padding: 4px 10px;">
                                        <?php echo date('l, F j, Y | ', strtotime($date_time_start)); ?><?php echo date('g:i A', strtotime($date_time_start)) . ' - ' . date('g:i A', strtotime($date_time_end)) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </td>
            </tr> 
            <tr>
                <td>&nbsp;</td>
            </tr>
            <?php /* <tr>
                <td style="background-color: #282936;padding: 20px;border-radius: 4px;box-shadow: 1px 1px 1px #ccc;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: #fff; padding: 6px 0px 16px 0px; font-weight: normal;">
                                    Featured Event
                                </td>
                            </tr>
                            <?php foreach ($featured_event as $event) : ?>
                                <?php $event = get_post($event); ?>
                                <?php $event_locations = wp_get_post_terms($event->ID, 'event-locations'); ?>
                                <?php $event_locations = (isset($event_locations[0]->name) ? $event_locations[0]->name : '&nbsp;'); ?>
                                <?php $city = get_field('location_city', $event->ID); ?>
                                <?php $city = (isset($city['label']) ? $city['label'] : ''); ?>
                                <tr>
                                    <td style="color: #adadb9; padding-bottom: 10px; font-family: Helvetica, Arial, sans-serif; font-weight: bold; text-transform: uppercase;">
                                        <?php echo $event_locations; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <a href="<?php echo get_permalink($event->ID); ?>">
                                            <img style="border-radius: 4px;" src="<?php echo get_field('newsletter_event_image', $event->ID); ?>" width="600" alt="">
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <table border="0" width="100%" cellspacing="0" cellpadding="10">
                                            <tbody>
                                                <tr>
                                                    <td width="30">
                                                        <img src="<?php echo $assets_uri; ?>/images/newsletter/icon-calendar.png" alt="" width="30" height="30">
                                                    </td>
                                                    <td style="color: #adadb9; font-family: Helvetica, Arial, sans-serif;">
                                                        <?php echo date('l, F j, Y | ', strtotime(get_field('date_time_date_time_start', $event->ID))); ?><?php echo date('g:i A', strtotime(get_field('date_time_date_time_start', $event->ID))) . ' - ' . date('g:i A', strtotime(get_field('date_time_date_time_end', $event->ID))) ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="color: #adadb9; padding: 10px 0; font-family: Helvetica, Arial, sans-serif; border-bottom: 1px dotted #63636e; border-top: 1px dotted #63636e;">
                                        <span style="font-size: 22px; font-weight: bold; color: #ffffff;">
                                            <?php echo $event->post_title; ?>
                                        </span>
                                        <p style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #ffffff;">
                                            <?php echo mb_strimwidth(strip_tags($event->post_content), 0, 300, '...'); ?>
                                        </p>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr> */ ?>
        <?php endif; ?>


        <!-- <tr>
            <td style="background-color: #fff; padding: 20px;  box-shadow: 1px 1px 1px #ccc;"><span style="padding: 30px 0 16px; font-family: Helvetica, Arial, sans-serif;  color: #000000;">Here are some upcoming events we thought you wouldn't want to miss in 2020: </span><br><br>
                <table style="font-family: Helvetica, Arial, sans-serif; padding-top: 20px;" border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>

                        <tr>
                            <td style="border-bottom: 1px dotted #ebebf1; font-size: 20px; text-align: center; background-color: #ebebf1; color: #000; font-weight: bold; padding: 6px 10px;" align="center">28</td>
                            <td style="border-bottom: 1px dotted #adadb9; padding: 6px 15px;" colspan="3"><a href="https://www.mitcnc.org/events/women-backing-women/" style="font-family: Helvetica, Arial, sans-serif; font-size: 18px; text-align: left; color: #000; font-weight: bold; text-decoration: none; display: block;">
                                    Women Backing Women</a></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px; text-align: center; background-color: #d2d2da; color: #000; font-weight: bold; padding: 4px 5px;" align="center">Apr</td>
                            <td style="color: #63636e; font-family: Helvetica, Arial, sans-serif; font-size: 14px; text-transform: uppercase; font-weight: bold; padding: 4px 15px;">
                                San Francisco</td>
                            <td style="padding: 4px;"><img src="<?php echo $assets_uri; ?>/images/newsletter/icon-calendar.png" alt="" width="20" height="20"></td>
                            <td style="color: #63636e; font-family: Helvetica, Arial, sans-serif; font-size: 14px; padding: 4px 10px;">
                                Sunday, April 28, 2019 | 1:00 PM - 3:00 PM</td>
                        </tr>
                        <tr>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px dotted #ebebf1; font-size: 20px; text-align: center; background-color: #ebebf1; color: #000; font-weight: bold; padding: 6px 10px;" align="center">28</td>
                            <td style="border-bottom: 1px dotted #adadb9; padding: 6px 15px;" colspan="3"><a href="https://www.mitcnc.org/events/women-backing-women/" style="font-family: Helvetica, Arial, sans-serif; font-size: 18px; text-align: left; color: #000; font-weight: bold; text-decoration: none; display: block;">
                                    Women Backing Women</a></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px; text-align: center; background-color: #d2d2da; color: #000; font-weight: bold; padding: 4px 5px;" align="center">Apr</td>
                            <td style="color: #63636e; font-family: Helvetica, Arial, sans-serif; font-size: 14px; text-transform: uppercase; font-weight: bold; padding: 4px 15px;">
                                San Francisco</td>
                            <td style="padding: 4px;"><img src="<?php echo $assets_uri; ?>/images/newsletter/icon-calendar.png" alt="" width="20" height="20"></td>
                            <td style="color: #63636e; font-family: Helvetica, Arial, sans-serif; font-size: 14px; padding: 4px 10px;">
                                Sunday, April 28, 2019 | 1:00 PM - 3:00 PM</td>
                        </tr>
                        <tr>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr> -->
        <tr>
            <td style="background-color: #fff; padding: 20px; ; box-shadow: 1px 1px 1px #ccc; border-radius: 4px;">
                <table width="600" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td>
                                <span style="padding: 6px 0px 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: rgb(0, 0, 0);">
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
                                            <td style="font-family: Helvetica, Arial, sans-serif;background-color: green;border: 3px solid #6e6f7b;text-align: center;font-size: 14px;" width="180">
                                                <a style="text-decoration: none; color: #fff;" href="https://www.mitcnc.org/get-involved/volunteer/">Volunteer</a>
                                            </td>
                                            <td width="0"></td>
                                            <td style="font-family: Helvetica, Arial, sans-serif;background-color: green;border: 3px solid #6e6f7b;text-align: center;;font-size: 14px;" width="180">
                                                <a style="text-decoration: none; color: #fff;" href="https://www.mitcnc.org/get-involved/venue-eventspaces/">Host</a>
                                            </td>
                                            <td width="0"></td>
                                            <td style="font-family: Helvetica, Arial, sans-serif;background-color: green;border: 3px solid #6e6f7b;text-align: center;ff;font-size: 14px;" width="180">
                                                <a style="text-decoration: none; color: #fff;" href="https://www.mitcnc.org/get-involved/speaker/">Speak</a>
                                            </td>
                                            <td width="0"></td>
                                            <td style="font-family: Helvetica, Arial, sans-serif;background-color: green;border: 3px solid #6e6f7b;text-align: center;;font-size: 14px;" width="180">
                                                <a style="text-decoration: none; color: #fff;" href="https://www.mitcnc.org/get-involved/sponsor/">Sponsor</a>
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

        <?php if ($upcoming_event != null) { ?>
	        <tr>
	            <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;"
	                valign="top">
                    <span style="padding: 6px 0px 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: #000000;">Upcoming Events</span>
	                <table width="600" border="0" cellspacing="0" cellpadding="0" style="padding-top: 14px;">
	                    <tbody>
	                    <tr>
	                        <td width="100%" valign="top">
	                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
	                                <tbody>
                                        <?php
                                        foreach ($upcoming_event as $key => $upcoming){
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
                                                    <a href="<?php echo get_permalink($upcoming->ID); ?>"><img style="border-radius: 4px;" src="<?php echo $image; ?>" width="600" /></a>
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
        
        <?php if ($event_list_bay_area != null) : ?>
            <tr>
                <td> </td>
            </tr>
            <tr>
                <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                    <span style="padding: 30px 0 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: #000000;">
                        Bay Area
                    </span>
                    <br>
                    <br>
                    <table style="font-family: Helvetica, Arial, sans-serif; padding-top: 20px;" border="0" width="600" cellspacing="0" cellpadding="0">
                        <tbody>
                            <?php foreach ($event_list_bay_area as $event) : ?>
                                <?php $event = get_post($event); ?>
                                <?php $event_locations = wp_get_post_terms($event->ID, 'event-locations'); ?>
                                <?php $event_locations = (isset($event_locations[0]->name) ? $event_locations[0]->name : '&nbsp;'); ?>
                                <?php $city = get_field('location_city', $event->ID); ?>
                                <?php $city = (isset($city['label']) ? $city['label'] : ''); ?>

                                <tr>
                                    <td style="padding-bottom: 14px;">
                                        <a href="<?php echo get_permalink($event->ID); ?>">
                                            <img style="border-radius: 4px;" src="<?php echo get_field('newsletter_event_image', $event->ID); ?>" width="600">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endif ?>

        <?php if ($event_list_east_bay != null) : ?>
            <tr>
                <td> </td>
            </tr>

            <tr>
                <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                    <span style="padding: 30px 0 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: #000000;">
                        East Bay
                    </span>
                    <br>
                    <br>
                    <table style="font-family: Helvetica, Arial, sans-serif; padding-top: 20px;" border="0" width="600" cellspacing="0" cellpadding="0">
                        <tbody>
                            <?php foreach ($event_list_east_bay as $event) : ?>
                                <?php $event = get_post($event); ?>
                                <?php $event_locations = wp_get_post_terms($event->ID, 'event-locations'); ?>
                                <?php $event_locations = (isset($event_locations[0]->name) ? $event_locations[0]->name : '&nbsp;'); ?>
                                <?php $city = get_field('location_city', $event->ID); ?>
                                <?php $city = (isset($city['label']) ? $city['label'] : ''); ?>

                                <tr>
                                    <td style="padding-bottom: 14px;">
                                        <a href="<?php echo get_permalink($event->ID); ?>">
                                            <img style="border-radius: 4px;" src="<?php echo get_field('newsletter_event_image', $event->ID); ?>" width="100%">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endif; ?>

        <?php if ($event_list_north_bay != null) : ?>
            <tr>
                <td> </td>
            </tr>

            <tr>
                <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                    <span style="padding: 30px 0 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: #000000;">
                        North Bay
                    </span>
                    <br>
                    <br>
                    <table style="font-family: Helvetica, Arial, sans-serif; padding-top: 20px;" border="0" width="600" cellspacing="0" cellpadding="0">
                        <tbody>
                            <?php foreach ($event_list_north_bay as $event) : ?>
                                <?php $event = get_post($event); ?>
                                <?php $event_locations = wp_get_post_terms($event->ID, 'event-locations'); ?>
                                <?php $event_locations = (isset($event_locations[0]->name) ? $event_locations[0]->name : '&nbsp;'); ?>
                                <?php $city = get_field('location_city', $event->ID); ?>
                                <?php $city = (isset($city['label']) ? $city['label'] : ''); ?>

                                <tr>
                                    <td style="padding-bottom: 14px;">
                                        <a href="<?php echo get_permalink($event->ID); ?>">
                                            <img style="border-radius: 4px;" src="<?php echo get_field('newsletter_event_image', $event->ID); ?>" width="100%">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endif; ?>

        <?php if ($event_list_peninsula != null) : ?>
            <tr>
                <td> </td>
            </tr>

            <tr>
                <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                    <span style="padding: 30px 0 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: #000000;">
                        Peninsula
                    </span>
                    <br>
                    <br>
                    <table style="font-family: Helvetica, Arial, sans-serif; padding-top: 20px;" border="0" width="600" cellspacing="0" cellpadding="0">
                        <tbody>
                            <?php foreach ($event_list_peninsula as $event) : ?>
                                <?php $event = get_post($event); ?>
                                <?php $event_locations = wp_get_post_terms($event->ID, 'event-locations'); ?>
                                <?php $event_locations = (isset($event_locations[0]->name) ? $event_locations[0]->name : '&nbsp;'); ?>
                                <?php $city = get_field('location_city', $event->ID); ?>
                                <?php $city = (isset($city['label']) ? $city['label'] : ''); ?>

                                <tr>
                                    <td style="padding-bottom: 14px;">
                                        <a href="<?php echo get_permalink($event->ID); ?>">
                                            <img style="border-radius: 4px;" src="<?php echo get_field('newsletter_event_image', $event->ID); ?>" width="100%">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endif; ?>

        <?php if ($event_list_sacramento != null) : ?>
            <tr>
                <td> </td>
            </tr>

            <tr>
                <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                    <span style="padding: 30px 0 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: #000000;">
                        Sacramento
                    </span>
                    <br>
                    <br>
                    <table style="font-family: Helvetica, Arial, sans-serif; padding-top: 20px;" border="0" width="600" cellspacing="0" cellpadding="0">
                        <tbody>
                            <?php foreach ($event_list_sacramento as $event) : ?>
                                <?php $event = get_post($event); ?>
                                <?php $event_locations = wp_get_post_terms($event->ID, 'event-locations'); ?>
                                <?php $event_locations = (isset($event_locations[0]->name) ? $event_locations[0]->name : '&nbsp;'); ?>
                                <?php $city = get_field('location_city', $event->ID); ?>
                                <?php $city = (isset($city['label']) ? $city['label'] : ''); ?>

                                <tr>
                                    <td style="padding-bottom: 14px;">
                                        <a href="<?php echo get_permalink($event->ID); ?>">
                                            <img style="border-radius: 4px;" src="<?php echo get_field('newsletter_event_image', $event->ID); ?>" width="100%">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endif; ?>

        <?php if ($event_list_san_francisco != null) : ?>
            <tr>
                <td> </td>
            </tr>

            <tr>
                <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                    <span style="padding: 30px 0 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: #000000;">
                        San Francisco
                    </span>
                    <br>
                    <br>
                    <table style="font-family: Helvetica, Arial, sans-serif; padding-top: 20px;" border="0" width="600" cellspacing="0" cellpadding="0">
                        <tbody>
                            <?php foreach ($event_list_san_francisco as $event) : ?>
                                <?php $event = get_post($event); ?>
                                <?php $event_locations = wp_get_post_terms($event->ID, 'event-locations'); ?>
                                <?php $event_locations = (isset($event_locations[0]->name) ? $event_locations[0]->name : '&nbsp;'); ?>
                                <?php $city = get_field('location_city', $event->ID); ?>
                                <?php $city = (isset($city['label']) ? $city['label'] : ''); ?>

                                <tr>
                                    <td style="padding-bottom: 14px;">
                                        <a href="<?php echo get_permalink($event->ID); ?>">
                                            <img style="border-radius: 4px;" src="<?php echo get_field('newsletter_event_image', $event->ID); ?>" width="100%">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endif; ?>

        <?php if ($event_list_south_bay != null) : ?>
            <tr>
                <td> </td>
            </tr>

            <tr>
                <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                    <span style="padding: 30px 0 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: #000000;">
                        South Bay
                    </span>
                    <br>
                    <br>
                    <table style="font-family: Helvetica, Arial, sans-serif; padding-top: 20px;" border="0" width="600" cellspacing="0" cellpadding="0">
                        <tbody>
                            <?php foreach ($event_list_south_bay as $event) : ?>
                                <?php $event = get_post($event); ?>
                                <?php $event_locations = wp_get_post_terms($event->ID, 'event-locations'); ?>
                                <?php $event_locations = (isset($event_locations[0]->name) ? $event_locations[0]->name : '&nbsp;'); ?>
                                <?php $city = get_field('location_city', $event->ID); ?>
                                <?php $city = (isset($city['label']) ? $city['label'] : ''); ?>

                                <tr>
                                    <td style="padding-bottom: 14px;">
                                        <a href="<?php echo get_permalink($event->ID); ?>">
                                            <img style="border-radius: 4px;" src="<?php echo get_field('newsletter_event_image', $event->ID); ?>" width="100%">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endif; ?>


        <?php if ($event_list != null && 0) { ?>
            <tr>
                <td> </td>
            </tr>
            <tr>
                <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                    <span style="padding: 30px 0 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: #000000;">All Events</span><br><br>
                    <table style="font-family: Helvetica, Arial, sans-serif; padding-top: 20px;" border="0" width="600" cellspacing="0" cellpadding="0">
                        <tbody>
                            <?php
                            foreach ($event_list as $event) {
                                $event = get_post($event);
                                $event_locations = wp_get_post_terms($event->ID, 'event-locations');
                                $event_locations = (isset($event_locations[0]->name) ? $event_locations[0]->name : '&nbsp;');
                                $city = get_field('location_city', $event->ID);
                                $city = (isset($city['label']) ? $city['label'] : '');
                            ?>
                                <tr>
                                    <td style="border-bottom: 1px dotted #adadb9; font-size: 20px; text-align: center; background-color: #ebebf1; color: #000; font-weight: bold; padding: 6px 10px;" align="center"><?php echo date('d', strtotime(get_field('date_time_date_time_start', $event->ID))); ?></td>
                                    <td style="border-bottom: 1px dotted #adadb9; padding: 6px 15px;" colspan="3">
                                        <a href="<?php echo get_permalink($event->ID); ?>" style="font-family: Helvetica, Arial, sans-serif; font-size: 18px; text-align: left; color: #A31F34; font-weight: bold; text-decoration: none; display: block;"><?php echo $event->post_title; ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px; text-align: center; background-color: #d2d2da; color: #000; font-weight: bold; padding: 4px 5px;" align="center"><?php echo date('M', strtotime(get_field('date_time_date_time_start', $event->ID))); ?></td>
                                    <td style="color: #63636e; font-family: Helvetica, Arial, sans-serif; font-size: 14px; text-transform: uppercase; font-weight: bold; padding: 4px 15px;"><?php echo $event_locations; ?></td>
                                    <td style="padding: 4px;"><img src="<?php echo $assets_uri; ?>/images/newsletter/icon-calendar.png" alt="" width="20" height="20" /></td>
                                    <td style="color: #63636e; font-family: Helvetica, Arial, sans-serif; font-size: 14px; padding: 4px 10px;"><?php echo date('l, F j, Y | ', strtotime(get_field('date_time_date_time_start', $event->ID))); ?><?php echo date('g:i A', strtotime(get_field('date_time_date_time_start', $event->ID))) . ' - ' . date('g:i A', strtotime(get_field('date_time_date_time_end', $event->ID))) ?></td>
                                </tr>
                                <?php if (count($event_list) > 1) { ?>
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
            <td style="background-color: #d0d0d0; color: #121217; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                <span style="padding: 6px 0px 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: #000000;">MITCNC Membership Comes With Benefits</span>
                <p style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #000000;">
                    <strong>##Full Name##</strong><br />
                    Membership Level: <strong color: #a31f34;>##CNC Membership Level##</strong><br />
                    Membership Expiration Date: <br />
                </p>
                <p style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #000000;">
                    <strong>Renew early</strong> - MITCNC introduced an anniversary-based membership that begins on the day you join, where a year is added to your membership expiration date if you renew early. We also launched an auto-renewal option for easy renewals.
                </p>
                <table style="background-color: #a31f34; text-align: center; border-radius: 2px; font-family: Helvetica, Arial, sans-serif;" border="0" width="100%" cellspacing="20" cellpadding="20">
                    <tr>
                        <td style="border: 1px solid #adadb9; color: #adadb9; font-size: 16px;">
                            <a style="color: #fff; font-family: Helvetica, Arial, sans-serif; text-decoration: none; font-size: 18px; font-weight: bold;" href="http://northerncalifornia.alumclub.mit.edu/s/1314/2015/club-class-main.aspx?sid=1314&gid=25&pgid=16045">
                                Renew Your MITCNC Membership Today! <img src="<?php echo $assets_uri; ?>/images/newsletter/arrow-right1.png" alt="" width="28" height="20" />
                                <br />
                            </a> Membership is open to all MIT graduates.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td> </td>
        </tr>
        <tr>
            <td style="background-color: #fff; padding: 20px; ; box-shadow: 1px 1px 1px #ccc; border-radius: 4px;">
                <table width="600" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td>
                                <span style="padding: 6px 0px 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: rgb(0, 0, 0);">
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
                                            <td style="font-family: Helvetica, Arial, sans-serif;background-color: green;border: 3px solid #6e6f7b;text-align: center;font-size: 14px;" width="180">
                                                <a style="text-decoration: none; color: #fff;" href="https://www.mitcnc.org/get-involved/volunteer/">Volunteer</a>
                                            </td>
                                            <td width="0"></td>
                                            <td style="font-family: Helvetica, Arial, sans-serif;background-color: green;border: 3px solid #6e6f7b;text-align: center;;font-size: 14px;" width="180">
                                                <a style="text-decoration: none; color: #fff;" href="https://www.mitcnc.org/get-involved/venue-eventspaces/">Host</a>
                                            </td>
                                            <td width="0"></td>
                                            <td style="font-family: Helvetica, Arial, sans-serif;background-color: green;border: 3px solid #6e6f7b;text-align: center;ff;font-size: 14px;" width="180">
                                                <a style="text-decoration: none; color: #fff;" href="https://www.mitcnc.org/get-involved/speaker/">Speak</a>
                                            </td>
                                            <td width="0"></td>
                                            <td style="font-family: Helvetica, Arial, sans-serif;background-color: green;border: 3px solid #6e6f7b;text-align: center;;font-size: 14px;" width="180">
                                                <a style="text-decoration: none; color: #fff;" href="https://www.mitcnc.org/get-involved/sponsor/">Sponsor</a>
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
        <tr>
            <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                <table border="0" width="600" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td colspan="4" style="padding: 6px 0px 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: rgb(0, 0, 0);">
                                Join The Conversation...
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" style="text-align: center;">
                                <a href="https://mitcnc.slack.com/join/signup">
                                    <img src="<?php echo $assets_uri; ?>/images/newsletter/youtube.png" style="text-align: center;" width="100" height="40">
                                </a>
                            </td>
                            <td width="25%" style="text-align: center;">
                                <a href="https://www.linkedin.com/company/mitcnc/">
                                    <img src="<?php echo $assets_uri; ?>/images/newsletter/logo-tm.png" style="" width="150" height="36">
                                </a>
                            </td>
                            <td width="25%" style="text-align: center;">
                                <a href="https://www.facebook.com/groups/mitcnc/">
                                    <img src="<?php echo $assets_uri; ?>/images/newsletter/podcast.png" alt="" style="text-align: center;" width="165" height="45">
                                </a>
                            </td>
                            <td width="25%" >
                                <p style="" align="center">
                                    <a href="https://twitter.com/mitcnc">
                                        <img src="<?php echo $assets_uri; ?>/images/newsletter/twitter-icon-134pixel.png" alt="" style="" width="50" height="50">
                                    </a>
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
                            <td style="border: 1px solid #adadb9; color: #adadb9;"><a style="color: #fff; font-family: Helvetica, Arial, sans-serif; text-decoration: none; font-size: 18px; font-weight: bold;" href="https://encompass.alum.mit.edu/s/1314/2015/club-class-main.aspx?sid=1314&gid=25&pgid=45853&cid=70021">Make
                                    A Tax-Deductible Donation To Our Scholarship Fund <img src="<?php echo $assets_uri; ?>/images/newsletter/arrow-right1.png" alt="" width="28" height="20" /><br /> </a>
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
            <td style="background-color: #121217; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;">
                <table style="font-family: Helvetica, Arial, sans-serif; color: #adadb9;" border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td style="padding-bottom: 10px;" width="60%"><img src="<?php echo $assets_uri; ?>/images/newsletter/footer-logo.png" alt="" width="85" height="60" /></td>
                            <td align="left" valign="middle" width="40%"><img src="<?php echo $assets_uri; ?>/images/newsletter/logo-mitcnc-white.png" alt="" width="220" height="50" /></td>
                        </tr>
                        <tr>
                            <td>
                                <p><strong>##Sender_Org##, ##Sender_Address##, ##Sender_City##, ##Sender_State##</strong><br /></p>
                                <p style="font-size: 14px;"><a style="color: #adadb9; text-decoration: none;" href="http://northerncalifornia.alumclub.mit.edu/s/1314/2015/club-class-main.aspx?sid=1314&gid=25&pgid=37&cid=51&seiid=30557&ecatid=4&puid=">##Unsubscribe##</a>
                                </p>
                            </td>
                            <td align="left" valign="top">
                                <p><a style="color: #adadb9; text-decoration: none;" href="mailto:clubadmin@mitcnc.org">clubadmin@mitcnc.org</a>
                                </p>
                                <table width="100%" cellspacing="0" cellpadding="0" align="left">
                                    <tbody>
                                        <tr>
                                            <td style="font-family: Helvetica, Arial, sans-serif; color: #adadb9;" colspan="3">Connect with Us
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="20" height="30"><a href="https://www.facebook.com/groups/mitcnc/">
                                                    <img src="<?php echo $assets_uri; ?>/images/newsletter/facebook.png" alt="" width="8" height="16" /></a></td>
                                            <td width="30"><a href="http://www.twitter.com/mitcnc"> <img src="<?php echo $assets_uri; ?>/images/newsletter/twitter.png" alt="" width="17" height="14" /></a></td>
                                            <td><a href="https://www.linkedin.com/company/mitcnc/"> <img src="<?php echo $assets_uri; ?>/images/newsletter/linkedin.png" alt="" width="17" height="16" /></a></td>
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