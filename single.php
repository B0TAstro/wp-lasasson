<?php get_header(); ?>

<main id="main" class="site-main" role="main">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="entry-meta">
                    <span class="posted-on"><?php echo get_the_date(); ?></span>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <footer class="entry-footer">
                <?php if (has_category()) : ?>
                    <div class="cat-links">
                        <?php the_category(', '); ?>
                    </div>
                <?php endif; ?>

                <?php if (has_tag()) : ?>
                    <div class="tags-links">
                        <?php the_tags('', ', ', ''); ?>
                    </div>
                <?php endif; ?>
            </footer>
        </article>

    <?php endwhile; ?>
    <button id="backButton">RETOUR</button>

    <script>
        document.getElementById('backButton').addEventListener('click', function() {
            window.history.back();
        });
    </script>

</main>

<?php get_footer(); ?>