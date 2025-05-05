<?php
/*
 * Template Name: Contact
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
    $section1 = get_field('section1_contact');
    ?>
    <section class="contact-form-section">
        <div class="container">
            <h2><?php echo esc_html($section1['titre']); ?></h2>
            <div class="wysiwyg intro-text">
                <?php echo wp_kses_post($section1['texte_introduction']); ?>
            </div>

            <form class="contact-form" id="contactForm">
                <p class="required-note">* champs à remplir obligatoirement</p>

                <div class="form-row">
                    <div class="form-group">
                        <input type="text" id="nom" name="nom" placeholder="<?php echo esc_html($section1['label_nom']); ?> *" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <input type="text" id="prenom" name="prenom" placeholder="<?php echo esc_html($section1['label_prenom']); ?> *" required>
                    </div>
                </div>

                <div class="form-row two-columns">
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="<?php echo esc_html($section1['label_email']); ?> *" required>
                    </div>

                    <div class="form-group">
                        <input type="tel" id="telephone" name="telephone" placeholder="<?php echo esc_html($section1['label_telephone']); ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <div class="select-wrapper">
                            <select id="objet" name="objet" required>
                                <option value="" disabled selected><?php echo esc_html($section1['label_objet']); ?> *</option>
                                <?php
                                if ($section1['objets_demande']) :
                                    foreach ($section1['objets_demande'] as $objet) :
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
                                <option value="" disabled selected><?php echo esc_html($section1['label_service']); ?> *</option>
                                <?php
                                if ($section1['services']) :
                                    foreach ($section1['services'] as $service) :
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
                        <textarea id="message" name="message" rows="8" placeholder="<?php echo esc_html($section1['label_message']); ?> *"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group checkbox">
                        <input type="checkbox" id="consent" name="consent" required>
                        <label for="consent">En soumettant ce formulaire, j’accepte que les informations saisies soient exploitées et stockées dans le cadre de ma demande</label>
                    </div>
                </div>

                <button type="submit" class="btn-primary btn-submit"><?php echo esc_html($section1['texte_bouton']); ?></button>
            </form>
        </div>
    </section>

    <?php
    $section2 = get_field('section2_contact');
    ?>
    <section class="siege-section">
        <h2><?php echo esc_html($section2['titre']); ?></h2>

        <div class="siege-image">
            <img src="<?php echo esc_url($section2['image']['url']); ?>" alt="<?php echo esc_attr($section2['image']['alt']); ?>">
        </div>

        <div class="wysiwyg siege-intro">
            <?php echo wp_kses_post($section2['texte_introduction']); ?>
        </div>

        <div class="siege-info">
            <div class="siege-address">
                <p class="address-title"><?php echo esc_html($section2['bloc_adresse']['texte_adresse_titre']); ?></p>
                <p class="address"><?php echo nl2br(esc_html($section2['bloc_adresse']['adresse'])); ?></p>
                <p class="phone">
                    <span>N° Téléphone : </span><?php echo esc_html($section2['bloc_adresse']['telephone']); ?>
                </p>
            </div>

            <div class="siege-hours">
                <p class="hours-title"><?php echo esc_html($section2['bloc_horraires']['texte_horaires_titre']); ?></p>
                <p class="hours"><?php echo nl2br(esc_html($section2['bloc_horraires']['horaires'])); ?></p>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>