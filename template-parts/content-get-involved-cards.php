<?php
$cards = array(
    array(
        'title' => 'Volunteer',
        'url' => get_permalink(4395),
        'image_path' => 'images/volunteer.svg',
    ),
    array(
        'title' => 'Speak',
        'url' => get_permalink(4399),
        'image_path' => 'images/speak.svg',
    ),
    array(
        'title' => 'Host',
        'url' => get_permalink(4397),
        'image_path' => 'images/host.svg',
    ),
    array(
        'title' => 'Sponsor',
        'url' => get_permalink(4401),
        'image_path' => 'images/sponsor.svg',
    ),
);
?>
<div class="row get-involved-cards">
    <?php
    foreach ($cards as $card) {
        ?>
        <div class="col-12 col-sm-6">
            <a href="<?php echo esc_url($card['url']); ?>" class="division-box">
                <div class="icon">
                    <img src="<?php echo esc_url(get_asset_uri($card['image_path'])); ?>"
                        alt="<?php echo esc_attr($card['title']); ?>">
                </div>
                <h4><?php echo esc_html($card['title']); ?></h4>
            </a>
        </div>
        <?php
    }
    ?>
</div>
