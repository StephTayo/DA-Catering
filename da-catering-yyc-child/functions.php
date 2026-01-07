<?php
if (!defined('ABSPATH')) {
    exit;
}

function da_catering_yyc_child_enqueue_styles() {
    $parent_style = 'da-catering-yyc-style';
    wp_enqueue_style(
        $parent_style,
        get_template_directory_uri() . '/assets/css/style.css'
    );
    wp_enqueue_style(
        'da-catering-yyc-child-style',
        get_stylesheet_uri(),
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'da_catering_yyc_child_enqueue_styles');
