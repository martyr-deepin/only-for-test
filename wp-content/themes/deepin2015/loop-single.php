            <?php setPostViews(get_the_ID()); ?>
            <div class="theme_main_left">
                <div class="theme_main_top">
                   <table>
                       <tr>
                            <td rowspan="2">
                                <img src="<?php echo $userAvater = getUserProfile(get_the_author());?>">
                            </td>
                           
                                <?php if(mb_strlen(get_the_title(), 'utf-8') <= 54):?>
                                    <td><?php the_title();?></td>
                                <?php else:?>
                                    <td style="font-size: 18px; line-height: 26px;"><?php the_title();?></td>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                           <td>
                                <?php the_author_posts_link(); ?>                                  
                                <span>/</span>
                                <?php 
                                    // if(!get_the_tags('', '<span>,</span>', '')) {
                                    //     echo"<a href=''>deepin</a>";
                                    // } else {
                                    //     the_tags('', '<span>,</span>', '') ;
                                    // } 
                                if ( count( get_the_category() ) ) : echo get_the_category_list( ', ' ); endif;
                                ?>
                                <span>/</span>
                                <span><?php the_time('Y-n-j') ?></span>
                           </td>
                       </tr>
                    </table>
                </div>
                <div class="theme_p_conf">
                    <?php the_content(); ?>
</p><p>&nbsp;</p>
<p style="text-align: center;"><span style="font-size: medium;DISPLAY: block;text-align: center;">
      <strong>
        Follow Us: <a href="http://www.deepin.org/" target="_blank">Website</a>&nbsp;|&nbsp;
        <a href="http://bbs.deepin.org" target="_blank">Forum</a><br></strong></span>
<span style="font-size: medium;text-align: center;"><strong><a href="http://e.weibo.com/linuxdeepinnew" target="_blank">Weibo</a>&nbsp;|&nbsp;
<a href="https://twitter.com/linux_deepin" target="_blank">Twitter</a>&nbsp;|
<a href="https://www.facebook.com/deepinlinux" target="_blank">Facebook&nbsp;</a>|&nbsp;
<a href="http://webchat.freenode.net/?channels=deepin" target="_blank">IRC</a>&nbsp;|&nbsp;
<a href="http://distrowatch.com/table.php?distribution=deepin" target="_blank">Distrowatch</a>
</strong></span></p>
                </div>
                <div class="theme_p_foot">
                    <p class="md1"></p>
                    <p class="md"><?php echo getPostViews(get_the_ID()); ?></p><p>|</p>
                    <a href="#comments">
                        <p class="md2"></p>
                        <p class="md"><?php echo get_comments_number();?></p>
                    </a>
                    <p>|</p>
                        <!-- JiaThis Button BEGIN -->
                        <div class="jiathis_style">
                            <p class="md3"></p>
                            <a class="jiathis_button_tsina"></a>
                            <a class="jiathis_button_weixin"></a>
                            <a class="jiathis_button_fb"></a>
                            <a class="jiathis_button_twitter"></a>
                            <a class="jiathis_button_googleplus"></a>
                        </div>
                        <script type="text/javascript" >
                        var jiathis_config={
                            sm:"tsina,weixin,fb,twitter,googleplus",
                            summary:"",
                            shortUrl:true,
                            hideMore:true
                        }
                        </script>
                        <!-- <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>-->
                        <!-- JiaThis Button END -->
                </div>
                <div class="theme_p_ps">
                    <span><?php previous_post_link('< %link') ?></span><p><?php next_post_link('%link <span>></span>') ?></p>
                </div>
            </div>        
