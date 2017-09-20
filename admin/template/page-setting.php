<?php
require_once WP_PLUGIN_DIR . '/barbwire-security/inc/Version.php';
require_once WP_PLUGIN_DIR . '/barbwire-security/inc/LoginParameter.php';
use barbsecurity\Version as Version;
use barbsecurity\LoginParameter as LoginParameter;

$barbwire_security_options_tmp = get_transient( BARB_SECURITY_OPTION_TRANSIENT );
if ( false === $barbwire_security_options_tmp ) {
	$barbwire_security_options_tmp = array();
}
$barbwire_security_options = array_merge( BarbwireSecurity::get_option(), $barbwire_security_options_tmp );


?>
<div class="wrap">
    <div class="wrap">
        <h2><?php echo __( 'Barbwire Security Settings', 'barbwire-security' ) ?></h2>
    </div>

    <form id="secure" method="post" action="">
		<?php wp_nonce_field( Version::$name, 'barb_secure' ) ?>
        <div class="header_buttons">
            <input type="submit" class="button button-primary button-large"
                   value="<?php echo __( 'save', 'barbwire-security' ) ?>"/>
        </div>
        <div id="settings">
            <h3><?php echo __( 'ADMIN LOGIN PAGE URL PARAMETER', 'barbwire-security' ); ?><a id="login_parameter"
                                                                                             class="help_link"
                                                                                             href="#"><img
                            src="<?php echo plugins_url() . '/barbwire-security/img/question_icon.png' ?>"/></a></h3>
			<?php
			$enable = $barbwire_security_options['parameter_enable'];
			?>
            <p><?php echo __( 'Login URL is', 'barbwire-security' ) ?> <input id="login_url" type="text"
                                                                              value="<?php echo wp_login_url() ?>"
                                                                              onclick="this.select()"
                                                                              readonly="readonly"/></p>
            <table>
                <tr>
                    <th><?php echo __( 'enable login url parameter function', 'barbwire-security' ) ?></th>

                    <td><label><input type="checkbox" name="parameter_enable"
                                      value="1" <?php echo $enable ? "checked='checked'" : ''; ?>><?php echo __( 'enable', 'barbwire-security' ) ?>
                        </label></td>
                </tr>
                <tr>
                    <th><?php echo __( 'parameter name', 'barbwire-security' ) ?></th>
                    <td>
						<?php $value = isset( $_POST['param_name'] ) && ! empty( $_POST['param_name'] ) && $enable ? $_POST['param_name'] : $barbwire_security_options['param_name']; ?>
                        <input type="text" name="param_name" placeholder="<?php echo LoginParameter::$key ?>"
                               value="<?php echo ! empty( $value ) ? $value : '' ?>" <?php echo $enable ? '' : 'readonly' ?>/><br/>
						<?php echo __( 'Alphanumeric characters and hyphens, underscores only.', 'barbwire-security' ) ?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo __( 'parameter value', 'barbwire-security' ) ?></th>
                    <td>
						<?php $value = isset( $_POST['param_value'] ) && ! empty( $_POST['param_value'] ) && $enable ? $_POST['param_value'] : $barbwire_security_options['param_value']; ?>
                        <input type="text" name="param_value" placeholder="<?php echo LoginParameter::$val ?>"
                               value="<?php echo ! empty( $value ) ? $value : '' ?>" <?php echo $enable ? '' : 'readonly' ?>/><br/>
						<?php echo __( 'Alphanumeric characters and hyphens, underscores only.', 'barbwire-security' ) ?>
                    </td>
                </tr>
            </table>
            <!-- TODO Unimplemented
            <h3>LOGIN RETRY LIMIT COUNT</h3>
            <table>
                <tr>
                    <th>Enable the login retry limit count function</th>
                    <?php /* TODO Unimplemented */ //$enable = isset($options['retry_times_enable']) && $options['retry_times_enable']==true;?>
                    <td><label><input type="checkbox" name="retry_times_enable" value="1" <?php /* TODO Unimplemented */ //isset($options['retry_times_enable']) && $options['retry_times_enable']==true?"checked='checked'":'';?>/>enable</label></td>
                </tr>
                <tr>
                    <th>Retry Limit</th>
                    <td><input class="retry_field short_num" type="number" name="retry_limit" value="<?php /* TODO Unimplemented */ //isset($options['retry_limit'])?$options['retry_limit']:''?>" <?php /* TODO Unimplemented */ //$enable?'':'readonly'?>/></td>
                </tr>
                <tr>
                    <th>Lockout Period</th>
                    <td><input class="retry_field short_num" type="number" name="retry_lock_period" value="<?php /* TODO Unimplemented */ //isset($options['retry_lock_period'])?$options['retry_lock_period']:''?>" <?php /* TODO Unimplemented */ // $enable?'':'readonly'?>> minuites</td>
                </tr>
                <tr>
                    <th>Connection Setting</th>
                    <td>
                        <label><input class="retry_field" type="radio" name="retry_connection" value="1" <?php /* TODO Unimplemented */ //isset($options['retry_connection']) && $options['retry_connection']=='1'?"checked='checked'":'';?> <?php /* TODO Unimplemented */ //$enable?'':'readonly'?>/>Direct connection to server.</label><br/>
                        <label><input class="retry_field" type="radio" name="retry_connection" value="2" <?php /* TODO Unimplemented */ //isset($options['retry_connection']) && $options['retry_connection']=='2'?"checked='checked'":'';?> <?php /* TODO Unimplemented */ //$enable?'':'readonly'?>/>Conecction via reversy proxy.</label>
                    </td>
                </tr>
            </table>
            -->
            <h3><?php echo __( 'AUTHOR ARCHIVE', 'barbwire-security' ) ?><a id="author_archive" class="help_link" href="#"><img
                            src="<?php echo plugins_url() . '/barbwire-security/img/question_icon.png' ?>"/></a></h3>
            <table>
                <tr>
                    <th><?php echo __( 'Block the display of author archive page', 'barbwire-security' ) ?></th>
                    <td><label><input type="checkbox" name="block_author_archive"
                                      value="1" <?php echo isset( $barbwire_security_options['block_author_archive'] ) && $barbwire_security_options['block_author_archive'] == true ? "checked='checked'" : ''; ?>>enable</label>
                    </td>
                </tr>
            </table>

            <h3><?php echo __( 'PINGBACK', 'barbwire-security' ) ?><a id="pingback" class="help_link" href="#"><img
                            src="<?php echo plugins_url() . '/barbwire-security/img/question_icon.png' ?>"/></a></h3>
            <table>
                <tr>
                    <th><?php echo __( 'Suppress Pingback function', 'barbwire-security' ) ?></th>
                    <td><label><input type="checkbox" name="pingback_suppress_enable"
                                      value="1" <?php echo isset( $barbwire_security_options['pingback_suppress_enable'] ) && $barbwire_security_options['pingback_suppress_enable'] == true ? "checked='checked'" : ''; ?>>enable</label>
                    </td>
                </tr>
            </table>

            <!--  TODO Unimplemented
            <h3>CAPTCHA</h3>
            <table>
                <tr>
                    <th>enable the CAPTCHA at login</th>
                    <td><label><input type="checkbox" name="captcha_enable" value="1" <?php /* TODO Unimplemented */ // isset($options['captcha_enable']) && $options['captcha_enable']==true?"checked='checked'":'';?>>enable</label></td>
                </tr>
            </table>
            -->

            <h3><?php echo __( 'REST API', 'barbwire-security' ) ?><a id="restapi" class="help_link" href="#"><img
                            src="<?php echo plugins_url() . '/barbwire-security/img/question_icon.png' ?>"/></a></h3>
            <table>
                <tr>
                    <th><?php echo __( 'Disable REST API', 'barbwire-security' ) ?></th>
                    <td>
						<?php
						$rest_api_value = 0;
						if ( isset( $barbwire_security_options['disable_rest_api'] ) && ! empty( $barbwire_security_options['disable_rest_api'] ) ) {
							$rest_api_value = (int) $barbwire_security_options['disable_rest_api'];
						}
						?>
                        <!-- <label><input type="checkbox" name="disable_rest_api"
                                      value="1" <?php echo isset( $barbwire_security_options['disable_rest_api'] ) && $barbwire_security_options['disable_rest_api'] == true ? "checked='checked'" : ''; ?>>enable</label> -->
                        <label><input type="radio" name="disable_rest_api"
                                      value="0"<?php echo $rest_api_value === 0 ? ' checked="checked"' : ''; ?>><?php echo __( 'Enable REST API(WordPress default)', 'barbwire-security' ) ?>
                            )</label><br>
                        <label><input type="radio" name="disable_rest_api"
                                      value="1"<?php echo $rest_api_value === 1 ? ' checked="checked"' : ''; ?>><?php echo __( 'Disable Anonymous REST request.', 'barbwire-security' ) ?>
                        </label><br>
                        <label><input type="radio" name="disable_rest_api"
                                      value="2"<?php echo $rest_api_value === 2 ? ' checked="checked"' : ''; ?>><?php echo __( 'Disable All REST request.' ) ?>
                        </label><br>
                        <label><input type="checkbox" name="specified_end_point"
                                      value="1"<?php echo $barbwire_security_options['specified_end_point'] == true ? ' checked="checked"' : ''; ?>><?php echo __( 'Enable specified end point.', 'barbwire-security' ) ?>
                        </label><br>
                        <label>Input end point, separate by a line break.<br><textarea name="end_points"
                                                                                       style="width:100%;height: 100px;"><?php echo $barbwire_security_options['end_points']; ?></textarea></label>
                    </td>
                </tr>
            </table>

            <div class="header_buttons">
                <input type="submit" class="button button-primary button-large"
                       value="<?php echo __( 'save', 'barbwire-security' ) ?>"/>
            </div>
        </div>
    </form>
</div>