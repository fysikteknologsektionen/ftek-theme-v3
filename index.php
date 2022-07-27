<?php
/**
 * WordPress template file
 *
 * @package ftek\theme
 */

namespace Ftek\Theme;

?>

<?php get_header(); ?>
<?php if ( is_search() ) : ?>
	<section class="flex flex-col items-center">
		<header>
			<h1>
				<?php
				printf(
					/* translators: %1$s: search term. */
					esc_html__( 'Results for "%1$s"', 'ftek-theme' ),
					'<span>' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
		</header>
		<div class="w-[60rem] grow-0 max-w-full mb-4">
			<?php get_search_form(); ?>
		</div>
	</section>
<?php endif; ?>
<?php if ( have_posts() ) : ?>
	<?php for ( $i = 0; have_posts(); $i++ ) : // phpcs:ignore Generic.CodeAnalysis.ForLoopWithTestFunctionCall.NotAllowed ?>
		<?php the_post(); ?>
		<?php if ( $i > 0 ) : ?>
			<hr class="w-4/5 mx-auto mb-4 mt-4" />
		<?php endif; ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header>
				<?php if ( is_singular() ) : ?>
					<?php
					$thumbnail_id = false;
					$current_id   = get_the_ID();
					for ( $j = 0; $j < 10 && $current_id; $j++ ) {
						if ( has_post_thumbnail( $current_id ) ) {
							$thumbnail_id = get_post_thumbnail_id( $current_id );
							break;
						}
						$current_id = wp_get_post_parent_id( $current_id );
					}
					?>
					<div class="relative overflow-hidden mb-4">
						<div class="flex items-center justify-center <?php echo $thumbnail_id ? 'min-h-[min(50vw,40vh)]' : ''; ?>">
							<h1 class="lg:text-6xl <?php echo $thumbnail_id ? 'text-white text-shadow-lg' : ''; ?>"><?php the_title(); ?></h1>
						</div>
						<?php if ( $thumbnail_id ) : ?>
							<div class="-z-10 top-0 absolute h-full w-full">
								<?php get_template_part( 'template-parts/image', null, array( 'id' => $thumbnail_id ) ); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php elseif ( ! empty( get_the_title() ) ) : ?>
					<div class="container mx-auto pl-2 pr-2">
						<h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
					</div>
				<?php endif; ?>
			</header>
			<div class="[&>*]:container [&>*]:mx-auto [&>*:not(ol,ul)]:pl-2 [&>*]:pr-2">
				<?php if ( is_singular() ) : ?>
					<?php the_content(); ?>
				<?php else : ?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</div>
		</article>
	<?php endfor; ?>
<?php else : ?>
	<div class="container mx-auto pl-2 pr-2">
		<section>
			<div class="flex flex-col items-center">
				<?php if ( is_search() ) : ?>
					<span><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ftek-theme' ); ?></span>
				<?php else : ?>
					<header>
						<h1><?php esc_html_e( 'Nothing here', 'ftek-theme' ); ?></h1>
					</header>
					<div class="w-[60rem] grow-0 max-w-full mb-4">
						<?php get_search_form(); ?>
					</div>
					<span><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'ftek-theme' ); ?></span>
				<?php endif; ?>
			<div>
		</section>
	</div>
<?php endif; ?>
<?php get_footer(); ?>
