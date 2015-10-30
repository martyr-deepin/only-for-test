    <!--AJAX LOAD-->
    <script type="text/javascript" src="http://libs.baidu.com/jquery/1.11.1/jquery.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ias.min.js" type="text/javascript"></script>   
    <script type="text/javascript">
        var ias = $.ias({
            container: "#search_content",        //包含所有文章的元素
            item: ".theme_search_list",      //文章元素
            //pagination: "#footer_page", //分页元素
            next: "#next_posts_link a",   //下一页元素
        });
         
        ias.extension(new IASTriggerExtension({
            text: '', //此选项为需要点击时的文字
            offset: 0,               //设置此项后，到 offset+1 页之后需要手动点击才能加载，取消此项则一直为无限加载
        }));
        ias.extension(new IASSpinnerExtension());
        ias.extension(new IASNoneLeftExtension({
            text: '', // 加载完成时的提示
        }));
    </script>
    <style>
        .ias-noneleft{text-align: center;margin-top:15px;margin-bottom:10px;}
        .ias-trigger-next {text-align: center;margin-top:15px;margin-bottom:10px;}
    </style>
    <!--END AJAX LOAD-->    
    <div class="cont">
        <div class="theme">
            <div class="search_con">
                <form method="get" action="<?php echo home_url( '/' ); ?>">
                    <input id="search_box" type="text" name="s">
                    <input id="search_bt" type="submit" value="<?php _e('SEARCH');?>">
                </form>
            </div>
            <div class="search_tip">
                <?php 
                     global $wp_query;
                     printf( __('SEARCH-RESULT') ,get_search_query(), $wp_query->found_posts);
                ?>
                <span>  
            </div>
            <ul class="theme_con_index clearfix current" id="search_content">
                <?php while(have_posts()) :the_post(); ?>
                <li class="theme_search_list">
                    <div class="theme_list_con">
                        <div class="title"><p class="theme_list_post"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p></div><br>
                        <div class="theme_list_ct">
                            <?php   
                                if (has_excerpt()) {
                                    $description = get_the_excerpt();
                                } else {
                                    $description = mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,220,"...");
                                    $description = str_replace("\n","",$description);
                                    $description = empty($description)? $keywords : $description;
                                }
                                echo $description;
                            ?>
                        </div>
                        <div class="auth_msg clearfix">
                            <p><span><?php the_time('Y-m-d H:i'); ?></span>&nbsp;-&nbsp;<span><?php the_author_posts_link(); ?></span>&nbsp;-&nbsp;<span>  <?php if ( count( get_the_category() ) ) : echo get_the_category_list( ', ' ); endif; ?></span></p>
                        </div>
                    </div>
                </li>
                <?php endwhile;?>
                
            </ul>
        </div>
    </div>
    <!--PAGE NAV-->
        <style>
            .page_navi{overflow:hidden;width:100%;text-align:center;padding-top: 15px;margin-bottom: 16px;}
            .page_navi a{display: inline-block;margin-right: 19px!important;margin-top: 21px;margin-bottom: 16px;height: 24px;-webkit-border-radius: 12px;-moz-border-radius: 12px;border-radius: 12px;color: #232a3c !important;text-decoration: none;line-height: 24px;min-width: 18px;}
            .page_navi a:hover,.page_navi a.current{color: #fff!important;background-color: #0086da;border-radius: 0;text-decoration: none;}
            .page_navi input{ height: 24px !important;width: 40px !important;border-radius: 4px;box-shadow: inset 3px 3px rgba(31,41,60,0.08);border: 1px solid #c9d1e1;}
            .page_navi input[type="text"]:focus{ outline: none;box-shadow: inset 3px 3px rgba(69,100,161,0.25)!important;border: 1px solid #96b0e8;}
            .page_navi span{margin-right: 19px;}
        </style>
        <div id="footer_page" class="page_navi">
            <?php par_pagenavi(4); ?>
            <div style="display:none;" id="next_posts_link"><?php next_posts_link(_x("NEXT")); ?></div>
        </div>   
    <!--END PAGE NAV-->