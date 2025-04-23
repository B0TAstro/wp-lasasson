<?php
// Enqueue styles/scripts + localisation AJAX
add_action('wp_enqueue_scripts', 'load_scripts_and_style');
function load_scripts_and_style()
{
  $template_directory_uri = get_template_directory_uri();

  wp_enqueue_style('theme-style', $template_directory_uri . '/style.css', [], filemtime(get_template_directory() . '/style.css'));

  if (file_exists(get_template_directory() . '/dist/main.css')) {
    wp_enqueue_style('styles-bundle', $template_directory_uri . '/dist/main.css', [], filemtime(get_template_directory() . '/dist/main.css'));
  }

  if (file_exists(get_template_directory() . '/dist/main.js')) {
    wp_enqueue_script('js-bundle', $template_directory_uri . '/dist/main.js', ['jquery'], filemtime(get_template_directory() . '/dist/main.js'), true);
  }

  // AJAX load-more.js script
  wp_enqueue_script('load-more-js', $template_directory_uri . '/src/js/load-more.js', ['jquery'], null, true);
  wp_localize_script('load-more-js', 'ajaxVars', array(
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'nonce'   => wp_create_nonce('load_more_nonce'),
  ));

  wp_localize_script('js-bundle', 'WP', array(
    'root'       => esc_url_raw(rest_url()),
    'nonce'      => wp_create_nonce(),
    'base'       => get_site_url(),
    'publicPath' => $template_directory_uri . "/dist/",
  ));
}

// Enregistrer les menus
add_action('after_setup_theme', 'custom_register_nav_menu', 0);
function custom_register_nav_menu()
{
  register_nav_menus(array(
    'primary_menu' => 'Menu principal',
  ));
}

// Options ACF
if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title'  => 'Options Header/Footer',
    'menu_title'  => 'Header/Footer',
    'menu_slug'   => 'header-footer-options',
    'capability'  => 'edit_posts',
    'redirect'    => false,
    'icon_url'    => 'dashicons-admin-generic',
    'position'    => 60,
  ));
}

// Thème supports
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('html5', array(
  'search-form',
  'comment-form',
  'comment-list',
  'gallery',
  'caption',
));

// ================= AJAX ACTUALITÉS =================
add_action('wp_ajax_load_more_actus', 'load_more_actus');
add_action('wp_ajax_nopriv_load_more_actus', 'load_more_actus');
function load_more_actus()
{
  check_ajax_referer('load_more_nonce');

  $page = intval($_POST['page']);

  $args = array(
    'post_type'      => 'post',
    'posts_per_page' => 5,
    'paged'          => $page,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
      // Tu peux aussi utiliser get_template_part()
?>
      <article class="news-item <?php echo has_post_thumbnail() ? 'has-thumbnail' : 'no-thumbnail'; ?>">
        <?php if (has_post_thumbnail()) : ?>
          <div class="news-content">
            <div>
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <div class="news-date"><?php echo get_the_date(); ?></div>
              <div class="news-excerpt"><?php the_excerpt(); ?></div>
            </div>
            <a href="<?php the_permalink(); ?>" class="news-link">Lire la suite</a>
          </div>
          <div class="news-thumbnail">
            <a href="<?php the_permalink(); ?>">
              <?php echo get_the_post_thumbnail(get_the_ID(), 'medium'); ?>
            </a>
          </div>
        <?php else : ?>
          <div class="news-content">
            <div>
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <div class="news-date"><?php echo get_the_date(); ?></div>
              <div class="news-excerpt"><?php the_excerpt(); ?></div>
            </div>
            <a href="<?php the_permalink(); ?>" class="news-link">Lire la suite</a>
          </div>
        <?php endif; ?>
      </article>
    <?php
    endwhile;
    wp_reset_postdata();
  endif;

  wp_die();
}

// ================= AJAX PRESSE =================
function load_more_presse()
{
  check_ajax_referer('load_more_nonce');

  $loaded   = intval($_POST['loaded']);
  $per_page = intval($_POST['per_page']);

  $section3 = get_field('section3', get_the_ID());
  $articles = $section3['articles_presse'];

  if (!$articles || !is_array($articles)) wp_die();

  $start = $loaded;
  $end   = min($start + $per_page, count($articles));

  for ($i = $start; $i < $end; $i++) {
    $article = $articles[$i];
    $image = $article['image_article'];
    $lien = $article['lien_article'];
    $titre_article = $article['titre_article'];
    ?>
    <div class="presse-item">
      <a href="<?php echo esc_url($lien); ?>" target="_blank" class="presse-link">
        <?php if ($image) : ?>
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="presse-image">
        <?php else : ?>
          <img class="presse-placeholder" src="<?php echo get_template_directory_uri(); ?>/assets/img/pdf-press-icon.png" alt="Cover">
        <?php endif; ?>
        <p class="article-title"><?php echo esc_html($titre_article); ?></p>
        <span class="presse-overlay"></span>
      </a>
    </div>
<?php
  }

  wp_die(); 
}

// ================= DEBUG HELPERS =================
function p($args)
{
  echo '<pre>';
  var_dump($args);
  echo '</pre>';
}
function d($args)
{
  p($args);
  die();
}
?>