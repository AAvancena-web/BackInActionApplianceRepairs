<?php
/**
 * Fallback template (posts, archives, search).
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part(
	'template-parts/page-hero',
	null,
	array( 'title' => is_singular() ? get_the_title() : ( is_search() ? 'Search results' : ( is_archive() ? wp_strip_all_tags( get_the_archive_title() ) : 'News and tips' ) ) )
);
?>
<section class="section">
	<div class="container container--narrow">
		<?php if ( have_posts() ) : ?>
			<?php if ( is_singular() ) : ?>
				<?php
				while ( have_posts() ) :
					the_post();
					echo '<div class="entry-content">';
					the_content();
					echo '</div>';
				endwhile;
				?>
			<?php else : ?>
				<div class="post-list">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<a class="post-card" href="<?php the_permalink(); ?>">
							<span class="post-card__date"><?php echo esc_html( get_the_date() ); ?></span>
							<h2 class="h3"><?php the_title(); ?></h2>
							<p><?php echo esc_html( get_the_excerpt() ); ?></p>
							<span class="text-link">Read more <?php echo bia_icon( 'arrow-right' ); // phpcs:ignore ?></span>
						</a>
					<?php endwhile; ?>
				</div>
				<?php the_posts_pagination(); ?>
			<?php endif; ?>
		<?php else : ?>
			<p>Nothing found here yet.</p>
		<?php endif; ?>
	</div>
</section>
<?php
get_template_part( 'template-parts/cta-band' );
get_footer();
