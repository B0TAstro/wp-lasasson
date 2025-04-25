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

        // Champs du tableau
        $column_1 = $section_1['colonne_1_repeteur_dons'];  // "Votre don"
        $column_2 = $section_1['colonne_2_repeteur_action_impact'];  // "Son impact concret"
        $rows = $section_1['repeteur_dons'];  // Le répéteur pour les lignes de dons et impacts

    ?>
    <section class="actu-section">
        <div class="actu-container">            
            <h2><?php echo esc_html($mission_title); ?></h2>
            <div class="actu-paragraph wysiwyg">
                <?php echo $mission_text; ?>
            </div>

            <div class="actu-image">
                <img src="<?php echo esc_url($why_support_image['url']); ?>" alt="<?php echo esc_attr($why_support_image['alt']); ?>">
            </div>

            <h3><?php echo esc_html($why_support_title); ?></h3>
            <div class="actu-paragraph wysiwyg">
                <?php echo $why_support_text; ?>
            </div>

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
    </section>
<?php endif; ?>


    <?php 
        $section_2 = get_field('section_2');
        if ($section_2) :
            $how_support_title = $section_2['titre_dons'] ;
            $how_support_text1 = $section_2['editor_dons'] ;
            $how_support_text2 = $section_2['image_dons'] ;
            $how_support_button1 = $section_2['lien_du_bouton_dons'] ;
            $how_support_button2 = $section_2['lien_du_bouton_dons'] ;
            $object_donation_title = $section_2['editor_dons'] ;
            $object_donation_text1 = $section_2['editor_dons'] ;
            $object_donation_text2 = $section_2['editor_dons'] ;
            $advantages_title = $section_2['titre_avantages_fiscaux'] ;
            $advantages_text = $section_2['texte_avantages_fiscaux'] ;
            
    ?>
        <section class="actu-section">
            <div class="actu-container">            
                <h2><?php echo esc_html($advantages_title); ?></h2>
                <div class="actu-paragraph wysiwyg">
                    <?php echo $advantages_text; ?>
                </div>
            </div>
        </section>  
        <?php endif; ?>


    <?php 
        $section_3 = get_field('section_3');
        if ($section_3) :
            $Emergency_call_title = $section_3['titre_appel_urgent'] ;
            $Emergency_call_text = $section_3['editor_appel_urgent'] ;
            $Emergency_call_button = $section_3['lien_bouton_appel_urgent'] ;    
    ?>
        <section class="actu-section">
            <div class="emergency-call-container">            
                <h2><?php echo esc_html($Emergency_call_title); ?></h2>
                <div class="emergency-call-paragraph wysiwyg">
                    <?php echo $Emergency_call_text; ?>
                </div>
                <a href="<?php echo esc_url($Emergency_call_button['url']); ?>" target="_blank<?php echo esc_attr($Emergency_call_button['target'] ?? '_self'); ?>" class=" btn-secondary btn-infos">
                    <?php echo esc_html($Emergency_call_button['title']); ?>
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
    
         if ($section_5) :
              $faq_title = $section_5['titre_questions_frequentes'] ;
              $faq_text = $section_5['sous-titre_questions_frequentes'] ;
         ?>
    
              <section class="faq-section">
                <div class="faq-container">            
                            <h2><?php echo esc_html($faq_title); ?></h2>
                      <div class="faq-paragraph wysiwyg">
                            <?php echo $faq_text; ?>
                      </div>
                </div>
              </section>
    <?php endif; ?>

    </main>

<?php
get_footer();
?>