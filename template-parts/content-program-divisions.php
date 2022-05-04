<?php
function parse_menu_object($menu_obj = null)
{
    $output = array();
    if ($menu_obj != null) {
        foreach ($menu_obj as $menu_item) {
            $menu_item->image = get_field('menu_item_image', $menu_item->ID);
            if ($menu_item->menu_item_parent == 0) {
                $output[$menu_item->ID] = $menu_item;
                $output[$menu_item->ID]->children = array();
            } else {
                if (isset($output[$menu_item->menu_item_parent])) {
                    $output[$menu_item->menu_item_parent]->children[] = $menu_item;
                }
            }
        }
    }
    return $output;
}
$parsed_program_menu = parse_menu_object(wp_get_nav_menu_items('programs'));
if ($parsed_program_menu != null) {
    ?>
    <article class="division-container pb0">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <h2><a href="<?php echo esc_url(get_permalink(1314)); ?>">Some of Our Program Divisions</a></h2>
                </div>
            </div>
            <div class="row mt40">
                <?php
                foreach ($parsed_program_menu as $menu_item) {
                    $menu_image = (isset($menu_item->image) && !empty($menu_item->image)) ? $menu_item->image : get_asset_uri('/images/program-divisions-icon-01.svg');
                    ?>
                    <div class="col-custom">
                        <a href="<?php echo esc_url($menu_item->url); ?>" class="division-box" style="min-height: 140px;">
                            <div class="icon"><img src="<?php echo esc_url($menu_image); ?>" alt="<?php echo esc_attr($menu_item->post_title); ?>"></div>
                            <h4><?php echo esc_html($menu_item->post_title); ?></h4>
                            <?php
                            if (isset($menu_item->children) && $menu_item->children != null) {
                                ?>
                                <ul>
                                    <?php
                                    foreach ($menu_item->children as $menu_child) {
                                        ?>
                                        <li><?php echo esc_html($menu_child->post_title); ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                            }
                            ?>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </article>
    <?php
}
