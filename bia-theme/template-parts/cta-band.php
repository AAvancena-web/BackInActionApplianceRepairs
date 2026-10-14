<?php
/**
 * Call to action band (copy from the current page's "cta" section).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$cta = bia_section( 'cta' );
?>
<section class="cta-band" aria-label="Book a repair">
	<div class="container">
		<div class="cta-band__inner" data-reveal>
			<svg class="cta-band__ring" viewBox="0 0 100 100" aria-hidden="true"><path d="M70.48 36.66 A25 25 0 1 1 39.43 28.34" fill="none" stroke="currentColor" stroke-width="10" stroke-linecap="round"/><path d="M54.84 21.16 L32.58 17.19 L43.57 40.76 Z" fill="currentColor" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round"/></svg>
			<div class="cta-band__copy">
				<h2 class="h2"><?php echo esc_html( $cta['title'] ); ?></h2>
				<p><?php echo bia_rich( $cta['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
			</div>
			<div class="cta-band__actions">
				<?php bia_call_button( 'navy' ); ?>
				<?php bia_button( 'Book Online', bia_book_url(), 'white' ); ?>
			</div>
		</div>
	</div>
</section>
