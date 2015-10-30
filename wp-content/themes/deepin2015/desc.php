<?php if (is_home()) { ?><title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title><?php } ?>
<?php if (is_search()) { ?><title>搜索结果 | <?php bloginfo('name'); ?></title><?php } ?>
<?php if (is_single()) { ?><title><?php echo trim(wp_title('', 0)); ?> | <?php bloginfo('name'); ?></title><?php } ?>
<?php if (is_page()) { ?><title><?php echo trim(wp_title('', 0)); ?> | <?php bloginfo('name'); ?></title><?php } ?>
<?php if (is_category()) { ?><title><?php single_cat_title(); ?> | <?php bloginfo('name'); ?></title><?php } ?>
<?php if (is_month()) { ?><title><?php the_time('F'); ?> | <?php bloginfo('name'); ?></title><?php } ?>
<?php if (function_exists('is_tag')) {
    if (is_tag()) { ?><title><?php single_tag_title("", true); 
?>
| <?php bloginfo('name'); ?></title><?php } ?> <?php } ?>

<?php
##定义一个函数.解决截取中文乱码的问题
if (!function_exists('utf8Substr')) {
    function utf8Substr($str, $from, $len)
    {
        return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $from . '}' .
            '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $len . '}).*#s',
            '$1', $str);
    }
}

if (WPLANG == "zh_CN"){
    $keywords = "deepin,深度操作系统,武汉深之度科技有限公司,深度科技";
} else {
    $keywords = "deepin,Wuhan Deepin Technology Co., Ltd.,Deepin Technology";
}
if (is_home()) {
    $description = "blog for deepin";
} elseif (is_single()) {
    if ($post->post_excerpt) {
        $description = $post->post_excerpt;
    } else {
        // if (preg_match('/<p>(.*)<\/p>/iU', trim(strip_tags($post->post_content, "<p>")), $result)) {
        //     $post_content = $result['1'];
        // } else {
        //     $post_content_r = explode("\n", trim(strip_tags($post->post_content)));
        //     $post_content = $post_content_r['0'];
        //     var_dump($post_content);
        // }
        // $description = utf8Substr($post_content, 0, 220);

        $description = mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,220,"...");
        $description = str_replace("\n","",$description);
        $description = str_replace("&nbsp;","",$description);
        $description = empty($description)? $keywords : $description;
    }



    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag) {
        $keywords = $keywords . $tag->name . ",";
    }
} elseif (is_category()) {
     	$description = strip_tags(apply_filters('category', category_description()));
     	$description = empty($description)?  :single_cat_title();
     	$keywords = "deepin, linuxdeepin, deepin blog";
   
}
?>
<?php echo "\n"; ?>
<meta name="description" content="<?php echo trim($description); ?>"/>
<meta name="keywords" content="<?php echo rtrim($keywords, ','); ?>"/>