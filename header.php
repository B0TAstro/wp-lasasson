<?php
/**
 * Header Template
 *
 * @file           header.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.3
 * @filesource     wp-content/themes/responsive/header.php
 * @link           http://codex.wordpress.org/Theme_Development#Document_Head_.28header.php.29
 * @since          available since Release 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
	<!doctype html>
	<!--[if !IE]>
	<html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
	<!--[if IE 7 ]>
	<html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
	<!--[if IE 8 ]>
	<html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
	<!--[if IE 9 ]>
	<html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
	<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="profile" href="http://gmpg.org/xfn/11"/>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
		
		<?php wp_head(); ?>
	</head>

<body <?php body_class(); ?>>

<?php responsive_container(); // before container hook. ?>

<div id="container" class="hfeed">

<?php responsive_header(); // before header hook. ?>
	<div class="skip-container cf">
		<a class="skip-link screen-reader-text focusable" href="#content"><?php esc_html_e( '&darr; Skip to Main Content', 'responsive' ); ?></a>
	</div><!-- .skip-container -->
	<div id="header_section">
		<?php $header_layout = get_theme_mod( 'header_layout_options', 'default' ); ?>
	<div id="header" role="banner" class='<?php echo esc_attr( $header_layout ); ?>' >
		
		<div class="btn-recrutement"><a href="//www.la-sasson.fr/recrutement/" target="_self"><img src="//www.la-sasson.fr/wp-content/uploads/2019/10/btn-recrutement.jpg" width="145" height="27"/></a></div>
		
		<div class="bloc-social">
		<a href="https://www.facebook.com/Association-La-Sasson-106552871193687" target="_blank"><img src="//www.la-sasson.fr/wp-content/uploads/2020/01/icon-fb.png" width="20" height="20"/></a>
			<a href="https://www.linkedin.com/in/association-la-sasson-a0147919b" target="_blank"><img src="//www.la-sasson.fr/wp-content/uploads/2020/01/icon-in.png" width="20" height="20"/></a>
			<a href="https://www.instagram.com/associationlasasson/?hl=fr" target="_blank"><img src="//www.la-sasson.fr/wp-content/uploads/2020/01/icon-insta.png" width="20" height="20"/></a>
		</div>

		<?php responsive_header_top(); // before header content hook. ?>

		<?php
		if ( has_nav_menu( 'top-menu', 'responsive' ) ) {
			wp_nav_menu(
				array(
					'container'      => '',
					'fallback_cb'    => false,
					'menu_class'     => 'top-menu',
					'theme_location' => 'top-menu',
				)
			);
		}
		?>

		<?php responsive_in_header(); // header hook. ?>
		<div id="content-outer" class='responsive-header'>
			<div id="logo">
		<?php if ( has_custom_logo() ) { ?>
					<?php the_custom_logo(); ?>
					<?php
					global $responsive_options;
					$responsive_options = responsive_get_options();
					if( empty( get_theme_mod( 'res_hide_site_title' ) ) ) { ?>
						<span class="site-name"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
					<?php
					}
					if( empty( get_theme_mod( 'res_hide_tagline' ) ) ) { ?>

						<span class="site-description"><?php bloginfo( 'description' ); ?></span>
						<?php
					}
					?>
		<?php } elseif ( has_header_image() ) {
			?>

			<a href="<?php echo esc_url(home_url( '/' )); ?>"><img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>"/></a>

	<?php
} else { // Header image was removed.
	global $responsive_options;
	$responsive_options = responsive_get_options();
	if ( empty( get_theme_mod( 'res_hide_site_title' ) ) ) {
		?>
		<span class="site-name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
		<?php
	}
	if ( empty( get_theme_mod( 'res_hide_tagline' ) ) ) {
		?>

		<span class="site-description"><?php bloginfo( 'description' ); ?></span>
		<?php
	}
}
?>

		</div><!-- end of #logo -->
		<?php do_action( 'responsive_header_container' ); ?>
	</div>
		
		

		<?php responsive_header_bottom(); // after header content hook. ?>

	</div><!-- end of #header -->
	</div>
<?php responsive_header_end(); // after header container hook. ?>

<?php responsive_wrapper(); // before wrapper container hook. ?>

    <?php global $responsive_blog_layout_columns; ?>

<?php
if ( ( isset( $responsive_options['site_layout_option'] ) && ( 'full-width-layout' === $responsive_options['site_layout_option'] ) && ( ! ( is_home() || is_front_page() ) ) ) || in_array( $responsive_options['blog_posts_index_layout_default'], $responsive_blog_layout_columns, true ) ) {
	?>
<div id="content-outer" >
<?php } ?>
	<div id="wrapper" class="clearfix">
<?php responsive_wrapper_top(); // before wrapper content hook. ?>
<?php responsive_in_wrapper(); // wrapper hook. ?>
