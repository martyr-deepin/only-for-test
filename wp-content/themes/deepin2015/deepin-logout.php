<?php
//　deepinid　oAuth2退出
define('WP_ROOT', join(DIRECTORY_SEPARATOR, array_slice(explode(DIRECTORY_SEPARATOR, dirname(__FILE__)), 0, -3)));
require_once(WP_ROOT . '/wp-load.php');
	wp_logout();
	$redirect_to = constant("LOGIN_URL").'/oauth2/logout?callback='.constant('HOME_URL');
	header("location:".$redirect_to); 
?>