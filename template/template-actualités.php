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

    <?php
    $section1 = get_field('section1');
    ?>
    <section class="section-actus">
        <div class="container">

            <h2><?php echo $section1['titre_section_actus']; ?></h2>

            <div class="actus-container">
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
                        <article class="news-item <?php echo has_post_thumbnail() ? 'has-thumbnail' : 'no-thumbnail'; ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="news-content">
                                    <div>
                                        <h3>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="news-date"><?php echo get_the_date(); ?></div>
                                        <div class="news-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
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
                                        <h3>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="news-date"><?php echo get_the_date(); ?></div>
                                        <div class="news-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="news-link">Lire la suite</a>
                                </div>
                            <?php endif; ?>
                        </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

            <button class="btn-primary btn-load-more" id="load-more-actus" data-page="1" data-max="<?php echo $actus_query->max_num_pages; ?>">
                <?php echo $section1['texte_bouton_plus_actus']; ?>
            </button>
        </div>
    </section>

    <?php
    $section2 = get_field('section2');
    ?>
    <section class="section-magazines">
        <h2><?php echo $section2['titre_section_magazines']; ?></h2>

        <p><?php echo $section2['description_magazines']; ?></p>

        <div class="magazines-wrapper">
            <button class="magazines-prev" aria-label="Magazine précédent">&lt;</button>

            <?php if (have_rows('section2_magazines')) : ?>
                <div class="magazines-container">
                    <div class="magazines-slider">
                        <?php
                        while (have_rows('section2_magazines')) : the_row();
                            $pdf = get_sub_field('fichier_pdf');
                            $cover = get_sub_field('image_couverture');
                            $numero = get_sub_field('numero');
                        ?>
                            <div class="magazine-item">
                                <a href="<?php echo esc_url($pdf['url']); ?>" target="_blank" class="magazine-link">
                                    <?php if ($cover) : ?>
                                        <img class="magazine-cover" src="<?php echo esc_url($cover['url']); ?>" alt="<?php echo esc_attr($numero); ?>">
                                    <?php else : ?>
                                        <img class="magazine-placeholder" src="<?php echo get_template_directory_uri(); ?>/assets/img/pdf-icon.png" alt="Cover">
                                    <?php endif; ?>
                                    <p class="magazine-number"><?php echo esc_html($numero); ?></p>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>

            <button class="magazines-next" aria-label="Magazine suivant">&gt;</button>
        </div>
    </section>

    <?php
    $section3 = get_field('section3');
    ?>
    <section class="section-presse">
        <h2><?php echo $section3['titre_section_presse']; ?></h2>

        <p><?php echo $section3['description_presse']; ?></p>

        <?php
        $articles_presse = get_field('section3')['articles_presse'];
        $total_articles = count($articles_presse);
        $initial_display = 6;
        ?>
        <div class="presse-container">
            <?php
            $count = 0;
            foreach ($articles_presse as $article) :
                if ($count < $initial_display) :
                    $titre_article = $article['titre_article'];
                    $image = $article['image_article'];
                    $lien = $article['lien_article'];
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
                                <span class="read-more">En savoir plus ➝</span>
                            </div>
                        </a>
                    </div>
            <?php
                endif;
                $count++;
            endforeach;
            ?>
        </div>

        <?php if ($total_articles > $initial_display) : ?>
            <button class="btn-primary btn-load-more" id="load-more-presse" data-page="1" data-per-page="3" data-total="<?php echo $total_articles; ?>" data-loaded="<?php echo $initial_display; ?>" data-page-id="<?php echo get_the_ID(); ?>">
                <?php echo get_field('section3')['texte_bouton_plus_presse']; ?>
            </button>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>