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
		'publisher_name'     => '',
		'slideshow_images'   => '[]',
		'org_nr'             => '',
		'email'              => '',
		'street_address'     => '',
		'mailing_address'    => '',
		'contact_url'        => '',
		'privacy_policy_url' => '',
		'the_phantom_url'    => '',
		'support_name'       => '',
		'support_url'        => '',
	);

	/**
	 * Initialize resources
	 */
	public static function init(): void {
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
	 * Should be called on uninstall
	 */
	public static function purge(): void {
		delete_option( 'ftek_theme_option' );
	}

	/**
	 * Adds theme customization menus
	 *
	 * Callback for the customize_register action hook
	 *
	 * @param \WP_Customize_Manager $manager WP_Customize_Manager instance.
	 */
	public static function add_customize_menus( \WP_Customize_Manager $manager ): void {
		$manager->add_setting(
			'ftek_theme_option[slideshow_images]',
			array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);
		$manager->add_control(
			new Slideshow_Image_Selector(
				$manager,
				'ftek_theme_slideshow_images_control',
				array(
					'section'  => 'ftek_theme_misc_section',
					'settings' => 'ftek_theme_option[slideshow_images]',
				)
			)
		);

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

		$manager->add_setting(
			'ftek_theme_option[org_nr]',
			array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);
		$manager->add_control(
			'ftek_theme_org_nr_control',
			array(
				'label'    => __( 'Organization number', 'ftek-theme' ),
				'section'  => 'ftek_theme_misc_section',
				'settings' => 'ftek_theme_option[org_nr]',
			)
		);

		$manager->add_setting(
			'ftek_theme_option[email]',
			array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);
		$manager->add_control(
			'ftek_theme_email_control',
			array(
				'label'    => __( 'Email', 'ftek-theme' ),
				'section'  => 'ftek_theme_misc_section',
				'settings' => 'ftek_theme_option[email]',
			)
		);

		$manager->add_setting(
			'ftek_theme_option[street_address]',
			array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);
		$manager->add_control(
			'ftek_theme_street_address_control',
			array(
				'label'    => __( 'Street address', 'ftek-theme' ),
				'section'  => 'ftek_theme_misc_section',
				'settings' => 'ftek_theme_option[street_address]',
			)
		);

		$manager->add_setting(
			'ftek_theme_option[mailing_address]',
			array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);
		$manager->add_control(
			'ftek_theme_mailing_address_control',
			array(
				'label'    => __( 'Mailing address', 'ftek-theme' ),
				'section'  => 'ftek_theme_misc_section',
				'settings' => 'ftek_theme_option[mailing_address]',
			)
		);

		$manager->add_setting(
			'ftek_theme_option[contact_url]',
			array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);
		$manager->add_control(
			'ftek_theme_contact_url_control',
			array(
				'label'    => __( 'Url to contact page', 'ftek-theme' ),
				'section'  => 'ftek_theme_misc_section',
				'settings' => 'ftek_theme_option[contact_url]',
			)
		);

		$manager->add_setting(
			'ftek_theme_option[privacy_policy_url]',
			array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);
		$manager->add_control(
			'ftek_theme_privacy_policy_url_control',
			array(
				'label'    => __( 'Url to privacy policy page', 'ftek-theme' ),
				'section'  => 'ftek_theme_misc_section',
				'settings' => 'ftek_theme_option[privacy_policy_url]',
			)
		);

		$manager->add_setting(
			'ftek_theme_option[the_phantom_url]',
			array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);
		$manager->add_control(
			'ftek_theme_the_phantom_url_control',
			array(
				'label'    => __( 'Url to page about Lee Falk\'s Phantom', 'ftek-theme' ),
				'section'  => 'ftek_theme_misc_section',
				'settings' => 'ftek_theme_option[the_phantom_url]',
			)
		);

		$manager->add_setting(
			'ftek_theme_option[support_name]',
			array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);
		$manager->add_control(
			'ftek_theme_support_name_control',
			array(
				'label'    => __( 'Name of support contact', 'ftek-theme' ),
				'section'  => 'ftek_theme_misc_section',
				'settings' => 'ftek_theme_option[support_name]',
			)
		);

		$manager->add_setting(
			'ftek_theme_option[support_url]',
			array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);
		$manager->add_control(
			'ftek_theme_support_url_control',
			array(
				'label'    => __( 'Url to support contact page', 'ftek-theme' ),
				'section'  => 'ftek_theme_misc_section',
				'settings' => 'ftek_theme_option[support_url]',
			)
		);
	}
}
