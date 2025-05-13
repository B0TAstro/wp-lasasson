<?php get_header(); ?>
<main id="main" class="site-main" role="main">
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

                if (!$layout_option) {
                    $layout_option = 'option_de_base';
                }

                switch ($layout_option) {
                    case 'option_de_base':
                        $option_de_base = get_field('option_de_base');
                        if (!empty($option_de_base['contenu_option_de_base'])) {
                            echo $option_de_base['contenu_option_de_base'];
                        }
                        break;

                    case 'image_gauche_droite_option_2':
                        $image_gauche_droite_option_2 = get_field('image_gauche_droite_option_2');
                        {
                            $titre = $image_gauche_droite_option_2['titre_option_2'];
                            $contenu = $image_gauche_droite_option_2['contenu_option_2'];
                            $image = $image_gauche_droite_option_2['image_gauche_droite_option_2'];
                            $position = $image_gauche_droite_option_2['image_position'];
                            $lien = $image_gauche_droite_option_2['lien_option_2'];

                            echo '<h2>' . esc_html($titre) . '</h2>';
                            echo '<div class="layout-image-text">';

                            if ($position === 'gauche') {
                                echo '<div class="image-left">';
                                echo wp_get_attachment_image($image, 'large');
                                echo '</div>';
                            }

                            echo '<div class="content">';
                            echo $contenu;

                            if (!empty($lien)) {
                                echo '<a href="' . esc_url($lien['url']) . '" class="button" target="' . esc_attr($lien['target']) . '">' . esc_html($lien['title']) . '</a>';
                            }
                            echo '</div>';

                            if ($position === 'droite') {
                                echo '<div class="image-right">';
                                echo wp_get_attachment_image($image, 'large');
                                echo '</div>';
                            }

                            echo '</div>';
                        }
                        break;

                    case 'pleine_image_option_3':
                        $pleine_image_option_3 = get_field('pleine_image_option_3');
                        {
                            $image_full = $pleine_image_option_3['image'];
                            $contenu_full = $pleine_image_option_3['contenu_option_3'];
                            $lien_full = $pleine_image_option_3['lien_option_3'];

                            echo '<div class="full-image">';
                            echo wp_get_attachment_image($image_full, 'full');
                            echo '</div>';

                            echo '<div class="full-content">';
                            echo $contenu_full;

                            if (!empty($lien_full)) {
                                echo '<a href="' . esc_url($lien_full['url']) . '" class="button" target="' . esc_attr($lien_full['target']) . '">' . esc_html($lien_full['title']) . '</a>';
                            }
                            echo '</div>';
                        }
                        break;

                    case 'option_4_simple':
                        $option_4_simple = get_field('option_4_simple');
                       {
                            $titre_simple = $option_4_simple['titre_option_4_simple'];
                            $contenu_simple = $option_4_simple['contenu_option_4_simple'];
                            $lien_simple = $option_4_simple['lien_option_4_simple'];

                            echo '<h2>' . esc_html($titre_simple) . '</h2>';
                            echo '<div class="simple-content">';
                            echo $contenu_simple;

                            if (!empty($lien_simple)) {
                                echo '<a href="' . esc_url($lien_simple['url']) . '" class="button" target="' . esc_attr($lien_simple['target']) . '">' . esc_html($lien_simple['title']) . '</a>';
                            }
                            echo '</div>';
                        }
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