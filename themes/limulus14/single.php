	<?php get_header();

	the_post();?>
	<!-- Insert content here -->

		<?php get_sidebar();

		$cat_object = get_the_category( $post->ID );
		if($cat_object[0]->parent == 0){
			$cat_id = $cat_object[1]->term_id;
			$cat_name = $cat_object[1]->name;
		} else {
			$cat_id = $cat_object[0]->term_id;
			$cat_name = $cat_object[0]->name;
		};


		$filters        = getParentCategories( $cat_id );
		$parent_object  = get_term_by( 'slug', $filters['coleccionslug'], 'category' );
		$parent_id      = $parent_object->term_id;
		//echo 'CatID: '.$cat_id;
		// echo 'Colecion: '.$filters['coleccionslug'];
		//echo '<br /><br />cat object: '; print_r($cat_object);
		//echo '<br /><br />filters: '; print_r($filters);
		//echo '<br /><br />parent object: ';print_r($parent_object);
		//echo '<br /><br />Parent id: '.$parent_id;
		// echo 'objeto: '; print_r($parent_object);
		?>

		<section class="feed_container clearfix">

			<header class="feed_header clearfix no_480">

				<div class="filters clearfix">

					<form id="level_2_filter" action="">
						<?php qtrans_getLanguage() == 'es' ? get_categories_box( '', 'colección', 'chosen-select-50', $filters ) : get_categories_box( '', 'collection', 'chosen-select-50', $filters ); ?>

						<?php qtrans_getLanguage() == 'es' ? get_categories_box( $parent_id, 'cajón', 'chosen-select-50 light', $filters ) : get_categories_box( $parent_id, 'box', 'chosen-select-50 light', $filters ); ?>


					</form><!-- level_2_filter -->

				</div><!-- filters -->

				<section class="navigator">
					<a href="<?php echo get_permalink(get_adjacent_post(false,'',false)); ?>" class="arrow left"></a>
					<a href="<?php echo get_permalink(get_adjacent_post(false,'',true)); ?>" class="arrow right"></a>
				</section><!-- navigator -->

			</header>

			<article class="single_post">

				<!-- <?php the_post_thumbnail( ); ?> -->
				<h1><?php the_title(); ?></h1>
				<hr class="divider full_width" />

				<section class="main_content">

					<?php the_content(); ?>

					<hr class="divider full_width" />
					<div class="addthis_custom_sharing"></div>

					<?php
					if(qtrans_getLanguage() == 'en'){
						$footnote = get_post_meta( $post->ID, '_piedepag_metabox_en', true );
					}else{
						$footnote = get_post_meta( $post->ID, '_piedepag_metabox', true );
					}; ?>



					<?php if ( $footnote ) : ?>


					<hr class="divider full_width" />
						<footer class="footnote">
							<?php echo wpautop( $footnote ); ?>
						</footer>
					<?php endif; ?>
					<hr class="divider full_width" />


				</section>

				<section class="mas_posts">
					<h4 class="solo_480 solo_320"><?php _e('Artículos relacionados', 'limulus'); ?></h4>

					<h4 class="no_480"><?php _e('Más artículos en: ', 'limulus'); ?><?php echo str_replace( '-', ' ', $filters['coleccion'] ); ?> > <?php echo $cat_name; ?></h4>
				<?php

					// Get related posts

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

				<hr class="divider full_width" />

				<div class="banner_fonca">
					<a href="http://fonca.conaculta.gob.mx/" target="_blank">
						<img src="<?php echo THEMEPATH; ?>/images/banners/segundo_encuentro_limulus.gif">
					</a>
				</div>




			</article><!-- each_post -->

		</section><!-- feed_container -->
		<?php
		$tags = wp_get_post_tags($post->ID);
		//print_r($tags);
		$array_formatos = array();
		$array_temas = array();

		foreach ($tags as $tag) {
			if( $tag->description == 'formato'){
				array_push( $array_formatos, $tag);
			}
			if( $tag->description == 'tema'){
				array_push( $array_temas, $tag);
			}
		}
		?>
		<section class="tags" style="display:none">

			<ul class="labels clearfix" id="tags_single" style="display:none">
				<?php foreach ( $array_formatos as $formato) : ?>
					<li data-tag="<?php echo $formato->slug; ?>"><a><?php echo $formato->name; ?></a></li>
				<?php endforeach; ?>

			</ul><!-- labels -->

			<ul class="labels clearfix" id="tags_single">

				<?php foreach ( $array_temas as $tema) : ?>
					<li data-tag="<?php echo $tema->slug; ?>"><a><?php echo $tema->name; ?></a></li>
				<?php endforeach; ?>
			</ul><!-- labels -->

		</section><!-- tags -->


	<?php get_footer(); ?>