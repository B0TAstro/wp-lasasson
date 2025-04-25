<?php
/*
 * Template Name: Nous soutenir
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

    </main>

<?php
get_footer();
?>