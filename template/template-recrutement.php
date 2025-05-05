<?php
/*
 * Template Name: Recrutement
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

    <div class="recrutement-container">

        <?php $navigation = get_field('navigation_recrutement'); ?>
        <div class="recrutement-nav">
            <a href="#offres-emplois" class="btn-primary btn-nav"><?php echo esc_html($navigation['bouton_emplois']); ?></a>
            <a href="#candidature-spontanee" class="btn-primary btn-nav"><?php echo esc_html($navigation['bouton_candidature']); ?></a>
        </div>

        <?php $section1 = get_field('section1_recrutement'); ?>
        <?php
        ?>
        <section id="offres-emplois" class="section-offres-emplois">
            <h2><?php echo esc_html($section1['titre_section_offres']); ?></h2>

            <div class="offres-container">
                <?php
                $today = date('Y-m-d');
                $args = array(
                    'post_type'      => 'offre_emploi',
                    'posts_per_page' => 6,
                    'post_status'    => 'publish',
                );

                if (isset($section1['mode_affichage_offres'])) {
                    if ($section1['mode_affichage_offres'] === 'valides') {
                        $args['meta_query'] = array(
                            array(
                                'key'     => 'section1_offreemplois_date_expiration',
                                'value'   => $today,
                                'compare' => '>=',
                                'type'    => 'DATE'
                            )
                        );
                    } elseif ($section1['mode_affichage_offres'] === 'selection') {
                        if (!empty($section1['selection_offres'])) {
                            $post_ids = array_map(fn($p) => $p->ID, $section1['selection_offres']);
                            $args['post__in'] = $post_ids;
                            $args['orderby'] = 'post__in';
                        }
                    }
                }

                $offres_query = new WP_Query($args);

                if ($offres_query->have_posts()) :
                    while ($offres_query->have_posts()) : $offres_query->the_post();
                        $offre_data = get_field('section1_offreemplois');
                        $date_expiration = isset($offre_data['date_expiration']) ? $offre_data['date_expiration'] : '';
                        $lieu_travail = isset($offre_data['lieu_travail']) ? $offre_data['lieu_travail'] : '';
                ?>
                        <article class="offre-item">
                            <div class="offre-content">
                                <div>
                                    <h3><?php the_title(); ?></h3>
                                    <div class="offre-date"><?php echo get_the_date(); ?></div>
                                    <div class="offre-description">
                                        ➝ <?php
                                            if (!empty($offre_data['texte'])) {
                                                $content = strip_tags($offre_data['texte']);
                                                echo wp_trim_words($content, 100, '...');
                                            }
                                            elseif (has_excerpt()) {
                                                echo strip_tags(get_the_excerpt());
                                            }
                                            else {
                                                $content = get_the_content();
                                                $content = apply_filters('the_content', $content);
                                                $content = strip_tags($content);
                                                echo wp_trim_words($content, 100, '...');
                                            }
                                            ?>
                                    </div>
                                    <?php if ($lieu_travail) : ?>
                                        <div class="offre-lieu">
                                            Lieu de travail : <?php echo esc_html($lieu_travail); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($date_expiration) : ?>
                                        <div class="offre-expiration">OFFRE VALIDE JUSQU'AU : <?php echo esc_html($date_expiration); ?></div>
                                    <?php endif; ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="offre-link">Lire la suite ➝</a>
                            </div>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <p class="no-offres">Il n'y a pas d'offres d'emplois pour le moment.</p>
                <?php endif; ?>
            </div>

            <?php if ($offres_query->have_posts() && $offres_query->max_num_pages > 1) : ?>
                <button class="btn-primary btn-load-more" id="load-more-offres" data-page="1" data-max="<?php echo $offres_query->max_num_pages; ?>">
                    <?php echo esc_html($section1['texte_bouton_plus_offres']); ?>
                </button>
            <?php endif; ?>
        </section>

        <?php $section2 = get_field('section2_recrutement'); ?>
        <section id="candidature-spontanee" class="candidature-spontanee">
            <h2><?php echo esc_html($section2['titre']); ?></h2>
            <div class="wysiwyg intro-text">
                <?php echo wp_kses_post($section2['texte_introduction']); ?>
            </div>

            <form class="candidature-form" id="candidatureForm" method="post" enctype="multipart/form-data">
                <p class="required-note">* champs à remplir obligatoirement</p>

                <div class="form-row">
                    <div class="form-group">
                        <input type="text" id="nom" name="nom" placeholder="<?php echo esc_html($section2['label_nom']); ?> *" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <input type="text" id="prenom" name="prenom" placeholder="<?php echo esc_html($section2['label_prenom']); ?> *" required>
                    </div>
                </div>

                <div class="form-row two-columns">
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="<?php echo esc_html($section2['label_email']); ?> *" required>
                    </div>

                    <div class="form-group">
                        <input type="tel" id="telephone" name="telephone" placeholder="<?php echo esc_html($section2['label_telephone']); ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <div class="select-wrapper">
                            <select id="objet" name="objet" required>
                                <option value="" disabled selected><?php echo esc_html($section2['label_objet']); ?> *</option>
                                <?php
                                if ($section2['objets_demande']) :
                                    foreach ($section2['objets_demande'] as $objet) :
                                ?>
                                        <option value="<?php echo esc_attr($objet['libelle']); ?>"><?php echo esc_html($objet['libelle']); ?></option>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <div class="select-wrapper">
                            <select id="service" name="service" required>
                                <option value="" disabled selected><?php echo esc_html($section2['label_service']); ?> *</option>
                                <?php
                                if ($section2['services']) :
                                    foreach ($section2['services'] as $service) :
                                ?>
                                        <option value="<?php echo esc_attr($service['email']); ?>"><?php echo esc_html($service['nom']); ?></option>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <textarea id="message" name="message" rows="8" placeholder="<?php echo esc_html($section2['label_message']); ?> *" required></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group file-upload">
                        <label for="cv"><?php echo esc_html($section2['label_cv']); ?> (pdf, word, txt - max 5Mo)</label>
                        <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx,.txt" required>
                        <div class="file-select">
                            <span class="file-selected">Choisir un fichier</span>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group file-upload">
                        <label for="lettre_motivation"><?php echo esc_html($section2['label_lm']); ?> (pdf, word, txt - max 5Mo)</label>
                        <input type="file" id="lettre_motivation" name="lettre_motivation" accept=".pdf,.doc,.docx,.txt" required>
                        <div class="file-select"></div>
                        <span class="file-selected">Choisir un fichier</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group checkbox">
                        <input type="checkbox" id="consent" name="consent" required>
                        <label for="consent">En soumettant ce formulaire, j’accepte que les informations saisies soient exploitées et stockées dans le cadre de ma demande</label>
                    </div>
                </div>

                <button type="submit" class="btn-primary btn-submit"><?php echo esc_html($section2['texte_bouton']); ?></button>
            </form>
        </section>
    </div>
</main>

<?php
get_footer();
?>