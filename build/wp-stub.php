<?php
/**
 * Minimal WordPress stand-ins so the theme templates can be rendered to static
 * HTML for the docs/ preview. Only the functions the theme uses are covered.
 * Not used by WordPress itself.
 */

define( 'ABSPATH', __DIR__ . '/' );

$GLOBALS['bia_static'] = array(
	'page'    => null,  // Current WP_Post stand-in, or null for the front page.
	'front'   => true,
	'title'   => '',
	'styles'  => array(),
	'scripts' => array(),
	'hooks'   => array(),
	'loop'    => false,
);

class WP_Post {
	public $ID;
	public $post_name;
	public $post_title;
	public $post_parent = 0;
	public function __construct( $id, $slug, $title ) {
		$this->ID         = $id;
		$this->post_name  = $slug;
		$this->post_title = $title;
	}
}

/* Hooks --------------------------------------------------------------------- */
function add_action( $hook, $cb, $prio = 10 ) { $GLOBALS['bia_static']['hooks'][ $hook ][ $prio ][] = $cb; }
function add_filter( $hook, $cb, $prio = 10 ) { add_action( $hook, $cb, $prio ); }
function remove_action() {}
function do_action( $hook ) {
	$args = array_slice( func_get_args(), 1 );
	if ( empty( $GLOBALS['bia_static']['hooks'][ $hook ] ) ) {
		return;
	}
	ksort( $GLOBALS['bia_static']['hooks'][ $hook ] );
	foreach ( $GLOBALS['bia_static']['hooks'][ $hook ] as $cbs ) {
		foreach ( $cbs as $cb ) {
			call_user_func_array( $cb, $args );
		}
	}
}
function apply_filters( $hook, $value ) { return $value; }
function __( $s ) { return $s; }

/* Theme setup no-ops -------------------------------------------------------- */
function add_theme_support() {}
function add_image_size() {}
function register_nav_menus() {}
function add_editor_style() {}
function get_template_directory() { return dirname( __DIR__ ) . '/bia-theme'; }
function get_template_directory_uri() { return '.'; }
function wp_enqueue_style( $h, $src ) { $GLOBALS['bia_static']['styles'][] = $src; }
function wp_enqueue_script( $h, $src ) { $GLOBALS['bia_static']['scripts'][] = $src; }
function has_site_icon() { return false; }
function has_custom_logo() { return false; }
function has_nav_menu() { return false; }
function get_theme_mod( $key, $default = '' ) { return $default; }

/* URLs ---------------------------------------------------------------------- */
function bia_static_file( $path ) {
	$path = trim( $path, '/' );
	return '' === $path ? 'index.html' : $path . '.html';
}
function home_url( $path = '' ) {
	if ( 'BIA_CURRENT' === $path ) {
		return $GLOBALS['bia_static']['file'];
	}
	$hash = '';
	if ( false !== strpos( $path, '#' ) ) {
		list( $path, $hash ) = explode( '#', $path, 2 );
		$hash = '#' . $hash;
	}
	return bia_static_file( $path ) . $hash;
}
function add_query_arg( $args, $url = null ) {
	if ( null === $url ) {
		return 'BIA_CURRENT';
	}
	if ( ! $args ) {
		return $url;
	}
	$q = array();
	foreach ( $args as $k => $v ) {
		$q[] = $k . '=' . $v;
	}
	return $url . ( false === strpos( $url, '?' ) ? '?' : '&' ) . implode( '&', $q );
}
function trailingslashit( $s ) { return rtrim( $s, '/' ) . '/'; }
function get_page_by_path() { return null; }
function get_permalink() { return '#'; }
function admin_url() { return '#'; }

/* Escaping and sanitising --------------------------------------------------- */
function esc_html( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES, 'UTF-8' ); }
function esc_attr( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES, 'UTF-8' ); }
function esc_url( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES, 'UTF-8' ); }
function wp_strip_all_tags( $s ) { return trim( strip_tags( $s ) ); }
function absint( $n ) { return abs( (int) $n ); }
function sanitize_key( $s ) { return strtolower( preg_replace( '/[^a-z0-9_\-]/i', '', $s ) ); }
function wp_unslash( $s ) { return $s; }
function wp_json_encode( $d, $f = 0 ) { return json_encode( $d, $f ); }
function wp_parse_args( $args, $defaults ) { return array_merge( $defaults, (array) $args ); }
function selected( $a, $b ) { if ( (string) $a === (string) $b ) { echo ' selected'; } }
function wp_nonce_field() {}

/* Conditionals -------------------------------------------------------------- */
function is_front_page() { return $GLOBALS['bia_static']['front']; }
function is_page() { return ! $GLOBALS['bia_static']['front'] && null !== $GLOBALS['bia_static']['page']; }
function is_singular() { return is_page(); }
function is_search() { return false; }
function is_archive() { return false; }
function is_home() { return false; }
function is_404() { return ! $GLOBALS['bia_static']['front'] && null === $GLOBALS['bia_static']['page']; }
function is_page_template( $t ) { return false; }
function get_queried_object() { return $GLOBALS['bia_static']['page']; }
function get_the_ID() { return $GLOBALS['bia_static']['page'] ? $GLOBALS['bia_static']['page']->ID : 0; }
function get_post_ancestors() { return array(); }
function get_the_title() { return $GLOBALS['bia_static']['page'] ? $GLOBALS['bia_static']['page']->post_title : ''; }
function get_page_template_slug() { return ''; }

/* Loop ---------------------------------------------------------------------- */
function have_posts() {
	if ( $GLOBALS['bia_static']['loop'] ) {
		$GLOBALS['bia_static']['loop'] = false;
		return true;
	}
	return false;
}
function the_post() {}
function get_the_content() { return ''; }
function the_content() {}
function has_post_thumbnail() { return false; }

/* Template output ----------------------------------------------------------- */
function language_attributes() { echo 'lang="en-AU"'; }
function bloginfo( $what ) { echo 'charset' === $what ? 'UTF-8' : 'Back In Action Appliance Repairs'; }
function get_bloginfo() { return 'Back In Action Appliance Repairs'; }
function body_class() {
	$classes = array( is_front_page() ? 'home' : 'page', is_front_page() ? 'is-home' : 'is-inner' );
	if ( $GLOBALS['bia_static']['page'] ) {
		$classes[] = 'page-' . $GLOBALS['bia_static']['page']->post_name;
	}
	echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
}
function wp_body_open() {}
function wp_head() {
	echo '<title>' . esc_html( $GLOBALS['bia_static']['title'] ) . "</title>\n";
	do_action( 'wp_head' );
	foreach ( $GLOBALS['bia_static']['styles'] as $src ) {
		echo '<link rel="stylesheet" href="' . esc_url( $src ) . '">' . "\n";
	}
}
function wp_footer() {
	foreach ( $GLOBALS['bia_static']['scripts'] as $src ) {
		echo '<script src="' . esc_url( $src ) . '" defer></script>' . "\n";
	}
	do_action( 'wp_footer' );
}
function get_header() { require get_template_directory() . '/header.php'; }
function get_footer() { require get_template_directory() . '/footer.php'; }
function get_template_part( $slug, $name = null, $args = array() ) {
	require get_template_directory() . '/' . $slug . '.php';
}
