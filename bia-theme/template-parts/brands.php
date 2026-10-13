<?php
/**
 * Brands marquee (text only).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$brands = bia_brands();
?>
<section class="brands" aria-labelledby="brands-title">
	<div class="container brands__head">
		<h2 class="brands__title" id="brands-title">We repair all major brands, including</h2>
	</div>
	<div class="marquee" data-marquee>
		<ul class="marquee__track">
			<?php foreach ( array_merge( $brands, $brands ) as $i => $brand ) : ?>
				<li<?php echo $i >= count( $brands ) ? ' aria-hidden="true"' : ''; ?>><?php echo esc_html( $brand ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
