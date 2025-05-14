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
        
    <div class="hero-article">
        <?php
            $parent_id = wp_get_post_parent_id(get_the_ID());
            $return_url = $parent_id ? get_permalink($parent_id) : home_url();
        ?>
        <a href="<?php echo esc_url($return_url); ?>" class="return-button">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/back-button.svg" alt="Retour">
        </a>

        <h1 class="article-title"><?php the_title(); ?></h1>
        <span class="posted-on"><?php echo get_the_date(); ?></span>
    </div>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
                                        echo '<div class=text-option2>';
                                            echo wp_kses_post($contenu);
                                        echo '</div>';

                                    echo'<div class="button">';
                                    if (!empty($lien)) {
                                        echo '<a href="' . esc_url($lien['url']) . '" class="btn-secondary btn-infos" target="' . esc_attr($lien['target']) . '">';
                                            echo esc_html($lien['title']);
                                        echo '</a>';
                                    }
                                    echo '</div>';

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


                                    echo '<div class="button-simple">';
                                    if (!empty($lien_simple)) {
                                        echo '<a href="' . esc_url($lien_simple['url']) . '" class="btn-secondary btn-infos" target="' . esc_attr($lien_simple['target']) . '">';
                                        echo esc_html($lien_simple['title']);
                                        echo '</a>';
                                    }
                                    echo '</div>';

                                echo '</div>';
                            echo '</div>';
                        break;
                    }
                ?>
            </div>
        </article>
       <?php
            // Récupération des textes ACF pour les boutons
            $navigation = get_field('navigation_actualite');

            // Récupérer les textes depuis le groupe ACF
            $texte_precedent = isset($navigation['article_precedent']) ? $navigation['article_precedent'] : "Actualité précédent";
            $texte_suivant = isset($navigation['article_suivant']) ? $navigation['article_suivant'] : "Actualité récente";

            // Le reste du code reste identique
            $current_post_id = get_the_ID();
            $current_post = get_post($current_post_id);

            // Vérifier si c'est le post le plus récent
            $is_most_recent = false;
            $recent_posts = get_posts(array(
                'numberposts' => 1,
                'orderby' => 'date',
                'order' => 'DESC',
                'post_type' => 'post'
            ));
            if (!empty($recent_posts) && $recent_posts[0]->ID == $current_post_id) {
                $is_most_recent = true;
            }

            // Récupérer le post plus ancien
            $older_post = null;
            $older_posts = get_posts(array(
                'numberposts' => 1,
                'orderby' => 'date',
                'order' => 'DESC',
                'post_type' => 'post',
                'date_query' => array(
                    array('before' => $current_post->post_date)
                )
            ));
            if (!empty($older_posts)) {
                $older_post = $older_posts[0];
                $has_older_posts = true;
            } else {
                $has_older_posts = false;
            }

            // Récupérer le post plus récent
            $newer_post = null;
            $newer_posts = get_posts(array(
                'numberposts' => 1,
                'orderby' => 'date',
                'order' => 'ASC',
                'post_type' => 'post',
                'date_query' => array(
                    array('after' => $current_post->post_date)
                )
            ));
            if (!empty($newer_posts)) {
                $newer_post = $newer_posts[0];
                $has_newer_posts = true;
            } else {
                $has_newer_posts = false;
            }

            // Afficher la navigation seulement si nécessaire
            if ($has_older_posts || $has_newer_posts) :
            ?>
            <div class="navigation-actualites">
                <div class="nav-button nav-left">
                    <?php if ($has_older_posts) : ?>
                        <a href="<?php echo get_permalink($older_post->ID); ?>" class="btn">
                            <img class="arrow-left" src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-article-left.svg" alt="arrow">
                            <?php echo esc_html($texte_precedent); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="nav-button nav-right">
                    <?php if ($has_newer_posts) : ?>
                        <a href="<?php echo get_permalink($newer_post->ID); ?>" class="btn">
                            <?php echo esc_html($texte_suivant); ?>
                            <img class="arrow-right" src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-article-right.svg" alt="arrow">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
</main>

<?php get_footer(); ?>
