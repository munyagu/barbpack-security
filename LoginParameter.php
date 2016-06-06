<?php
namespace barbsecurity;

require_once dirname(__FILE__).'/barb_libs.php';
require_once dirname(__FILE__).'/Version.php';

use \bp_log as bp_log;

/**
 * パラメータチェック用クラス
 * Author nagasawa@barbwire.co.jp
 * Copyright barbwire.co.jp
 */
class LoginParameter {
	
	public static $key = 'secure';
	public static $val = 'true';

	/**
	 * GETリクエストにパラメータが含まれるかどうかをチェックする
	 * @return bool
	 */
	public static function checkGetParam(){
		bp_log("checkParam");
		$options = get_option(Version::$name);
		$key = $options['param_name'];
		$val = $options['param_value'];

		if(! isset($_GET[$key]) || $_GET[$key] != $val){
			return false;
		}else{
			return true;
		}
	}

	/**
	 * リファラにパラメータが含まれるかどうかをチェックする
	 * @return bool
	 */
	public static function checkRefererParam(){
		bp_log("checkParam");
		$options = get_option(Version::$name);

		$key = $options['param_name'];
		$val = $options['param_value'];

		if(strpos($_SERVER['HTTP_REFERER'], (urlencode($key).'='.urlencode($val))) !== false){
			return true;
		}else{
			return false;
		}

	}



	public static function activeteLoginParameter(){
		bp_log("activeteLoginParameter");
		//add_action('wp_logout', array('barbsecurity\LoginParameter', 'bs_wp_logout'));
		//add_action('wp_login_failed', array('barbsecurity\LoginParameter', 'bs_front_end_login_fail'));

		//add_filter('wp_redirect', array('barbsecurity\LoginParameter', 'bs_redirect'), 1, 2);
		//add_filter('wp_redirect','barbsecurity\ttttest', 1, 2);
		add_filter('login_url',array('barbsecurity\LoginParameter', 'addParameter'),1);
		add_filter('logout_redirect',array('barbsecurity\LoginParameter', 'addParameter'),1);

		//do not care second mistake
		//add_filter('wp_login_errors',array('barbsecurity\LoginParameter', 'addParameterSecond'),1 ,2);
	}

	public static function addParameter($redirect){
		$options = get_option(Version::$name);
		$key = $options['param_name'];
		$val = $options['param_value'];
		$redirect .= strpos($redirect, '?') === false ? '?' : '&';
		$redirect .= "{$key}={$val}";
		return $redirect;
	}

/* never tested
	public static function addParameterSecond($errors, &$redirect_to){
		if(count($errors) > 0){
			$options = get_option(Version::$name);
			$key = $options['param_name'];
			$val = $options['param_value'];
			$redirect_to .= strpos($redirect, '?') === false ? '?' : '&';
			$redirect_to .= "{$key}={$val}";
		}
		return $errors;
	}
 */
}
