	<?php 
		get_header(); ?>
		
		<section class="feed_container clearfix">

			<header class="feed_header clearfix no_480">

				<div class="filters clearfix">
				
					<form id="level_1_filter" >
						
						<?php get_categories_box( NULL, 'colección', 'chosen-select' ); ?>

					</form><!-- level_1_filter -->

				</div><!-- filters -->

			</header>

			<article class="search_page">
				<?php
					global $wp_query;
					$total_results = $wp_query->found_posts;
					$query_string  = $wp_query->query_vars['s'];
				
				?>
				<h1><?php printf( _n( "%d Resultado para ", "%d Resultados para ", $total_results, 'limulus' ), $total_results ); ?><i><?php echo $query_string; ?></i></h1>
				<hr class="divider">

				<section class="search_container clearfix">
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<article class="each_serarch_result clearfix">
						<a href="<?php the_permalink(); ?>">
						<?php 
						if( has_post_thumbnail() ) {
							the_post_thumbnail();
						}else{

						 	echo "<img src='".THEMEPATH."/images/no_image.png' /> "; 
						} 
						?>
						<div class="info_container">

							<h3><?php the_title(); ?></h3>
							<div class="excerpt no_480">
								<?php the_excerpt(); ?>
							</div>
						</div><!-- info_container -->
						</a>
					</article><!-- each_serarch_result -->

					<?php endwhile; endif; ?>

				</section>
				
				<hr class="divider">
				
				<form id="secondary_searchbox" class="searchform_results clearfix" method="get" action="<?php echo qtrans_convertURL( site_url('/') ); ?>">
					<input type="search" id="searchbox2" value="" name="s" id="s" >
					<input type="hidden" value="<?php echo qtrans_getLanguage(); ?>" name="lang" id="lang" >
					<input type="submit" id="submit_search2" value="">
				</form>
				
			</article><!-- each_post -->
	
		</section><!-- feed_container -->
	
	<?php get_footer(); ?>