<?php
    define('HOME_URL', 'http://blog.deepin.org');//blog主页地址
    define('ACCOUNT_URL', 'http://account.deepin.org');//个人中心主页地址
    define('COOKIE_DOMAIN', '.deepin.org');//cookie 作用域
    define('DEEPINID_REGISTER_URL', 'http://account.deepin.org/register');//个人中心注册地址
    /*数据库配置*/
    define('DB_NAME_EN', 'en_deepin_blog');//英文blog数据库名
    define('DB_NAME_ZH', 'deepin_blog');//中文blog数据库名
    define('DB_USER', 'M4_DB_USER'); // MySQL 数据库用户名
    define('DB_PASSWORD', 'M4_DB_PASSWORD'); // MySQL 数据库密码 
    define('DB_HOST', 'M4_DB_HOST'); // MySQL 主机
    /*Deepin ID OAuth认证配置*/
    define('CLIENT_ID', '8ab5ee30b1a0e513ad7fb07ddc01c574bc0ad7cc');//deepinid client_id
    define('CLIENT_SECRET', 'cb461844af2317c9c4fbf4dd42926b65994943c4');//deepinid client_secret
    define('REDIRECT_URI', 'https://blog.deepin.org/wp-content/themes/deepin2015/deepin-login.php');//deepinid　回调地址
    define('LOGIN_URL', 'https://login.deepin.org');//deepinid 登录url
    define('API_URL', 'https://api.deepin.org');//deepinid API url
    /*以下为deepin ID OAuth认证配置，通常不用改动*/
    define('RESPONSE_TYPE', 'code');//deepinid 认证方式
    define('SCOPE', 'base,user:read');//deepinid app权限
    define('ENDPOINT_OAUTH2', '/oauth2/authorize');//deepinid url-endpoint　authorizes
    define('ENDPOINT_TOKEN', '/oauth2/token');//deepinid url-endpoint token
    define('ENDPOINT_USER', '/v1/user');//deepinid url-endpoint user
    define('ENDPOINT_USERS', '/v1/users');//deepinid url-endpoint users
    
?>
