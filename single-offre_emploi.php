<?php
get_header();
$acf = get_field('section1_offreemplois');
?>

<main class="single-offre-emploi">
    <h1><?php the_title(); ?></h1>

    <?php if (!empty($acf['image'])): ?>
        <img src="<?= esc_url($acf['image']['url']); ?>" alt="<?= esc_attr($acf['image']['alt']); ?>">
    <?php endif; ?>

    <?php if (!empty($acf['contenu'])): ?>
        <div class="wysiwyg"><?= wp_kses_post($acf['contenu']); ?></div>
    <?php endif; ?>

    <?php if (!empty($acf['date_expiration'])): ?>
        <p class="expiration">Offre valable jusqu’au : <?= esc_html($acf['date_expiration']); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>