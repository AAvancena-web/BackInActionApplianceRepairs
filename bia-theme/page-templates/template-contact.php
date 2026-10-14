<?php
/**
 * Template Name: Contact
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$contact = bia_page( 'contact' );

get_header();

get_template_part( 'template-parts/page-hero', null, array( 'hero' => $contact['hero'], 'art' => bia_illustration( 'dishwasher', 'page-hero__unit' ) ) );

get_template_part( 'template-parts/contact-section' );

get_template_part( 'template-parts/areas' );

while ( have_posts() ) :
	the_post();
	if ( get_the_content() ) {
		echo '<section class="section"><div class="container container--narrow entry-content">';
		the_content();
		echo '</div></section>';
	}
endwhile;

get_template_part( 'template-parts/faq' );

get_footer();
