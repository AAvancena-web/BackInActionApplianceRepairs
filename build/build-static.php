<?php
/**
 * Render the theme to static HTML in docs/ (GitHub Pages preview).
 *
 * Usage: php build/build-static.php
 */

require __DIR__ . '/wp-stub.php';
require get_template_directory() . '/functions.php';
do_action( 'after_setup_theme' );

$root  = dirname( __DIR__ );
$out   = $root . '/docs';
$theme = get_template_directory();
$site  = 'Back In Action Appliance Repairs';

$pages = array(
	'index.html'                       => array( null, 'front-page.php' ),
	bia_about_slug() . '.html'         => array( new WP_Post( 2, bia_about_slug(), 'About' ), 'page-templates/template-about.php' ),
	'contact.html'                     => array( new WP_Post( 6, 'contact', 'Contact' ), 'page-templates/template-contact.php' ),
	'404.html'                         => array( null, '404.php' ),
);
$id = 3;
foreach ( bia_services() as $slug => $service ) {
	$pages[ $slug . '.html' ] = array( new WP_Post( $id++, $slug, $service['title'] ), 'page-templates/template-service.php' );
}

/**
 * Inline script for the preview only: forms show a success notice instead of posting.
 */
$preview_js = <<<'JS'
<script>
document.addEventListener('submit', function (e) {
	var form = e.target.closest('.bia-form');
	if (!form || e.defaultPrevented) return;
	e.preventDefault();
	var notice = document.createElement('div');
	notice.className = 'form-notice form-notice--success';
	notice.setAttribute('role', 'status');
	notice.textContent = 'Preview only: in WordPress this form emails the booking to the business.';
	form.insertBefore(notice, form.firstChild);
	var btn = form.querySelector('button[type="submit"]');
	if (btn) { btn.removeAttribute('disabled'); btn.querySelector('span').textContent = 'Sent'; }
});
</script>
JS;

@mkdir( $out, 0755, true );

foreach ( $pages as $file => $page ) {
	list( $post, $template ) = $page;
	$GLOBALS['bia_static']['page']    = $post;
	$GLOBALS['bia_static']['front']   = 'index.html' === $file;
	$GLOBALS['bia_static']['file']    = $file;
	$GLOBALS['bia_static']['styles']  = array();
	$GLOBALS['bia_static']['scripts'] = array();
	$GLOBALS['bia_static']['loop']    = true;
	do_action( 'wp_enqueue_scripts' );
	$GLOBALS['bia_static']['title'] = '404.html' === $file ? 'Page Not Found | ' . $site : bia_seo_title();

	ob_start();
	require $theme . '/' . $template;
	$html = ob_get_clean();

	$html = str_replace( './assets/', 'assets/', $html );
	$html = str_replace( '</body>', $preview_js . "\n</body>", $html );
	$html = str_replace( '<meta name="theme-color"', '<meta name="robots" content="noindex, nofollow">' . "\n" . '<meta name="theme-color"', $html );
	file_put_contents( $out . '/' . $file, $html );
	echo "Wrote docs/$file\n";
}

// Copy assets.
$copy = function ( $src, $dst ) use ( &$copy ) {
	@mkdir( $dst, 0755, true );
	foreach ( scandir( $src ) as $f ) {
		if ( '.' === $f || '..' === $f ) {
			continue;
		}
		is_dir( "$src/$f" ) ? $copy( "$src/$f", "$dst/$f" ) : copy( "$src/$f", "$dst/$f" );
	}
};
$copy( $theme . '/assets', $out . '/assets' );
touch( $out . '/.nojekyll' );
echo "Copied assets\n";
