	<?php get_header(); ?>
		
		<section class="feed_container post_feed_home clearfix">

			<?php 
				$count = 0; 
				wp_reset_postdata(); 
				if ( have_posts() ) : while ( have_posts() ) :
					the_post(); 
					$count ++; ?>
				
					<article class="each_post home">
						<a rel="nofollow" href="<?php the_permalink(); ?>">
							<?php
								if($count > 5){
									the_post_thumbnail('medium_lim', array( )); 
								} else {
									the_post_thumbnail('big_lim', array( )); 
								}
							?>
						</a>
						<section class="info_post">
							<div class="post_content">
								<a href="<?php the_permalink(); ?>">
									<h3><strong><?php the_title(); ?></strong></h3>
								</a>
							</div>
						</section>
						
					</article>

			<?php 
				endwhile; endif; ?>
			
			<div class="clearfix"></div>

		</section><!-- feed_container -->

	<?php get_footer(); ?>