<?php get_header(); ?>

	
	<?php  
	global $myposts;
	
	//Original filters
	//Array( 'coleccion' => $value, 'cajon' => $value2)
	
	$this_cat =  $myposts->cat;
	$parent   = ( $myposts->parent) ? $myposts->parent : $myposts->cat ;
	$filters  = getParentCategories( $this_cat );
	
	?>

	<section class="feed_container clearfix">

		<header class="feed_header">

			<div class="filters clearfix">
				<form id="level_2_filter" action="">

					<?php get_categories_box( '', 'colección', 'chosen-select-50', $filters ); ?>

					<?php 
					if( $parent ){
						
						get_categories_box( $parent, 'cajón', 'chosen-select-50 light', $filters ); 
					}else{
						
						get_categories_box( '', 'cajón', 'chosen-select-50 light disabled', $filters );
					}
					?>

				</form><!-- level_2_filter -->
			</div><!-- filters -->

		</header>

	<?php if ( ! empty($myposts->posts) ) : foreach ($myposts->posts as $post) : setup_postdata( $post ); ?>    

		<article class="each_post">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'blur_this' ) ); ?>
				<h3><?php the_title(); ?></h3>
			</a>
		</article><!-- each_post -->

		

	<?php endforeach; ?>
	<?php $post_count = $wp_query->post_count; ?>
	<?php while( $post_count % 5 !== 0) : ?>

		<article class="each_post fake">
			
		</article>
		
	<?php $post_count++; endwhile; ?>
	<?php else: ?>
		<p class="no_post_error">:€-- <br><?php _e('Los filtros seleccionados no obtuvieron ningún resultado', 'limulus'); ?></p>
		<a href="<?php echo site_url(); ?>" class="linkhome"><?php _e('Ir al inicio', 'limulus'); ?></a>
	<?php endif; ?>

		<?php echo get_previous_posts_link( '<i class="fa fa-caret-left"></i> anterior' ); ?>
		<?php echo get_next_posts_link( 'siguiente <i class="fa fa-caret-right"></i>' ); ?>
	</section><!-- feed_container -->



<?php get_footer(); ?>