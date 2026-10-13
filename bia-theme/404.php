<?php
/**
 * 404.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'title' => 'This page is out of action',
		'lead'  => 'The page you are after has moved or no longer exists. Try one of our repair services below or give us a call.',
	)
);
?>
<section class="section services-section">
	<div class="container">
		<?php get_template_part( 'template-parts/service-cards' ); ?>
	</div>
</section>
<?php
get_footer();
