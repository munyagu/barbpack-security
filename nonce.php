<?php
/*************** VERIFY THE NONCE AT LOGIN ***************/

/**
 * ログインフォームにメッセージを表示し、nonceを追加する
 */
function barb_security_login_form() {
    bp_log("barb_security_login_form");

    if (defined('BARB_SECURITY_MESSAGE') && BARB_SECURITY_MESSAGE) {
        ?>
        <script type="text/javascript">
            window.onload = function () {
                var element = document.getElementById('backtoblog');

                var area = document.createElement('div');
                area.style.marginTop = "30px";
                area.style.width = "100%";
                area.style.height = "80px";
                area.style.color = "#800000";
                area.style.textAlign = "center";

                var logo = document.createElement('p');
                logo.style.fontSize = "14px";
                logo.style.fontWeight = "600";
                logo.innerHTML = 'Barb Pack Security ver.{$version}';
                area.appendChild(logo);

                var copy = document.createElement('p');
                copy.style.fontSize = "14px";
                copy.style.fontWeight = "600";
                copy.innerHTML = '&copy;<a href="http://barbwire.co.jp" target="_blank">BARBWIRE</a>';
                area.appendChild(copy);

                document.body.appendChild(area);
        </script>
        <?php
    }
    // nonceの追加
    wp_nonce_field(Version::$name, 'barb_secure_login');
}
if(isset($bs_options['parameter_enable']) && $bs_options['parameter_enable'] == true) {
    add_action('login_form', 'barb_security_login_form');
}

/**
 * check login nonce
 */
function barb_security_login_init(){
    global $bs_options;
    bp_log("barb_security_login_init");
    if(wp_verify_nonce(Version::$name, 'barb_secure_login')){
        exit_403();
    }

    if(isset($bs_options['parameter_enable']) && $bs_options['parameter_enable'] == true) {
        // リファラが空の場合はGETにパラメータがあることをチェックする
        if(!isset($_SERVER['HTTP_REFERER'])){
            // check get parameter case referer is empty
            if(!LoginParameter::checkGetParam()){
                bp_log("1 case referer is empty");
                exit_403();
            }
        }else if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],'/wp-login.php') !== false){
            bp_log("2 case referer is wp-login.php");
            /**
             * リファラがwp-login.phpの場合はリファラかリクエストにパラメータがあることを確認する
             * また、以下のGETパラメータが有る場合は無視する(logoutはログイン画面が表示されるので無視しない)
             */
            $actions = array('postpass', 'lostpassword', 'retrievepassword', 'resetpass', 'rp');
            if(isset($_GET['action']) && in_array($_GET['action'], $actions, true)){
                return;
            }

            if(!LoginParameter::checkRefererParam() && !LoginParameter::checkGetParam()){
                exit_403();
            }
        }else if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],'/wp-admin/') !== false){
            // do nothing case referer is wp-admin
            bp_log("3 case referer is wp-admin");
            return true;
        }else if(isset($_SERVER['HTTP_REFERER'])){
            // それ以外のリファラでGETにパラメータがあることをチェックする
            if(!LoginParameter::checkGetParam()){
                echo "4";
                exit_403();
            }
        }else{
            echo "5";
            exit_403();
        }

    }

}
add_action( 'login_init', 'barb_security_login_init', 1 );