<?php
//　deepinid　oAuth2回调文件
define('WP_ROOT', join(DIRECTORY_SEPARATOR, array_slice(explode(DIRECTORY_SEPARATOR, dirname(__FILE__)), 0, -3)));
require_once(WP_ROOT . '/wp-load.php');

if(isset($_GET['code'])) {
    $access_info = getAccessToken($_GET['code']);
    $user_info = getUserInfo($access_info['access_token']);
} else {
    die('invalid code');
}

// setcookie('AVATAR', $user_info['avatar'], time() + (60 * 60 * 24 * 365), '/');

if (username_exists($user_info['username'])) {
    $user_id = username_exists($user_info['username']);
    get_user_meta($user_id, 'uid', true);
    wp_set_auth_cookie($user_id);
} else {
    $user_id = wp_create_user($user_info['username'], 'deepinpassword' . $user_info['email'], $user_info['email']);
    if (is_numeric($user_id)) {
        add_user_meta($user_id, 'uid', $user_info['uid'], true);
        wp_set_auth_cookie($user_id);
    } else {
        die('error login_name or emalil');
    }
}

header("location:".constant("HOME_URL"));
?>