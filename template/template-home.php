<?php
/*
 * Template Name: Accueil
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

    <?php
    $section1 = get_field('section1_home');
    ?>
    <section class="section-slider">
        <?php if ($section1['slider']) : ?>
            <div class="slider-container">
                <div class="slider">
                    <?php foreach ($section1['slider'] as $slide) : ?>
                        <div class="slide">
                            <?php echo wp_get_attachment_image($slide['image']['ID'], 'full', false, array('class' => 'slide-image')); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="slider-content">
            <div class="wysiwyg slider-text">
                <?php echo apply_filters('the_content', $section1['paragraph']); ?>
            </div>

            <div class="slider-cta">
                <a href="<?php echo $section1['link']['url']; ?>" class="btn-primary"><?php echo $section1['link']['title']; ?></a>
            </div>
        </div>
    </section>

    <?php
    $section2 = get_field('section2_home');
    ?>
    <section class="section-presentation">
        <div class="container">
            <div class="presentation-content">
                <?php if ($section2['title']) : ?>
                    <h2><?php echo $section2['title']; ?></h2>
                <?php endif; ?>

                <?php if ($section2['paragraph']) : ?>
                    <div class="wysiwyg section-text">
                        <?php echo apply_filters('the_content', $section2['paragraph']); ?>
                    </div>
                <?php endif; ?>

                <?php if ($section2['link']) : ?>
                    <div class="button-container">
                        <a href="<?php echo $section2['link']['url']; ?>" class="btn-primary"><?php echo $section2['link']['title']; ?></a>
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

    <?php
    $section3 = get_field('section3_home');
    if ($section3 && isset($section3['blocks']) && is_array($section3['blocks']) && count($section3['blocks']) > 0) :
    ?>
        <section class="section-info">
            <div class="container">
                <div class="info-blocks">
                    <?php foreach ($section3['blocks'] as $block) : ?>
                        <div class="info-block">
                            <?php if ($block['title']) : ?>
                                <h3 class="block-title"><?php echo $block['title']; ?></h3>
                            <?php endif; ?>

                            <?php if ($block['subtitle']) : ?>
                                <p class="block-subtitle"><?php echo $block['subtitle']; ?></p>
                            <?php endif; ?>

                            <?php if ($block['paragraph']) : ?>
                                <div class="wysiwyg block-text">
                                    <?php echo apply_filters('the_content', $block['paragraph']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $section4 = get_field('section4_home');
    ?>
    <section class="section-contact">
        <div class="container">
            <?php if ($section4['title']) : ?>
                <h2><?php echo $section4['title']; ?></h2>
            <?php endif; ?>

            <?php if ($section4['link']) : ?>
                <div class="section-cta">
                    <a href="<?php echo $section4['link']['url']; ?>" class="btn-secondary"><?php echo $section4['link']['title']; ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php
    $section5 = get_field('section5_home');
    ?>
    <section class="section-news">
        <div class="container">
            <?php if ($section5['title']) : ?>
                <h2><?php echo $section5['title']; ?></h2>
            <?php endif; ?>

            <div class="news-grid">
                <?php
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
                        <article class="news-item <?php echo has_post_thumbnail() ? 'has-thumbnail' : 'no-thumbnail'; ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="news-content">
                                    <div>
                                        <h3>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="news-date"><?php echo get_the_date(); ?></div>
                                        <div class="news-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="news-link">Lire la suite</a>
                                </div>
                                <div class="news-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo get_the_post_thumbnail(get_the_ID(), 'medium'); ?>
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="news-content">
                                    <div>
                                        <h3>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="news-date"><?php echo get_the_date(); ?></div>
                                        <div class="news-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="news-link">Lire la suite</a>
                                </div>
                            <?php endif; ?>
                        </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

            <?php if ($section5['link']) : ?>
                <div class="section-cta">
                    <a href="<?php echo $section5['link']['url']; ?>" class="btn-primary"><?php echo $section5['link']['title']; ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>