<?php
/**
 * Template Name: About
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$about = bia_page( 'about' );

get_header();

get_template_part( 'template-parts/page-hero', null, array( 'hero' => $about['hero'], 'art' => bia_illustration( 'washer', 'page-hero__unit' ) ) );
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
			<?php bia_eyebrow( $about['story']['eyebrow'] ); ?>
			<h2 class="h2" id="story-title"><?php echo esc_html( $about['story']['title'] ); ?></h2>
			<?php bia_paras( $about['story']['paras'], 'lead' ); ?>
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

<?php get_template_part( 'template-parts/reasons' ); ?>

<section class="section services-section" aria-labelledby="about-services-title">
	<div class="container">
		<div class="section-head section-head--split" data-reveal>
			<div>
				<?php bia_eyebrow( $about['services']['eyebrow'] ); ?>
				<h2 class="h2" id="about-services-title"><?php echo esc_html( $about['services']['title'] ); ?></h2>
			</div>
			<p><?php echo esc_html( $about['services']['text'] ); ?></p>
		</div>
		<?php get_template_part( 'template-parts/service-cards', null, array( 'variant' => 'about', 'cta' => $about['services']['cta'] ) ); ?>
	</div>
</section>

<?php get_template_part( 'template-parts/process' ); ?>

<?php get_template_part( 'template-parts/brands' ); ?>

<?php get_template_part( 'template-parts/faq' ); ?>

<?php get_template_part( 'template-parts/cta-band' ); ?>

<?php
get_footer();
