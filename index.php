<?php
/**
 * WordPress template file
 *
 * @package ftek\theme
 */

namespace Ftek\Theme;

get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header>
				<?php if ( is_singular() ) : ?>
					<h1><?php the_title(); ?></h1>
				<?php else : ?>
					<h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
				<?php endif; ?>
			</header>
			<?php the_content(); ?>
		</article>
		<?php
	}
} else {
	?>
	<section>
		<header>
			<?php if ( is_search() ) : ?>
				<h1>
					<?php
					printf(
						/* translators: %s: search term. */
						esc_html__( 'Results for "%s"', 'ftek-theme' ),
						'<span>' . esc_html( get_search_query() ) . '</span>'
					);
					?>
				</h1>
			<?php else : ?>
				<h1><?php esc_html_e( 'Nothing here', 'ftek-theme' ); ?></h1>
			<?php endif; ?>
		</header>
		<?php if ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ftek-theme' ); ?></p>
		<?php else : ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ftek-theme' ); ?></p>
		<?php endif; ?>
		<?php get_search_form(); ?>
	</section>
	<?php
}

get_footer();
