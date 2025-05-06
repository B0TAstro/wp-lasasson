    <footer>
        <div class="footer-infos">
            <ul>
                <li>© <?php echo date('Y'); ?></li>
                <?php if (have_rows('footer_links', 'options')) :
                    while (have_rows('footer_links', 'options')) : the_row();
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

                if (have_rows('footer_socials', 'options')) :
                    while (have_rows('footer_socials', 'options')) : the_row();
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