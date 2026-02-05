<?php
/*
Template Name: Booking Page
*/
add_filter('body_class', function ($classes) {
  $classes[] = 'booking-page';
  return $classes;
});
get_header();
include get_stylesheet_directory() . '/templates/booking.php';
get_footer();
