	<?php 
		get_header();
		$categories = get_the_category();
		$cat_id = NULL;
		foreach ($categories as $mycat)
			$cat_id = ($mycat->parent === 0) ? $mycat->term_id : NULL;
			
		$cat_id = ($cat_id) ? $cat_id : '0';
		the_post(); ?>

		<section class="feed_container clearfix">
			<article class="single_post">

				<!-- <?php the_post_thumbnail( ); ?> -->
				<div class="tags_single clearfix">
					<?php the_tags('', ' '); ?>
				</div>
				
				<h1><?php the_title(); ?></h1>
				

				<section class="main_content">

					<?php the_content(); ?>

				
					<div class="addthis_custom_sharing"></div>

				<?php
					if(qtrans_getLanguage() == 'en'){
						$footnote = get_post_meta( $post->ID, '_piedepag_metabox_en', true );
					}else{
						$footnote = get_post_meta( $post->ID, '_piedepag_metabox', true );
					}; ?>


					<?php if ( $footnote ) : ?>
					
						<footer class="footnote">
							<?php echo wpautop( $footnote ); ?>
						</footer>

					<?php endif; ?>
					
				</section>

				<section class="mas_posts">
					<h4 class=""><?php _e('Artículos relacionados', 'limulus'); ?></h4>

				<?php

					// Related posts
					$args = array(
						'posts_per_page'   => 4,
						'post_type'        => 'post',
						'post_status'      => 'publish',
						'exclude'		   => $post->ID,
						'cat'         	   => $cat_id
					);

					$related_posts = get_posts( $args );

				foreach ($related_posts as $related) : ?>

					<article class="each_post">
						<a href="<?php echo get_permalink( $related->ID ); ?>">
							<?php echo get_the_post_thumbnail( $related->ID, 'thumbnail' ); ?>
							<h3><?php echo qtrans_use(qtrans_getLanguage(), $related->post_title, false); ?></h3>
						</a>
					</article><!-- each_post -->
					
			<?php endforeach; ?>

				</section>

			</article><!-- each_post -->

		</section><!-- feed_container -->
		

	<?php get_footer(); ?>