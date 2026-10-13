<?php
/**
 * Inner page hero.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$args    = isset( $args ) && is_array( $args ) ? $args : array();
$eyebrow = isset( $args['eyebrow'] ) ? $args['eyebrow'] : '';
$title   = isset( $args['title'] ) ? $args['title'] : get_the_title();
$lead    = isset( $args['lead'] ) ? $args['lead'] : '';
$art     = isset( $args['art'] ) ? $args['art'] : '';
$form    = ! empty( $args['form'] );
$service = isset( $args['service'] ) ? $args['service'] : '';
?>
<section class="page-hero<?php echo $form ? ' page-hero--form' : ''; ?>">
	<div class="page-hero__bg" aria-hidden="true"><span class="page-hero__ring" data-parallax="0.08"></span></div>
	<div class="container page-hero__inner">
		<div class="page-hero__copy">
			<?php bia_breadcrumbs(); ?>
			<?php if ( $eyebrow ) : ?>
				<?php bia_eyebrow( $eyebrow, 'eyebrow--light' ); ?>
			<?php endif; ?>
			<h1 class="h1"><?php echo esc_html( $title ); ?></h1>
			<?php if ( $lead ) : ?>
				<p class="lead"><?php echo esc_html( $lead ); ?></p>
			<?php endif; ?>
			<div class="btn-row">
				<?php bia_call_button( 'amber' ); ?>
				<?php if ( ! $form ) : ?>
					<?php bia_button( 'Book online', bia_book_url(), 'white' ); ?>
				<?php endif; ?>
			</div>
			<?php if ( $form ) : ?>
				<ul class="hero-ticks">
					<li><?php echo bia_icon( 'check' ); // phpcs:ignore ?>Fixed price first</li>
					<li><?php echo bia_icon( 'check' ); // phpcs:ignore ?>Same and next day bookings</li>
					<li><?php echo bia_icon( 'check' ); // phpcs:ignore ?>Workmanship guaranteed</li>
				</ul>
			<?php endif; ?>
		</div>
		<?php if ( $form ) : ?>
			<div class="hero-form" id="hero-form">
				<h2 class="hero-form__title">Book a repair</h2>
				<p class="hero-form__sub">We call you back to confirm a time.</p>
				<?php bia_form( 'booking', array( 'compact' => true, 'service' => $service ) ); ?>
			</div>
		<?php elseif ( $art ) : ?>
			<div class="page-hero__art"><?php echo $art; // phpcs:ignore ?></div>
		<?php endif; ?>
	</div>
</section>
