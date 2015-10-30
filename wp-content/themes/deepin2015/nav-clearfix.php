    <div class="theme_hotsort">
        <div class="subnav">
            <?php if(is_single()):?>
                <p class="lead">
                    <a href="<?php bloginfo('url'); ?>"><?php _e('BLOG');?></a>&nbsp;>
                    <?php        
                        $categorys = get_the_category(); $category = $categorys[0];
                        echo $nav = get_category_parents($category->term_id, false,'&nbsp;>&nbsp;'); 
                        _e('TEXT');
                    ?>
                </p> 
            <?php elseif(is_category()):?>
                <p class="lead">
                    <a href="<?php echo bloginfo('url'); ?>"><?php _e('BLOG');?></a>>
                    <?php         
                        $catTitle = single_cat_title( "", false );
                        $cat = get_cat_ID( $catTitle );
                        $cat = get_category_parents( $cat, TRUE, "&nbsp;>&nbsp;" );
                        echo substr($cat, 0, strlen($cat) -13);
                    ?>
                </p> 
            <?php else:?>
                <p class="lead"><?php _e('HOT-CAT');?></p>
                <ul class="nav nav-pills">
                    <li><a href="<?php _e('COMMUNITY-ANNOUNCEMENT-LINK');?>"><?php _e('COMMUNITY-ANNOUNCEMENT');?></a></li>
                    <li><a href="<?php _e('REPLEASE-NOTES-LINK');?>"><?php _e('REPLEASE-NOTES');?></a></li>
                    <li><a href="<?php _e('SYSTEM-UPDATE-LINK');?>"><?php _e('SYSTEM-UPDATE');?></a></li>
                    <li><a href="<?php _e('MEDIA-REPORTS-LINK');?>"><?php _e('MEDIA-REPORTS');?></a></li>
                    <li><a href="<?php _e('WONDERFUL-ACTIVITIES-LINK');?>"><?php _e('WONDERFUL-ACTIVITIES');?></a></li>
                </ul>   
            <?php endif;?>
                
            <div class="tools-container">
                <?php if ( is_user_logged_in() ): ?>
                    <a id="theme_post" href="<?php home_url();?>/wp-admin/">
                        <?php _e('CONTRIBUTE');?>
                    </a>
                <?php else: ?>
                    <a id="theme_post" href="https://api.deepin.org/oauth2/authorize?client_id=20808e496366f82485da377de935a3a5f2f6707d&redirect_uri=http://blog.deepin.org/wp-content/themes/deepin2015/deepin-login.php&response_type=code&scope=base">
                        <?php _e('CONTRIBUTE');?>
                    </a>
                <?php endif;?>
                <a title="RSS" class='theme_extend' href="<?php bloginfo('url'); ?>/?feed=rss2" target="_blank"></a>
                <a title="<?php _e('CATEGORY');?>" class='theme_moresort'"></a>

            </div>
            <span class="arrow_sort"></span>

        </div>

    </div>
    <div id="theme_moreSort" style="">
                                   <?php
                                        $arg = array(
                                            'parent' => 0,
                                        );
                                        $categories = get_categories($arg);
                                        $child_arg = array(
                                            'echo'        => false,
                                            'title_li'    => null,
                                            'show_count'  => true,
                                            'hide_empty'  => false,
                                        );
                                        //
                                        foreach ($categories as $category) {
                                            $child_arg['parent'] = $category->term_id;
                                            $child_categories = wp_list_categories($child_arg);
                                            echo '<div><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '><h4>'.$category->name.'</h4></a><ul>'.$child_categories.'</ul></div>';

                                        }

                                    ?>
    </div>