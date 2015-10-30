# 1 升级说明

本次升级主要增添单点登录功能(Deepin ID OAuth认证)，请在升级前到[Deepin Id的后台管理](deepinid-manager.deepin.org/d41d8cd9/)中添加对应应用．

# 2 升级步骤

# 2.1 获取Deepin ID OAuth认证相关配置
到[Deepin Id的后台管理](deepinid-manager.deepin.org/d41d8cd9/)新建应用

blog回调地址为：
````
http://blog.deepin.org/wp-content/themes/deepin2015/deepin-login.php
````

# 2.1 暂停http://blog.deepin.org
停止后访问http://blog.deepin.org会出现502错误，建议先重定向到维护页面。

# 2.2 数据库
数据库不做变更，请将数据库配置写入配置文件(deepin/deepin-config.php)

# 2.3 Blog代码更新

1. cd　网站根目录

2. 从git同步代码
项目源码托管在cr.deepin.io上，项目名称为： sites/blog.deepin.org。
统一使用webdelopyer帐号同步代码：
````bash
# 使用master分支
git clone ssh://webdeployer@cr.deepin.io:29418/sites/blog.deepin.org
git checkout master
````
3. 修改配置文件
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

# 2.4 同步资源文件
    请将原程序wp-content/uploads文件夹复制到wp-content下

# 2.5 nginx配置
添加如下nginx配置

````nginx
access_log /var/log/nginx/blog.deepin.log;
error_log /var/log/nginx/blog.deepin.log;

location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/var/run/php5-fpm.sock;
    fastcgi_index index.php;
    include fastcgi_params;
}
````

重新加载nginx配置

````bash
sudo service nginx reload
````

完成配置