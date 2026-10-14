<?php
/**
 * Brands marquee (text only), with the page's heading and note.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$section = bia_section( 'brands' );
$brands  = bia_brands( isset( $section['list'] ) ? $section['list'] : 'all' );
?>
<section class="brands" aria-labelledby="brands-title">
	<div class="container brands__head">
		<?php if ( ! empty( $section['eyebrow'] ) ) : ?>
			<?php bia_eyebrow( $section['eyebrow'] ); ?>
		<?php endif; ?>
		<h2 class="brands__title" id="brands-title"><?php echo esc_html( $section['title'] ); ?></h2>
	</div>
	<div class="marquee" data-marquee>
		<ul class="marquee__track">
			<?php foreach ( array_merge( $brands, $brands ) as $i => $brand ) : ?>
				<li<?php echo $i >= count( $brands ) ? ' aria-hidden="true"' : ''; ?>><?php echo esc_html( $brand ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php if ( ! empty( $section['note'] ) ) : ?>
		<div class="container"><p class="brands__note"><?php echo esc_html( $section['note'] ); ?></p></div>
	<?php endif; ?>
</section>
