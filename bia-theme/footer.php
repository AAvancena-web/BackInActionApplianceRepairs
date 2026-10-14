<?php
/**
 * Global footer. Includes the pre-footer contact section (details, map, booking form).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

if ( bia_show_prefooter_contact() ) {
	get_template_part( 'template-parts/contact-section' );
}
?>
</main>

<footer class="site-footer">
	<div class="container footer-main">
		<div class="footer-brand">
			<a class="brand brand--footer" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Back In Action Appliance Repairs home">
				<img class="brand__logo" src="<?php echo esc_url( bia_img( 'logo-reverse.svg' ) ); ?>" alt="Back In Action Appliance Repairs" width="318" height="124">
			</a>
			<p><?php echo bia_rich( bia_section( 'footer' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
			<?php
			$socials = array_filter(
				array(
					'facebook'  => bia_opt( 'bia_facebook' ),
					'instagram' => bia_opt( 'bia_instagram' ),
					'google'    => bia_opt( 'bia_google' ),
				)
			);
			if ( $socials ) :
				?>
				<ul class="socials">
					<?php foreach ( $socials as $network => $url ) : ?>
						<li><a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( ucfirst( $network ) ); ?>"><?php echo bia_icon( $network ); // phpcs:ignore ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<div class="footer-col">
			<h2 class="footer-title">Repairs</h2>
			<ul class="footer-links">
				<?php foreach ( bia_services() as $slug => $service ) : ?>
					<li><a href="<?php echo esc_url( bia_url( $slug ) ); ?>"><?php echo esc_html( $service['title'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="footer-col">
			<h2 class="footer-title">Company</h2>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				bia_menu( 'footer', 'footer-links' );
			} else {
				?>
				<ul class="footer-links">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
					<li><a href="<?php echo esc_url( bia_url( bia_about_slug() ) ); ?>">About</a></li>
					<li><a href="<?php echo esc_url( bia_url( 'contact' ) ); ?>">Contact</a></li>
					<li><a href="<?php echo esc_url( bia_book_url() ); ?>">Book a Repair</a></li>
				</ul>
				<?php
			}
			?>
		</div>

		<div class="footer-col footer-col--contact">
			<h2 class="footer-title">Get in Touch</h2>
			<ul class="footer-contact">
				<li><a href="<?php echo esc_attr( bia_phone_href() ); ?>"><?php echo bia_icon( 'phone' ); // phpcs:ignore ?><span><?php echo esc_html( bia_phone() ); ?></span></a></li>
				<li><a href="mailto:<?php echo esc_attr( bia_email() ); ?>"><?php echo bia_icon( 'mail' ); // phpcs:ignore ?><span><?php echo esc_html( bia_email() ); ?></span></a></li>
				<li><span class="footer-contact__static"><?php echo bia_icon( 'pin' ); // phpcs:ignore ?><span><?php echo esc_html( bia_opt( 'bia_area' ) ); ?></span></span></li>
				<li><span class="footer-contact__static"><?php echo bia_icon( 'clock' ); // phpcs:ignore ?><span><?php echo esc_html( bia_opt( 'bia_hours' ) ); ?></span></span></li>
			</ul>
		</div>
	</div>

	<div class="footer-bottom">
		<div class="container footer-bottom__inner">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Back In Action Appliance Repairs. All rights reserved.<?php echo bia_opt( 'bia_abn' ) ? ' ABN ' . esc_html( bia_opt( 'bia_abn' ) ) : ''; ?></p>
			<p class="footer-bottom__tag">Washing Machines <i>|</i> Dryers <i>|</i> Dishwashers</p>
		</div>
	</div>
</footer>

<a class="mobile-call" href="<?php echo esc_attr( bia_phone_href() ); ?>" data-mobile-call>
	<span class="mobile-call__icon"><?php echo bia_icon( 'phone' ); // phpcs:ignore ?></span>
	<span>Call now</span>
</a>

<button class="to-top" type="button" aria-label="Scroll to top" data-to-top>
	<svg class="to-top__ring" viewBox="0 0 48 48" aria-hidden="true"><circle cx="24" cy="24" r="22"></circle></svg>
	<?php echo bia_icon( 'arrow-up' ); // phpcs:ignore ?>
</button>

<?php wp_footer(); ?>
</body>
</html>
