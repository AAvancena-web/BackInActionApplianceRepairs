<?php
/**
 * FAQ accordion (copy from the current page's "faqs" section).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$section = bia_section( 'faqs' );
$faqs    = $section['items'];
?>
<section class="section faq-section" aria-labelledby="faq-title">
	<div class="container faq-layout">
		<div class="faq-intro" data-reveal>
			<?php bia_eyebrow( $section['eyebrow'] ); ?>
			<h2 class="h2" id="faq-title"><?php echo esc_html( $section['title'] ); ?></h2>
			<?php bia_paras( $section['intro'] ); ?>
			<?php bia_call_button( 'navy' ); ?>
		</div>
		<div class="faq-list" data-reveal data-delay=".1s">
			<?php foreach ( $faqs as $i => $faq ) : ?>
				<details class="faq"<?php echo 0 === $i ? ' open' : ''; ?>>
					<summary><span><?php echo esc_html( $faq[0] ); ?></span><span class="faq__icon"><?php echo bia_icon( 'plus' ); // phpcs:ignore ?></span></summary>
					<div class="faq__body"><?php bia_paras( $faq[1] ); ?></div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
	<script type="application/ld+json"><?php
	$entities = array();
	foreach ( $faqs as $faq ) {
		$answer     = str_replace( '**', '', implode( ' ', (array) $faq[1] ) );
		$entities[] = array( '@type' => 'Question', 'name' => $faq[0], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $answer ) );
	}
	echo wp_json_encode( array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $entities ), JSON_UNESCAPED_SLASHES );
	?></script>
</section>
