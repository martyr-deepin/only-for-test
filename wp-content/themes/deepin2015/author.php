<?php get_header(); ?>
<link href="<?php bloginfo('template_url'); ?>/css/hot_sort.css" rel="stylesheet">
<?php get_template_part('nav', 'clearfix'); ?>
    <!--AJAX LOAD-->
    <script type="text/javascript" src="http://libs.baidu.com/jquery/1.11.1/jquery.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ias.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var ias = $.ias({
            container: ".theme_cont",        //包含所有文章的元素
            item: ".theme_list",      //文章元素
            //pagination: "#footer_page", //分页元素
            next: "#next_posts_link a",   //下一页元素
        });
         
        ias.extension(new IASTriggerExtension({
            text: '', //此选项为需要点击时的文字
            offset: 2,               //设置此项后，到 offset+1 页之后需要手动点击才能加载，取消此项则一直为无限加载
        }));
        ias.extension(new IASSpinnerExtension());
        ias.extension(new IASNoneLeftExtension({
            text: '', // 加载完成时的提示
        }));
    </script>
    <!--END AJAX LOAD-->


    <link href="<?php bloginfo('template_url'); ?>/css/author.css" rel="stylesheet">
    <div class="theme_personal">
        <div class="theme_personal_info">
            <div class="theme_personal_img">
                <img src="<?php  echo $userAvater = getUserProfile(get_the_author()); ?>">
            </div>
            <div class="theme_personal_con">

                <p><?php echo get_the_author();?></p>
                <p><?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?></p>
            </div>
        </div>
    </div>
<?php get_template_part('loop', 'index' ); ?>
<?php get_footer(); ?>