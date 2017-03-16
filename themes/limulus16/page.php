	<?php 
		get_header(); 
		the_post(); ?>
		
	
			<article class="single_post page">

				<!-- <?php the_post_thumbnail( ); ?> -->
				<h1><?php the_title(); ?></h1>

				<section class="main_content">
					<?php the_content(); ?>
				</section>
				
			</article>
			
	
		</section><!-- feed_container -->
	

	<?php get_footer(); ?>