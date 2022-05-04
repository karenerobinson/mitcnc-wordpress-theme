<?php
    global $assets_uri, $events_page_id, $volunteer_spotlight_page_id;
?>
        <footer>
            <div class="container">
                <div class="footer">
                    <div class="row">
                        <div class="col-sm-24 col-md-6">
                            <div class="left-footer">
                                <a href="http://www.mit.edu/" target="_blank"><img src="<?php echo esc_url($assets_uri); ?>/images/logo-mit-only.svg" alt=""></a>
                                <div class="footer-content">
                                    <h5 class="gray5">MIT Alumni Association</h5>
                                    <p>600 Memorial Drive, W98-2nd Floor Cambridge, MA 02139-4822</p>
                                </div>
                            </div>
                            <div class="right-footer">
                                <div class="footer-links">
                                    <ul>
                                        <li><a href="about-us">About</a></li>
                                        <li><a href="https://alum.mit.edu/directory" target="_blank">Alumni Directory</a></li>
                                        <li><a href="https://giving.mit.edu/" target="_blank">Giving to MIT</a></li>
                                        <li><a href="mailto:clubadmin@mitcnc.org" >Contact Club Admin</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-24 col-md-5 offset-md-1">
                            <div class="footer-menu-container">
                                <ul>
                                    <li><a href="<?php echo esc_url(get_permalink($events_page_id)); ?>">Events </a></li>
                                    <li><a href="<?php echo esc_url(get_permalink($volunteer_spotlight_page_id)); ?>">Volunteer Spotlight</a></li>
                                    <?php if (!get_current_user_id()) : ?>
                                        <li class="footer-menu-join"><a href="<?php echo esc_url(get_membership_url()); ?>">Join</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                       <div class="col-sm-24 col-md-5 offset-md-1">
                            <div class="footer-program-menu">
                                <h6>Programs</h6>
                                <ul>
                                    <li><a href="/programs/mitcnc-circles">MIT Circles</a>
                                    <li><a href="/mit-catalysts">Catalysts Podcast</a>
                                    <li><a href="/programs/energy-and-environment">Energy &amp; Environment Track</a>
                                    <li><a href="/programs/k-12-steam-initiatives/">K-12 STEAM</a>
                                    <li><a href="/startups">Startups Track</a>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-24 col-md-5 offset-md-1">
                            <div class="right-footer">
                                <div class="social-area">
                                    <h6>Follow Us</h6>
                                    <ul>
                                        <li><a href="https://www.facebook.com/groups/MITCNC/" target="_blank" ><img src="<?php echo esc_url($assets_uri); ?>/images/fb.svg" width="8"></a></li>
                                        <li><a href="https://twitter.com/mitcnc" target="_blank" ><img src="<?php echo esc_url($assets_uri); ?>/images/tw.svg" width="16"></a></li>
                                        <li><a href="https://www.linkedin.com/company/mitcnc/" target="_blank" ><img src="<?php echo esc_url($assets_uri); ?>/images/in.svg" width="16"></a></li>
                                        <li><a href="https://mitcnc.slack.com" target="_blank" ><img src="<?php echo esc_url($assets_uri); ?>/images/slack.svg" width="16"></a></li>
                                        <li><a href="https://www.instagram.com/mitcnc/?hl=en" target="_blank" ><img src="<?php echo esc_url($assets_uri); ?>/images/instagram-logo.svg" width="16"></a></li>
                                    </ul>

                                    <div>
                                        <a href="<?php echo esc_url(get_membership_url()); ?>" class="donate-btn"><?php echo get_current_user_id() ? 'My Membership' : 'Join'; ?></a>
                                        <a href="<?php echo esc_url(get_permalink(8128)); ?>" class="donate-btn">Donate</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-24">
                        <div class="footer-bottom">
                            <p class="copy-right">© <?php echo esc_html(date('Y')); ?> MITCNC, All Rights Reserved.</p>
                            <ul>
                                <li><a href="https://alum.mit.edu/about/infinite-connection-terms-conditions-use" target="_blank">Terms and Use </a></li>
                                <li><a href="https://alum.mit.edu/about/privacy-statement" target="_blank">Privacy Statement </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <?php wp_footer(); ?>
        <?php if (get_current_user_id()) : ?>
            <input type="hidden" value="<?php echo esc_attr(get_current_user_id()); ?>" data-name="<?php echo esc_attr(get_field('full_name', 'user_' . get_current_user_id())); ?> <?php echo esc_attr(get_field('user_last_name', 'user_' . get_current_user_id())); ?>" data-profile="<?php echo esc_url(get_author_posts_url(get_current_user_id())); ?> " id="login_status">
        <?php endif; ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script defer src="https://www.googletagmanager.com/gtag/js?id=UA-130796301-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-130796301-1');
        </script>
    </body>
</html>
