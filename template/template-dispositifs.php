<?php
/*
 * Template Name: Nos dispositifs
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
    $section1 = get_field('section1_dispositifs');
    if ($section1) :
    ?>
        <section class="section-presentation">
            <div class="presentation-image">
                <img src="<?php echo esc_url($section1['image']['url']); ?>" alt="<?php echo esc_attr($section1['image']['alt']); ?>" />
            </div>
            <div class="presentation-text">
                <h2><?php echo esc_html($section1['titre']); ?></h2>
                <div class="wysiwyg presentation-content"><?php echo $section1['texte']; ?></div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $section2 = get_field('section2_dispositifs');
    if ($section2) :
    ?>
        <section class="section-liste-dispositifs">
            <h2><?php echo esc_html($section2['titre']); ?></h2>

            <p class="section-intro"><?php echo esc_html($section2['texte']); ?></p>

            <div class="dispositifs-grid">
                <?php
                $dispositifs = [];

                // Option 1: Affichage automatique des pages enfants
                if ($section2['type_dispositif'] == 'auto') {
                    $dispositifs = get_children([
                        'post_parent' => get_the_ID(),
                        'post_type' => 'page',
                        'post_status' => 'publish',
                        'orderby' => 'title',
                        'order' => 'ASC',
                    ]);
                }
                // Option 2: Sélection manuelle
                elseif ($section2['type_dispositif'] == 'manual' && !empty($section2['dispositifs_manuels'])) {
                    $dispositifs = $section2['dispositifs_manuels'];
                    if (!empty($dispositifs)) {
                        usort($dispositifs, function ($a, $b) {
                            return strcmp(get_the_title($a->ID), get_the_title($b->ID));
                        });
                    }
                }

                if ($dispositifs) :
                    foreach ($dispositifs as $dispositif) :
                        $post_id = isset($dispositif->ID) ? $dispositif->ID : $dispositif;
                        $thumbnail_id = get_post_thumbnail_id($post_id);
                        $thumbnail = $thumbnail_id ? wp_get_attachment_image_src($thumbnail_id, 'medium')[0] : '';
                        $titre = get_the_title($post_id);
                        $permalink = get_permalink($post_id);
                ?>
                        <div class="dispositif-card">
                            <a href="<?php echo esc_url($permalink); ?>" class="dispositif-link">
                                <?php if ($thumbnail) : ?>
                                    <img class="dispositif-image" src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($titre); ?>">
                                <?php else : ?>
                                    <img class="dispositif-placeholder" src="<?php echo get_template_directory_uri(); ?>/assets/img/dispositif-placeholder.png" alt="Image">
                                <?php endif; ?>
                                <h3><?php echo esc_html($titre); ?></h3>
                            </a>
                        </div>
                    <?php
                    endforeach;
                else :
                    ?>
                    <p class="no-dispositifs">Aucun dispositif n'est disponible pour le moment.</p>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $section3 = get_field('section3_dispositifs');
    if ($section3 && !empty($section3['faq'])) :
    ?>
        <section class="section-faq">
            <h2><?php echo esc_html($section3['titre']); ?></h2>

            <p class="section-intro"><?php echo esc_html($section3['texte']); ?></p>

            <div class="faq-container">
                <?php foreach ($section3['faq'] as $index => $item) : ?>
                    <div class="faq-item" id="faq-item-<?php echo $index; ?>">
                        <div class="faq-question" aria-expanded="false" aria-controls="faq-answer-<?php echo $index; ?>">
                            <h3><?php echo esc_html($item['question']); ?></h3>
                            <div class="faq-toggle">
                                <img class="icon-plus" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-plus.svg" alt="Plus">
                                <img class="icon-moins" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-moins.svg" alt="Moins">
                            </div>
                        </div>

                        <div class="faq-answer" id="faq-answer-<?php echo $index; ?>" aria-hidden="true">
                            <?php echo wp_kses_post($item['reponse']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>