<?php
/**
 * Call to action band.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$args  = isset( $args ) && is_array( $args ) ? $args : array();
$title = isset( $args['title'] ) ? $args['title'] : 'Appliance playing up? Let us take a look.';
$text  = isset( $args['text'] ) ? $args['text'] : 'Fast bookings across ' . bia_opt( 'bia_area' ) . ' with a fixed price before any work starts.';
?>
<section class="cta-band" aria-label="Book a repair">
	<div class="container">
		<div class="cta-band__inner" data-reveal>
			<svg class="cta-band__ring" viewBox="0 0 100 100" aria-hidden="true"><path d="M70.48 36.66 A25 25 0 1 1 39.43 28.34" fill="none" stroke="currentColor" stroke-width="10" stroke-linecap="round"/><path d="M54.84 21.16 L32.58 17.19 L43.57 40.76 Z" fill="currentColor" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round"/></svg>
			<div class="cta-band__copy">
				<h2 class="h2"><?php echo esc_html( $title ); ?></h2>
				<p><?php echo esc_html( $text ); ?></p>
			</div>
			<div class="cta-band__actions">
				<?php bia_call_button( 'navy' ); ?>
				<?php bia_button( 'Book online', bia_book_url(), 'white' ); ?>
			</div>
		</div>
	</div>
</section>
