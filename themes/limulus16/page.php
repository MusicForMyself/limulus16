	<?php get_header(); 

	the_post();?>
	<!-- Insert content here -->
		
	
			<article class="single_post">

				<!-- <?php the_post_thumbnail( ); ?> -->
				<h1><?php the_title(); ?></h1>
				

				<section class="main_content">
					<?php the_content(); ?>
				</section>
				
				
				
			</article><!-- each_post -->

			
	
		</section><!-- feed_container -->
	
	

	<?php get_footer(); ?>