<?php


// CUSTOM PAGES //////////////////////////////////////////////////////////////////////


	add_action('init', function(){

		// Routes
		if( ! get_page_by_path('routes') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Routes',
				'post_name'   => 'routes',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );

			$parent = get_ID_by_slug('routes');

		}

		// Que somos
		if( ! get_page_by_path('que-somos') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Qué somos',
				'post_name'   => 'que-somos',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );

			$parent = get_ID_by_slug('que-somos');

			// Agradecimientos
			if( ! get_page_by_path('agradecimientos') ){
				$page = array(
					'post_author' => 1,
					'post_status' => 'publish',
					'post_title'  => 'Agradecimientos',
					'post_name'   => 'agradecimientos',
					'post_type'   => 'page',
					'post_parent' => $parent
				);

				wp_insert_post( $page, true );
			}


			// Sobre limulus
			if( ! get_page_by_path('sobre-limulus') ){
				$page = array(
					'post_author' => 1,
					'post_status' => 'publish',
					'post_title'  => 'Sobre Límulus',
					'post_name'   => 'sobre-limulus',
					'post_type'   => 'page',
					'post_parent' => $parent
				);
				wp_insert_post( $page, true );
			}

			
		}

		
		// Info
		if( ! get_page_by_path('info') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Información',
				'post_name'   => 'info',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );

			$parent = get_ID_by_slug('info');

			// Aviso de privacidad
			if( ! get_page_by_path('aviso-privacidad') ){
				$page = array(
					'post_author' => 1,
					'post_status' => 'publish',
					'post_title'  => 'Aviso de privacidad',
					'post_name'   => 'aviso-privacidad',
					'post_type'   => 'page',
					'post_parent' => $parent
				);
				wp_insert_post( $page, true );
			}

			// Aviso de privacidad
			if( ! get_page_by_path('derechos-autor') ){
				$page = array(
					'post_author' => 1,
					'post_status' => 'publish',
					'post_title'  => 'Información sobre derechos de autor',
					'post_name'   => 'info-derechos-autor',
					'post_type'   => 'page',
					'post_parent' => $parent
				);
				wp_insert_post( $page, true );
			}
		}


	});
