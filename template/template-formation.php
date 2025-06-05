<?php
/*
 * Template Name: Formation
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
                $section_1_former = get_field('section_1_former');

                if ($section_1_former) :
                    $bouton_professionnels = $section_1_former['bouton_professionnels'];
                    $bouton_salaries = $section_1_former['bouton_salaries'];
                    $titre_former = $section_1_former['titre_former'];
                    $texte_former = $section_1_former['texte_former'];
                    $texte_objectifs = $section_1_former['texte_objectifs'];
                ?>
                <section class="section-formation">
                    <div class="container-formation">  
                         <a href="<?php echo esc_url($bouton_professionnels['url']); ?>" target="<?php echo esc_attr($bouton_professionnels['target'] ?? '_self'); ?>" class="btn-secondary btn-formation">
                            <?php echo esc_html($bouton_professionnels['title']); ?>
                        </a>
                        <a href="<?php echo esc_url($bouton_salaries['url']); ?>" target="<?php echo esc_attr($bouton_salaries['target'] ?? '_self'); ?>" class="btn-secondary btn-formation">
                            <?php echo esc_html($bouton_salaries['title']); ?>
                        </a>

                        <h2><?php echo esc_html($titre_former); ?></h2>
                        <div class="Paragraphe-formation wysiwyg">
                            <?php echo wp_kses_post($texte_former); ?>
                        </div>
                        <div class="Paragraphe-objectifs wysiwyg">
                            <?php echo wp_kses_post($texte_objectifs); ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <div class="bandeauformation">
            <?php 
            // bandeau entre la section 1 et 2
                $bandeau_1_formeraqui = get_field('bandeau_1_formeraqui');
            ?>
                <img src="<?php echo esc_url($bandeau_1_formeraqui['url']); ?>" alt="<?php echo esc_attr($bandeau_1_formeraqui['alt'] ?? ''); ?>">
            </div>

            <?php
                $section_2_aqui = get_field('section_2_aqui');

                if ($section_2_aqui) :
                    $titre_a_qui = $section_2_aqui['titre_a_qui'];
                    $texte_de_droite = $section_2_aqui['texte_de_droite'];
                    $texte_de_gauche = $section_2_aqui['texte_de_gauche'] ?? [];
                ?>
                <section class="section-aqui">
                    <div class="container-aqui">
                        <h2><?php echo esc_html($titre_a_qui); ?></h2>
                        <div class="blocs-container">
                            <div class="Paragraphe-de-gauche wysiwyg">
                                <?php echo $texte_de_gauche; ?>
                            </div>
                            <div class="Paragraphe-de-droite wysiwyg">
                                <?php echo $texte_de_droite; ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <div class="bandeauformation">
                <?php 
                // bandeau entre la section 2 et 3
                    $bandeau_2_aquiapproche = get_field('bandeau_2_aquiapproche');
                ?>
                    <img src="<?php echo esc_url($bandeau_2_aquiapproche['url']); ?>" alt="<?php echo esc_attr($bandeau_2_aquiapproche['alt'] ?? ''); ?>">
            </div>

            <?php
                $section_3_approche = get_field('section_3_approche');

                if ($section_3_approche) :
                    $titre_approche = $section_3_approche['titre_approche'];
                    $texte_approche = $section_3_approche['texte_approche'];
                    $texte_2_approche = $section_3_approche['texte_2_approche'];
                    $titre_nos_formation_phares = $section_3_approche['titre_nos_formation_phares'];
                    $formations = $section_3_approche['formations'];
                ?>

                    <section class="approche">
                        <div class="container">
                                <h2><?php echo esc_html($titre_approche); ?></h2>                  

                            <div class="approche-introduction">
                                <div class="intro-text wysiwyg">
                                    <?php echo wp_kses_post($texte_approche); ?>
                                </div>
                                <div class="second-text wysiwyg">
                                    <?php echo wp_kses_post($texte_2_approche); ?>
                                </div>
                            </div>

                            <div class="approche-formations">
                                <h3><?php echo esc_html($titre_nos_formation_phares); ?></h3>

                                <div class="formations-list">
                                    <?php foreach ($formations as $formation): ?>
                                        <div class="formation-item">
                                            <h4><?php echo esc_html($formation['type_de_formations']); ?></h4>

                                            <div class="item-text wysiwyg">
                                                <?php echo wp_kses_post($formation['texte_formation']); ?>
            
                                                <?php echo wp_kses_post($formation['texte_duree']); ?>
                                            </div>

                                                <a href="<?php echo esc_url($formation['fichier_pdf']['url']); ?>" target="_blank" rel="noopener noreferrer">
                                                    <?php echo esc_html($formation['texte_du_bouton_pdf']); ?>
                                                </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </section>
            <?php endif; ?>

             <div class="bandeauformation">
                <?php 
                // bandeau entre la section 1 et 2
                    $bandeau_3_formation_phareformulaire = get_field('bandeau_3_formation_phareformulaire');
                ?>
                    <img src="<?php echo esc_url($bandeau_3_formation_phareformulaire['url']); ?>" alt="<?php echo esc_attr($bandeau_3_formation_phareformulaire['alt'] ?? ''); ?>">
            </div>

            <?php
                $section_4_formulaire = get_field('section_4_formulaire');

                if ($section_4_formulaire) :
                    $titre_contact = $section_4_formulaire['titre_contact'];
                    $texte_contact = $section_4_formulaire['texte_contact'];
                    $nom_formulaire = $section_4_formulaire['nom_formulaire'];
                    $prenom_formulaire = $section_4_formulaire['prenom_formulaire'];
                    $mail_formulaire = $section_4_formulaire['mail_formulaire'];
                    $telephone_formulaire = $section_4_formulaire['telephone_formulaire'];
                    $message_formulaire = $section_4_formulaire['message_formulaire'];
                    $texte_bouton_envoi = $section_4_formulaire['texte_bouton_envoi'];
                    
                ?>
                <section class="section-formulaire">
                    <div class="container-formulaire">
                        <h2><?php echo esc_html($titre_contact); ?></h2>

                        <div class="Paragraphe-contact wysiwyg">
                            <?php echo $texte_contact; ?>
                        </div>

                        <form class="formation-form" id="formationForm">
                            <p class="required">* mentions à remplir obligatoirement</p>

                            <div class="form">
                                <div class="form-element">
                                    <input type="text" id="nom" name="nom" placeholder="<?php echo esc_html($nom_formulaire); ?> *" required>
                                </div>
                            </div>

                            <div class="form">
                                <div class="form-element">
                                    <input type="text" id="prenom" name="prenom" placeholder="<?php echo esc_html($prenom_formulaire); ?> *" required>
                                </div>
                            </div>

                            <div class="form-two-elements">
                                <div class="form-element">
                                    <input type="email" id="email" name="email" placeholder="<?php echo esc_html($mail_formulaire); ?> *" required>
                                </div>

                                <div class="form-element">
                                    <input type="tel" id="telephone" name="telephone" placeholder="<?php echo esc_html($telephone_formulaire); ?>">
                                </div>
                            </div>

                            <div class="form">
                                <div class="form-element">
                                    <textarea id="messager" name="messager" rows="8" placeholder="<?php echo esc_html($message_formulaire); ?> *"></textarea>
                                </div>
                            </div>

                            <div class="form">
                                <div class="form-element checkbox">
                                    <input type="checkbox" id="consentement" name="consentement" required>
                                    <label for="consentement">En soumettant ce formulaire, j’accepte que les informations saisies soient exploitées et stockées dans le cadre de ma demande</label>
                                </div>
                            </div>

                            <button type="submit" class="btn-primary btn-submit"><?php echo esc_html($texte_bouton_envoi); ?></button>
                        </form>
                    </div>
                </section>
            <?php endif; ?>
            
             <div class="bandeauformation">
                <?php 
                // bandeau entre la section 4 et 5
                    $bandeau_4_formulaireengagement = get_field('bandeau_4_formulaireengagement');
                ?>
                    <img src="<?php echo esc_url($bandeau_4_formulaireengagement['url']); ?>" alt="<?php echo esc_attr($bandeau_4_formulaireengagement['alt'] ?? ''); ?>">
            </div>

        <?php
            $section_5_engagement = get_field('section_5_engagement');

            if ($section_5_engagement) :
                $titre_engagement = $section_5_engagement['titre_engagement'];
                $image_certification = $section_5_engagement['image_certification'];
                $texte_referent_handicap = $section_5_engagement['texte_referent_handicap'];
                $bouton_reglement_interieur = $section_5_engagement['bouton_reglement_interieur'];
                $bouton_condition_generale_de_vente = $section_5_engagement['bouton_condition_generale_de_vente'];
                $bouton_registre_daccessibilite = $section_5_engagement['bouton_registre_daccessibilite'];
            ?>

            <section class="section-engagement">
                <div class="container-engagement">
                    <h2><?php echo esc_html($titre_engagement); ?></h2>
                    
                    <div class="contenu-principal">
                        <?php if ($image_certification) : ?>
                            <img src="<?php echo esc_url($image_certification['url']); ?>" alt="<?php echo esc_attr($image_certification['alt'] ?? ''); ?>">
                        <?php endif; ?>
                        
                        <div class="Paragraphe-referent-handicap wysiwyg">
                            <?php echo $texte_referent_handicap; ?>
                        </div>
                    </div>
                    
                    <div class="btns-engagement">
                        <?php if ($bouton_reglement_interieur) : ?>
                            <a href="<?php echo esc_url($bouton_reglement_interieur['url']); ?>" target="<?php echo esc_attr($bouton_reglement_interieur['target'] ?? '_self'); ?>" class="btn-secondary">
                                <?php echo esc_html($bouton_reglement_interieur['title']); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($bouton_condition_generale_de_vente) : ?>
                            <a href="<?php echo esc_url($bouton_condition_generale_de_vente['url']); ?>" target="<?php echo esc_attr($bouton_condition_generale_de_vente['target'] ?? '_self'); ?>" class="btn-secondary">
                                <?php echo esc_html($bouton_condition_generale_de_vente['title']); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($bouton_registre_daccessibilite) : ?>
                            <a href="<?php echo esc_url($bouton_registre_daccessibilite['url']); ?>" target="<?php echo esc_attr($bouton_registre_daccessibilite['target'] ?? '_self'); ?>" class="btn-secondary">
                                <?php echo esc_html($bouton_registre_daccessibilite['title']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>    
            </section>
        <?php endif; ?>
    </main>
<?php
get_footer();
?>