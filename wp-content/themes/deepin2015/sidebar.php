        <div class="ct_right">
            <div class="ct_right_top">
                    <p class="md1"></p>
                    <p class="md"><?php echo getPostViews(get_the_ID()); ?></p><p>|</p>
                    <a href="#comments">
                    <p class="md2"></p>
                    <p class="md"><?php echo get_comments_number();?></p></a><p>|</p>
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
                        <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
                        <!-- JiaThis Button END -->
            </div>
            <div class="ct_right_recommend">
                <div class="advice"><?php _e('RECOMMENDED'); ?></div>
                <?php
                    wp_reset_query();  
                    $category = get_the_category();  
                    $args = array(
                        'cat'          => $category[0]->cat_ID,
                        'showposts'    => 5,
                        'post__not_in' => array(get_the_ID())
                    );
                    query_posts($args);  
                    global $index;
                    $index = 0;
                    if (have_posts()) : while (have_posts()) : the_post(); 
                ?>
                        <?php if($index == 0): ?>    
                            <a href='<?php the_permalink(); ?>'>
                            <?php the_post_thumbnail( array(264, 113) ); ?>  
                            </a>
                            <div class="ct_right_rec_msg">
                                <p class="mp1"><a  href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
                                <p class="mp2">
                                <?php 
                                    if (has_excerpt()) {
                                        $description = get_the_excerpt();
                                    }else {
                                        $description = mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0, 120,"...");
                                        $description = str_replace("\n","",$description);
                                        $description = empty($description)? $keywords : $description;
                                    }
                                    echo $description;
                                ?>
                                </p>
                            </div>
                        <?php else: ?>
                            <div class="ct_right_rec_msg">
                                <p class="mp1"><a  href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
                                <p class="mp2">
                                    <?php 
                                        if (has_excerpt()) {
                                            $description = get_the_excerpt();
                                        } else {
                                            $description = mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,120,"...");
                                            $description = str_replace("\n","",$description);
                                            $description = empty($description)? $keywords : $description;
                                        }
                                        echo $description;
                                    ?>
                                </p>
                            </div>
                    <?php  endif; $index++; endwhile; endif; ?>
            </div>              
        </div> 







