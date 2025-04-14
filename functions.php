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
?>

<?php
function add_style()
{
  wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css', false);
}
add_action('wp_enqueue_scripts', 'add_style');

function add_script()
{
  wp_enqueue_script('main-js', get_template_directory_uri() . '/main.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'add_script');
?>

<?php
function custom_register_nav_menu()
{
  register_nav_menus(array(
    'primary_menu' => 'Menu principal',
  ));
}
add_action('after_setup_theme', 'custom_register_nav_menu', 0);
?>

<?php
// ADD MENU OPTION PAGE
//acf_add_options_page();
?>