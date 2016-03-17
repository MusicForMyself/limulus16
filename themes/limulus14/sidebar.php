<aside id="main_sidebar" class="sidebar side_tags no_480 no_320">
	<div class="fixed_target">
		<h4><?php _e('etiquetas', 'limulus'); ?></h4>
		<?php
		$tags = get_tags( array(
				'hide_empty' => false
			) );
		
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
		<section class="tags">

			<ul class="labels clearfix">
				<?php foreach ( $array_formatos as $formato) : ?>
					<li data-tag="<?php echo $formato->slug; ?>"><a><?php echo $formato->name; ?></a></li>
				<?php endforeach; ?>
				
			</ul><!-- labels -->

			<ul class="labels clearfix">

				<?php foreach ( $array_temas as $tema) : ?>
					<li data-tag="<?php echo $tema->slug; ?>"><a><?php echo $tema->name; ?></a></li>
				<?php endforeach; ?>
			</ul><!-- labels -->

		</section><!-- tags -->

		<a class="clean_filters" href="<?php echo qtrans_converturl(site_url()); ?>"><?php _e('limpiar', 'limulus'); ?></a>
	</div><!-- fixed_target -->
</aside><!-- main_sidebar -->