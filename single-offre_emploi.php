<?php
get_header();
?>

<main>
    <button id="backButton">RETOUR</button>
    <script>
        document.getElementById('backButton').addEventListener('click', function() {
            window.history.back();
        });
    </script>
    <?php $acf = get_field('section1_offreemplois'); ?>

    <div class="container-offre-emploi">
        <h1><?php the_title(); ?></h1>

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
    </div>
</main>

<footer>
    <div class="footer-infos">
        <ul>
            <li>© <?php echo date('Y'); ?></li>
            <?php if (have_rows('footer_links', 'option')) :
                while (have_rows('footer_links', 'option')) : the_row();
                    $link = get_sub_field('lien');
                    if ($link): ?>
                        <li>
                            <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>">
                                <?php echo esc_html($link['title']); ?>
                            </a>
                        </li>
            <?php endif;
                endwhile;
            endif; ?>
        </ul>
    </div>

    <div class="footer-socials">
        <ul>
            <?php
            $default_icons = [
                'instagram' => get_template_directory_uri() . '/assets/img/socials/instagram.svg',
                'facebook' => get_template_directory_uri() . '/assets/img/socials/facebook.svg',
                'linkedin' => get_template_directory_uri() . '/assets/img/socials/linkedin.svg',
                'twitter' => get_template_directory_uri() . '/assets/img/socials/twitter.svg',
                'youtube' => get_template_directory_uri() . '/assets/img/socials/youtube.svg',
            ];

            if (have_rows('footer_socials', 'option')) :
                while (have_rows('footer_socials', 'option')) : the_row();
                    $network = get_sub_field('reseau');
                    $custom_icon = get_sub_field('icone_personnalisee');
                    $link = get_sub_field('lien');
                    if (!$link) continue;

                    $icon_url = ($network === 'autre') ? esc_url($custom_icon) : ($default_icons[$network] ?? '');

                    if ($icon_url): ?>
                        <li>
                            <a href="<?php echo esc_url($link); ?>" target="_blank">
                                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($network); ?>">
                            </a>
                        </li>
            <?php endif;
                endwhile;
            endif; ?>
        </ul>
    </div>

    <?php wp_footer(); ?>
</footer>
</body>

</html>