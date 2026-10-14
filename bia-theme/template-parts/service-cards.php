<?php
/**
 * Service cards (whole card is a link).
 *
 * Args: variant home|about|other. "other" shows the other two services with the
 * current service page's own descriptions and button labels.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$args    = isset( $args ) && is_array( $args ) ? $args : array();
$variant = isset( $args['variant'] ) ? $args['variant'] : 'home';
$cta     = isset( $args['cta'] ) ? $args['cta'] : 'Learn More';
$current = bia_current_slug();
$others  = array();
if ( 'other' === $variant ) {
	$other  = bia_section( 'other' );
	$others = isset( $other['items'] ) ? $other['items'] : array();
}
$i = 0;
?>
<div class="service-grid<?php echo 'other' === $variant ? ' service-grid--two' : ''; ?>">
	<?php foreach ( bia_services() as $slug => $service ) : ?>
		<?php
		if ( 'other' === $variant && ( $slug === $current || ! isset( $others[ $slug ] ) ) ) {
			continue;
		}
		if ( 'other' === $variant ) {
			$text  = array( $others[ $slug ][0] );
			$label = $others[ $slug ][1];
		} elseif ( 'about' === $variant ) {
			$text  = $service['about_card'];
			$label = $cta;
		} else {
			$text  = array( $service['card'] );
			$label = $cta;
		}
		?>
		<a class="service-card" href="<?php echo esc_url( bia_url( $slug ) ); ?>" data-reveal data-delay="<?php echo esc_attr( ( $i++ * 0.08 ) . 's' ); ?>">
			<span class="service-card__art"><?php echo bia_illustration( $service['art'] ); // phpcs:ignore ?></span>
			<span class="service-card__body">
				<span class="service-card__icon"><?php echo bia_icon( $service['icon'] ); // phpcs:ignore ?></span>
				<h3 class="service-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
				<span class="service-card__text"><?php bia_paras( $text ); ?></span>
				<span class="service-card__link"><?php echo esc_html( $label ); ?> <?php echo bia_icon( 'arrow-right' ); // phpcs:ignore ?></span>
			</span>
		</a>
	<?php endforeach; ?>
</div>
