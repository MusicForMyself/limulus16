	<?php get_header(); ?>


	<!-- Insert content here -->

		<section class="feed_container clearfix">

			<article class="single_post que_somos ">

				<h1><?php _e('¿Qué somos?', 'limulus'); ?></h1>
					
				
				<section id="sobre_limulus" class="clearfix">
					<h3 class=""><?php _e('Sobre Límulus', 'limulus'); ?></h3>
					<?php

					$args = array(
					    'post_type' => 'attachment',
					    'numberposts' => null,
					    'post_status' => null,
					    'post_parent' => get_ID_by_slug('que-somos/sobre-limulus'),
					    'exclude'     => get_post_thumbnail_id()
					);
					$attachments = get_posts( $args );
					?>
					<section class="gallery no_480 clearfix">
						<img class="gallery_view" src="" alt="">
						<ul class="thumbnail_container clearfix">
					<?php
						if ($attachments) {
						    foreach ($attachments as $attachment) {
						    	$link_array = wp_get_attachment_image_src($attachment->ID, 'thumbnail');
						    	$link = $link_array[0];

						    	$link_full_array = wp_get_attachment_image_src($attachment->ID, 'large');
						    	$link_full       = $link_full_array[0];
						        echo "<li class='gallery_thumbnail margin_right_1' data-full='$link_full'><img src='".$link."' alt=''></li>";
						    }
						}
					?>
						</ul>
						<div class="clearfix"></div>
					</section><!-- gallery -->

					
					<article>

						<?php
						wp_reset_postdata();
							$subpage = get_page_by_path( 'que-somos/sobre-limulus' );

							echo     apply_filters('the_content', $subpage->post_content);

						?>

					</article>
				</section><!-- sobre_limulus -->

					

				
				<section id="quienes_somos" class="clearfix">
					<h3 ><?php _e('Quiénes somos', 'limulus'); ?></h3>
					<div class="socios clearfix">
						<img src="http://placehold.it/806x536">
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
				<?php /*
					<hr class="divider no_480 full_width">
				<h3 class="solo_480"><?php _e('Nuestros Aliados', 'limulus'); ?></h3>
				<section id="nuestros_aliados" class="clearfix">
					<h3 class="no_480"><?php _e('Nuestros Aliados', 'limulus'); ?></h3>

					<?php

					$args = array(
						'post_type'    => 'aliado',
						'orderby'      => 'post_date',
						'order'        => 'ASC'
					);

					$aliados = get_posts( $args );

					foreach ($aliados as $aliado) {
						$pic = get_the_post_thumbnail( $aliado->ID );
						$link_aliado = get_post_meta($aliado->ID,'_linkaliado_metabox',true);
						$post_title = qtrans_use('es', $aliado->post_title, false);
						$post_content = qtrans_use('es', $aliado->post_content, false);
						echo <<<HTML

					<article class="contact long margin_right">
						<a href="$link_aliado" target="_blank">
							$pic
						</a>
						<h4>$post_title</h4>
						<p class="no_320">$post_content</p>
					</article>

HTML;
					}

					*/ ?>



				</section><!-- nuestros_aliados -->

					
				<!-- <h3 class="solo_480"><?php _e('Contáctanos', 'limulus'); ?></h3>
				<section id="contactanos" class="clearfix">
					<h3 class="no_480"><?php _e('Contáctanos', 'limulus'); ?></h3>
					<a class="email_contacto" href="mailto:hola@limulus.mx">hola@limulus.mx</a>

					<ul class="social_bar solo_480 clearfix">
						<li class="twitter"><a href="https://twitter.com/limulus_mx"></a></li>
						<li class="facebook"><a href="http://www.facebook.com/revistalimulus"></a></li>
						<li class="tumblr"><a href="http://limulusmx.tumblr.com/"></a></li>
						<li class="instagram"><a href="http://instagram.com/limulusmx"></a></li>
					</ul>

				</section> --> 
				
				<?php /*
				<hr class="divider full_width" />
				
				<div class="banner_fonca">
					<a href="http://fonca.conaculta.gob.mx/" target="_blank">
						<img src="<?php echo THEMEPATH; ?>/images/banners/segundo_encuentro_limulus.gif">
					</a>
				</div>
				*/ ?>
			</article><!-- each_post -->
			
		</section><!-- feed_container -->

	<?php get_footer(); ?>