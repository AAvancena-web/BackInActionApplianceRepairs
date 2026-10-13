<?php
/**
 * Homepage (landing page layout).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="hero" aria-labelledby="hero-title">
	<div class="hero__bg" aria-hidden="true">
		<span class="hero__ring" data-parallax="0.06"></span>
		<span class="hero__dots"></span>
	</div>
	<div class="container hero__inner">
		<div class="hero__copy">
			<?php bia_eyebrow( 'Melbourne appliance repairs', 'eyebrow--light' ); ?>
			<h1 class="hero__title" id="hero-title">Washer, dryer or dishwasher broken? We will get it <span class="hl">back in action.</span></h1>
			<p class="lead">Fast, honest repairs in your home across <?php echo esc_html( bia_opt( 'bia_area' ) ); ?>. We find the fault, give you a fixed price before any work starts and fix most appliances on the first visit.</p>
			<div class="btn-row">
				<?php bia_call_button( 'amber' ); ?>
				<?php bia_button( 'Book online', '#hero-form', 'white' ); ?>
			</div>
			<ul class="hero-appliances" aria-label="Appliances we repair">
				<?php foreach ( bia_services() as $slug => $service ) : ?>
					<li><a href="<?php echo esc_url( bia_url( $slug ) ); ?>"><?php echo bia_icon( $service['icon'] ); // phpcs:ignore ?><span><?php echo esc_html( $service['short'] ); ?></span></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="hero-form" id="hero-form">
			<span class="hero-form__tag"><?php echo bia_icon( 'bolt' ); // phpcs:ignore ?> Same and next day bookings</span>
			<h2 class="hero-form__title">Book a repair</h2>
			<p class="hero-form__sub">Takes 30 seconds. We call you back to confirm a time.</p>
			<?php bia_form( 'booking', array( 'compact' => true ) ); ?>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/trust-strip' ); ?>

<section class="section services-section" aria-labelledby="services-title">
	<div class="container">
		<div class="section-head section-head--split" data-reveal>
			<div>
				<?php bia_eyebrow( 'What we repair' ); ?>
				<h2 class="h2" id="services-title">Three appliances. One specialist.</h2>
			</div>
			<p>We only repair washing machines, dryers and dishwashers. That focus means we know them inside out, carry the right parts and get most jobs done in one visit.</p>
		</div>
		<?php get_template_part( 'template-parts/service-cards' ); ?>
	</div>
</section>

<section class="section intro-section" aria-labelledby="intro-title">
	<div class="container intro-grid">
		<div class="intro-art" data-reveal>
			<?php echo bia_hero_art(); // phpcs:ignore ?>
		</div>
		<div class="intro-copy" data-reveal data-delay=".1s">
			<?php bia_eyebrow( 'About Back In Action' ); ?>
			<h2 class="h2" id="intro-title">A new name with the trade in the family</h2>
			<p class="lead">Back In Action is a new Melbourne business built on years of family experience fixing household appliances.</p>
			<p>We grew up around washing machines in pieces on the workshop floor. Now we are bringing that know how to your laundry and kitchen, with modern booking, clear pricing and the kind of service that earns a call back next time.</p>
			<ul class="tick-list">
				<li><?php echo bia_icon( 'check' ); // phpcs:ignore ?>Upfront, fixed price quotes</li>
				<li><?php echo bia_icon( 'check' ); // phpcs:ignore ?>On time arrivals and clear communication</li>
				<li><?php echo bia_icon( 'check' ); // phpcs:ignore ?>Honest advice on repair or replace</li>
				<li><?php echo bia_icon( 'check' ); // phpcs:ignore ?>Every repair tested before we leave</li>
			</ul>
			<?php bia_button( 'More about us', bia_url( 'about' ), 'navy' ); ?>
		</div>
	</div>
</section>

<section class="section faults-section" aria-labelledby="faults-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( 'Common problems we fix' ); ?>
			<h2 class="h2" id="faults-title">Sound familiar?</h2>
			<p class="lead">If your appliance is doing any of these, we can help. Most faults are fixed on the spot.</p>
		</div>
		<div class="faults-grid">
			<?php $i = 0; foreach ( bia_services() as $slug => $service ) : ?>
				<div class="faults-col" data-reveal data-delay="<?php echo esc_attr( ( $i++ * 0.08 ) . 's' ); ?>">
					<div class="faults-col__head"><span class="faults-col__icon"><?php echo bia_icon( $service['icon'] ); // phpcs:ignore ?></span><h3><?php echo esc_html( $service['short'] ); ?></h3></div>
					<ul class="fault-list">
						<?php foreach ( $service['faults'] as $fault ) : ?>
							<li><?php echo bia_icon( 'check-circle' ); // phpcs:ignore ?><?php echo esc_html( $fault[0] ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="text-link" href="<?php echo esc_url( bia_url( $slug ) ); ?>"><?php echo esc_html( $service['title'] ); ?> <?php echo bia_icon( 'arrow-right' ); // phpcs:ignore ?></a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/process' ); ?>

<?php get_template_part( 'template-parts/brands' ); ?>

<section class="section reasons-section" aria-labelledby="reasons-title">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<?php bia_eyebrow( 'Why Back In Action', 'eyebrow--light' ); ?>
			<h2 class="h2" id="reasons-title">The repair service we would want at home</h2>
		</div>
		<div class="reason-grid">
			<?php foreach ( bia_reasons() as $i => $reason ) : ?>
				<div class="reason" data-reveal data-delay="<?php echo esc_attr( ( $i % 3 * 0.08 ) . 's' ); ?>">
					<span class="reason__icon"><?php echo bia_icon( $reason['icon'] ); // phpcs:ignore ?></span>
					<h3><?php echo esc_html( $reason['title'] ); ?></h3>
					<p><?php echo esc_html( $reason['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section areas-section" aria-labelledby="areas-title">
	<div class="container areas-grid">
		<div data-reveal>
			<?php bia_eyebrow( 'Service area' ); ?>
			<h2 class="h2" id="areas-title">Repairs across <?php echo esc_html( bia_opt( 'bia_area' ) ); ?></h2>
			<p>We come to you. Our technicians cover suburbs right across Melbourne, so wherever your laundry or kitchen is, help is not far away. Call with your suburb and we will confirm your booking window.</p>
			<?php bia_button( 'Check your suburb', bia_url( 'contact' ), 'navy' ); ?>
		</div>
		<ul class="area-chips" data-reveal data-delay=".1s">
			<?php foreach ( bia_areas() as $area ) : ?>
				<li><?php echo bia_icon( 'pin' ); // phpcs:ignore ?><?php echo esc_html( $area ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php get_template_part( 'template-parts/reviews' ); ?>

<?php get_template_part( 'template-parts/faq' ); ?>

<?php get_template_part( 'template-parts/cta-band' ); ?>

<?php
get_footer();
