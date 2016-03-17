<?php


// DEFINIR LOS PATHS A LOS DIRECTORIOS DE JAVASCRIPT Y CSS ///////////////////////////



	define( 'JSPATH', get_template_directory_uri() . '/js/' );

	define( 'CSSPATH', get_template_directory_uri() . '/css/' );

	define( 'THEMEPATH', get_template_directory_uri() . '/' );
	
	define( 'SITEURL', site_url('/') );

	define( 'LANG', qtrans_getLanguage() );



// FRONT END SCRIPTS AND STYLES //////////////////////////////////////////////////////


	add_action( 'wp_enqueue_scripts', function(){

		// scripts
		wp_enqueue_script( 'plugins', JSPATH.'plugins.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'functions', JSPATH.'functions.js', array('plugins'), '1.0', true );

		// localize scripts
		wp_localize_script( 'functions', 'ajax_url', admin_url('admin-ajax.php') );
		wp_localize_script( 'functions', 'site_url_localized', SITEURL );
		wp_localize_script( 'functions', 'is_home_localized', is_home() ? 'true' : 'false' );
		wp_localize_script( 'functions', 'is_single_localized', is_single() ? 'true' : 'false' );
		wp_localize_script( 'functions', 'lang_localized', LANG );
		// wp_localize_script( 'functions', 'is_cat', is_category($post->ID) );
		wp_enqueue_script("jquery-ui-accordion");

		// styles
		wp_enqueue_style( 'styles', get_stylesheet_uri() );
		wp_enqueue_style( 'chosen-styles', CSSPATH.'chosen.css' );
		wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );

	});



// ADMIN SCRIPTS AND STYLES //////////////////////////////////////////////////////////



	add_action( 'admin_enqueue_scripts', function(){

		// scripts
		wp_enqueue_script( 'admin-js', JSPATH.'admin.js', array('jquery'), '1.0', true );

		// localize scripts
		wp_localize_script( 'admin-js', 'ajax_url', admin_url('admin-ajax.php') );

		// styles
		wp_enqueue_style( 'admin-css', CSSPATH.'admin.css' );

	});


// INTERNATIONALIZE THEME ////////////////////////////////////////////////////////////



	add_action( 'after_setup_theme', function (){

		load_theme_textdomain('limulus', get_template_directory() . '/languages' );
		apply_filters( 'theme_locale', get_locale(), 'limulus' );

	});



// FRONT PAGE DISPLAYS A STATIC PAGE /////////////////////////////////////////////////



	// add_action( 'after_setup_theme', function () {
		
	//  $frontPage = get_page_by_path('home', OBJECT);
	//  $blogPage  = get_page_by_path('blog', OBJECT);
		
	//  if ( $frontPage AND $blogPage ){
	//      update_option('show_on_front', 'page');
	//      update_option('page_on_front', $frontPage->ID);
	//      update_option('page_for_posts', $blogPage->ID);
	//  }
	// });



// REMOVE ADMIN BAR FOR NON ADMINS ///////////////////////////////////////////////////



	// add_filter( 'show_admin_bar', function($content){
	// 	// return ( current_user_can('administrator') ) ? $content : false;
	// 	return false;
	// });



// CAMBIAR EL CONTENIDO DEL FOOTER EN EL DASHBOARD ///////////////////////////////////



	add_filter( 'admin_footer_text', function() {
		echo 'Creado por <a href="http://hacemoscodigo.com">Los Maquiladores</a>. ';
		echo 'Powered by <a href="http://www.wordpress.org">WordPress</a>';
	});



// POST THUMBNAILS SUPPORT ///////////////////////////////////////////////////////////



	if ( function_exists('add_theme_support') ){
		add_theme_support('post-thumbnails');
	}

	if ( function_exists('add_image_size') ){
		
		add_image_size( 'slider', 805, 140, true );
		
		// cambiar el tamaño del thumbnail
		/*
		update_option( 'thumbnail_size_h', 100 );
		update_option( 'thumbnail_size_w', 200 );
		update_option( 'thumbnail_crop', false );
		*/
	}



// POST TYPES, METABOXES, TAXONOMIES, CUSTOM PAGES, ROUTES AND USERS ////////////////////////////////



	require_once('inc/post-types.php');


	require_once('inc/metaboxes.php');


	require_once('inc/taxonomies.php');


	require_once('inc/pages.php');


	require_once('inc/routes.php');
	
	
	require_once('inc/users.php');



// MODIFICAR EL MAIN QUERY ///////////////////////////////////////////////////////////



	add_action( 'pre_get_posts', function($query){

		//HERE WE WILL APPLY THE FILTERS!!
		if ( $query->is_home() && $query->is_main_query() ) {
			
			//Main query home: 30 posts and exclude featured
			$featured = getfeaturedPost();

			$query->set( 'posts_per_page', 30 );
			$query->set( 'orderby', 'ID' );
			$query->set( 'order', 'DESC' );
			$query->set( 'post_type', 'post');
			$query->set( 'post__not_in', array( $featured->ID ) );
		}

	});



// THE EXECRPT FORMAT AND LENGTH /////////////////////////////////////////////////////



	/*add_filter('excerpt_length', function($length){
		return 20;
	});*/


	/*add_filter('excerpt_more', function(){
		return ' &raquo;';
	});*/



// REMOVE ACCENTS AND THE LETTER Ñ FROM FILE NAMES ///////////////////////////////////



	add_filter( 'sanitize_file_name', function ($filename) {
		$filename = str_replace('ñ', 'n', $filename);
		return remove_accents($filename);
	});

/// REWRITE AUTHOR BASE URL  //////////////////////////////////////////////////////



	function custom_author_base(){
		global $wp_rewrite;
		$wp_rewrite->author_base = 'colaborador';
	}

	add_action('init', 'custom_author_base', 0 );

// HELPER METHODS AND FUNCTIONS //////////////////////////////////////////////////////



	/**
	 * Print the <title> tag based on what is being viewed.
	 * @return string
	 */
	function print_title(){
		global $page, $paged;

		wp_title( '|', true, 'right' );
		bloginfo( 'name' );

		// Add a page number if necessary
		if ( $paged >= 2 || $page >= 2 ){
			echo ' | ' . sprintf( __( 'Pagina %s' ), max( $paged, $page ) );
		}
	}



	/**
	 * Imprime una lista separada por commas de todos los terms asociados al post id especificado
	 * los terms pertenecen a la taxonomia especificada. Default: Category
	 *
	 * @param  int     $post_id
	 * @param  string  $taxonomy
	 * @return string
	 */
	function print_the_terms($post_id, $taxonomy = 'category'){
		$terms = get_the_terms( $post_id, $taxonomy );

		if ( $terms and ! is_wp_error($terms) ){
			$names = wp_list_pluck($terms ,'name');
			echo implode(', ', $names);
		}
	}



	/**
	 * Regresa la url del attachment especificado
	 * @param  int     $post_id
	 * @param  string  $size
	 * @return string  url de la imagen
	 */
	function attachment_image_url($post_id, $size){
		$image_id   = get_post_thumbnail_id($post_id);
		$image_data = wp_get_attachment_image_src($image_id, $size, true);
		echo isset($image_data[0]) ? $image_data[0] : '';
	}



	/**
	 * Imprime active si el string coincide con la pagina que se esta mostrando
	 * @param  string $string
	 * @return string
	 */
	function nav_is($string = ''){
		$query = get_queried_object();

		if( isset($query->slug) AND preg_match("/$string/i", $query->slug)
			OR isset($query->name) AND preg_match("/$string/i", $query->name)
			OR isset($query->rewrite) AND preg_match("/$string/i", $query->rewrite['slug'])
			OR isset($query->post_title) AND preg_match("/$string/i", remove_accents(str_replace(' ', '-', $query->post_title) ) ) )
			echo 'active';
	}

	/**
	 * Regresa un tag y una URL para cambiar el idioma
	 * @param String $class
	 * @return Array
	 */
	function get_qtrans_single($class){

		$lang = qtrans_getLanguage();

		$change_lang_text = ( $lang === 'es' ) ? 'ENG' : 'ES' ; 
		$change_lang      = ( $lang === 'es' ) ? '?lang=en' : '?lang=es' ; 

		$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$change_lang;
		$link = "<a href='http://$url' class='$class'>$change_lang_text</a>";
		
		echo $link;
	}

	/**
	 * Regresa un select box con las categorías existentes con un elemento vacío para permitir a Chosen colocar un placeholder
	 * @param Integer $parent
	 * @param String $placeholder
	 * @param String $class
	 * @param String $url_filter_array
	 * @return DOM element
	 */
	function get_categories_box( $parent = 0, $placeholder, $class, $url_filter_array = NULL ){
		$parent = ( !$parent ) ? 0 : $parent;
		
		$args = array(
			'orderby'            => 'NAME', 
			'order'              => 'ASC',
			'hide_empty'         => false, 
			'parent'           	 => $parent,
			'exclude'            => 1,
			'hierarchical'       => 0, 
			'taxonomy'           => 'category',
			'pad_counts'         => 0
		);
		$categories = get_categories( $args );

		$select_box = "<select data-placeholder='$placeholder' class='$class'>";
		$select_box .= "<option> </option>";

		foreach ($categories as $category) {
			$selected 	 = filter_is_selected( $category->name, $url_filter_array );
			$select_box .= "<option value='{$category->slug}' {$selected} >{$category->name}</option>";
		
			// echo 'Slug: '.$category->slug.'<br />';
			//echo 'Name: '.$category->name.'<br />';
			//echo 'Filter array: '; print_r($url_filter_array);
			// echo '<br />';
		}
		$select_box .= '</select>';
		echo $select_box;
	}


	/**
	 * Regresa el ID de un page dado su slug
	 * @param String $page_slug
	 * @return String $page->ID
	 */
	function get_ID_by_slug($page_slug) {
		$page = get_page_by_path($page_slug);
		if ($page) {
			return $page->ID;
		} else {
			return null;
		}
	}


	/**
	 * Devuelve un arreglo con las categorías jerárquicas de una url
	 * @param String $category_id
	 * @return Array $parents
	 */
	function getParentCategories( $category_id ) {
		
		try {
			$category_parents = get_category_parents( $category_id );
			if( gettype( $category_parents ) !== 'string' ) throw new Exception('No known parent categories \n');

		}catch ( Exception $e ) {

			return  array(
						'coleccion' => '',
						'cajon'     => ''
					);
		}

		$parents_exploded = explode( '/', $category_parents );
		$objeto_categoria = get_term_by('id',$category_id,'category');
		//print_r($objeto_categoria);
		//echo $objeto_categoria->parent;	
		$coleccion_object = get_term_by('id', $objeto_categoria->parent, 'category');
		$coleccion = ( isset($coleccion_object->name) ) ? $coleccion_object->name : '';
		$coleccionslug = ( isset($coleccion_object->name) ) ? $coleccion_object->slug : '';

		$cajon_object = get_term_by('id', $category_id, 'category');
		$cajon = ( isset($cajon_object->name) ) ? $cajon_object->name :  '' ;
		$cajonslug = ( isset($cajon_object->name) ) ? $cajon_object->slug :  '' ;

		$parents = array(
				'coleccion' => $coleccion,
				'cajon'     => $cajon,
				'coleccionslug' => $coleccionslug,
				'cajonslug' => $cajonslug
			);

			return $parents;

	};

	/**
	 * Devuelve un arreglo con las categorias subyacentes a un parent
	 * @param Integer $parent
	 * @return Array $children
	 */
	function getChildCategories( $parent ) {

		$args = array(
			'type'                     => 'post',
			'parent'                   => '',
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 0,
			'hierarchical'             => 0,
			'exclude'                  => '1',
			'taxonomy'                 => 'category'

		); 

		$children_obj = get_categories( $args );

		return $children;
	}


	/**
	 * Imprime selected si el filtro esta presente en la url (Usarlo en cada option de un select)
	 * @param String $compareA
	 * @param Array $compareB_array
	 * @return String 'selected'
	 */
	function filter_is_selected( $compareA, $compareB_array ) {
		
		if ( !isset($compareB_array) ) return;
		
		foreach ($compareB_array as $term) {
			if ( $compareA == $term ){
				return 'selected';
			}
		}

	}

	/**
	 * Trae el último post marcado como featured
	 * @return Object feat_post
	 */
	function getfeaturedPost( ) {
		
		// Get featured post
		$args = array(
			'posts_per_page'   => 1,
			'meta_key'         => '_featured_metabox',
			'meta_value'       => 'is_feat',
			'post_type'        => 'post',
			'post_status'      => 'publish'
		); 

		$feat_post = get_posts( $args );

		return $feat_post[0];

	}

	//agregar metas de idioma inglés a las imágenes
	function metaImgIng( $form_fields, $post ) {
		$campos_extra['img_titulo_ing'] = array(
			'label' => 'Título inglés',
			'input' => 'text',
			'value' => get_post_meta( $post->ID, 'img_titulo_ing', true ),
		);
		
		$campos_extra['img_alt_ing'] = array(
			'label' => 'Texto alternativo inglés',
			'input' => 'text',
			'value' => get_post_meta( $post->ID, 'img_alt_ing', true )
		);
		
		return $campos_extra;
	}
	 
	//add_filter( 'attachment_fields_to_edit', 'metaImgIng', 10, 2 );
	 
	 
	function metaImgIngSave( $post, $attachment ) {
		if( isset( $attachment['img_titulo_ing'] ) )
			update_post_meta( $post['ID'], 'img_titulo_ing', $attachment['img_titulo_ing'] );
			
		if( isset( $attachment['img_alt_ing'] ) )
			update_post_meta( $post['ID'], 'img_alt_ing', $attachment['img_alt_ing'] );
		
		return $post;
	}
	 
	//add_filter( 'attachment_fields_to_save', 'metaImgIngSave', 10, 2 );

	//add_filter( 'image_send_to_editor', 'new_image_send_to_editor', 21, 8 );

	function new_image_send_to_editor( $html, $id, $caption, $title, $align, $url, $size, $alt,$width,$height ) {

		$caption = '<!--:en-->INGLES<!--:--><!--:es-->'.$caption.'<!--:-->';
		$altEdit = '<!--:en-->INGLES<!--:--><!--:es-->'.$alt.'<!--:-->';
		//$title = '<!--:en-->INGLES<!--:--><!--:es-->'.$title.'<!--:-->';
		$salida = preg_replace( '/ alt="(.*?)" /', $altEdit, $html );

		//$salida = __('[caption id="attachment_'.$id.'" align="'.$align.'" width="'.$width.'"]<a href="'.$url.'"><img class="'.$size.'wp-image-1398" '.$altEdit.' src="'.$url.'" width="806" height="659" /></a>'.$caption.'[/caption]');

		return $salida;

	}

	add_filter('next_posts_link_attributes', 'next_link_attributes');
	add_filter('previous_posts_link_attributes', 'prev_link_attributes');

	function prev_link_attributes() {
		return 'class="prev_posts"';
	}
	function next_link_attributes() {
		return 'class="next_posts"';
	}
