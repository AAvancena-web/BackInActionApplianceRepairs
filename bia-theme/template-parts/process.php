<?php
/**
 * How it works steps.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section process-section" aria-labelledby="process-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( 'How it works' ); ?>
			<h2 class="h2" id="process-title">From broken to back in action in four steps</h2>
		</div>
		<ol class="process" data-process>
			<?php foreach ( bia_process() as $i => $step ) : ?>
				<li class="process__step" data-reveal data-delay="<?php echo esc_attr( ( $i * 0.1 ) . 's' ); ?>">
					<span class="process__num"><?php echo esc_html( $i + 1 ); ?></span>
					<h3><?php echo esc_html( $step['title'] ); ?></h3>
					<p><?php echo esc_html( $step['text'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
