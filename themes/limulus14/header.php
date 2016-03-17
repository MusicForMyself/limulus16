<!doctype html>
	<head>
		<meta charset="utf-8">
		<title><?php print_title(); ?></title>
		<link rel="shortcut icon" href="<?php echo THEMEPATH; ?>images/favicon.ico">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="cleartype" content="on">
		<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4dd43084644b4d2b"></script>
		<?php wp_head(); ?>
</head>

	<body>
	<!--[if lt IE 9]>
			<p class="chromeframe">Estás usando una versión <strong>vieja</strong> de tu explorador. Por favor <a href="http://browsehappy.com/" target="_blank"> actualiza tu explorador</a> para tener una experiencia completa.</p>
		<![endif]-->
		<div class="container">

		<header class="clearfix">

			<a href="<?php echo qtrans_convertURL(site_url()); ?>"><h1 class="logo">Límulus</h1></a>
			<nav class="header_menu">
				
				<div class="renglon renglon_1 clearfix">
					
					<form method="get" id="searchform" class="main_search clearfix solo_480 solo_320" action="<?php echo qtrans_convertURL( site_url('/') ); ?>">
						<input class="menu_item black_border search" type="text" value="" name="s" id="s" >
						<input type="hidden" value="<?php echo qtrans_getLanguage(); ?>" name="lang" id="lang" >
						<input  type="submit" class="search_btn" id="searchsubmit" value="" >
					</form>

					<?php get_qtrans_single('lang_change black_border'); ?>

					<ul class="social_bar no_480">
						<li class="twitter"><a href="https://twitter.com/limulus_mx" target="_blank"></a></li>
						<li class="facebook"><a href="http://www.facebook.com/revistalimulus" target="_blank"></a></li>
						<li class="tumblr"><a href="http://limulusmx.tumblr.com/" target="_blank"></a></li>
						<li class="instagram"><a href="http://instagram.com/limulusmx" target="_blank"></a></li>
					</ul><!-- social_bar -->

				</div><!-- renglon -->

				<div class="renglon renglon_2 clearfix no_480 no_320">

					<a href="<?php echo qtrans_convertURL( site_url('que-somos/')); ?>" class="menu_item black_border que-somos <?php echo ( is_page('que-somos') ) ? 'active' : '' ; ?>"><?php _e('¿qué somos?', 'limulus'); ?></a>
					
					<form action="http://hacemoscodigo.us3.list-manage.com/subscribe/post" method="POST">
						<input type="hidden" name="u" value="2de945d89b22b4d7511814d1d" >
						<input type="hidden" name="id" value="89cfe9ab44">
						<input class="menu_item black_border newsletter no_480" type="email" name="MERGE0" id="MERGE0" placeholder="newsletter" onfocus="this.placeholder = '' " onblur="this.placeholder = 'newsletter'">
					</form>

					<form method="get" id="searchform" class="main_search clearfix" action="<?php echo qtrans_convertURL( site_url('/') ); ?>">
						<input class="menu_item black_border search" type="text" value="" name="s" id="s" >
						<input type="hidden" value="<?php echo qtrans_getLanguage(); ?>" name="lang" id="lang" >
						<input  type="submit" class="search_btn" id="searchsubmit" value="" >
					</form>

				</div><!-- renglon -->

				<div class="renglon renglon_2 clearfix solo_480 solo_320">

					<a href="<?php echo qtrans_convertURL( site_url('que-somos/')); ?>" class="menu_item black_border que-somos <?php echo ( is_page('que-somos') ) ? 'active' : '' ; ?>"><?php _e('¿qué somos?', 'limulus'); ?></a>


				</div><!-- renglon -->
			</nav><!-- header_menu -->

		</header><!-- main header -->
