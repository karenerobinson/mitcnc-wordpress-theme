<?php global $assets_uri, $home;

if (isset($_SERVER['REQUEST_METHOD']) && filter_var(wp_unslash($_SERVER['REQUEST_METHOD']), FILTER_SANITIZE_STRING) && isset($_GET['ticket']) && filter_var(wp_unslash($_GET['ticket']), FILTER_SANITIZE_STRING)) {
    wp_redirect(get_permalink(4085) . '?ticket=' . wp_unslash($_GET['ticket']));
    exit;
}
    session_start();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width,  user-scalable=no, initial-scale=1, shrink-to-fit=no">
        <meta name="Referrer-Policy" value="no-referrer | same-origin"/>
        <link rel="shortcut icon" href="<?php echo esc_url($assets_uri); ?>/images/favicon.png" />
        <?php wp_head(); ?>
        <?php date_default_timezone_set('America/Los_Angeles'); ?>
        <?php if (is_page_template('page-templates/template-event-agenda.php') || is_page_template('page-templates/template-mit-ai-influencer-awards-2020.php') || is_page_template('page-templates/template-mit-ai-conference-2020-idol.php')  || is_page_template('page-templates/template-research-slam-mit-ai-conference-2020.php')) { ?>
                <!-- Global site tag (gtag.js) - Google Analytics -->
                <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130796301-2"></script>
                <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-130796301-2');
                </script>
        <?php }; ?>
        <?php
            global $post, $login_page_id;
            $body_class = '';
        if (isset($post->post_parent)) {
            $ancestors = get_post_ancestors($post->ID);
            $ancestors_count = count($ancestors);
            for ($i = 0; $i < $ancestors_count; $i++) {
                $data_ancestor = get_post($ancestors[$i]);
                if (0 == $data_ancestor->post_parent) {
                    $body_class = $data_ancestor->post_name;
                    break;
                }
            }
        } else {
            $body_class = 'no-parent';
        }
        ?>
        <?php
        if (is_singular('events') || is_singular('puzzle-snacks') || is_singular('puzzles')) {
            $image_url = !empty(get_field('social_share_image')) ? get_field('social_share_image') : get_the_post_thumbnail_url(get_the_ID(), 'full');
            ?>
            <meta property="og:image" content="<?php echo esc_url($image_url); ?>">
            <meta name="twitter:image" content="<?php echo esc_url($image_url); ?>">
            <?php
        } else if (is_author()) {
            global $userobj;
            if (null != $userobj && isset($userobj->ID) && $userobj->ID > 0) {
                $speaker_bio = get_field('bio', 'user_' . $userobj->ID);
                $speaker_img = get_field('profile_image', 'user_' . $userobj->ID);
                $speaker_img = !empty($speaker_img) ? $speaker_img : get_asset_uri('/images/placeholder.png');

                $description = strip_tags(substr($speaker_bio, 0, 500)) . '...';
                ?>
                    <meta property="og:description" content="<?php echo esc_html($description); ?>" />
                    <meta property="og:image" content="<?php echo esc_url($speaker_img); ?>" />

                    <meta name="twitter:description" content="<?php echo esc_html($description); ?>" />
                    <meta name="twitter:image" content="<?php echo esc_url($speaker_img); ?>" />
                <?php
            }
        }
        ?>
        <style type="text/css">
            .parent-pageid-85 .main-sidebar-container .bellows-submenu li{
                display: none !important;
            }
            .parent-pageid-85 .main-sidebar-container .bellows-submenu .bellows-menu-item-has-children.bellows-menu-item-713,
            .parent-pageid-85 .main-sidebar-container .bellows-submenu .bellows-menu-item-has-children.bellows-menu-item-713 li{
                display: block !important;
            }
            header .navigation{
                display: flex;
                justify-content: flex-end;
                align-items: flex-start;
            }
            header .navigation ul li.hidden{
                display: none;
            }
            header .navigation ul{
                display: inline-block;
            }
            header .navigation ul li .drop-down{
                width: 130%;
            }

            @media (min-width: 768px) {
                .speaker-card .card-img img{
                    width: 100%;
                    height: auto;
                }
            }

            <?php if (is_page_template('page-templates/template-home-new.php') || is_page_template('page-templates/template-home-with-lazy-load.php')) { ?>
                .home .yotu-playlist .yotu-videos.yotu-mode-grid h3.yotu-video-title{
                    position: absolute;
                    margin: 0 !important;
                    top: auto;
                    bottom: 0;
                    display: flex;
                    align-items: center;
                    justify-content: flex-start;
                }
            <?php } ?>
            <?php if (is_page_template('page-templates/template-photos.php')) { ?>
                /* added by faraz */
                .photonic-loading{
                    z-index: 10000;
                }
                .photonicModalOverlay{
                    z-index: 9999;
                    background-color: #000;
                }
                .photonicModalOverlay .photonicModalOverlayScrollable{
                    padding: 30px;
                }
                .photonicModalOverlay .photonic-google-photo{
                    border-radius: 5px;
                    margin: 10px;
                }
                .photonicModalOverlay .photonic-google-photo a img{
                    height: 200px;
                    width: 349px;
                    object-fit: cover;
                    object-position: center;
                    padding: 0;
                }
                .photonicModalOverlay a.photonicModalClose{
                    top: 20px;
                    position: fixed;

                    right: 36px !important;
                    font-size: 45px !important;
                    width: 45px !important;
                        height: 45px !important;
                }
                   .photonicModalOverlay a.photonicModalClose:hover{
                        text-decoration: none !important;
                 }
                .photonicModalOverlay .photonic-more-button{
                    padding: 3px 25px;
                    background: #A31F34;
                    color: #ffffff;
                    text-align: center;
                    border-radius: 30px;
                    margin-top: 10px;
                    border: 1px solid #A31F34;
                    text-decoration: none;
                }
                .photonicModalOverlay .photonic-more-button:hover{
                    background: #fff;
                    color: #A31F34;
                }

                .photonic-panel {
                    background: rgb(0, 0, 0) !important;
                    
                }
            <?php } ?>
            <?php if (is_singular('events')) { ?>
                /*hacked by faraz for runtime bug on live to limit speakers on banner */
                .banner-speakers li{
                   display: none !important;
                }
                .banner-speakers li:nth-child(-n+8) {
                   display: inline-block !important;
                }
            <?php } ?>

            <?php if (is_author()) { ?>
                @media(min-width: 1024px){
                    .slick-slider{
                        user-select: auto;
                    }
                }
            <?php } ?>
        </style>



    </head>
    <body <?php body_class($body_class); ?>>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="logo">
                            <a href="<?php echo esc_url($home); ?>">
                                <img src="<?php echo esc_url($assets_uri); ?>/images/logo.svg" alt="MITCNC">
                            </a>
                        </div>
                    </div>
                    <div class="toggle-button">
                        <a href="#" class="burger-menu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>

                        <a href="#" class="close-menu-btn"><img src="<?php echo esc_url($assets_uri); ?>/images/cancel-red.svg" alt="MITCNC"></a>
                    </div>
                    <div class="col-sm-18 col-md-<?php echo (current_user_can('administrator')) ? '15' : '18'; ?>">
                        <div class="navigation">

                            <?php
                                // when mega menu is going to be added then remember to remove code from custom.js search: // FOR MEGA MENU in custom.js
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'menu-primary',
                                        'container' => 'ul',
                                        'container_id' => 'primary-menu-container',
                                        'container_class' => ' ',
                                        'menu_id' => 'menu-main_menu',
                                        'menu_class' => 'main-nav',
                                        'walker' => new mitcnc_walker()
                                    )
                                );
                                if (get_current_user_id() > 0) {
                                    ?>
                                        <ul id="menu-for_login" class="main-nav" style="top: 15px;">
                                            <li id="menu-item-4249" class=" red-background menu-item menu-item-type-post_type menu-item-object-page menu-item-4249">
                                                <a href="<?php echo esc_url(wp_logout_url()); ?>" style="background:  #A31F34;color: #fff !important;">
                                                    Logout
                                                </a>
                                            </li>
                                        </ul>
                                    <?php
                                } else {
                                    wp_nav_menu(
                                        array(
                                            'menu' => 'for_login',
                                            'container' => 'ul',
                                            'container_id' => 'primary-menu-container',
                                            'container_class' => ' ',
                                            'menu_id' => 'menu-main_menu2',
                                            'menu_class' => 'main-nav',
                                            'walker' => new mitcnc_walker()
                                        )
                                    );
                                }

                                ?>
                        
                        </div>
                    </div>
                    <?php if (current_user_can('administrator')) { ?>
                    <div class="col-auto col-md-2 text-center p-0 mobile-search">
                        <div class="search">
                            <span><a href="javascript:void(0);" class="search-icon" onclick="openNav()"><img src="<?php echo esc_url($assets_uri); ?>/images/icons/search.svg" alt="" ></a></span>
                        </div>    
                    </div>
                    <?php } ?>
                </div>
            </div>
        </header>

        <?php if (current_user_can('administrator')) get_template_part('template-parts/search', 'popup'); ?>

        <div class="mobile-navigation">
            <div class="bellows-header-menu">
                <?php
                bellows('main', array( 'menu' => 2 ));
                if (get_current_user_id() > 0) {
                    ?>
                        <nav id="bellows-main-85" class="bellows bellows-main bellows-source-menu bellows-align-full bellows-skin-none">
                            <ul id="menu-for_login" class="bellows-nav" data-bellows-config="main">
                                <li id="menu-item-4249" class="bellows-menu-item bellows-menu-item-type-post_type bellows-menu-item-object-page bellows-menu-item-4249 bellows-item-level-0">
                                    <a href="<?php echo esc_url(wp_logout_url()); ?>" class="bellows-target">
                                        <span class="bellows-target-title bellows-target-text">Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    <?php
                } else {
                    bellows('main', array( 'menu' => 85 ));
                }
                ?>
            </div>
        </div>

        <div class="share-icons">
            <ul>
                <li>
                    <a href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank">
                        <img src="<?php echo esc_url($assets_uri); ?>/images/share-fb.svg" alt="">
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>&amp;hashtags=MITCNC" target="_blank">
                        <img src="<?php echo esc_url($assets_uri); ?>/images/share-tw.svg" alt="">
                    </a>
                </li>
                <li>
                    <a href="mailto:?subject=<?php echo esc_html(get_the_title()); ?>&amp;body=Check out this site: <?php echo urlencode(get_permalink()); ?>">
                        <img src="<?php echo esc_url($assets_uri); ?>/images/share-mail.svg" alt="">
                    </a>
                </li>
            </ul>
        </div>
