<?php
/*
 * Template Name: Actualités
 */

get_header();
?>

<main>
    <?php $btn = get_field('bouton_soutenir_lien', 'option'); ?>
    <a class="btn-soutenir" href="<?php echo esc_url($btn['url']); ?>" target="<?php echo esc_attr($btn['target']); ?>">
        <span class="icon">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/heart-empty.svg" alt="Soutenir" class="heart-empty">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/heart-full.svg" alt="Soutenir" class="heart-full">
        </span>
        <p class="label"><?php echo esc_html($btn['title']); ?></p>
    </a>

    <h1><?php the_title(); ?></h1>

    <div class="container">
        <!-- SECTION 1: Dernières actualités -->
        <section class="section-actus">
            <h2 class="section-title"><?php echo get_field('section1')['titre_section_actus']; ?></h2>

            <div class="actus-container" id="actus-container">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 5,
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
                ?>
            </div>

            <div class="load-more-container">
                <button id="load-more-actus" class="btn-load-more" data-page="1" data-max="<?php echo $actus_query->max_num_pages; ?>">
                    <?php echo get_field('section1')['texte_bouton_plus_actus']; ?>
                </button>
            </div>
        </section>

        <!-- SECTION 2: Magazines de l'association -->
        <section class="section-magazines">
            <h2 class="section-title"><?php echo get_field('section2')['titre_section_magazines']; ?></h2>
            <p class="section-description"><?php echo get_field('section2')['description_magazines']; ?></p>

            <?php if (have_rows('section2_magazines')) : ?>
                <div class="magazines-container">
                    <?php
                    while (have_rows('section2_magazines')) : the_row();
                        $pdf = get_sub_field('fichier_pdf');
                        $cover = get_sub_field('image_couverture');
                        $numero = get_sub_field('numero');
                    ?>
                        <div class="magazine-item">
                            <a href="<?php echo esc_url($pdf['url']); ?>" target="_blank" class="magazine-link">
                                <?php if ($cover) : ?>
                                    <img src="<?php echo esc_url($cover['url']); ?>" alt="Magazine <?php echo esc_attr($numero); ?>" class="magazine-cover">
                                <?php else : ?>
                                    <div class="magazine-placeholder">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/pdf-icon.svg" alt="PDF">
                                    </div>
                                <?php endif; ?>
                                <span class="magazine-number"><?php echo esc_html($numero); ?></span>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

            <?php
            /* Commenté comme demandé
            <script>
                jQuery(document).ready(function($) {
                    $('.magazines-slider').slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        arrows: true,
                        dots: true,
                        responsive: [
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 2
                                }
                            },
                            {
                                breakpoint: 576,
                                settings: {
                                    slidesToShow: 1
                                }
                            }
                        ]
                    });
                });
            </script>
            */
            ?>
        </section>

        <!-- SECTION 3: Articles de presse -->
        <section class="section-presse">
            <h2 class="section-title"><?php echo get_field('section3')['titre_section_presse']; ?></h2>
            <p class="section-description"><?php echo get_field('section3')['description_presse']; ?></p>

            <?php
            // Compter le nombre total d'articles de presse
            $articles_presse = get_field('section3')['articles_presse'];
            $total_articles = count($articles_presse);
            $initial_display = 3; // Nombre d'articles à afficher initialement (une ligne en desktop)

            if ($articles_presse) : ?>
                <div class="presse-grid" id="presse-container">
                    <?php
                    $count = 0;
                    foreach ($articles_presse as $article) :
                        if ($count < $initial_display) :
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
                        endif;
                        $count++;
                    endforeach;
                    ?>
                </div>
            <?php endif; ?>

            <?php if ($total_articles > $initial_display) : ?>
                <div class="load-more-container">
                    <button id="load-more-presse" class="btn-load-more" data-page="1" data-total="<?php echo $total_articles; ?>" data-per-page="3" data-loaded="<?php echo $initial_display; ?>">
                        <?php echo get_field('section3')['texte_bouton_plus_presse']; ?>
                    </button>
                </div>
            <?php endif; ?>
        </section>
    </div>
</main>

<script>
    jQuery(document).ready(function($) {
        // Chargement des actualités supplémentaires
        $('#load-more-actus').on('click', function() {
            var button = $(this);
            var page = button.data('page') + 1;

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'post',
                data: {
                    action: 'load_more_actus',
                    page: page,
                },
                success: function(response) {
                    if (response) {
                        $('#actus-container').append(response);
                        button.data('page', page);

                        // Cacher le bouton si on a atteint la dernière page
                        if (page >= button.data('max')) {
                            button.hide();
                        }
                    }
                }
            });
        });

        // Chargement des articles de presse supplémentaires
        $('#load-more-presse').on('click', function() {
            var button = $(this);
            var page = button.data('page') + 1;
            var perPage = button.data('per-page');
            var loaded = button.data('loaded');
            var total = button.data('total');

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'post',
                data: {
                    action: 'load_more_presse',
                    page: page,
                    loaded: loaded,
                    per_page: perPage
                },
                success: function(response) {
                    if (response) {
                        $('#presse-container').append(response);
                        button.data('page', page);

                        // Mettre à jour le nombre d'articles chargés
                        var newLoaded = loaded + perPage;
                        button.data('loaded', newLoaded);

                        // Cacher le bouton si on a chargé tous les articles
                        if (newLoaded >= total) {
                            button.hide();
                        }
                    }
                }
            });
        });
    });
</script>

<?php get_footer(); ?>