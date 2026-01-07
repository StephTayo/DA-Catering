<?php
if (!defined('ABSPATH')) {
    exit;
}

function da_catering_yyc_enqueue_assets() {
    $theme_version = wp_get_theme()->get('Version');
    wp_enqueue_style(
        'da-catering-yyc-fonts',
        'https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Outfit:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );
    wp_enqueue_style(
        'da-catering-yyc-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        $theme_version
    );
    wp_enqueue_script(
        'da-catering-yyc-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        $theme_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'da_catering_yyc_enqueue_assets');

function da_catering_yyc_register_menus() {
    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'da-catering-yyc')
        )
    );
}
add_action('after_setup_theme', 'da_catering_yyc_register_menus');

function da_catering_yyc_theme_support() {
    add_theme_support('custom-logo', array(
        'height'      => 120,
        'width'       => 120,
        'flex-height' => true,
        'flex-width'  => true
    ));
}
add_action('after_setup_theme', 'da_catering_yyc_theme_support');
