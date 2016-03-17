	<?php get_header(); 

	the_post();?>
	<!-- Insert content here -->
		
		<section class="feed_container clearfix">

			<header class="feed_header clearfix no_480">

				<div class="filters clearfix">
					<form action="">

						<select data-placeholder="colección" class="chosen-select-50">
							<option value=""></option>
							<option value="">El hombre y la naturaleza</option>
							<option value="">Huellas</option>
							<option value="">Migraciones</option>
							<option value="">Visiones</option>
						</select>

						<select data-placeholder="cajón" class="chosen-select-50 light">
							<option value=""></option>
							<option value="">Símbolos</option>
							<option value="">Piratería</option>
							<option value="">Fósiles</option>
							<option value="">Colecciones</option>
						</select>
					</form>
				</div><!-- filters -->

				<section class="navigator">
					<a href="" class="arrow left"></a>
					<a href="" class="arrow right disabled"></a>
				</section><!-- navigator -->

			</header>

			<article class="single_post">

				<!-- <?php the_post_thumbnail( ); ?> -->
				<h1><?php the_title(); ?></h1>
				<hr class="divider">

				<section class="main_content">
					<?php the_content(); ?>
				</section>
				
				<hr class="divider">
				<section class="mas_posts">
					<h4>Más artículos en Huellas > símbolos</h4>
					<?php
					for( $i=0; $i<4; $i++){
					?>
						<article class="each_post">

							<img class="blur_this" src="<?php echo THEMEPATH; ?>images/thumb.jpg" >
							<h3>Del campo a la ciudad al campo</h3>
							<p>Jamex</p>
						</article><!-- each_post -->
					<?php
					}
					?>
				</section>
				
			</article><!-- each_post -->

			<hr class="divider full_width" />

				<div class="banner_fonca">
					<a href="http://fonca.conaculta.gob.mx/" target="_blank">
						<img src="<?php echo THEMEPATH; ?>/images/banners/segundo_encuentro_limulus.gif">
					</a>
				</div>
	
		</section><!-- feed_container -->
	
	
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>