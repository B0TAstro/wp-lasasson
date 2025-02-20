<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Single Actualites Template
 *
 * @file           single.php
 * @filesource     wp-content/themes/lasasson/single-actualites.php
 */

get_header(); ?>
<div id="content-outer">
<div id="content" class="<?php echo esc_attr( implode( ' ', responsive_get_content_classes() ) ); ?>" role="main">

	<?php get_template_part( 'loop-header', get_post_type() ); ?>

	<?php if ( have_posts() ) : ?>

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php responsive_entry_before(); ?>
			<?php
				get_template_part( 'partials/single-offre_emploi/layout', get_post_type() );
			?>
	
			<?php responsive_entry_after(); ?>

			<?php responsive_comments_before(); ?>
			<?php comments_template( '', true ); ?>
			<?php responsive_comments_after(); ?>

			<?php
		endwhile;

		get_template_part( 'loop-nav', get_post_type() );

		else :

			get_template_part( 'loop-no-posts', get_post_type() );

	endif;
		?>

</div><!-- end of #content -->

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
