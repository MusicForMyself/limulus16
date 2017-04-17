(function($){

	"use strict";

	$(function(){


		/**
		 * Validación de emails
		 */
		window.validateEmail = function (email) {
			var regExp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return regExp.test(email);
		};



		/**
		 * Regresa todos los valores de un formulario como un associative array
		 */
		window.getFormData = function (selector) {
			var result = [],
				data   = $(selector).serializeArray();

			$.map(data, function (attr) {
				result[attr.name] = attr.value;
			});
			return result;
		}

		//Chosen
		// $('.chosen-select').prepend('<option class="level-0" value="" > </option>').attr('data-placeholder', 'colección');

		$(".chosen-select").chosen({
				width: "100%",
				disable_search: true,
				placeholder_text_single: 'colección'
		});


		$(".chosen-select-50").chosen({
					width: "49.75%",
					disable_search: true,
					inherit_select_classes: true
		});

		$(".chosen-select-50 + .chosen-container").first().css('margin-right', '.5%');

		// window.addEventListener("orientationchange", function() {
		//  // Announce the new orientation number
		//  alert(window.orientation);
		// }, false);

		// Foggy
		$('.each_post').mouseenter(function(){
			$(this).find('.blur_this').foggy({
				blurRadius: 1
			});
		})
		.mouseleave(function(){
			$(this).find('.blur_this').foggy(false);
		});

		//Foggy imagen principal
		$('.banner').mouseenter(function(){
			$(this).find('.blur_this').foggy({
				blurRadius: 1
			});
			//$('.banner h3').css('background', '#000');
		})
		.mouseleave(function(){
			$(this).find('.blur_this').foggy(false);
			//$('.banner h3').css('background', 'initial');
		});


		// FitVids
		$("iframe").each(function(){
			$(this).unwrap(".main_content");
		});
		
		$(".main_content").fitVids();

		$('.cycle-container').cycle({
				'slides' : 'li',
				'fx'     : 'scrollHorz',
				'swipe'  : true
	   });

		//Clone some 'extra' posts

		// var post_num = $('.each_post').length;

		// if ( post_num % 5 !== 0 ) {

		//     console.log(post_num);
		// }
		// while ( post_num % 5 !== 0 ) {
		//     $('.feed_container').append( 'a' );
		//     post_num = $('.each_post').length;
		// }
		
		// // Change menu order || ( $(window).width() <= 768 && window.orientation !== 0 
		if( ($(window).width() <= 480) || ( $(window).width() <= 768 && window.orientation !== 0 ) ){

			// $('.renglon_1').prepend( $('#searchform') );
			$( ".mobile_accordion" ).accordion({
				collapsible : true,
				header      : 'h3.solo_480',
				active      : 10,
				heightStyle : 'content',
				autoHeight  : true
			});

		}

		$(window).load( function(){

			// Style @Overrides

			function resize_functions(){

				// Change menu order
				if( $(document).width() > 480 ){
					// if (window.orientation == 0) $('#searchform').appendTo( $('.renglon_2') );
					if( $( ".mobile_accordion" ).accordion() ) $( ".mobile_accordion" ).accordion( "destroy" );
					( $('#searchform').hasClass('open') ) ? closeSearchBox()  :  '' ;
					$('#searchform').removeAttr( 'style' );
					$('#main_sidebar .labels li').css('margin', '0.5rem 1rem' );
				}

				

				if( $(window).width() <= 768 ){
					//Tags margin
					var label_list_width  = $('#main_sidebar .labels').width();
					var label_list_count  = $('#main_sidebar .labels li').length/2;
					var label_total_width = 0;

					$('#main_sidebar .labels li').each(function(index) {
						label_total_width += parseInt($(this).width(), 10);
					});

					var label_margin = ( ( label_list_width - label_total_width )/ label_list_count );
					if( label_margin > 5 && label_margin < 30) $('#main_sidebar .labels li').css('margin', '0.5rem '+label_margin+'px' );
				}

				// Make sidebar same height as posts_container
				if( $(document).width() > 768 ){
					$('#main_sidebar .labels li').css('margin', '0.5rem 0.5rem' );
					var posts_height = $('.feed_container').height();
					if( posts_height > 389 ){
						$('#main_sidebar, #pages_sidebar').height( posts_height+9 );
						return;
					}
					$('#main_sidebar, #pages_sidebar').height( '391px' );
					// $('.feed_container').height( '369px' );

				}
				$('#main_sidebar, #pages_sidebar').height('auto');


			}
			resize_functions();

			$(window).resize(function(){
				resize_functions();
			});

			if($('.filters').length > 0){
				var z = $('.filters').offset().top;
			};
			$(window).scroll( function( e ){
				if( $(window).width() <= 768 ) return;
				var y = $(this).scrollTop();
				if ( y >= z && !$('.filters').hasClass('fixed_filters') ) {
					$('.filters').addClass('fixed_filters');
					$('.fixed_target').addClass('fixed');
					$('#main_sidebar').css('height' , '-=28' );
					return;
				} else if( y < z && $('.filters').hasClass('fixed_filters') ){
					$('.filters').removeClass('fixed_filters');
					$('.fixed_target').removeClass('fixed');
					$('#main_sidebar').css('height' , '+=28' );
				}


			});

			//Fija el menú lateral de las páginas
			// var z = ($('#pages_sidebar').length > 1) ? $('#pages_sidebar').offset().top : $('#main_sidebar').offset().top;
			// $(window).scroll( function( e ){
			// 	if( $(window).width() <= 768 ) return;
			// 	var y = $(this).scrollTop();
			// 	if ( y >= z && !$('#pages_sidebar').hasClass('fixed_filters') ) {
			// 		$('#pages_sidebar').addClass('fixed_filters');
			// 		$('.fixed_target').addClass('fixed');
			// 		// $('#pages_sidebar').css('height' , '-=28' );
			// 		return;
			// 	} else if( y < z && $('#pages_sidebar').hasClass('fixed_filters') ){
			// 		$('#pages_sidebar').removeClass('fixed_filters');
			// 		$('.fixed_target').removeClass('fixed');
			// 		// $('#pages_sidebar').css('height' , '+=28' );
			// 	}


			// });


		});

		/**
		 * Agrega un nuevo parámetro a la url
		 * @param String param (Array param on level 3)
		 * @param Integer level
		 */
		function setNewUrlParam( param, level ){

			// if( typeof(param) == 'String' )
			// console.log('lol catz');
			switch( level ){
				case 1:
					window.location = site_url_localized +'coleccion/'+ param + '/cajon-general/?lang=' + lang_localized;
					break;

				case 2:
					window.location = site_url_localized + 'coleccion/'+ param[0] + '/' + param[1] + '/?lang=' + lang_localized;
					break;

				case 3:
					var my_url = '';
					//Clear empty values
					param = param.filter(function( n ){
						return n !== '';
					});
					param.forEach( function( value ){
						my_url += value+'/';
						console.log('tag '+my_url);
					});
					var lang = '?lang=' + lang_localized;
					my_url += lang;
					console.log(my_url);

					window.location = site_url_localized +'coleccion/'+ my_url;
					break;

				default:
					break;
			}
		}

		/**
		 * Revisa el contexto antes de agregar un tag
		 * @param String param
		 * @return Array url_params
		 */
		function priorParamCheck( param ){

			var pathname = ( window.location.pathname ),
				path_array ,start_index;

			pathname = ( window.location.pathname );
			path_array = pathname.split("/");
			start_index = path_array.indexOf('coleccion');

			//Si existe ya un filtrado nivel 1 por lo menos
			if( start_index !== -1 ){
				//Remove prefix
				path_array.splice( 0, start_index+1 );

				//Remove possible empty elements
				path = path_array.filter(function(n){if (n != '')return n});

				//Add new param to array
				path_array.splice( path_array.length+1, 0, param);
				console.log(path_array);
				return path_array;
			}
			// console.log(['coleccion', 'limulus', 'cajon-general', param]);
			return ['limulus', 'cajon-general', param];

		}

		/**
		 * Acciones de los selects
		 */
		//NIVEL 1
		$('#level_1_filter').find('select').chosen().change( function(){

			var param = $(this).val();
			setNewUrlParam( param, 1 );
		});


		//NIVEL 1 from NIVEL 2 (category)
		$('#level_2_filter').find('select').first().chosen().change( function(){

			var param = $(this).val();
			setNewUrlParam( param, 1 );
		});

		//NIVEL 2 from NIVEL 2 (category)
		$('#level_2_filter').find('select').last().chosen().change( function(){

			//Parent
			var param_array = new Array();
				param_array[0] = $(this).siblings().first().val();
				param_array[1] = $(this).val();

			setNewUrlParam( param_array, 2 );
		});


		//Label filtering LEVEL 3
		$('.labels li').on('click', function(){

			if( $(this).hasClass('active') ) return;
			var this_tag = $(this).data('tag');

			// window.location = window.location+'/'+$(this).data('tag');
			var param_array = priorParamCheck( this_tag ),
				my_url = '';
			window.localStorage.setItem('param_array', param_array);
			setNewUrlParam( param_array, 3);
		});

		$('.clean_filters').on('click', function(){
			$('.logo').trigger('click');
			//Todo: Actually remove tags from query GO HOME
			$('.labels li').removeClass('active');
			window.localStorage.removeItem( 'param_array' );
			window.location = site_url_localized;
		});
		if ( is_home_localized == 'true' ) window.localStorage.removeItem( 'param_array' );

		/**
		 * Sets active clases to selected tags
		 */
		var setActiveTags =  function ( param_array ){
			if( !param_array ) return 0;
			var array_local = param_array.split(",");
			// console.log(array_local);
			$('.labels li').each( function(){
				var $context = $(this);
				array_local.forEach( function( param ){
					if( $context.data('tag') == param )
						$context.addClass('active');

				});
				// ( $(this).data('tag').('active') ) ? $(this).removeClass('active') : $(this).addClass('active') ;
			});

		}
		setActiveTags( window.localStorage.getItem('param_array') );

/////
		/**
		 * Sets active clases to selected tags
		 */
		var saveActiveTagsSingle = function(param_array){

			var this_tag = $('#tags_single li').data('tag');
			var param_array = new Array();

			// window.location = window.location+'/'+$(this).data('tag');

			$('#tags_single li').each(function(index,value){

				var $context = $(this);
				param_array.push($context.data('tag'));
			});
			window.localStorage.setItem('param_array', param_array);

			console.log(param_array);


		};

		if ( is_single_localized == 'true' ) saveActiveTagsSingle('param_array');

		var setActiveTagsSingle =  function ( param_array ){

			if( !param_array ) return 0;
			var array_local = param_array.split(",");
			// console.log(array_local);
			$('.labels li').each( function(){
				var $context = $(this);
				array_local.forEach( function( param ){
					if( $context.data('tag') == param )
						$context.addClass('active');

				});
				// ( $(this).data('tag').('active') ) ? $(this).removeClass('active') : $(this).addClass('active') ;
			});

		}


			 if ( is_single_localized == 'true' ) setActiveTagsSingle( window.localStorage.getItem('param_array') );

/////

		//Evitar que coleccion/limulus/ crashee
		var path_string = window.location.pathname,
			path        = path_string.split('/');

			path        = path.filter( function(n){ if (n != '') return n } );
		//This may cause troubles in local but not in server
		// if ( path[path.length-1] == 'limulus') window.location = site_url_localized+'coleccion/limulus/cajon-general/'


		//Galeria que somos
		var link_full = $('.gallery_thumbnail').first().data('full');
		$('.gallery_thumbnail').first().addClass('thumb_active').foggy({ blurRadius: 1 });
		$('.gallery_view').attr('src', link_full);

		$('.gallery_thumbnail').on('click',function(){
			$(this).siblings().removeClass('thumb_active').foggy(false);
			if( ! $(this).hasClass('thumb_active') ) {
				$(this).addClass('thumb_active');
				var link_full = $(this).data('full');
				$('.gallery_view').attr('src', link_full);
				$(this).foggy({
					blurRadius: 1
				});
			}

		});

		// Navegación sidebar Que somos
		$('#pages_sidebar ul li').on('click', function( e ){
			e.preventDefault();
			console.log($(this).find('a').attr('href'));

			var elementClicked = $(this).find('a').attr('href');
			var destination = $(elementClicked).offset().top;
			$("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination-15}, 360 );

			$(this).siblings().removeClass('selected');
			$(this).addClass('selected');
			window.location.hash = elementClicked;
			return false;
		});

		//Sidebar Info
		if( window.location.hash == '#aviso-privacidad'){
			$('#pages_sidebar ul li').siblings().removeClass('selected');
			$('#pages_sidebar ul li').first().addClass('selected');
		}
		if( window.location.hash == '#info-derechos-autor'){
			$('#pages_sidebar ul li').siblings().removeClass('selected');
			$('#pages_sidebar ul li').last().addClass('selected');
		}



		/** SEARCHFORM
		 * Abre el searchbox en la versión móvil
		 */
		function openSearchBox(){

			$('h1.logo').fadeOut('fast');

			if( $(window).width() < 340 ){
				$('.lang_change').animate({
					'margin-left'  : '35px'
				}, 80, 'swing');

				$('#searchform').css( 'position' , 'absolute').animate({
					width     : '232%',
					right     : '45%'
				}, 140, 'swing').addClass('open');
				return;
			}

			if( $(window).width() < 435 ){
				$('.lang_change').animate({
					'margin-left'  : '35px'
				}, 80, 'swing');

				$('#searchform').css( 'position' , 'absolute').animate({
					width     : '400%',
					right     : '45%'
				}, 140, 'swing').addClass('open');
				return;
			}

			if( $(window).width() < 768 ){
				$('.lang_change').animate({
					'margin-left'  : '35px'
				}, 80, 'swing');

				$('#searchform').css( 'position' , 'absolute').animate({
					width     : '400%',
					right     : '45%'
				}, 140, 'swing').addClass('open');
				return;
			}

			$('.lang_change').animate({
				'margin-left'  : '45px'
			}, 80, 'swing');

			$('#searchform').css( 'position' , 'absolute').animate({
				width     : '405%',
				right     : '37%'
			}, 140, 'swing').addClass('open');

		}

		/**
		 * Cierra el searchbox en la versión móvil
		 */
		function closeSearchBox(){

			$('h1.logo').fadeIn('fast');

			$('.lang_change').animate({
				'margin-left'  : '0'
			}, 80, 'swing');

			$('#searchform').css( 'position' , 'absolute').animate({
				width     : '35px',
				right     : '45%'
			}, 100, 'swing').removeClass('open');
			return;

			$('.lang_change').animate({
				'margin-left'  : 'initial'
			}, 80, 'swing');

		}

		/**
		 * Accion para cerrar el searchbox si está abierto
		 */
		// $(document).on('click', function(){
		// 	( $('#searchform').hasClass('open') ) ? closeSearchBox()  :  '' ;
		// });

		// 	$('#searchform').click(function(e){
		// 	  e.stopPropagation();
		// 	});

		/**
		 * Enviar form de la busqueda
		 */
		// $('#searchsubmit').on('click', function(e){

		// 	e.preventDefault();

		// 	if( ( $(window).width() > 480 && window.orientation == 0   ) || $('#searchform').hasClass('open') ){
				
		// 		$('#searchform').submit();
		// 		return;
		// 	}
		// 	openSearchBox();
		// });

		/**
		 * Botones Next y Prev en el single
		 */
		if( !$('.arrow.left').attr('href') ) $('.arrow.left').addClass('disabled');
		if( !$('.arrow.right').attr('href') ) $('.arrow.right').addClass('disabled');

		// PAGINATION hack
		if($('.prev_posts').length && $('.next_posts').length){
			$('.prev_posts').append('<span>|</span>')
		}

		// Assign this accoding to responsive layout
		var posts_per_row = 4;
		var home_skip_to_grid = 5;
		var maCounter = 0;
		var new_container_height = 0;

		if($(window).width() <= 1024){
			maCounter = 0;
			new_container_height = 0;
		}

		/*** General screen fixes ***/
		var initializeContainer = function(){
				console.log("Init container");
				new_container_height = $('.each_post').first().find('.wp-post-image').height();
				
				/*** Search screen fixes ***/
				$('.each_post.search_result').each(function(){
					if( !maCounter || (maCounter > (posts_per_row-1)) ){
						console.log(maCounter);
						new_container_height = $(this).find('.wp-post-image').height();
						maCounter = 0;
					}
					$(this).css('height', new_container_height);
					maCounter++;
				});

				/*** Home screen fixes ***/
				$('.each_post.home').each(function(){
					
					if(!maCounter )
						new_container_height = $(this).find('.wp-post-image').height();
					$(this).css('height', new_container_height);
					maCounter++;
					maCounter = ( $(this).css('margin-right') == '0px' ) ? 0 : maCounter;
				});

				$('.each_post img').each(function(){
					var img_height = $(this).height();
					var container_height = $(this).closest('.each_post').height();
					var final_margin = (container_height-img_height) / 2;
					if(img_height && img_height < container_height)
						$(this).css('margin-top', final_margin);
				});
			
		};
		
		$('.feed_container').imagesLoaded(function(){
			initializeContainer();
		});
		
		$('.each_post').infinitescroll({
			loading: {
				finished: undefined,
				finishedMsg: "<em>No more posts.</em>",
							img: null,
				msg: null,
				msgText: "<em>Loading...</em>",
				selector: null,
				speed: 'fast',
				start: undefined
			},
			animate: false,
			loadingImg   : "img/ring.gif",
			debug: false
		} );

		$('.feed_container').on('append', function(){
			console.log("Finished loading content");
			// initializeContainer();
		});

	});

})(jQuery);
