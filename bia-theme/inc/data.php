<?php
/**
 * Site copy and structured content.
 *
 * All page copy lives in inc/content.json (from the client's content document,
 * 14 Oct 2026). Wrap a phrase in **double asterisks** to make it bold.
 * Contact details (phone, email, hours, service area) are set in
 * Customizer > Back In Action Settings.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

/**
 * All content, decoded once.
 *
 * @return array
 */
function bia_content() {
	static $content = null;
	if ( null === $content ) {
		$json    = file_get_contents( BIA_DIR . '/inc/content.json' ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		$content = json_decode( $json, true );
		if ( ! is_array( $content ) ) {
			$content = array( 'pages' => array(), 'services' => array(), 'trust' => array(), 'areas' => array() );
		}
	}
	return $content;
}

/**
 * The three services, keyed by page slug.
 */
function bia_services() {
	return bia_content()['services'];
}

/**
 * One service by slug.
 *
 * @param string $slug Service slug.
 * @return array|null
 */
function bia_get_service( $slug ) {
	$services = bia_services();
	return isset( $services[ $slug ] ) ? $services[ $slug ] : null;
}

/**
 * A page's content: home, about or contact.
 *
 * @param string $key Page key.
 * @return array
 */
function bia_page( $key ) {
	$pages = bia_content()['pages'];
	return isset( $pages[ $key ] ) ? $pages[ $key ] : array();
}

/**
 * About page slug (the SEO slug from the content document).
 */
function bia_about_slug() {
	$about = bia_page( 'about' );
	return ! empty( $about['slug'] ) ? $about['slug'] : 'about';
}

/**
 * Content for the page being viewed. Falls back to the homepage content, so
 * shared sections (contact form, footer text) always have copy.
 *
 * @return array
 */
function bia_current_content() {
	if ( is_front_page() ) {
		return bia_page( 'home' );
	}
	$slug    = bia_current_slug();
	$service = bia_get_service( $slug );
	if ( $service ) {
		return $service;
	}
	if ( bia_about_slug() === $slug ) {
		return bia_page( 'about' );
	}
	if ( 'contact' === $slug ) {
		return bia_page( 'contact' );
	}
	return bia_page( 'home' );
}

/**
 * Whether the current page has its own entry in content.json.
 */
function bia_is_content_page() {
	$slug = bia_current_slug();
	return is_front_page() || bia_get_service( $slug ) || bia_about_slug() === $slug || 'contact' === $slug;
}

/**
 * One section of the current page's content, falling back to the homepage.
 *
 * @param string $section Section key, e.g. "contact" or "cta".
 * @return array|string
 */
function bia_section( $section ) {
	$current = bia_current_content();
	if ( isset( $current[ $section ] ) ) {
		return $current[ $section ];
	}
	$home = bia_page( 'home' );
	return isset( $home[ $section ] ) ? $home[ $section ] : array();
}

/**
 * Brands list: "all" or "laundry" (washers and dryers).
 *
 * @param string $which all|laundry.
 */
function bia_brands( $which = 'all' ) {
	$content = bia_content();
	return 'laundry' === $which ? $content['brands_laundry'] : $content['brands_all'];
}

/**
 * Key service benefits bar.
 */
function bia_trust_points() {
	return bia_content()['trust'];
}

/**
 * Areas served.
 */
function bia_areas() {
	return bia_content()['areas'];
}

/**
 * Customer reviews. Leave empty to hide the reviews section.
 * Add real reviews only, for example from Google, with this filter:
 * array( 'name' => 'Sam, Brunswick', 'text' => 'Review text', 'service' => 'Washing machine repair' ).
 */
function bia_reviews() {
	return apply_filters( 'bia_reviews', array() );
}

/**
 * Escape text and turn **phrase** into <strong>phrase</strong>.
 *
 * @param string $text Text.
 * @return string Safe HTML.
 */
function bia_rich( $text ) {
	return preg_replace( '/\*\*(.+?)\*\*/', '<strong>$1</strong>', esc_html( $text ) );
}

/**
 * Print paragraphs.
 *
 * @param array|string $paras Paragraphs.
 * @param string       $first_class Class for the first paragraph (e.g. "lead").
 */
function bia_paras( $paras, $first_class = '' ) {
	foreach ( (array) $paras as $i => $para ) {
		$class = ( 0 === $i && $first_class ) ? ' class="' . esc_attr( $first_class ) . '"' : '';
		echo '<p' . $class . '>' . bia_rich( $para ) . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput
	}
}
