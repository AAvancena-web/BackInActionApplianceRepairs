<?php
/**
 * One-time site setup on theme activation: pages, templates, front page and menu.
 * Existing pages with the same slug are kept and only receive a template if they have none.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_switch_theme', 'bia_activation_setup' );
function bia_activation_setup() {
	if ( get_option( 'bia_setup_done' ) ) {
		return;
	}

	$ids          = array();
	$ids['home']  = bia_ensure_page( 'home', 'Home', '' );
	$ids['about'] = bia_ensure_page( bia_about_slug(), 'About', 'page-templates/template-about.php' );
	foreach ( bia_services() as $slug => $service ) {
		$ids[ $slug ] = bia_ensure_page( $slug, $service['title'], 'page-templates/template-service.php' );
	}
	$ids['contact'] = bia_ensure_page( 'contact', 'Contact', 'page-templates/template-contact.php' );

	if ( 'page' !== get_option( 'show_on_front' ) && $ids['home'] ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
	}

	if ( ! get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}

	bia_create_menus( $ids );
	flush_rewrite_rules();
	update_option( 'bia_setup_done', 1 );
}

/**
 * Create a top level page if it does not exist.
 *
 * @param string $slug     Slug.
 * @param string $title    Title.
 * @param string $template Template path.
 * @return int Page ID.
 */
function bia_ensure_page( $slug, $title, $template ) {
	$page = get_page_by_path( $slug );
	$id   = $page ? $page->ID : wp_insert_post(
		array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => $title,
			'post_name'    => $slug,
			'post_content' => '',
		)
	);

	if ( $id && ! is_wp_error( $id ) && $template ) {
		$current = get_post_meta( $id, '_wp_page_template', true );
		if ( ! $current || 'default' === $current ) {
			update_post_meta( $id, '_wp_page_template', $template );
		}
	}

	return is_wp_error( $id ) ? 0 : (int) $id;
}

/**
 * Build the primary menu. The footer Company column has its own fallback links.
 *
 * @param array $ids Page IDs.
 */
function bia_create_menus( $ids ) {
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	if ( ! empty( $locations['primary'] ) ) {
		return;
	}

	$menu_name = 'Back In Action Main';
	$menu      = wp_get_nav_menu_object( $menu_name );
	$menu_id   = $menu ? $menu->term_id : wp_create_nav_menu( $menu_name );
	if ( is_wp_error( $menu_id ) ) {
		return;
	}

	if ( ! $menu ) {
		$order = array( 'home' => 'Home', 'about' => 'About' );
		foreach ( bia_services() as $slug => $service ) {
			$order[ $slug ] = $service['title'];
		}
		$order['contact'] = 'Contact';

		foreach ( $order as $key => $title ) {
			if ( empty( $ids[ $key ] ) ) {
				continue;
			}
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'     => $title,
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $ids[ $key ],
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
				)
			);
		}
	}

	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}

/**
 * Template fallback: pick the right template by slug even if none is assigned.
 */
add_filter( 'template_include', 'bia_template_fallback', 20 );
function bia_template_fallback( $template ) {
	if ( ! is_page() || is_front_page() || get_page_template_slug() ) {
		return $template;
	}
	$slug = bia_current_slug();
	$map  = '';
	if ( bia_get_service( $slug ) ) {
		$map = 'template-service.php';
	} elseif ( bia_about_slug() === $slug ) {
		$map = 'template-about.php';
	} elseif ( 'contact' === $slug ) {
		$map = 'template-contact.php';
	}
	if ( $map ) {
		$found = locate_template( 'page-templates/' . $map );
		if ( $found ) {
			return $found;
		}
	}
	return $template;
}
