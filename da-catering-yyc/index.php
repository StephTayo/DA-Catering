<?php get_header(); ?>

<?php
if (is_front_page()) {
    $page_path = "index";
} else {
    $page_path = "booking";
}

$theme_root = get_template_directory();
$page_file = $theme_root . "/templates/{$page_path}.php";

if (file_exists($page_file)) {
    include $page_file;
}
?>

<?php get_footer(); ?>
