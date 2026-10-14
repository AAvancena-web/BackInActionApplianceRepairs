<?php
/**
 * Template Name: Service
 *
 * Service page. Content is matched by page slug in inc/content.json.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$slug    = bia_current_slug();
$service = bia_get_service( $slug );
if ( ! $service ) {
	$services = bia_services();
	$slug     = key( $services );
	$service  = reset( $services );
}

get_header();

get_template_part( 'template-parts/page-hero', null, array( 'form' => true ) );

get_template_part( 'template-parts/trust-strip' );
?>

<section class="section intro-section" aria-labelledby="svc-intro-title">
	<div class="container intro-grid">
		<div class="intro-art intro-art--single" data-reveal>
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'bia-card', array( 'class' => 'intro-photo' ) );
			} else {
				echo bia_illustration( $service['art'] ); // phpcs:ignore
			}
			?>
		</div>
		<div class="intro-copy" data-reveal data-delay=".1s">
			<?php bia_eyebrow( $service['intro']['eyebrow'] ); ?>
			<h2 class="h2" id="svc-intro-title"><?php echo esc_html( $service['intro']['title'] ); ?></h2>
			<?php bia_paras( $service['intro']['paras'], 'lead' ); ?>
			<?php
			while ( have_posts() ) :
				the_post();
				if ( get_the_content() ) {
					echo '<div class="entry-content">';
					the_content();
					echo '</div>';
				}
			endwhile;
			?>
			<div class="btn-row">
				<?php bia_call_button( 'navy' ); ?>
				<?php bia_button( 'Book Online', '#hero-form', 'amber' ); ?>
			</div>
		</div>
	</div>
</section>

<section class="section faults-section" aria-labelledby="svc-faults-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( $service['faults']['eyebrow'] ); ?>
			<h2 class="h2" id="svc-faults-title"><?php echo esc_html( $service['faults']['title'] ); ?></h2>
		</div>
		<div class="fault-cards">
			<?php foreach ( $service['faults']['items'] as $i => $fault ) : ?>
				<div class="fault-card" data-reveal data-delay="<?php echo esc_attr( ( $i % 3 * 0.08 ) . 's' ); ?>">
					<span class="fault-card__icon"><?php echo bia_icon( 'wrench' ); // phpcs:ignore ?></span>
					<h3><?php echo esc_html( $fault[0] ); ?></h3>
					<?php bia_paras( $fault[1] ); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section included-section" aria-labelledby="svc-included-title">
	<div class="container included-grid">
		<div class="included-card" data-reveal>
			<?php bia_eyebrow( $service['included']['eyebrow'], 'eyebrow--light' ); ?>
			<h2 class="h2" id="svc-included-title"><?php echo esc_html( $service['included']['title'] ); ?></h2>
			<ul class="tick-list tick-list--light">
				<?php foreach ( $service['included']['items'] as $item ) : ?>
					<li><?php echo bia_icon( 'check' ); // phpcs:ignore ?><?php echo esc_html( $item ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="advice-card" data-reveal data-delay=".1s">
			<span class="advice-card__icon"><?php echo bia_icon( 'refresh' ); // phpcs:ignore ?></span>
			<?php bia_eyebrow( $service['advice']['eyebrow'], 'eyebrow--navy' ); ?>
			<h2 class="h3"><?php echo esc_html( $service['advice']['title'] ); ?></h2>
			<?php bia_paras( $service['advice']['paras'] ); ?>
			<?php bia_button( $service['advice']['cta'], bia_book_url(), 'navy' ); ?>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/process' ); ?>

<?php get_template_part( 'template-parts/brands' ); ?>

<?php get_template_part( 'template-parts/reviews' ); ?>

<?php get_template_part( 'template-parts/faq' ); ?>

<section class="section other-services" aria-labelledby="other-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( $service['other']['eyebrow'] ); ?>
			<h2 class="h2" id="other-title"><?php echo esc_html( $service['other']['title'] ); ?></h2>
		</div>
		<?php get_template_part( 'template-parts/service-cards', null, array( 'variant' => 'other' ) ); ?>
	</div>
</section>

<?php get_template_part( 'template-parts/cta-band' ); ?>

<?php
get_footer();
