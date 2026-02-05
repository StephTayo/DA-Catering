<?php
get_header();

if (is_front_page()) {
    $page_path = "index";
} else {
    $page_path = "booking";
}

$theme_root = get_stylesheet_directory();
$page_file = $theme_root . "/templates/{$page_path}.php";

if (!file_exists($page_file)) {
    $page_file = get_template_directory() . "/templates/{$page_path}.php";
}

if (file_exists($page_file)) {
    include $page_file;
}

get_footer();
