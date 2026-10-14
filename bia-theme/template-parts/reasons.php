<?php
/**
 * Why us / values grid (copy from the current page's "reasons" section).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$section = bia_section( 'reasons' );
?>
<section class="section reasons-section" aria-labelledby="reasons-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( $section['eyebrow'], 'eyebrow--light' ); ?>
			<h2 class="h2" id="reasons-title"><?php echo esc_html( $section['title'] ); ?></h2>
		</div>
		<div class="reason-grid">
			<?php foreach ( $section['items'] as $i => $reason ) : ?>
				<div class="reason" data-reveal data-delay="<?php echo esc_attr( ( $i % 3 * 0.08 ) . 's' ); ?>">
					<span class="reason__icon"><?php echo bia_icon( $reason['icon'] ); // phpcs:ignore ?></span>
					<h3><?php echo esc_html( $reason['title'] ); ?></h3>
					<?php bia_paras( $reason['paras'] ); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
