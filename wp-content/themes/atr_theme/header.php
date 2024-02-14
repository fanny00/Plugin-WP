<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <!--Etiquetas Movil APP IOS-->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Gourmet">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.jpg">
    <!--Etiquetas Movil APP ANDROID-->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#333333">
    <meta name="aplication-name" content="Gourmet">
    <link rel="icon" type="image/png" href="<?php get_template_directory_uri(); ?>/icono.png">
    <title><?php wp_title('') ?><?php if ( wp_title( '', false ) ) { echo " : "; } ?><?php bloginfo( 'name' ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="container-fluid container-fluid-menu">
    <div class="row">
        <?php
            //$imagen = ATR_DIR_URI . '/public/img/logo.png';
         ?>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <a href="#">
                <?php
                    if ( function_exists( 'the_custom_logo' ) ){
                        the_custom_logo();
                    }
                 ?>
            </a>
        </div>
        
        <div class="col-xl-9 col-lg-9 col-md-6 col-sm-12 col-12">
           <nav class="menu-principal navbar navbar-expand-lg navbar-dark">
           <a class="navbar-brand" href="#">
                MENÚ
           </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle-navigation">
                    <span class="navbar-toggler-icon"></span> 
                </button>
                <?php
                    wp_nav_menu( array(
                        'theme_location'    => 'menu_principal',
                        'container_class'   => 'collapse navbar-collapse',
                        'container_id'      => 'navbarNav',
                        'menu_class'        => 'navbar-nav'
                    ) );
                 ?>
           </nav>
        </div><!--menu-->

    </div><!--row-->
</div><!--container-->

<div class="container-fluid container-slide">
    <div class="row">
        <?php
            if ( is_front_page() ){
                while( have_posts() ) : the_post();
            
         ?>

            
            <!--carousel para desktop--> 
            <?php get_template_part('public/partials/slide-desktop'); ?>

            
            <!--carrousel para tablet-->
            <?php get_template_part('public/partials/slide-tablet'); ?>

             <!--carrousel para movil-->
            <?php get_template_part('public/partials/slide-movil'); ?>
            

        <?php
                endwhile;
            } elseif( is_page() ){
                
                //$pagina_reservacion = get_option( 'Reservaciones' );
                $pagina_reservacion = get_option( 'page' );
                $id_imagen = get_post_thumbnail_id( $pagina_reservacion );
                $destacada = wp_get_attachment_image_src( $id_imagen, 'header' );
                //var_dump($destacada);
                $destacada = $destacada[0];
        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="header-top-imagen d-flex flex-column justify-content-center" style="background-image: url('<?php echo $destacada; ?>')">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </div>


        <?php 
        //is_home(), es para validar la pagina donde se publican todos los articulos de blog
            }elseif( is_home() ){ 

                $image = get_option('page_for_posts');
                $url = get_post_thumbnail_id($image);
                $url = wp_get_attachment_image_src($url, 'header');
                //var_dump($url);
                $url = $url[0];
            
        ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="header-top-imagen d-flex flex-column justify-content-center" style="background-image: url('<?php echo $url; ?>')">
                        <?php
                            $args = array(
                                'post_type' => 'page',
                                'name' => 'blog'
                            );

                            $titulo = new WP_Query($args);
                            while ( $titulo->have_posts( ) ): $titulo->the_post();
                        ?>
                        <h1><?php echo get_the_title( $titulo->post->ID );  ?></h1>

                        <?php endwhile; wp_reset_postdata(  ); ?>
                    </div>
                </div>
            </div>
        
        <!-- is_single(); es para la pagina de publicacion unica, aqui se ve el post completo-->
        <?php }elseif(is_single()) { ?>
            
            <?php
                $image = get_option('page_for_posts');
                $url = get_post_thumbnail_id($image);
                $url = wp_get_attachment_image_src($url, 'header');
                $url = $url[0];

                //Con get_post(); cogemos la info del post
                $entrada = get_post();
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="header-top-imagen d-flex flex-column justify-content-center" style="background-image: url('<?php echo $url; ?>')">
                       
                        <h1 class=""><?php echo $entrada->post_title; ?></h1>

                    </div>
                </div>
            </div>


        <?php } ?>

    </div>
</div>


            