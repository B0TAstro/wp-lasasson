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

                <section class="section-numero-urgence">
                    <div class="container-infos-pratiques">
                        <div class="numero-durgence">                        
                                <h2><?php echo esc_html($titre_numero_urgence); ?></h2>
                        </div>
                            <div class="Paragraphe-numero-durgence wysiwyg">
                                <?php echo $contenu_numero_urgence; ?>
                            </div>
                                <a href="<?php echo esc_url($bouton_numero_urgence['url']); ?>" target="_blank<?php echo esc_attr($bouton_numero_urgence['target'] ?? '_self'); ?>" class=" btn-secondary btn-infos">
                                    <?php echo esc_html($bouton_numero_urgence['title']); ?>
                                </a>
                    </div>
                </section>
        <?php endif; ?>

        <?php
     
            $section_2 = get_field('section_2');
          

            if ($section_2) :
                $titre_rapport = $section_2['titre_section_rapport_dactivite'] ?? null;
                $contenu_rapport = $section_2['texte_section_rapport_dactivite'] ?? null;
                $fichier_pdf = $section_2['fichier_pdf_rapport_dactivite'] ?? null; 
                $texte_bouton = $section_2['texte_bouton_pdf'] ?? null;
            ?>

            <section class="section-rapport-dactivite">
                <div class="container-infos-pratiques">
                    <div class="titre-rapport-dactivite">            
                            <h2><?php echo esc_html($titre_rapport); ?></h2>           
                    </div>

                        <div class="Paragraphe-rapport-dactivite wysiwyg">
                            <?php echo $contenu_rapport; ?>
                        </div>              
                            <a class="btn-secondary btn-infos" href="<?php echo esc_url($fichier_pdf['url']); ?>" target="_blank" download>
                                <?php echo esc_html($texte_bouton); ?>
                            </a>                
                </div>
            </section>        
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

           
                <section class="section-nos-financeurs-et-partenaires">
                    <div class="container-nos-financeurs-et-partenaires">

                      
                        <div class="bloc-nosfinanceurs">
                           
                                <h2><?php echo esc_html($titre_nosfinanceurs); ?></h2>
                                           
                                <div class="Paragraphe-nos-financeurs wysiwyg">
                                    <?php echo $contenu_nosfinanceurs; ?>
                                </div>
                        
                                <div class="nosfinanceurs_galerie">
                                    <?php foreach ($repeteur_nosfinanceurs as $nosfinanceurs): ?>
                                        <?php
                                            $image_nos_financeurs = $nosfinanceurs['image_du_repeteur'] ?? null;
                                            $lien_nos_financeurs = $nosfinanceurs['lien_nos_financeurs'] ?? null;
                                        ?>
                                      
                                            <a href="<?php echo esc_url($lien_nos_financeurs); ?>" target="_blank" class="partenaire__item">
                                                <img src="<?php echo esc_url($image_nos_financeurs['url']); ?>" alt="<?php echo esc_attr($image_nos_financeurs['alt'] ?? ''); ?>">
                                            </a> 
                                    <?php endforeach; ?>
                                </div>
                        </div>
                
                            <div class="bloc-nos-partenaires">

                                <h2><?php echo esc_html($titre_nos_partenaire); ?></h2>

                                    <div class="Paragraphe-nos-partenaire wysiwyg">
                                        <?php echo $contenu_nos_partenaire; ?>
                                    </div>
                                                   
                                    <div class="nos-partenaire_galerie">
                                        <?php foreach ($repeteur_nos_partenaire as $nos_partenaires): ?>
                                            <?php
                                                $image_nos_partenaires = $nos_partenaires['image_du_repeteur_nos_partenaires'] ?? null;
                                                $lien_nos_partenaires = $nos_partenaires['lien_nos_partenaires'] ?? null;
                                            ?>
                                                <a href="<?php echo esc_url($lien_nos_partenaires); ?>" target="_blank" class="partenaire_item">
                                                    <img src="<?php echo esc_url($image_nos_partenaires['url']); ?>" alt="<?php echo esc_attr($image_nos_partenaires['alt'] ?? ''); ?>">
                                                </a>
                                        <?php endforeach; ?>
                                    </div>
                            </div>
                    </div>
                </section>
        <?php endif; ?>
    </main>
<?php
get_footer();
?>