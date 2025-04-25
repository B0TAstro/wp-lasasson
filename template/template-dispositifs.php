<?php
/*
 * Template Name: Nos dispositifs
 */

get_header();
?>

<main class="dispositifs-page">
    <?php $btn = get_field('bouton_soutenir_lien', 'option'); ?>
    <a class="btn-soutenir" href="<?php echo esc_url($btn['url']); ?>" target="<?php echo esc_attr($btn['target']); ?>">
        <span class="icon">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/heart-empty.svg" alt="Soutenir" class="heart-empty">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/heart-full.svg" alt="Soutenir" class="heart-full">
        </span>
        <p class="label"><?php echo esc_html($btn['title']); ?></p>
    </a>

    <div class="page-header">
        <h1><?php the_title(); ?></h1>
    </div>

    <?php
    // Section 1 - Présentation
    $section1 = get_field('section1');
    if ($section1) :
    ?>
        <section class="section-presentation">
            <div class="container">
                <div class="presentation-content">
                    <div class="presentation-image">
                        <?php if ($section1['image']) : ?>
                            <img src="<?php echo esc_url($section1['image']['url']); ?>" alt="<?php echo esc_attr($section1['image']['alt']); ?>" />
                        <?php else : ?>
                            <div class="placeholder-image">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.svg" alt="Image" />
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="presentation-text">
                        <?php if ($section1['titre']) : ?>
                            <h2><?php echo esc_html($section1['titre']); ?></h2>
                        <?php endif; ?>
                        <?php if ($section1['texte']) : ?>
                            <div class="wysiwyg-content"><?php echo $section1['texte']; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Section 2 - Liste des dispositifs
    $section2 = get_field('section2');
    if ($section2) :
    ?>
        <section class="section-liste-dispositifs">
            <div class="container">
                <?php if ($section2['titre']) : ?>
                    <h2><?php echo esc_html($section2['titre']); ?></h2>
                <?php endif; ?>

                <?php if ($section2['texte']) : ?>
                    <div class="section-intro">
                        <p><?php echo esc_html($section2['texte']); ?></p>
                    </div>
                <?php endif; ?>

                <div class="dispositifs-grid">
                    <?php
                    // Détermine les dispositifs à afficher
                    $dispositifs = [];

                    // Option 1: Affichage automatique des pages enfants
                    if ($section2['type_dispositif'] == 'auto') {
                        $dispositifs = get_children([
                            'post_parent' => get_the_ID(),
                            'post_type' => 'page',
                            'post_status' => 'publish',
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                        ]);
                    } 
                    // Option 2: Sélection manuelle
                    elseif ($section2['type_dispositif'] == 'manual' && !empty($section2['dispositifs_manuels'])) {
                        $dispositifs = $section2['dispositifs_manuels'];
                    }

                    // Affiche les dispositifs
                    if ($dispositifs) :
                        foreach ($dispositifs as $dispositif) :
                            $thumbnail = get_the_post_thumbnail_url($dispositif->ID, 'medium');
                            $titre = get_the_title($dispositif->ID);
                            $permalink = get_permalink($dispositif->ID);
                    ?>
                            <div class="dispositif-card">
                                <a href="<?php echo esc_url($permalink); ?>" class="dispositif-link">
                                    <div class="dispositif-image">
                                        <?php if ($thumbnail) : ?>
                                            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($titre); ?>">
                                        <?php else : ?>
                                            <div class="placeholder-image">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.svg" alt="Image">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="dispositif-title">
                                        <h3><?php echo esc_html($titre); ?></h3>
                                    </div>
                                </a>
                            </div>
                    <?php
                        endforeach;
                    else :
                    ?>
                        <div class="no-dispositifs">
                            <p>Aucun dispositif n'est disponible pour le moment.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Section 3 - FAQ
    $section3 = get_field('section3');
    if ($section3 && !empty($section3['questions'])) :
    ?>
        <section class="section-faq">
            <div class="container">
                <?php if ($section3['titre']) : ?>
                    <h2><?php echo esc_html($section3['titre']); ?></h2>
                <?php endif; ?>

                <?php if ($section3['texte']) : ?>
                    <div class="section-intro">
                        <p><?php echo esc_html($section3['texte']); ?></p>
                    </div>
                <?php endif; ?>

                <div class="faq-container">
                    <?php foreach ($section3['questions'] as $index => $item) : ?>
                        <div class="faq-item" id="faq-item-<?php echo $index; ?>">
                            <div class="faq-question">
                                <h3><?php echo esc_html($item['question']); ?></h3>
                                <button class="faq-toggle" aria-expanded="false" aria-controls="faq-answer-<?php echo $index; ?>">
                                    <span class="sr-only">Afficher/Masquer la réponse</span>
                                    <span class="icon-plus">+</span>
                                </button>
                            </div>
                            <div class="faq-answer" id="faq-answer-<?php echo $index; ?>" aria-hidden="true">
                                <?php echo $item['reponse']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>