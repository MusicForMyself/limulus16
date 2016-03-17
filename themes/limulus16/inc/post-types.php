<?php


// CUSTOM POST TYPES /////////////////////////////////////////////////////////////////


	add_action('init', function(){


		// aliadoS
		$labels = array(
			'name'          => 'Aliados',
			'singular_name' => 'Aliado',
			'add_new'       => 'Nuevo aliado',
			'add_new_item'  => 'Nuevo aliado',
			'edit_item'     => 'Editar aliado',
			'new_item'      => 'Nuevo aliado',
			'all_items'     => 'Todas',
			'view_item'     => 'Ver aliado',
			'search_items'  => 'Buscar aliado',
			'not_found'     => 'No se encontro',
			'menu_name'     => 'Aliados'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'aliados' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);
		register_post_type( 'aliado', $args );

	});