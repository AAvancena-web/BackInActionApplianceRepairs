<?php
/**
 * Inline SVG icon set (stroke icons, 24px grid).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return an inline SVG icon.
 *
 * @param string $name  Icon name.
 * @param string $class Extra class.
 * @return string
 */
function bia_icon( $name, $class = '' ) {
	$paths = array(
		'phone'        => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>',
		'mail'         => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>',
		'pin'          => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>',
		'clock'        => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
		'arrow-right'  => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
		'arrow-up'     => '<path d="m5 12 7-7 7 7"/><path d="M12 19V5"/>',
		'chevron-down' => '<path d="m6 9 6 6 6-6"/>',
		'check'        => '<path d="M20 6 9 17l-5-5"/>',
		'check-circle' => '<circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>',
		'close'        => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
		'plus'         => '<path d="M12 5v14"/><path d="M5 12h14"/>',
		'bolt'         => '<path d="M13 2 3 14h9l-1 8 10-12h-9z"/>',
		'target'       => '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>',
		'shield'       => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/>',
		'lock'         => '<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
		'wrench'       => '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94z"/>',
		'tag'          => '<path d="M20.59 13.41 13.42 20.58a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><circle cx="7" cy="7" r="1.5"/>',
		'van'          => '<path d="M1 6h13v11H1z"/><path d="M14 9h4.5l3.5 4v4h-8"/><circle cx="5.5" cy="18" r="2"/><circle cx="17.5" cy="18" r="2"/>',
		'family'       => '<circle cx="8" cy="6" r="3"/><circle cx="17" cy="9" r="2"/><path d="M3 21v-3a5 5 0 0 1 10 0v3"/><path d="M14 21v-2a3 3 0 0 1 6 0v2"/>',
		'chat'         => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 9h8M8 13h5"/>',
		'home'         => '<path d="m3 10 9-7 9 7v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/>',
		'leaf'         => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
		'star'         => '<path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/>',
		'quote'        => '<path d="M3 21c3 0 7-1 7-8V5c0-1.25-.76-2-2-2H4c-1.25 0-2 .75-2 1.97V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .01-1 1.03V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.76-2-2-2h-4c-1.25 0-2 .75-2 1.97V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/>',
		'refresh'      => '<path d="M21 12a9 9 0 1 1-3-6.7"/><path d="M21 3v6h-6"/>',
		'calendar'     => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
		'washer'       => '<rect x="4" y="2" width="16" height="20" rx="2.5"/><path d="M4 7h16"/><circle cx="12" cy="14" r="4.5"/><path d="M9.5 14.5c1.2-.8 2.3.8 3.5 0s2-.6 2-.6"/><path d="M7.5 4.5h.01M10 4.5h.01"/>',
		'dryer'        => '<rect x="4" y="2" width="16" height="20" rx="2.5"/><path d="M4 7h16"/><circle cx="12" cy="14" r="4.5"/><path d="M11 11.8c-.7.8.7 1.6 0 2.4s.7 1.6 0 2.4M13.5 11.8c-.7.8.7 1.6 0 2.4s.7 1.6 0 2.4"/><path d="M16.5 4.5h.01"/>',
		'dishwasher'   => '<rect x="4" y="2" width="16" height="20" rx="2.5"/><path d="M4 7h16"/><path d="M8 4.5h4"/><path d="M7.5 11h9"/><path d="M8 15c0 2 1.5 3 4 3s4-1 4-3"/><path d="M10 11v-1.5M14 11v-1.5"/>',
		'facebook'     => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
		'instagram'    => '<rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><path d="M17.5 6.5h.01"/>',
		'google'       => '<path d="M21.5 12.2c0-.7-.1-1.4-.2-2H12v3.8h5.3a4.6 4.6 0 0 1-2 3v2.5h3.2c1.9-1.7 3-4.3 3-7.3z"/><path d="M12 22c2.7 0 5-.9 6.6-2.4l-3.2-2.5c-.9.6-2 1-3.4 1-2.6 0-4.8-1.8-5.6-4.1H3.1v2.6A10 10 0 0 0 12 22z"/><path d="M6.4 14c-.4-1.3-.4-2.7 0-4V7.4H3.1a10 10 0 0 0 0 9.2z"/><path d="M12 6c1.5 0 2.8.5 3.8 1.5l2.9-2.9A10 10 0 0 0 3.1 7.4L6.4 10C7.2 7.7 9.4 6 12 6z"/>',
	);

	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}

	return sprintf(
		'<svg class="icon icon-%1$s %2$s" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%3$s</svg>',
		esc_attr( $name ),
		esc_attr( $class ),
		$paths[ $name ]
	);
}
