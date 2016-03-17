<?php
	/**
	 * CROP IMAGEN
	 * @return boolean
	 */
	function crop_save_image(){
			$image_name = isset($_POST['image_name']) ? $_POST['image_name'] : false;
			$file       = isset($_POST['img']) ? $_POST['img'] : false;

			$new_img = cortar_imagen_png($_POST['x1'], $_POST['y1'], $_POST['w'], $_POST['h'], $image_name, $file, $_POST['w_crop'], $_POST['h_crop'], $_POST['image_id'], $_POST['name_crop']);

			wp_send_json_success($new_img);

	}

	add_action('wp_ajax_crop_save_image', 'crop_save_image');
	add_action('wp_ajax_nopriv_crop_save_image', 'crop_save_image');


	function cortar_imagen_png( $x, $y, $width, $height, $image_name, $file , $w_crop, $h_crop, $id_image, $name_crop ){

		$root_save = path_root($file);
		$size_save = '-'.$w_crop.'x'.$h_crop;

		$dst_x = 0;
		$dst_y = 0;
		$src_x = $x;
		$src_y = $y;
		$dst_w = $width;
		$dst_h = $height;
		$src_w = $width;
		$src_h = $height;

		//escala la imagen

		$source_aspect_ratio = $width / $height;
		$desired_aspect_ratio = $w_crop / $h_crop;

		if ($source_aspect_ratio > $desired_aspect_ratio) {

			$dst_h = $h_crop;
			$dst_w = ( int ) ($h_crop * $source_aspect_ratio);

		} else {

			$dst_w = $w_crop;
			$dst_h = ( int ) ($w_crop / $source_aspect_ratio);
		}


		$dst_image = imagecreatetruecolor($dst_w,$dst_h);

		list($source_width, $source_height, $source_type) = getimagesize($file);

		switch ($source_type) {
			case IMAGETYPE_GIF:
				header('Content-Type: image/gif');
				$type_image = 'gif';
				$src_image = imagecreatefromgif($file);
				break;
			case IMAGETYPE_JPEG:
				header('Content-Type: image/jpeg');
				$type_image = 'jpg';
				$src_image = imagecreatefromjpeg($file);
				break;
			case IMAGETYPE_PNG:
				header('Content-Type: image/png');
				$type_image = 'png';
				$src_image = imagecreatefrompng($file);
				break;
		}

		//crop image

		imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

		if ($type_image == 'jpg'):
			return $image_crop = saveCropImagejpg($dst_image, $image_name, $root_save, $size_save, $id_image, $name_crop, $w_crop, $h_crop, $type_image);
		elseif($type_image == 'png'):
			return $image_crop = saveCropImagepng($dst_image, $image_name, $root_save, $size_save, $id_image, $name_crop, $w_crop, $h_crop, $type_image);
		elseif($type_image == 'gif'):
			return $image_crop = saveCropImagegif($dst_image, $image_name, $root_save, $size_save, $id_image, $name_crop, $w_crop, $h_crop, $type_image);
		endif;
	}

	/**
	 * Save Crop Image in JPG
	 */
	function saveCropImagejpg( $imagen, $image_name, $root_save, $size_save, $id_image, $name_crop, $w_crop, $h_crop, $type_image ){
		$upload_dir  = wp_upload_dir();
		$path        = $upload_dir['basedir'].$root_save.'/'.$image_name."$size_save.jpg";
		$upload      = imagejpeg( $imagen, $path, 100 );
		update_size_image($id_image, $name_crop, $image_name, $size_save, $w_crop, $h_crop, $type_image);
		return $upload ? $upload_dir['baseurl'].$root_save.'/'.$image_name."$size_save.jpg" : false;
	}

	 /**
	 * Save Crop Image in PNG
	 */
	function saveCropImagepng( $imagen, $image_name, $root_save, $size_save, $id_image, $name_crop, $w_crop, $h_crop, $type_image ){
		$upload_dir  = wp_upload_dir();
		$path        = $upload_dir['basedir'].$root_save.'/'.$image_name."$size_save.png";
		$upload      = imagepng( $imagen, $path);
		update_size_image($id_image, $name_crop, $image_name, $size_save, $w_crop, $h_crop, $type_image);
		return $upload ? $upload_dir['baseurl'].$root_save.'/'.$image_name."$size_save.png" : false;
	}

	/**
	 * Save Crop Image in GIF
	 */
	function saveCropImagegif( $imagen, $image_name, $root_save, $size_save, $id_image, $name_crop, $w_crop, $h_crop, $type_image ){
		$upload_dir  = wp_upload_dir();
		$path        = $upload_dir['basedir'].$root_save.'/'.$image_name."$size_save.gif";
		$upload      = imagegif( $imagen, $path, 100 );
		update_size_image($id_image, $name_crop, $image_name, $size_save, $w_crop, $h_crop, $type_image);
		return $upload ? $upload_dir['baseurl'].$root_save.'/'.$image_name."$size_save.gif" : false;
	}

	function path_root($file){
		$imagen       = pathinfo($file);
		$carpeta_num  = strpos($imagen['dirname'], 'uploads');
		$carpeta      = substr($imagen['dirname'],$carpeta_num+7);
		return $carpeta;
	}

	function update_size_image($id_image, $name_crop, $image_name, $size_save, $w_crop, $h_crop, $type_image){
		$metadata = wp_get_attachment_metadata( $id_image, true );
		$metadata['sizes'][$name_crop] = array(
			'file' => $image_name."$size_save.".$type_image,
			'width' => $w_crop,
			'height' => $h_crop
		);
		wp_update_attachment_metadata( $id_image, $metadata);
	}