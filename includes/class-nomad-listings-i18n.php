<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://jayanoris.com
 * @since      1.0.0
 *
 * @package    Nomad_Listings
 * @subpackage Nomad_Listings/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Nomad_Listings
 * @subpackage Nomad_Listings/includes
 * @author     Kelvin Jayanoris <kelvin@jayanoris.com>
 */
class Nomad_Listings_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'nomad-listings',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
