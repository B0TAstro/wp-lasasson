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

     
            if ($section_1) :
                $titre_numero_urgence = $section_1['titre_section_numero_durgence'] ?? null;
                $contenu_numero_urgence = $section_1['texte_section_numero_durgence'] ?? null;
                $bouton_numero_urgence = $section_1['bouton_section_numero_durgence'] ?? null;
            ?>

            <?php if ($titre_numero_urgence || $contenu_numero_urgence || $bouton_numero_urgence): ?>
                <section class="section-numero-urgence">
                    <div class="container-infos-pratiques">
                        <div class="numero-durgence">
                            <?php if ($titre_numero_urgence): ?>
                                <h2><?php echo esc_html($titre_numero_urgence); ?></h2>
                            <?php endif; ?>
                        </div>
                        <?php if ($contenu_numero_urgence): ?>
                            <div class="Paragraphe-numero-durgence wysiwyg">
                                <?php echo $contenu_numero_urgence; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($bouton_numero_urgence): ?>
                            <div class="btn-numero-urgence">
                                <a href="<?php echo esc_url($bouton_numero_urgence['url']); ?>" target="<?php echo esc_attr($bouton_numero_urgence['target'] ?? '_self'); ?>" class=" btn-secondary">
                                    <?php echo esc_html($bouton_numero_urgence['title']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>



        <?php
     
            $section_2 = get_field('section_2');
          

            if ($section_2) :
                $titre_rapport = $section_2['titre_section_rapport_dactivite'] ?? null;
                $contenu_rapport = $section_2['texte_section_rapport_dactivite'] ?? null;
                $fichier_pdf = $section_2['fichier_pdf_rapport_dactivite'] ?? null; 
            ?>

            <?php if ($titre_rapport || $contenu_rapport || $fichier_pdf): ?>
            <section class="section-rapport-dactivite">
                <div class="container-infos-pratiques">
                    <div class="titre-rapport-dactivite">
                        <?php if ($titre_rapport): ?>
                            <h2><?php echo esc_html($titre_rapport); ?></h2>
                        <?php endif; ?>
                    </div>

                    <?php if ($contenu_rapport): ?>
                        <div class="Paragraphe-rapport-dactivite wysiwyg">
                            <?php echo $contenu_rapport; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($fichier_pdf): ?>
                        <div class="telecharger-rapport">
                            <a class="btn-rapport" href="<?php echo esc_url($fichier_pdf['url']); ?>" target="_blank" download>
                                📄 Télécharger le rapport d’activité global 2024
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
            <?php endif; ?>
        <?php endif; ?>

        <?php
            $section_3 = get_field('section_3'); 
           
        if ($section_3) :
                $titre_nosfinanceurs = $section_3['titre_section_nos_financeurs'] ?? null;
                $contenu_nosfinanceurs = $section_3['texte_section_nos_financeurs'] ?? null;
                $repeteur_nosfinanceurs = $section_3['repeteur_nos_financeurs'] ?? null;

                $titre_nos_partenaire = $section_3['titre_section_nos_partenaires'] ?? null;
                $contenu_nos_partenaire = $section_3['texte_section_nos_partenaires'] ?? null;
                $repeteur_nos_partenaire = $section_3['repeteur_nos_partenaires'] ?? null;
                ?>

            <?php if ($titre_nosfinanceurs || $contenu_nosfinanceurs || $repeteur_nosfinanceurs || $titre_nos_partenaire || $contenu_nos_partenaire || $repeteur_nos_partenaire): ?>
                <section class="section-nos-financeurs-et-partenaires">
                    <div class="container-nos-financeurs-et-partenaires">

                        <?php if ($titre_nosfinanceurs || $contenu_nosfinanceurs || $repeteur_nosfinanceurs): ?>
                        <div class="bloc-nosfinanceurs">
                            <?php if ($titre_nosfinanceurs): ?>
                                <h2><?php echo esc_html($titre_nosfinanceurs); ?></h2>
                            <?php endif; ?>

                            <?php if ($contenu_nosfinanceurs): ?>
                                <div class="Paragraphe-partenaire wysiwyg">
                                    <?php echo $contenu_nosfinanceurs; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($repeteur_nosfinanceurs): ?>
                                <div class="nosfinanceurs_galerie">
                                    <?php foreach ($repeteur_nosfinanceurs as $nosfinanceurs): ?>
                                        <?php
                                            $image_nos_financeurs = $nosfinanceurs['image_du_repeteur'] ?? null;
                                            $lien_nos_financeurs = $nosfinanceurs['lien_nos_financeurs'] ?? null;
                                        ?>
                                        <?php if ($image_nos_financeurs): ?>
                                            <a href="<?php echo esc_url($lien_nos_financeurs); ?>" target="_blank" class="partenaire__item">
                                                <img src="<?php echo esc_url($image_nos_financeurs['url']); ?>" alt="<?php echo esc_attr($image_nos_financeurs['alt'] ?? ''); ?>">
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <?php if ($titre_nos_partenaire || $contenu_nos_partenaire || $repeteur_nos_partenaire): ?>
                            <div class="bloc-nos-partenaires">
                                <?php if ($titre_nos_partenaire): ?>
                                    <h2><?php echo esc_html($titre_nos_partenaire); ?></h2>
                                <?php endif; ?>

                                <?php if ($contenu_nos_partenaire): ?>
                                    <div class="Paragraphe-nos-partenaire wysiwyg">
                                        <?php echo $contenu_nos_partenaire; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($repeteur_nos_partenaire): ?>
                                    <div class="nos-partenaire_galerie">
                                        <?php foreach ($repeteur_nos_partenaire as $nos_partenaire): ?>
                                            <?php
                                                $image_nos_partenaire = $nos_partenaire['image_du_repeteur'] ?? null;
                                                $lien_nos_partenaire = $nos_partenaire['lien_partenaire'] ?? null;
                                            ?>
                                            <?php if ($image_nos_partenaire): ?>
                                                <a href="<?php echo esc_url($lien_nos_partenaire); ?>" target="_blank" class="nos-partenaire_item">
                                                    <img src="<?php echo esc_url($image_nos_partenaire['url']); ?>" alt="<?php echo esc_attr($image_nos_partenaire['alt'] ?? ''); ?>">
                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>
    </main>

<?php
get_footer();
?>