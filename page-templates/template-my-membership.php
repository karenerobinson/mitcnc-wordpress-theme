<?php
/* Template Name: My Membership */

$user_id = get_current_user_id();
if ($user_id > 0) {
    $subscription = get_active_subscription($user_id);
    if ($subscription) {
        $cancel_at_period_end = $subscription->cancel_at_period_end;
        $current_period_end = date_i18n('F j, Y', substr($subscription->current_period_end, 0, 10));
        ob_start();
        ?>
        <p>Your membership will <?php echo esc_html($cancel_at_period_end ? 'end' : 'renew'); ?>
            on <strong><?php echo esc_html($current_period_end); ?></strong>. Click the button below to update your
            saved payment method,
            <?php echo esc_html($cancel_at_period_end ? 'renew' : 'cancel'); ?> your membership, or view receipts.</p>
        <?php
        echo do_shortcode('[stripe_customer_portal label="Manage membership" class="default-btn red-btn"]');
        $post->post_content = str_replace("\n", '', ob_get_clean());
    } else {
        $donation_content = '';
        $enable_donations = apply_filters('mitcnc_site_enable_donation_at_checkout', false);

        if ($enable_donations) {
            $donation_currency = 'usd';
            $donation_amounts = array(500, 1000, 2500, 5000, 10000, 0);
            ob_start();
            ?>
            <h3>Donation</h3>
            <form class="stripe-checkout-form donation-amount">
                <table class="stripe-checkout-price-table table table-striped">
                    <?php
                    $fmt = new NumberFormatter('en', NumberFormatter::CURRENCY);

                    foreach ($donation_amounts as $amount_in_cents) {
                        $amount = $fmt->formatCurrency($amount_in_cents / 100, $donation_currency);
                        ?>
                        <tr class="price-row">
                            <td class="price-col-amount">
                                <input type="radio" name="donation_amount"
                                       id="<?php echo esc_attr($amount_in_cents); ?>"
                                       value="<?php echo esc_attr($amount_in_cents); ?>" <?php checked(1, $amount_in_cents == 0, true); ?>/>
                                <label for="<?php echo esc_attr($amount_in_cents); ?>"><?php echo $amount_in_cents > 0 ? esc_html($amount) : 'None'; ?></label>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </form>
            <br>
            <?php
            $donation_content = str_replace("\n", '', ob_get_clean());
        }

        $renew_date = date_i18n('F j, Y', strtotime('+1 year'));
        ob_start();
        ?>
        <p>
            Select a membership level below. Your membership will start immediately and automatically renew in one
            year on <strong><?php echo esc_html($renew_date); ?></strong>. In addition to your membership, please
            consider making a one-time donation to our scholarship fund. You may also make a donation later via the
            <a href="/donate" target="_blank">donate page</a>.
        </p>

        <?php
        // phpcs:ignore
        echo $donation_content;
        ?>

        <h3>Membership Level</h3>
        <?php
        echo do_shortcode('[stripe_subscription_checkout checkout_btn_label="Join the Club" checkout_btn_class="default-btn red-btn" price_table_class="table table-striped"]');
        $post->post_content = str_replace("\n", '', ob_get_clean());
    }
} else {
    ob_start();
    ?>
    <h2>You must be logged in to view your membership details</h2>
    <a href="/login/" class="default-btn red-btn">
        Login
    </a>
    <?php
    $post->post_content = str_replace("\n", '', ob_get_clean());
}

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page', array('thumbnail_in_bottom' => true));
        endwhile;
        ?>
    </main>
</div>

<?php get_footer(); ?>
