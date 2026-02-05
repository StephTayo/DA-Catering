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

function da_catering_yyc_child_redirect_shop() {
    if (is_admin() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
        return;
    }

    if (class_exists('WooCommerce')) {
        return;
    }

    $request_path = trim((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');

    if (is_page('shop') || $request_path === 'shop') {
        wp_safe_redirect(home_url('/booking/#checkout'), 301);
        exit;
    }
}
add_action('template_redirect', 'da_catering_yyc_child_redirect_shop');

function da_catering_yyc_child_force_booking_template($template) {
    if (is_admin() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
        return $template;
    }

    $request_path = trim((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    if ($request_path !== 'booking') {
        return $template;
    }

    $booking_template = locate_template('page-booking.php');
    if ($booking_template) {
        status_header(200);
        return $booking_template;
    }

    $parent_booking = get_template_directory() . '/page-booking.php';
    if (file_exists($parent_booking)) {
        status_header(200);
        return $parent_booking;
    }

    return $template;
}
add_filter('template_include', 'da_catering_yyc_child_force_booking_template');
