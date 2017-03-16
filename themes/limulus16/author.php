    <?php get_header(); 

    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    ?>        
        
        <section class="feed_container clearfix">

            <article class="single_post">
                <?php 
                    $colaboradores = get_users('blog_id=1&orderby=nicename&meta_key=es_colaborador&meta_value=on');
                    foreach ($colaboradores as $colaborador) {
                        echo '<h3 class="solo_480 menu_mobile"><a href="'.site_url('/colaborador/').$colaborador->user_nicename.'">' . $colaborador->first_name . ' '.$colaborador->last_name .'</a></h3>';

                    }
                    $bio_es =  get_the_author_meta( '_bio_es', $curauth->ID ); 

                ?>
                    

                <!-- <?php the_post_thumbnail( ); ?> -->
                <h1><?php echo $curauth->first_name.' '.$curauth->last_name; ?></h1>
                
                <hr class="divider full_width" />

                <section class="main_content">

                   <dd>
                   <?php _e('[:es] '.$bio_es.' [:en] '.$curauth->user_description); ?>
                   </dd>

                    <hr class="divider full_width" />
                </section>
                
                <section class="mas_posts">
                    <h4 class="solo_480 solo_320"><?php _e('Artículos relacionados a este colaborador:', 'limulus'); ?></h4>

                    <h4 class="no_480"><?php _e('Artículos relacionados a este colaborador: ', 'limulus'); ?></h4>
                <?php

                    // Get related posts
                    $args = array(
                        'posts_per_page'   => 4,
                        'post_type'        => 'post',
                        'post_status'      => 'publish',
                        'author'           =>  $curauth->id
                        
                    ); 

                    $related_posts = get_posts( $args );
                
                foreach ($related_posts as $related) : ?>
                    <article class="each_post">
                        <a href="<?php echo get_permalink( $related->ID ); ?>">
                            <?php echo get_the_post_thumbnail( $related->ID, 'thumbnail' ); ?>
                            <h3><?php echo qtrans_use(qtrans_getLanguage(), $related->post_title, false); ?></h3>
                        </a>
                    </article><!-- each_post -->
            <?php endforeach; ?>

                </section>

            <hr class="divider full_width" />

                <div class="banner_fonca">
                    <a href="http://fonca.conaculta.gob.mx/" target="_blank">
                        <img src="<?php echo THEMEPATH; ?>/images/banners/segundo_encuentro_limulus.gif">
                    </a>
                </div>
                
            </article><!-- each_post -->
    
        </section><!-- feed_container -->
    
    <?php get_footer(); ?>