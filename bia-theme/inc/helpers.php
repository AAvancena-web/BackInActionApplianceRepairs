<?php
/**
 * Template helpers.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

/**
 * Theme option defaults. Phone, email and hours are placeholders until confirmed.
 */
function bia_option_defaults() {
	return array(
		'bia_phone'             => '0400 000 000',
		'bia_email'             => 'hello@yourdomain.com.au',
		'bia_area'              => 'Melbourne metro',
		'bia_hours'             => 'Monday to Saturday, 7 am to 6 pm',
		'bia_abn'               => '',
		'bia_map_query'         => 'Melbourne VIC',
		'bia_map_zoom'          => '10',
		'bia_form_recipient'    => '',
		'bia_booking_shortcode' => '',
		'bia_contact_shortcode' => '',
		'bia_facebook'          => '',
		'bia_instagram'         => '',
		'bia_google'            => '',
	);
}

/**
 * Get a theme option.
 *
 * @param string $key Option key.
 * @return string
 */
function bia_opt( $key ) {
	$defaults = bia_option_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( $key, $default );
}

function bia_phone() {
	return bia_opt( 'bia_phone' );
}

function bia_phone_href() {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', bia_phone() );
}

function bia_email() {
	return bia_opt( 'bia_email' );
}

/**
 * Theme image URL.
 *
 * @param string $file File name inside assets/img.
 */
function bia_img( $file ) {
	return BIA_URI . '/assets/img/' . ltrim( $file, '/' );
}

/**
 * URL for a page by path, with a sensible fallback.
 *
 * @param string $path Page path, e.g. "dryer-repairs".
 */
function bia_url( $path ) {
	$path = trim( $path, '/' );
	if ( '' === $path ) {
		return home_url( '/' );
	}
	$page = get_page_by_path( $path );
	if ( $page ) {
		return get_permalink( $page );
	}
	return home_url( '/' . $path . '/' );
}

/**
 * Booking form anchor on the contact page.
 */
function bia_book_url() {
	return bia_url( 'contact' ) . '#book';
}

/**
 * Print an eyebrow label. No dashes; a small amber ring leads the text.
 *
 * @param string $text  Label.
 * @param string $class Extra classes.
 */
function bia_eyebrow( $text, $class = '' ) {
	printf( '<span class="eyebrow %s">%s</span>', esc_attr( $class ), esc_html( $text ) );
}

/**
 * Button markup. All variants have solid backgrounds.
 *
 * @param string $label   Label.
 * @param string $url     URL.
 * @param string $variant amber|navy|white.
 * @param string $icon    Icon name or empty.
 * @param string $extra   Extra attributes.
 */
function bia_button( $label, $url, $variant = 'amber', $icon = 'arrow-right', $extra = '' ) {
	$icon_html = $icon ? bia_icon( $icon ) : '';
	printf(
		'<a class="btn btn--%1$s" href="%2$s" %5$s><span>%3$s</span>%4$s</a>',
		esc_attr( $variant ),
		esc_url( $url ),
		esc_html( $label ),
		$icon_html, // phpcs:ignore WordPress.Security.EscapeOutput
		$extra // phpcs:ignore WordPress.Security.EscapeOutput
	);
}

/**
 * Call button (tel link) with the phone number as the label.
 *
 * @param string $variant Button variant.
 */
function bia_call_button( $variant = 'navy' ) {
	printf(
		'<a class="btn btn--%1$s" href="%2$s">%3$s<span>Call %4$s</span></a>',
		esc_attr( $variant ),
		esc_attr( bia_phone_href() ),
		bia_icon( 'phone' ), // phpcs:ignore WordPress.Security.EscapeOutput
		esc_html( bia_phone() )
	);
}

/**
 * Breadcrumbs for inner pages.
 */
function bia_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	$items   = array();
	$items[] = array( 'label' => 'Home', 'url' => home_url( '/' ) );

	if ( is_page() ) {
		foreach ( array_reverse( get_post_ancestors( get_the_ID() ) ) as $ancestor ) {
			$items[] = array( 'label' => get_the_title( $ancestor ), 'url' => get_permalink( $ancestor ) );
		}
		$items[] = array( 'label' => get_the_title(), 'url' => '' );
	} elseif ( is_singular() ) {
		$items[] = array( 'label' => get_the_title(), 'url' => '' );
	} elseif ( is_search() ) {
		$items[] = array( 'label' => 'Search results', 'url' => '' );
	} elseif ( is_404() ) {
		$items[] = array( 'label' => 'Page not found', 'url' => '' );
	} elseif ( is_archive() ) {
		$items[] = array( 'label' => wp_strip_all_tags( get_the_archive_title() ), 'url' => '' );
	} elseif ( is_home() ) {
		$items[] = array( 'label' => 'News', 'url' => '' );
	}

	echo '<nav class="breadcrumbs" aria-label="Breadcrumb"><ol>';
	foreach ( $items as $item ) {
		if ( $item['url'] ) {
			printf( '<li><a href="%s">%s</a></li>', esc_url( $item['url'] ), esc_html( $item['label'] ) );
		} else {
			printf( '<li aria-current="page">%s</li>', esc_html( $item['label'] ) );
		}
	}
	echo '</ol></nav>';
}

/**
 * Whether the global pre-footer contact section should show (hidden on Contact).
 */
function bia_show_prefooter_contact() {
	$hide = is_page_template( 'page-templates/template-contact.php' ) || ( is_page() && 'contact' === bia_current_slug() );
	return (bool) apply_filters( 'bia_show_prefooter_contact', ! $hide );
}

/**
 * Google Maps embed URL (no API key required).
 */
function bia_map_embed_url() {
	return add_query_arg(
		array(
			'q'      => rawurlencode( bia_opt( 'bia_map_query' ) ),
			'z'      => absint( bia_opt( 'bia_map_zoom' ) ),
			'output' => 'embed',
		),
		'https://maps.google.com/maps'
	);
}

/**
 * Current page slug.
 */
function bia_current_slug() {
	$post = get_queried_object();
	return ( $post instanceof WP_Post ) ? $post->post_name : '';
}

/**
 * Structured data: LocalBusiness on every page, plus Service and BreadcrumbList on inner pages.
 */
add_action( 'wp_head', 'bia_schema', 20 );
function bia_schema() {
	$services = array();
	foreach ( bia_services() as $service ) {
		$services[] = $service['title'];
	}
	$business = array(
		'@type'       => array( 'LocalBusiness', 'HomeAndConstructionBusiness' ),
		'@id'         => home_url( '/' ) . '#business',
		'name'        => 'Back In Action Appliance Repairs',
		'url'         => home_url( '/' ),
		'telephone'   => bia_phone(),
		'email'       => bia_email(),
		'image'       => bia_img( 'logo.svg' ),
		'areaServed'  => bia_opt( 'bia_area' ),
		'description' => 'Washing machine, dryer and dishwasher repairs across ' . bia_opt( 'bia_area' ) . '.',
		'knowsAbout'  => $services,
	);
	$graph = array( $business );

	$service = bia_get_service( bia_current_slug() );
	if ( $service && ! is_front_page() ) {
		$graph[] = array(
			'@type'       => 'Service',
			'serviceType' => $service['title'],
			'name'        => $service['seo_title'],
			'description' => $service['meta'],
			'provider'    => array( '@id' => home_url( '/' ) . '#business' ),
			'areaServed'  => bia_opt( 'bia_area' ),
		);
	}

	if ( is_page() && ! is_front_page() ) {
		$graph[] = array(
			'@type'           => 'BreadcrumbList',
			'itemListElement' => array(
				array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
				array( '@type' => 'ListItem', 'position' => 2, 'name' => get_the_title() ),
			),
		);
	}

	echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $graph ), JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
