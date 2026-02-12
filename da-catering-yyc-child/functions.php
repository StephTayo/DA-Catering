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
    if (is_page_template('page-booking.php')) {
        wp_enqueue_style(
            'da-catering-yyc-child-booking-fonts',
            'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@700;800;900&display=swap',
            array(),
            null
        );
    }
    wp_enqueue_style(
        'da-catering-yyc-child-style',
        get_stylesheet_uri(),
        array($parent_style),
        file_exists(get_stylesheet_directory() . '/style.css') ? filemtime(get_stylesheet_directory() . '/style.css') : wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'da_catering_yyc_child_enqueue_styles');

function da_catering_yyc_child_enqueue_scripts() {
    wp_dequeue_script('da-catering-yyc-main');
    wp_enqueue_script(
        'da-catering-yyc-child-main',
        get_stylesheet_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
    wp_localize_script(
        'da-catering-yyc-child-main',
        'daNewsletter',
        array(
            'ajaxUrl' => admin_url('admin-ajax.php', 'https'),
            'nonce' => wp_create_nonce('da_newsletter_subscribe'),
        )
    );
    wp_localize_script(
        'da-catering-yyc-child-main',
        'daOrder',
        array(
            'ajaxUrl' => admin_url('admin-ajax.php', 'https'),
            'nonce' => wp_create_nonce('da_order_submit'),
        )
    );
    wp_localize_script(
        'da-catering-yyc-child-main',
        'daBooking',
        array(
            'ajaxUrl' => admin_url('admin-ajax.php', 'https'),
            'nonce' => wp_create_nonce('da_booking_submit'),
        )
    );
    wp_localize_script(
        'da-catering-yyc-child-main',
        'daContact',
        array(
            'ajaxUrl' => admin_url('admin-ajax.php', 'https'),
            'nonce' => wp_create_nonce('da_contact_submit'),
        )
    );
    wp_localize_script(
        'da-catering-yyc-child-main',
        'daCart',
        array(
            'ajaxUrl' => admin_url('admin-ajax.php', 'https'),
            'nonce' => wp_create_nonce('da_cart_action'),
        )
    );
    wp_localize_script(
        'da-catering-yyc-child-main',
        'daSite',
        array(
            'homeUrl' => home_url('/'),
        )
    );
}
add_action('wp_enqueue_scripts', 'da_catering_yyc_child_enqueue_scripts', 20);
add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
});

// Performance: add preconnects and defer main script.
add_filter('wp_resource_hints', function ($hints, $relation_type) {
    if ($relation_type === 'preconnect') {
        $hints[] = 'https://fonts.googleapis.com';
        $hints[] = 'https://fonts.gstatic.com';
        $hints[] = 'https://images.unsplash.com';
        $hints[] = 'https://upload.wikimedia.org';
    }
    return $hints;
}, 10, 2);

add_filter('script_loader_tag', function ($tag, $handle) {
    if ($handle === 'da-catering-yyc-child-main') {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}, 10, 2);

add_filter('wp_lazy_loading_enabled', '__return_true');

function da_catering_yyc_child_allow_logo_uploads($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'da_catering_yyc_child_allow_logo_uploads');

function da_catering_yyc_child_fix_svg_display($data, $file, $filename, $mimes) {
    if (strpos((string) $filename, '.svg') !== false) {
        $data['ext'] = 'svg';
        $data['type'] = 'image/svg+xml';
    }
    return $data;
}
add_filter('wp_check_filetype_and_ext', 'da_catering_yyc_child_fix_svg_display', 10, 4);

// Avoid media upload errors from generating oversized image variants.
add_filter('intermediate_image_sizes_advanced', function ($sizes) {
    if (is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) {
        return $sizes;
    }
    foreach ($sizes as $name => $data) {
        $width = isset($data['width']) ? (int) $data['width'] : 0;
        $height = isset($data['height']) ? (int) $data['height'] : 0;
        if ($width > 2000 || $height > 2000) {
            unset($sizes[$name]);
        }
    }
    return $sizes;
}, 10, 1);

// Prevent large image downscaling which can fail on some hosts.
add_filter('big_image_size_threshold', function ($threshold) {
    if (is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) {
        return $threshold;
    }
    return false;
});

// Disable all intermediate sizes to avoid server-side resize failures.
add_filter('intermediate_image_sizes_advanced', function ($sizes) {
    if (is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) {
        return $sizes;
    }
    return array();
}, 99, 1);

// Prevent PHP warnings/notices from breaking async media upload responses.
add_action('admin_init', function () {
    // In admin, remove any front-end image size filters that can break uploads.
    remove_all_filters('intermediate_image_sizes_advanced');
    remove_all_filters('big_image_size_threshold');
    if (defined('DOING_AJAX') && DOING_AJAX) {
        @ini_set('display_errors', '0');
    }
});

function da_catering_yyc_child_admin_media_fix($hook) {
    if ($hook !== 'upload.php') {
        return;
    }
    wp_enqueue_script(
        'da-catering-yyc-child-admin-media-fix',
        get_stylesheet_directory_uri() . '/assets/js/admin-media-fix.js',
        array('jquery'),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('admin_enqueue_scripts', 'da_catering_yyc_child_admin_media_fix');

// Ensure Customizer media scripts are loaded (prevents blank media frame).
function da_catering_yyc_child_customizer_media_support() {
    wp_enqueue_media();
    wp_enqueue_style('media-views');
    wp_enqueue_script('media-views');
    wp_enqueue_script('media-models');
    wp_enqueue_script('media-editor');
    wp_enqueue_script('wp-api-request');
    wp_enqueue_script(
        'da-catering-yyc-child-customizer-media-fix',
        get_stylesheet_directory_uri() . '/assets/js/customizer-media-fix.js',
        array('jquery'),
        wp_get_theme()->get('Version'),
        true
    );
    wp_localize_script(
        'da-catering-yyc-child-customizer-media-fix',
        'daMediaFix',
        array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'mediaNonce' => wp_create_nonce('media-form'),
            'restNonce' => wp_create_nonce('wp_rest'),
            'restUrl' => esc_url_raw(rest_url()),
        )
    );
}
add_action('customize_controls_enqueue_scripts', 'da_catering_yyc_child_customizer_media_support', 20);

// Ensure media templates exist in Customizer controls footer.
function da_catering_yyc_child_print_customizer_media_templates() {
    if (function_exists('wp_print_media_templates')) {
        wp_print_media_templates();
    }
}
add_action('customize_controls_print_footer_scripts', 'da_catering_yyc_child_print_customizer_media_templates', 5);

// Force custom logo output to use the theme asset (bypass broken media picker).
function da_catering_yyc_child_force_custom_logo($html) {
    $logo_url = get_stylesheet_directory_uri() . '/assets/img/DA Catering Logo.png';
    $home_url = home_url('/');
    $alt = 'DA Catering YYC logo';
    return '<a href="' . esc_url($home_url) . '" class="custom-logo-link" rel="home" aria-current="page">' .
        '<img src="' . esc_url($logo_url) . '" class="custom-logo" alt="' . esc_attr($alt) . '" decoding="async" />' .
        '</a>';
}
add_filter('get_custom_logo', 'da_catering_yyc_child_force_custom_logo', 20);

// Force site icon URLs to the theme assets so favicons update immediately.
function da_catering_yyc_child_force_site_icon($url, $size, $blog_id) {
    $base = get_stylesheet_directory_uri() . '/assets/img';
    if ((int) $size === 32) {
        return $base . '/favicon-32x32.png';
    }
    if ((int) $size === 180) {
        return $base . '/apple-touch-icon.png';
    }
    if ((int) $size === 512) {
        return $base . '/icon-512x512.png';
    }
    return $base . '/favicon-32x32.png';
}
add_filter('get_site_icon_url', 'da_catering_yyc_child_force_site_icon', 20, 3);

// Force media modal to use admin-ajax settings (helps when REST is blocked in Customizer).
add_filter('media_view_settings', function ($settings) {
    if (is_admin() || is_customize_preview()) {
        $settings['ajaxurl'] = admin_url('admin-ajax.php');
        $settings['nonce'] = wp_create_nonce('media-form');
        $settings['post'] = array('id' => 0);
    }
    return $settings;
});

function da_catering_yyc_child_redirect_shop() {
    if (is_admin() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
        return;
    }

    if (class_exists('WooCommerce')) {
        return;
    }

    $request_path = trim((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');

    if (is_page('shop') || $request_path === 'shop') {
        wp_safe_redirect(home_url('/booking/?quick_order=1'), 301);
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

function da_catering_yyc_child_register_newsletter_table() {
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }

    $version_key = 'da_newsletter_table_version';
    $current_version = (int) get_option($version_key, 0);
    $target_version = 2;
    if ($current_version >= $target_version) {
        return;
    }

    global $wpdb;
    $table = $wpdb->prefix . 'da_newsletter';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE {$table} (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        email VARCHAR(190) NOT NULL,
        created_at DATETIME NOT NULL,
        subscribed_at DATETIME NULL,
        confirmed_at DATETIME NULL,
        unsubscribed_at DATETIME NULL,
        status VARCHAR(20) NOT NULL DEFAULT 'pending',
        token VARCHAR(64) NOT NULL,
        ip_address VARCHAR(45) NULL,
        user_agent TEXT NULL,
        source VARCHAR(40) NULL,
        PRIMARY KEY  (id),
        UNIQUE KEY email (email)
    ) {$charset_collate};";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);

    if ($current_version < $target_version) {
        $wpdb->query("UPDATE {$table} SET subscribed_at = created_at WHERE subscribed_at IS NULL");
        $wpdb->query("UPDATE {$table} SET source = 'legacy' WHERE source IS NULL OR source = ''");
    }

    update_option($version_key, $target_version);
    update_option('da_newsletter_table_created', 1);
}
add_action('init', 'da_catering_yyc_child_register_newsletter_table');

function da_catering_yyc_child_register_broadcasts_table() {
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }

    $version_key = 'da_broadcast_table_version';
    $current_version = (int) get_option($version_key, 0);
    $target_version = 2;

    global $wpdb;
    $table = $wpdb->prefix . 'da_broadcasts';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE {$table} (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        subject VARCHAR(190) NOT NULL,
        title VARCHAR(190) NOT NULL,
        body LONGTEXT NOT NULL,
        poster_url TEXT NULL,
        status VARCHAR(20) NOT NULL DEFAULT 'draft',
        scheduled_at DATETIME NULL,
        created_at DATETIME NOT NULL,
        sent_at DATETIME NULL,
        total_recipients INT NOT NULL DEFAULT 0,
        sent_count INT NOT NULL DEFAULT 0,
        send_mode VARCHAR(20) NOT NULL DEFAULT 'once',
        batch_size INT NOT NULL DEFAULT 100,
        last_offset INT NOT NULL DEFAULT 0,
        PRIMARY KEY  (id)
    ) {$charset_collate};";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);

    $log_table = $wpdb->prefix . 'da_broadcast_logs';
    $log_sql = "CREATE TABLE {$log_table} (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        broadcast_id BIGINT UNSIGNED NOT NULL,
        email VARCHAR(190) NOT NULL,
        status VARCHAR(20) NOT NULL,
        error TEXT NULL,
        sent_at DATETIME NULL,
        PRIMARY KEY  (id),
        KEY broadcast_email (broadcast_id, email)
    ) {$charset_collate};";
    dbDelta($log_sql);

    update_option($version_key, $target_version);
}
add_action('init', 'da_catering_yyc_child_register_broadcasts_table');

function da_catering_yyc_child_get_or_create_subscriber($email, $source = 'order') {
    if (!$email || !is_email($email)) {
        return;
    }
    global $wpdb;
    $table = $wpdb->prefix . 'da_newsletter';
    $existing = $wpdb->get_row($wpdb->prepare("SELECT id, status, token, unsubscribed_at FROM {$table} WHERE email = %s", $email));
    if ($existing) {
        if (!empty($existing->unsubscribed_at) || $existing->status === 'unsubscribed') {
            return;
        }
        if ($existing->status === 'confirmed') {
            return;
        }
        $now = current_time('mysql');
        $token = da_catering_yyc_child_generate_newsletter_token();
        $wpdb->update(
            $table,
            array(
                'status' => 'confirmed',
                'token' => $token,
                'unsubscribed_at' => null,
                'confirmed_at' => $now,
                'subscribed_at' => $now,
                'source' => $source,
            ),
            array('id' => $existing->id),
            array('%s', '%s', '%s', '%s', '%s', '%s'),
            array('%d')
        );
        return;
    }

    $now = current_time('mysql');
    $token = da_catering_yyc_child_generate_newsletter_token();
    $wpdb->insert(
        $table,
        array(
            'email' => $email,
            'created_at' => $now,
            'subscribed_at' => $now,
            'confirmed_at' => $now,
            'status' => 'confirmed',
            'token' => $token,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'source' => $source,
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );
}

function da_catering_yyc_child_generate_newsletter_token() {
    return bin2hex(random_bytes(16));
}

function da_catering_yyc_child_get_logo_url() {
    $logo_id = get_theme_mod('custom_logo');
    if ($logo_id) {
        $logo_url = wp_get_attachment_image_url($logo_id, 'full');
        if ($logo_url) {
            return $logo_url;
        }
    }
    return get_stylesheet_directory_uri() . '/assets/img/DA Catering Logo.png';
}

function da_catering_yyc_child_get_brand_palette() {
    return array(
        'primary' => '#1f3d34',
        'primary_strong' => '#173028',
        'accent' => '#B8F527',
        'accent_strong' => '#8BC727',
        'dark' => '#1a1a1a',
        'gray' => '#2d2d2d',
        'white' => '#ffffff',
    );
}

function da_catering_yyc_child_build_email_shell($title, $body_html, $options = array()) {
    $opts = wp_parse_args(
        $options,
        array(
            'unsub_url' => '',
            'include_cta' => true,
            'brand' => 'DA Catering YYC',
        )
    );
    $colors = da_catering_yyc_child_get_brand_palette();
    $logo_url = da_catering_yyc_child_get_logo_url();
    $phone = '+1 587 966 5757';
    $phone_link = 'tel:+15879665757';
    $whatsapp_link = 'https://wa.me/15879665757';
    $email_link = 'mailto:orders@dacatering.ca';

    $header_bg = 'background:linear-gradient(135deg,' . $colors['dark'] . ',' . $colors['gray'] . ');';
    $cta_bg = 'background:linear-gradient(' . $colors['gray'] . ',' . $colors['dark'] . ');';
    $button_bg = 'background:linear-gradient(' . $colors['accent'] . ',' . $colors['accent_strong'] . ');';

    $cta_block = '';
    if ($opts['include_cta']) {
        $cta_block = '
          <tr>
            <td align="center" style="padding:20px;' . $cta_bg . '">
              <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                  <td align="center" style="padding-bottom:12px;">
                    <a href="' . esc_url($phone_link) . '" class="cta-button" style="display:inline-block;padding:14px 26px;border-radius:999px;' . $button_bg . 'color:#1a1a1a;font-weight:bold;text-decoration:none;font-family:Arial,Helvetica,sans-serif;letter-spacing:0.5px;">ORDER NOW</a>
                  </td>
                </tr>
                <tr>
                  <td align="center" style="font-family:Arial,Helvetica,sans-serif;color:#ffffff;font-size:14px;">
                    <span class="cta-stack" style="display:inline-block;margin:0 10px;">
                      Phone: <a href="' . esc_url($phone_link) . '" style="color:' . $colors['accent'] . ';text-decoration:none;">' . esc_html($phone) . '</a>
                    </span>
                    <span class="cta-stack" style="display:inline-block;margin:0 10px;">
                      Email: <a href="' . esc_url($email_link) . '" style="color:' . $colors['accent'] . ';text-decoration:none;">orders@dacatering.ca</a>
                    </span>
                    <span class="cta-stack" style="display:inline-block;margin:0 10px;">
                      WhatsApp: <a href="' . esc_url($whatsapp_link) . '" style="color:' . $colors['accent'] . ';text-decoration:none;">Chat now</a>
                    </span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>';
    }

    $unsub_row = '';
    if (!empty($opts['unsub_url'])) {
        $unsub_row = '
                <tr>
                  <td align="center" style="font-family:Arial,Helvetica,sans-serif;color:#999999;font-size:12px;padding-top:6px;">
                    <a href="' . esc_url($opts['unsub_url']) . '" style="color:#999999;text-decoration:none;">Unsubscribe</a>
                  </td>
                </tr>';
    }

    return '
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style type="text/css">
    @media only screen and (max-width: 620px) {
      .container { width: 100% !important; }
      .full-width { width: 100% !important; height: auto !important; }
      .padding { padding: 12px !important; }
      .cta-button { display: block !important; width: 100% !important; }
      .cta-stack { display: block !important; padding: 8px 0 !important; }
    }
  </style>
</head>
<body style="margin:0;padding:0;background-color:#ffffff;">
  <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#ffffff;">
    <tr>
      <td align="center" style="padding:0;margin:0;">
        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="600" class="container" style="width:600px;max-width:600px;margin:0 auto;background:#ffffff;">
          <tr>
            <td align="center" style="padding:18px 20px;' . $header_bg . '">
              ' . ($logo_url ? '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr($opts['brand']) . ' Logo" style="display:block;border:0;outline:none;text-decoration:none;height:90px;max-width:180px;width:auto;margin:0 auto;">' : '') . '
            </td>
          </tr>
          <tr>
            <td align="center" class="padding" style="padding:16px 20px;background:#ffffff;">
              <h2 style="margin:0 0 10px;font-family:Arial,Helvetica,sans-serif;font-size:22px;color:' . $colors['primary'] . ';">' . esc_html($title) . '</h2>
              <div style="font-family:Arial,Helvetica,sans-serif;color:#4a5650;line-height:1.6;">' . $body_html . '</div>
            </td>
          </tr>
          ' . $cta_block . '
          <tr>
            <td align="center" style="padding:18px;background:' . $colors['dark'] . ';">
              <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                  <td align="center" style="font-family:Arial,Helvetica,sans-serif;color:#999999;font-size:12px;">
                    <a href="' . esc_url(home_url('/')) . '" style="color:#999999;text-decoration:none;">Website</a>
                    &nbsp;|&nbsp;
                    <a href="https://www.instagram.com" style="color:#999999;text-decoration:none;">Instagram</a>
                    &nbsp;|&nbsp;
                    <a href="https://www.facebook.com" style="color:#999999;text-decoration:none;">Facebook</a>
                  </td>
                </tr>
                ' . $unsub_row . '
                <tr>
                  <td align="center" style="font-family:Arial,Helvetica,sans-serif;color:#999999;font-size:12px;padding-top:6px;">
                    &copy; ' . date('Y') . ' ' . esc_html($opts['brand']) . '. All rights reserved.
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>';
}

function da_catering_yyc_child_send_confirmation_email($email, $token) {
    $confirm_url = home_url('/?da_newsletter_confirm=' . urlencode($token));
    $unsub_url = home_url('/?da_newsletter_unsub=' . urlencode($token));
    $subject = 'Confirm your newsletter subscription';
    $body = '
      <p style="margin:0 0 16px;">We’re excited to have you. Click the button below to confirm your email and stay updated on our delicious deals and exclusive promos.</p>
      <p style="margin:24px 0;">
        <a href="' . esc_url($confirm_url) . '" style="display:inline-block;padding:12px 20px;background:#d46a1f;color:#ffffff;text-decoration:none;border-radius:999px;font-weight:600;">Confirm subscription</a>
      </p>
      <p style="margin:0 0 16px;">If you did not request this, you can ignore this email.</p>
    ';
    $message = da_catering_yyc_child_build_email_shell(
        'Welcome to DA Catering YYC — Home of Quality Meals!',
        $body,
        array('unsub_url' => $unsub_url)
    );
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($email, $subject, $message, $headers);
}

function da_catering_yyc_child_handle_newsletter_subscribe() {
    $nonce = isset($_POST['nonce']) ? sanitize_text_field(wp_unslash($_POST['nonce'])) : '';
    if (!$nonce || !wp_verify_nonce($nonce, 'da_newsletter_subscribe')) {
        wp_send_json_error(array('message' => 'Security check failed. Please refresh and try again.'), 403);
    }

    $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $honeypot = isset($_POST['company']) ? sanitize_text_field(wp_unslash($_POST['company'])) : '';

    if ($honeypot !== '') {
        wp_send_json_success(array('message' => 'Thanks! Please check your email to confirm.'));
    }

    if (!$email || !is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
    }

    $rate_email = $email ? strtolower($email) : 'unknown';
    $rate_key = 'da_newsletter_rl_' . md5($rate_email);
    $rate = (int) get_transient($rate_key);
    if ($rate >= 5) {
        wp_send_json_error(array('message' => 'Too many attempts. Please try again later.'));
    }
    set_transient($rate_key, $rate + 1, HOUR_IN_SECONDS);

    global $wpdb;
    $table = $wpdb->prefix . 'da_newsletter';
    $existing = $wpdb->get_row($wpdb->prepare("SELECT id, status, token, unsubscribed_at FROM {$table} WHERE email = %s", $email));
    if ($existing) {
        if ($existing->status === 'confirmed' && empty($existing->unsubscribed_at)) {
            wp_send_json_success(array('message' => "You're already subscribed."));
        }

        $token = da_catering_yyc_child_generate_newsletter_token();
        $now = current_time('mysql');
        $wpdb->update(
            $table,
            array(
                'status' => 'pending',
                'token' => $token,
                'unsubscribed_at' => null,
                'subscribed_at' => $now,
                'source' => 'newsletter',
            ),
            array('id' => $existing->id),
            array('%s', '%s', '%s', '%s', '%s'),
            array('%d')
        );
        da_catering_yyc_child_send_confirmation_email($email, $token);
        delete_transient($rate_key);
        wp_send_json_success(array('message' => 'Check your email to confirm your subscription.'));
    }

    $token = da_catering_yyc_child_generate_newsletter_token();
    $now = current_time('mysql');
    $inserted = $wpdb->insert(
        $table,
        array(
            'email' => $email,
            'created_at' => $now,
            'subscribed_at' => $now,
            'status' => 'pending',
            'token' => $token,
            'ip_address' => $ip,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'source' => 'newsletter',
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );

    if (!$inserted) {
        wp_send_json_error(array('message' => 'Sorry, something went wrong. Please try again.'));
    }

    da_catering_yyc_child_send_confirmation_email($email, $token);
    delete_transient($rate_key);

    wp_send_json_success(array('message' => 'Check your email to confirm your subscription.'));
}
add_action('wp_ajax_da_newsletter_subscribe', 'da_catering_yyc_child_handle_newsletter_subscribe');
add_action('wp_ajax_nopriv_da_newsletter_subscribe', 'da_catering_yyc_child_handle_newsletter_subscribe');

function da_catering_yyc_child_handle_newsletter_actions() {
    $token = '';
    $action = '';
    if (isset($_GET['da_newsletter_confirm'])) {
        $token = sanitize_text_field(wp_unslash($_GET['da_newsletter_confirm']));
        $action = 'confirm';
    } elseif (isset($_GET['da_newsletter_unsub'])) {
        $token = sanitize_text_field(wp_unslash($_GET['da_newsletter_unsub']));
        $action = 'unsub';
    }

    if (!$token || !$action) {
        return;
    }

    global $wpdb;
    $table = $wpdb->prefix . 'da_newsletter';
    $row = $wpdb->get_row($wpdb->prepare("SELECT id, email, status FROM {$table} WHERE token = %s", $token));

    if (!$row) {
        wp_die('Invalid or expired link. Please contact us for help.', 'Newsletter', array('response' => 404));
    }

    if ($action === 'confirm') {
        $now = current_time('mysql');
        $wpdb->update(
            $table,
            array(
                'status' => 'confirmed',
                'confirmed_at' => $now,
                'unsubscribed_at' => null,
                'subscribed_at' => $now,
            ),
            array('id' => $row->id),
            array('%s', '%s', '%s', '%s'),
            array('%d')
        );
        wp_die('Thanks! Your subscription is confirmed.', 'Newsletter');
    }

    if ($action === 'unsub') {
        $wpdb->update(
            $table,
            array(
                'status' => 'unsubscribed',
                'unsubscribed_at' => current_time('mysql'),
            ),
            array('id' => $row->id),
            array('%s', '%s'),
            array('%d')
        );
        wp_die('You have been unsubscribed.', 'Newsletter');
    }
}
add_action('template_redirect', 'da_catering_yyc_child_handle_newsletter_actions');

function da_catering_yyc_child_newsletter_admin_menu() {
    add_menu_page(
        'Newsletter Subscribers',
        'Newsletter',
        'manage_options',
        'da-newsletter',
        'da_catering_yyc_child_render_newsletter_admin',
        'dashicons-email-alt',
        61
    );
}
add_action('admin_menu', 'da_catering_yyc_child_newsletter_admin_menu');

function da_catering_yyc_child_render_newsletter_admin() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_GET['da_newsletter_export']) && wp_verify_nonce($_GET['_wpnonce'] ?? '', 'da_newsletter_export')) {
        da_catering_yyc_child_export_newsletter_csv();
        exit;
    }

    global $wpdb;
    $table = $wpdb->prefix . 'da_newsletter';
    $subscribers = $wpdb->get_results("SELECT id, email, status, created_at, confirmed_at, unsubscribed_at, ip_address FROM {$table} ORDER BY created_at DESC LIMIT 500");
    $total = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$table}");
    $export_url = wp_nonce_url(admin_url('admin.php?page=da-newsletter&da_newsletter_export=1'), 'da_newsletter_export');
    ?>
    <div class="wrap">
        <h1>Newsletter Subscribers</h1>
        <p>Total subscribers: <strong><?php echo esc_html($total); ?></strong></p>
        <p><a class="button button-primary" href="<?php echo esc_url($export_url); ?>">Download CSV</a></p>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Subscribed</th>
                    <th>Confirmed</th>
                    <th>Unsubscribed</th>
                    <th>IP</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($subscribers) : ?>
                    <?php foreach ($subscribers as $row) : ?>
                        <tr>
                            <td><?php echo esc_html($row->id); ?></td>
                            <td><?php echo esc_html($row->email); ?></td>
                            <td><?php echo esc_html($row->status); ?></td>
                            <td><?php echo esc_html($row->created_at); ?></td>
                            <td><?php echo esc_html($row->confirmed_at); ?></td>
                            <td><?php echo esc_html($row->unsubscribed_at); ?></td>
                            <td><?php echo esc_html($row->ip_address); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7">No subscribers yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <p style="margin-top:12px;color:#666;">Showing the latest 500 subscribers.</p>
    </div>
    <?php
}

function da_catering_yyc_child_export_newsletter_csv() {
    if (!current_user_can('manage_options')) {
        return;
    }
    global $wpdb;
    $table = $wpdb->prefix . 'da_newsletter';
    $rows = $wpdb->get_results("SELECT email, status, created_at, confirmed_at, unsubscribed_at, ip_address, user_agent FROM {$table} ORDER BY created_at DESC", ARRAY_A);

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=da-newsletter-subscribers.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('Email', 'Status', 'Subscribed At', 'Confirmed At', 'Unsubscribed At', 'IP Address', 'User Agent'));
    foreach ($rows as $row) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

// Promo modal: allow admins to manage homepage promo posters.
function da_catering_yyc_child_register_promo_cpt() {
    $labels = array(
        'name' => 'Promos',
        'singular_name' => 'Promo',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Promo',
        'edit_item' => 'Edit Promo',
        'new_item' => 'New Promo',
        'view_item' => 'View Promo',
        'search_items' => 'Search Promos',
        'not_found' => 'No promos found',
        'not_found_in_trash' => 'No promos found in Trash',
    );

    register_post_type('da_promo', array(
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-megaphone',
        'supports' => array('title', 'thumbnail'),
        'show_in_rest' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
    ));
}

add_action('admin_menu', function () {
    add_menu_page(
        'Broadcasts',
        'Broadcasts',
        'manage_options',
        'da-broadcasts',
        'da_catering_yyc_child_render_broadcasts_admin',
        'dashicons-megaphone',
        62
    );
    add_submenu_page(
        'da-broadcasts',
        'All Emails',
        'All Emails',
        'manage_options',
        'da-broadcast-emails',
        'da_catering_yyc_child_render_broadcast_emails_admin'
    );
});

function da_catering_yyc_child_render_broadcasts_admin() {
    if (!current_user_can('manage_options')) {
        return;
    }
    global $wpdb;
    $table = $wpdb->prefix . 'da_broadcasts';
    $now = current_time('mysql');

    if (isset($_GET['da_broadcast_preview']) && wp_verify_nonce($_GET['_wpnonce'] ?? '', 'da_broadcast_preview')) {
        $preview_id = (int) $_GET['da_broadcast_preview'];
        da_catering_yyc_child_render_broadcast_preview($preview_id);
        exit;
    }

    if (isset($_GET['da_broadcast_export']) && wp_verify_nonce($_GET['_wpnonce'] ?? '', 'da_broadcast_export')) {
        $export_id = (int) $_GET['da_broadcast_export'];
        da_catering_yyc_child_export_broadcast_csv($export_id);
        exit;
    }
    if (isset($_GET['da_broadcast_recipients_export']) && wp_verify_nonce($_GET['_wpnonce'] ?? '', 'da_broadcast_recipients_export')) {
        da_catering_yyc_child_export_broadcast_recipients_csv();
        exit;
    }

    if (isset($_POST['da_broadcast_nonce']) && wp_verify_nonce($_POST['da_broadcast_nonce'], 'da_broadcast_save')) {
        $subject = sanitize_text_field(wp_unslash($_POST['subject'] ?? ''));
        $title = sanitize_text_field(wp_unslash($_POST['title'] ?? ''));
        $body = wp_kses_post(wp_unslash($_POST['body'] ?? ''));
        $poster_url = esc_url_raw(wp_unslash($_POST['poster_url'] ?? ''));
        $send_mode = sanitize_text_field(wp_unslash($_POST['send_mode'] ?? 'once'));
        $batch_size = (int) (wp_unslash($_POST['batch_size'] ?? 100));
        $action = sanitize_text_field(wp_unslash($_POST['da_broadcast_action'] ?? 'save'));
        $send_now = $action === 'send' ? 1 : 0;
        $scheduled_at = sanitize_text_field(wp_unslash($_POST['scheduled_at'] ?? ''));

        if ($subject && $title && $body) {
            $status = $send_now ? 'queued' : ($scheduled_at ? 'scheduled' : 'draft');
            $scheduled_value = $send_now ? $now : ($scheduled_at ?: '');
            $wpdb->insert(
                $table,
                array(
                    'subject' => $subject,
                    'title' => $title,
                    'body' => $body,
                    'poster_url' => $poster_url,
                    'status' => $status,
                    'scheduled_at' => $scheduled_value,
                    'created_at' => $now,
                    'send_mode' => in_array($send_mode, array('once', 'batch'), true) ? $send_mode : 'once',
                    'batch_size' => $batch_size > 0 ? $batch_size : 100,
                ),
                array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d')
            );
            $id = (int) $wpdb->insert_id;
            if ($send_now) {
                wp_schedule_single_event(time() + 5, 'da_broadcast_send_event', array($id));
            } else {
                $ts = strtotime($scheduled_at);
                if ($ts) {
                    wp_schedule_single_event($ts, 'da_broadcast_send_event', array($id));
                }
            }
            echo '<div class="notice notice-success"><p>' . ($send_now ? 'Broadcast queued for sending.' : 'Broadcast saved.') . '</p></div>';
        } else {
            echo '<div class="notice notice-error"><p>Please fill subject, title, and body.</p></div>';
        }
    }

    $rows = $wpdb->get_results("SELECT * FROM {$table} ORDER BY created_at DESC LIMIT 50");
    $newsletter_table = $wpdb->prefix . 'da_newsletter';
    $recipient_total = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$newsletter_table} WHERE status = 'confirmed' AND (unsubscribed_at IS NULL)");
    $recipient_preview = $wpdb->get_results("SELECT email, source, subscribed_at FROM {$newsletter_table} WHERE status = 'confirmed' AND (unsubscribed_at IS NULL) ORDER BY subscribed_at DESC LIMIT 25");
    ?>
    <div class="wrap">
        <h1>Broadcasts</h1>
        <div style="background:#fff;border:1px solid #ccd0d4;border-radius:8px;padding:16px;margin:12px 0;">
            <h2 style="margin-top:0;">Recipients</h2>
            <p>Total confirmed recipients: <strong><?php echo esc_html($recipient_total); ?></strong></p>
            <?php
            $recipients_export_url = wp_nonce_url(admin_url('admin.php?page=da-broadcasts&da_broadcast_recipients_export=1'), 'da_broadcast_recipients_export');
            ?>
            <p><a class="button" href="<?php echo esc_url($recipients_export_url); ?>">Export Recipients CSV</a></p>
            <?php if ($recipient_preview) : ?>
                <table class="widefat striped" style="max-width:720px;">
                    <thead>
                        <tr>
                            <th>Email (latest 25)</th>
                            <th>Source</th>
                            <th>Subscribed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recipient_preview as $recipient) : ?>
                            <tr>
                                <td><?php echo esc_html($recipient->email); ?></td>
                                <td><?php echo esc_html($recipient->source); ?></td>
                                <td><?php echo esc_html($recipient->subscribed_at); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>No confirmed recipients yet.</p>
            <?php endif; ?>
        </div>
        <form method="post">
            <?php wp_nonce_field('da_broadcast_save', 'da_broadcast_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th><label>Subject</label></th>
                    <td><input type="text" name="subject" style="width:100%;max-width:700px;" required></td>
                </tr>
                <tr>
                    <th><label>Title</label></th>
                    <td><input type="text" name="title" style="width:100%;max-width:700px;" required></td>
                </tr>
                <tr>
                    <th><label>Poster URL</label></th>
                    <td>
                        <input type="text" name="poster_url" style="width:100%;max-width:700px;" id="da-broadcast-poster">
                        <button type="button" class="button" id="da-broadcast-poster-btn" style="margin-top:8px;">Select/Upload Poster</button>
                        <div id="da-broadcast-poster-preview" style="margin-top:10px;max-width:320px;"></div>
                    </td>
                </tr>
                <tr>
                    <th><label>Body</label></th>
                    <td><?php wp_editor('', 'da_broadcast_body', array('textarea_name' => 'body', 'media_buttons' => true)); ?></td>
                </tr>
                <tr>
                    <th><label>Schedule</label></th>
                    <td>
                        <input type="datetime-local" name="scheduled_at">
                        <span style="margin-left:12px;color:#666;">Leave blank to save as draft.</span>
                    </td>
                </tr>
                <tr>
                    <th><label>Send Mode</label></th>
                    <td>
                        <label><input type="radio" name="send_mode" value="once" checked> Send once (all at once)</label>
                        <label style="margin-left:16px;"><input type="radio" name="send_mode" value="batch"> Send in batches</label>
                        <input type="number" name="batch_size" value="100" min="10" max="1000" style="margin-left:12px;width:120px;" />
                        <span style="color:#666;">per batch</span>
                    </td>
                </tr>
            </table>
            <p>
                <button class="button" type="submit" name="da_broadcast_action" value="save">Save Broadcast</button>
                <button class="button button-primary" type="submit" name="da_broadcast_action" value="send">Send Broadcast</button>
            </p>
        </form>

        <h2>Recent Broadcasts</h2>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Scheduled</th>
                    <th>Sent</th>
                    <th>Recipients</th>
                    <th>Sent Count</th>
                    <th>Mode</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rows) : foreach ($rows as $row) : ?>
                    <tr>
                        <td><?php echo esc_html($row->subject); ?></td>
                        <td><?php echo esc_html($row->status); ?></td>
                        <td><?php echo esc_html($row->scheduled_at); ?></td>
                        <td><?php echo esc_html($row->sent_at); ?></td>
                        <td><?php echo esc_html($row->total_recipients); ?></td>
                        <td><?php echo esc_html($row->sent_count); ?></td>
                        <td><?php echo esc_html($row->send_mode ?? 'once'); ?></td>
                        <td>
                            <?php
                            $preview_url = wp_nonce_url(admin_url('admin.php?page=da-broadcasts&da_broadcast_preview=' . (int) $row->id), 'da_broadcast_preview');
                            $export_url = wp_nonce_url(admin_url('admin.php?page=da-broadcasts&da_broadcast_export=' . (int) $row->id), 'da_broadcast_export');
                            ?>
                            <a href="<?php echo esc_url($preview_url); ?>" target="_blank">Preview</a>
                            &nbsp;|&nbsp;
                            <a href="<?php echo esc_url($export_url); ?>">Export CSV</a>
                        </td>
                    </tr>
                <?php endforeach; else : ?>
                    <tr><td colspan="8">No broadcasts yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

add_action('da_broadcast_send_event', 'da_catering_yyc_child_process_broadcast', 10, 1);

add_action('wp_mail_failed', function ($wp_error) {
    $GLOBALS['da_last_mail_error'] = $wp_error instanceof WP_Error ? $wp_error->get_error_message() : 'Unknown error';
});

function da_catering_yyc_child_render_broadcast_preview($broadcast_id) {
    global $wpdb;
    $table = $wpdb->prefix . 'da_broadcasts';
    $broadcast = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table} WHERE id = %d", $broadcast_id));
    if (!$broadcast) {
        wp_die('Broadcast not found.');
    }
    $brand = 'DA Catering YYC';
    $unsub_url = home_url('/?da_newsletter_unsub=preview');
    echo da_catering_yyc_child_build_broadcast_email($broadcast, $unsub_url, $brand);
}

function da_catering_yyc_child_build_broadcast_email($broadcast, $unsub_url, $brand) {
    $phone_link = 'tel:+15879665757';
    $poster = '';
    if (!empty($broadcast->poster_url)) {
        $poster = '
          <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="border:1px solid #e0e0e0;border-radius:8px;background:#fafafa;margin-bottom:16px;">
            <tr>
              <td align="center" style="padding:0;">
                <a href="' . esc_url($phone_link) . '" style="text-decoration:none;">
                  <img src="' . esc_url($broadcast->poster_url) . '" alt="DA Catering Promotional Flyer" style="display:block;border:0;outline:none;text-decoration:none;width:100%;max-width:600px;height:auto;border-radius:8px;">
                </a>
              </td>
            </tr>
          </table>';
    }
    $body = $poster . wp_kses_post($broadcast->body);
    return da_catering_yyc_child_build_email_shell($broadcast->title, $body, array('unsub_url' => $unsub_url, 'brand' => $brand));
}

function da_catering_yyc_child_render_broadcast_emails_admin() {
    if (!current_user_can('manage_options')) {
        return;
    }
    global $wpdb;
    $table = $wpdb->prefix . 'da_newsletter';
    $notice = null;

    if (isset($_POST['da_broadcast_emails_nonce']) && wp_verify_nonce($_POST['da_broadcast_emails_nonce'], 'da_broadcast_emails_manage')) {
        $action = sanitize_text_field(wp_unslash($_POST['da_broadcast_emails_action'] ?? ''));
        if ($action === 'add') {
            $email = sanitize_email(wp_unslash($_POST['manual_email'] ?? ''));
            if (!$email || !is_email($email)) {
                $notice = array('type' => 'error', 'message' => 'Please enter a valid email address.');
            } else {
                $existing = $wpdb->get_row($wpdb->prepare("SELECT id, status, unsubscribed_at FROM {$table} WHERE email = %s", $email));
                $now = current_time('mysql');
                if ($existing) {
                    if ($existing->status === 'unsubscribed' || !empty($existing->unsubscribed_at)) {
                        $wpdb->update(
                            $table,
                            array(
                                'status' => 'confirmed',
                                'unsubscribed_at' => null,
                                'confirmed_at' => $now,
                                'subscribed_at' => $now,
                                'source' => 'manual',
                            ),
                            array('id' => $existing->id),
                            array('%s', '%s', '%s', '%s', '%s'),
                            array('%d')
                        );
                        $notice = array('type' => 'success', 'message' => 'Email reactivated and added back to the list.');
                    } else {
                        $notice = array('type' => 'warning', 'message' => 'That email is already on the list.');
                    }
                } else {
                    $token = da_catering_yyc_child_generate_newsletter_token();
                    $inserted = $wpdb->insert(
                        $table,
                        array(
                            'email' => $email,
                            'created_at' => $now,
                            'subscribed_at' => $now,
                            'confirmed_at' => $now,
                            'status' => 'confirmed',
                            'token' => $token,
                            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'admin',
                            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
                            'source' => 'manual',
                        ),
                        array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
                    );
                    $notice = $inserted
                        ? array('type' => 'success', 'message' => 'Email added successfully.')
                        : array('type' => 'error', 'message' => 'Unable to add email. Please try again.');
                }
            }
        } elseif ($action === 'delete') {
            $email = sanitize_email(wp_unslash($_POST['delete_email'] ?? ''));
            if (!$email || !is_email($email)) {
                $notice = array('type' => 'error', 'message' => 'Invalid email for deletion.');
            } else {
                $deleted = $wpdb->delete($table, array('email' => $email), array('%s'));
                $notice = $deleted
                    ? array('type' => 'success', 'message' => 'Email removed from the list.')
                    : array('type' => 'warning', 'message' => 'Email not found or already removed.');
            }
        }
    }
    $rows = $wpdb->get_results(
        "SELECT id, email, source, status, subscribed_at, unsubscribed_at FROM {$table} ORDER BY subscribed_at DESC LIMIT 5000"
    );
    ?>
    <div class="wrap">
        <h1>All Emails</h1>
        <p>This list shows the latest 5,000 emails collected from subscriptions, orders, and bookings.</p>
        <?php if ($notice) : ?>
            <div class="notice notice-<?php echo esc_attr($notice['type']); ?> is-dismissible">
                <p><?php echo esc_html($notice['message']); ?></p>
            </div>
        <?php endif; ?>
        <form method="post" style="margin: 16px 0 20px; display:flex; gap:10px; align-items:center;">
            <?php wp_nonce_field('da_broadcast_emails_manage', 'da_broadcast_emails_nonce'); ?>
            <input type="hidden" name="da_broadcast_emails_action" value="add">
            <label for="manual-email" style="font-weight:600;">Add email</label>
            <input id="manual-email" type="email" name="manual_email" placeholder="name@example.com" required style="min-width:260px;">
            <button class="button button-secondary" type="submit">Add</button>
        </form>
        <p>
            <?php
            $export_url = wp_nonce_url(admin_url('admin.php?page=da-broadcasts&da_broadcast_recipients_export=1'), 'da_broadcast_recipients_export');
            ?>
            <a class="button button-primary" href="<?php echo esc_url($export_url); ?>">Export Recipients CSV</a>
        </p>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Source</th>
                    <th>Status</th>
                    <th>Subscribed</th>
                    <th>Unsubscribed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rows) : foreach ($rows as $row) : ?>
                    <tr>
                        <td><?php echo esc_html($row->email); ?></td>
                        <td><?php echo esc_html($row->source); ?></td>
                        <td><?php echo esc_html($row->status); ?></td>
                        <td><?php echo esc_html($row->subscribed_at); ?></td>
                        <td><?php echo esc_html($row->unsubscribed_at); ?></td>
                        <td>
                            <form method="post" style="display:inline;" onsubmit="return confirm('Delete this email from the list?');">
                                <?php wp_nonce_field('da_broadcast_emails_manage', 'da_broadcast_emails_nonce'); ?>
                                <input type="hidden" name="da_broadcast_emails_action" value="delete">
                                <input type="hidden" name="delete_email" value="<?php echo esc_attr($row->email); ?>">
                                <button class="button button-link-delete" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; else : ?>
                    <tr><td colspan="6">No emails yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

function da_catering_yyc_child_export_broadcast_recipients_csv() {
    if (!current_user_can('manage_options')) {
        return;
    }
    global $wpdb;
    $table = $wpdb->prefix . 'da_newsletter';
    $rows = $wpdb->get_results(
        "SELECT email, source, subscribed_at FROM {$table} WHERE status = 'confirmed' AND (unsubscribed_at IS NULL) ORDER BY subscribed_at DESC",
        ARRAY_A
    );

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=da-broadcast-recipients.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('Email', 'Source', 'Subscribed At'));
    if ($rows) {
        foreach ($rows as $row) {
            fputcsv($output, array($row['email'], $row['source'], $row['subscribed_at']));
        }
    }
    fclose($output);
    exit;
}

function da_catering_yyc_child_export_broadcast_csv($broadcast_id) {
    if (!current_user_can('manage_options')) {
        return;
    }
    global $wpdb;
    $log_table = $wpdb->prefix . 'da_broadcast_logs';
    $rows = $wpdb->get_results(
        $wpdb->prepare("SELECT email, status, sent_at, error FROM {$log_table} WHERE broadcast_id = %d ORDER BY email ASC", $broadcast_id),
        ARRAY_A
    );

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=da-broadcast-' . $broadcast_id . '-log.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('Email', 'Status', 'Sent At', 'Error'));
    foreach ($rows as $row) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

function da_catering_yyc_child_process_broadcast($broadcast_id) {
    global $wpdb;
    $b_table = $wpdb->prefix . 'da_broadcasts';
    $n_table = $wpdb->prefix . 'da_newsletter';
    $log_table = $wpdb->prefix . 'da_broadcast_logs';
    $broadcast = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$b_table} WHERE id = %d", $broadcast_id));
    if (!$broadcast || $broadcast->status === 'sent') {
        return;
    }

    $send_mode = $broadcast->send_mode ?: 'once';
    $batch_size = (int) ($broadcast->batch_size ?: 100);
    $offset = (int) ($broadcast->last_offset ?: 0);

    $subscribers = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT email, token FROM {$n_table} WHERE status = 'confirmed' AND (unsubscribed_at IS NULL) LIMIT %d OFFSET %d",
            $send_mode === 'batch' ? $batch_size : 1000000,
            $send_mode === 'batch' ? $offset : 0
        )
    );
    $total = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$n_table} WHERE status = 'confirmed' AND (unsubscribed_at IS NULL)");
    if ($total === 0 || !$subscribers) {
        $wpdb->update($b_table, array('status' => 'sent', 'sent_at' => current_time('mysql')), array('id' => $broadcast_id), array('%s', '%s'), array('%d'));
        return;
    }

    $brand = 'DA Catering YYC';
    $sent_count = 0;

    $emails = array_map(function ($s) {
        return $s->email;
    }, $subscribers);
    $existing = array();
    if ($emails) {
        $placeholders = implode(',', array_fill(0, count($emails), '%s'));
        $existing_rows = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT email FROM {$log_table} WHERE broadcast_id = %d AND email IN ({$placeholders})",
                array_merge(array($broadcast_id), $emails)
            )
        );
        foreach ($existing_rows as $row) {
            $existing[$row->email] = true;
        }
    }
    foreach ($subscribers as $subscriber) {
        if (isset($existing[$subscriber->email])) {
            continue;
        }
        $unsub_url = home_url('/?da_newsletter_unsub=' . urlencode($subscriber->token));
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: DA Catering YYC <orders@dacatering.ca>',
        );
        $message = da_catering_yyc_child_build_broadcast_email($broadcast, $unsub_url, $brand);
        $GLOBALS['da_last_mail_error'] = '';
        if (wp_mail($subscriber->email, $broadcast->subject, $message, $headers)) {
            $sent_count++;
            $wpdb->insert(
                $log_table,
                array(
                    'broadcast_id' => $broadcast_id,
                    'email' => $subscriber->email,
                    'status' => 'sent',
                    'sent_at' => current_time('mysql'),
                ),
                array('%d', '%s', '%s', '%s')
            );
        } else {
            $wpdb->insert(
                $log_table,
                array(
                    'broadcast_id' => $broadcast_id,
                    'email' => $subscriber->email,
                    'status' => 'failed',
                    'error' => substr((string) ($GLOBALS['da_last_mail_error'] ?? 'Failed to send'), 0, 1000),
                    'sent_at' => current_time('mysql'),
                ),
                array('%d', '%s', '%s', '%s', '%s')
            );
        }
    }

    $new_sent = (int) $broadcast->sent_count + $sent_count;
    $new_offset = $send_mode === 'batch' ? $offset + count($subscribers) : $total;
    $all_done = $new_offset >= $total;

    $wpdb->update(
        $b_table,
        array(
            'status' => $all_done ? 'sent' : 'queued',
            'sent_at' => $all_done ? current_time('mysql') : null,
            'total_recipients' => $total,
            'sent_count' => $new_sent,
            'last_offset' => $new_offset,
        ),
        array('id' => $broadcast_id),
        array('%s', '%s', '%d', '%d', '%d'),
        array('%d')
    );

    if (!$all_done && $send_mode === 'batch') {
        wp_schedule_single_event(time() + 120, 'da_broadcast_send_event', array($broadcast_id));
    }
}

add_filter('cron_schedules', function ($schedules) {
    if (!isset($schedules['da_broadcast_batch'])) {
        $schedules['da_broadcast_batch'] = array(
            'interval' => 120,
            'display' => 'Broadcast batch (2 minutes)',
        );
    }
    return $schedules;
});

add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook !== 'toplevel_page_da-broadcasts') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script('media-editor');
    $inline = <<<JS
document.addEventListener('DOMContentLoaded', function () {
  const btn = document.getElementById('da-broadcast-poster-btn');
  const input = document.getElementById('da-broadcast-poster');
  const preview = document.getElementById('da-broadcast-poster-preview');
  if (!btn || !input || !window.wp || !wp.media) return;

  let frame = null;
  btn.addEventListener('click', function (e) {
    e.preventDefault();
    if (frame) {
      frame.open();
      return;
    }
    frame = wp.media({
      title: 'Select Poster',
      button: { text: 'Use this poster' },
      multiple: false
    });
    frame.on('select', function () {
      const attachment = frame.state().get('selection').first().toJSON();
      if (!attachment || !attachment.url) return;
      input.value = attachment.url;
      if (preview) {
        preview.innerHTML = '<img src="' + attachment.url + '" alt="" style="max-width:100%;height:auto;border:1px solid rgba(31,61,52,0.12);border-radius:10px;" />';
      }
    });
    frame.open();
  });
});
JS;
    wp_add_inline_script('media-editor', $inline);
});
add_action('init', 'da_catering_yyc_child_register_promo_cpt');

add_action('init', function () {
    add_post_type_support('da_promo', 'thumbnail');
});

function da_catering_yyc_child_add_promo_metabox() {
    add_meta_box('da_promo_details', 'Promo Details', 'da_catering_yyc_child_render_promo_metabox', 'da_promo', 'normal', 'high');
}
add_action('add_meta_boxes', 'da_catering_yyc_child_add_promo_metabox');

function da_catering_yyc_child_render_promo_metabox($post) {
    wp_nonce_field('da_promo_save', 'da_promo_nonce');
    $active = get_post_meta($post->ID, '_da_promo_active', true);
    $price = get_post_meta($post->ID, '_da_promo_price', true);
    $cta = get_post_meta($post->ID, '_da_promo_cta', true);
    $headline = get_post_meta($post->ID, '_da_promo_headline', true);
    $subline = get_post_meta($post->ID, '_da_promo_subline', true);
    $start = get_post_meta($post->ID, '_da_promo_start', true);
    $end = get_post_meta($post->ID, '_da_promo_end', true);
    $poster = get_post_meta($post->ID, '_da_promo_poster', true);
    ?>
    <p>
        <label>
            <input type="checkbox" name="da_promo_active" value="1" <?php checked($active, '1'); ?> />
            Active (show this promo modal on the website)
        </label>
    </p>
    <p>
        <label>Headline (optional)</label><br />
        <input type="text" name="da_promo_headline" value="<?php echo esc_attr($headline); ?>" style="width:100%;" />
    </p>
    <p>
        <label>Subheadline (optional)</label><br />
        <input type="text" name="da_promo_subline" value="<?php echo esc_attr($subline); ?>" style="width:100%;" />
    </p>
    <p>
        <label>CTA Button Label (optional)</label><br />
        <input type="text" name="da_promo_cta" value="<?php echo esc_attr($cta); ?>" style="width:100%;" placeholder="Quick Order" />
    </p>
    <p>
        <label>Package Price (numbers only)</label><br />
        <input type="number" name="da_promo_price" value="<?php echo esc_attr($price); ?>" step="0.01" min="0" />
    </p>
    <p>
        <label>Start Date (optional)</label><br />
        <input type="date" name="da_promo_start" value="<?php echo esc_attr($start); ?>" />
    </p>
    <p>
        <label>End Date (optional)</label><br />
        <input type="date" name="da_promo_end" value="<?php echo esc_attr($end); ?>" />
    </p>
    <p>
        <label>Promo Poster (fallback if Featured Image fails)</label><br />
        <input type="text" name="da_promo_poster" value="<?php echo esc_attr($poster); ?>" style="width:100%;" placeholder="Poster image URL" />
        <button type="button" class="button" data-promo-poster-upload>Select/Upload Poster</button>
    </p>
    <div data-promo-poster-preview style="margin:12px 0;max-width:320px;">
        <?php
        if ($poster) {
            echo '<img src="' . esc_url($poster) . '" alt="" style="max-width:100%;height:auto;border:1px solid rgba(31,61,52,0.12);border-radius:10px;" />';
        }
        ?>
    </div>
    <p style="margin-top:12px;color:#666;">Use the promo's Featured Image for the poster artwork.</p>
    <?php
}

function da_catering_yyc_child_save_promo_meta($post_id) {
    if (!isset($_POST['da_promo_nonce']) || !wp_verify_nonce($_POST['da_promo_nonce'], 'da_promo_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $active = isset($_POST['da_promo_active']) ? '1' : '0';
    update_post_meta($post_id, '_da_promo_active', $active);
    update_post_meta($post_id, '_da_promo_price', isset($_POST['da_promo_price']) ? sanitize_text_field(wp_unslash($_POST['da_promo_price'])) : '');
    update_post_meta($post_id, '_da_promo_cta', isset($_POST['da_promo_cta']) ? sanitize_text_field(wp_unslash($_POST['da_promo_cta'])) : '');
    update_post_meta($post_id, '_da_promo_headline', isset($_POST['da_promo_headline']) ? sanitize_text_field(wp_unslash($_POST['da_promo_headline'])) : '');
    update_post_meta($post_id, '_da_promo_subline', isset($_POST['da_promo_subline']) ? sanitize_text_field(wp_unslash($_POST['da_promo_subline'])) : '');
    update_post_meta($post_id, '_da_promo_start', isset($_POST['da_promo_start']) ? sanitize_text_field(wp_unslash($_POST['da_promo_start'])) : '');
    update_post_meta($post_id, '_da_promo_end', isset($_POST['da_promo_end']) ? sanitize_text_field(wp_unslash($_POST['da_promo_end'])) : '');
    $poster_url = isset($_POST['da_promo_poster']) ? esc_url_raw(wp_unslash($_POST['da_promo_poster'])) : '';
    update_post_meta($post_id, '_da_promo_poster', $poster_url);

    // If no featured image is set, try to attach the poster URL as the featured image.
    if ($poster_url && !has_post_thumbnail($post_id)) {
        $attachment_id = attachment_url_to_postid($poster_url);
        if ($attachment_id) {
            set_post_thumbnail($post_id, $attachment_id);
        }
    }
}
add_action('save_post_da_promo', 'da_catering_yyc_child_save_promo_meta');

function da_catering_yyc_child_get_active_promo() {
    $args = array(
        'post_type' => 'da_promo',
        'post_status' => 'publish',
        'posts_per_page' => 5,
        'meta_key' => '_da_promo_active',
        'meta_value' => '1',
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $query = new WP_Query($args);
    if (!$query->have_posts()) {
        return null;
    }

    $today = current_time('Y-m-d');
    foreach ($query->posts as $post) {
        $start = get_post_meta($post->ID, '_da_promo_start', true);
        $end = get_post_meta($post->ID, '_da_promo_end', true);
        if ($start && $start > $today) {
            continue;
        }
        if ($end && $end < $today) {
            continue;
        }
        $poster = get_post_meta($post->ID, '_da_promo_poster', true);
        if (!has_post_thumbnail($post) && !$poster) {
            continue;
        }
        return $post;
    }
    return null;
}

function da_catering_yyc_child_get_promo_debug_report() {
    if (!current_user_can('manage_options')) {
        return array();
    }
    $args = array(
        'post_type' => 'da_promo',
        'post_status' => 'publish',
        'posts_per_page' => 5,
        'meta_key' => '_da_promo_active',
        'meta_value' => '1',
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $query = new WP_Query($args);
    if (!$query->have_posts()) {
        return array(
            array(
                'title' => 'No active promos found.',
                'issues' => array('No published promo has Active checked.'),
            ),
        );
    }

    $today = current_time('Y-m-d');
    $report = array();
    foreach ($query->posts as $post) {
        $issues = array();
        $start = get_post_meta($post->ID, '_da_promo_start', true);
        $end = get_post_meta($post->ID, '_da_promo_end', true);
        $poster = get_post_meta($post->ID, '_da_promo_poster', true);

        if ($start && $start > $today) {
            $issues[] = 'Start date is in the future: ' . $start;
        }
        if ($end && $end < $today) {
            $issues[] = 'End date already passed: ' . $end;
        }
        if (!has_post_thumbnail($post) && !$poster) {
            $issues[] = 'Missing featured image and poster URL.';
        }

        $report[] = array(
            'title' => get_the_title($post),
            'issues' => $issues,
        );
    }
    return $report;
}

function da_catering_yyc_child_render_promo_modal() {
    if (!is_front_page()) {
        return;
    }
    $promo = da_catering_yyc_child_get_active_promo();
    if (!$promo) {
        return;
    }

    $image = get_the_post_thumbnail_url($promo, 'large');
    if (!$image) {
        $image = get_post_meta($promo->ID, '_da_promo_poster', true);
    }
    $headline = get_post_meta($promo->ID, '_da_promo_headline', true);
    $subline = get_post_meta($promo->ID, '_da_promo_subline', true);
    $cta = get_post_meta($promo->ID, '_da_promo_cta', true);
    $price = get_post_meta($promo->ID, '_da_promo_price', true);
    $cta_text = $cta ? $cta : 'Place Order';
    $promo_name = get_the_title($promo);

    $query_args = array(
        'quick_order' => '1',
        'promo' => $promo->ID,
        'promo_price' => $price,
        'promo_name' => $promo_name,
    );
    $promo_url = add_query_arg($query_args, home_url('/booking/'));
    ?>
    <div class="promo-modal is-visible" data-promo-modal data-promo-id="<?php echo esc_attr($promo->ID); ?>">
      <div class="promo-modal__backdrop" data-promo-close></div>
      <div class="promo-modal__dialog" role="dialog" aria-modal="true" aria-label="Promo">
        <button class="promo-modal__close" type="button" aria-label="Close" data-promo-close>×</button>
        <div class="promo-modal__media">
          <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($promo_name); ?> poster" loading="lazy" decoding="async" />
        </div>
        <div class="promo-modal__content">
          <h3><?php echo esc_html($headline ? $headline : $promo_name); ?></h3>
          <?php if ($subline) : ?>
            <p><?php echo esc_html($subline); ?></p>
          <?php endif; ?>
          <?php if ($price !== '') : ?>
            <div class="promo-modal__price">Package price: <strong>$<?php echo esc_html($price); ?></strong></div>
          <?php endif; ?>
          <a class="btn btn-primary promo-modal__cta" href="<?php echo esc_url($promo_url); ?>"><?php echo esc_html($cta_text); ?></a>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        document.body.classList.add("promo-modal-open");
        var modal = document.querySelector("[data-promo-modal]");
        if (!modal) return;
        modal.querySelectorAll("[data-promo-close]").forEach(function (btn) {
          btn.addEventListener("click", function (event) {
            event.preventDefault();
            event.stopPropagation();
            modal.classList.remove("is-visible");
            document.body.classList.remove("promo-modal-open");
          });
        });
        var cta = modal.querySelector(".promo-modal__cta");
        if (cta) {
          cta.addEventListener("click", function () {
            modal.classList.remove("is-visible");
            document.body.classList.remove("promo-modal-open");
          });
        }
      });
    </script>
    <?php
}
add_action('wp_footer', 'da_catering_yyc_child_render_promo_modal');

add_action('wp_footer', function () {
    if (!current_user_can('manage_options')) {
        return;
    }
    if (!is_front_page()) {
        return;
    }
    $promo = da_catering_yyc_child_get_active_promo();
    if ($promo) {
        $image = get_the_post_thumbnail_url($promo, 'large');
        if (!$image) {
            $image = get_post_meta($promo->ID, '_da_promo_poster', true);
        }
        echo '<div style="position:fixed;bottom:20px;right:20px;z-index:3000;background:#111;color:#fff;padding:10px 12px;border-radius:8px;font-size:12px;">Promo modal: active #' . esc_html($promo->ID) . '<br>Image: ' . esc_html($image ? 'ok' : 'missing') . '</div>';
    } else {
        echo '<div style="position:fixed;bottom:20px;right:20px;z-index:3000;background:#b91c1c;color:#fff;padding:10px 12px;border-radius:8px;font-size:12px;">Promo modal: NOT RENDERED (no active promo)</div>';
    }
});

add_action('admin_notices', function () {
    if (!current_user_can('manage_options')) {
        return;
    }
    if (!isset($_GET['post_type']) || $_GET['post_type'] !== 'da_promo') {
        return;
    }
    if (!empty($_GET['post'])) {
        return;
    }
    $report = da_catering_yyc_child_get_promo_debug_report();
    if (!$report) {
        return;
    }
    $all_clear = true;
    foreach ($report as $item) {
        if (!empty($item['issues'])) {
            $all_clear = false;
            break;
        }
    }
    if ($all_clear) {
        return;
    }
    echo '<div class="notice notice-warning"><p><strong>Promo modal check:</strong></p><ul style="margin:6px 0 0 18px;list-style:disc;">';
    foreach ($report as $item) {
        if (empty($item['issues'])) {
            continue;
        }
        echo '<li><strong>' . esc_html($item['title']) . ':</strong> ' . esc_html(implode(' | ', $item['issues'])) . '</li>';
    }
    echo '</ul></div>';
});

// Ensure media uploader works on Promo editor and add a poster picker fallback.
add_action('admin_enqueue_scripts', function ($hook) {
    if (!in_array($hook, array('post.php', 'post-new.php'), true)) {
        return;
    }
    $screen = get_current_screen();
    if (!$screen || $screen->post_type !== 'da_promo') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script('media-editor');
    $inline = <<<JS
document.addEventListener('DOMContentLoaded', function () {
  const button = document.querySelector('[data-promo-poster-upload]');
  const input = document.querySelector('input[name="da_promo_poster"]');
  const preview = document.querySelector('[data-promo-poster-preview]');
  if (!button || !input || !window.wp || !wp.media) return;

  let frame = null;
  button.addEventListener('click', function (e) {
    e.preventDefault();
    if (frame) {
      frame.open();
      return;
    }
    frame = wp.media({
      title: 'Select Promo Poster',
      button: { text: 'Use this poster' },
      multiple: false
    });
    frame.on('select', function () {
      const attachment = frame.state().get('selection').first().toJSON();
      if (!attachment || !attachment.url) return;
      input.value = attachment.url;
      if (preview) {
        preview.innerHTML = '<img src="' + attachment.url + '" alt="" style="max-width:100%;height:auto;border:1px solid rgba(31,61,52,0.12);border-radius:10px;" />';
      }
    });
    frame.open();
  });
});
JS;
    wp_add_inline_script('media-editor', $inline);
});

// Set default email sender address/name.
add_filter('wp_mail_from', function ($from) {
    return 'deb@dacatering.ca';
});

add_filter('wp_mail_from_name', function ($name) {
    return 'DA Catering YYC';
});

// Optional SMTP configuration via wp-config.php constants.
add_action('phpmailer_init', function ($phpmailer) {
    if (!defined('DA_SMTP_HOST')) {
        return;
    }
    $phpmailer->isSMTP();
    $phpmailer->Host = DA_SMTP_HOST;
    $phpmailer->SMTPAuth = defined('DA_SMTP_USER');
    if (defined('DA_SMTP_USER')) {
        $phpmailer->Username = DA_SMTP_USER;
    }
    if (defined('DA_SMTP_PASS')) {
        $phpmailer->Password = DA_SMTP_PASS;
    }
    if (defined('DA_SMTP_PORT')) {
        $phpmailer->Port = (int) DA_SMTP_PORT;
    }
    if (defined('DA_SMTP_SECURE')) {
        $phpmailer->SMTPSecure = DA_SMTP_SECURE;
    }
    $phpmailer->From = 'orders@dacatering.ca';
    $phpmailer->FromName = 'DA Catering YYC';
});

function da_catering_yyc_child_get_menu_prices() {
    $base = array(
        'Jollof Rice' => 18,
        'Fried Rice' => 17,
        'Egusi Soup & Pounded Yam' => 22,
        'Semovita & Efo Riro' => 21,
        'Red Stew' => 19,
        'Ayamase (Ofada Stew)' => 22,
        'Suya Skewers' => 16,
        'Dodo (Fried Plantain)' => 12,
        'Puff Puff' => 10,
        'Moi Moi' => 14,
        'Asun (Spicy Goat)' => 23,
        'Okra Soup' => 19,
        'Tropical Mango Smoothie' => 8,
        'Orange Carrot Boost' => 7,
        'Party Tray: Jollof + Suya + Dodo' => 150,
        'Pineapple Ginger Zing' => 8,
        'Watermelon Cooler' => 7,
        'Berry Blast' => 8,
        'Zobo / Hibiscus Drink' => 6,
        'Kunu / Tigernut Drink' => 6,
        'Chapman' => 6,
        'Sobolo' => 6,
    );
    $json = get_option('da_menu_prices_json', '');
    if ($json) {
        $decoded = json_decode($json, true);
        if (is_array($decoded)) {
            foreach ($decoded as $name => $price) {
                if (!is_string($name) || $name === '') {
                    continue;
                }
                if (!is_numeric($price)) {
                    continue;
                }
                $base[$name] = (float) $price;
            }
        }
    }
    return $base;
}

function da_catering_yyc_child_rate_limit($key, $limit = 10, $window = HOUR_IN_SECONDS) {
    $count = (int) get_transient($key);
    if ($count >= $limit) {
        return false;
    }
    set_transient($key, $count + 1, $window);
    return true;
}

// Orders: store quick orders and email customer/admin with receipt action.
function da_catering_yyc_child_register_order_cpt() {
    register_post_type('da_order', array(
        'labels' => array(
            'name' => 'Orders',
            'singular_name' => 'Order',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-cart',
        'supports' => array('title'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'da_catering_yyc_child_register_order_cpt');

add_action('admin_menu', function () {
    add_submenu_page(
        'edit.php?post_type=da_order',
        'Menu Prices',
        'Menu Prices',
        'manage_options',
        'da-menu-prices',
        'da_catering_yyc_child_render_menu_prices_page'
    );
});

function da_catering_yyc_child_render_menu_prices_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    if (isset($_POST['da_menu_prices_nonce']) && wp_verify_nonce($_POST['da_menu_prices_nonce'], 'da_menu_prices_save')) {
        $raw = wp_unslash($_POST['da_menu_prices_json'] ?? '');
        $trimmed = trim($raw);
        $decoded = $trimmed ? json_decode($trimmed, true) : array();
        if ($trimmed && !is_array($decoded)) {
            echo '<div class="notice notice-error"><p>Invalid JSON. Please fix the format.</p></div>';
        } else {
            update_option('da_menu_prices_json', $trimmed);
            echo '<div class="notice notice-success"><p>Menu prices updated.</p></div>';
        }
    }
    $current = get_option('da_menu_prices_json', '');
    ?>
    <div class="wrap">
        <h1>Menu Prices</h1>
        <p>Provide a JSON object of item name to price. Example:</p>
        <pre style="background:#f6f7f7;padding:12px;border-radius:6px;">{"Jollof Rice":18,"Fried Rice":17}</pre>
        <form method="post">
            <?php wp_nonce_field('da_menu_prices_save', 'da_menu_prices_nonce'); ?>
            <textarea name="da_menu_prices_json" rows="12" style="width:100%;max-width:900px;"><?php echo esc_textarea($current); ?></textarea>
            <p><button class="button button-primary" type="submit">Save Prices</button></p>
        </form>
    </div>
    <?php
}

add_filter('manage_da_order_posts_columns', function ($columns) {
    $columns['order_status'] = 'Status';
    $columns['order_total'] = 'Subtotal';
    $columns['order_email'] = 'Customer Email';
    $columns['order_phone'] = 'Phone';
    $columns['order_paid'] = 'Paid';
    return $columns;
});

add_action('manage_da_order_posts_custom_column', function ($column, $post_id) {
    if ($column === 'order_status') {
        $status = get_post_meta($post_id, '_da_order_status', true) ?: 'received';
        echo esc_html(ucwords(str_replace('_', ' ', $status)));
    }
    if ($column === 'order_total') {
        $subtotal = (float) get_post_meta($post_id, '_da_order_subtotal', true);
        echo esc_html(da_catering_yyc_child_format_money($subtotal));
    }
    if ($column === 'order_email') {
        $order = get_post_meta($post_id, '_da_order_data', true);
        echo esc_html(is_array($order) ? ($order['order_email'] ?? '') : '');
    }
    if ($column === 'order_phone') {
        $order = get_post_meta($post_id, '_da_order_data', true);
        echo esc_html(is_array($order) ? ($order['order_phone'] ?? '') : '');
    }
    if ($column === 'order_paid') {
        $paid = (int) get_post_meta($post_id, '_da_order_paid', true);
        echo $paid ? 'Yes' : 'No';
    }
}, 10, 2);

add_action('admin_head', function () {
    $screen = get_current_screen();
    if (!$screen || $screen->post_type !== 'da_order') {
        return;
    }
    echo '<style>
      .column-order_status { width: 120px; }
      .column-order_total { width: 120px; }
    </style>';
});

add_action('admin_menu', function () {
    add_submenu_page(
        'edit.php?post_type=da_order',
        'Reports',
        'Reports',
        'manage_options',
        'da-order-reports',
        'da_catering_yyc_child_render_order_reports'
    );
});

function da_catering_yyc_child_get_order_totals($year = null) {
    global $wpdb;
    $year = $year ? (int) $year : (int) current_time('Y');
    $table_posts = $wpdb->posts;
    $table_meta = $wpdb->postmeta;

    $results = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT MONTH(p.post_date) AS month, COUNT(*) AS orders, SUM(CAST(m.meta_value AS DECIMAL(12,2))) AS total
             FROM {$table_posts} p
             INNER JOIN {$table_meta} m ON p.ID = m.post_id AND m.meta_key = '_da_order_subtotal'
             WHERE p.post_type = 'da_order'
               AND p.post_status = 'publish'
               AND YEAR(p.post_date) = %d
             GROUP BY MONTH(p.post_date)
             ORDER BY MONTH(p.post_date)",
            $year
        )
    );

    $by_month = array_fill(1, 12, array('orders' => 0, 'total' => 0));
    foreach ($results as $row) {
        $month = (int) $row->month;
        $by_month[$month] = array(
            'orders' => (int) $row->orders,
            'total' => (float) $row->total,
        );
    }
    return $by_month;
}

function da_catering_yyc_child_render_order_reports() {
    if (!current_user_can('manage_options')) {
        return;
    }
    $year = isset($_GET['year']) ? (int) $_GET['year'] : (int) current_time('Y');
    $totals = da_catering_yyc_child_get_order_totals($year);

    $year_total = 0;
    $year_orders = 0;
    foreach ($totals as $month => $data) {
        $year_total += $data['total'];
        $year_orders += $data['orders'];
    }
    $avg = $year_orders ? ($year_total / $year_orders) : 0;
    ?>
    <div class="wrap">
        <h1>Order Reports</h1>
        <form method="get" style="margin:12px 0;">
            <input type="hidden" name="post_type" value="da_order" />
            <input type="hidden" name="page" value="da-order-reports" />
            <label>Year:</label>
            <input type="number" name="year" value="<?php echo esc_attr($year); ?>" min="2020" max="<?php echo esc_attr(current_time('Y')); ?>" />
            <button class="button">Filter</button>
        </form>
        <div style="margin:12px 0;">
            <strong>Total (<?php echo esc_html($year); ?>):</strong> <?php echo esc_html(da_catering_yyc_child_format_money($year_total)); ?>
            &nbsp; | &nbsp;
            <strong>Orders:</strong> <?php echo esc_html($year_orders); ?>
            &nbsp; | &nbsp;
            <strong>Avg Order:</strong> <?php echo esc_html(da_catering_yyc_child_format_money($avg)); ?>
        </div>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Orders</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($totals as $month => $data) : ?>
                    <tr>
                        <td><?php echo esc_html(date('F', mktime(0, 0, 0, $month, 1))); ?></td>
                        <td><?php echo esc_html($data['orders']); ?></td>
                        <td><?php echo esc_html(da_catering_yyc_child_format_money($data['total'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

add_action('wp_dashboard_setup', function () {
    wp_add_dashboard_widget('da_orders_summary', 'DA Orders Summary', 'da_catering_yyc_child_render_orders_dashboard_widget');
});

function da_catering_yyc_child_render_orders_dashboard_widget() {
    $month = (int) current_time('n');
    $year = (int) current_time('Y');
    $totals = da_catering_yyc_child_get_order_totals($year);
    $month_total = $totals[$month]['total'] ?? 0;
    $month_orders = $totals[$month]['orders'] ?? 0;

    $year_total = 0;
    foreach ($totals as $data) {
        $year_total += $data['total'];
    }
    echo '<p><strong>This month:</strong> ' . esc_html(da_catering_yyc_child_format_money($month_total)) . ' (' . esc_html($month_orders) . ' orders)</p>';
    echo '<p><strong>This year:</strong> ' . esc_html(da_catering_yyc_child_format_money($year_total)) . '</p>';
    echo '<p><a href=\"' . esc_url(admin_url('edit.php?post_type=da_order&page=da-order-reports')) . '\">View reports</a></p>';
}

function da_catering_yyc_child_format_money($amount) {
    return '$' . number_format((float) $amount, 2);
}

function da_catering_yyc_child_build_items_table($items) {
    $rows = '';
    foreach ($items as $item) {
        $name = esc_html($item['name'] ?? '');
        $qty = (int) ($item['qty'] ?? 1);
        $price = (float) ($item['price'] ?? 0);
        $line = $qty * $price;
        $rows .= '<tr>
          <td style="padding:8px 0;border-bottom:1px solid #eee;">' . $name . '</td>
          <td style="padding:8px 0;border-bottom:1px solid #eee;text-align:center;">' . $qty . '</td>
          <td style="padding:8px 0;border-bottom:1px solid #eee;text-align:right;">' . da_catering_yyc_child_format_money($line) . '</td>
        </tr>';
    }
    return $rows;
}

function da_catering_yyc_child_send_order_confirmation($order_id, $order, $items, $subtotal) {
    $email = $order['order_email'];

    $items_rows = da_catering_yyc_child_build_items_table($items);
    $subject = 'Your order was received';
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: DA Catering YYC <orders@dacatering.ca>',
    );

    $body = '
      <p style="margin:0 0 12px;">Order #' . esc_html($order_id) . '</p>
      <p style="margin:0 0 16px;line-height:1.6;">We have received your order and will follow up shortly. You will receive status updates by email.</p>
      <table style="width:100%;border-collapse:collapse;margin-top:12px;">
        <thead>
          <tr>
            <th style="text-align:left;padding-bottom:8px;border-bottom:2px solid #eee;">Item</th>
            <th style="text-align:center;padding-bottom:8px;border-bottom:2px solid #eee;">Qty</th>
            <th style="text-align:right;padding-bottom:8px;border-bottom:2px solid #eee;">Total</th>
          </tr>
        </thead>
        <tbody>
          ' . $items_rows . '
        </tbody>
      </table>
      <p style="margin:16px 0 0;text-align:right;font-weight:700;">Subtotal: ' . da_catering_yyc_child_format_money($subtotal) . '</p>
    ';
    $message = da_catering_yyc_child_build_email_shell('Thanks for your order!', $body);
    wp_mail($email, $subject, $message, $headers);
}

function da_catering_yyc_child_send_order_admin_notice($order_id, $order, $items, $subtotal) {
    $receipt_token = get_post_meta($order_id, '_da_order_receipt_token', true);
    $receipt_url = add_query_arg('da_order_receipt', $receipt_token, home_url('/'));
    $paid_token = get_post_meta($order_id, '_da_order_paid_token', true);
    $paid_url = add_query_arg('da_order_paid', $paid_token, home_url('/'));
    $status_token = get_post_meta($order_id, '_da_order_status_token', true);
    $confirmed_url = add_query_arg(array('da_order_status' => $status_token, 'status' => 'confirmed'), home_url('/'));
    $progress_url = add_query_arg(array('da_order_status' => $status_token, 'status' => 'in_progress'), home_url('/'));
    $ready_url = add_query_arg(array('da_order_status' => $status_token, 'status' => 'ready'), home_url('/'));

    $items_rows = da_catering_yyc_child_build_items_table($items);
    $subject = 'New quick order received';
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: DA Catering YYC <orders@dacatering.ca>',
    );

    $body = '
      <p style="margin:0 0 12px;">Order #' . esc_html($order_id) . '</p>
      <p style="margin:0 0 12px;">Customer: <strong>' . esc_html($order['order_name']) . '</strong></p>
      <p style="margin:0 0 12px;">Email: ' . esc_html($order['order_email']) . '</p>
      <p style="margin:0 0 12px;">Phone: ' . esc_html($order['order_phone']) . '</p>
      <p style="margin:0 0 12px;">Fulfillment: ' . esc_html($order['fulfillment']) . '</p>
      <p style="margin:0 0 12px;">Preferred time: ' . esc_html($order['order_time']) . '</p>
      ' . (!empty($order['delivery_address']) ? '<p style="margin:0 0 12px;">Delivery address: ' . esc_html($order['delivery_address']) . '</p>' : '') . '
      ' . (!empty($order['order_notes']) ? '<p style="margin:0 0 12px;">Notes: ' . esc_html($order['order_notes']) . '</p>' : '') . '
      <table style="width:100%;border-collapse:collapse;margin-top:12px;">
        <thead>
          <tr>
            <th style="text-align:left;padding-bottom:8px;border-bottom:2px solid #eee;">Item</th>
            <th style="text-align:center;padding-bottom:8px;border-bottom:2px solid #eee;">Qty</th>
            <th style="text-align:right;padding-bottom:8px;border-bottom:2px solid #eee;">Total</th>
          </tr>
        </thead>
        <tbody>
          ' . $items_rows . '
        </tbody>
      </table>
      <p style="margin:16px 0 0;text-align:right;font-weight:700;">Subtotal: ' . da_catering_yyc_child_format_money($subtotal) . '</p>
      <p style="margin:18px 0 0;">
        <a href="' . esc_url($receipt_url) . '" style="display:inline-block;padding:12px 18px;background:#d46a1f;color:#ffffff;text-decoration:none;border-radius:999px;font-weight:600;">Send Receipt to Customer</a>
      </p>
      <p style="margin:12px 0 0;">
        <a href="' . esc_url($paid_url) . '" style="display:inline-block;padding:10px 16px;background:#1f3d34;color:#ffffff;text-decoration:none;border-radius:999px;font-weight:600;">Mark as Paid</a>
      </p>
      <p style="margin:18px 0 0;">
        <a href="' . esc_url($confirmed_url) . '" style="display:inline-block;padding:10px 16px;background:#2563eb;color:#ffffff;text-decoration:none;border-radius:999px;font-weight:600;">Confirm Order</a>
        <a href="' . esc_url($progress_url) . '" style="display:inline-block;padding:10px 16px;background:#0f766e;color:#ffffff;text-decoration:none;border-radius:999px;font-weight:600;margin-left:6px;">In Progress</a>
        <a href="' . esc_url($ready_url) . '" style="display:inline-block;padding:10px 16px;background:#16a34a;color:#ffffff;text-decoration:none;border-radius:999px;font-weight:600;margin-left:6px;">Ready</a>
      </p>
    ';
    $message = da_catering_yyc_child_build_email_shell('New Quick Order', $body, array('include_cta' => false));
    wp_mail('orders@dacatering.ca', $subject, $message, $headers);
}

function da_catering_yyc_child_send_order_receipt($order_id) {
    $order = get_post_meta($order_id, '_da_order_data', true);
    $items = get_post_meta($order_id, '_da_order_items', true);
    if (!is_array($order) || !is_array($items)) {
        return false;
    }

    $subtotal = (float) get_post_meta($order_id, '_da_order_subtotal', true);
    $email = $order['order_email'];
    $items_rows = da_catering_yyc_child_build_items_table($items);
    $subject = 'Your receipt from DA Catering YYC';
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: DA Catering YYC <orders@dacatering.ca>',
    );

    $body = '
      <p style="margin:0 0 12px;">Order #' . esc_html($order_id) . '</p>
      <p style="margin:0 0 16px;">Thank you for your payment. Here is your receipt.</p>
      <table style="width:100%;border-collapse:collapse;margin-top:12px;">
        <thead>
          <tr>
            <th style="text-align:left;padding-bottom:8px;border-bottom:2px solid #eee;">Item</th>
            <th style="text-align:center;padding-bottom:8px;border-bottom:2px solid #eee;">Qty</th>
            <th style="text-align:right;padding-bottom:8px;border-bottom:2px solid #eee;">Total</th>
          </tr>
        </thead>
        <tbody>
          ' . $items_rows . '
        </tbody>
      </table>
      <p style="margin:16px 0 0;text-align:right;font-weight:700;">Subtotal: ' . da_catering_yyc_child_format_money($subtotal) . '</p>
    ';
    $message = da_catering_yyc_child_build_email_shell('Receipt', $body);
    return wp_mail($email, $subject, $message, $headers);
}

function da_catering_yyc_child_send_order_status_email($order_id, $status) {
    $order = get_post_meta($order_id, '_da_order_data', true);
    if (!is_array($order)) {
        return false;
    }
    $email = $order['order_email'];
    $status_map = array(
        'confirmed' => 'Order confirmed',
        'in_progress' => 'In progress',
        'ready' => 'Ready for pickup/delivery',
        'paid' => 'Payment received',
    );
    $status_label = $status_map[$status] ?? 'Order update';
    $subject = $status_label . ' - DA Catering YYC';
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: DA Catering YYC <orders@dacatering.ca>',
    );
    $body = '<p style="margin:0 0 16px;line-height:1.6;">Hi ' . esc_html($order['order_name']) . ', your order status is now: <strong>' . esc_html($status_label) . '</strong>.</p>';
    $message = da_catering_yyc_child_build_email_shell($status_label, $body);
    return wp_mail($email, $subject, $message, $headers);
}

function da_catering_yyc_child_send_booking_confirmation($booking) {
    $email = $booking['email'];
    $subject = 'Your catering booking request was received';
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: DA Catering YYC <orders@dacatering.ca>',
    );
    $body = '
      <p style="margin:0 0 16px;line-height:1.6;">We have received your catering request and will get back to you within 2 hours.</p>
      <p style="margin:0 0 6px;"><strong>Event:</strong> ' . esc_html($booking['event_type']) . '</p>
      ' . (!empty($booking['package_name']) ? '<p style="margin:0 0 6px;"><strong>Package:</strong> ' . esc_html($booking['package_name']) . ' (Starting at $' . esc_html($booking['package_price']) . ')</p>' : '') . '
      <p style="margin:0 0 6px;"><strong>Guests:</strong> ' . esc_html($booking['guest_count']) . '</p>
      <p style="margin:0 0 6px;"><strong>Date:</strong> ' . esc_html($booking['event_date']) . '</p>
      <p style="margin:0 0 6px;"><strong>Time:</strong> ' . esc_html($booking['event_time']) . '</p>
    ';
    $message = da_catering_yyc_child_build_email_shell('Thanks for your booking request!', $body);
    wp_mail($email, $subject, $message, $headers);
}

function da_catering_yyc_child_send_booking_admin_notice($booking) {
    $subject = 'New catering booking request';
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: DA Catering YYC <orders@dacatering.ca>',
    );
    $body = '
      <p><strong>Name:</strong> ' . esc_html($booking['full_name']) . '</p>
      <p><strong>Email:</strong> ' . esc_html($booking['email']) . '</p>
      <p><strong>Phone:</strong> ' . esc_html($booking['phone']) . '</p>
      <p><strong>Event Type:</strong> ' . esc_html($booking['event_type']) . '</p>
      <p><strong>Guests:</strong> ' . esc_html($booking['guest_count']) . '</p>
      <p><strong>Date:</strong> ' . esc_html($booking['event_date']) . '</p>
      <p><strong>Time:</strong> ' . esc_html($booking['event_time']) . '</p>
      <p><strong>Budget:</strong> ' . esc_html($booking['budget_range']) . '</p>
      <p><strong>Service Type:</strong> ' . esc_html($booking['service_type']) . '</p>
      <p><strong>Package:</strong> ' . esc_html($booking['package_name']) . '</p>
      <p><strong>Package Price:</strong> $' . esc_html($booking['package_price']) . '</p>
      <p><strong>Address:</strong> ' . esc_html($booking['delivery_address']) . '</p>
      <p><strong>Delivery Instructions:</strong> ' . esc_html($booking['delivery_instructions']) . '</p>
      <p><strong>Dietary Restrictions:</strong> ' . esc_html($booking['dietary_restrictions']) . '</p>
      <p><strong>Special Requests:</strong> ' . esc_html($booking['special_requests']) . '</p>
    ';
    $message = da_catering_yyc_child_build_email_shell('New Catering Booking', $body, array('include_cta' => false));
    wp_mail('orders@dacatering.ca', $subject, $message, $headers);
}

function da_catering_yyc_child_handle_booking_submit() {
    $nonce = isset($_POST['nonce']) ? sanitize_text_field(wp_unslash($_POST['nonce'])) : '';
    if (!$nonce || !wp_verify_nonce($nonce, 'da_booking_submit')) {
        wp_send_json_error(array('message' => 'Security check failed. Please refresh and try again.'), 403);
    }

    $honeypot = isset($_POST['booking_company']) ? sanitize_text_field(wp_unslash($_POST['booking_company'])) : '';
    if ($honeypot !== '') {
        wp_send_json_success(array('message' => 'Booking request submitted.'));
    }

    $booking = array(
        'full_name' => sanitize_text_field(wp_unslash($_POST['full_name'] ?? '')),
        'email' => sanitize_email(wp_unslash($_POST['email'] ?? '')),
        'phone' => sanitize_text_field(wp_unslash($_POST['phone'] ?? '')),
        'event_type' => sanitize_text_field(wp_unslash($_POST['event_type'] ?? '')),
        'guest_count' => sanitize_text_field(wp_unslash($_POST['guest_count'] ?? '')),
        'event_date' => sanitize_text_field(wp_unslash($_POST['event_date'] ?? '')),
        'event_time' => sanitize_text_field(wp_unslash($_POST['event_time'] ?? '')),
        'budget_range' => sanitize_text_field(wp_unslash($_POST['budget_range'] ?? '')),
        'service_type' => sanitize_text_field(wp_unslash($_POST['service_type'] ?? '')),
        'delivery_address' => sanitize_textarea_field(wp_unslash($_POST['delivery_address'] ?? '')),
        'delivery_instructions' => sanitize_textarea_field(wp_unslash($_POST['delivery_instructions'] ?? '')),
        'dietary_restrictions' => sanitize_textarea_field(wp_unslash($_POST['dietary_restrictions'] ?? '')),
        'special_requests' => sanitize_textarea_field(wp_unslash($_POST['special_requests'] ?? '')),
        'package_name' => sanitize_text_field(wp_unslash($_POST['package_name'] ?? '')),
        'package_price' => sanitize_text_field(wp_unslash($_POST['package_price'] ?? '')),
    );

    if (!$booking['full_name'] || !$booking['email'] || !$booking['phone']) {
        wp_send_json_error(array('message' => 'Please complete all required fields.'));
    }

    $rate_key = 'da_booking_rl_' . md5(strtolower($booking['email'] ?: 'unknown'));
    if (!da_catering_yyc_child_rate_limit($rate_key, 5, HOUR_IN_SECONDS)) {
        wp_send_json_error(array('message' => 'Too many attempts. Please try again later.'));
    }

    da_catering_yyc_child_send_booking_confirmation($booking);
    da_catering_yyc_child_send_booking_admin_notice($booking);
    da_catering_yyc_child_get_or_create_subscriber($booking['email'], 'booking');

    delete_transient($rate_key);
    wp_send_json_success(array('message' => 'Booking request submitted.'));
}
add_action('wp_ajax_da_booking_submit', 'da_catering_yyc_child_handle_booking_submit');
add_action('wp_ajax_nopriv_da_booking_submit', 'da_catering_yyc_child_handle_booking_submit');

function da_catering_yyc_child_handle_contact_submit() {
    $nonce = isset($_POST['nonce']) ? sanitize_text_field(wp_unslash($_POST['nonce'])) : '';
    if (!$nonce || !wp_verify_nonce($nonce, 'da_contact_submit')) {
        wp_send_json_error(array('message' => 'Security check failed. Please refresh and try again.'), 403);
    }

    $full_name = sanitize_text_field(wp_unslash($_POST['full_name'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $phone = sanitize_text_field(wp_unslash($_POST['phone'] ?? ''));
    $event_type = sanitize_text_field(wp_unslash($_POST['event_type'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));

    if (!$full_name || !$email || !is_email($email) || !$event_type) {
        wp_send_json_error(array('message' => 'Please complete all required fields.'));
    }

    $rate_key = 'da_contact_rl_' . md5(strtolower($email));
    if (!da_catering_yyc_child_rate_limit($rate_key, 5, HOUR_IN_SECONDS)) {
        wp_send_json_error(array('message' => 'Too many attempts. Please try again later.'));
    }

    $subject = 'New website contact request';
    $body = '<p><strong>Name:</strong> ' . esc_html($full_name) . '</p>'
        . '<p><strong>Email:</strong> ' . esc_html($email) . '</p>'
        . '<p><strong>Phone:</strong> ' . esc_html($phone ?: 'N/A') . '</p>'
        . '<p><strong>Event Type:</strong> ' . esc_html($event_type) . '</p>'
        . '<p><strong>Message:</strong><br>' . nl2br(esc_html($message ?: 'N/A')) . '</p>';

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . $full_name . ' <' . $email . '>',
    );

    $sent = wp_mail('deb@dacatering.ca', $subject, $body, $headers);
    if ($sent) {
        wp_send_json_success(array('message' => 'Thanks! We received your message and will respond soon.'));
    }

    wp_send_json_error(array('message' => 'Unable to send your message. Please try again.'));
}
add_action('wp_ajax_da_contact_submit', 'da_catering_yyc_child_handle_contact_submit');
add_action('wp_ajax_nopriv_da_contact_submit', 'da_catering_yyc_child_handle_contact_submit');

function da_catering_yyc_child_get_cart_token($create = true) {
    $cookie_name = 'da_cart_token';
    $token = isset($_COOKIE[$cookie_name]) ? sanitize_text_field(wp_unslash($_COOKIE[$cookie_name])) : '';
    if (!$token && $create) {
        $token = bin2hex(random_bytes(16));
        setcookie($cookie_name, $token, array(
            'expires' => time() + DAY_IN_SECONDS * 7,
            'path' => '/',
            'secure' => is_ssl(),
            'httponly' => false,
            'samesite' => 'Lax',
        ));
    }
    return $token;
}

function da_catering_yyc_child_sanitize_cart_items($raw_items) {
    if (!is_array($raw_items)) {
        return array();
    }
    $items = array();
    foreach ($raw_items as $item) {
        if (!is_array($item)) {
            continue;
        }
        $name = sanitize_text_field($item['name'] ?? '');
        if ($name === '') {
            continue;
        }
        $price = is_numeric($item['price'] ?? null) ? (float) $item['price'] : 0.0;
        $qty = is_numeric($item['qty'] ?? null) ? max(1, (int) $item['qty']) : 1;
        $notes = sanitize_text_field($item['notes'] ?? '');
        $items[] = array(
            'name' => $name,
            'price' => $price,
            'qty' => $qty,
            'notes' => $notes,
        );
    }
    return $items;
}

function da_catering_yyc_child_handle_cart_save() {
    $nonce = isset($_POST['nonce']) ? sanitize_text_field(wp_unslash($_POST['nonce'])) : '';
    if (!$nonce || !wp_verify_nonce($nonce, 'da_cart_action')) {
        wp_send_json_error(array('message' => 'Security check failed.'), 403);
    }
    $raw_items = isset($_POST['items']) ? json_decode(wp_unslash($_POST['items']), true) : array();
    $items = da_catering_yyc_child_sanitize_cart_items($raw_items);
    $token = da_catering_yyc_child_get_cart_token(true);
    if (!$token) {
        wp_send_json_error(array('message' => 'Unable to create cart token.'), 500);
    }
    set_transient('da_cart_' . $token, $items, DAY_IN_SECONDS * 7);
    wp_send_json_success(array('token' => $token, 'count' => count($items)));
}
add_action('wp_ajax_da_cart_save', 'da_catering_yyc_child_handle_cart_save');
add_action('wp_ajax_nopriv_da_cart_save', 'da_catering_yyc_child_handle_cart_save');

function da_catering_yyc_child_handle_cart_fetch() {
    $nonce = isset($_POST['nonce']) ? sanitize_text_field(wp_unslash($_POST['nonce'])) : '';
    if (!$nonce || !wp_verify_nonce($nonce, 'da_cart_action')) {
        wp_send_json_error(array('message' => 'Security check failed.'), 403);
    }
    $token = isset($_POST['token']) ? sanitize_text_field(wp_unslash($_POST['token'])) : '';
    if ($token === '') {
        $token = da_catering_yyc_child_get_cart_token(false);
    }
    if (!$token) {
        wp_send_json_success(array('items' => array()));
    }
    $items = get_transient('da_cart_' . $token);
    if (!is_array($items)) {
        $items = array();
    }
    if (!isset($_COOKIE['da_cart_token']) && $token) {
        setcookie('da_cart_token', $token, array(
            'expires' => time() + DAY_IN_SECONDS * 7,
            'path' => '/',
            'secure' => is_ssl(),
            'httponly' => false,
            'samesite' => 'Lax',
        ));
    }
    wp_send_json_success(array('items' => $items, 'token' => $token));
}
add_action('wp_ajax_da_cart_fetch', 'da_catering_yyc_child_handle_cart_fetch');
add_action('wp_ajax_nopriv_da_cart_fetch', 'da_catering_yyc_child_handle_cart_fetch');

function da_catering_yyc_child_handle_order_submit() {
    $nonce = isset($_POST['nonce']) ? sanitize_text_field(wp_unslash($_POST['nonce'])) : '';
    if (!$nonce || !wp_verify_nonce($nonce, 'da_order_submit')) {
        wp_send_json_error(array('message' => 'Security check failed. Please refresh and try again.'), 403);
    }

    $honeypot = isset($_POST['order_company']) ? sanitize_text_field(wp_unslash($_POST['order_company'])) : '';
    if ($honeypot !== '') {
        wp_send_json_success(array('message' => 'Order received.'));
    }

    $order = array(
        'order_name' => sanitize_text_field(wp_unslash($_POST['order_name'] ?? '')),
        'order_email' => sanitize_email(wp_unslash($_POST['order_email'] ?? '')),
        'order_phone' => sanitize_text_field(wp_unslash($_POST['order_phone'] ?? '')),
        'fulfillment' => sanitize_text_field(wp_unslash($_POST['fulfillment'] ?? 'pickup')),
        'order_time' => sanitize_text_field(wp_unslash($_POST['order_time'] ?? '')),
        'delivery_address' => sanitize_textarea_field(wp_unslash($_POST['delivery_address'] ?? '')),
        'order_notes' => sanitize_textarea_field(wp_unslash($_POST['order_notes'] ?? '')),
    );

    if (!$order['order_name'] || !$order['order_email'] || !$order['order_phone']) {
        wp_send_json_error(array('message' => 'Please complete all required fields.'));
    }

    $rate_key = 'da_order_rl_' . md5(strtolower($order['order_email'] ?: 'unknown'));
    if (!da_catering_yyc_child_rate_limit($rate_key, 10, HOUR_IN_SECONDS)) {
        wp_send_json_error(array('message' => 'Too many attempts. Please try again later.'));
    }

    $items_json = wp_unslash($_POST['items'] ?? '');
    $items = json_decode($items_json, true);
    if (!is_array($items) || empty($items)) {
        wp_send_json_error(array('message' => 'Your order is empty. Please add items.'));
    }

    $promo_meta_raw = wp_unslash($_POST['promo_meta'] ?? '');
    $promo_meta = $promo_meta_raw ? json_decode($promo_meta_raw, true) : null;
    $promo_allowed = array();
    if (is_array($promo_meta) && !empty($promo_meta['id'])) {
        $promo_id = (int) $promo_meta['id'];
        $promo_title = get_the_title($promo_id);
        $promo_price = get_post_meta($promo_id, '_da_promo_price', true);
        if ($promo_title && $promo_price !== '') {
            $promo_allowed[$promo_title] = (float) $promo_price;
        }
    }

    $price_list = da_catering_yyc_child_get_menu_prices();
    $validated_items = array();

    $subtotal = 0;
    foreach ($items as $item) {
        $name = isset($item['name']) ? sanitize_text_field($item['name']) : '';
        $qty = (int) ($item['qty'] ?? 1);
        if ($qty < 1) {
            $qty = 1;
        }
        if (!$name) {
            continue;
        }

        if (isset($promo_allowed[$name])) {
            $price = (float) $promo_allowed[$name];
        } elseif (isset($price_list[$name])) {
            $price = (float) $price_list[$name];
        } else {
            wp_send_json_error(array('message' => 'One or more items are unavailable. Please refresh the menu and try again.'));
        }

        $subtotal += $qty * $price;
        $validated_items[] = array(
            'name' => $name,
            'qty' => $qty,
            'price' => $price,
            'notes' => isset($item['notes']) ? sanitize_text_field($item['notes']) : '',
        );
    }

    $order_title = 'Order - ' . $order['order_name'] . ' - ' . current_time('Y-m-d H:i');
    $order_id = wp_insert_post(array(
        'post_type' => 'da_order',
        'post_status' => 'publish',
        'post_title' => $order_title,
    ));

    if (is_wp_error($order_id) || !$order_id) {
        wp_send_json_error(array('message' => 'Sorry, something went wrong. Please try again.'));
    }

    $token = bin2hex(random_bytes(16));
    $paid_token = bin2hex(random_bytes(16));
    update_post_meta($order_id, '_da_order_data', $order);
    update_post_meta($order_id, '_da_order_items', $validated_items);
    update_post_meta($order_id, '_da_order_subtotal', $subtotal);
    update_post_meta($order_id, '_da_order_receipt_token', $token);
    update_post_meta($order_id, '_da_order_receipt_sent', 0);
    update_post_meta($order_id, '_da_order_paid_token', $paid_token);
    update_post_meta($order_id, '_da_order_paid', 0);
    $status_token = bin2hex(random_bytes(16));
    update_post_meta($order_id, '_da_order_status', 'received');
    update_post_meta($order_id, '_da_order_status_token', $status_token);

    da_catering_yyc_child_send_order_confirmation($order_id, $order, $validated_items, $subtotal);
    da_catering_yyc_child_send_order_admin_notice($order_id, $order, $validated_items, $subtotal);
    da_catering_yyc_child_get_or_create_subscriber($order['order_email'], 'order');

    delete_transient($rate_key);
    wp_send_json_success(array('message' => 'Order received.'));
}
add_action('wp_ajax_da_order_submit', 'da_catering_yyc_child_handle_order_submit');
add_action('wp_ajax_nopriv_da_order_submit', 'da_catering_yyc_child_handle_order_submit');

function da_catering_yyc_child_handle_order_receipt() {
    $token = isset($_GET['da_order_receipt']) ? sanitize_text_field(wp_unslash($_GET['da_order_receipt'])) : '';
    if (!$token) {
        return;
    }
    $query = new WP_Query(array(
        'post_type' => 'da_order',
        'post_status' => 'publish',
        'meta_key' => '_da_order_receipt_token',
        'meta_value' => $token,
        'posts_per_page' => 1,
    ));

    if (!$query->have_posts()) {
        wp_die('Invalid or expired receipt link.', 'Receipt', array('response' => 404));
    }

    $order_id = $query->posts[0]->ID;
    $already_sent = (int) get_post_meta($order_id, '_da_order_receipt_sent', true);
    if ($already_sent) {
        wp_die('Receipt already sent.', 'Receipt');
    }

    $sent = da_catering_yyc_child_send_order_receipt($order_id);
    if ($sent) {
        update_post_meta($order_id, '_da_order_receipt_sent', 1);
        update_post_meta($order_id, '_da_order_receipt_sent_at', current_time('mysql'));
        wp_die('Receipt sent successfully.', 'Receipt');
    }

    wp_die('Failed to send receipt. Please try again.', 'Receipt', array('response' => 500));
}
add_action('template_redirect', 'da_catering_yyc_child_handle_order_receipt');

function da_catering_yyc_child_handle_order_paid() {
    $token = isset($_GET['da_order_paid']) ? sanitize_text_field(wp_unslash($_GET['da_order_paid'])) : '';
    if (!$token) {
        return;
    }
    $query = new WP_Query(array(
        'post_type' => 'da_order',
        'post_status' => 'publish',
        'meta_key' => '_da_order_paid_token',
        'meta_value' => $token,
        'posts_per_page' => 1,
    ));

    if (!$query->have_posts()) {
        wp_die('Invalid or expired link.', 'Order Status', array('response' => 404));
    }

    $order_id = $query->posts[0]->ID;
    $already_paid = (int) get_post_meta($order_id, '_da_order_paid', true);
    if ($already_paid) {
        wp_die('Order already marked as paid.', 'Order Status');
    }

    update_post_meta($order_id, '_da_order_paid', 1);
    update_post_meta($order_id, '_da_order_paid_at', current_time('mysql'));
    da_catering_yyc_child_send_order_status_email($order_id, 'paid');
    wp_die('Order marked as paid.', 'Order Status');
}
add_action('template_redirect', 'da_catering_yyc_child_handle_order_paid');

function da_catering_yyc_child_handle_order_status() {
    $token = isset($_GET['da_order_status']) ? sanitize_text_field(wp_unslash($_GET['da_order_status'])) : '';
    $status = isset($_GET['status']) ? sanitize_text_field(wp_unslash($_GET['status'])) : '';
    if (!$token || !$status) {
        return;
    }
    $allowed = array('confirmed', 'in_progress', 'ready');
    if (!in_array($status, $allowed, true)) {
        wp_die('Invalid status.', 'Order Status', array('response' => 400));
    }

    $query = new WP_Query(array(
        'post_type' => 'da_order',
        'post_status' => 'publish',
        'meta_key' => '_da_order_status_token',
        'meta_value' => $token,
        'posts_per_page' => 1,
    ));

    if (!$query->have_posts()) {
        wp_die('Invalid or expired link.', 'Order Status', array('response' => 404));
    }

    $order_id = $query->posts[0]->ID;
    update_post_meta($order_id, '_da_order_status', $status);
    update_post_meta($order_id, '_da_order_status_updated_at', current_time('mysql'));
    da_catering_yyc_child_send_order_status_email($order_id, $status);
    wp_die('Order status updated.', 'Order Status');
}
add_action('template_redirect', 'da_catering_yyc_child_handle_order_status');
