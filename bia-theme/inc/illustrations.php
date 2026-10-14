<?php
/**
 * Brand illustrations (inline SVG) for the three appliances.
 * Drawn in the logo palette so the site needs no stock photography.
 * Replace with real job photos any time via the page's featured image.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

/**
 * Appliance illustration.
 *
 * @param string $type  washer|dryer|dishwasher.
 * @param string $class Extra class.
 * @return string
 */
function bia_illustration( $type, $class = '' ) {
	$body = '<rect x="20" y="18" width="160" height="204" rx="22" fill="#FFFFFF" stroke="#12264A" stroke-width="5"/>'
		. '<path d="M20 64h160" stroke="#12264A" stroke-width="5"/>'
		. '<rect x="34" y="232" width="24" height="10" rx="4" fill="#12264A"/><rect x="142" y="232" width="24" height="10" rx="4" fill="#12264A"/>';

	switch ( $type ) {
		case 'dryer':
			$inner = '<rect x="36" y="32" width="58" height="18" rx="9" fill="#E8EEF7"/>'
				. '<rect x="42" y="38" width="22" height="6" rx="3" fill="#FFC629"/>'
				. '<circle cx="132" cy="41" r="11" fill="#E8EEF7" stroke="#12264A" stroke-width="4"/><path d="M132 41l6-5" stroke="#12264A" stroke-width="4" stroke-linecap="round"/>'
				. '<circle cx="160" cy="41" r="5" fill="#FFC629"/>'
				. '<circle cx="100" cy="140" r="58" fill="#E8EEF7" stroke="#12264A" stroke-width="5"/>'
				. '<circle cx="100" cy="140" r="42" fill="#12264A"/>'
				. '<g class="ill-spin"><path d="M100 140m-30 0a30 30 0 0 1 30 -30" stroke="#FFC629" stroke-width="7" fill="none" stroke-linecap="round"/><circle cx="100" cy="140" r="7" fill="#FFC629"/></g>'
				. '<g class="ill-steam" stroke="#5A6474" stroke-width="4" stroke-linecap="round" fill="none"><path d="M70 -2c-6 6 6 10 0 16"/><path d="M100 -6c-6 6 6 10 0 16"/><path d="M130 -2c-6 6 6 10 0 16"/></g>';
			break;

		case 'dishwasher':
			$inner = '<rect x="36" y="32" width="128" height="18" rx="9" fill="#E8EEF7"/>'
				. '<circle cx="48" cy="41" r="4" fill="#12264A"/><circle cx="62" cy="41" r="4" fill="#12264A"/><circle cx="76" cy="41" r="4" fill="#FFC629"/>'
				. '<rect x="118" y="37" width="38" height="8" rx="4" fill="#12264A"/>'
				. '<rect x="38" y="80" width="124" height="126" rx="12" fill="#E8EEF7" stroke="#12264A" stroke-width="5"/>'
				. '<path d="M38 120h124M38 164h124" stroke="#12264A" stroke-width="4"/>'
				. '<g class="ill-plates"><circle cx="66" cy="104" r="16" fill="#FFFFFF" stroke="#12264A" stroke-width="4"/><circle cx="100" cy="104" r="16" fill="#FFFFFF" stroke="#12264A" stroke-width="4"/><circle cx="134" cy="104" r="16" fill="#FFC629" stroke="#12264A" stroke-width="4"/></g>'
				. '<rect x="56" y="134" width="16" height="26" rx="6" fill="#FFFFFF" stroke="#12264A" stroke-width="4"/><rect x="82" y="138" width="16" height="22" rx="6" fill="#FFFFFF" stroke="#12264A" stroke-width="4"/><rect x="108" y="134" width="16" height="26" rx="6" fill="#FFFFFF" stroke="#12264A" stroke-width="4"/><rect x="134" y="138" width="14" height="22" rx="6" fill="#FFFFFF" stroke="#12264A" stroke-width="4"/>'
				. '<g class="ill-bubbles" fill="#FFFFFF" stroke="#5A6474" stroke-width="3"><circle cx="70" cy="186" r="7"/><circle cx="96" cy="182" r="5"/><circle cx="122" cy="188" r="8"/><circle cx="146" cy="180" r="4"/></g>';
			break;

		case 'washer':
		default:
			$inner = '<rect x="36" y="32" width="58" height="18" rx="9" fill="#E8EEF7"/>'
				. '<rect x="42" y="38" width="34" height="6" rx="3" fill="#FFC629"/>'
				. '<circle cx="132" cy="41" r="11" fill="#E8EEF7" stroke="#12264A" stroke-width="4"/><path d="M132 41v-7" stroke="#12264A" stroke-width="4" stroke-linecap="round"/>'
				. '<circle cx="160" cy="41" r="5" fill="#12264A"/>'
				. '<circle cx="100" cy="140" r="58" fill="#E8EEF7" stroke="#12264A" stroke-width="5"/>'
				. '<circle cx="100" cy="140" r="42" fill="#12264A"/>'
				. '<g class="ill-spin"><path d="M64 146c10-10 22 4 36-4s24-8 36 0v10a36 36 0 0 1-72 0z" fill="#3D6BB3"/><circle cx="84" cy="124" r="5" fill="#FFFFFF" opacity=".8"/><circle cx="114" cy="118" r="3.5" fill="#FFFFFF" opacity=".8"/></g>'
				. '<path d="M80 108a40 40 0 0 1 22 -9" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" opacity=".5"/>';
			break;
	}

	return sprintf(
		'<svg class="illustration illustration--%1$s %2$s" viewBox="0 -12 200 258" role="img" aria-label="%3$s" xmlns="http://www.w3.org/2000/svg">%4$s%5$s</svg>',
		esc_attr( $type ),
		esc_attr( $class ),
		esc_attr( 'dishwasher' === $type ? 'Dishwasher illustration' : ( 'dryer' === $type ? 'Clothes dryer illustration' : 'Washing machine illustration' ) ),
		$body,
		$inner
	);
}

/**
 * Map a service slug to its illustration.
 *
 * @param string $slug Service slug.
 * @return string
 */
function bia_service_illustration( $slug, $class = '' ) {
	$map = array(
		'washing-machine-repairs' => 'washer',
		'dryer-repairs'           => 'dryer',
		'dishwasher-repairs'      => 'dishwasher',
	);
	return bia_illustration( isset( $map[ $slug ] ) ? $map[ $slug ] : 'washer', $class );
}

/**
 * Hero composition: the three appliances inside the logo's turning arrow.
 */
function bia_hero_art() {
	ob_start();
	?>
	<div class="hero-art" aria-hidden="true">
		<svg class="hero-art__ring" viewBox="0 0 400 400">
			<path d="M318 120 A150 150 0 1 1 180 52" fill="none" stroke="#FFC629" stroke-width="30" stroke-linecap="round"/>
			<path d="M244 34 L160 20 L200 108 Z" fill="#FFC629" stroke="#FFC629" stroke-width="10" stroke-linejoin="round"/>
		</svg>
		<div class="hero-art__units">
			<?php echo bia_illustration( 'washer', 'hero-art__unit hero-art__unit--1' ); // phpcs:ignore ?>
			<?php echo bia_illustration( 'dryer', 'hero-art__unit hero-art__unit--2' ); // phpcs:ignore ?>
			<?php echo bia_illustration( 'dishwasher', 'hero-art__unit hero-art__unit--3' ); // phpcs:ignore ?>
		</div>
		<div class="hero-art__badge"><?php echo bia_icon( 'wrench' ); // phpcs:ignore ?><span><strong>Fixed on site</strong><small>Common parts carried in the van</small></span></div>
	</div>
	<?php
	return ob_get_clean();
}
