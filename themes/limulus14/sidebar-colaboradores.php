<aside id="pages_sidebar" class="sidebar page_side no_480 no_320">
	<ul>
		<?php
	     $colaboradores = get_users('blog_id=1&orderby=nicename&meta_key=es_colaborador&meta_value=on');
	    foreach ($colaboradores as $colaborador) {
	        echo '<li><a href="'.site_url('/colaborador/').$colaborador->user_nicename.'">' . $colaborador->first_name . ' '.$colaborador->last_name .'</a></li>';
	    }
		?>
	</ul>
</aside><!-- main_sidebar -->