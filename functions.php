<?php
require_once dirname(__FILE__).'/Version.php';
require_once dirname(__FILE__).'/admin/settings.php';
require_once dirname(__FILE__).'/disable_pingback.php';
require_once dirname(__FILE__).'/nonce.php';

require_once dirname(__FILE__).'/LoginParameter.php';
require_once dirname(__FILE__).'/barb_libs.php';

use barbsecurity\Version as Version;
use barbsecurity\LoginParameter as LoginParameter;

define('BARB_SECURITY_AUTHORITYSECURE', 'manage_options');    //User level required in order to change the settings.
define('BARB_SECURITY_SAVE_TRANSIENT', Version::$name."_SAVE");

$version = Version::getVersion();
$bs_options = get_option(Version::$name, array());

function barb_security_plugins_loaded() {
    $result = load_plugin_textdomain(Version::$name, false, Version::$name.'/languages');
}
add_action( 'plugins_loaded', 'barb_security_plugins_loaded' );



/*************************************
 * ADMIN LOGIN PAGE URL PARAMETER
 *************************************/

$barb_security_options = get_option(Version::$name, array());
/* If enable ADMIN LOGIN PAGE URL PARAMETER, initialize activate it.  */
if(isset($barb_security_options['parameter_enable']) && $barb_security_options['parameter_enable'] == true){
    LoginParameter::activeteLoginParameter();
}


/*************** OTHER ***************/

/**
 * エラーコード403で終了する
 */
function exit_403(){
    echo '<html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1>'.__('Failed to login.', Version::$name).'</body></html>';
    status_header( 403 );
    exit();
}
