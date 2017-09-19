<?php

namespace barbsecurity;

use \BarbwireSecurity as BarbwireSecurity;

/**
 * Class DisableRESTAPI
 * @package barbsecurity
 *
 * test url http://hostname/wp-json/wp/v2/posts
 *
 */
class DisableRESTAPI {

	/**
	 * activate disnable rest api
	 */
	public static function activate() {

		$option = BarbwireSecurity::getOption();

		if ( defined( 'JSON_API_VERSION' ) && version_compare( JSON_API_VERSION, '2.0', '<' ) ) {
			add_filter( 'json_enabled', '__return_false' );
			add_filter( 'json_jsonp_enabled', '__return_false' );
		} else if ( defined( 'REST_API_VERSION' ) && version_compare( REST_API_VERSION, '2.0', '>=' ) ) {
			if ( version_compare( get_bloginfo( 'version' ), '4.7', '<' ) ) {
				add_filter( 'rest_enabled', '__return_false' ); // Deprecated in WordPress 4.7
				add_filter( 'rest_jsonp_enabled', '__return_false' ); // Deprecated in WordPress 4.7
			}

			add_filter( 'rest_authentication_errors', array(
				'barbsecurity\DisableRESTAPI',
				'rest_authentication_errors'
			) );
		} else {
			// not exists rest api
		}

	}

	/**
	 *
	 */
	public static function activateAuth() {
		add_filter( 'rest_authentication_errors', function ( $result ) {
			if ( ! is_user_logged_in() ) {
				return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
			}
		} );
	}


}