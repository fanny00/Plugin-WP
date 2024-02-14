<?php wp_footer(); ?>

<div class="container-fluid info-footer">
    <div class="container">
            <div class="row sobre-nosotros">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <?php $nosotros = new WP_Query('pagename=sobre-nosotros');
                    while( $nosotros->have_posts()) : $nosotros->the_post();
                    the_title('<h3>', '</h3>');
                    the_content();
                    endwhile;
                    ?>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 column-post">
                    <?php 
                        //Aqui pondre codigo para el titulo
                        $args = array(
                            'post_type' => 'page',
                            'name' => 'blog'
                        );

                        $title = new WP_Query($args);

                        while ( $title->have_posts() ) : $title->the_post();

                    ?>

                    <h3>Noticias <?php echo get_the_title( $title->post->idate ); ?></h3>
                        
                    <?php endwhile; wp_reset_postdata(  ); ?>
                    <?php
                        $args = [
                            'post_type' => 'post',
                            'posts_per_page' => 2,
                            'order' => 'DESC',
                            'orderby' => 'rand'
                        ];
                        $entradas = new WP_Query($args);
                        while ( $entradas->have_posts() ) : $entradas->the_post();

                     ?>
                     <div class="row row-post">
                         <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 imagen">
                             <?php $imagen = get_the_post_thumbnail_url(); ?>
                             <img class="img-fluid" src="<?php echo $imagen; ?>" alt="<?php bloginfo( 'name' ); ?>">
                         </div>
                         <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title('<h5>', '</h5>'); ?>
                            </a>
                             <span><?php the_date( 'd F, Y' ); ?></span>
                         </div>
                     </div><!--/row-post-->
                     <?php endwhile; wp_reset_postdata(); ?>
                </div>
                    
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 column-info">
                    <?php $info = new WP_Query('pagename=info-contacto');
                        while ( $info->have_posts() ) : $info->the_post();
                        the_content(); endwhile; ?>
                    <div class="telefono">
                        <p><span><i class="fas fa-phone"></i> </span> <?php echo esc_html( get_option( 'atr_telefono' ) ); ?></p>
                    </div>
                    <div class="correo">
                        <p><span><i class="fas fa-envelope"></i></span> <?php echo esc_html( get_option( 'atr_correo' ) ); ?></p>
                    </div>
                    <div class="direccion">
                        <p><span><i class="fas fa-map-marker-alt"></i></span> <?php echo esc_html( get_option( 'atr_direccion' ) ); ?></p>
                        <?php 
                        $args = [
                            'theme_location' => 'menu_sociales',
                            'menu_class' => 'menu-sociales'
                        ];
                        wp_nav_menu( $args ); ?>
                    </div>
                </div>
            </div>
    </div>
   <div class="row copyright">
        <div class="col-xl-12 text-center">
            <p>Copyright @ <?php echo date('Y'); ?><span><?php echo bloginfo( 'name' ); ?></span> Todos los derechos Reservados </p>
        </div>
   </div>
</div>
</body>
</html>
