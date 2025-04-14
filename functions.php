<?php
add_action('wp_enqueue_scripts', 'load_scripts_and_style');

function load_scripts_and_style()
{
  $template_directory_uri = get_template_directory_uri();
  wp_enqueue_style('theme-style', $template_directory_uri . '/style.css', [], filemtime(get_template_directory() . '/style.css'));

  if (file_exists(get_template_directory() . '/dist/main.css')) {
    wp_enqueue_style('styles-bundle', $template_directory_uri . '/dist/main.css', [], filemtime(get_template_directory() . '/dist/main.css'));
  }

  if (file_exists(get_template_directory() . '/dist/main.js')) {
    wp_enqueue_script('js-bundle', $template_directory_uri . '/dist/main.js', [], filemtime(get_template_directory() . '/dist/main.js'), true);
  }

  wp_localize_script('js-bundle', 'WP', array(
    'root' => esc_url_raw(rest_url()),
    'nonce' => wp_create_nonce(),
    'base' => get_site_url(),
    'publicPath' => $template_directory_uri . "/dist/",
  ));
}

function custom_register_nav_menu()
{
  register_nav_menus(array(
    'primary_menu' => 'Menu principal',
  ));
}
add_action('after_setup_theme', 'custom_register_nav_menu', 0);

// ADD MENU OPTION PAGES
if (function_exists('acf_add_options_page')) {
  // Page d'options directe pour Header/Footer (sans page parent)
  acf_add_options_page(array(
      'page_title'    => 'Options Header/Footer',
      'menu_title'    => 'Options Header/Footer',
      'menu_slug'     => 'header-footer-options',
      'capability'    => 'edit_posts',
      'icon_url'      => 'dashicons-admin-generic',
      'position'      => 59
  ));
}

add_theme_support('post-thumbnails');

add_theme_support('title-tag');

add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
));
?>