<?php
/**
 * Reviews. Only shows when real reviews are added (see bia_reviews() in inc/data.php).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$reviews = bia_reviews();
if ( ! $reviews ) {
	return;
}
?>
<section class="section reviews-section" aria-labelledby="reviews-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( 'Reviews' ); ?>
			<h2 class="h2" id="reviews-title">What our customers say</h2>
		</div>
		<div class="review-grid">
			<?php foreach ( $reviews as $i => $review ) : ?>
				<figure class="review" data-reveal data-delay="<?php echo esc_attr( ( $i * 0.08 ) . 's' ); ?>">
					<div class="review__stars" aria-label="5 stars"><?php echo str_repeat( bia_icon( 'star' ), 5 ); // phpcs:ignore ?></div>
					<blockquote><p><?php echo esc_html( $review['text'] ); ?></p></blockquote>
					<figcaption><strong><?php echo esc_html( $review['name'] ); ?></strong><?php echo ! empty( $review['service'] ) ? '<span>' . esc_html( $review['service'] ) . '</span>' : ''; ?></figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
		<?php if ( bia_opt( 'bia_google' ) ) : ?>
			<p class="reviews-more"><?php bia_button( 'Read more reviews on Google', bia_opt( 'bia_google' ), 'navy', 'arrow-right', 'target="_blank" rel="noopener"' ); ?></p>
		<?php endif; ?>
	</div>
</section>
