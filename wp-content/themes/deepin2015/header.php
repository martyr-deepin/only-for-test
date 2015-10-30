<!DOCTYPE html>
<head>
    <?php
        require_once(TEMPLATEPATH."/desc.php");
    ?>
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php bloginfo('template_url'); ?>/css/header.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/css/footer.css" rel="stylesheet">


    <link href="<?php bloginfo('template_url'); ?>/css/bootstrapCss/bootstrap.min.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/css/bootstrapCss/bootstrap-theme.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://deepin.org/js/lib/respond.min.js"></script>
    <script type="text/javascript" src="http://deepin.org/js/lib/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="top" class="navbar navbar-static-top bs-docs-nav" role="banner">
    <div class="navbar navbar-static-top bs-docs-nav" role="banner">
        <div class="nav-container">
            <div class="navbar-header">
                <a class="logo" href="http://deepin.org/">
                    <img src="<?php bloginfo('template_url'); ?>/image/logo.png">
                </a>
            </div>
            <div class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="http://bbs.deepin.org"><?php _e('BBS');?></a>
                    </li>
                    <li>
                        <a href="http://wiki.deepin.org"><?php _e('WIKI');?></a>
                    </li>
                    <li>
                        <a class="a" href="http://blog.deepin.org"><?php _e('BLOG');?></a>
                    </li>
                    <li>
                        <a href="http://feedback.deepin.org"><?php _e('BUG'); ?></a>
                    </li>
                    <li>
                        <a href="http://deepin.org/mirror.html"><?php _e('MIRROR'); ?></a>
                    </li>
                </ul>
                <div class="nav navbar-nav navbar-right">
                    <?php if ( is_user_logged_in() ): ?>
                        <div class="user-info left">
                            <a class="user" >
                                <img src="<?php 
                                    global $current_user;
                                    get_currentuserinfo();
                                    echo $userAvater = getUserProfile($current_user->user_login);
                                ?>">
                                <em class='message-count'>
                                </em>
                            </a>
                            <div class="user-menu">
                                <span class="label username">
                                    <?php
                                        
                                        echo $current_user->user_login;
                                    ?>
                                </span>
                                <div class="arrow-down"></div>
                                <div class="dropdown invisible">
                                    <div class="arrow"></div>
                                    <ul class="dropdown-list info-list">
                                        <li>
                                            <a href="<?php echo constant('ACCOUNT_URL'); ?>" target="_blank"><?php _e('DEEPIN-ID');?></a>
                                        </li>
                                        <li>
                                            <a href="/wp-content/themes/deepin2015/deepin-logout.php"><?php _e('LOGOUT');?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="user-info left">
                            <img class="left user-icon" src="<?php bloginfo('template_url'); ?>/image/icon_user.png">
                            <ul class="not-login">
                                <li>
                                    <a href="<?php echo constant("DEEPINID_REGISTER_URL");?>"><?php _e('REGISTER');?> </a>
                                </li>
                                <li class="delim">|</li>
                                <li>
                                    <a href="<?php echo constant("DEEPINID_LOGIN_URL");?>"><?php _e('LOGIN'); ?></a>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="global left">
                        <div class="language-panel invisible">
                            <div class="arrow"></div>
                            <ul class="language-list">
                                <li>
                                    <a href="<?php echo curPageURL(); ?>?language=en" <?php if(WPLANG == 'en_US'): ?> style="color:#0086DA;"<?php endif; ?>>English</a>
                                </li>
                                <li>
                                    <a href="<?php echo curPageURL();?>?language=zh-cn"
                                        <?php if(WPLANG == 'zh_CN'): ?> style="color:#0086DA;"<?php endif; ?>
                                    >简体中文</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="search left">
                        <form method="get" autocomplete="off" action="<?php echo home_url( '/' ); ?>" >
                            <div style="display: none; position: absolute; top:37px; left:44px;" id="sg">
                                <div id="st_box" cellpadding="2" cellspacing="0"></div>
                            </div>
                            <a class="search-button">
                                <img src="<?php bloginfo('template_url'); ?>/image/icon_search.png">
                            </a>
                            <input type="text" name="s" id="scbar_txt" autocomplete="off" x-webkit-speech speech class="search-text" " />
                            <button id="scbar_btn" type="submit" name="searchsubmit" value="true" class="search-btn"><i class="icon icon-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




