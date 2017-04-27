<?php 
/**
* Template Name: Page with Grid
*/

get_header(); ?>

		
	<div id="content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="header">
<h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
</header>
<?php amd_get_custom_sidebar(get_the_ID()); ?>
<section class="entry-content">
<?php the_content(); ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
<?php endwhile; endif; ?>
</section>
</article>
<hr class="hr-gradient">

<div id="amd-widget-grid">
	<?php dynamic_sidebar(' in-page-widget-area' ); ?>
</div>

	</div><!-- close content-->
	<div style="margin: 0 auto; height: 20px;"></div>

	<?php amd_get_footer_quote(get_the_ID()); ?>
	</div><!-- close main-box -->
<?php get_footer(); ?>
	