<?php
/**
 * Inner page hero. Copy comes from the current page's "hero" section unless args override it.
 *
 * Args: form (bool, show the booking form), art (HTML), title (fallback title).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$args    = isset( $args ) && is_array( $args ) ? $args : array();
$content = bia_current_content();
$hero    = isset( $args['hero'] ) ? $args['hero'] : ( isset( $content['hero'] ) && bia_is_content_page() && ! is_front_page() ? $content['hero'] : array() );
$title   = ! empty( $hero['title'] ) ? $hero['title'] : ( isset( $args['title'] ) ? $args['title'] : get_the_title() );
$lead    = ! empty( $hero['lead'] ) ? $hero['lead'] : ( isset( $args['lead'] ) ? $args['lead'] : '' );
$art     = isset( $args['art'] ) ? $args['art'] : '';
$form    = ! empty( $args['form'] );
$ticks   = ! empty( $hero['ticks'] ) ? $hero['ticks'] : array();
$service = bia_get_service( bia_current_slug() );
?>
<section class="page-hero<?php echo $form ? ' page-hero--form' : ''; ?>">
	<div class="page-hero__bg" aria-hidden="true"><span class="page-hero__ring" data-parallax="0.08"></span></div>
	<div class="container page-hero__inner">
		<div class="page-hero__copy">
			<?php bia_breadcrumbs(); ?>
			<?php if ( ! empty( $hero['eyebrow'] ) ) : ?>
				<?php bia_eyebrow( $hero['eyebrow'], 'eyebrow--light' ); ?>
			<?php endif; ?>
			<h1 class="h1"><?php echo esc_html( $title ); ?></h1>
			<?php if ( $lead ) : ?>
				<p class="lead"><?php echo bia_rich( $lead ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
			<?php endif; ?>
			<div class="btn-row">
				<?php bia_call_button( 'amber' ); ?>
				<?php if ( ! empty( $hero['secondary'] ) ) : ?>
					<?php bia_button( $hero['secondary'], $form ? '#hero-form' : bia_book_url(), 'white' ); ?>
				<?php endif; ?>
			</div>
			<?php if ( $ticks ) : ?>
				<ul class="hero-ticks">
					<?php foreach ( $ticks as $tick ) : ?>
						<li><?php echo bia_icon( 'check' ); // phpcs:ignore ?><?php echo esc_html( $tick ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<?php if ( $form && $service ) : ?>
			<div class="hero-form" id="hero-form">
				<h2 class="hero-form__title"><?php echo esc_html( $service['form']['title'] ); ?></h2>
				<p class="hero-form__sub"><?php echo esc_html( $service['form']['sub'] ); ?></p>
				<?php
				bia_form(
					'booking',
					array(
						'compact'       => true,
						'service'       => bia_current_slug(),
						'model'         => ! empty( $service['form']['model'] ),
						'message_label' => $service['form']['message_label'],
						'support'       => $service['form']['support'],
					)
				);
				?>
			</div>
		<?php elseif ( $art ) : ?>
			<div class="page-hero__art"><?php echo $art; // phpcs:ignore ?></div>
		<?php endif; ?>
	</div>
</section>
