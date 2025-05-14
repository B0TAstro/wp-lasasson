<?php get_header(); ?>
<main id="main" class="site-main" role="main">
     <?php $btn = get_field('bouton_soutenir_lien', 'option'); ?>
    <a class="btn-soutenir" href="<?php echo esc_url($btn['url']); ?>" target="<?php echo esc_attr($btn['target']); ?>">
        <span class="icon">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/heart-empty.svg" alt="Soutenir" class="heart-empty">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/heart-full.svg" alt="Soutenir" class="heart-full">
        </span>
        <p class="label"><?php echo esc_html($btn['title']); ?></p>
    </a>
    
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="entry-meta">
                    <span class="posted-on"><?php echo get_the_date(); ?></span>
                </div>
            </header>

            <div class="entry-content">
                <?php
                    $layout_option = get_field('layout_option');

                    switch ($layout_option) {

                        case 'base':
                            echo '<div class="acf-option-base">';
                                $option_de_base = get_field('option_de_base');
                                echo '<div class="base-content">';
                                    if (!empty($option_de_base['contenu_option_de_base'])) {
                                        echo wp_kses_post($option_de_base['contenu_option_de_base']);
                                    }
                                echo '</div>';
                            echo'</div>';
                            break;

                        case 'image_gauche_droite':
                            echo '<div class="acf-option-image-gauche-droite">';

$image_gauche_droite_option_2 = get_field('image_gauche_droite_option_2');

$titre    = $image_gauche_droite_option_2['titre_option_2'];
$contenu  = $image_gauche_droite_option_2['contenu_option_2'];
$image    = $image_gauche_droite_option_2['image_option_2']; 
$position = $image_gauche_droite_option_2['image_position']; // 'gauche' ou 'droite'
$lien     = $image_gauche_droite_option_2['lien_option_2'];

echo '<div class="layout-image-text ' . esc_attr($position) . '">';

// Affiche l'image
if (!empty($image)) {
    echo '<div class="image-block">';
    echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
    echo '</div>';
}

// Contenu texte
echo '<div class="content">';
echo '<h2>' . esc_html($titre) . '</h2>';
echo wp_kses_post($contenu);

if (!empty($lien)) {
    echo '<a href="' . esc_url($lien['url']) . '" class="button" target="' . esc_attr($lien['target']) . '">';
    echo esc_html($lien['title']);
    echo '</a>';
}

echo '</div>'; // .content
echo '</div>'; // .layout-image-text
echo '</div>'; // .acf-option-image-gauche-droite


                            break;

                        case 'pleine_image':
                            echo '<div class="acf-option-pleine-image">';
                            $pleine_image_option_3 = get_field('pleine_image_option_3');

                            $image_full   = $pleine_image_option_3['image_option_3'];
                            $contenu_full = $pleine_image_option_3['contenu_option_3'];

                            echo '<div class="full-image">';
                            if (!empty($image_full)) {
                                echo '<img src="' . esc_url($image_full['url']) . '" alt="' . esc_attr($image_full['alt']) . '">';
                            }
                            echo '</div>';

                            echo '<div class="full-content">';
                            echo wp_kses_post($contenu_full);

                            echo '</div>';
                            echo '</div>';
                            break;

                        case 'simple':
                            echo '<div class="acf-option-simple">';
                            $option_4_simple = get_field('option_4_simple');

                            $titre_simple   = $option_4_simple['titre_option_4_simple'];
                            $contenu_simple = $option_4_simple['contenu_option_4_simple'];
                            $lien_simple    = $option_4_simple['lien_option_4_simple'];

                            echo '<h2>' . esc_html($titre_simple) . '</h2>';
                            echo '<div class="simple-content">';
                            echo wp_kses_post($contenu_simple);

                            if (!empty($lien_simple)) {
                                echo '<a href="' . esc_url($lien_simple['url']) . '" class="button" target="' . esc_attr($lien_simple['target']) . '">';
                                echo esc_html($lien_simple['title']);
                                echo '</a>';
                            }

                            echo '</div>';
                            echo '</div>';
                            break;
                    }
                ?>
            </div>

            <footer class="entry-footer">
                <?php if (has_category()) : ?>
                    <div class="cat-links">
                        <?php the_category(', '); ?>
                    </div>
                <?php endif; ?>
                <?php if (has_tag()) : ?>
                    <div class="tags-links">
                        <?php the_tags('', ', ', ''); ?>
                    </div>
                <?php endif; ?>
            </footer>
        </article>
    <?php endwhile; ?>
    <button id="backButton">RETOUR</button>
    <script>
        document.getElementById('backButton').addEventListener('click', function() {
            window.history.back();
        });
    </script>
</main>
<?php get_footer(); ?>
