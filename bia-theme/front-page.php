<?php
/**
 * Homepage (landing page layout).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

$home = bia_page( 'home' );
$hero = $home['hero'];

get_header();
?>

<section class="hero" aria-labelledby="hero-title">
	<div class="hero__bg" aria-hidden="true">
		<span class="hero__ring" data-parallax="0.06"></span>
		<span class="hero__dots"></span>
	</div>
	<div class="container hero__inner">
		<div class="hero__copy">
			<?php bia_eyebrow( $hero['eyebrow'], 'eyebrow--light' ); ?>
			<h1 class="hero__title" id="hero-title"><?php echo esc_html( $hero['title_before'] ); ?> <span class="hl"><?php echo esc_html( $hero['title_highlight'] ); ?></span> <span class="hero__title-small"><?php echo esc_html( $hero['title_after'] ); ?></span></h1>
			<p class="lead"><?php echo bia_rich( $hero['lead'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
			<div class="btn-row">
				<?php bia_call_button( 'amber' ); ?>
				<?php bia_button( $hero['secondary'], '#hero-form', 'white' ); ?>
			</div>
			<p class="hero-appliances__label"><?php echo esc_html( $hero['services_label'] ); ?></p>
			<ul class="hero-appliances" aria-label="<?php echo esc_attr( $hero['services_label'] ); ?>">
				<?php foreach ( bia_services() as $slug => $service ) : ?>
					<li><a href="<?php echo esc_url( bia_url( $slug ) ); ?>"><?php echo bia_icon( $service['icon'] ); // phpcs:ignore ?><span><?php echo esc_html( $service['title'] ); ?></span></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="hero-form" id="hero-form">
			<span class="hero-form__tag"><?php echo bia_icon( 'bolt' ); // phpcs:ignore ?> <?php echo esc_html( $hero['tag'] ); ?></span>
			<h2 class="hero-form__title"><?php echo esc_html( $home['form']['title'] ); ?></h2>
			<p class="hero-form__sub"><?php echo esc_html( $home['form']['sub'] ); ?></p>
			<?php
			bia_form(
				'booking',
				array(
					'compact'       => true,
					'model'         => ! empty( $home['form']['model'] ),
					'message_label' => $home['form']['message_label'],
					'support'       => $home['form']['support'],
				)
			);
			?>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/trust-strip' ); ?>

<section class="section services-section" aria-labelledby="services-title">
	<div class="container">
		<div class="section-head section-head--split" data-reveal>
			<div>
				<?php bia_eyebrow( $home['services']['eyebrow'] ); ?>
				<h2 class="h2" id="services-title"><?php echo esc_html( $home['services']['title'] ); ?></h2>
			</div>
			<p><?php echo bia_rich( $home['services']['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
		</div>
		<?php get_template_part( 'template-parts/service-cards', null, array( 'variant' => 'home', 'cta' => $home['services']['cta'] ) ); ?>
		<p class="services-note" data-reveal><?php echo bia_icon( 'van' ); // phpcs:ignore ?><span><?php echo esc_html( $home['services']['note'] ); ?></span></p>
	</div>
</section>

<section class="section intro-section" aria-labelledby="intro-title">
	<div class="container intro-grid">
		<div class="intro-art" data-reveal>
			<?php echo bia_hero_art(); // phpcs:ignore ?>
		</div>
		<div class="intro-copy" data-reveal data-delay=".1s">
			<?php bia_eyebrow( $home['intro']['eyebrow'] ); ?>
			<h2 class="h2" id="intro-title"><?php echo esc_html( $home['intro']['title'] ); ?></h2>
			<?php bia_paras( $home['intro']['paras'], 'lead' ); ?>
			<h3 class="intro-list-title"><?php echo esc_html( $home['intro']['list_title'] ); ?></h3>
			<ul class="tick-list">
				<?php foreach ( $home['intro']['list'] as $item ) : ?>
					<li><?php echo bia_icon( 'check' ); // phpcs:ignore ?><?php echo esc_html( $item ); ?></li>
				<?php endforeach; ?>
			</ul>
			<?php bia_button( $home['intro']['cta'], bia_url( bia_about_slug() ), 'navy' ); ?>
		</div>
	</div>
</section>

<section class="section faults-section" aria-labelledby="faults-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( $home['problems']['eyebrow'] ); ?>
			<h2 class="h2" id="faults-title"><?php echo esc_html( $home['problems']['title'] ); ?></h2>
			<p class="lead"><?php echo esc_html( $home['problems']['text'] ); ?></p>
		</div>
		<div class="faults-grid">
			<?php $i = 0; foreach ( bia_services() as $slug => $service ) : ?>
				<div class="faults-col" data-reveal data-delay="<?php echo esc_attr( ( $i++ * 0.08 ) . 's' ); ?>">
					<div class="faults-col__head"><span class="faults-col__icon"><?php echo bia_icon( $service['icon'] ); // phpcs:ignore ?></span><h3><?php echo esc_html( $service['problems_title'] ); ?></h3></div>
					<ul class="fault-list">
						<?php foreach ( $service['problems'] as $problem ) : ?>
							<li><?php echo bia_icon( 'check-circle' ); // phpcs:ignore ?><?php echo esc_html( $problem ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="text-link" href="<?php echo esc_url( bia_url( $slug ) ); ?>" aria-label="<?php echo esc_attr( $home['problems']['cta'] . ' about ' . $service['title'] ); ?>"><?php echo esc_html( $home['problems']['cta'] ); ?> <?php echo bia_icon( 'arrow-right' ); // phpcs:ignore ?></a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/process' ); ?>

<?php get_template_part( 'template-parts/brands' ); ?>

<?php get_template_part( 'template-parts/reasons' ); ?>

<?php get_template_part( 'template-parts/areas' ); ?>

<?php get_template_part( 'template-parts/reviews' ); ?>

<?php get_template_part( 'template-parts/faq' ); ?>

<?php get_template_part( 'template-parts/cta-band' ); ?>

<?php
get_footer();
