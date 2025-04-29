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
        <?php 
    $section_1 = get_field('section_1');
    if ($section_1) :
        $mission_title = $section_1['titre_soutenez_notre_mission'] ;
        $mission_text = $section_1['texte_soutenez_notre_mission'] ;
        $why_support_image = $section_1['image_soutenez_notre_mission'] ;
        $why_support_title = $section_1['titre_pourquoi_nous_soutenir'] ;
        $why_support_text = $section_1['editor_pourquoi_nous_soutenir'] ;
        $dons_title = $section_1['titre_dons'] ;

        $column_1 = $section_1['colonne_1_repeteur_dons']; 
        $column_2 = $section_1['colonne_2_repeteur_action_impact'];  
        $rows = $section_1['repeteur_dons'];  

    ?>
    <section class="support-section">
        <div class="support-container">
            <h2><?php echo esc_html($mission_title); ?></h2>
            <div class="mission-paragraph wysiwyg">
                <?php echo $mission_text; ?>
            </div>
            
            <div class="why-support-block">
                <div class="mission-image">
                    <img src="<?php echo esc_url($why_support_image['url']); ?>" alt="<?php echo esc_attr($why_support_image['alt']); ?>">
                </div>
                <div class="why-support-content">
                    <h3><?php echo esc_html($why_support_title); ?></h3>
                    <div class="why-support-paragraph wysiwyg">
                        <?php echo $why_support_text; ?>
                    </div>
                </div>
            </div>

            <div class="dons">
                <h3><?php echo esc_html($dons_title); ?></h3>
                
                <table class="dons-table">
                    <thead>
                        <tr>
                            <th><?php echo esc_html($column_1); ?></th>
                            <th><?php echo esc_html($column_2); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row) : ?>
                            <tr>
                                <td><?php echo esc_html($row['texte_dons']); ?></td>
                                <td><?php echo esc_html($row['texte_action_impact']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php endif; ?>


    <?php 
        $section_2 = get_field('section_2');
        if ($section_2) :
            $how_support_title = $section_2['titre_comment_nous_soutenir'] ;
            $how_support_text1 = $section_2['texte_cheques'] ;
            $how_support_text2 = $section_2['texte_virement_bancaire'] ;
            $how_support_button1 = $section_2['lien_bouton_don_unique'] ;
            $how_support_button2 = $section_2['lien_bouton_don_mensuel'] ;
            $how_support_image = $section_2['image_comment_nous_soutenir'] ;
            $object_donation_title = $section_2['titre_don_objets'] ;
            $object_donation_text1 = $section_2['texte_accepte_don_objets'] ;
            $object_donation_text2 = $section_2['texte_types_dobjets'] ;
            $object_donation_image = $section_2['image_don_objets'] ;
            $advantages_title = $section_2['titre_avantages_fiscaux'] ;
            $advantages_text = $section_2['texte_avantages_fiscaux'] ;
            
    ?>
        <section class="how-support-section">
            <div class="how-support-container">    
                <div class="how-support-block">
                    <div class="how-support-text">
                        <h2><?php echo esc_html($how_support_title); ?></h2>
                        <div class="how-support-paragraph wysiwyg">
                            <?php echo $how_support_text1; ?>
                            <?php echo $how_support_text2; ?>
                        </div>

                        <div class="how-support-buttons">
                            <a href="<?php echo esc_url($how_support_button1['url']); ?>" target="<?php echo esc_attr($how_support_button1['target'] ?? '_self'); ?>" class="btn-primary">
                                <?php echo esc_html($how_support_button1['title']); ?>
                            </a>
                        
                            <a href="<?php echo esc_url($how_support_button2['url']); ?>" target="<?php echo esc_attr($how_support_button2['target'] ?? '_self'); ?>" class="btn-primary">
                                <?php echo esc_html($how_support_button2['title']); ?>
                            </a>
                        </div>
                    </div>    

                    <div class="how-support-image">
                        <img src="<?php echo esc_url($how_support_image['url']); ?>" alt="<?php echo esc_attr($how_support_image['alt']); ?>">
                    </div>
                </div>
            
                <div class="objects-block"> 
                    <div class="objects-text">           
                        <h3><?php echo esc_html($object_donation_title); ?></h3>
                        <div class="objects-paragraph wysiwyg">
                            <?php echo $object_donation_text1; ?>
                            <?php echo $object_donation_text2; ?>
                        </div>
                    </div>
                        <div class="objects-image">
                            <img src="<?php echo esc_url($object_donation_image['url']); ?>" alt="<?php echo esc_attr($object_donation_image['alt']); ?>">
                        </div>
                </div>

                <div class="advantages-block">            
                    <h2><?php echo esc_html($advantages_title); ?></h2>
                    <div class="advantages-paragraph wysiwyg">
                        <?php echo $advantages_text; ?>
                    </div>
                </div>
            </div>
        </section>  
    <?php endif; ?>


    <?php
        $section_3 = get_field('section_3');
        if ($section_3) :
            $Emergency_call_title = $section_3['titre_appel_urgent'];
            $Emergency_call_text = $section_3['editor_appel_urgent'];
            $button_text = $section_3['texte_bouton']; 
            $recipient_email = $section_3['email']; 
           
            // Encodage correct du sujet pour le lien mailto
            $subject = rawurlencode($Emergency_call_title);
            
            // Créer le lien mailto avec l'adresse email
            $mailto_link = 'mailto:' . $recipient_email . '?subject=' . $subject;
    ?>
        <section class="emergency-section">          
                    <h2><?php echo esc_html($Emergency_call_title); ?></h2>
   
                    <?php if ($section_3['repeteur_image_slider']) : ?>
                        <div class="emergency-slider-container">
                            <div class="emergency-slider">
                                <?php foreach ($section_3['repeteur_image_slider'] as $slide) : ?>
                                    <div class="emergency-slide">
                                        <?php echo wp_get_attachment_image($slide['image_slider']['ID'], 'full', false, array('class' => 'slide-image')); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                           
                            <button class="slider-prev" aria-label="Slide précédente">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-left.svg" alt="Précédent" class="arrow arrow-left">
                            </button>
                            <button class="slider-next" aria-label="Slide suivante">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-right.svg" alt="Suivant" class="arrow arrow-right">
                            </button>
                       
                        </div>
                    <?php endif; ?>
            </div>
            <div class=emergency-section-3-text-button>
            <div class="emergency-call-paragraph wysiwyg">
                <?php echo $Emergency_call_text; ?>
            </div>
                <a href="<?php echo esc_attr($mailto_link); ?>" class="btn-primary">
                    <?php echo esc_html($button_text); ?>
                </a>
            </div>
        </section>
    <?php endif; ?>

    <?php 
       
       $section_4 = get_field('section_4');

       if ($section_4) :
           $mecene_title = $section_4['titre_mecene'] ;
           $mecene_text = $section_4['texte_mecene'] ;
           $mecene_button = $section_4['lien_du_bouton_mecene'] ;
       ?>

           <section class="mecene-section">
               <div class="mecene-container">            
                        <h2><?php echo esc_html($mecene_title); ?></h2>
                    <div class="mecene-paragraph wysiwyg">
                        <?php echo $mecene_text; ?>
                    </div>
                        <a href="<?php echo esc_url($mecene_button['url']); ?>" target="_blank<?php echo esc_attr($mecene_button['target'] ?? '_self'); ?>" class=" btn-secondary btn-infos">
                               <?php echo esc_html($mecene_button['title']); ?>
                        </a>
               </div>
           </section>
   <?php endif; ?>

   <?php 
        $section_5 = get_field('section_5');

    if ($section_5 && !empty($section_5['repeteur_pour_les_questions_et_les_reponses'])) :
            $faq_title = $section_5['titre_questions_frequentes'];
            $faq_text = $section_5['sous-titre_questions_frequentes'];
            $faq_items = $section_5['repeteur_pour_les_questions_et_les_reponses'];
        ?>
        <section class="section-faq">
            <h2><?php echo esc_html($faq_title); ?></h2>
            
            <?php if (!empty($faq_text)) : ?>
                <p class="section-intro"><?php echo $faq_text; ?></p>
            <?php endif; ?>
            
            <div class="faq-container">
                <?php foreach ($faq_items as $index => $item) : ?>
                    <div class="faq-item" id="faq-item-<?php echo $index; ?>">
                        <div class="faq-question" aria-expanded="false" aria-controls="faq-answer-<?php echo $index; ?>">
                            <h3><?php echo esc_html($item['questions_faq']); ?></h3>
                            <div class="faq-toggle">
                                <img class="icon-plus" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-plus.svg" alt="Plus">
                                <img class="icon-moins" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-moins.svg" alt="Moins">
                            </div>
                        </div>
                        <div id="faq-answer-<?php echo $index; ?>" class="faq-answer" aria-hidden="true">
                            <?php echo wp_kses_post($item['reponse_faq']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

<?php
get_footer();
?>