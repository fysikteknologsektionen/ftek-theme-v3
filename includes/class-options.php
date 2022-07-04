<?php
/**
 * Options class
 *
 * @package ftek\theme
 */

namespace Ftek\Theme;

/**
 * Options class
 */
class Options {

	public const DEFAULTS = array(
		'publisher_name' => '',
	);

	/**
	 * Initialize resources
	 */
	public static function init(): void {
		add_action( 'init', array( self::class, 'add_option' ) );
		add_action( 'customize_register', array( self::class, 'add_customize_menus' ) );
	}

	/**
	 * Returns option values
	 *
	 * @param ?string $key Key of requested setting or null for the entire
	 *                     option array.
	 */
	public static function get( ?string $key = null ) {
		$option = get_option( 'ftek_theme_option' );
		$option = array_merge( self::DEFAULTS, $option ? $option : array() );
		return null === $key ? $option : $option[ $key ];
	}

	/**
	 * Should be called on plugin activation
	 *
	 * Makes sure all settings exist
	 */
	public static function activate(): void {
		self::add_option();
		update_option( 'ftek_theme_option', array_intersect_key( self::get(), self::DEFAULTS ) );
	}

	/**
	 * Should be called on uninstall
	 */
	public static function purge(): void {
		delete_option( 'ftek_theme_option' );
	}

	/**
	 * Registers option with the WordPress Settings API
	 */
	public static function add_option(): void {
		register_setting(
			'ftek_theme_option_group',
			'ftek_theme_option',
			array(
				'single'       => true,
				'show_in_rest' => array(
					'schema' => array(
						'type'       => 'object',
						'required'   => true,
						'properties' => array(
							'publisher_name' => array(
								'type'     => 'string',
								'required' => true,
							),
						),
					),
				),
				'default'      => self::DEFAULTS,
			)
		);
	}

	/**
	 * Adds theme customization menus
	 *
	 * Callback for the customize_register action hook
	 *
	 * @param \WP_Customize_Manager $manager WP_Customize_Manager instance.
	 */
	public static function add_customize_menus( \WP_Customize_Manager $manager ): void {
		$manager->add_section(
			'ftek_theme_misc_section',
			array(
				'title'    => __( 'Ftek Theme Settings', 'ftek-theme' ),
				'priority' => 100,
			)
		);

		$manager->add_setting(
			'ftek_theme_option[publisher_name]',
			array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);

		$manager->add_control(
			'ftek_theme_publisher_name_control',
			array(
				'label'    => __( 'Full name of the publisher', 'ftek-theme' ),
				'section'  => 'ftek_theme_misc_section',
				'settings' => 'ftek_theme_option[publisher_name]',
			)
		);
	}
}
