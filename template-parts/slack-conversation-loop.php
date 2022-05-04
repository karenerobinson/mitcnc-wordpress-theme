<?php
    global $user_info, $message;
?>
<ul class="message">
    <li>
        <?php
        if (null != $user_info) {
            ?>
                <span class="user_img">
                <?php if (isset($user_info->image_48)) { ?>
                        <img src="<?php echo esc_url(isset($user_info->image_48) ? $user_info->image_48 : ''); ?>">
                        <?php
                } else {
                    echo isset($user_info->real_name) ? esc_html(substr($user_info->real_name, 0, 1)) : '';
                }
                ?>
                </span>
                <?php
        }
        ?>
    </li>
    <li>
        <div class="name-header">
            <strong><?php echo isset($user_info->real_name) ? esc_html($user_info->real_name) : ''; ?></strong>
            <small><?php echo isset($message->ts) ? esc_html(date('h:i A', explode('.', $message->ts)[0])) : ''; ?></small>
        </div>
        <p style="font-size: 14px !important; margin: 0;">
            <?php echo filter_var(slack_parse_text_key($message->text), FILTER_UNSAFE_RAW); ?>
        </p>
        <?php if (isset($message->files) && null != $message->files && 0) { ?>
            <div class="attachment-container">
                <?php
                foreach ($message->files as $k => $image) {
                    ?>
                        <div class="attachment">
                            <img src="<?php echo esc_url(isset($image->thumb_360) ? $image->thumb_360 : $image->thumb_80); ?>" alt="<?php echo isset($image->name) ? esc_attr($image->name) : ''; ?>" title="">
                        </div>
                    <?php
                }
                ?>
            </div>
        <?php } ?>
    </li>
</ul>
