<?php
/**
 * WordPress template file
 *
 * @package ftek\theme
 */

namespace Ftek\Theme;

?>

<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header>
				<?php if ( is_singular() && has_post_thumbnail() ) : ?>
					<div class="h-[min(50vw,40vh)]">
						<?php get_template_part( 'template-parts/image', null, array( 'id' => get_post_thumbnail_id() ) ); ?>
					</div>
				<?php endif; ?>
				<div class="container mx-auto pl-2 pr-2">
					<?php if ( is_singular() ) : ?>
						<h1><?php the_title(); ?></h1>
					<?php else : ?>
						<h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
					<?php endif; ?>
				</div>
			</header>
			<div class="[&>*]:container [&>*]:mx-auto [&>*]:pl-2 [&>*]:pr-2">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
<?php else : ?>
	<div class="container mx-auto pl-2 pr-2">
		<section>
			<div class="flex flex-col items-center">
				<div class="w-[60rem] grow-0 max-w-full mb-4 mt-4">
					<?php get_search_form(); ?>
				</div>
				<header>
					<h1>
						<?php if ( is_search() ) : ?>
							<?php
							printf(
								/* translators: %s: search term. */
								esc_html__( 'Results for "%s"', 'ftek-theme' ),
								'<span>' . esc_html( get_search_query() ) . '</span>'
							);
							?>
						<?php else : ?>
							<?php esc_html_e( 'Nothing here', 'ftek-theme' ); ?>
						<?php endif; ?>
					</h1>
				</header>
					<?php if ( is_search() ) : ?>
					<span><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ftek-theme' ); ?></span>
				<?php else : ?>
					<span><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'ftek-theme' ); ?></span>
				<?php endif; ?>
			<div>
		</section>
	</div>
<?php endif; ?>
<?php get_footer(); ?>
