<?php
/**
 * FAQ accordion.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$args  = isset( $args ) && is_array( $args ) ? $args : array();
$faqs  = isset( $args['faqs'] ) ? $args['faqs'] : bia_faqs();
$title = isset( $args['title'] ) ? $args['title'] : 'Frequently asked questions';
?>
<section class="section faq-section" aria-labelledby="faq-title">
	<div class="container faq-layout">
		<div class="faq-intro" data-reveal>
			<?php bia_eyebrow( 'FAQs' ); ?>
			<h2 class="h2" id="faq-title"><?php echo esc_html( $title ); ?></h2>
			<p>Cannot see your question? Give us a call and talk to the person who will actually fix your appliance.</p>
			<?php bia_call_button( 'navy' ); ?>
		</div>
		<div class="faq-list" data-reveal data-delay=".1s">
			<?php foreach ( $faqs as $i => $faq ) : ?>
				<details class="faq"<?php echo 0 === $i ? ' open' : ''; ?>>
					<summary><span><?php echo esc_html( $faq[0] ); ?></span><span class="faq__icon"><?php echo bia_icon( 'plus' ); // phpcs:ignore ?></span></summary>
					<div class="faq__body"><p><?php echo esc_html( $faq[1] ); ?></p></div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
	<script type="application/ld+json"><?php
	$entities = array();
	foreach ( $faqs as $faq ) {
		$entities[] = array( '@type' => 'Question', 'name' => $faq[0], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $faq[1] ) );
	}
	echo wp_json_encode( array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $entities ), JSON_UNESCAPED_SLASHES );
	?></script>
</section>
