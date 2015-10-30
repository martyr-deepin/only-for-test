


<?php get_header(); ?>
<link href="<?php bloginfo('template_url'); ?>/css/page3Tip.css" rel="stylesheet">

<div class="theme">
    <?php get_template_part('nav', 'clearfix'); ?>
    <div class="theme_cont">
        <?php while ( have_posts() ) : the_post(); ?>
        <div class="theme_main">
            <?php get_template_part('loop', 'single'); ?>
            <div class="theme_comment" id="comments">
                <?php comments_template( '', true ); ?>
            </div>           
        </div>
        <?php endwhile; ?>
        <?php get_sidebar();  ?>
    </div>
</div>

<?php get_footer(); ?>
<script type="text/javascript">
$(function(){ 
    $('img').parent('a').attr('target', '_blank');
}); 
</script>
