<?php

/**
 * Este sera  el archivo de la pagina de Inicio
 */
get_header(); ?>

<div class="container container-bloque">
    <div class="row row-front">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 position">
            <div class="row row-front-page-gallery">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div id="modal-galeria" class="modal-galeria"></div>
                    </div>
                    <?php 
                        //con esto obtengo la linea de codigo que tiene los ids de las imagenes de la galeria
                        $galeria = get_field('galeria', $post->ID, false);

                        //con esta linea de codigo obtengo un array de objetos, debo buscar en cual objeto
                        //estan los ids, en mi caso es el 7
                        $imagenes_ids = explode('"', $galeria);
                        //var_dump($imagenes_ids);

                        //Ahora con esta linea apunto al objeto numero 7 para obtener los ids
                        $imagenes_ids = $imagenes_ids[5];

                        //ahora utilizo de nuevo el explode(), para separar el string en objetos
                        $ids = explode(",", $imagenes_ids);
                        //var_dump($ids);

                        //creo un contador $i
                        $i = 0;
                        

                        foreach ( $ids as $imagen_id ):
                            
                            $imagen_galeria = wp_get_attachment_image_src( $imagen_id, 'medium' );
                            //var_dump($imagen_id);
                    ?>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 imagen">
                                <div class="sombra">
                                    <a href="<?php echo $imagen_galeria[0]; ?>" data-toggle="modal" data-target="#exampleModalCenter"><span><i class="fas fa-search"></i></span></a>
                                </div>
                                <a href="#">
                                    <!--IMPORTANTE : AQUI PONDREMOS $imagen_galeria[0], y con cada vuelta
                                    de bucle se incrementara 1,2,3...-->
                                    <img class="img-fluid" src="<?php echo $imagen_galeria[0]; ?>" alt="">
                                </a>
                            </div>
                        <?php $i++; endforeach; ?> 
            </div><!--/row-front-page-gallery-->
        </div><!--/col-->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 text-content">
                <div class="contenido">
                    <?php echo get_the_content(  ); ?>
                    <div class="boton-container">
                        <a href="#" type="button" class="btn btn-dark boton-view">view details</a>
                    </div>
                </div>
            </div>
    </div><!--/row-front-->
</div><!--/container-->

<div class="container-fluid container-bloque container-separador">
    <div class="row">
    <?php $imagen = get_field('bloque-imagen1'); ?>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 bloque-imagen" style="background-image: url('<?php echo $imagen; ?>')">
            <div class="container">
                <div class="row bloque-texto">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="texto text-content">
                            <?php the_field('texto1'); ?>
                            <div class="boton-container">
                                <a href="#" type="button" class="btn btn-dark boton-view">view details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>

<div class="container container-bloque container-reservaciones">
   <?php get_template_part( 'public/partials/form', 'reservaciones' ); ?>
</div>



<!--Menu-page-->
<div class="container-fluid container-menu-page container-bloque">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 text-center titulo-menu">
                    <span>
                    <?php
                    $tituloMenu = new WP_Query('pagename=menu');
                    while( $tituloMenu->have_posts()): $tituloMenu->the_post(); 
                    the_title('<h3>', '</h3>');
                        endwhile; wp_reset_postdata(  ) ;
                    ?>
                    </span>
                    <hr class="linea1">
                    <hr class="linea2">
                </div>
                <?php
                    //Aqui creare el WP_Query que mostrara las entradas de los post
                    $args = array(
                        'post_type'         => 'menus',
                        'category_name'     => 'menu-principal',
                        'posts_per_page'    => 4,
                        'orderby'           => 'date',
                        'order'             => 'DESC'
                    );

                    $menu = new WP_Query($args);

                    while ( $menu->have_posts() ): $menu->the_post();
         
                    ?>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 menu-page">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 imagen">
                            <?php $imagen = get_the_post_thumbnail_url(  ); ?>
                            <a href="<?php the_permalink( ); ?>">
                                <img class="img-fluid" src="<?php echo $imagen; ?>" alt="<?php bloginfo( 'name' ); ?>">
                            </a>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12 texto">
                            <a href="">
                                <p class="title"><?php the_title(); ?><span><?php the_field('precio'); ?></span></p>
                            </a>
                            <span class="description"><?php the_content(); ?></span>
                        </div>
                    </div>
                </div>

                <?php endwhile; wp_reset_postdata(  ); ?>
            </div><!--/row-->
        </div><!--/container-->
</div><!--/container-fluid-->

<!--Eventos-->
<div class="container container-bloque">
    <div class="row row-paginas">
        <?php 
            $encabezado = new WP_Query('pagename=paginas');
            while ( $encabezado->have_posts() ) : $encabezado->the_post();
                 
        ?>
        <div class="col-xl-12-col-lg-12 col-md-12 col-sm-12 col-12 text-content">
            <?php the_content($encabezado->post->ID);  ?>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
        <?php
            $args = array(
                'post_type' => 'eventos',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $eventos = new WP_Query($args);
            //$imagen = get_the_post_thumbnail_url($eventos->post->ID, false);

            while ( $eventos->have_posts() ) : $eventos->the_post();
         ?>
         <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 page-paginas-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 imagen text-center">
                    <div class="sombra">
                        <a href=""><i class="fas fa-link"></i></span></a>
                    </div>
                    <a href="#">
                        <!--Importante: debe de ponerse la funcion get_the_post_thumbnail_url()
                        dentro del src sin haberla encapsulado previamente en una variable-->
                        <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url( ); ?>" alt="<?php echo bloginfo( 'name' ); ?>">
                    </a>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 contenido">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title('<h5>', '</h5>'); ?>
                    </a>
                    <p class="contenido-fecha">
                        <span class="fecha"><i class="far fa-calendar-alt"></i></span><?php the_field('fecha'); ?>
                        <span class="hora"><i class="fas fa-clock"></i></span><?php the_field('hora'); ?>
                    </p>
                    <span><?php the_excerpt(); ?></span>
                </div>
            </div>
         </div><!--/page-paginas-content-->
        <?php endwhile; wp_reset_postdata(  ); ?>
    </div><!--/row-paginas-->
</div>

<!--bloque parallax-->
<div class="container-fluid container-bloque container-separador">
    <div class="row">
        <?php 
            $imagen = get_option('page_for_posts');

        ?>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 bloque-imagen bloque-imagen-2" style="background-image: url('<?php echo get_the_post_thumbnail_url($imagen, false); ?>')">
            <div class="container container-blog-front-page">
                <div class="row">
                    
                        <?php
                            $args = array(
                                'post_type'         => 'post',
                                'posts_per_page'    => 1,
                                'orderby'           => 'rand',
                                'order'             => 'DESC'
                            );
                            $publicacion = new WP_Query($args);
                            while ( $publicacion->have_posts() ) : $publicacion->the_post();
                        ?>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 imagen">
                            <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo bloginfo('name'); ?>">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 content">
                            <a class="titulo" href="<?php the_permalink(); ?>">
                                <!--aqui el date-->
                                <?php the_title('<h5>', '</h5>'); ?>
                            </a>
                                <span><?php the_excerpt(); ?></span>
                            <div>
                                <a type="button" class="btn btn-dark" href="<?php the_permalink() ?>">ver más</a>
                            </div>
                        </div>
                        <?php endwhile; wp_reset_postdata(  ); ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!--NEWSLETTER-->
<?php get_template_part('public/partials/newsletter'); ?>


<?php get_footer(); ?>