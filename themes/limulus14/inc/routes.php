<?php 

/*

██████╗  ██████╗ ██╗   ██╗████████╗███████╗███████╗
██╔══██╗██╔═══██╗██║   ██║╚══██╔══╝██╔════╝██╔════╝
██████╔╝██║   ██║██║   ██║   ██║   █████╗  ███████╗
██╔══██╗██║   ██║██║   ██║   ██║   ██╔══╝  ╚════██║
██║  ██║╚██████╔╝╚██████╔╝   ██║   ███████╗███████║
╚═╝  ╚═╝ ╚═════╝  ╚═════╝    ╚═╝   ╚══════╝╚══════╝
                                                   
*/
//$slim = new \Slim\Slim();

//Category, Subcategory
//


add_action( 'slim_mapping', function( $slim ) {



	$slim->get('/coleccion/:coleccion+/', function( $coleccion ) { 

		global $request_variables;

		$request_variables = $coleccion;
		
		//Remove empty last element
		if( !empty( $request_variables ) ) unset( $request_variables[count($request_variables)-1]);
		
	});

	// $slim->get('/coleccion/tags/:tags+/', function( $tags ) { 
	// 	$request_tags = $tags;
		
	// 	//Remove empty last element
	// });

});

