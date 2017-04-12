<?php 
/********
* Template Name: Home Page Template
*******/

get_header(); ?>

		
	<div id="content">
		<h1 class="entry-title"><?php the_title(); ?></h1> 
			<div id="home-left-column">
				<div id="slideshow-container">
					<div id="slideshow">
						<img id="headshot" src="<?php echo get_template_directory_uri() . '/images/new_amd.jpg'; ?>" alt="Ann Marie Dobosz" width="300" height="477" />
						<img src="<?php echo get_template_directory_uri() . '/images/lean.jpg'; ?>" alt="lean" width="300" height="221" />
						<img src="<?php echo get_template_directory_uri() . '/images/crouch.jpg'; ?>" alt="crouch" width="300" height="222" />
						<img src="<?php echo get_template_directory_uri() . '/images/doors.jpg'; ?>" alt="doors" width="300" height="386" />
						<img src="<?php echo get_template_directory_uri() . '/images/dance.jpg'; ?>" alt="dance" width="300" height="222" />
						<img src="<?php echo get_template_directory_uri() . '/images/fist.jpg'; ?>" alt="fist" width="300" height="300" />
					</div>
				</div>
				
				<?php amd_get_custom_sidebar(get_the_ID()); ?>			
				</div> <!-- close left column -->
		<div id="homepage-content">
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>			
			<?php endwhile; endif; ?>
			<?php edit_post_link(); ?>
		</div>

	</div><!-- close content-->
	</div><!-- close main-box -->
<?php get_footer(); ?>
	