<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body>
    <header>
        <?php $logo = get_field('logo_header', 'option'); ?>
        <?php if ($logo): ?>
            <a href="/">
                <img src="<?php echo esc_url($logo); ?>" alt="Logo">
            </a>
        <?php endif; ?>

        <nav>
            <ul>
                <?php if (have_rows('menu_items', 'option')) :
                    while (have_rows('menu_items', 'option')) : the_row();
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
        </nav>

        <?php $btn = get_field('bouton_recrutement_lien', 'option'); ?>
        <?php if ($btn): ?>
            <a class="btn-recrutement" href="<?php echo esc_url($btn['url']); ?>" target="<?php echo esc_attr($btn['target']); ?>">
                <?php echo esc_html($btn['title']); ?>
            </a>
        <?php endif; ?>
    </header>