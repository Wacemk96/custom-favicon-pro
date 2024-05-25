<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://waseemk.com
 * @since      1.0.0
 *
 * @package    Custom_Favicon_Pro
 * @subpackage Custom_Favicon_Pro/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Custom_Favicon_Pro
 * @subpackage Custom_Favicon_Pro/includes
 * @author     Muhammad Waseem <vasimlive@gmail.com>
 */
class Custom_Favicon_Pro_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'custom-favicon-pro',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
