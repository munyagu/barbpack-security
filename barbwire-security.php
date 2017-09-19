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

define( 'BARB_SECURITY_VERSION', '1.2.1' );

require_once dirname( __FILE__ ) . '/inc/functions.php';
require_once dirname( __FILE__ ) . '/inc/barb_libs.php';
require_once dirname( __FILE__ ) . '/inc/Version.php';

use barbsecurity\Version as Version;

class BarbwireSecurity {

	private static $defaultOptionValue = array(
		'parameter_enable' => false,
		'param_name' => 'secure',
		'param_value' => 'true',
		'block_author_archive' => false,
		'pingback_suppress_enable' => false,
		'disable_rest_api' => 0

	);

	private static $option = array();

	public static function getOption(){
		if(empty(self::$option)){
			self::$option = get_option( Version::$name, BarbwireSecurity::$defaultOptionValue );
		}
		return self::$option;
	}

	/**
	 * プラグインが有効化された際の処理
	 */
	function barb_security_register_activation_hook() {

	}

	/**
	 * プラグインが無効化された際の処理
	 */
	function barb_security_register_deactivation_hook() {

	}

	/**
	 * プラグインが削除された際の処理
	 */
	function barb_security_uninstall() {
		delete_option( Version::$name );
	}

}


register_activation_hook( __FILE__, array( 'BarbwireSecurity', 'barb_security_register_activation_hook' ) );


register_deactivation_hook( __FILE__, array( 'BarbwireSecurity', 'barb_security_register_deactivation_hook' ) );


register_uninstall_hook( __FILE__, array( 'BarbwireSecurity', 'barb_security_uninstall' ) );

