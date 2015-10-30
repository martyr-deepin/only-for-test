<?php
/**
 * The Template used to display all single posts
 *
 * @since 0.0.1
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

get_header();
?>
<br>

<br>
		<div id="content-container" class="span-15">
			<div id="content">
				<!-- JiaThis Button BEGIN -->
				<div id="ckepop"><span class="jiathis_txt">分享到：</span>
				<a class="jiathis_button_tsina"></a>
				<a class="jiathis_button_tqq"></a>
				<a class="jiathis_button_renren"></a>
				<a class="jiathis_button_kaixin001"></a>
				<a class="jiathis_button_t163"></a>
				<a class="jiathis_button_tsohu"></a>
				<a class="jiathis_button_qzone"></a>
				<a class="jiathis_button_douban"></a>
				<a class="jiathis_button_email"></a>
				<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank"></a>
				<a class="jiathis_counter_style"></a>
				</div>
<script type="text/javascript" >
var jiathis_config={
	summary:"",
	hideMore:false
}
</script>
<script type="text/javascript" src="http://v2.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->
</br>
			
</br>
</br>
			<?php
			/* Run the loop to output the post.
			 * If you want to overload this in a child theme then include a file
			 * called loop-single.php and that will be used instead.
			 */
			get_template_part( 'loop', 'single' );
			?>

	
</div><!-- #content -->
</div><!-- #ccontent-ontainer -->

<?php
get_sidebar();
get_footer();
