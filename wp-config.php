<?php
/** 
 * WordPress 基础配置文件。
 *
 * 本文件包含以下配置选项: MySQL 设置、数据库表名前缀、
 * 密匙、WordPress 语言设定以及 ABSPATH。如需更多信息，请访问
 * {@link http://codex.wordpress.org/Editing_wp-config.php 编辑
 * wp-config.php} Codex 页面。MySQL 设置具体信息请咨询您的空间提供商。
 *
 * 这个文件用在于安装程序自动生成 wp-config.php 配置文件，
 * 您可以手动复制这个文件，并重命名为 wp-config.php，然后输入相关信息。
 *
 * @package WordPress
 */


// WordPress 目录的绝对路径。
if (!defined('ABSPATH')) {
	define('ABSPATH', dirname(__FILE__) . '/');
}
//加载deepinid相关配置文件
require_once(ABSPATH . 'deepin/deepin-config.php');
//加载deepin相关方法
require_once(ABSPATH . 'deepin/deepin-functions.php');


// special rules for language detecting
if (array_key_exists("q", $_GET) && $_GET["q"] == "/archives/7776"){
	$deepin_language = "en";
} else {
	$deepin_language = dectLang();
}


/**
 * MySQL 设置 - 具体信息来自您正在使用的主机 *
 */
// 创建数据表时默认的文字编码 
define('DB_CHARSET', 'utf8');
// 数据库整理类型。如不确定请勿更改 
define('DB_COLLATE', '');
// WordPress 数据表前缀。前缀名只能为数字、字母加下划线。
$table_prefix  = 'wp_';
// 根据语言选用不同数据库
if ($deepin_language == "en") {
	define('DB_NAME', constant('DB_NAME_EN'));
} else {
	define('DB_NAME', constant('DB_NAME_ZH'));
}


/**#@+
 * 身份密匙设定。
 *
 * 您可以随意写一些字符
 * 或者直接访问 {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org 私钥生成服务}，
 * 任何修改都会导致 cookie 失效，所有用户必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '6YIQqEe[*@qYXB_< 13kv8e*0-:fP09&=fXp,>QxY7g57gWTW1DC]9tf!*4}9q,4');
define('SECURE_AUTH_KEY',  'X^~8}Wufspe^d,>}!GK,M#x@57ME~;LP[+}E;5`Ym3Kt`ZiFX].@5.4,-Akvl}k{');
define('LOGGED_IN_KEY',    'N!Sy;Va6h{t/vV[kE1y9-4D!<.nflj_8N_n5u_.sG27nSPZ$K;+nV<QNS/XQcgZp');
define('NONCE_KEY',        '6_WV8m-%L|?Zc1x7ON!iB:ZYlO^9hC/nrq0~/$`[22DWP=!GoDIEmy7dk`C_u:|a');
define('AUTH_SALT',        'q]urfYyi8p~+!FGoE6m0RzGEw>A#D}FXw2Q8.:txHUqlx*t_]|xE70o]ekY>`HBd');
define('SECURE_AUTH_SALT', 'R72((I>T#^ha+50,z(nNP>2>QBuZzfnHEZ`(/5KgE DeEE948yH|<GNubKd75^H+');
define('LOGGED_IN_SALT',   'o$%-!6zs*,Q#vcSb>.YZ~aq1|}hj]*Yi`U:o2Al;=^,gO;M6#jD^L#6g@-.XRA-y');
define('NONCE_SALT',       'NG?Ha5On?@S4XSvl7 FU?.<2`d;!9@q7:(zWb2lvEmF@WOqq8g!4rXd_3?h`P+:m');


/**
 * WordPress 语言设置，默认为英语。
 *
 * 本项设定能够让 WordPress 显示您需要的语言。
 * wp-content/languages 内应放置同名的 .mo 语言文件。
 * 要使用 WordPress 简体中文界面，只需填入 zh_CN。
 */
//define ('WPLANG', 'zh_CN');
if ($deepin_language == "zh-cn"){
	define ('WPLANG' ,'zh_CN');
} else {
	define ('WPLANG' ,'en_US');
}


/**
 * 开发者专用：WordPress 调试模式。
 *
 * 将这个值改为“true”，WordPress 将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用本功能。
 */
define('WP_DEBUG', false);

// 设置 WordPress 变量和包含文件。
require_once(ABSPATH . 'wp-settings.php');

//　加载deepinid同步登录/登出代码
require_once(ABSPATH . 'deepin/deepin-synLogin.php');

