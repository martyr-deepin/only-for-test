<?php get_header(); ?>
<link href="<?php bloginfo('template_url'); ?>/css/hot_sort.css" rel="stylesheet">
<?php get_template_part('nav', 'clearfix'); ?>
<?php get_template_part('loop', 'index' ); ?>
<?php get_footer(); ?>

<!--AJAX LOAD-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ias.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function getNextPageNum() { 
            var nextPageLink  =  $('#footer_page > a:last-child').attr('href');
            var page = parseInt($('#skip').val()) + 1;
            nextPageLink = nextPageLink.substring(0, nextPageLink.indexOf('/page'));
            nextPageLink = nextPageLink + '/page/' + page + '/';
            return nextPageLink;
    }


    var ias = $.ias({
        container: ".theme_cont",     //包含所有文章的元素
        item: ".theme_list",          //文章元素
        //pagination: "#footer_page", //分页元素
        next: "#next_posts_link a",   //下一页元素

    });
     
    ias.extension(new IASTriggerExtension({
        text: '',      //此选项为需要点击时的文字
        offset: 2,     //设置此项后，到 offset+1 页之后需要手动点击才能加载，取消此项则一直为无限加载
    }));
    ias.extension(new IASSpinnerExtension());
    ias.extension(new IASNoneLeftExtension({
        text: '', // 加载完成时的提示
    }));

    //ajax加载后,执行
    ias.on('rendered', function() {
        $('#footer_page .current').next().addClass("current").siblings().removeClass('current');
        $('#skip').attr('value', parseInt($('#skip').attr('value')) + 1) ;

        var page = parseInt($('#skip').val());
        var maxPage = $('#footer_page span').html();
        maxPage = parseInt(maxPage.substring(1, maxPage.length));
        if(page == maxPage) {
            $('#footer_page > a:last-child').remove();
        } else {
            $('#footer_page > a:last-child').attr('href', getNextPageNum());
        }
        
    });




</script>
<!--END AJAX LOAD-->