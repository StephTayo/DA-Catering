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
        wp_get_theme()->get('Version')
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
}
add_action('wp_enqueue_scripts', 'da_catering_yyc_child_enqueue_scripts', 20);

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

function da_catering_yyc_child_register_newsletter_table() {
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }

    $option_key = 'da_newsletter_table_created';
    if (get_option($option_key)) {
        return;
    }

    global $wpdb;
    $table = $wpdb->prefix . 'da_newsletter';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE {$table} (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        email VARCHAR(190) NOT NULL,
        created_at DATETIME NOT NULL,
        confirmed_at DATETIME NULL,
        unsubscribed_at DATETIME NULL,
        status VARCHAR(20) NOT NULL DEFAULT 'pending',
        token VARCHAR(64) NOT NULL,
        ip_address VARCHAR(45) NULL,
        user_agent TEXT NULL,
        PRIMARY KEY  (id),
        UNIQUE KEY email (email)
    ) {$charset_collate};";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
    update_option($option_key, 1);
}
add_action('init', 'da_catering_yyc_child_register_newsletter_table');

function da_catering_yyc_child_generate_newsletter_token() {
    return bin2hex(random_bytes(16));
}

function da_catering_yyc_child_send_confirmation_email($email, $token) {
    $confirm_url = home_url('/?da_newsletter_confirm=' . urlencode($token));
    $unsub_url = home_url('/?da_newsletter_unsub=' . urlencode($token));
    $subject = 'Confirm your newsletter subscription';
    $brand = 'DA Catering YYC';
    $message = '
      <div style="background:#f7f4ee;padding:24px 0;font-family:Arial, sans-serif;color:#1f3d34;">
        <div style="max-width:560px;margin:0 auto;background:#ffffff;border-radius:16px;padding:28px;border:1px solid rgba(31,61,52,0.12);">
          <h2 style="margin:0 0 12px;font-size:22px;color:#1f3d34;">Confirm your subscription</h2>
          <p style="margin:0 0 16px;color:#4a5650;line-height:1.6;">Thanks for subscribing to ' . esc_html($brand) . '. Please confirm your email by clicking the button below.</p>
          <p style="margin:24px 0;">
            <a href="' . esc_url($confirm_url) . '" style="display:inline-block;padding:12px 20px;background:#d46a1f;color:#ffffff;text-decoration:none;border-radius:999px;font-weight:600;">Confirm subscription</a>
          </p>
          <p style="margin:0 0 16px;color:#4a5650;line-height:1.6;">If you did not request this, you can ignore this email.</p>
          <p style="margin:0;color:#6b7280;font-size:12px;">Unsubscribe anytime: <a href="' . esc_url($unsub_url) . '" style="color:#6b7280;">' . esc_html($unsub_url) . '</a></p>
        </div>
        <p style="text-align:center;margin:16px 0 0;color:#9aa3a0;font-size:12px;">&copy; ' . date('Y') . ' ' . esc_html($brand) . '</p>
      </div>
    ';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($email, $subject, $message, $headers);
}

function da_catering_yyc_child_handle_newsletter_subscribe() {
    $nonce = isset($_POST['nonce']) ? sanitize_text_field(wp_unslash($_POST['nonce'])) : '';
    if (!$nonce || !wp_verify_nonce($nonce, 'da_newsletter_subscribe')) {
        wp_send_json_error(array('message' => 'Security check failed. Please refresh and try again.'), 403);
    }

    $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $honeypot = isset($_POST['company']) ? sanitize_text_field(wp_unslash($_POST['company'])) : '';

    if ($honeypot !== '') {
        wp_send_json_success(array('message' => 'Thanks! Please check your email to confirm.'));
    }

    if (!$email || !is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
    }

    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $rate_key = 'da_newsletter_rl_' . md5($ip);
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
        $wpdb->update(
            $table,
            array(
                'status' => 'pending',
                'token' => $token,
                'unsubscribed_at' => null,
            ),
            array('id' => $existing->id),
            array('%s', '%s', '%s'),
            array('%d')
        );
        da_catering_yyc_child_send_confirmation_email($email, $token);
        wp_send_json_success(array('message' => 'Check your email to confirm your subscription.'));
    }

    $token = da_catering_yyc_child_generate_newsletter_token();
    $inserted = $wpdb->insert(
        $table,
        array(
            'email' => $email,
            'created_at' => current_time('mysql'),
            'status' => 'pending',
            'token' => $token,
            'ip_address' => $ip,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s')
    );

    if (!$inserted) {
        wp_send_json_error(array('message' => 'Sorry, something went wrong. Please try again.'));
    }

    da_catering_yyc_child_send_confirmation_email($email, $token);

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
        $wpdb->update(
            $table,
            array(
                'status' => 'confirmed',
                'confirmed_at' => current_time('mysql'),
                'unsubscribed_at' => null,
            ),
            array('id' => $row->id),
            array('%s', '%s', '%s'),
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
