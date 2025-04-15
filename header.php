<!DOCTYPE html>
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
        <?php $logo = get_field('logo_header', 'option'); ?>
        <a class="logo_header" href="/">
            <img loading="lazy" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
        </a>

        <input type="checkbox" id="menu-toggle" class="menu-toggle" />
        <label for="menu-toggle" class="burger" aria-label="Menu mobile">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <nav class="nav-wrapper">
            <?php wp_nav_menu(array('menu' => 'menu-principal')); ?>

            <?php $btn = get_field('bouton_recrutement_lien', 'option'); ?>
            <a class="btn-recrutement" href="<?php echo esc_url($btn['url']); ?>" target="<?php echo esc_attr($btn['target']); ?>">
                <?php echo esc_html($btn['title']); ?>
            </a>
        </nav>
    </header>