<?php
/*
 * Template Name: Qui nous sommes
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
       
       $section_1_qui = get_field('section_1_qui');

            if ($section_1_qui) :
                $titre_qui_somme_nous = $section_1_qui['titre_qui_sommes_nous'] ;
                $texte_qui_somme_nous = $section_1_qui['texte_qui_somme_nous'] ;
                $texte2_qui_somme_nous = $section_1_qui['texte_qui_somme_nous2'] ;
                $image_qui_somme_nous = $section_1_qui['image_qui_sommes_nous'] ;
                $texte3_qui_somme_nous = $section_1_qui['texte_qui_somme_nous_3'] ;
                $bouton_telechargement_qui_somme_nous = $section_1_qui['bouton_telechargement'] ;
                $texte_du_bouton_de_telechargment=$section_1_qui['texte_du_bouton_telechargement']
                
            ?>
            <section class="who-are-we-section">
                <div class="who-are-we-container">                               
                        <h2><?php echo esc_html($titre_qui_somme_nous); ?></h2>                             
                    <div class="who-are-we-paragraph wysiwyg">
                        <?php echo $texte_qui_somme_nous; ?>
                        <?php echo $texte2_qui_somme_nous; ?>
                    </div>    

                        <img src="<?php echo esc_url($image_qui_somme_nous['url']); ?>" alt="<?php echo esc_attr($image_qui_somme_nous['alt'] ?? ''); ?>">

                    <div class="who-are-we-paragraph2 wysiwyg">
                        <?php echo $texte3_qui_somme_nous; ?>
                    </div>

                         <a class="btn-secondary btn-infos" href="<?php echo esc_url($bouton_telechargement_qui_somme_nous['url']); ?>" target="_blank" download>
                            <?php echo esc_html($texte_du_bouton_de_telechargment); ?>
                        </a>                
                </div>
            </section> 
            
        <?php endif; ?>  

        <?php 
   
            $section_2_nos_missions = get_field('section_2_nos_missions');

            if ($section_2_nos_missions):
                $title_nos_missions = $section_2_nos_missions['titre_nos_missions'];
                $text_nos_missions = $section_2_nos_missions['texte_nos_missions'];
                $title_axes_intervention = $section_2_nos_missions['titre_axes_intervention'];
                $axes_items = $section_2_nos_missions['repeteur_axes_dintervention'];
            ?>

            <section class="section-nos-missions">
                <div class="container-nos-missions">

                    <div class="bloc-nos-missions">
                        <h2><?php echo esc_html($title_nos_missions); ?></h2>

                        <div class="paragraphe-nos-missions wysiwyg">
                            <?php echo wp_kses_post($text_nos_missions); ?>
                        </div>
                    </div>

                    <div class="bloc-axes-intervention">
                        <h3><?php echo esc_html($title_axes_intervention); ?></h3>

                        <div class="axes-intervention-liste">
                            <?php foreach ($axes_items as $axe) : 
                                $axe_titre = $axe['titre_de_laxe_dintervention'];
                                $axe_texte = $axe['texte_de_laxe_de_lintervention'];
                                $axe_image = $axe['image_de_laxe_de_lintervention'];
                            ?>
                                <div class="axe-intervention-item">
                                        <div class="axe-image">
                                            <img src="<?php echo esc_url($axe_image['url']); ?>" alt="<?php echo esc_attr($axe_image['alt'] ?? ''); ?>">
                                        </div>

                                    <div class="axe-contenu">
                                    
                                            <h4><?php echo esc_html($axe_titre); ?></h4>    
                                            
                                        <div class="paragraphe-nos-missions wysiwyg">
                                            <p><?php echo wp_kses_post($axe_texte); ?></p>
                                        </div> 
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </section>

        <?php endif; ?>


        <?php
            $section_3_nos_objectifs = get_field('section_3_nos_objectifs');
            if ($section_3_nos_objectifs) :
                $titre_nosobjectifs = $section_3_nos_objectifs['titre_nos_objectifs'];
                $texte_nosobjectifs = $section_3_nos_objectifs['texte_nos_objectifs'];
                $repeteur_nosobjectifs = $section_3_nos_objectifs['repeteur_nos_objectifs'];
            ?>

            <section class="objectifs-section">
                <div class="objectifs-container">

                    <h2><?php echo esc_html($titre_nosobjectifs); ?></h2>

                    <div class="objectifs-paragraph wysiwyg">
                        <?php echo wp_kses_post($texte_nosobjectifs); ?>
                    </div>

                    <?php if ($repeteur_nosobjectifs) : ?>
                        <div class="objectifs-list">
                            <?php foreach ($repeteur_nosobjectifs as $objectif) : 
                                $objectif_titre = $objectif['titre_de_lobjectif'];
                                $objectif_texte = $objectif['texte_de_lobjectif'];
                            ?>
                                <div class="objectif-item">
                                    <h3><?php echo esc_html($objectif_titre); ?></h3>
                                        <div class="objectif-text">
                                            <p><?php echo wp_kses_post($objectif_texte); ?></p>
                                        </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>      
                </div>
            </section>
        <?php endif; ?>

        <?php 
            $section_4_nos_valeurs = get_field('section_4_nos_valeurs');
            if ($section_4_nos_valeurs) :
                $titre_nos_valeurs = $section_4_nos_valeurs['titre_nos_valeurs'];
                $texte_nos_valeurs = $section_4_nos_valeurs['texte_nos_valeurs'];
                $repeteur_nos_valeurs = $section_4_nos_valeurs['repeteur_nos_valeurs'];
          
            ?>
            <section class="valeurs-section">
                <div class="valeurs-container">

                    <h2><?php echo esc_html($titre_nos_valeurs); ?></h2>

                    <div class="valeurs-paragraph wysiwyg">
                        <?php echo wp_kses_post($texte_nos_valeurs); ?>
                    </div>

                    <?php if ($repeteur_nos_valeurs) : ?>
                        <div class="valeurs-list">
                            <?php foreach ($repeteur_nos_valeurs as $valeur) : 
                                $valeur_titre = $valeur['titre_de_la_valeur'];
                                $valeur_texte = $valeur['texte_de_la_valeur'];
                                $valeur_image = $valeur['image_de_la_valeur'];
                            ?>
                                <div class="valeur-item">
                                    <h3><?php echo esc_html($valeur_titre); ?></h3>
                                        <div class="valeur-text">
                                            <p><?php echo wp_kses_post($valeur_texte); ?></p>
                                        </div>
                                        
                                <img src="<?php echo esc_url($valeur_image['url']); ?>" alt="<?php echo esc_attr($valeur_image['alt'] ?? ''); ?>">
                          
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>      
                </div>
            </section>
        <?php endif; ?>  
        
        <?php 
            $section_5_les_gens_du_mois = get_field('section_5_les_gens_du_mois');
            if ($section_5_les_gens_du_mois) :

                $titre_section = $section_5_les_gens_du_mois['titre_les_gens_du_mois'];

                $bloc_de_gauche = $section_5_les_gens_du_mois['bloc_de_gauche'];
                $image_gauche = $bloc_de_gauche['image_de_la_personne_de_gauche'];
                $titre_gauche = $bloc_de_gauche['titre_de_la_personne_de_gauche'];
                $soustitre_gauche = $bloc_de_gauche['sous-titre_de_la_personne_de_gauche'];

                $bloc_du_centre = $section_5_les_gens_du_mois['bloc_du_centre'];
                $wysiwyg_haut = $bloc_du_centre['texte_du_haut'];
                $wysiwyg_bas = $bloc_du_centre['texte_du_bas'];
                $bouton_article = $bloc_du_centre['bouton_vers_larticle'];

                $bloc_de_droite = $section_5_les_gens_du_mois['bloc_de_droite'];
                $image_droit = $bloc_de_droite['image_de_la_personne_de_droite'];
                $titre_droit = $bloc_de_droite['titre_de_la_personne_de_droite'];
                $soustitre_droit = $bloc_de_droite['sous-titre_de_la_personne_de_droite'];

            ?>

            <section class="gens-du-mois-section">
                <div class="gens-du-mois-container">

                    <h2><?php echo esc_html($titre_section); ?></h2>

                    <div class="gens-du-mois-blocs">

                        <div class="bloc bloc-gauche">
                            <?php if ($image_gauche) : ?>
                                <img src="<?php echo esc_url($image_gauche['url']); ?>" alt="<?php echo esc_attr($image_gauche['alt'] ?? ''); ?>">
                            <?php endif; ?>
                            <h3><?php echo esc_html($titre_gauche); ?></h3>
                            <p><?php echo esc_html($soustitre_gauche); ?></p>
                        </div>

                        <div class="bloc bloc-centre">
                            <div class="wysiwyg wysiwyg-haut">
                                <?php echo wp_kses_post($wysiwyg_haut); ?>
                            </div>
                            <div class="wysiwyg wysiwyg-bas">
                                <?php echo wp_kses_post($wysiwyg_bas); ?>
                            </div>                                
                        </div>

                        <div class="bloc bloc-droit">
                            <?php if ($image_droit) : ?>
                                <img src="<?php echo esc_url($image_droit['url']); ?>" alt="<?php echo esc_attr($image_droit['alt'] ?? ''); ?>">
                            <?php endif; ?>
                            <h3><?php echo esc_html($titre_droit); ?></h3>
                            <div class="sous-titre">
                                <p><?php echo esc_html($soustitre_droit); ?></p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        <?php endif; ?>


    </main>
<?php
get_footer();
?>