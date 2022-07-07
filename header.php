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
		<header class="sticky top-0 relative z-10">
			<div class="relative bg-white shadow z-20">
				<div class="container mx-auto p-2 flex items-center flex-wrap">
					<?php if ( has_custom_logo() ) : ?>
						<a class="shrink-0 mr-10" href="<?php echo esc_attr( home_url() ); ?>">
							<img class="h-16" src="<?php echo esc_attr( wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'medium' ) ); ?>" />
						</a>
					<?php endif; ?>
					<?php if ( $navbar_items ) : ?>
						<nav class="hidden lg:block overflow-hidden">
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
						<?php if ( ! is_search() ) : ?>
							<div class="hidden sm:block">
								<?php get_search_form(); ?>
							</div>
						<?php endif; ?>
						<?php if ( ! is_user_logged_in() ) : ?>
							<a class="btn ml-2 shrink-0 h-11 pl-4 pr-4" href="<?php echo esc_attr( wp_login_url() ); ?>">
								<span><?php esc_html_e( 'Sign in', 'ftek-theme' ); ?></span>
							</a>
						<?php endif; ?>
						<?php if ( $navbar_items ) : ?>
							<button class="btn shrink-0 aspect-square w-11 ml-2 lg:hidden" onclick="document.getElementById('ftek-theme-dropdown').toggleAttribute('closed'); this.toggleAttribute('active');">☰</button>
						<?php endif; ?>
					</nav>
				</div>
			</div>
			<?php if ( $navbar_items ) : ?>
				<nav id="ftek-theme-dropdown" class="bg-white lg:hidden relative shadow-md [&[closed]]:-translate-y-[calc(100%+10px)] -mb-[calc(100%+10px)] transition-transform" closed>
					<ul>
						<?php foreach ( $navbar_items as $item ) : ?>
							<li class="p-2">
								<a class="no-underline text-black" href="<?php echo esc_attr( $item->url ); ?>"><?php echo esc_attr( $item->title ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
			<?php endif; ?>
		</header>
		<?php if ( is_front_page() && $slideshow_images ) : ?>
			<div class="relative overflow-hidden">
				<div class="flex items-center">
					<?php if ( count( $slideshow_images ) > 1 ) : ?>
						<button id="ftek-theme-slideshow-left" class="opacity-50 enabled:hover:opacity-100 transition-opacity text-white text-shadow-2xl text-2xl enabled:cursor-pointer enabled:hover:scale-110 transition-transform p-2">❮</button>
					<?php endif; ?>
					<div class="grow flex flex-col items-center justify-center min-w-0">
						<?php if ( count( $slideshow_images ) > 1 ) : ?>
							<div class="m-1 opacity-50 hover:opacity-100 transition-opacity invisible">
								<?php foreach ( $slideshow_images as $i => $img ) : ?>
									<button class="p-1 text-shadow-lg text-sm <?php echo 0 === $i ? 'text-red-700' : 'text-white'; ?> cursor-pointer hover:scale-110 transition">⬤</button>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<div class="text-center text-white text-shadow-md mt-[10vh] invisible"><?php bloginfo( 'description' ); ?></div>
						<h1 class="max-w-full bg-red-700/50 p-4 text-white font-bold m-0 mb-2 mt-2 lg:text-6xl"><?php bloginfo( 'name' ); ?></h1>
						<div class="text-center text-white text-shadow-md mb-[10vh]"><?php bloginfo( 'description' ); ?></div>
						<?php if ( count( $slideshow_images ) > 1 ) : ?>
							<div class="m-1 opacity-50 hover:opacity-100 transition-opacity">
								<?php foreach ( $slideshow_images as $i => $img ) : ?>
									<button class="ftek-theme-slideshow-indicator p-1 text-shadow-lg text-sm <?php echo 0 === $i ? 'text-red-700' : 'text-white'; ?> cursor-pointer hover:scale-110 transition">⬤</button>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
					<?php if ( count( $slideshow_images ) > 1 ) : ?>
						<button id="ftek-theme-slideshow-right" class="opacity-50 enabled:hover:opacity-100 transition-opacity text-white text-shadow-2xl text-2xl enabled:cursor-pointer enabled:hover:scale-110 transition-transform p-2">❯</button>
					<?php endif; ?>
				</div>
				<div id="ftek-theme-slideshow-frame" class="-z-10 top-0 absolute h-full w-full flex transition-[left] duration-500">
					<?php foreach ( $slideshow_images as $img ) : ?>
						<div class="shrink-0 relative h-full w-full inline-block">
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
							<img class="object-cover w-full h-full absolute top-0 left-0 opacity-0 transition-opacity" src="<?php echo esc_attr( $img['url'] ); ?>" onload="this.style.opacity = 1" />
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
		<section class="flex-grow container mx-auto p-2 pb-10">
			<main id="main" role="main">
