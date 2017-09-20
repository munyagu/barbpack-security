<?php

/*
Plugin Name: Barbwire Security
Plugin URI: http://barbwire.co.jp/plugin/barb-pack
Description: This plugin enhances the WordPress security.
Author: barbwire.co.jp
Version: 1.2.1
Author URI: http://barbwire.co.jp/
Text Domain:barbwire-security
Domain Path: /languages/
 */

define( 'BARBWIRE_SECURITY_VERSION', '1.2.1' );

require_once dirname( __FILE__ ) . '/inc/functions.php';
require_once dirname( __FILE__ ) . '/inc/Version.php';

use barbsecurity\Version as Version;

class BarbwireSecurity {

	/**
	 * Default option values
	 *
	 * @var array
	 */
	private static $default_option_value = array(
		'parameter_enable'         => false,
		'param_name'               => '',
		'param_value'              => '',
		'block_author_archive'     => false,
		'pingback_suppress_enable' => false,
		'disable_rest_api'         => 0,
		'specified_end_point'      => false,
		'end_points'               => '',

	);


	/**
	 * Get option setting from Database
	 *
	 * @return mixed options
	 */
	public static function get_option() {
		return get_option( Version::$name, self::$default_option_value );
	}

	/**
	 * Update option setting
	 *
	 * @param mixed $options settings.
	 */
	public static function update_option( $options ) {
		update_option( Version::$name, $options );
	}

	/**
	 * Activation hook
	 */
	function barb_security_register_activation_hook() {

	}

	/**
	 * Deactivation hook
	 */
	function barb_security_register_deactivation_hook() {

	}

	/**
	 * Uninstall hook
	 */
	function barb_security_uninstall() {
		delete_option( Version::$name );
	}

}


register_activation_hook( __FILE__, array( 'BarbwireSecurity', 'barb_security_register_activation_hook' ) );


register_deactivation_hook( __FILE__, array( 'BarbwireSecurity', 'barb_security_register_deactivation_hook' ) );


register_uninstall_hook( __FILE__, array( 'BarbwireSecurity', 'barb_security_uninstall' ) );

