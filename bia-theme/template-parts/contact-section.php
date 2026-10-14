<?php
/**
 * Global pre-footer contact section: contact details, Google Map and booking form.
 * Copy comes from the current page's "contact" section.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$c       = bia_section( 'contact' );
$cards   = isset( $c['cards'] ) ? $c['cards'] : array();
$service = bia_get_service( bia_current_slug() );
?>
<section class="section contact-section" id="book" aria-labelledby="contact-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( $c['eyebrow'] ); ?>
			<h2 class="h2" id="contact-title"><?php echo esc_html( $c['title'] ); ?></h2>
			<?php if ( ! empty( $c['paras'] ) ) : ?>
				<div class="contact-section__intro"><?php bia_paras( $c['paras'], 'lead' ); ?></div>
			<?php else : ?>
				<p class="lead"><?php echo bia_rich( $c['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
			<?php endif; ?>
		</div>

		<div class="contact-grid">
			<div class="contact-info" data-reveal>
				<h3 class="contact-info__title">Contact Details</h3>
				<a class="info-card info-card--accent" href="<?php echo esc_attr( bia_phone_href() ); ?>">
					<span class="info-card__icon"><?php echo bia_icon( 'phone' ); // phpcs:ignore ?></span>
					<span><small>Call Us</small><strong><?php echo esc_html( bia_phone() ); ?></strong><?php echo ! empty( $cards['phone'] ) ? '<em>' . esc_html( $cards['phone'] ) . '</em>' : ''; ?></span>
				</a>
				<a class="info-card" href="mailto:<?php echo esc_attr( bia_email() ); ?>">
					<span class="info-card__icon"><?php echo bia_icon( 'mail' ); // phpcs:ignore ?></span>
					<span><small>Email Us</small><strong><?php echo esc_html( bia_email() ); ?></strong><?php echo ! empty( $cards['email'] ) ? '<em>' . esc_html( $cards['email'] ) . '</em>' : ''; ?></span>
				</a>
				<div class="info-card">
					<span class="info-card__icon"><?php echo bia_icon( 'clock' ); // phpcs:ignore ?></span>
					<span><small><?php echo esc_html( ! empty( $c['hours_label'] ) ? $c['hours_label'] : 'Hours' ); ?></small><strong><?php echo esc_html( bia_opt( 'bia_hours' ) ); ?></strong></span>
				</div>
				<div class="info-card">
					<span class="info-card__icon"><?php echo bia_icon( 'pin' ); // phpcs:ignore ?></span>
					<span><small>Service Area</small><strong><?php echo esc_html( bia_opt( 'bia_area' ) ); ?></strong></span>
				</div>
				<div class="map-card">
					<iframe title="Service area map" src="<?php echo esc_url( bia_map_embed_url() ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					<span class="map-card__label"><?php echo bia_icon( 'pin' ); // phpcs:ignore ?> Servicing <?php echo esc_html( bia_opt( 'bia_area' ) ); ?></span>
				</div>
			</div>

			<div class="form-card" data-reveal data-delay=".1s">
				<h3 class="form-card__title"><?php echo esc_html( $c['form_title'] ); ?></h3>
				<p class="form-card__sub"><?php echo esc_html( $c['form_sub'] ); ?></p>
				<?php
				bia_form(
					'booking',
					array(
						'service'       => $service ? bia_current_slug() : '',
						'model'         => ! empty( $c['model'] ),
						'extra'         => ! empty( $c['extra'] ) ? $c['extra'] : '',
						'message_label' => $c['message_label'],
						'support'       => $c['support'],
					)
				);
				?>
			</div>
		</div>
	</div>
</section>
