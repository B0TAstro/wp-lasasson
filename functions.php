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

// Custom Post Type "Offre d'emploi"
add_action('init', function () {
  register_post_type('offre_emploi', [
    'labels' => [
      'name'               => 'Offres d\'emploi',
      'singular_name'      => 'Offre d\'emploi',
      'add_new'            => 'Ajouter une offre',
      'add_new_item'       => 'Ajouter une offre d\'emploi',
      'edit_item'          => 'Modifier l\'offre',
      'new_item'           => 'Nouvelle offre',
      'view_item'          => 'Voir l\'offre',
      'search_items'       => 'Rechercher une offre',
      'not_found'          => 'Aucune offre trouvée',
      'not_found_in_trash' => 'Aucune offre dans la corbeille',
      'all_items'          => 'Toutes les offres',
      'menu_name'          => 'Offres d\'emploi',
    ],
    'public'             => true,
    'has_archive'        => true,
    'rewrite'            => ['slug' => 'offre-emploi'],
    'menu_icon'          => 'dashicons-businessman',
    'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
    'show_in_rest'       => true,
    'menu_position'      => 10,
    'publicly_queryable' => true,
  ]);
});
add_action('after_switch_theme', 'flush_rewrite_rules');
// Direct enfant de la page Recrutement
add_action('save_post_offre_emploi', function ($post_id, $post, $update) {
  if (wp_is_post_revision($post_id) || defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

  $recrutement_page = get_page_by_path('recrutement');
  if ($recrutement_page && $post->post_parent != $recrutement_page->ID) {
    wp_update_post([
      'ID' => $post_id,
      'post_parent' => $recrutement_page->ID,
    ]);
  }
}, 10, 3);
// Personnaliser le slug de l'URL
add_filter('wp_insert_post_data', function ($data, $postarr) {
  if ($data['post_type'] === 'offre_emploi' && $data['post_status'] !== 'auto-draft') {
    $slug_base = sanitize_title($data['post_title']);
    $id = $postarr['ID'] ?? 0;
    $annee = date('Y');
    $data['post_name'] = "{$slug_base}-{$id}-{$annee}";
  }
  return $data;
}, 10, 2);

// ================= AJAX OFFRE D'EMPLOI =================
add_action('wp_ajax_load_more_offres', 'load_more_offres');
add_action('wp_ajax_nopriv_load_more_offres', 'load_more_offres');

function load_more_offres()
{
  check_ajax_referer('load_more_nonce');

  $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

  $args = array(
    'post_type'      => 'offre_emploi',
    'posts_per_page' => 6,
    'paged'          => $page,
    'post_status'    => 'publish',
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
      $offre_data = get_field('section1_offreemplois');
      $date_expiration = isset($offre_data['date_expiration']) ? $offre_data['date_expiration'] : '';
      $lieu_travail = isset($offre_data['lieu_travail']) ? $offre_data['lieu_travail'] : '';
      $texte = isset($offre_data['texte']) ? strip_tags($offre_data['texte']) : '';
?>
      <article class="offre-item">
        <div class="offre-content">
          <div>
            <h3><?php the_title(); ?></h3>
            <div class="offre-date"><?php echo get_the_date(); ?></div>
            <div class="offre-description">
              ➝ <?php
                if ($texte) {
                  echo wp_trim_words($texte, 100, '...');
                } elseif (has_excerpt()) {
                  echo strip_tags(get_the_excerpt());
                } else {
                  $content = get_the_content();
                  $content = apply_filters('the_content', $content);
                  $content = strip_tags($content);
                  echo wp_trim_words($content, 100, '...');
                }
                ?>
            </div>
            <?php if ($lieu_travail) : ?>
              <div class="offre-lieu">
                Lieu de travail : <?php echo esc_html($lieu_travail); ?>
              </div>
            <?php endif; ?>
            <?php if ($date_expiration) : ?>
              <div class="offre-expiration">OFFRE VALIDE JUSQU'AU : <?php echo esc_html($date_expiration); ?></div>
            <?php endif; ?>
          </div>
          <a href="<?php the_permalink(); ?>" class="offre-link">Lire la suite ➝</a>
        </div>
      </article>
    <?php
    endwhile;
    wp_reset_postdata();
  endif;

  wp_die();
}

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
  $subject = "Nouveau message du formulaire de contact | $objet";
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

      <p style="margin-top: 20px; margin-bottom: 20px;"><strong>Message :</strong></p>
      <div style="margin-left: 20px; padding: 10px; background-color: #f9f9f9; border-left: 5px solid #FFCA23;">
        <p style="white-space: pre-line;">$message</p>
      </div>

      <br><hr><br>
      <p style="margin-top: 20px; margin-bottom: 20px;">Vous pouvez répondre à cette personne via cet e-mail  ➝  <a href="mailto:$email">$email</a></p>
    </body>
  </html>
  HTML;
  $sent = wp_mail($service, $subject, $body, $headers);

  $user_headers = [
    'Content-Type: text/html; charset=UTF-8',
    "From: Association La Sasson<tom@famille-boullay.fr>", // Remplacez par l'email de l'expéditeur
  ];
  $user_subject = "Confirmation de réception de votre message";
  $user_body = <<<HTML
  <html>
    <body>
      <p>Bonjour $prenom $nom,</p>
      <p>Merci d’avoir pris contact avec nous via le formulaire de contact du site web de <strong>La Sasson</strong>.</p>
      <p>Votre message a bien été transmis à notre service. Nous reviendrons vers vous dans les meilleurs délais en fonction de votre demande.</p>
      <p>En attendant, vous pouvez retrouver plus d’informations sur la Sasson sur notre site internet.</p>
      <p style="margin-top: 30px;">Bonne journée à vous,<br>
      <strong>L’équipe La Sasson</strong></p>
    </body>
  </html>
  HTML;
  wp_mail($email, $user_subject, $user_body, $user_headers);

  if ($sent) {
    wp_send_json_success("Votre message a bien été envoyé.");
  } else {
    wp_send_json_error("Erreur lors de l'envoi du message. Vérifiez les logs ou les paramètres SMTP.");
  }
}

add_action('wp_ajax_send_candidature_form', 'send_candidature_form');
add_action('wp_ajax_nopriv_send_candidature_form', 'send_candidature_form');

function send_candidature_form()
{
  $fields = [
    'nom',
    'prenom',
    'email',
    'telephone',
    'objet',
    'offre_poste',
    'message',
    'consent'
  ];

  foreach ($fields as $field) {
    $$field = sanitize_text_field($_POST[$field] ?? '');
  }

  if (!$nom || !$prenom || !$email || !$objet || !$message || !$consent) {
    wp_send_json_error('Tous les champs obligatoires doivent être remplis.');
  }

  $recrutement_page = get_page_by_path('recrutement');
  $page_id = $recrutement_page->ID;
  $acf_fields = get_field('section2_recrutement', $page_id);
  $email_reception = $acf_fields['email_reception'];
  if (empty($email_reception)) {
    wp_send_json_error("Adresse email destinataire vide.");
    return;
  }
  if (!is_email($email_reception)) {
    wp_send_json_error("Adresse email destinataire invalide: " . $email_reception);
    return;
  }

  $attachments = [];
  $allowed_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'];
  $max_size = 5 * 1024 * 1024; // 5 Mo

  foreach (['cv', 'lettre_motivation'] as $file_key) {
    if (!isset($_FILES[$file_key])) {
      wp_send_json_error("Fichier $file_key manquant.");
    }

    $file = $_FILES[$file_key];

    if ($file['error'] !== 0) {
      wp_send_json_error("Erreur lors de l'upload de $file_key.");
    }

    if ($file['size'] > $max_size) {
      wp_send_json_error("Le fichier $file_key dépasse 5 Mo.");
    }

    if (!in_array($file['type'], $allowed_types)) {
      wp_send_json_error("Type de fichier non autorisé pour $file_key.");
    }

    $upload = wp_handle_upload($file, ['test_form' => false]);

    if (!isset($upload['file'])) {
      wp_send_json_error("Erreur upload fichier $file_key.");
    }

    $attachments[] = $upload['file'];
  }

  $headers = [
    'Content-Type: text/html; charset=UTF-8',
    "From: Site Web - Formulaire de Candidature<tom@famille-boullay.fr>", // Remplacez par l'email de l'expéditeur
    "Reply-To: $email"
  ];
  $subject = "Nouveau message du formulaire de candidature | $objet";
  if (!empty($offre_poste)) {
    $subject .= ": $offre_poste";
  }
  $body = <<<HTML
  <html>
    <body>
      <p>Bonjour,</p>
      <p>Vous avez reçu un nouveau message depuis le formulaire de candidature du site <strong>La Sasson</strong> :</p>
      <br><hr><br>

      <p><strong>De la part de :</strong> $nom $prenom</p>
      <p><strong>Téléphone :</strong> $telephone</p>
      <p><strong>Objet :</strong> $objet | $offre_poste</p>

      <p style="margin-top: 20px; margin-bottom: 20px;"><strong>Message :</strong></p>
      <div style="margin-left: 20px; padding: 10px; background-color: #f9f9f9; border-left: 5px solid #FFCA23;">
        <p style="white-space: pre-line;">$message</p>
      </div>

      <br><hr><br>
      <p style="margin-top: 20px; margin-bottom: 20px;">Vous pouvez répondre à cette personne via cet e-mail  ➝  <a href="mailto:$email">$email</a></p>
    </body>
  </html>
  HTML;

  $sent = wp_mail($email_reception, $subject, $body, $headers, $attachments);

  $user_headers = [
    'Content-Type: text/html; charset=UTF-8',
    "From: Association La Sasson<tom@famille-boullay.fr>", // Remplacez par l'email de l'expéditeur
  ];
  $user_subject = "Confirmation de réception de votre candidature";
  $user_body = <<<HTML
  <html>
    <body>
      <p>Bonjour $prenom $nom,</p>
      <p>Merci d’avoir pris contact avec nous via le formulaire de candidature du site web de <strong>La Sasson</strong>.</p>
      <p>Votre message a bien été transmis à notre service. Nous reviendrons vers vous si votre profil correspond à nos besoins.</p>
      <p style="margin-top: 30px;">Bonne journée à vous,<br>
      <strong>L’équipe RH La Sasson</strong></p>
    </body>
  </html>
  HTML;
  wp_mail($email, $user_subject, $user_body, $user_headers);

  // Supprimer les fichiers
  foreach ($attachments as $path) {
    if (file_exists($path)) {
      unlink($path);
    }
  }

  if ($sent) {
    wp_send_json_success("Votre candidature a bien été envoyée.");
  } else {
    wp_send_json_error("Erreur lors de l'envoi. Contactez l’administrateur.");
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
  $section3 = get_field('section3_actu', $page_id);
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