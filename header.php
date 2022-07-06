<?php
/**
 * WordPress template file
 *
 * @package ftek\theme
 */

namespace Ftek\Theme;

$slideshow_images = json_decode( Options::get( 'slideshow_images' ), true );
$navbar_items     = get_nav_menu_items_by_location( 'main-navbar' );

?>

<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php wp_head(); ?>
	</head>
	<body class="bg-white min-h-screen flex flex-col" <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<header class="container mx-auto p-2 flex items-center">
			<?php if ( has_custom_logo() ) : ?>
				<a class="shrink-0 mr-10" href="<?php echo esc_attr( home_url() ); ?>">
					<img class="h-16" src="<?php echo esc_attr( wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'medium' ) ); ?>" />
				</a>
			<?php endif; ?>
			<?php if ( $navbar_items ) : ?>
				<nav class="hidden md:block overflow-hidden">
					<ul class="inline-flex justify-center">
						<?php foreach ( $navbar_items as $item ) : ?>
							<li class="p-2">
								<a class="no-underline text-black" href="<?php echo esc_attr( $item->url ); ?>"><?php echo esc_attr( $item->title ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
			<?php endif; ?>
			<nav class="flex flex-grow justify-end items-center">
				<?php ( ! is_search() ) && get_search_form(); ?>
				<?php if ( ! is_user_logged_in() ) : ?>
					<a class="border hover:brightness-100 border-gray-200 hover:bg-gray-200 rounded-md ml-2 p-2 shrink-0 no-underline text-black" href="<?php echo esc_attr( wp_login_url() ); ?>">
						<span><?php esc_html_e( 'Sign in', 'ftek-theme' ); ?></span>
					</a>
				<?php endif; ?>
			</nav>
		</header>
		<?php if ( $slideshow_images ) : ?>
			<div class="h-[40vh] min-h-36">
				<?php foreach ( $slideshow_images as $img ) : ?>
					<div class="relative h-full">
						<?php
						$full_path            = wp_get_original_image_path( $img['id'] );
						$basename             = basename( $full_path );
						$placeholder_basename = basename( wp_get_attachment_image_url( $img['id'], 'ftek-theme-placeholder-size' ) );
						$placeholder_path     = str_replace( $basename, $placeholder_basename, $full_path );
						// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
						$data      = file_get_contents( $placeholder_path );
						$finfo     = new \finfo( FILEINFO_MIME_TYPE );
						$mime_type = $finfo->buffer( $data );
						?>
						<div class="overflow-hidden z-10 w-full h-full bg-gray-400">
							<img class="object-cover w-full h-full blur-lg" src="data:<?php echo esc_attr( $mime_type ); ?>;charset=utf-8;base64,<?php echo esc_attr( base64_encode( $data ) ); ?>" /> <?php // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode ?>
						</div>
						<img class="object-cover w-full h-full absolute top-0 left-0" src="<?php echo esc_attr( $img['url'] ); ?>" />
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<section class="flex-grow container mx-auto p-2 pb-10">
			<main id="main" role="main">
