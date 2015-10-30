<?php
/**
 * The Header for our theme.
 */
if ( WP_DEBUG && !empty( $_REQUEST['debug'] ) ) {
	if ( 'show' != $_REQUEST['debug'] ) {
		echo '<!-- ';
	}
	esc_html_e( 'Theme File: ' . __FILE__ );
	if ( 'show' != $_REQUEST['debug'] ) {
		echo ' -->';
	}
}
?><!DOCTYPE html>
<!--[if IE 6]>
<html class="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html class="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php if ( is_home() ) {
        bloginfo('name'); echo " - "; bloginfo('description');
    } elseif ( is_category() ) {
        single_cat_title(); echo " - "; bloginfo('name');
    } elseif (is_single() || is_page() ) {
        single_post_title();
    } elseif (is_search() ) {
        echo "搜索结果"; echo " - "; bloginfo('name');
    } elseif (is_404() ) {
        echo '页面未找到!';
    } else {
        wp_title('',true);
    } ?><?php wp_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/**
	 * Add some JavaScript to pages with the comment form to support sites with
	 * threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/**
	 * Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
	$hTag = apply_filters( 'esssence_title_tag', ( is_home() || is_front_page() )? 'h1' : 'h4' );
?>
</head>

<body <?php body_class(); ?>>
<?php
//-- start -- huangwei 2011-12-19 包含顶部公共导航菜单
require_once dirname(ABSPATH).'/ld_check_browser.php';
ldLang::checkLang();
$content = LdLang::commonHeader();

if( preg_match('/<div\sclass=\"main12\">(.|\n)*?<\!--end\smain12-->/i',$content,$m) ) {
	$imghtmls = '<div class="blogbox">
    <div class="blog-header"><img src="'.get_template_directory_uri() . '/images/blog_01.jpg" /></div>
</div>';
	$content = str_replace($m[0],$imghtmls,$content);
}
$content = preg_replace('/<div\sclass=\"nav5\">(.|\n)*?<\!--end\snav5-->/i','',$content);
echo $content;
//-- end --
?>
	<div id="wrapper" class="hfeed container" style="width: 1000px;">
