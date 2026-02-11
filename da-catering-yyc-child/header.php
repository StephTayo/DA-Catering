<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://images.unsplash.com">
  <?php
    $da_logo_path = get_stylesheet_directory() . '/assets/img/DA Catering Logo.png';
    $da_logo_ver = file_exists($da_logo_path) ? filemtime($da_logo_path) : wp_get_theme()->get('Version');
    $da_logo_url = get_stylesheet_directory_uri() . '/assets/img/DA Catering Logo.png?v=' . $da_logo_ver;

    $da_favicon_32_path = get_stylesheet_directory() . '/assets/img/favicon-32x32.png';
    $da_favicon_32_ver = file_exists($da_favicon_32_path) ? filemtime($da_favicon_32_path) : wp_get_theme()->get('Version');
    $da_favicon_32 = get_stylesheet_directory_uri() . '/assets/img/favicon-32x32.png?v=' . $da_favicon_32_ver;

    $da_apple_touch_path = get_stylesheet_directory() . '/assets/img/apple-touch-icon.png';
    $da_apple_touch_ver = file_exists($da_apple_touch_path) ? filemtime($da_apple_touch_path) : wp_get_theme()->get('Version');
    $da_apple_touch = get_stylesheet_directory_uri() . '/assets/img/apple-touch-icon.png?v=' . $da_apple_touch_ver;

    $da_icon_512_path = get_stylesheet_directory() . '/assets/img/icon-512x512.png';
    $da_icon_512_ver = file_exists($da_icon_512_path) ? filemtime($da_icon_512_path) : wp_get_theme()->get('Version');
    $da_icon_512 = get_stylesheet_directory_uri() . '/assets/img/icon-512x512.png?v=' . $da_icon_512_ver;
  ?>
  <link rel="icon" href="<?php echo esc_url($da_favicon_32); ?>" sizes="32x32">
  <link rel="apple-touch-icon" href="<?php echo esc_url($da_apple_touch); ?>" sizes="180x180">
  <link rel="icon" href="<?php echo esc_url($da_icon_512); ?>" sizes="512x512">
  <?php if (is_front_page()) : ?>
    <title>African Catering Calgary | DA Catering YYC | Authentic West African Food</title>
    <meta name="description" content="Order authentic African catering in Calgary. 100+ dishes including Jollof rice, Egusi soup, Suya, smoothies & more. Perfect for events, families & corporate lunches. Delivery available.">
    <link rel="preload" as="image" href="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?auto=format&fit=crop&w=900&q=80" fetchpriority="high">
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": ["LocalBusiness", "Restaurant"],
        "name": "DA Catering YYC",
        "url": "<?php echo esc_url(home_url('/')); ?>",
        "telephone": "+1-403-478-2475",
        "image": "<?php echo esc_url($da_logo_url); ?>",
        "address": {
          "@type": "PostalAddress",
          "addressLocality": "Calgary",
          "addressRegion": "AB",
          "addressCountry": "CA"
        },
        "areaServed": "Calgary, Alberta",
        "servesCuisine": ["African", "West African"],
        "sameAs": [
          "https://instagram.com/dacateringyyc"
        ]
      }
    </script>
  <?php else : ?>
    <title>Book African Catering in Calgary | Order Online | DA Catering YYC</title>
    <meta name="description" content="Book African catering for your Calgary event or place your order online. Fast delivery, authentic flavors, customizable menus. DA Catering YYC serves 5-100+ guests.">
  <?php endif; ?>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="header">
  <div class="container header-inner">
    <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
      <?php if (has_custom_logo()) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <img src="<?php echo esc_url($da_logo_url); ?>" alt="DA Catering YYC logo">
      <?php endif; ?>
      <span class="logo-text">DA Catering YYC</span>
    </a>
    <nav class="nav" data-nav>
      <a href="<?php echo esc_url(home_url('/')); ?>#home">Home</a>
      <a href="<?php echo esc_url(home_url('/')); ?>#menu">Menu</a>
      <a href="<?php echo esc_url(home_url('/')); ?>#catering">Catering</a>
    </nav>
    <div class="header-actions" data-actions>
      <a class="btn btn-primary" href="https://wa.me/14034782475?text=Hi%20DA%20Catering%20YYC,%20I'd%20like%20to%20place%20an%20order.%20My%20order%20details%20are:%20____" target="_blank" rel="noopener">Order on WhatsApp</a>
      <a class="btn btn-secondary" href="<?php echo esc_url(home_url('/booking/#checkout')); ?>">Place Order Now</a>
    </div>
    <button class="mobile-toggle" type="button" data-mobile-toggle aria-label="Toggle navigation">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>
