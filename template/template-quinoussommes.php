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

            if($section_2_nos_missions) :
                $titre_nos_missions = $section_2_nos_missions ['titre_nos_missions'];
                $texte_nos_missions = $section_2_nos_missions['texte_nos_missions'];
                $titre_axes_intervention = $section_2_nos_missions['titre_axes_intervention'];
                $repeteur_axes_intervention = $section_2_nos_missions['repeteur_axes_dintervention']

            ?>

            <section class="our-missions-section">

            <div class="our-mission-container">                               
                        <h2><?php echo esc_html($titre_nos_missions); ?></h2>                             
                    <div class="our-mission-paragraph wysiwyg">
                        <?php echo $texte_nos_missions; ?>




            </section>



        <?php endif; ?>

        </main>
<?php
get_footer();
?>