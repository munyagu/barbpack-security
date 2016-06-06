<?php
namespace barbsecurity;

include_once dirname('__FILE__').'/barbpack-security.php';

class Version {

	public static $name = 'barbpack-security';

	public static function getVersion(){
		$ver = BARB_SECURITY_VERSION;
		return $ver;
	}	
}
