<?php
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
        <button id="backButton" class="return-button">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/back-button.svg" alt="Retour">
        </button>

        <h1 class="dispositif-title"><?php the_title(); ?></h1>
    </div>

    <script>
        document.getElementById('backButton').addEventListener('click', function() {
            window.history.back();
        });
    </script>

    <?php $acf = get_field('section1_offreemplois'); ?>
    <section class="container-offre-emploi">
        <?php if (!empty($acf['image'])): ?>
            <img src="<?= esc_url($acf['image']['url']); ?>" alt="<?= esc_attr($acf['image']['alt']); ?>">
        <?php endif; ?>

        <?php if (!empty($acf['texte'])): ?>
            <div class="wysiwyg"><?= wp_kses_post($acf['texte']); ?></div>
        <?php endif; ?>

        <?php if (!empty($acf['lieu_travail'])): ?>
            <p class="">Lieu de travail : <?= esc_html($acf['lieu_travail']); ?></p>
        <?php endif; ?>

        <?php if (!empty($acf['date_expiration'])): ?>
            <p class="">Offre valable jusqu’au : <?= esc_html($acf['date_expiration']); ?></p>
        <?php endif; ?>
    </section>
</main>

<?php
get_footer();
?>