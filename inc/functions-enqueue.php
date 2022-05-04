<?php
    // NOTE: This theme requires jQuery 3.3.1+. We rely on the jquery-manager plugin to handle this.

    /* Enqueue styles and scripts */
    add_action( 'wp_enqueue_scripts', function () {
        global $assets_uri, $theme_uri;

        wp_enqueue_style( 'main-style', $assets_uri . '/css/style.css' );
        wp_enqueue_style( 'fancyboxstyle', $assets_uri . '/css/jquery.fancybox.css' );

        wp_enqueue_script( 'script.slick', $assets_uri . '/js/slick.min.js', ['jquery'], false, true );

        if(is_singular('events') || is_page_template('page-templates/template-event-agenda.php') || is_page_template('page-templates/template-event-agenda-details.php')){
            wp_enqueue_script( 'script.atc', $assets_uri . '/js/atc.min.js', ['jquery'], false, true );
            wp_enqueue_script( 'script.eb_widgets', 'https://www.eventbrite.com/static/widgets/eb_widgets.js', array(), false, true );
            if (is_page_template('page-templates/template-event-agenda-details.php')) {
                wp_enqueue_script( 'script.slim_scroll', $assets_uri . '/js/slim-scroll.js', array(), false, true );
            }
        }

        wp_enqueue_script( 'script.fancybox', $assets_uri . '/js/jquery.fancybox.pack.js', ['jquery'], false, true );
        wp_enqueue_script( 'script.custom', $assets_uri . '/js/custom.js', ['jquery'], false, true );

        wp_localize_script( 'script.custom', 'HOME_DIRECTORY', ['PATH' => $theme_uri] );
        wp_localize_script( 'script.custom', 'myAjaxObject', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'assets_uri' => $assets_uri) );
    } );

    add_action( 'login_enqueue_scripts', function () {
        global $assets_uri;
        wp_enqueue_script( 'script.jquery', $assets_uri . '/js/jquery-3.3.1.min.js', false, false, false );
    } );

    add_action( 'edit_user_profile', function ( $user ) {
        ?>
            <style>
                .user-rich-editing-wrap,
                .user-admin-color-wrap,
                .user-comment-shortcuts-wrap,
                .show-admin-bar.user-admin-bar-front-wrap,
                .user-first-name-wrap,
                .user-last-name-wrap,
                .user-nickname-wrap,
                .user-display-name-wrap,
                .user-url-wrap,
                .user-description-wrap,
                .user-profile-picture {
                    display: none;
                }
                .regular-text+.description{
                    display: block;
                }
                label{
                    font-weight: 600 !important;
                }
                .login .privacy-policy-page-link{
                    margin: 2em 0;
                }
            </style>
        <?php
    } );
    add_action( 'user_new_form', 'dontchecknotify_register_form' );
    function dontchecknotify_register_form() {
        ?>
        <script>
            jQuery(document).ready(function($) {
                jQuery("#send_user_notification").removeAttr("checked");
            } );
        </script>
        <?php
    }

    add_action('admin_enqueue_scripts', function() {
        wp_enqueue_media();
    });

    add_action('admin_head', function(){?>
        <style>
            #TB_overlay{ z-index: 9999 !important; }
            .select2-container .select2-selection--single{ min-height: 28px; height: auto; }
            .btn_copy{
                background: #0085ba;
                border-color: #0073aa #006799 #006799;
                box-shadow: 0 1px 0 #006799;
                color: #fff;
                text-decoration: none;
                text-shadow: 0 -1px 1px #006799, 1px 0 1px #006799, 0 1px 1px #006799, -1px 0 1px #006799;
                height: 30px;
                line-height: 28px;
                padding: 2px 10px;
                text-align: center;
                z-index: 1;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                font-family: "Arial";
                font-size: 14px;
                position: absolute;
                right: 15px;
                top: 30px;
            }
            .acf-fields.-left .btn_copy{
                position: relative;
                float: right;
                margin: 0 13px 15px 0;
                top: 0;
                right: 0;
            }
            #newsletter--preview-for-members iframe,
            #newsletter--preview-for-non-members iframe,
            #newsletter--preview-for-non-alum iframe {
                min-height: 1024px;
            }
            .acf-fields.-left #newsletter--preview-for-members:before,
            .acf-fields.-left #newsletter--preview-for-members>.acf-input {
                width: 100%;
            }
            .use-full-width-flex .select2-container.-acf .select2-selection--multiple .select2-selection__choice{
                width: 90%;
                display: flex;
                align-items: center;
                justify-content: flex-start;
            }
        </style>
        <script>
            function __copy_html(section_id){
                var obj = jQuery('#'+section_id),
                    obj_val = obj.find('textarea[id^="acf-editor-"].wp-editor-area').val();
                jQuery('<input>').val(obj_val).appendTo('body').select();
                document.execCommand("copy");
                alert('Html Copied');
                return false;
            }
            jQuery(window).load(function(){
                jQuery('#event_for_reminder select').on('change', function(){
                    var $post_id = jQuery(this).val();
                    var formData = new FormData(),
                        xhttp = new XMLHttpRequest();
                        formData.append('action', 'getIntroForEventReminder');
                        formData.append('post_id', (typeof $post_id !== 'undefined' && $post_id != '') ? $post_id : '');
                        xhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                var activeEditor = tinyMCE.get('acf-editor-101');
                                if(activeEditor!==null){
                                    activeEditor.setContent(this.responseText);
                                } else {
                                    jQuery('#acf-editor-101').val(this.responseText);
                                }
                            }
                        };
                        xhttp.open('POST', '<?php echo admin_url( 'admin-ajax.php' ); ?>', true);
                        xhttp.send(formData);
                });
            });
        </script>
    <?php });

    add_action('admin_footer', function(){?>
        <script>
            var preview_for_members = jQuery('#newsletter--preview-for-members'),
                preview_for_non_members = jQuery('#newsletter--preview-for-non-members'),
                preview_for_non_alum = jQuery('#newsletter--preview-for-non-alum');
            if(preview_for_members.length){
                if(preview_for_members.find('textarea[id^="acf-editor-"].wp-editor-area').val() != ''){
                    preview_for_members.prepend('<input type="button" class="newsletter--copy_html btn_copy" onclick="__copy_html(\''+preview_for_members.attr('id')+'\');" value="Copy HTML" />');
                }
            }
            if(preview_for_non_members.length){
                if(preview_for_non_members.find('textarea[id^="acf-editor-"].wp-editor-area').val() != ''){
                    preview_for_non_members.prepend('<input type="button" class="newsletter--copy_html btn_copy" onclick="__copy_html(\''+preview_for_non_members.attr('id')+'\');" value="Copy HTML" />');
                }
            }
            if(preview_for_non_alum.length){
                if(preview_for_non_alum.find('textarea[id^="acf-editor-"].wp-editor-area').val() != ''){
                    preview_for_non_alum.prepend('<input type="button" class="newsletter--copy_html btn_copy" onclick="__copy_html(\''+preview_for_non_alum.attr('id')+'\');" value="Copy HTML" />');
                }
            }
        </script>
    <?php });
