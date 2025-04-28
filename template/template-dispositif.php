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
        $return_option = get_field('return_option');
        $return_url = '';
        if ($return_option === 'last_page') {
            $return_url = isset($_SERVER['HTTP_REFERER']) ? esc_url($_SERVER['HTTP_REFERER']) : get_permalink(get_page_by_path('nos-dispositifs'));
        } elseif ($return_option === 'dispositifs') {
            $return_url = get_permalink(get_page_by_path('nos-dispositifs'));
        } elseif ($return_option === 'home') {
            $return_url = home_url();
        }
        ?>
        <a href="<?php echo esc_url($return_url); ?>" class="return-button">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/back-button.svg" alt="Retour">
        </a>

        <h1 class="dispositif-title"><?php the_title(); ?></h1>
    </div>

    <?php
    $section1 = get_field('section1');
    if (!empty($section1['images'])) :
    ?>
        <section class="section-hero">
            <?php if (count($section1['images']) > 1) : ?>
                <div class="hero-slider">
                    <?php foreach ($section1['images'] as $img) : ?>
                        <div class="slide">
                            <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="hero-image">
                    <img src="<?php echo esc_url($section1['images'][0]['url']); ?>" alt="<?php echo esc_attr($section1['images'][0]['alt']); ?>">
                </div>
            <?php endif; ?>

            <?php if (!empty($section1['text'])) : ?>
                <div class="section-content">
                    <?php echo wp_kses_post($section1['text']); ?>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <?php
    $contact_groups = get_field('contact_groups');
    $has_multiple_contacts = count($contact_groups) > 1;
    if ($contact_groups) : ?>
        <?php foreach ($contact_groups as $index => $group) : ?>
            <section class="section section-contact" <?php if ($has_multiple_contacts) echo 'data-accordion'; ?>>
                <?php if ($group['title']) : ?>
                    <h2 class="contact-title">
                        <?php echo esc_html($group['title']); ?>
                        <?php if ($has_multiple_contacts) : ?>
                            <span class="chevron">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/chevron-down.svg" alt="Chevron">
                            </span>
                        <?php endif; ?>
                    </h2>
                <?php endif; ?>

                <div class="contact-info">
                    <div class="contact-address">
                        <?php if (!empty($group['bloc_adresse'])) : ?>
                            <p class="address"><?php echo nl2br(esc_html($group['bloc_adresse']['addresse'])); ?></p>
                            <p class="phone">Tél. <?php echo esc_html($group['bloc_adresse']['telephone']); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="contact-hours">
                        <?php if (!empty($group['bloc_horraires'])) : ?>
                            <p class="hours-title"><?php echo esc_html($group['bloc_horraires']['texte_horaires_titre']); ?></p>
                            <p class="hours-text"><?php echo nl2br(esc_html($group['bloc_horraires']['horaires'])); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php
    // Section 3 : Texte et bouton
    $section3 = get_field('section3');
    if (!empty($section3['title']) || !empty($section3['text']) || !empty($section3['button'])) :
    ?>
        <section class="section-text-button">
            <?php if (!empty($section3['title'])) : ?>
                <h2><?php echo esc_html($section3['title']); ?></h2>
            <?php endif; ?>

            <?php if (!empty($section3['text'])) : ?>
                <div class="section-content">
                    <?php echo wp_kses_post($section3['text']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($section3['button'])) : ?>
                <a href="<?php echo esc_url($section3['button']['url']); ?>" class="btn-primary" target="<?php echo esc_attr($section3['button']['target']); ?>">
                    <?php echo esc_html($section3['button']['title']); ?>
                </a>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <?php
    // Section 4 : Texte + Image
    $section4 = get_field('section4');
    if (!empty($section4['title']) || !empty($section4['text']) || !empty($section4['image'])) :
    ?>
        <section class="section-text-image">
            <div class="text-content">
                <?php if (!empty($section4['title'])) : ?>
                    <h2><?php echo esc_html($section4['title']); ?></h2>
                <?php endif; ?>
                <?php if (!empty($section4['text'])) : ?>
                    <div class="section-content">
                        <?php echo wp_kses_post($section4['text']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($section4['image'])) : ?>
                <div class="image-content">
                    <img src="<?php echo esc_url($section4['image']['url']); ?>" alt="<?php echo esc_attr($section4['image']['alt']); ?>">
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <?php
    // Section 5 : Texte additionnel
    $section5 = get_field('section5');
    if (!empty($section5['text'])) :
    ?>
        <section class="section-additional-text">
            <div class="section-content">
                <?php echo wp_kses_post($section5['text']); ?>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>