<?php
/**
 * Template Name: Service
 *
 * Service page. Content is matched by page slug in inc/data.php.
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

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'eyebrow' => 'Melbourne ' . strtolower( $service['title'] ),
		'title'   => $service['title'] . ' Melbourne',
		'lead'    => $service['hero_lead'],
		'form'    => true,
		'service' => $slug,
	)
);

get_template_part( 'template-parts/trust-strip' );
?>

<section class="section intro-section" aria-labelledby="svc-intro-title">
	<div class="container intro-grid">
		<div class="intro-art intro-art--single" data-reveal>
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'bia-card', array( 'class' => 'intro-photo' ) );
			} else {
				echo bia_service_illustration( $slug ); // phpcs:ignore
			}
			?>
		</div>
		<div class="intro-copy" data-reveal data-delay=".1s">
			<?php bia_eyebrow( $service['title'] ); ?>
			<h2 class="h2" id="svc-intro-title"><?php echo esc_html( $service['intro_title'] ); ?></h2>
			<?php foreach ( $service['intro'] as $para ) : ?>
				<p><?php echo esc_html( $para ); ?></p>
			<?php endforeach; ?>
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
				<?php bia_button( 'Book online', '#hero-form', 'amber' ); ?>
			</div>
		</div>
	</div>
</section>

<section class="section faults-section" aria-labelledby="svc-faults-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( 'Common faults' ); ?>
			<h2 class="h2" id="svc-faults-title"><?php echo esc_html( ucfirst( $service['single'] ) ); ?> problems we fix every week</h2>
		</div>
		<div class="fault-cards">
			<?php foreach ( $service['faults'] as $i => $fault ) : ?>
				<div class="fault-card" data-reveal data-delay="<?php echo esc_attr( ( $i % 3 * 0.08 ) . 's' ); ?>">
					<span class="fault-card__icon"><?php echo bia_icon( 'wrench' ); // phpcs:ignore ?></span>
					<h3><?php echo esc_html( $fault[0] ); ?></h3>
					<p><?php echo esc_html( $fault[1] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section included-section" aria-labelledby="svc-included-title">
	<div class="container included-grid">
		<div class="included-card" data-reveal>
			<?php bia_eyebrow( 'Every repair includes', 'eyebrow--light' ); ?>
			<h2 class="h2" id="svc-included-title">What you get when you book</h2>
			<ul class="tick-list tick-list--light">
				<?php foreach ( $service['included'] as $item ) : ?>
					<li><?php echo bia_icon( 'check' ); // phpcs:ignore ?><?php echo esc_html( $item ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="advice-card" data-reveal data-delay=".1s">
			<span class="advice-card__icon"><?php echo bia_icon( 'refresh' ); // phpcs:ignore ?></span>
			<h2 class="h3">Repair or replace?</h2>
			<p><?php echo esc_html( $service['repair_or_replace'] ); ?></p>
			<?php bia_button( 'Ask for an honest opinion', bia_url( 'contact' ), 'navy' ); ?>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/process' ); ?>

<?php get_template_part( 'template-parts/brands' ); ?>

<?php get_template_part( 'template-parts/reviews' ); ?>

<?php get_template_part( 'template-parts/faq', null, array( 'faqs' => $service['faqs'], 'title' => ucfirst( $service['single'] ) . ' repair questions' ) ); ?>

<section class="section other-services" aria-labelledby="other-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( 'We also repair' ); ?>
			<h2 class="h2" id="other-title">Other appliances we fix</h2>
		</div>
		<?php get_template_part( 'template-parts/service-cards', null, array( 'exclude' => $slug ) ); ?>
	</div>
</section>

<?php get_template_part( 'template-parts/cta-band', null, array( 'title' => 'Is your ' . $service['single'] . ' playing up? Let us take a look.' ) ); ?>

<?php
get_footer();
