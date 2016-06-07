<?php
/*************** PINGBACK ***************/
/**
 * remove pingback functions
 * test command curl http://barbpack.barbwire.jp/xmlrpc.php -d '<methodCall><methodName>pingback.ping</methodName><params></params></methodCall>'
 */
function bs_remove_xmlrpc_methods($methods){
    bp_log("bs_remove_xmlrpc_methods");
    // refer: http://sakuratan.biz/archives/1208
    // refer:http://z9.io/2008/06/08/did-your-wordpress-site-get-hacked/
    unset( $methods['pingback.ping'] );
    unset( $methods['pingback.extensions.getPingbacks'] );
    return $methods;
}
if(isset($bs_options['pingback_suppress_enable']) && $bs_options['pingback_suppress_enable'] == true) {
    add_filter('xmlrpc_methods', 'bs_remove_xmlrpc_methods', 1, 1);
}

/**
 * remeve X-Pingback from HTTP header
 * @param $headers
 * @return mixed
 */
function bs_wp_headers( $headers ) {
    bp_log("bs_wp_headers");
    unset( $headers['X-Pingback'] );
    return $headers;
}
if(isset($bs_options['pingback_suppress_enable']) && $bs_options['pingback_suppress_enable'] == true) {
    add_filter('wp_headers', 'bs_wp_headers');
}