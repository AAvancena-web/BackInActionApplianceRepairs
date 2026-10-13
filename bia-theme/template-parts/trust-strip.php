<?php
/**
 * Trust strip.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="trust-strip" aria-label="Why book with us">
	<div class="container">
		<ul class="trust-grid">
			<?php foreach ( bia_trust_points() as $i => $point ) : ?>
				<li class="trust-item" data-reveal data-delay="<?php echo esc_attr( ( $i * 0.06 ) . 's' ); ?>">
					<span class="trust-item__icon"><?php echo bia_icon( $point['icon'] ); // phpcs:ignore ?></span>
					<span><strong><?php echo esc_html( $point['title'] ); ?></strong><small><?php echo esc_html( $point['text'] ); ?></small></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
