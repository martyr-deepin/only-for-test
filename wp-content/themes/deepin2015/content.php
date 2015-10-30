
<?php   
    global $index, $wp_query;
    $paged = $wp_query->query_vars['paged'];
    if(is_home() && $index == 0 && $paged <= 1): $index++;?>
            <div class="theme_main_list">
                <a href="<?php the_permalink();?>">
                    <?php the_post_thumbnail( array(749, 321) ); ?> 
                </a>
                <div class="theme_main_list_msg">
                    <p class="theme_main_list_title">
                        <a href="<?php the_permalink(); ?>"><?php echo subTitle(get_the_title(), 45); ?></a>
                    </p>
                    <div class="mt">
                        <a><img src="<?php bloginfo('template_url'); ?>/image/avatar_small.jpg"></a>
                        <?php the_author_posts_link(); ?><span>/</span>
                        <?php if ( count( get_the_category() ) ) : echo get_the_category_list( ', ' ); endif; ?>
                        <span>/</span><span><?php the_time('m-d') ?></span>
                        <div class="icon_info">
                            <a href="<?php the_permalink();?>#comments">
                                <div class="md2"><?php echo get_comments_number();?></div>
                                <div class="md1"></div>
                            </a>
                            
                            <div class="md2"><?php echo getPostViews(get_the_ID()); ?></div>
                            <div class="md3"></div>
                        </div>
                    </div>
                </div>
            </div>
    <?php else:?>    
            <div class="theme_list">
                <?php 
                    if (has_post_thumbnail()) {
                        $link = get_the_permalink();
                        echo "<a href='".$link."'>";
                        the_post_thumbnail( 'thumbnail' );
                        echo '</a>';
                    } else {
                        //默认图片
                        $link = get_the_permalink();
                        echo "<a href='".$link."'>";
                        $templet_url = get_bloginfo("template_url");
                        echo '<img src="'. $templet_url.'/image/blog_3.png">';
                        echo '</a>';
                    } 
                ?>
                <div class="theme_list_msg">
                    <p class="theme_list_title"><a title="<?php the_title();?>" href="<?php the_permalink(); ?>"><?php echo subTitle(get_the_title(), 35); ?></a></p>
                    <div class="mt"> 
                        <div class="mc">
                            <p> 
                                <?php   
                                if (has_excerpt()) {
                                    $description = get_the_excerpt();
                                } else {
                                    $description = mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,220,"...");
                                    $description = str_replace("\n","",$description);
                                    $description = empty($description)? $keywords : $description;
                                }
                                echo $description;?>
                            </p>
                        </div>
                        <div class="mt_info">
		                <img class="imgCls" src="<?php bloginfo('template_url'); ?>/image/avatar_small.jpg">
		                <?php the_author_posts_link(); ?>
		                <span>/</span>     
		                <?php if(count( get_the_category())) : echo get_the_category_list( ', ' ); endif; ?>
		                <span>/</span>
		                <span>
		                    <?php 
		                        //the_time('Y-m-d H:i') 
		                        the_time('m-d');
		                    ?>
		                </span>
                        </div>
                        
                        <div class="icon_info">
                            <a href="<?php the_permalink();?>#comments">
                                <div class="md2"><?php echo get_comments_number();?></div>
                                <div class="md1"></div>
                            </a>
                            <div class="md2"><?php echo getPostViews(get_the_ID()); ?></div>
                            <div class="md3"></div>
                        </div>
                    </div>
                </div>
            </div>
    <?php endif; ?>            
