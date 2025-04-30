<?php
/*
 * Template Name: Dispositif
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

    <div class="hero">
        <?php
        $parent_id = wp_get_post_parent_id(get_the_ID());
        $return_url = $parent_id ? get_permalink($parent_id) : home_url();
        ?>
        <a href="<?php echo esc_url($return_url); ?>" class="return-button">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/back-button.svg" alt="Retour">
        </a>

        <h1 class="dispositif-title"><?php the_title(); ?></h1>
    </div>

    <?php $section1 = get_field('section1_dispositif');
    if ($section1['images']) : ?>
        <section class="section-dispositif-slider">
            <div class="dispositif-slider-container<?php echo count($section1['images']) > 1 ? ' has-slider' : ''; ?>">
                <div class="dispositif-slider">
                    <?php foreach ($section1['images'] as $img) : ?>
                        <div class="dispositif-slide">
                            <img src="<?php echo esc_url($img['image']['url']); ?>" alt="<?php echo esc_attr($img['image']['alt']); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if (count($section1['images']) > 1) : ?>
                    <div class="dispositif-slider-dots"></div>
                <?php endif; ?>
            </div>

            <div class="wysiwyg dispositif-slider-section-content">
                <?php echo wp_kses_post($section1['text']); ?>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $section2 = get_field('section2_dispositif');

    $contact_groups = $section2['contact_groups'];
    $has_multiple_contacts = is_array($contact_groups) && count($contact_groups) > 1;
    if ($has_multiple_contacts) : ?>
        <section class="section-dispositif-contact" data-accordion-container>
            <?php foreach ($contact_groups as $group) : ?>
                <div class="dispositif-contact-group" data-accordion>
                    <h2 class="dispositif-contact-title">
                        <?php echo esc_html($group['title']); ?>
                        <img class="chevron" src="<?php echo get_template_directory_uri(); ?>/assets/img/chevron-down.svg" alt="Chevron">
                    </h2>
                    <div class="dispositif-contact-info">
                        <div class="dispositif-bloc-address">
                            <p class="dispositif-address-title"><?php echo esc_html($group['bloc_adresse']['texte_adresse_titre']); ?></p>
                            <p class="dispositif-address"><?php echo nl2br(esc_html($group['bloc_adresse']['addresse'])); ?></p>
                            <p class="dispositif-phone"><span>N° Téléphone : </span><?php echo esc_html($group['bloc_adresse']['telephone']); ?></p>
                        </div>
                        <div class="dispositif-bloc-hours">
                            <p class="dispositif-hours-title"><?php echo esc_html($group['bloc_horraires']['texte_horaires_titre']); ?></p>
                            <p class="dispositif-hours"><?php echo nl2br(esc_html($group['bloc_horraires']['horaires'])); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    <?php else :
        $group = $contact_groups[0]; ?>
        <section class="section-dispositif-contact">
            <div class="dispositif-contact-info">
                <div class="dispositif-bloc-address">
                    <p class="dispositif-address-title"><?php echo esc_html($group['bloc_adresse']['texte_adresse_titre']); ?></p>
                    <p class="dispositif-address"><?php echo nl2br(esc_html($group['bloc_adresse']['addresse'])); ?></p>
                    <p class="dispositif-phone"><span>N° Téléphone : </span><?php echo esc_html($group['bloc_adresse']['telephone']); ?></p>
                </div>
                <div class="dispositif-bloc-hours">
                    <p class="dispositif-hours-title"><?php echo esc_html($group['bloc_horraires']['texte_horaires_titre']); ?></p>
                    <p class="dispositif-hours"><?php echo nl2br(esc_html($group['bloc_horraires']['horaires'])); ?></p>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $section3 = get_field('section3_dispositif');
    if (!empty($section3) && (!empty($section3['title']) || !empty($section3['text']) || !empty($section3['image']) || !empty($section3['button']))) :
        $btn_class = !empty($section3['button_style']) ? $section3['button_style'] : 'btn-primary';
        $image_position = !empty($section3['elements_position']) && $section3['elements_position'] === 'right' ? 'right' : '';
        ?>
        <section class="section-dispositif-text-image <?php echo esc_attr($image_position); ?>">
            <div class="dispositif-text-content">
                <?php if (!empty($section3['title'])) : ?>
                    <h2><?php echo esc_html($section3['title']); ?></h2>
                <?php endif; ?>

                <?php if (!empty($section3['text'])) : ?>
                    <div class="wysiwyg dispositif-content">
                        <?php echo wp_kses_post($section3['text']); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($section3['button'])) : ?>
                    <a href="<?php echo esc_url($section3['button']['url']); ?>" class="<?php echo esc_attr($btn_class); ?> dispositif-button" target="<?php echo esc_attr($section3['button']['target']); ?>">
                        <?php echo esc_html($section3['button']['title']); ?>
                    </a>
                <?php endif; ?>
            </div>

            <?php if (!empty($section3['image'])) : ?>
                <div class="dispositif-image-content">
                    <img src="<?php echo esc_url($section3['image']['url']); ?>" alt="<?php echo esc_attr($section3['image']['alt']); ?>">
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <?php
    $section4 = get_field('section4_dispositif');
    if (!empty($section4) && (!empty($section4['title']) || !empty($section4['text']) || !empty($section4['button']))) :
        $btn_class = !empty($section4['button_style']) ? $section4['button_style'] : 'btn-primary';
    ?>
        <section class="section-dispositif-text-button">
            <?php if (!empty($section4['title'])) : ?>
                <h2><?php echo esc_html($section4['title']); ?></h2>
            <?php endif; ?>

            <?php if (!empty($section4['text'])) : ?>
                <div class="wysiwyg dispositif-text-button-content">
                    <?php echo wp_kses_post($section4['text']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($section4['button'])) : ?>
                <a href="<?php echo esc_url($section4['button']['url']); ?>" class="<?php echo esc_attr($btn_class); ?> dispositif-button" target="<?php echo esc_attr($section4['button']['target']); ?>">
                    <?php echo esc_html($section4['button']['title']); ?>
                </a>
            <?php endif; ?>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>