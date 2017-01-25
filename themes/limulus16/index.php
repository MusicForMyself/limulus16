	<?php get_header(); ?>
		
		<section class="feed_container post_feed_home clearfix">

			<?php 
				$count = 0; 
				wp_reset_postdata(); 
				if ( have_posts() ) : while ( have_posts() ) :
					the_post(); 
					$count ++; ?>
				
					<article class="each_post">
						<a href="<?php the_permalink(); ?>">
							<?php
								if($count > 5){
									the_post_thumbnail('medium_lim', array( )); 
								} else {
									the_post_thumbnail('big_lim', array( )); 
								}
							?>
							<h3><?php the_title(); ?></h3>
						</a>
					</article>

			<?php 
				endwhile; endif; ?>
			
			<div class="clearfix"></div>

		</section><!-- feed_container -->

	<?php get_footer(); ?>