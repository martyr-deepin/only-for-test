<?php get_header(); ?>
<link href="<?php bloginfo('template_url'); ?>/css/hot_sort.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/css/search.css" rel="stylesheet">
<style type="text/css" media="screen"> 
</style>

<?php get_template_part('nav', 'clearfix'); ?>

<?php get_template_part('loop', 'search' ); ?>

<?php get_footer(); ?>