<?php  get_header(); ?>
		
	<section class="feed_container clearfix">

		<article class="search_page">
			<?php
				global $wp_query;
				$total_results = $wp_query->found_posts;
				$query_string  = $wp_query->query_vars['s']; ?>

			<section class="search_container clearfix">
				
			<?php 
				if ( have_posts() ) : ?>
					<h1><?php printf( _n( "%d Resultado para ", "%d Resultados para ", $total_results, 'limulus' ), $total_results ); ?><i>"<?php echo $query_string; ?>"</i></h1>
				<?php 
					while ( have_posts() ) : 
						the_post(); ?>
			
						<article class="each_post search_result">
							<a rel="nofollow" href="<?php the_permalink(); ?>">
								<?php 
								if( has_post_thumbnail() ) {
									echo get_the_post_thumbnail( $post->ID, 'medium_lim' );
								}else{

								 	echo "<img src='".THEMEPATH."/images/no_image.png' /> "; 
								} ?>
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
					endwhile;
				else: ?>
				<h1 class="no_results">Tu búsqueda </br> no obtuvo </br>ningún </br>resultado</h1>
				<a class="go_home" href="<?php echo site_url(); ?>">ir al inicio</a>
			<?php
				endif; ?>

			</section>
						
		</article>

	</section>
	
<?php get_footer(); ?>