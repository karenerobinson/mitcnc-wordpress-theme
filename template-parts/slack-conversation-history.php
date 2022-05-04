<?php global $assets_uri, $agenda_date_id; ?>
<style>
    .slack-conversation-history{
        border-top: 2px solid #e12d5a;
    }
    .slack-conversation-history .messages-container{
        background-color: #fff;
        box-shadow: 0 10px 25px 0 rgba(2, 2, 2, 0.07);
        padding: 28px 15px;
        position: relative;
        height: 426px;
    }
    .slack-conversation-history .messages-container .loader{
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        opacity: 0.5;
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .slack-conversation-history .messages-container .message{
        padding: 15px 0;
        display: flex;
        padding: 0;
        list-style: none;
        border-bottom: 2px dotted #e4e4e4;
        word-break: break-word;
    }
    .slack-conversation-history .messages-container .message li{
        padding: 20px 0px 20px 15px;
    }
    .slack-conversation-history .messages-container .message li .name-header strong{
        font-size: 15px;
    }
    .slack-conversation-history .messages-container .message li:first-child{
        padding-left: 0;
    }
    .slack-conversation-history .messages-container .message li .user_img{
        width: 48px;
        background: #a31f34;
        border-radius: 50%;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #fff;
    }
    .slack-conversation-history .messages-container .message li .user_img img{
        border-radius: 50%;
    }
</style>
<input type="hidden" name="slack_channel_id" value="<?php echo esc_attr(get_term_meta($agenda_date_id, 'slack_channel_id', true)); ?>">
<div class="slim-scroll messages-container">
    <div class="loader">
        <img src="<?php echo esc_url($assets_uri); ?>/images/200.gif" alt="">
    </div>
</div>
