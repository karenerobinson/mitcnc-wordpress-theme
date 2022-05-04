<?php
$defaults = array(
    'class' => 'row speaker-container',
);

$args = wp_parse_args($args, $defaults);

$class = $args['class'];
$speaker_ids = $args['speaker_ids'];

if (is_array($speaker_ids) && !empty($speaker_ids)) {
    ?>
    <div class="<?php echo esc_attr($class); ?>">
        <?php
        foreach ($speaker_ids as $speaker_id) {
            get_template_part('template-parts/content', 'speaker-card', array('speaker_id' => $speaker_id));
        }
        ?>
    </div>
    <?php
}
