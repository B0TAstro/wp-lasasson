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
  acf_add_options_page(array(
      'page_title'    => 'Options Header/Footer',
      'menu_title'    => 'Header/Footer',
      'menu_slug'     => 'header-footer-options',
      'capability'    => 'edit_posts',
      'redirect'      => false,
      'icon_url'      => 'dashicons-admin-generic',
      'position'      => 60,
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

// FUNCTION Charger plus d'actu
function load_more_actus() {
  $page = $_POST['page'];
  
  $args = array(
      'post_type' => 'post',
      'posts_per_page' => 5,
      'paged' => $page,
      'post_status' => 'publish'
  );
  
  $actus_query = new WP_Query($args);
  
  if ($actus_query->have_posts()) :
      while ($actus_query->have_posts()) : $actus_query->the_post();
          ?>
          <div class="actu-card">
              <div class="actu-header">
                  <h3><?php echo get_the_title(); ?></h3>
                  <span class="actu-date"><?php echo get_the_date('d.m.Y'); ?></span>
              </div>
              
              <div class="actu-content">
                  <?php if (has_post_thumbnail()) : ?>
                      <div class="actu-image">
                          <?php the_post_thumbnail('medium'); ?>
                      </div>
                  <?php endif; ?>
                  
                  <div class="actu-text">
                      <?php the_excerpt(); ?>
                      <a href="<?php the_permalink(); ?>" class="btn-savoir">En savoir +</a>
                  </div>
              </div>
          </div>
          <?php
      endwhile;
      wp_reset_postdata();
  endif;
  
  die();
}
add_action('wp_ajax_load_more_actus', 'load_more_actus');
add_action('wp_ajax_nopriv_load_more_actus', 'load_more_actus');

// FUNCTION Charger plus d'articles de presse via AJAX
function load_more_presse() {
  // $page variable removed as it's not being used
  $loaded = $_POST['loaded'];
  $per_page = $_POST['per_page'];
  
  $articles_presse = get_field('section3', get_the_ID())['articles_presse'];
  
  $start_index = $loaded;
  $end_index = min($loaded + $per_page, count($articles_presse));
  
  for ($i = $start_index; $i < $end_index; $i++) {
      $article = $articles_presse[$i];
      $image = $article['image_article'];
      $lien = $article['lien_article'];
      ?>
      <div class="presse-item">
          <a href="<?php echo esc_url($lien); ?>" target="_blank" class="presse-link">
              <?php if ($image) : ?>
                  <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="presse-image">
              <?php endif; ?>
              <span class="presse-overlay">+ LINK</span>
          </a>
      </div>
      <?php
  }
  die();
}
add_action('wp_ajax_load_more_presse', 'load_more_presse');
add_action('wp_ajax_nopriv_load_more_presse', 'load_more_presse');

// FUNCTIONS DEBUG
// Fonction qui permet d'afficher le contenue d'une varible de mainière lisible
function p($args){
  echo '<pre>';
  var_dump($args);
  echo '</pre>';
}
// Se base sur p mais ajoute un die() pour stopper l'execution du script
function d($args){
  p($args);
  die();
}
?>