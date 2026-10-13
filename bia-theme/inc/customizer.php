<?php
/**
 * Customizer: contact details, map, forms and social links.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

add_action( 'customize_register', 'bia_customize_register' );
function bia_customize_register( $wp_customize ) {
	$wp_customize->add_panel( 'bia_panel', array( 'title' => __( 'Back In Action Settings', 'bia' ), 'priority' => 30 ) );

	$sections = array(
		'bia_contact' => array(
			'title'  => __( 'Contact details', 'bia' ),
			'fields' => array(
				'bia_phone' => array( 'label' => 'Phone number', 'type' => 'text' ),
				'bia_email' => array( 'label' => 'Email address', 'type' => 'email' ),
				'bia_area'  => array( 'label' => 'Service area (e.g. Melbourne metro)', 'type' => 'text' ),
				'bia_hours' => array( 'label' => 'Business hours', 'type' => 'text' ),
				'bia_abn'   => array( 'label' => 'ABN (shown in the footer if set)', 'type' => 'text' ),
			),
		),
		'bia_map'     => array(
			'title'  => __( 'Google Map', 'bia' ),
			'fields' => array(
				'bia_map_query' => array( 'label' => 'Map search query or address', 'type' => 'text' ),
				'bia_map_zoom'  => array( 'label' => 'Map zoom (1 to 20)', 'type' => 'number' ),
			),
		),
		'bia_forms'   => array(
			'title'       => __( 'Forms', 'bia' ),
			'description' => __( 'Built-in forms email submissions to the recipient below. To use a form plugin (Contact Form 7, Gravity Forms, WPForms), paste its shortcode and it replaces the built-in form.', 'bia' ),
			'fields'      => array(
				'bia_form_recipient'    => array( 'label' => 'Form recipient email (defaults to site admin email)', 'type' => 'email' ),
				'bia_booking_shortcode' => array( 'label' => 'Booking form shortcode (optional)', 'type' => 'text' ),
				'bia_contact_shortcode' => array( 'label' => 'Contact form shortcode (optional)', 'type' => 'text' ),
			),
		),
		'bia_social'  => array(
			'title'  => __( 'Social links', 'bia' ),
			'fields' => array(
				'bia_facebook'  => array( 'label' => 'Facebook URL', 'type' => 'url' ),
				'bia_instagram' => array( 'label' => 'Instagram URL', 'type' => 'url' ),
				'bia_google'    => array( 'label' => 'Google Business Profile URL', 'type' => 'url' ),
			),
		),
	);

	$defaults = bia_option_defaults();

	foreach ( $sections as $section_id => $section ) {
		$wp_customize->add_section(
			$section_id,
			array(
				'title'       => $section['title'],
				'panel'       => 'bia_panel',
				'description' => isset( $section['description'] ) ? $section['description'] : '',
			)
		);
		foreach ( $section['fields'] as $id => $field ) {
			$sanitize = 'sanitize_text_field';
			if ( 'email' === $field['type'] ) {
				$sanitize = 'sanitize_email';
			} elseif ( 'url' === $field['type'] ) {
				$sanitize = 'esc_url_raw';
			} elseif ( 'number' === $field['type'] ) {
				$sanitize = 'absint';
			}
			$wp_customize->add_setting(
				$id,
				array(
					'default'           => isset( $defaults[ $id ] ) ? $defaults[ $id ] : '',
					'sanitize_callback' => $sanitize,
				)
			);
			$wp_customize->add_control(
				$id,
				array(
					'label'   => $field['label'],
					'section' => $section_id,
					'type'    => $field['type'],
				)
			);
		}
	}
}
