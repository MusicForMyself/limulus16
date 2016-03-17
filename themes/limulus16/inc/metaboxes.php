<?php


// CUSTOM METABOXES //////////////////////////////////////////////////////////////////



	add_action('add_meta_boxes', function(){

		add_meta_box( '_featured_metabox', 'Banner Home', 'featured_metabox_callback', 'post', 'side', 'default' );

		add_meta_box( '_piedepag_metabox', 'Pie de página', 'piedepag_metabox_callback', 'post', 'normal', 'default' );

		add_meta_box( '_piedepag_metabox_en', 'Pie de página inglés', 'piedepag_metabox_en_callback', 'post', 'normal', 'default' );

		add_meta_box( '_linkaliado_metabox', 'Link aliado', 'linkaliado_metabox_callback', 'aliado', 'normal', 'default' );

		add_meta_box( '_alt_en', 'Alternativo inglés', 'alt_en_callback', 'attachment', 'normal', 'default' );

	});



// CUSTOM METABOXES CALLBACK FUNCTIONS ///////////////////////////////////////////////

	//Alt para imagenes en inglés
	function alt_en_callback($post){

		$meta = get_post_meta($post->ID, '_alt_en', true);
		
		$alt_en = $meta ? $meta : '' ;
		wp_nonce_field(__FILE__, '_alt_en');

		echo "<label for='featured'> Alt en inglés: </label>";
		echo "<input type='text' id='alt_meta' name='_alt_meta' value='$linkaliado' />";
	}


	//Featured home
	function featured_metabox_callback($post){

		$is_feat = ( get_post_meta($post->ID, '_featured_metabox', true) ) ? 'checked' : '';
		wp_nonce_field(__FILE__, '_featured_metabox_nonce');

		echo "<label for='featured'> Destacado en el home: </label>";
		echo "<input type='checkbox' id='featured' name='_featured_metabox' value='is_feat' $is_feat/>";
	}

	//Pie de pagina
	function piedepag_metabox_callback($post){

		$meta = get_post_meta($post->ID, '_piedepag_metabox', true);

		$piedepag = $meta ? $meta : '' ;

		wp_nonce_field(__FILE__, '_piedepag_metabox_nonce');

		wp_editor( stripslashes($piedepag), 'piedepagmetabox', array( 
			'media_buttons' => false,
			'textarea_name' => '_piedepag_metabox'
		) );


	}

	function piedepag_metabox_en_callback($post){

		$meta_en = get_post_meta($post->ID, '_piedepag_metabox_en', true);

		$piedepag_en = $meta_en ? $meta_en : '' ;

		wp_nonce_field(__FILE__, '_piedepag_metabox_en_nonce');

		wp_editor( stripslashes($piedepag_en), 'piedepagmetabox_en', array( 
			'media_buttons' => false,
			'textarea_name' => '_piedepag_metabox_en'
		) );


	}

	//Link para aliados
	function linkaliado_metabox_callback($post){

		$meta = get_post_meta($post->ID, '_linkaliado_metabox', true);

		$linkaliado = $meta ? $meta : '' ;

		wp_nonce_field(__FILE__, '_linkaliado_metabox_nonce');

		echo "<label for='linkaliado'> Link aliado: </label>";
		echo "<input type='text' id='linkaliado' name='_linkaliado_metabox' value='$linkaliado' size='70' />";

	}


// SAVE METABOXES DATA ///////////////////////////////////////////////////////////////



	add_action('save_post', function($post_id){


		if ( ! current_user_can('edit_page', $post_id)) 
			return $post_id;


		if ( defined('DOING_AUTOSAVE') and DOING_AUTOSAVE ) 
			return $post_id;
		
		
		if ( wp_is_post_revision($post_id) OR wp_is_post_autosave($post_id) ) 
			return $post_id;


		if ( isset($_POST['_piedepag_metabox']) and check_admin_referer(__FILE__, '_piedepag_metabox_nonce') ){
			update_post_meta($post_id, '_piedepag_metabox', $_POST['_piedepag_metabox']);
		}

		if ( isset($_POST['_piedepag_metabox_en']) and check_admin_referer(__FILE__, '_piedepag_metabox_en_nonce') ){
			update_post_meta($post_id, '_piedepag_metabox_en', $_POST['_piedepag_metabox_en']);
		}

		// Guardar correctamente los checkboxes
		if ( isset($_POST['_featured_metabox']) and check_admin_referer(__FILE__, '_featured_metabox_nonce') ){
			update_post_meta($post_id, '_featured_metabox', $_POST['_featured_metabox']);
		}

		// Guardar clink de aliado
		if ( isset($_POST['_linkaliado_metabox']) and check_admin_referer(__FILE__, '_linkaliado_metabox_nonce') ){
			update_post_meta($post_id, '_linkaliado_metabox', $_POST['_linkaliado_metabox']);
		}


	});



// OTHER METABOXES ELEMENTS //////////////////////////////////////////////////////////
