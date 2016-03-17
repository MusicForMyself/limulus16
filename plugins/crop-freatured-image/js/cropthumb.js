(function($){

	"use strict";

	$(function(){

		$('.crop-freatured-image').live('click', function (e) {
			event.preventDefault();
			var imagen      = $(this).data('url_imagen');
			var name_image  = $(this).data('name_imagen');
			var id_image    = $(this).data('id_imagen');
			var size        = $("#size-thumb").val();

			if(size != ''){
				CropImage.init(imagen, name_image, size, id_image);
			} else{
				alert('favor de seleccionar una medida');
			}
		});

		$('.cancel').live('click', function () {
			$('#fondo-crop-image').remove();
			$('.imgareaselect-outer, .imgareaselect-selection, .imgareaselect-border1, .imgareaselect-border2').remove();
		});


		$('#bt-saveImage').live('click', function () {
			CropImage.saveImage();
		});


		window.CropImage = {};

		/**
		 * [init description]
		 *
		 * @return {[type]}
		 */
		CropImage.init = function (imagen, name_image, size, id_image)
		{
			/**
			 * Crea el contenedor
			 */
			this.CreaContainer();

			/**
			 * contenedor imagen
			 * @type {[type]}
			 */
			this.$container = $('#cont-crop-image');

			/**
			 * Inserta la imagen en el contenedor
			 */
			this.add_image(imagen, name_image);

			this.imagen     = imagen;

			this.image_name = name_image;

			this.widthCrop  = 0;

			this.heightCrop = 0;

			this.nameCrop   = '';

			this.idCrop   = id_image;

			/**
			 * tamaño al q se cortara la imagen
			 */
			this.size_crop(size);

			/**
			 * Inicializa plugin imgAreaSelect
			 */
			this.init_imgAreaSelect();

		};

		CropImage.CreaContainer = function ()
		{
			$('<div></div>',{
				'id'     : 'fondo-crop-image'
			}).appendTo('body');

			$('body').append('<input type="hidden" name="x1" value="" id="x1" /><input type="hidden" name="y1" value="" id="y1" /><input type="hidden" name="w" value="" id="w" /><input type="hidden" name="h" value="" id="h" />');

			$('<div></div>',{
				'id'     : 'cont-crop-image'
			}).appendTo('#fondo-crop-image');

		};

		CropImage.add_image = function (imagen, name_image)
		{
			this.$container.html('<div class="thumbnail_crop"><img id="photo" data-name="'+name_image+'" src="'+imagen+'" /></div><p><button type="button" class="button tagadd cancel"> <i class="icon-remove"></i> Cancel</button> <button type="button" class="button tagadd" id="bt-saveImage"><i class="icon-ok-sign icon-white"></i> Save Image</button></p>');

		};

		CropImage.init_imgAreaSelect = function () {
			$('#photo').imgAreaSelect({
				minxWidth: CropImage.widthCrop,
				minHeight: CropImage.heightCrop,
				aspectRatio: CropImage.widthCrop+':'+CropImage.heightCrop,
				onSelectChange: this.updateSelection
		    });

		};

		CropImage.updateSelection = function (img, selection) {
			$('#x1').val(selection.x1);
			$('#y1').val(selection.y1);
			$('#w').val(selection.width);
			$('#h').val(selection.height);
		};

		CropImage.size_crop = function (size) {

			var w_count   = size.indexOf(",");
			var y_count   = size.indexOf("-");

			this.widthCrop  = size.substring(0,w_count);
			this.heightCrop = size.substring(w_count+1,y_count);
			this.nameCrop   = size.substring(y_count+1);

		};

		CropImage.saveImage = function(){
			var x1 = $('#x1').val(),
				y1 = $('#y1').val(),
				w  = $('#w').val(),
				h  = $('#h').val();

			this.ajax_crop_image(x1, y1, w, h);

		}

		CropImage.ajax_crop_image = function(x1, y1, w, h){
			$.post(ajax_url, {
				x1         : x1,
				y1         : y1,
				w          : w,
				h          : h,
				w_crop     : this.widthCrop,
				h_crop     : this.heightCrop,
				img        : this.imagen,
				image_name : this.image_name,
				image_id   : this.idCrop,
				name_crop  : this.nameCrop,
				action     : 'crop_save_image'
			}, 'json')

			.done(function (data){
				$('.imgareaselect-outer, .imgareaselect-selection, .imgareaselect-border1, .imgareaselect-border2').remove();
				$('#cont-crop-image').empty().append('<h2>El corte se realizo correctamente</h2><img src="'+data.data+'" alt="" /><p><button type="button" class="button tagadd cancel"> <i class="icon-remove"></i> Cerrar</button></p>');

			});
		}




	});

})(jQuery);
