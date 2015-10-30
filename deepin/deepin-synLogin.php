<?php
// deepinid 同步登陆
define('DEEPINID_LOGIN_URL', getOAuth2Url());//cookie 作用域

if($_SERVER['DOCUMENT_URI'] != '/wp-content/themes/deepin2015/deepin-login.php') {
    $deepinUser = $_COOKIE['deepinid_login'];
    $current_user = wp_get_current_user();
    $wpUser = $current_user->user_login;

    if (!$deepinUser && is_user_logged_in() ) {
      wp_logout();
      header("location:".constant("HOME_URL"));
    }

    if($deepinUser && ($deepinUser != $wpUser) ) {
        header('location:'.constant("DEEPINID_LOGIN_URL"));
    }
}
?>
