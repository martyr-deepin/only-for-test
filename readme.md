# 0 简介

blog.deepin.org为deepin官方博客，基于wordpress开发。

# 1 安装部署

# 1.1 前置依赖

要求部署环境上已经有如下工具:
1.系统环境:Debian Stable ( wheezy 7.8 )
2.服务器: nginx/1.4.6 
3.数据库: mysql/5.5.44
4.php版本 >=5.4

# 1.2 安装依赖

# 1.2.1 安装系统工具

在一个干净的debain上安装需要php, php-fpm, curl。php版本要求高于5.4。

````bash
#安装curl
sudo apt-get install curl

#安装php环境
sudo apt-get install php5 php5-fpm
````

# 1.2.2 安装php插件

Wiki网站正常运行需要如下php扩展：Mcrypt/MySQL PDO/CURL/gd。

````bash
#安装php扩展
sudo apt-get install php5-mcrypt php5-mysql php5-curl php5-gd
````

# 1.3 部署源码

项目源码托管在cr.deepin.io上，项目名称为： sites/blog.deepin.org。
统一使用webdelopyer帐号同步代码：

````bash
# 使用master分支
git clone ssh://webdeployer@cr.deepin.io:29418/sites/blog.deepin.org
git checkout master
````

# 1.4 配置文件

先复制配置示例：

````bash
cd deepin
cp deepin-config.default deepin-config.php
````

修改如下内容为实际的线上配置：

````
    /*数据库配置*/
    define('DB_NAME_EN', 'en_deepin_blog');//英文blog数据库名
    define('DB_NAME_ZH', 'deepin_blog');//中文blog数据库名
    define('DB_USER', 'root'); // MySQL 数据库用户名
    define('DB_PASSWORD', 'root'); // MySQL 数据库密码 
    define('DB_HOST', 'localhost'); // MySQL 主机
    /*Deepin ID OAuth认证配置*/
    define('CLIENT_ID', '8ab5ee30b1a0e513ad7fb07ddc01c574bc0ad7cc');//deepinid client_id
    define('CLIENT_SECRET', 'cb461844af2317c9c4fbf4dd42926b65994943c4');//deepinid client_secret
    define('REDIRECT_URI', 'https://blog.deepin.org/wp-content/themes/deepin2015/deepin-login.php');//deepinid　回调地址
````
Deepin ID OAuth认证配置需要在[Deepin Id的后台管理](deepinid-manager.deepin.org/d41d8cd9/)中添加。

# 1.5 删除readme/release-note-*.md 等文件

在网站的根目录执行：
````bash
rm readme.md
rm release-not-*.md
````bash

# 2 更新部署

初次安装完毕后， 如果需要升级，需要执行如下步骤。

# 2.1 依赖更新

需要参考每一次的更新文档

# 2.2 代码更新

在网站的根目录执行：

````bash
git pull --rebase
````
---
