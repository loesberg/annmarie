<?php get_header(); ?>
<div id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php comments_template(); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>

</div><!-- close content -->
<?php get_sidebar(); ?>
</div><!-- close main box -->
<?php get_footer(); ?>