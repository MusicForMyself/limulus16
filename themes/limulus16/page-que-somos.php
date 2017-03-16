	<?php get_header(); ?>


	<!-- Insert content here -->

		<section class="feed_container clearfix">

			<article class="single_post que_somos ">

				<h1><?php _e('¿Qué somos?', 'limulus'); ?></h1>
					
				
				<section id="sobre_limulus" class="clearfix">
					<h3 class=""><?php _e('Sobre Límulus', 'limulus'); ?></h3>

					<article>
					<?php
						wp_reset_postdata();
							$subpage = get_page_by_path( 'que-somos/sobre-limulus' ); ?>
					
						<figure id="qsomosFeaturedImage" class="head_image">
							<?php echo get_the_post_thumbnail($subpage->ID, 'full'); ?>
						</figure>

						<?php echo apply_filters('the_content', $subpage->post_content); ?>

					</article>

				</section><!-- sobre_limulus -->
				
				<section id="quienes_somos" class="clearfix">
					<h3 ><?php _e('Quiénes somos', 'limulus'); ?></h3>
					<div class="socios clearfix">
						<figure id="sociosFeaturedImage" class="head_image">
							<img src="http://placehold.it/806x536">
						</figure>
						
						<div class="socio">
							<h4>Andrea Ruy Sánchez</h4>
							<span><a target="_blank" href="http://andrearuy.com">andrearuy.com</a></span>
							<span><a target="_blank" href="http://twitter.com/andrearuy">@andrearuy</a></span>
						</div>
						<div class="socio">
							<h4>Priscila Vanneuville</h4>
							<span><a target="_blank" href="http://prisci.la">prisci.la</a></span>
							<span><a target="_blank" href="http://palabraslugar.tumblr.com">palabraslugar.tumblr</a></span>
						</div>
					</div>

					


				</section><!-- quienes_somos -->
	
				<section id="agradecimientos">

					<article>

					<h3 class=""><?php _e('Agradecimientos', 'limulus'); ?></h3>

						<?php
						wp_reset_postdata();
							$subpage = get_page_by_path( 'que-somos/agradecimientos' );

							echo     apply_filters('the_content', $subpage->post_content);

						?>

					</article>

				</section>

				<section id="contactanos">

					<article>

					<h3 class=""><?php _e('Contáctanos', 'limulus'); ?></h3>

						<p><a class="mailto" href="mailto:hola@limulus.mx">hola@limulus.mx</a> </br> </br> </br></p>

					</article>

				</section>
				
					
			</article><!-- each_post -->
			
		</section><!-- feed_container -->

	<?php get_footer(); ?>