<?php
/**
 * Default page.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part( 'template-parts/page-hero' );
?>
<section class="section">
	<div class="container container--narrow entry-content">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>
</section>
<?php
get_template_part( 'template-parts/cta-band' );
get_footer();
