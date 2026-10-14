<?php
/**
 * Theme setup and assets.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'bia_setup' );
function bia_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'custom-logo', array( 'height' => 124, 'width' => 318, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	add_image_size( 'bia-card', 800, 600, true );

	register_nav_menus(
		array(
			'primary' => __( 'Primary menu', 'bia' ),
			'footer'  => __( 'Footer menu', 'bia' ),
		)
	);
}

add_action( 'wp_enqueue_scripts', 'bia_assets' );
function bia_assets() {
	$css_ver = BIA_VERSION . '.' . filemtime( BIA_DIR . '/assets/css/main.css' );
	$js_ver  = BIA_VERSION . '.' . filemtime( BIA_DIR . '/assets/js/main.js' );

	wp_enqueue_style( 'bia-main', BIA_URI . '/assets/css/main.css', array(), $css_ver );
	wp_enqueue_script( 'bia-main', BIA_URI . '/assets/js/main.js', array(), $js_ver, array( 'strategy' => 'defer', 'in_footer' => true ) );
}

/**
 * Early head output: JS flag, font preloads, favicon and theme colour.
 */
add_action( 'wp_head', 'bia_head_meta', 1 );
function bia_head_meta() {
	// Flag JS early so scroll-reveal styles never flash.
	echo "<script>document.documentElement.classList.add('js');</script>\n";
	$fonts = array( 'outfit-latin-800-normal.woff2', 'manrope-latin-400-normal.woff2' );
	foreach ( $fonts as $font ) {
		printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( BIA_URI . '/assets/fonts/' . $font ) );
	}
	if ( ! has_site_icon() ) {
		printf( '<link rel="icon" href="%s" type="image/svg+xml">' . "\n", esc_url( bia_img( 'icon.svg' ) ) );
	}
	echo '<meta name="theme-color" content="#12264A">' . "\n";
}

/**
 * Meta description from the page data when no SEO plugin is active.
 */
add_action( 'wp_head', 'bia_meta_description', 2 );
function bia_meta_description() {
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) {
		return;
	}
	$content = bia_current_content();
	$desc    = bia_is_content_page() && ! empty( $content['meta'] ) ? $content['meta'] : '';
	if ( ! $desc ) {
		return;
	}
	printf( '<meta name="description" content="%s">' . "\n", esc_attr( wp_strip_all_tags( $desc ) ) );
}

/**
 * SEO title from the content document when no SEO plugin is active.
 */
add_filter( 'pre_get_document_title', 'bia_document_title' );
function bia_document_title( $title ) {
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || is_404() || is_search() ) {
		return $title;
	}
	return bia_seo_title() ? bia_seo_title() : $title;
}

/**
 * SEO title for the current page ('' when the page has none).
 */
function bia_seo_title() {
	if ( ! bia_is_content_page() ) {
		return '';
	}
	$content = bia_current_content();
	return ! empty( $content['seo_title'] ) ? $content['seo_title'] : '';
}

/**
 * Body classes.
 */
add_filter( 'body_class', 'bia_body_class' );
function bia_body_class( $classes ) {
	$classes[] = is_front_page() ? 'is-home' : 'is-inner';
	return $classes;
}

add_filter( 'excerpt_length', function () { return 24; } );
add_filter( 'excerpt_more', function () { return '...'; } );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );

/**
 * Use a pipe in document titles (no dashes anywhere on the site).
 */
add_filter( 'document_title_separator', function () { return '|'; } );
