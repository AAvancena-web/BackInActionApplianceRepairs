<?php
/**
 * Template Name: About
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'eyebrow' => 'About us',
		'title'   => 'Fixing what matters at home',
		'lead'    => 'Back In Action Appliance Repairs is a new Melbourne business with a long family history in the trade. We repair washing machines, dryers and dishwashers, and we do it properly.',
		'art'     => bia_illustration( 'washer', 'page-hero__unit' ),
	)
);
?>

<section class="section intro-section" aria-labelledby="story-title">
	<div class="container intro-grid">
		<div class="intro-art" data-reveal>
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'bia-card', array( 'class' => 'intro-photo' ) );
			} else {
				echo bia_hero_art(); // phpcs:ignore
			}
			?>
		</div>
		<div class="intro-copy" data-reveal data-delay=".1s">
			<?php bia_eyebrow( 'Our story' ); ?>
			<h2 class="h2" id="story-title">Raised in the trade, starting something of our own</h2>
			<p class="lead">Some kids grow up kicking a footy in the backyard. We grew up holding the torch while a dishwasher pump got swapped out.</p>
			<p>Appliance repair has been part of our family for years. After learning the trade from the ground up, working on just about every brand and fault you can think of, we started Back In Action to do things our own way.</p>
			<p>That means a tight focus on the three appliances households rely on most, a fixed price before we start, and the kind of respect for your home and your time that keeps customers coming back.</p>
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
		</div>
	</div>
</section>

<section class="section reasons-section" aria-labelledby="values-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( 'What we stand for', 'eyebrow--light' ); ?>
			<h2 class="h2" id="values-title">How we work</h2>
		</div>
		<div class="reason-grid">
			<?php foreach ( bia_reasons() as $i => $reason ) : ?>
				<div class="reason" data-reveal data-delay="<?php echo esc_attr( ( $i % 3 * 0.08 ) . 's' ); ?>">
					<span class="reason__icon"><?php echo bia_icon( $reason['icon'] ); // phpcs:ignore ?></span>
					<h3><?php echo esc_html( $reason['title'] ); ?></h3>
					<p><?php echo esc_html( $reason['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section services-section" aria-labelledby="about-services-title">
	<div class="container">
		<div class="section-head section-head--split" data-reveal>
			<div>
				<?php bia_eyebrow( 'What we repair' ); ?>
				<h2 class="h2" id="about-services-title">Our repair services</h2>
			</div>
			<p>Specialists in the three appliances that keep a busy household running.</p>
		</div>
		<?php get_template_part( 'template-parts/service-cards' ); ?>
	</div>
</section>

<?php get_template_part( 'template-parts/process' ); ?>

<?php get_template_part( 'template-parts/brands' ); ?>

<?php get_template_part( 'template-parts/cta-band' ); ?>

<?php
get_footer();
