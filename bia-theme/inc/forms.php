<?php
/**
 * Built-in lead forms (booking and contact) with email delivery.
 *
 * Each form can be swapped for a plugin shortcode in Customizer > Back In Action Settings > Forms.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

/**
 * Render a form.
 *
 * @param string $type booking|contact.
 * @param array  $args Options: submit (label), compact (bool), service (preselect slug).
 */
function bia_form( $type = 'booking', $args = array() ) {
	static $instance = 0;
	$instance++;

	$args = wp_parse_args(
		$args,
		array(
			'submit'  => 'booking' === $type ? 'Book my repair' : 'Send message',
			'compact' => false,
			'service' => '',
		)
	);

	$shortcode = bia_opt( 'bia_' . $type . '_shortcode' );
	if ( $shortcode ) {
		echo '<div class="bia-form-plugin">' . do_shortcode( $shortcode ) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput
		return;
	}

	$form_id = 'bia-form-' . $type . '-' . $instance;
	$status  = isset( $_GET['bia_form'] ) ? sanitize_key( wp_unslash( $_GET['bia_form'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	$which   = isset( $_GET['bia_id'] ) ? sanitize_key( wp_unslash( $_GET['bia_id'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	$half    = $args['compact'] ? '' : ' field--half';
	?>
	<form id="<?php echo esc_attr( $form_id ); ?>" class="bia-form bia-form--<?php echo esc_attr( $type ); ?><?php echo $args['compact'] ? ' is-compact' : ''; ?>" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate>
		<?php if ( $which === $form_id && 'sent' === $status ) : ?>
			<div class="form-notice form-notice--success" role="status"><?php echo bia_icon( 'check-circle' ); // phpcs:ignore ?> <span>Thanks, we have your details. We will call you shortly to lock in a time.</span></div>
		<?php elseif ( $which === $form_id && 'error' === $status ) : ?>
			<div class="form-notice form-notice--error" role="alert"><span>Sorry, something went wrong. Please check the required fields or call us on <a href="<?php echo esc_attr( bia_phone_href() ); ?>"><?php echo esc_html( bia_phone() ); ?></a>.</span></div>
		<?php endif; ?>

		<input type="hidden" name="action" value="bia_form">
		<input type="hidden" name="bia_type" value="<?php echo esc_attr( $type ); ?>">
		<input type="hidden" name="bia_id" value="<?php echo esc_attr( $form_id ); ?>">
		<input type="hidden" name="bia_ref" value="<?php echo esc_url( home_url( add_query_arg( array() ) ) ); ?>">
		<?php wp_nonce_field( 'bia_form_submit', 'bia_nonce' ); ?>
		<div class="hp-field" aria-hidden="true"><label>Leave this empty <input type="text" name="bia_website" tabindex="-1" autocomplete="off"></label></div>

		<div class="form-grid">
			<div class="field<?php echo esc_attr( $half ); ?>">
				<label for="<?php echo esc_attr( $form_id ); ?>-name">Name <span class="req">*</span></label>
				<input id="<?php echo esc_attr( $form_id ); ?>-name" type="text" name="bia_name" autocomplete="name" required placeholder="Your name">
			</div>
			<div class="field<?php echo esc_attr( $half ); ?>">
				<label for="<?php echo esc_attr( $form_id ); ?>-phone">Phone <span class="req">*</span></label>
				<input id="<?php echo esc_attr( $form_id ); ?>-phone" type="tel" name="bia_phone" autocomplete="tel" required placeholder="04xx xxx xxx">
			</div>
			<div class="field<?php echo esc_attr( $half ); ?>">
				<label for="<?php echo esc_attr( $form_id ); ?>-email">Email <span class="req">*</span></label>
				<input id="<?php echo esc_attr( $form_id ); ?>-email" type="email" name="bia_email" autocomplete="email" required placeholder="you@email.com">
			</div>
			<div class="field<?php echo esc_attr( $half ); ?>">
				<label for="<?php echo esc_attr( $form_id ); ?>-suburb">Suburb<?php echo 'booking' === $type ? ' <span class="req">*</span>' : ''; ?></label>
				<input id="<?php echo esc_attr( $form_id ); ?>-suburb" type="text" name="bia_suburb" autocomplete="address-level2" <?php echo 'booking' === $type ? 'required' : ''; ?> placeholder="e.g. Coburg">
			</div>

			<?php if ( 'booking' === $type ) : ?>
				<div class="field<?php echo esc_attr( $half ); ?>">
					<label for="<?php echo esc_attr( $form_id ); ?>-service">Appliance <span class="req">*</span></label>
					<div class="select-wrap">
						<select id="<?php echo esc_attr( $form_id ); ?>-service" name="bia_service" required data-service-select>
							<option value="">Select an appliance</option>
							<?php foreach ( bia_services() as $slug => $service ) : ?>
								<option value="<?php echo esc_attr( $service['title'] ); ?>" data-slug="<?php echo esc_attr( $slug ); ?>" <?php selected( $args['service'], $slug ); ?>><?php echo esc_html( $service['short'] ); ?></option>
							<?php endforeach; ?>
							<option value="More than one appliance" data-slug="multiple">More than one</option>
						</select>
					</div>
				</div>
				<div class="field<?php echo esc_attr( $half ); ?>">
					<label for="<?php echo esc_attr( $form_id ); ?>-brand">Brand</label>
					<input id="<?php echo esc_attr( $form_id ); ?>-brand" type="text" name="bia_brand" placeholder="e.g. Bosch" list="bia-brands">
				</div>
			<?php endif; ?>

			<div class="field field--full">
				<label for="<?php echo esc_attr( $form_id ); ?>-message"><?php echo 'booking' === $type ? 'What is it doing?' : 'Message'; ?></label>
				<textarea id="<?php echo esc_attr( $form_id ); ?>-message" name="bia_message" rows="<?php echo $args['compact'] ? 2 : 4; ?>" placeholder="<?php echo esc_attr( 'booking' === $type ? 'e.g. Front loader will not drain, error code E21' : 'How can we help?' ); ?>"></textarea>
			</div>
		</div>

		<button type="submit" class="btn btn--amber btn--block btn--lg">
			<span><?php echo esc_html( $args['submit'] ); ?></span><?php echo bia_icon( 'arrow-right' ); // phpcs:ignore ?>
		</button>
		<p class="form-foot"><?php echo bia_icon( 'lock' ); // phpcs:ignore ?> <span><?php echo 'booking' === $type ? 'No obligation. We call you back to confirm a time.' : 'We reply fast. Your details stay private.'; ?></span></p>
	</form>
	<?php
	static $datalist = false;
	if ( ! $datalist && 'booking' === $type ) {
		$datalist = true;
		echo '<datalist id="bia-brands">';
		foreach ( bia_brands() as $brand ) {
			echo '<option value="' . esc_attr( $brand ) . '">';
		}
		echo '</datalist>';
	}
}

/**
 * Handle submissions.
 */
add_action( 'admin_post_nopriv_bia_form', 'bia_handle_form' );
add_action( 'admin_post_bia_form', 'bia_handle_form' );
function bia_handle_form() {
	$ref     = isset( $_POST['bia_ref'] ) ? esc_url_raw( wp_unslash( $_POST['bia_ref'] ) ) : home_url( '/' );
	$form_id = isset( $_POST['bia_id'] ) ? sanitize_key( wp_unslash( $_POST['bia_id'] ) ) : '';
	$ref     = remove_query_arg( array( 'bia_form', 'bia_id' ), $ref );
	$ref     = wp_validate_redirect( $ref, home_url( '/' ) );

	$back = function ( $status ) use ( $ref, $form_id ) {
		wp_safe_redirect( add_query_arg( array( 'bia_form' => $status, 'bia_id' => $form_id ), $ref ) . '#' . $form_id );
		exit;
	};

	if ( ! isset( $_POST['bia_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['bia_nonce'] ) ), 'bia_form_submit' ) ) {
		$back( 'error' );
	}

	// Honeypot: silently accept bots without sending.
	if ( ! empty( $_POST['bia_website'] ) ) {
		$back( 'sent' );
	}

	$type   = isset( $_POST['bia_type'] ) && 'booking' === $_POST['bia_type'] ? 'booking' : 'contact';
	$fields = array(
		'Name'      => 'bia_name',
		'Phone'     => 'bia_phone',
		'Email'     => 'bia_email',
		'Suburb'    => 'bia_suburb',
		'Appliance' => 'bia_service',
		'Brand'     => 'bia_brand',
		'Message'   => 'bia_message',
	);

	$data = array();
	foreach ( $fields as $label => $key ) {
		if ( isset( $_POST[ $key ] ) && '' !== $_POST[ $key ] ) {
			$data[ $label ] = 'bia_message' === $key ? sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) : sanitize_text_field( wp_unslash( $_POST[ $key ] ) );
		}
	}

	if ( empty( $data['Name'] ) || empty( $data['Phone'] ) || empty( $data['Email'] ) || ! is_email( $data['Email'] ) ) {
		$back( 'error' );
	}
	if ( 'booking' === $type && ( empty( $data['Suburb'] ) || empty( $data['Appliance'] ) ) ) {
		$back( 'error' );
	}

	$subject = sprintf( '[%s] %s from %s', get_bloginfo( 'name' ), 'booking' === $type ? 'Repair booking request' : 'Contact enquiry', $data['Name'] );

	$body = '';
	foreach ( $data as $label => $value ) {
		$body .= $label . ': ' . $value . "\n";
	}
	$body .= "\nSubmitted from: " . $ref . "\n";

	$to      = bia_opt( 'bia_form_recipient' ) ? bia_opt( 'bia_form_recipient' ) : get_option( 'admin_email' );
	$headers = array( 'Reply-To: ' . $data['Name'] . ' <' . $data['Email'] . '>' );

	/**
	 * Fires before a form email is sent. Use to push leads to a CRM.
	 */
	do_action( 'bia_form_submitted', $type, $data );

	wp_mail( $to, $subject, $body, $headers );

	$back( 'sent' );
}
