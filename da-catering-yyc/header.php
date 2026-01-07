<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php if (is_front_page()) : ?>
    <title>African Catering Calgary | DA Catering YYC | Authentic West African Food</title>
    <meta name="description" content="Order authentic African catering in Calgary. 100+ dishes including Jollof rice, Egusi soup, Suya, smoothies & more. Perfect for events, families & corporate lunches. Delivery available.">
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
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/da-catering-logo.jpeg'); ?>" alt="DA Catering YYC logo">
      <?php endif; ?>
      <span class="logo-text">DA Catering YYC</span>
    </a>
    <nav class="nav" data-nav>
      <a href="<?php echo esc_url(home_url('/')); ?>#home">Home</a>
      <a href="<?php echo esc_url(home_url('/')); ?>#menu">Menu</a>
      <a href="<?php echo esc_url(home_url('/')); ?>#catering">Catering</a>
    </nav>
    <div class="header-actions" data-actions>
      <a class="btn btn-primary" href="https://wa.me/14034782475?text=Hi%20DA%20Catering%20YYC,%20I'd%20like%20to%20place%20an%20order.%20My%20name%20is%20____%20and%20my%20order%20details%20are:%20____" target="_blank" rel="noopener">Order on WhatsApp</a>
      <a class="btn btn-secondary" href="<?php echo esc_url(home_url('/shop')); ?>">Place Order Now</a>
    </div>
    <button class="mobile-toggle" type="button" data-mobile-toggle>Menu</button>
  </div>
</header>
