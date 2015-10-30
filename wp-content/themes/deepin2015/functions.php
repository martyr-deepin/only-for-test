<?php
//文章摘要
add_theme_support("post-thumbnails");

function deepin_get_excerpt()
{
    if (has_excerpt()) {
        $description = get_the_excerpt();
    } else {
        $description = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 220, "...");
        $description = str_replace("\n", "", $description);
        $description = empty($description) ? $keywords : $description;
    }
    echo $description;
}

//特色图像
function autoset_featured()
{
    global $post;
    $already_has_thumb = has_post_thumbnail($post->ID);
    if (!$already_has_thumb) {
        $attached_image = get_children("post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1");
        if ($attached_image) {
            foreach ($attached_image as $attachment_id => $attachment) {
                set_post_thumbnail($post->ID, $attachment_id);
            }
        }
    }
}

add_action("the_post", "autoset_featured");
add_action("save_post", "autoset_featured");
add_action("draft_to_publish", "autoset_featured");
add_action("new_to_publish", "autoset_featured");
add_action("pending_to_publish", "autoset_featured");

//分页
function par_pagenavi($range = 9)
{
    global $paged, $wp_query;
    if (!$max_page) {
        $max_page = $wp_query->max_num_pages;
    }
    //首页对最大页数的处理
    if($paged == 0) {
       $max_page=  ceil($wp_query->found_posts/30);
    }
    if ($max_page > 1) {
        if (!$paged) {
            $paged = 1;
        }
        //if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 返回首页 </a>";}
        previous_posts_link(_x("PREV"));
        if ($max_page > $range) {
            if ($paged < $range) {
                for ($i = 1; $i <= ($range + 1); $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a>";
                }
            } elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                for ($i = $max_page - $range; $i <= $max_page; $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a>";
                }
            } elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a>";
                }
            }
        } else {
            for ($i = 1; $i <= $max_page; $i++) {
                echo "<a href='" . get_pagenum_link($i) . "'";
                if ($i == $paged) echo " class='current'";
                echo ">$i</a>";
            }
        }
        echo "<input id='skip' onkeypress='EnterPress(event)' onkeydown='EnterPress(event)' type='text' style='text-align:center;' value='" . $paged . "'><span>/" . $max_page . "</span>";
        next_posts_link(_x("NEXT"));
        //if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 最后一页 </a>";}
    }
}

//每页显示数
function custom_posts_per_page($query)
{
    global $wp_query;
    $paged = $wp_query->query_vars['paged'];
    if (is_home()) {
        $query->set('posts_per_page', 29);//首页每页显示文章
    }
    if (is_category()) {
        $query->set('posts_per_page', 30);//首页每页显示文章
    }
    if (is_search()) {
        $query->set('posts_per_page', -1);//搜索页显示所有匹配的文章，不分页
    }
    if (is_archive()) {
        $query->set('posts_per_page', 30);//archive每页显示25篇文章
    }
    if ($paged > 1) {
        $query->set('posts_per_page', 30);
    }
    // if($paged == 1 || $paged == 0) {
    // 	$query->set('posts_per_page', 29);
    // }
}

add_action('pre_get_posts', 'custom_posts_per_page');


//获取文章分类
function deepin_get_category()
{
    $category = get_the_category();
    //var_dump($category);
    echo "<a href='" . get_category_link($category[0]->cat_ID) . "'>" . $category[0]->cat_name . "</a>";
}

// 禁用谷歌字体
function coolwp_remove_open_sans_from_wp_core()
{
    wp_deregister_style('open-sans');
    wp_register_style('open-sans', false);
    wp_enqueue_style('open-sans', '');
}

add_action('init', 'coolwp_remove_open_sans_from_wp_core');

//活取用户头像
function getUserAvater($username)
{
    $requese = imgGetCurl('https://api.deepin.org/v1/users/' . $username);
    //var_dump($requese);
    if ($requese) {
        return json_decode($requese)->avatar;
    } else {
        return bloginfo('template_url') . '/image/default.jpg';
    }

}

function getUserProfile($username)
{
    $url = constant('API_URL').constant('ENDPOINT_USERS');
    $requese = imgGetCurl($url. '/' .$username);
    if ($requese) {
        return json_decode($requese)->profile_image;
    } else {
        return bloginfo('template_url') . '/image/default.jpg';
    }

}

function imgGetCurl($url = '', $param = array())
{
    $paramStr = '';
    if (is_array($param) && count($param)) {
        foreach ($param as $index => $value) {
            $paramStr .= $index . '=' . $value . '&';
        }
        $paramStr = substr($paramStr, 0, -1);
        $requestUrl = $url . '?' . $paramStr;
    } else {
        $requestUrl = $url;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $requestUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设置CURL,让其返回数据
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch) or die(curl_error($ch));
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    return ($httpCode >= 200 && $httpCode < 300) ? $data : false;
}

//语言包
load_theme_textdomain('deepin', get_template_directory() . '/languages');

function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

//点击量
function setPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// 说明：获取完整URL 
function curPageURL()
{
    $pageURL = 'http'; 
    if ($_SERVER["HTTPS"] == "on") 
    { 
        $pageURL .= "s"; 
    } 
    $pageURL .= "://"; 
    if ($_SERVER["SERVER_PORT"] != "80") 
    { 
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"]; 
    } else { 
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; 
    } 
    $url = explode('?', $pageURL);
    return $url[0];
} 


//文章标题截取
function subTitle($title, $length)
{
    if (WPLANG == 'zh_CN') {

        return mb_strlen($title, 'utf-8') <= $length ? $title : mb_substr($title, 0, $length, 'utf-8') . "...";
    } else {
        return mb_strlen($title, 'utf-8') <= $length + 20 ? $title : mb_substr($title, 0, $length + 12, 'utf-8') . "...";
    }
}    
//搜索关键字高亮
function search_word_replace($buffer){
    if(is_search()){
        $arr = explode(" ", get_search_query());
        $arr = array_unique($arr);
        foreach($arr as $v)
            if($v)
                $buffer = preg_replace("/(".$v.")/i", "<font color=\"#0086DA\">$1</font>", $buffer);
    }
    return $buffer;
}
add_filter("the_title", "search_word_replace", 200);
add_filter("the_excerpt", "search_word_replace", 200);
add_filter("the_content", "search_word_replace", 200);



//优化
remove_action( 'wp_head', 'feed_links_extra', 3 ); //去除评论feed
remove_action( 'wp_head', 'feed_links', 2 ); //去除文章feed
remove_action( 'wp_head', 'rsd_link' ); //针对Blog的远程离线编辑器接口
remove_action( 'wp_head', 'wlwmanifest_link' ); //Windows Live Writer接口
remove_action( 'wp_head', 'index_rel_link' ); //移除当前页面的索引
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); //移除后面文章的url
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); //移除最开始文章的url
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );//自动生成的短链接
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); ///移除相邻文章的url
remove_action( 'wp_head', 'wp_generator' ); // 移除版本号








   