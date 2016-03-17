<?php

	//Here we catch the routes
	global $request_variables;	
	global $request_tags;
	
	switch( count($request_variables) ){
		case 1:
			
			getCategoryPage( $request_variables[0] );
			break;

		case 2:
			
			getSubCategoryPage( $request_variables );
			break;

		default:
			if ( count( $request_variables ) > 2 ) {
				$tags = $request_variables;

				//Quitar filtros nivel 1 y 2
				unset($tags[0]);
				unset($tags[1]);
				$tags = array_values( $tags );
				$tag_ids = array();
				
				foreach ($tags as $tag) {

					$tag_object = get_term_by('slug', $tag, 'post_tag');
					if( $tag_object ) array_push( $tag_ids, $tag_object->term_id);
				}
				$request_tags = ( $tag_ids ) ? $tag_ids : '';
				
				getSubCategoryPage( $request_variables, $request_tags );
				break;
			}
			break;
	}

	// Parent Category (Coleccion)
	function getCategoryPage( $category_slug ){

		global $myposts;
		$myposts = new stdClass();
		$category_obj = get_category_by_slug( $category_slug );

		if( ! $category_obj ) {

			$myposts->posts = array();
			$myposts->cat = array();
			$myposts->parent = array();
			get_template_part( 'category' );
			return;
		}
		$category_id = $category_obj->term_id;

		$myposts = executeQuery( $category_id );
		
		get_template_part( 'category' );
	}


	// SubCategory (Abrir un Cajón)
	// category_slug es un array de terminos
	function getSubCategoryPage( $filters, $tags = '' ){
		
		global $myposts;
		$myposts = new stdClass();
		$tags = ( $tags ) ? $tags : '' ;


		
		if( $filters[0] === 'limulus' ){

			$myposts = executeQuery( 0, $tags);
			get_template_part( 'category' );
			return;
		}
		

		$category_object = get_category_by_slug( $filters[0] );
		$category_id     = $category_object->term_id;

		// Validation
		if( $filters[1] !== 'cajon-general' ){

			$category_object = get_category_by_slug( $filters[1] );
			$category_id 	 = $category_object->term_id;
		}
		
		$myposts = executeQuery( $category_id, $tags );

		get_template_part( 'category' );
	}


	function executeQuery($category = 0, $tags = ''){
		$myposts = new stdClass();

		$myposts->posts = array();
		$myposts->cat = array();
		$myposts->parent = array();

		$category_object = get_category( $category );


		$args = array(
			'post_type'    		=> 'post',
			'category'     		=> $category,
			'posts_per_page'    => 20,
			'orderby'      		=> 'name',
			'order'        		=> 'ASC',
			'tag__and'           => $tags
		);
		
		$myposts->posts = get_posts( $args );

		if( !is_wp_error( $category_object ) ){
			
			$myposts->cat = $category_object->term_id;
			$myposts->parent = $category_object->parent;

		}
		return $myposts;

	}

