	<?php get_header(); ?>
	<!-- Insert content here -->

		<?php get_sidebar(); ?>

		<section class="feed_container post_feed_home clearfix">

			<header class="feed_header clearfix ">

				<div class="filters clearfix no_480">

					<form id="level_1_filter" >

						<?php qtrans_getLanguage() == 'es' ? get_categories_box( NULL, 'colección', 'chosen-select' ) : get_categories_box( NULL, 'collection', 'chosen-select' ); ?>

					</form><!-- level_1_filter -->
				</div><!-- filters -->
				<div class="clearfix"></div>
			<?php

			global $wp_query;
			$post_count = $wp_query->post_count;

			$featured_post = getfeaturedPost();

				if($featured_post) :
					$size = (!wp_is_mobile()) ? 'slider' : 'thumbnail';
			?>
				<div class="banner">
					<a href="<?php echo get_permalink( $featured_post->ID ); ?>">
						<div class="img_wrap">
							<?php echo get_the_post_thumbnail( $featured_post->ID, 'slider', array( 'class' => 'blur_this no_480 no_320' ) ); ?>
							<?php echo get_the_post_thumbnail( $featured_post->ID, 'thumbnail', array( 'class' => 'blur_this solo_480 solo_320' ) ); ?>
						</div>

						<div class="info_container">
							<h3><?php echo qtrans_use(qtrans_getLanguage(), $featured_post->post_title, false); ?></h3>
						</div><!-- info_container -->
					</a>
				</div><!-- banner -->
				<hr class="divider margin_top no_480">
			<?php endif; ?>

			</header>

			<?php wp_reset_postdata(); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<article class="each_post">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('thumbnail', array( 'class' => 'blur_this' )); ?>
						<h3><?php the_title(); ?></h3>
					</a>
				</article>

			<?php endwhile; endif; ?>
			<?php while( $post_count % 5 !== 0) : ?>

				<article class="each_post fake">

				</article>

			<?php $post_count++; endwhile; ?>
			<div class="clearfix"></div>
			<hr class="divider pagination double margin_top"></hr>
			<?php echo get_previous_posts_link( '<i class="fa fa-caret-left"></i> anterior' ); ?>
			<?php echo get_next_posts_link( 'siguiente <i class="fa fa-caret-right"></i>' ); ?>
			<hr class="divider pagination solo_768"></hr>
			<div class="banner_fonca">
				<a href="http://fonca.conaculta.gob.mx/" target="_blank">
					<img src="<?php echo THEMEPATH; ?>/images/banners/25_fonca_limulus.gif">
				</a>
			</div>
			<hr class="divider pagination solo_768"></hr>
		</section><!-- feed_container -->



	<?php get_footer(); ?>