
	<footer class="main_footer clearfix">
		<ul class="logos clearfix">

			<li class="limulus"><a href="<?php echo site_url(); ?>" target="_blank">Límulus</a></li>
			<li class="legislatura"><a href="http://www.diputados.gob.mx/inicio.htm" target="_blank">Cámara de diputados</a></li>
			<li class="conaculta"><a href="http://www.conaculta.gob.mx/" target="_blank">Conaculta</a></li>
			<li class="fiac"><a>FIAC</a></li>
		</ul>
		<ul class="footer_links clearfix">
			<li>Limulus &copy; <?php echo date('Y'); ?></li>
			<li class="no_480"><a href="<?php echo site_url('info').'#aviso-privacidad'; ?>"><?php _e('Aviso de privacidad', 'limulus'); ?></a></li>
			<li><a href="<?php echo site_url('info#info-derechos-autor'); ?>"><?php _e('Información sobre derechos de autor', 'limulus'); ?></a></li>
			<li><a href="mailto:hola@limulus.mx">hola@limulus.mx</a></li>
			<br />
			<br />
			<li><p>Esta revista es producida gracias al Programa “Edmundo Valadés” de Apoyo a la Edición de Revistas Independientes 2014, del Fondo Nacional para la Cultura y las Artes</p></li>
		</ul>
	</footer>
		<?php wp_footer(); ?>
		</div><!-- container -->
		<!-- ANALYTICS -->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-49789320-1', 'limulus.mx');
		  ga('create', 'UA-39817725-1', 'auto', {'name': 'nori'});
		  ga('send', 'pageview');
		  ga('nori.send', 'pageview');


		</script>

	</body>

</html>
