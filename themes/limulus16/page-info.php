<?php 
	get_header(); 

	get_sidebar('info');

	the_post();
?>

<!-- Insert content here -->
	
	<section class="feed_container clearfix">


		<article class="single_post info">

		<?php 
			global $pages;
			$page_ID = get_ID_by_slug('info');
			
			$args = array(
				'sort_order'  => 'ASC',
				'sort_column' => 'post_title',
				'parent' => $page_ID,
				'exclude'     => $page_ID,
				'post_type'   => 'page',
				'post_status' => 'publish'
			); 

			//Get children pages
			$pages = get_pages($args);

				foreach ( $pages as $key => $page ) {
					$formatted_content = apply_filters('the_content',$page->post_content);
					echo <<< HTML
			
			<section id='{$page->post_name}' class='{$page->post_name}'>
				<h3>{$page->post_title}</h3>

				<article> {$formatted_content} </article>
			</section><!-- sobre_limulus -->

HTML;
			if( $key !== count($pages)-1 ) echo '<hr class="divider full_width">';

				}

			?>

			<hr class="divider full_width" />

				<div class="banner_fonca">
					<a href="http://fonca.conaculta.gob.mx/" target="_blank">
						<img src="<?php echo THEMEPATH; ?>/images/banners/segundo_encuentro_limulus.gif">
					</a>
				</div>


		</article><!-- each_post -->

	</section><!-- feed_container -->


<?php get_footer(); ?>