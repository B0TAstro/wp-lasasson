<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body>
    <header>
        <!-- <?php
                if (wp_is_mobile()) {
                    get_header('mobile');
                } else {
                    get_header('desktop');
                }
                ?> -->

        <a href="/">
            <img src="<?php the_field('logo_header', 'option'); ?>" alt="Logo La Sasson">
        </a>

        <ul>
            <?php if (have_rows('menu_items', 'option')) : ?>
                <?php while (have_rows('menu_items', 'option')) : the_row(); ?>
                    <li>
                        <a href="<?php the_sub_field('lien'); ?>">
                            <?php the_sub_field('texte'); ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            <?php endif; ?>
        </ul>

        <a href="<?php the_field('bouton_recrutement_lien', 'option'); ?>" class="btn-recrutement">
            <?php the_field('bouton_recrutement_texte', 'option'); ?>
        </a>
    </header>