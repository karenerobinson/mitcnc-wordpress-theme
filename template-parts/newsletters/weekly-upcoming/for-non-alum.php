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
       $all_event_locations,
       $newsletter_banner,
       $newsletter_banner_link,
       $intro;

$upcoming_event = $event_list;
?>
<style>
    html, body {
        background: #e4e4e4;
        margin: 0;
        padding: 0;
    }
</style>

<table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#e4e4e4" style="width: 640px; overflow: hidden;">
    <tbody>
    <tr>
        <td style="padding: 10px; 20px; color: #3c3c42; font-size: 14px; font-family: Helvetica, Arial, sans-serif; text-align: right;">
            <strong><?php echo get_the_date("l, F j, Y", $post_id); ?></strong>
        </td>
    </tr>
    <?php if (!empty($newsletter_banner)) { ?>
        <tr>
            <td>
                <?php if(!empty($newsletter_banner_link)){ ?><a href="<?php echo $newsletter_banner_link; ?>"><?php } ?>
                    <img style="border-radius: 4px;" width="640" src="<?php echo $newsletter_banner; ?>" />
                    <?php if(!empty($newsletter_banner_link)){ ?></a><?php } ?>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;" valign="top">
            <p><span style="font-size: 16px;">Hi&nbsp;##Full Name##</span></p>
            <p style="text-align: center;"><span style="font-size: 25px; font-weight: bold;">Welcome to our
                    2019-2020 Season</span><br><span style="font-size: 18px;">Here are some upcoming events
                    we thought you wouldn't want to miss</span></p>
            <table width="600" border="0" cellspacing="0" cellpadding="0" style="padding-top: 14px;">
                <tbody>
                    <tr>
                        <td width="100%" valign="top">
                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td style="padding-bottom: 14px;"><a href="https://www.mitcnc.org/calendar/"><img style="border-radius: 4px;" src="https://www.mitcnc.org/app/media/2019/10/event-calendar-banner.png" width="100%"></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>

    <?php if($upcoming_event != null): ?>
    <tr>
        <td style="background-color: #fff; padding: 20px; border-radius: 4px; box-shadow: 1px 1px 1px #ccc;" valign="top"><span style="padding: 6px 0px 16px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; color: #000000;">Upcoming
                Events</span>
            <table width="600" border="0" cellspacing="0" cellpadding="0" style="padding-top: 14px;">
                <tbody>
                    <tr>
                        <td width="100%" valign="top">
                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <?php foreach ($upcoming_event as $event): ?>
                                    <?php $event = get_post($event); ?>
                                    <?php $event_locations = wp_get_post_terms($event->ID, 'event-locations'); ?>
                                    <?php $event_locations = (isset($event_locations[0]->name) ? $event_locations[0]->name : '&nbsp;'); ?>
                                    <?php $city = get_field('location_city', $event->ID); ?>
                                    <?php $city = (isset($city['label']) ? $city['label'] : ''); ?>
                                        <tr>
                                            <td style="padding-bottom: 14px;">
                                                <a href="<?php echo get_permalink($event->ID); ?>">
                                                <img style="border-radius: 4px;" src="<?php echo get_field('newsletter_event_image',$event->ID); ?>" width="100%"></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <?php endif; ?>
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
                    <td width="25%" style="border: 1px solid rgb(235, 235, 235); text-align: center;">
                        <a href="https://mitcnc.slack.com/join/signup">
                            <img src="<?php echo $assets_uri; ?>/images/newsletter/logo-slack.png" style="text-align: center;" width="150" height="80">
                        </a>
                    </td>
                    <td width="25%" style="border: 1px solid rgb(235, 235, 235); text-align: center;">
                        <a href="https://www.linkedin.com/company/mitcnc/">
                            <img src="<?php echo $assets_uri; ?>/images/newsletter/logo-tm.png" style="" width="150" height="36">
                        </a>
                    </td>
                    <td width="25%" style="border: 1px solid rgb(235, 235, 235); text-align: center;">
                        <a href="https://www.facebook.com/groups/mitcnc/">
                            <img src="<?php echo $assets_uri; ?>/images/newsletter/images.png" alt="" style="text-align: center;" width="104" height="80">
                        </a>
                    </td>
                    <td width="25%" style="border:solid 1px #EBEBEB; border-left:none;">
                        <p style="" align="center">
                            <a href="https://twitter.com/mitcnc">
                                <img src="<?php echo $assets_uri; ?>/images/newsletter/twitter-icon-134pixel.png" alt="" style="" width="62" height="50">
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
            <table
                style="background-color: #A31F34; text-align: center; border-radius: 2px; font-family: Helvetica, Arial, sans-serif;"
                border="0" width="100%" cellspacing="20" cellpadding="20">
                <tbody>
                <tr>
                    <td style="border: 1px solid #adadb9; color: #adadb9;">
                        <a style="color: #fff; font-family: Helvetica, Arial, sans-serif; text-decoration: none; font-size: 18px; font-weight: bold;" href="https://encompass.alum.mit.edu/s/1314/2015/club-class-main.aspx?sid=1314&gid=25&pgid=45853&cid=70021">
                            Make A Tax-Deductible Donation To Our Scholarship Fund <img src="<?php echo $assets_uri; ?>/images/newsletter/arrow-right1.png"alt="" width="28" height="20"/><br/>
                        </a>
                        <!-- <span style="font-size: 16px; color: #f1a3b1;">Membership is open to all MIT graduates.</span> -->
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
            <table style="font-family: Helvetica, Arial, sans-serif; color: #adadb9;" border="0" width="100%"
                   cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td style="padding-bottom: 10px;" width="60%"><img
                            src="<?php echo $assets_uri; ?>/images/newsletter/footer-logo.png"
                            alt="" width="85" height="60"/></td>
                    <td align="left" valign="middle" width="40%"><img
                            src="<?php echo $assets_uri; ?>/images/newsletter/logo-mitcnc-white.png"
                            alt="" width="220" height="50"/></td>
                </tr>
                <tr>
                    <td>
                        <p><strong>##Sender_Org##, ##Sender_Address##, ##Sender_City##, ##Sender_State##</strong><br/></p>
                        <p style="font-size: 14px;"><a style="color: #adadb9; text-decoration: none;"
                                                       href="https://alum.mit.edu/about/privacy-statement">Privacy
                                Policy</a> | <a style="color: #adadb9; text-decoration: none;"
                                                href="http://northerncalifornia.alumclub.mit.edu/s/1314/2015/club-class-main.aspx?sid=1314&gid=25&pgid=37&cid=51&seiid=30557&ecatid=4&puid=">##Unsubscribe##</a>
                        </p>
                    </td>
                    <td align="left" valign="top">
                        <p><a style="color: #adadb9; text-decoration: none;" href="mailto:clubadmin@mitcnc.org">clubadmin@mitcnc.org</a>
                        </p>
                        <table width="100%" cellspacing="0" cellpadding="0" align="left">
                            <tbody>
                            <tr>
                                <td style="font-family: Helvetica, Arial, sans-serif; color: #adadb9;"
                                    colspan="3">Connect with Us
                                </td>
                            </tr>
                            <tr>
                                <td width="20" height="30"><a href="https://www.facebook.com/groups/mitcnc/">
                                        <img
                                            src="<?php echo $assets_uri; ?>/images/newsletter/facebook.png"
                                            alt="" width="8" height="16"/></a></td>
                                <td width="30"><a href="http://www.twitter.com/mitcnc"> <img
                                            src="<?php echo $assets_uri; ?>/images/newsletter/twitter.png"
                                            alt="" width="17" height="14"/></a></td>
                                <td><a href="https://www.linkedin.com/company/mitcnc/"> <img
                                            src="<?php echo $assets_uri; ?>/images/newsletter/linkedin.png"
                                            alt="" width="17" height="16"/></a></td>
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