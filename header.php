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
		<header class="relative z-10">
			<div class="relative bg-white shadow z-20">
				<div class="container mx-auto p-2 flex items-center flex-wrap">
					<?php if ( has_custom_logo() ) : ?>
						<a class="shrink-0 mr-10" href="<?php echo esc_attr( home_url() ); ?>">
							<img class="h-16" src="<?php echo esc_attr( wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'medium' ) ); ?>" />
						</a>
					<?php endif; ?>
					<?php if ( $navbar_items ) : ?>
						<nav class="hidden lg:block overflow-hidden">
							<ul class="inline-flex justify-center list-none m-0">
								<?php foreach ( $navbar_items as $item ) : ?>
									<li class="p-2">
										<a class="no-underline text-black" href="<?php echo esc_attr( $item->url ); ?>"><?php echo esc_attr( $item->title ); ?></a>
									</li>
								<?php endforeach; ?>
							</ul>
						</nav>
					<?php endif; ?>
					<nav class="flex flex-grow justify-end items-center">
						<?php if ( ! is_search() && have_posts() ) : ?>
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
							<button class="shrink-0 aspect-square w-11 ml-2 lg:hidden" onclick="document.getElementById('ftek-theme-dropdown').toggleAttribute('closed'); this.toggleAttribute('active');">☰</button>
						<?php endif; ?>
					</nav>
				</div>
			</div>
			<?php if ( $navbar_items ) : ?>
				<nav id="ftek-theme-dropdown" class="bg-white lg:hidden w-full absolute shadow-md [&[closed]]:-translate-y-[calc(100%+10px)] transition-transform" closed>
					<ul class="container mx-auto list-none m-0">
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
						<button id="ftek-theme-slideshow-left" class="no-btn opacity-50 enabled:hover:opacity-100 text-white text-shadow-2xl text-2xl enabled:cursor-pointer enabled:hover:scale-110 transition-transform p-2">❮</button>
					<?php endif; ?>
					<div class="grow flex flex-col items-center justify-center min-w-0">
						<?php if ( count( $slideshow_images ) > 1 ) : ?>
							<div class="m-1 opacity-50 hover:opacity-100 transition-opacity invisible">
								<?php foreach ( $slideshow_images as $i => $img ) : ?>
									<button class="no-btn p-1 text-shadow-lg text-sm <?php echo 0 === $i ? 'text-red-700' : 'text-white'; ?> cursor-pointer hover:scale-110 transition">⬤</button>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<div class="text-center text-white text-shadow-md mt-[10vh] invisible"><?php bloginfo( 'description' ); ?></div>
						<h1 class="font-sans max-w-full bg-red-700/50 p-4 text-white font-bold m-0 mb-2 mt-2 lg:text-6xl"><?php bloginfo( 'name' ); ?></h1>
						<div class="text-center text-white text-shadow-md mb-[10vh]"><?php bloginfo( 'description' ); ?></div>
						<?php if ( count( $slideshow_images ) > 1 ) : ?>
							<div class="m-1 opacity-50 hover:opacity-100 transition-opacity">
								<?php foreach ( $slideshow_images as $i => $img ) : ?>
									<button class="ftek-theme-slideshow-indicator no-btn p-1 text-shadow-lg text-sm <?php echo 0 === $i ? 'text-red-700' : 'text-white'; ?> cursor-pointer hover:scale-110 transition">⬤</button>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
					<?php if ( count( $slideshow_images ) > 1 ) : ?>
						<button id="ftek-theme-slideshow-right" class="no-btn opacity-50 enabled:hover:opacity-100 text-white text-shadow-2xl text-2xl enabled:cursor-pointer enabled:hover:scale-110 transition-transform p-2">❯</button>
					<?php endif; ?>
				</div>
				<div id="ftek-theme-slideshow-frame" class="-z-10 top-0 absolute h-full w-full flex transition-[left] duration-500">
					<?php foreach ( $slideshow_images as $img ) : ?>
						<div class="shrink-0 h-full w-full inline-block">
							<?php get_template_part( 'template-parts/image', null, array( 'id' => $img['id'] ) ); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
		<section class="flex-grow pt-2 pb-2">
			<main id="main" role="main">
