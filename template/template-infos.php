<?php
/*
 * Template Name: Infos pratiques
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
    
   
        <?php
         
            $section_1 = get_field('section_1');

            // Vérifie qu'on a bien des données
            if ($section_1) :
                $titre_numero_urgence = $section_1['titre_section_numero_durgence'] ?? null;
                $contenu_numero_urgence = $section_1['texte_section_numero_durgence'] ?? null;
            ?>

            <?php if ($titre_numero_urgence || $contenu_numero_urgence): ?>
            <section class="section-numero-d'urgence">
                <div class="numero-durgence">
                    <?php if ($titre_numero_urgence): ?>
                        <h2><?php echo esc_html($titre_numero_urgence); ?></h2>
                    <?php endif; ?>
                </div>
                <?php if ($contenu_numero_urgence): ?>
                    <div class="Paragraphe numero-durgence wysiwyg">
                        <?php echo $contenu_numero_urgence; ?>
                    </div>
                <?php endif; ?>
                </section>
            <?php endif; ?>
        <?php endif; ?>


        <?php
     
            $section_2 = get_field('section_2');
            // Vérifie qu'on a bien des données
            if ($section_2) :
                $titre_rapport = $section_2['titre_section_rapport_dactivite'] ?? null;
                $contenu_rapport = $section_2['texte_section_rapport_dactivite'] ?? null;
                $fichier_pdf = $section_2['fichier_pdf_rapport_dactivite'] ?? null; 
            ?>

            <?php if ($titre_rapport || $contenu_rapport || $fichier_pdf): ?>
            <section class="section-rapport-dactivite">
                <div class="titre-rapport-dactivite">
                    <?php if ($titre_rapport): ?>
                        <h2><?php echo esc_html($titre_rapport); ?></h2>
                    <?php endif; ?>
                </div>

                <?php if ($contenu_rapport): ?>
                    <div class="Paragraphe rapport-dactivite wysiwyg">
                        <?php echo $contenu_rapport; ?>
                    </div>
                <?php endif; ?>

                <?php if ($fichier_pdf): ?>
                    <div class="telecharger-rapport">
                        <a class="btn-rapport" href="<?php echo esc_url($fichier_pdf['url']); ?>" target="_blank" download>
                            📄 Télécharger le rapport d’activité
                        </a>
                    </div>
                <?php endif; ?>
            </section>
            <?php endif; ?>
        <?php endif; ?>

        <?php
            $section_3 = get_field('section_3');
            // Vérifie qu'on a bien des données
     
            if ($section_3) :
                $titre_nosfinanceurs = $section_3['titre_section_nos_financeurs'] ?? null;
                $contenu_nosfinanceurs = $section_3['texte_section_nos_financeurs'] ?? null;
                $repeteur_nosfinanceurs = $section_3['repeteur_nos_financeurs'] ?? null;
            ?>

            <?php if ($titre_nosfinanceurs || $contenu_nosfinanceurs || $repeteur_nosfinanceurs): ?>
            <section class="section-nosfinanceurs">
                <div class="titre-nosfinanceurs">
                    <?php if ($titre_nosfinanceurs): ?>
                        <h2><?php echo esc_html($titre_nosfinanceurs); ?></h2>
                    <?php endif; ?>
                </div>

                <?php if ($contenu_nosfinanceurs): ?>
                    <div class="Paragraphe partenaire wysiwyg">
                        <?php echo $contenu_nosfinanceurs; ?>
                    </div>
                <?php endif; ?>

                <?php if ($repeteur_nosfinanceurs): ?>
                    <div class="nosfinanceurs_galerie">
                        <?php foreach ($repeteur_nosfinanceurs as $item): ?>
                            <?php
                                $image = $item['image_du_repeteur'] ?? null;
                                $lien = $item['lien_nos_financeurs'] ?? null;
                            ?>
                            <?php if ($image): ?>
                                <a href="<?php echo esc_url($lien); ?>" target="_blank" class="partenaire__item">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>">
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
            <?php endif; ?>
        <?php endif; ?>

        <?php
            $section_4 = get_field('section_4');
            // Vérifie qu'on a bien des données
            if ($section_4) :
                $titre_nos_partenaire = $section_4['titre_section_nos_partenaires'] ?? null;
                $contenu_nos_partenaire = $section_4['texte_section_nos_partenaires'] ?? null;
                $repeteur_nos_partenaire = $section_4['repeteur_nos_partenaires'] ?? null;
            ?>

            <?php if ($titre_nos_partenaire || $contenu_nos_partenaire || $repeteur_nos_partenaire): ?>
            <section class="section-nos-partenaire">
                <div class="titre-nos-partenaire">
                    <?php if ($titre_nos_partenaire): ?>
                        <h2><?php echo esc_html($titre_nos_partenaire); ?></h2>
                    <?php endif; ?>
                </div>
                <?php if ($contenu_nos_partenaire): ?>
                    <div class="Paragraphe nos-partenaire wysiwyg">
                        <?php echo $contenu_nos_partenaire; ?>
                    </div>
                <?php endif; ?>
                <?php if ($repeteur_nos_partenaire): ?>
                    <div class="nos-partenaire_galerie">
                        <?php foreach ($repeteur_nos_partenaire as $item): ?>
                            <?php
                                $image_nos_partenaire = $item['image_du_repeteur'] ?? null;
                                $lien_nos_partenaire = $item['lien_partenaire'] ?? null;
                            ?>
                            <?php if ($image_nos_partenaire): ?>
                                <a href="<?php echo esc_url($lien); ?>" target="_blank" class="nos-partenaire_item">
                                    <img src="<?php echo esc_url($image_nos_partenaire['url']); ?>" alt="<?php echo esc_attr($image_nos_partenaire['alt'] ?? ''); ?>">
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
            <?php endif; ?>
        <?php endif; ?>
</main>


<?php
get_footer();
?>