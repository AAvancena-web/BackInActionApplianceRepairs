<?php
/**
 * Navigation helpers and fallbacks.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default navigation: Home | About | the three services | Contact.
 */
function bia_default_nav() {
	$items   = array();
	$items[] = array( 'label' => 'Home', 'url' => home_url( '/' ) );
	$items[] = array( 'label' => 'About', 'url' => bia_url( bia_about_slug() ) );
	foreach ( bia_services() as $slug => $service ) {
		$items[] = array( 'label' => $service['title'], 'url' => bia_url( $slug ) );
	}
	$items[] = array( 'label' => 'Contact', 'url' => bia_url( 'contact' ) );
	return $items;
}

/**
 * Print a menu for a location, falling back to the default nav.
 *
 * @param string $location primary|footer.
 * @param string $class    Menu UL class.
 */
function bia_menu( $location = 'primary', $class = 'menu' ) {
	if ( has_nav_menu( $location ) ) {
		wp_nav_menu(
			array(
				'theme_location' => $location,
				'container'      => false,
				'menu_class'     => $class,
				'depth'          => 1,
			)
		);
		return;
	}

	$current = trailingslashit( home_url( add_query_arg( array() ) ) );
	echo '<ul class="' . esc_attr( $class ) . '">';
	foreach ( bia_default_nav() as $item ) {
		$classes = array( 'menu-item' );
		if ( trailingslashit( $item['url'] ) === $current ) {
			$classes[] = 'current-menu-item';
		}
		printf(
			'<li class="%s"><a href="%s"%s>%s</a></li>',
			esc_attr( implode( ' ', $classes ) ),
			esc_url( $item['url'] ),
			in_array( 'current-menu-item', $classes, true ) ? ' aria-current="page"' : '',
			esc_html( $item['label'] )
		);
	}
	echo '</ul>';
}
