<?php
/**
 * How it works steps (copy from the current page's "process" section).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$process = bia_section( 'process' );
?>
<section class="section process-section" aria-labelledby="process-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( 'How It Works' ); ?>
			<h2 class="h2" id="process-title"><?php echo esc_html( $process['title'] ); ?></h2>
		</div>
		<ol class="process" data-process>
			<?php foreach ( $process['steps'] as $i => $step ) : ?>
				<li class="process__step" data-reveal data-delay="<?php echo esc_attr( ( $i * 0.1 ) . 's' ); ?>">
					<span class="process__num"><?php echo esc_html( $i + 1 ); ?></span>
					<h3><?php echo esc_html( $step[0] ); ?></h3>
					<p><?php echo esc_html( $step[1] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
