<?php
/**
 * Displays the post entry header
 *
 * @package Responsive WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php do_action( 'responsive_before_blog_entry_title' ); ?>

<h2 class="entry-title post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

<?php do_action( 'responsive_after_blog_entry_title' ); ?>
