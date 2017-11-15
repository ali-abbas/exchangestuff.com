<?php
/*
    =========================
    CREATED BY : SYED ALI
    THEME SETUP
    =========================
*/

add_theme_support('menus');

/*
    =========================
    INCLUDES AND REQUIRE
    =========================
*/

include(get_template_directory() . '/includes/front/enqueue.php');
include(get_template_directory() . '/includes/setup.php');
include(get_template_directory() . '/includes/widgets.php');
include(get_template_directory() . '/includes/custom_post.php');
require get_template_directory() . '/includes/walker.php';

/*
    =========================
    FILTERS AND ACTION HOOKS
    =========================
*/


add_action( 'wp_enqueue_scripts', 'es_enqueue' );
add_action( 'after_setup_theme', 'es_setup_theme' );
add_action( 'widgets_init', 'es_widgets' );
add_action('init', 'wporg_custom_post_type');

/*
    =========================
    SHORTCODES
    =========================
*/