<?php

/**
 * Template Name: Accueil
 */

get_header();
?>

<main>
    <?php
    $section1 = get_field('section1');
    if ($section1) :
    ?>
        <section class="section section-slider">
            <div class="container">
                <?php if ($section1['slider']) : ?>
                    <div class="slider-container">
                        <div class="slider">
                            <?php foreach ($section1['slider'] as $slide) : ?>
                                <div class="slide">
                                    <?php echo wp_get_attachment_image($slide['image']['ID'], 'full', false, array('class' => 'slide-image')); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="slider-nav">
                            <button class="slider-prev">&lt;</button>
                            <button class="slider-next">&gt;</button>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($section1['paragraph']) : ?>
                    <div class="slider-content">
                        <div class="slider-text wysiwyg">
                            <?php echo apply_filters('the_content', $section1['paragraph']); ?>
                        </div>

                        <?php if ($section1['link']) : ?>
                            <div class="slider-cta">
                                <a href="<?php echo $section1['link']['url']; ?>" class="btn btn-primary"><?php echo $section1['link']['title']; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Section 2 - Présentation
    $section2 = get_field('section2');
    if ($section2) :
    ?>
        <section class="section section-presentation">
            <div class="container">
                <div class="presentation-content">
                    <?php if ($section2['title']) : ?>
                        <h2 class="section-title"><?php echo $section2['title']; ?></h2>
                    <?php endif; ?>

                    <?php if ($section2['paragraph']) : ?>
                        <div class="section-text">
                            <?php echo $section2['paragraph']; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($section2['link']) : ?>
                        <div class="section-cta">
                            <a href="<?php echo $section2['link']['url']; ?>" class="btn btn-primary"><?php echo $section2['link']['title']; ?></a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="presentation-images">
                    <?php if ($section2['large_image']) : ?>
                        <div class="large-image">
                            <?php echo wp_get_attachment_image($section2['large_image']['ID'], 'full'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($section2['round_image']) : ?>
                        <div class="round-image">
                            <?php echo wp_get_attachment_image($section2['round_image']['ID'], 'full'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Section 3 - Informations (répéteur)
    $section3 = get_field('section3');
    if ($section3 && isset($section3['blocks']) && is_array($section3['blocks']) && count($section3['blocks']) > 0) :
    ?>
        <section class="section section-info">
            <div class="container">
                <div class="info-blocks">
                    <?php foreach ($section3['blocks'] as $block) : ?>
                        <div class="info-block">
                            <?php if ($block['title']) : ?>
                                <h3 class="block-title"><?php echo $block['title']; ?></h3>
                            <?php endif; ?>

                            <?php if ($block['subtitle']) : ?>
                                <h4 class="block-subtitle"><?php echo $block['subtitle']; ?></h4>
                            <?php endif; ?>

                            <?php if ($block['paragraph']) : ?>
                                <div class="block-text">
                                    <?php echo $block['paragraph']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Section 4 - Contact
    $section4 = get_field('section4');
    if ($section4) :
    ?>
        <section class="section section-contact">
            <div class="container">
                <?php if ($section4['title']) : ?>
                    <h2 class="section-title"><?php echo $section4['title']; ?></h2>
                <?php endif; ?>

                <?php if ($section4['link']) : ?>
                    <div class="section-cta">
                        <a href="<?php echo $section4['link']['url']; ?>" class="btn btn-primary"><?php echo $section4['link']['title']; ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Section 5 - Actualités
    $section5 = get_field('section5');
    if ($section5) :
    ?>
        <section class="section section-news">
            <div class="container">
                <?php if ($section5['title']) : ?>
                    <h2 class="section-title"><?php echo $section5['title']; ?></h2>
                <?php endif; ?>

                <div class="news-grid">
                    <?php
                    // Récupération des dernières actualités
                    $news_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    );

                    $news_query = new WP_Query($news_args);

                    if ($news_query->have_posts()) :
                        while ($news_query->have_posts()) : $news_query->the_post();
                    ?>
                            <article class="news-item">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="news-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="news-content">
                                    <h3 class="news-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="news-date"><?php echo get_the_date(); ?></div>
                                    <div class="news-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="news-link">Lire la suite</a>
                                </div>
                            </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

                <?php if ($section5['link']) : ?>
                    <div class="section-cta">
                        <a href="<?php echo $section5['link']['url']; ?>" class="btn btn-primary"><?php echo $section5['link']['title']; ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>