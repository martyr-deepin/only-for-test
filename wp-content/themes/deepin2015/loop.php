        <div class="theme_cont">
            <?php 
                if(have_posts()) {
                    global $index;
                    $index= 0;
                    while ( have_posts() ) {
                        the_post();
                        
                        get_template_part( 'content', get_post_format() );
                    }   
                } else {
                   header("location:http://blog.deepin.org"); 
                }

            ?>
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
        </div>   
          <div style="display:none;" id="next_posts_link"><?php next_posts_link(' 下一页 '); ?></div>
        <!--END PAGE NAV-->


   

