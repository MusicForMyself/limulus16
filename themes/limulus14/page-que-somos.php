	<?php get_header(); ?>
	<?php get_sidebar('que-somos'); ?>

	<!-- Insert content here -->

		<section class="feed_container clearfix">

			<article class="single_post que_somos mobile_accordion">

				<h1><?php _e('Qué somos', 'limulus'); ?></h1>
					<hr class="divider no_480 full_width">
				<h3 class="solo_480"><?php _e('Sobre Límulus', 'limulus'); ?></h3>
				<section id="sobre_limulus" class="clearfix">
					<h3 class="no_480"><?php _e('Sobre Límulus', 'limulus'); ?></h3>
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

					<section id="cycle_gallery" class="gallery solo_480">
						<ul class="cycle-container clearfix">
					<?php
						if ($attachments) {
						    foreach ($attachments as $attachment) {

						    	$link_full_array = wp_get_attachment_image_src($attachment->ID, 'large');
						    	$link_full       = $link_full_array[0];
						        echo "<li><img src='".$link_full."'></li>";
						    }
						}
					?>
						</ul>
					</section><!-- gallery -->

					<article>

						<?php
						wp_reset_postdata();
							$subpage = get_page_by_path( 'que-somos/sobre-limulus' );

							echo     apply_filters('the_content', $subpage->post_content);

						?>

					</article>
				</section><!-- sobre_limulus -->

					<hr class="divider no_480 full_width">

				<h3 class="solo_480"><?php _e('Quiénes somos', 'limulus'); ?></h3>
				<section id="quienes_somos" class="clearfix">
					<h3 class="no_480"><?php _e('Quiénes somos', 'limulus'); ?></h3>
					<div class="socios clearfix">
					<?php
					$args = array(
							'meta_key'     => 'es_socio',
							'meta_compare' => '=',
							'meta_value'   => 'on',
							'orderby'      => 'name',
							'order'        => 'ASC'
						 );

						$users = get_users( $args );

						foreach ( $users as $user ) {
							$twitter_html = '';
							$themepath = THEMEPATH;
							$user_meta = get_user_meta( $user->ID );
							$name = $user_meta['first_name'][0] . ' ' . $user_meta['last_name'][0];
							$twitter = $user_meta['twitter'][0];
							$web = get_user_meta($user->ID,'user_url', TRUE);
							$pic = $user_meta['foto_colaborador'][0];
							
							if($user_meta['twitter'][0] !== '') $twitter_html = "<a target='_blank' href='http://twitter.com/$twitter'>@$twitter</a>";

							echo <<<HTML
							<article class="contact square margin_right">
								<img src="$pic">
								<h4>$name</h4>
								<p class="no_320">
								$twitter_html
								<br><a target="_blank" href="$web">$web</a>
								</p>
							</article>
HTML;
						}
						 ?>
						</div>

					<?php
					$args = array(
							'meta_key'     => 'es_colaborador',
							'meta_compare' => '=',
							'meta_value'   => 'on',
							'orderby'      => 'name',
							'order'        => 'ASC'
						 );

						$users = get_users( $args );

						foreach ( $users as $user ) {
							$twitter_html = '';
							$themepath = THEMEPATH;
							$user_meta = get_user_meta( $user->ID );
							$name = $user_meta['first_name'][0] . ' ' . $user_meta['last_name'][0];
							$twitter = $user_meta['twitter'][0];
							$web = get_user_meta($user->ID,'user_url', true);
							$pic = $user_meta['foto_colaborador'][0];
							
							if($user_meta['twitter'][0] !== '') $twitter_html = "<a target='_blank' href='http://twitter.com/$twitter'>@$twitter</a>";

							echo <<<HTML
							<article class="contact square margin_right">

								<img src="$pic">
								<h4>$name</h4>
								<p class="no_320">
								$twitter_html
								<br><a target="_blank" href="$web">$web</a>
								</p>
							</article>
HTML;
						}
						 ?>


				</section><!-- quienes_somos -->
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

					<hr class="divider no_480 full_width">
				<h3 class="solo_480"><?php _e('Contáctanos', 'limulus'); ?></h3>
				<section id="contactanos" class="clearfix">
					<h3 class="no_480"><?php _e('Contáctanos', 'limulus'); ?></h3>
					<a class="email_contacto" href="mailto:hola@limulus.mx">hola@limulus.mx</a>

					<ul class="social_bar solo_480 clearfix">
						<li class="twitter"><a href="https://twitter.com/limulus_mx"></a></li>
						<li class="facebook"><a href="http://www.facebook.com/revistalimulus"></a></li>
						<li class="tumblr"><a href="http://limulusmx.tumblr.com/"></a></li>
						<li class="instagram"><a href="http://instagram.com/limulusmx"></a></li>
					</ul><!-- social_bar -->

				</section><!-- contactanos -->
				
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