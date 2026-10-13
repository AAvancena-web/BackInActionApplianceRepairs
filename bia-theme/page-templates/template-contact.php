<?php
/**
 * Template Name: Contact
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'eyebrow' => 'Contact',
		'title'   => 'Book a repair or ask a question',
		'lead'    => 'The fastest way to book is to call. Prefer to type? Send the form and we will call you back to lock in a time.',
		'art'     => bia_illustration( 'dishwasher', 'page-hero__unit' ),
	)
);

get_template_part( 'template-parts/contact-section' );
?>

<section class="section areas-section" aria-labelledby="areas-title">
	<div class="container areas-grid">
		<div data-reveal>
			<?php bia_eyebrow( 'Service area' ); ?>
			<h2 class="h2" id="areas-title">Where we work</h2>
			<p>We cover <?php echo esc_html( bia_opt( 'bia_area' ) ); ?>. If you are not sure whether we come to your suburb, just call and ask.</p>
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
		<ul class="area-chips" data-reveal data-delay=".1s">
			<?php foreach ( bia_areas() as $area ) : ?>
				<li><?php echo bia_icon( 'pin' ); // phpcs:ignore ?><?php echo esc_html( $area ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php get_template_part( 'template-parts/faq' ); ?>

<?php
get_footer();
