<?php


// TAXONOMIES ////////////////////////////////////////////////////////////////////////


	add_action( 'init', 'custom_taxonomies_callback', 0 );

	function custom_taxonomies_callback(){

		// AUTORES
		/*if( ! taxonomy_exists('autores')){

			$labels = array(
				'name'              => 'Autores',
				'singular_name'     => 'Autor',
				'search_items'      => 'Buscar',
				'all_items'         => 'Todos',
				'edit_item'         => 'Editar Autor',
				'update_item'       => 'Actualizar Autor',
				'add_new_item'      => 'Nuevo Autor',
				'new_item_name'     => 'Nombre Nuevo Autor',
				'menu_name'         => 'Autores'
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'autores' ),
			);

			register_taxonomy( 'autor', 'libro', $args );
		}*/
		
		
		// TERMS JERÁRQUICOS
		if ( ! term_exists( 'El Hombre y la Naturaleza', 'category' ) ){
			$term_id_hombre = wp_insert_term( 'El Hombre y la Naturaleza', 'category' );
		}
			
			if ( ! term_exists( 'Elementos', 'category' && isset( $term_id_hombre['term_id'] ) ) ){
				wp_insert_term( 'Elementos', 'category', array(
				    'parent' => $term_id_hombre['term_id'] ) );
			}
			if ( ! term_exists( 'Tiempo', 'category' && isset( $term_id_hombre['term_id'] ) ) ){
				wp_insert_term( 'Tiempo', 'category', array(
				    'parent' => $term_id_hombre['term_id'] ) );
			}
			if ( ! term_exists( 'Representación', 'category' && isset( $term_id_hombre['term_id'] ) ) ){
				wp_insert_term( 'Representación', 'category', array(
				    'parent' => $term_id_hombre['term_id'] ) );
			}
			
		if ( ! term_exists( 'Huellas', 'category' ) ){
			$term_id_huellas = wp_insert_term( 'Huellas', 'category' );
		}
			if ( ! term_exists( 'Símbolos', 'category' && isset( $term_id_hombre['term_id'] ) ) ){
				wp_insert_term( 'Símbolos', 'category', array(
				    'parent' => $term_id_huellas['term_id'] ) );
			}
			if ( ! term_exists( 'Piratería', 'category' && isset( $term_id_hombre['term_id'] ) ) ){
				wp_insert_term( 'Piratería', 'category', array(
				    'parent' => $term_id_huellas['term_id'] ) );
			}
			if ( ! term_exists( 'Fósiles', 'category' && isset( $term_id_hombre['term_id'] ) ) ){
				wp_insert_term( 'Fósiles', 'category', array(
				    'parent' => $term_id_huellas['term_id'] ) );
			}
			if ( ! term_exists( 'Colecciones', 'category' && isset( $term_id_hombre['term_id'] ) ) ){
				wp_insert_term( 'Colecciones', 'category', array(
				    'parent' => $term_id_huellas['term_id'] ) );
			}

		if ( ! term_exists( 'Migraciones', 'category' ) ){
			$term_id_migraciones = wp_insert_term( 'Migraciones', 'category' );
		}
			if ( ! term_exists( 'Peregrinaciones', 'category' && isset( $term_id_migraciones['term_id'] ) ) ){
				wp_insert_term( 'Peregrinaciones', 'category', array(
				    'parent' => $term_id_migraciones['term_id'] ) );
			}
			if ( ! term_exists( 'Mexicanos en el extranjero', 'category' && isset( $term_id_migraciones['term_id'] ) ) ){
				wp_insert_term( 'Mexicanos en el extranjero', 'category', array(
				    'parent' => $term_id_migraciones['term_id'] ) );
			}
			if ( ! term_exists( 'Frontera', 'category' && isset( $term_id_migraciones['term_id'] ) ) ){
				wp_insert_term( 'Frontera', 'category', array(
				    'parent' => $term_id_migraciones['term_id'] ) );
			}
			if ( ! term_exists( 'Extranjeros en México', 'category' && isset( $term_id_migraciones['term_id'] ) ) ){
				wp_insert_term( 'Extranjeros en México', 'category', array(
				    'parent' => $term_id_migraciones['term_id'] ) );
			}

		if ( ! term_exists( 'Visiones', 'category' ) ){
			$term_id_visiones = wp_insert_term( 'Visiones', 'category' );
		}
			if ( ! term_exists( 'Reflejos y espejísmos', 'category' && isset( $term_id_visiones['term_id'] ) ) ){
				wp_insert_term( 'Reflejos y espejísmos', 'category', array(
				    'parent' => $term_id_visiones['term_id'] ) );
			}
			if ( ! term_exists( 'Sombras', 'category' && isset( $term_id_visiones['term_id'] ) ) ){
				wp_insert_term( 'Sombras', 'category', array(
				    'parent' => $term_id_visiones['term_id'] ) );
			}
			if ( ! term_exists( 'Colores y luz', 'category' && isset( $term_id_visiones['term_id'] ) ) ){
				wp_insert_term( 'Colores y luz', 'category', array(
				    'parent' => $term_id_visiones['term_id'] ) );
			}
			if ( ! term_exists( 'Visiones sobre México', 'category' && isset( $term_id_visiones['term_id'] ) ) ){
				wp_insert_term( 'Visiones sobre México', 'category', array(
				    'parent' => $term_id_visiones['term_id'] ) );
			}
		
		

		//FORMATOS
		if ( ! term_exists( 'Video', 'post_tag' ) ){
			wp_insert_term( 'Video', 'post_tag', array( 'description'=> 'formato', 'slug' => 'video') );
		}
		if ( ! term_exists( 'Fotorreportaje', 'post_tag' ) ){
			wp_insert_term( 'Fotorreportaje', 'post_tag', array( 'description'=> 'formato', 'slug' => 'fotorreportaje') );
		}
		if ( ! term_exists( 'Ilustración', 'post_tag' ) ){
			wp_insert_term( 'Ilustración', 'post_tag', array( 'description'=> 'formato', 'slug' => 'ilustracion') );
		}
		if ( ! term_exists( 'Texto', 'post_tag' ) ){
			wp_insert_term( 'Texto', 'post_tag', array( 'description'=> 'formato', 'slug' => 'texto') );
		}
		if ( ! term_exists( 'Entrevista', 'post_tag' ) ){
			wp_insert_term( 'Entrevista', 'post_tag', array( 'description'=> 'formato', 'slug' => 'entrevista') );
		}

		//TEMAS
		if ( ! term_exists( 'Ciudad', 'post_tag' ) ){
			wp_insert_term( 'Ciudad', 'post_tag', array( 'description'=> 'tema', 'slug' => 'ciudad') );
		}
		if ( ! term_exists( 'Cultura', 'post_tag' ) ){
			wp_insert_term( 'Cultura', 'post_tag', array( 'description'=> 'tema', 'slug' => 'cultura') );
		}
		if ( ! term_exists( 'Innovación', 'post_tag' ) ){
			wp_insert_term( 'Innovación', 'post_tag', array( 'description'=> 'tema', 'slug' => 'innovacion') );
		}
		if ( ! term_exists( 'Ciencia', 'post_tag' ) ){
			wp_insert_term( 'Ciencia', 'post_tag', array( 'description'=> 'tema', 'slug' => 'ciencia') );
		}
		if ( ! term_exists( 'Actualidad', 'post_tag' ) ){
			wp_insert_term( 'Actualidad', 'post_tag', array( 'description'=> 'tema', 'slug' => 'actualidad') );
		}



		delete_option("category_children");
	}
