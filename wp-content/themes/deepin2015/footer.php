<div id="footer">
    <div class="about">
        <ul>
            <li>
                <a href="http://www.deepin.org/aboutus.html" target="_blank"><?php _e('ABOUT-US'); ?></a>
            </li>
            <li>
                <a href="http://www.deepin.org/contact.html" target="_blank"><?php _e('CONTACT-US'); ?></a>
            </li>
            <li>
                <a href="http://www.deepin.org/links.html" target="_blank"><?php _e('LINKS'); ?></a>
            </li>
        </ul>
    </div>
    <div class="copyright">
        ©<?php _e('COPYRIGHT'); ?>
    </div>
    <div class="beian">
        鄂ICP备14003693号-3
    </div>

<!-- ============zh-cn LINKS============ -->
    <div class="social right">
        <a class="weibo left pop" target="_blank" href="http://weibo.com/linuxdeepinnew"></a>
        <a class="weixin left pop"></a>
        <a class="twitter left" target="_blank" href="https://twitter.com/linux_deepin"></a>
        <a class="facebook left" target="_blank" href="https://www.facebook.com/deepinlinux"></a>
        <a class="irc left pop"></a>
        <a class="maillist left pop"></a>
    </div>
<!-- ============END zh-cn LINKS============ -->
</div>

<div class="mask-layer">
</div>

<!-- ============zh-cn WINDOWS============ -->
<div class="windows">
    <div class="window weixin">
        <div class="close"></div>
        <div class="frame">
            <div class="title-bar">
                <h1>微信</h1>
            </div>
            <div class="client">
                <p>
                    欢迎关注　"深度操作系统" 公众号,使用微信扫描下方二维码即可关注。
                </p>
                <img src="<?php bloginfo('template_url'); ?>/image/weixin.jpg" alt="deepin weixin">
            </div>
        </div>
    </div>
    <div class="window irc">
        <div class="close"></div>
        <div class="frame">
            <div class="title-bar">
                <p>
                    <h1><?php _e('IRC-TITLE');?></h1>
                </p>
            </div>
            <div class="client">
                <?php _e('IRC-CONTENT');?>
            </div>
        </div>
    </div>
    <div class="window maillist">
                <div class="close"></div>
                <div class="frame">
                    <div class="title-bar">
                        <h1><?php _e('MAIL-TITLE');?>
                    </div>
                    <div class="client">
                        <?php _e('MAIL-CONTENT');?>
                    </div>
                </div>
            </div>
</div>
<!-- ============END zh-cn WINDOWS============ -->
<div id="scrolltop">
    <?php if ( is_user_logged_in() ): ?>
        <span><a id="post_new" href="<?php home_url();?>/wp-admin/"　 title="<?php _e('CONTRIBUTE'); ?>"></a></span>
    <?php else: ?>
        <span><a id="post_new" href="https://api.deepin.org/oauth2/authorize?client_id=20808e496366f82485da377de935a3a5f2f6707d&redirect_uri=http://blog.deepin.org/wp-content/themes/deepin2015/deepin-login.php&response_type=code&scope=base"　 title="<?php _e('CONTRIBUTE'); ?>" ></a></span>
    <?php endif;?>
    <span><a title="<?php _e('TOP'); ?>" onclick="window.scrollTo('0','0')" class="scrolltopa"></a></span>
</div>
<?php

    if (!current_user_can('manage_options')) {
        add_filter('show_admin_bar', '__return_false');
    }
    wp_footer();
?>


    
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>

    <script src="<?php bloginfo('template_url'); ?>/js/jquery.poshytip.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/jquery-scrolltofixed.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>
</body>
</html>
