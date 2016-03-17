<?php
/* Plugin name: Crop freatured Image
   Author: alejandro cervantes
   Author URI: https://twitter.com/aCervantes_S
   Version: 1.0
   Description: Corta la imagen destacada del post desde un punto en especifico, realiza un corte diferente para cada tamaño de imagen.
   Text Domain: Crop-images
*/

    // DEFINIR LOS PATHS  ///////////////////////////

	define( 'PATH_PLUGINURL', plugins_url(basename( dirname(__FILE__))) . "/");
	define( 'PATH_PLUGINPATH', dirname(__FILE__) . "/");
	define( 'PATH_VERSION', "1.0");

	require_once('php/ajax.php');

	/**
	 * Inicialisa cropthumb en el post.
	 */


	function init_cropthumb() {
	    new cropthumb();
	}


	if ( is_admin() ) {
	    add_action( 'load-post.php', 'init_cropthumb' );
	    //add_action( 'load-post-new.php', 'new_size_image' );
	}


	class cropthumb {


		public function __construct() {
			add_filter( 'admin_post_thumbnail_html', array( $this, 'custom_admin_post_thumbnail_html') );
		}

		/**
		 * Coloca link para crop de imagen
		 */
		public function custom_admin_post_thumbnail_html( $content ) {
			global $post;
			wp_enqueue_script( 'imgareaselect2' , PATH_PLUGINURL . 'js/imgareaselect.js' , array('underscore') , PATH_VERSION );
			wp_enqueue_script( 'cropthumb' , PATH_PLUGINURL . 'js/cropthumb.js' , array('imgareaselect2') , PATH_VERSION );
			wp_enqueue_style('cropthumb-css', PATH_PLUGINURL . 'css/cropthumb.css');

			$thumb_id = get_post_thumbnail_id( $post->ID);

			$url_image  = $this->url_thumb_freatured($thumb_id);

			$name_image = $this->name_thum_freatured($url_image);

			$select_sizes = $this->select_sizes_thum();

		    return $content .= '<div id="cont-bt-crop"><p>Crop featured image. </p>'. $select_sizes.'<input type="button" class="button tagadd crop-freatured-image" data-url_imagen="'.$url_image.'" data-name_imagen="'.$name_image.'" data-id_imagen="'.$thumb_id.'" value="Crop"></div>';
		}

		/**
		 * Select de las medidas de thumbnail
		 */
		public function select_sizes_thum(){
			$sizes = $this->return_sizes_thumb();
			$html = '';
			foreach ($sizes as $size)
				$html .= '<option value="'.$size['width'].','.$size['height'].'-'.$size['name'].'" >'.$size['name'].' </option>';

			return "<select name='size-thumb' id='size-thumb' ><option value=''>&lt;none&gt;</option>{$html}</select>";
		}

		/**
		 * retorna las me didas de thumbnail que existen en el tema
		 * @return [type] [description]
		 */
		public function return_sizes_thumb(){
			global $_wp_additional_image_sizes;
			foreach ( get_intermediate_image_sizes() as $s ) {
				$sizes[$s] = array( 'name' => '', 'width' => '', 'height' => '', 'crop' => FALSE );

				/* Read theme added sizes or fall back to default sizes set in options... */

				$sizes[$s]['name'] = $s;

				if ( isset( $_wp_additional_image_sizes[$s]['width'] ) )
					$sizes[$s]['width'] = intval( $_wp_additional_image_sizes[$s]['width'] );
				else
					$sizes[$s]['width'] = get_option( "{$s}_size_w" );

				if ( isset( $_wp_additional_image_sizes[$s]['height'] ) )
					$sizes[$s]['height'] = intval( $_wp_additional_image_sizes[$s]['height'] );
				else
					$sizes[$s]['height'] = get_option( "{$s}_size_h" );

				if ( isset( $_wp_additional_image_sizes[$s]['crop'] ) )
					$sizes[$s]['crop'] = intval( $_wp_additional_image_sizes[$s]['crop'] );
				else
					$sizes[$s]['crop'] = get_option( "{$s}_crop" );
			}

			return $sizes;
		}


		/**
		 * Retorna la url de la freatured image
		 */
		public function url_thumb_freatured($thumb_id){

			$url = wp_get_attachment_image_src( $thumb_id, 'full');
			return $url[0];
		}



		/**
		 * Retorna el nombre de la freatured image
		 */
		public function name_thum_freatured($url_image) {
			$imagen = pathinfo($url_image);
			return $imagen['filename'];
		}

	}


