<?php
/**
 * WordPress functions.php magic file
 *
 * @package ftek\theme
 */

namespace Ftek\Theme;

require_once __DIR__ . '/vendor/autoload.php';


/**
 * Enqueue an entrypoint script
 *
 * @param string $handle Script and style handle.
 * @param string $src    Name of a file inside src/entrypoints.
 */
function enqueue_entrypoint_script( string $handle, string $src ): void {
	$exploded = explode( '.js', $src );
	if ( empty( $exploded[ count( $exploded ) - 1 ] ) ) {
		array_pop( $exploded );
		$src = implode( '.js', $src );
	}

	$base_path = '/build/' . $src;
	$asset     = require get_template_directory() . $base_path . '.asset.php';

	if ( file_exists( get_template_directory() . $base_path . '.css' ) ) {
		wp_enqueue_style(
			$handle,
			get_template_directory_uri() . $base_path . '.css',
			in_array( 'wp-components', $asset['dependencies'], true ) ? array( 'wp-components' ) : array(),
			$asset['version']
		);
	} else {
		wp_enqueue_style( 'wp-components' );
	}

	wp_enqueue_script(
		$handle,
		get_template_directory_uri() . $base_path . '.js',
		$asset['dependencies'],
		$asset['version'],
		true
	);

	wp_set_script_translations(
		$handle,
		'ftek-theme',
		get_template_directory() . '/languages'
	);
}

/**
 * Retrieves all menu items of a navigation menu by menu location
 *
 * @param string $location Menu location.
 * @param array  $args     Arguments to pass to get_posts().
 */
function get_nav_menu_items_by_location( string $location, array $args = array() ) {
	$locations = get_nav_menu_locations();
	if ( ! $locations || ! isset( $locations[ $location ] ) ) {
		return false;
	}
	return wp_get_nav_menu_items( $locations[ $location ], $args );
}

/**
 * Retrieve a quote about Lee Falk's Phantom
 */
function get_phantom_quote(): string {
	$quotes = array(
		__( 'It is terror for the evil man to awake in darkness and see The Phantom.', 'ftek-theme' ),
		__( "He who looks upon the Phantom's face will die a horrible death.", 'ftek-theme' ),
		__( 'There are times when the Phantom leaves the jungle and walks the streets of the town like an ordinary man.', 'ftek-theme' ),
		__( 'You never find the Phantom – he finds you.', 'ftek-theme' ),
		__( 'When the Phantom asks, you answer.', 'ftek-theme' ),
		__( 'When the Phantom moves, lightning stands still.', 'ftek-theme' ),
		__( 'The voice of the Phantom turns the blood to ice.', 'ftek-theme' ),
		__( 'The Phantom has the strength of ten tigers.', 'ftek-theme' ),
		__( 'The Phantom has a thousand eyes and a thousand ears.', 'ftek-theme' ),
		__( 'The Phantom moves as silently as the jungle cat.', 'ftek-theme' ),
		__( 'The Phantom is rough with roughnecks.', 'ftek-theme' ),
		__( 'Never point a gun at the Phantom.', 'ftek-theme' ),
		__( 'Learn to love the darkness.', 'ftek-theme' ),
	);

	return $quotes[ array_rand( $quotes ) ];
}


add_action(
	'after_setup_theme',
	function(): void {
		load_theme_textdomain( 'ftek-theme', get_template_directory() . '/languages' );

		register_nav_menus(
			array(
				'main-navbar' => __( 'Main navbar', 'ftek-theme' ),
			)
		);
	}
);

do_action(
	'switch_theme',
	function(): void {
		Options::purge();
	}
);

add_action(
	'wp_enqueue_scripts',
	function(): void {
		if ( is_front_page() ) {
			enqueue_entrypoint_script( 'ftek-theme-slideshow', 'slideshow.ts' );
		}

		wp_enqueue_style(
			'ftek-theme-style',
			get_stylesheet_uri(),
			array(),
			filemtime( get_template_directory() . '/style.css' )
		);
	}
);

add_theme_support( 'custom-logo' );

add_image_size( 'ftek-theme-placeholder-size', 32, 32 );

Options::init();
