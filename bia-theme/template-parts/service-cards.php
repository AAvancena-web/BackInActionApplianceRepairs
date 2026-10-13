<?php
/**
 * Service cards (whole card is a link).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$args    = isset( $args ) && is_array( $args ) ? $args : array();
$exclude = isset( $args['exclude'] ) ? $args['exclude'] : '';
$i       = 0;
?>
<div class="service-grid<?php echo $exclude ? ' service-grid--two' : ''; ?>">
	<?php foreach ( bia_services() as $slug => $service ) : ?>
		<?php
		if ( $slug === $exclude ) {
			continue;
		}
		?>
		<a class="service-card" href="<?php echo esc_url( bia_url( $slug ) ); ?>" data-reveal data-delay="<?php echo esc_attr( ( $i++ * 0.08 ) . 's' ); ?>">
			<span class="service-card__art"><?php echo bia_service_illustration( $slug ); // phpcs:ignore ?></span>
			<span class="service-card__body">
				<span class="service-card__icon"><?php echo bia_icon( $service['icon'] ); // phpcs:ignore ?></span>
				<h3 class="service-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
				<p><?php echo esc_html( $service['card'] ); ?></p>
				<span class="service-card__link">Learn more <?php echo bia_icon( 'arrow-right' ); // phpcs:ignore ?></span>
			</span>
		</a>
	<?php endforeach; ?>
</div>
