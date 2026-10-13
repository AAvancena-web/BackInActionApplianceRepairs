<?php
/**
 * Global pre-footer contact section: details, Google Map and booking form.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section contact-section" id="book" aria-labelledby="contact-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( 'Book a repair' ); ?>
			<h2 class="h2" id="contact-title">Ready to get back in action?</h2>
			<p class="lead">Call us now or send the form and we will ring you back to lock in a time.</p>
		</div>

		<div class="contact-grid">
			<div class="contact-info" data-reveal>
				<a class="info-card info-card--accent" href="<?php echo esc_attr( bia_phone_href() ); ?>">
					<span class="info-card__icon"><?php echo bia_icon( 'phone' ); // phpcs:ignore ?></span>
					<span><small>Call us</small><strong><?php echo esc_html( bia_phone() ); ?></strong></span>
				</a>
				<a class="info-card" href="mailto:<?php echo esc_attr( bia_email() ); ?>">
					<span class="info-card__icon"><?php echo bia_icon( 'mail' ); // phpcs:ignore ?></span>
					<span><small>Email us</small><strong><?php echo esc_html( bia_email() ); ?></strong></span>
				</a>
				<div class="info-card">
					<span class="info-card__icon"><?php echo bia_icon( 'clock' ); // phpcs:ignore ?></span>
					<span><small>Hours</small><strong><?php echo esc_html( bia_opt( 'bia_hours' ) ); ?></strong></span>
				</div>
				<div class="map-card">
					<iframe title="Service area map" src="<?php echo esc_url( bia_map_embed_url() ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					<span class="map-card__label"><?php echo bia_icon( 'pin' ); // phpcs:ignore ?> Servicing <?php echo esc_html( bia_opt( 'bia_area' ) ); ?></span>
				</div>
			</div>

			<div class="form-card" data-reveal data-delay=".1s">
				<h3 class="form-card__title">Book your repair</h3>
				<p class="form-card__sub">Tell us the appliance and what it is doing. We will call you back to confirm.</p>
				<?php bia_form( 'booking' ); ?>
			</div>
		</div>
	</div>
</section>
