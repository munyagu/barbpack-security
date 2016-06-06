<?php
/*
Plugin Name: Barb Pack Security
Plugin URI: http://barbwire.co.jp/plugin/barb-pack
Description: pingbackを無効にします
Author: barbwire.co.jp
Version: 0.8
Author URI: http://barbwire.co.jp/
Text Domain: contact-form-7
Domain Path: /languages/
 */

define('BARB_SECURITY_VERSION', '0.8');

require_once dirname(__FILE__).'/functions.php';
require_once dirname(__FILE__).'/barb_libs.php';

/**
 * プラグインが有効化された際の処理
 */
function bs_register_activation_hook(){
	
}
register_activation_hook(__FILE__, 'bs_register_activation_hook');

/**
 * プラグインが無効化された際の処理
 */
function bs_register_deactivation_hook(){

}
register_deactivation_hook(__FILE__, 'bs_register_deactivation_hook');

/**
 * プラグインが削除された際の処理
 */
function barb_security_uninstall(){
    delete_option(Version::$name);
}
register_uninstall_hook(__FILE__, 'barb_security_uninstall');

