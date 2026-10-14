<?php
/**
 * Service area (copy from the current page's "areas" section).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$section = bia_section( 'areas' );
$cta_url = 'contact' === bia_current_slug() ? '#book' : bia_url( 'contact' );
?>
<section class="section areas-section" aria-labelledby="areas-title">
	<div class="container areas-grid">
		<div data-reveal>
			<?php bia_eyebrow( $section['eyebrow'] ); ?>
			<h2 class="h2" id="areas-title"><?php echo esc_html( $section['title'] ); ?></h2>
			<?php bia_paras( $section['paras'] ); ?>
			<?php bia_button( $section['cta'], $cta_url, 'navy' ); ?>
		</div>
		<div data-reveal data-delay=".1s">
			<h3 class="areas-list-title"><?php echo esc_html( $section['list_title'] ); ?></h3>
			<ul class="area-chips">
				<?php foreach ( bia_areas() as $area ) : ?>
					<li><?php echo bia_icon( 'pin' ); // phpcs:ignore ?><?php echo esc_html( $area ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
