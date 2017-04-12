<?php get_header(); ?>
<div id="content" role="main">
<article id="post-0" class="post not-found">
<header class="header">
<h1 class="entry-title"><?php _e( 'Oops!', 'amd' ); ?></h1>
</header>
<section class="entry-content">
<p><?php _e( "You've searched for something that isn't here. Try searching?", 'amd' ); ?></p>
<?php get_search_form(); ?>
</section>
</article>
</section>
</div><!-- close content -->
</div><!-- close main box -->
<?php get_footer(); ?>