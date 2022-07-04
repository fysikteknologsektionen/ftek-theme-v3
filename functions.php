<?php
/**
 * WordPress functions.php magic file
 *
 * @package ftek\theme
 */

namespace Ftek\Theme;

require_once __DIR__ . '/vendor/autoload.php';


define( __NAMESPACE__ . '\THEME_FILE', __FILE__ );
define( __NAMESPACE__ . '\THEME_ROOT', dirname( THEME_FILE ) );


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
	$asset     = require THEME_ROOT . $base_path . '.asset.php';

	if ( file_exists( THEME_ROOT . $base_path . '.css' ) ) {
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
		THEME_ROOT . '/languages'
	);
}

/**
 * Activation hook callback
 */
function activate() {
	Options::activate();
}

/**
 * Uninstall hook callback
 */
function uninstall(): void {
	Options::purge();
}


add_action(
	'after_setup_theme',
	function(): void {
		load_theme_textdomain( 'ftek-theme', false, get_template_directory() . '/languages' );
	}
);

register_activation_hook( THEME_FILE, __NAMESPACE__ . '\activate' );
register_uninstall_hook( THEME_FILE, __NAMESPACE__ . '\uninstall' );

Options::init();
