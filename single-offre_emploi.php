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

    <div class="hero hero-offre-emploi">
        <?php
        $parent_id = wp_get_post_parent_id(get_the_ID());
        $return_url = $parent_id ? get_permalink($parent_id) : home_url();
        ?>
        <a href="<?php echo esc_url($return_url); ?>" class="return-button">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/back-button.svg" alt="Retour">
        </a>

        <h1 class="dispositif-title"><?php the_title(); ?></h1>

        <?php
        $entete = get_field('entete_offre');
        ?>
        <div class="offre-header">
            <div class="offre-validite">Offre valide jusqu'au <?php echo esc_html($entete['date_validite']); ?></div>

            <?php if (!empty($entete['lien_france_travail'])) : ?>
                <a class="offre-reference-link" href="<?php echo esc_url($entete['lien_france_travail']); ?>" target="_blank" rel="noopener">
                    <div class="offre-reference">Ref. de l'offre : <?php echo esc_html($entete['reference_offre']); ?></div>
                </a>
            <?php else : ?>
                <div class="offre-reference-link no-link">
                    <div class="offre-reference">Ref. de l'offre : <?php echo esc_html($entete['reference_offre']); ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <section class="section-offre-emploi">
        <?php $objectifs = get_field('objectifs_generaux');
        if (!empty($objectifs)) : ?>
            <div class="offre-section">
                <h2>OBJECTIFS GÉNÉRAUX</h2>
                <div class="wysiwyg offre-section-content">
                    <?php echo $objectifs; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php $description = get_field('description_poste');
        if (!empty($description)) : ?>
            <div class="offre-section">
                <h2>DESCRIPTION DU POSTE</h2>
                <div class="wysiwyg offre-section-content">
                    <?php echo $description; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php $savoir = get_field('savoir_faire');
        if (!empty($savoir)) : ?>
            <div class="offre-section">
                <h2>SAVOIR FAIRE</h2>
                <div class="wysiwyg offre-section-content">
                    <?php echo $savoir; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php $connaissances = get_field('connaissances_associees');
        if (!empty($connaissances)) : ?>
            <div class="offre-section">
                <h2>CONNAISSANCES ASSOCIÉES</h2>
                <div class="wysiwyg offre-section-content">
                    <?php echo $connaissances; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php $capacites = get_field('capacites_relationnelles');
        if (!empty($capacites)) : ?>
            <div class="offre-section">
                <h2 class="section-title">CAPACITÉS RELATIONNELLES</h2>
                <div class="wysiwyg offre-section-content">
                    <?php echo $capacites; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php $statut = get_field('statut_remuneration');
        if (!empty($statut)) : ?>
            <div class="offre-section last">
                <h2 class="section-title">STATUT ET RÉMUNÉRATION</h2>
                <div class="wysiwyg offre-section-content">
                    <?php echo $statut; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $page_recrutement = get_page_by_path('recrutement');
        $recrutement_url = $page_recrutement ? get_permalink($page_recrutement->ID) : home_url('/');
        $poste_encoded = urlencode(get_the_title());
        $candidature_url = $recrutement_url . '?poste=' . $poste_encoded;
        ?>
        <div class="offre-candidature">
            <a href="<?php echo esc_url($candidature_url); ?>" class="btn-primary btn-candidature">
                <?php echo esc_html(get_field('texte_bouton')); ?>
            </a>
        </div>
    </section>
</main>

<?php
get_footer();
?>