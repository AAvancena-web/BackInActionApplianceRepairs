<?php
/**
 * Global header.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main">Skip to content</a>
<div class="scroll-progress" aria-hidden="true"><span></span></div>

<header class="site-header" data-header>
	<div class="topbar">
		<div class="container topbar__inner">
			<p class="topbar__tag"><?php echo bia_icon( 'pin' ); // phpcs:ignore ?><span>Washer, dryer and dishwasher repairs across <?php echo esc_html( bia_opt( 'bia_area' ) ); ?></span></p>
			<ul class="topbar__links">
				<li><span><?php echo bia_icon( 'clock' ); // phpcs:ignore ?><?php echo esc_html( bia_opt( 'bia_hours' ) ); ?></span></li>
				<li><a href="mailto:<?php echo esc_attr( bia_email() ); ?>"><?php echo bia_icon( 'mail' ); // phpcs:ignore ?><span><?php echo esc_html( bia_email() ); ?></span></a></li>
			</ul>
		</div>
	</div>

	<div class="container header-main">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Back In Action Appliance Repairs home">
			<?php
			if ( has_custom_logo() ) {
				echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'medium', false, array( 'class' => 'brand__logo', 'alt' => 'Back In Action Appliance Repairs' ) );
			} else {
				printf( '<img class="brand__logo" src="%s" alt="Back In Action Appliance Repairs" width="318" height="124">', esc_url( bia_img( 'logo.svg' ) ) );
			}
			?>
		</a>

		<nav class="primary-nav" id="primary-nav" aria-label="Primary" data-nav>
			<div class="primary-nav__head">
				<img src="<?php echo esc_url( bia_img( 'logo.svg' ) ); ?>" alt="" width="159" height="62">
				<button class="nav-close" type="button" aria-label="Close menu" data-nav-close><?php echo bia_icon( 'close' ); // phpcs:ignore ?></button>
			</div>
			<?php bia_menu( 'primary', 'menu' ); ?>
			<div class="primary-nav__foot">
				<?php bia_button( 'Book a Repair', bia_book_url(), 'amber' ); ?>
				<a class="nav-contact" href="<?php echo esc_attr( bia_phone_href() ); ?>"><?php echo bia_icon( 'phone' ); // phpcs:ignore ?><span><?php echo esc_html( bia_phone() ); ?></span></a>
				<a class="nav-contact" href="mailto:<?php echo esc_attr( bia_email() ); ?>"><?php echo bia_icon( 'mail' ); // phpcs:ignore ?><span><?php echo esc_html( bia_email() ); ?></span></a>
			</div>
		</nav>

		<div class="header-actions">
			<a class="header-call" href="<?php echo esc_attr( bia_phone_href() ); ?>" aria-label="Call <?php echo esc_attr( bia_phone() ); ?>">
				<span class="call-circle"><?php echo bia_icon( 'phone' ); // phpcs:ignore ?></span>
				<span class="header-call__text"><small>Call for a repair</small><strong><?php echo esc_html( bia_phone() ); ?></strong></span>
			</a>
			<?php bia_button( 'Book a Repair', bia_book_url(), 'amber', 'arrow-right', 'data-cta="header"' ); ?>
			<button class="nav-toggle" type="button" aria-controls="primary-nav" aria-expanded="false" aria-label="Open menu" data-nav-toggle>
				<span></span><span></span><span></span>
			</button>
		</div>
	</div>
</header>
<div class="nav-overlay" data-nav-close aria-hidden="true"></div>

<main id="main" class="site-main">
