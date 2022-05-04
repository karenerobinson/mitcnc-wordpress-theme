<?php
    class mitcnc_walker extends Walker_Nav_Menu{
        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<div class='drop-down'><ul class='sub-menu'>\n";
        }
        function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul></div>\n";
        }
    }

    function prefix_nav_description( $item_output, $item, $depth, $args ) {
        if ( !empty( $item->description) && 0) {
            $item_output = str_replace( '<a ', '<div class="menu-item-description" style="color: #161616">' . $item->description . '</div>' . '<a ', $item_output );
        }
        return $item_output;
    }
    add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description', 10, 4 );
    remove_filter( 'nav_menu_description', 'strip_tags' );
    add_filter( 'wp_setup_nav_menu_item', 'cus_wp_setup_nav_menu_item' );
    function cus_wp_setup_nav_menu_item( $menu_item ) {
        $menu_item->description = apply_filters( 'nav_menu_description', '' );
        return $menu_item;
    }