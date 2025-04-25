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
  wp_localize_script('load-more-js', 'ajaxVars', [
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'nonce'   => wp_create_nonce('load_more_nonce'),
  ]);

  wp_localize_script('js-bundle', 'WP', array(
    'ajaxUrl'    => admin_url('admin-ajax.php'),
    'nonce'      => wp_create_nonce(),
    'root'       => esc_url_raw(rest_url()),
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

// ================= Fonction AJAX pour tous les formulaires =================
add_action('wp_ajax_send_dynamic_form', 'send_dynamic_form');
add_action('wp_ajax_nopriv_send_dynamic_form', 'send_dynamic_form');

function send_dynamic_form()
{
  $fields = [
    'nom',
    'prenom',
    'email',
    'telephone',
    'objet',
    'service',
    'message',
    'consent'
  ];

  foreach ($fields as $field) {
    $$field = sanitize_text_field($_POST[$field] ?? '');
  }

  if (!$nom || !$prenom || !$email || !$objet || !$service || !$message || !$consent) {
    wp_send_json_error('Tous les champs obligatoires doivent être remplis.');
  }

  $headers = [
    'Content-Type: text/html; charset=UTF-8',
    "From: Site Web - Formulaire de Contact<tom@famille-boullay.fr>", // Remplacez par l'email de l'expéditeur
    "Reply-To: $email"
  ];
  $subject = "Nouveau message du formulaire de contact - $objet";
  $body = <<<HTML
  <html>
    <body>
      <p>Bonjour,</p>
      <p>Vous avez reçu un nouveau message depuis le formulaire de contact du site <strong>La Sasson</strong> :</p>
      <br><hr><br>

      <table cellpadding="5" cellspacing="0" border="0" style="margin-top: 10px;">
      <p><strong>De la part de :</strong> $nom $prenom</p>
      <p><strong>Téléphone :</strong> $telephone</p>
      <p><strong>Objet :</strong> $objet</p>

      <p style="margin-top: 20px;"><strong>Message :</strong></p>
      <div style="margin-left: 30px; padding: 10px; background-color: #f9f9f9; border-left: 5px solid #FFCA23;">
        <p style="white-space: pre-line;">$message</p>
      </div>

      <br><hr><br>
      <p style="margin-top: 30px;">Vous pouvez répondre à cette personne via cet e-mail ➝ <a href="mailto:$email">$email</a></p>
    </body>
  </html>
  HTML;

  $sent = wp_mail($service, $subject, $body, $headers);

  $user_subject = "Nous avons bien reçu votre message";

  $user_body = <<<HTML
  <html>
    <body>
      <p>Bonjour $prenom $nom,</p>
      <p>Merci d’avoir pris contact avec nous via le formulaire du site web de <strong>La Sasson</strong>.</p>
      <p>Votre message a bien été transmis à notre service. Nous reviendrons vers vous dans les meilleurs délais en fonction de votre demande.</p>
      <p>En attendant, vous pouvez retrouver plus d’informations sur la Sasson sur notre site internet.</p>
      <p style="margin-top: 30px;">Belle journée à vous,<br>
      <strong>L’équipe La Sasson</strong></p>
    </body>
  </html>
  HTML;

  $user_headers = [
    'Content-Type: text/html; charset=UTF-8',
    "From: Association La Sasson<tom@famille-boullay.fr>", // Remplacez par l'email de l'expéditeur
  ];

  wp_mail($email, $user_subject, $user_body, $user_headers);

  if ($sent) {
    wp_send_json_success("Votre message a bien été envoyé.");
  } else {
    wp_send_json_error("Erreur lors de l'envoi du message. Vérifiez les logs ou les paramètres SMTP.");
  }
}

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
add_action('wp_ajax_load_more_presse', 'load_more_presse');
add_action('wp_ajax_nopriv_load_more_presse', 'load_more_presse');

function load_more_presse()
{
  check_ajax_referer('load_more_nonce');

  $loaded   = isset($_POST['loaded']) ? intval($_POST['loaded']) : 0;
  $per_page = isset($_POST['per_page']) ? intval($_POST['per_page']) : 3;

  $page_id = isset($_POST['page_id']) ? intval($_POST['page_id']) : get_option('page_on_front');
  $section3 = get_field('section3', $page_id);
  $articles = $section3['articles_presse'];

  if (!$articles || !is_array($articles)) {
    wp_send_json_error('Aucun article trouvé');
  }

  $start = $loaded;
  $end   = min($start + $per_page, count($articles));

  ob_start();

  for ($i = $start; $i < $end; $i++) {
    if (!isset($articles[$i])) continue;
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
        <div class="overlay">
          <p class="article-title"><?php echo esc_html($titre_article); ?></p>
        </div>
      </a>
    </div>
<?php
  }

  $html = ob_get_clean();
  wp_send_json_success($html);
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