<?php
/**
 * Template Name: Contacto
 */
get_header(); ?>

<div class="container container-bloque">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <?php while ( have_posts() ): the_post(); ?>
                <span class="title-page text-form"><?php the_content(); ?></span>
            <?php endwhile; ?>
            <form action="" method="post">
                <div class="row row-page-contact">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 name">
                        <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre" required>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 email">                       
                        <input type="email" name="email" id="email" placeholder="Tu Email" required>                        
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 telefono">                       
                        <input type="text" name="telefono" id="telefono" placeholder="Tu Teléfono" required>                        
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mensaje">                       
                        <textarea name="mensaje" id="mensaje" cols="30" rows="6" placeholder="Tu Mensaje" required></textarea>                      
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 enviar text-center">                       
                        <button type="submit" name="enviar" id="enviar" class="btn btn-dark">Enviar</button>  
                        <!--Este input estara oculto y me servira para verificar que se carga correctamente el form-->
                        <input type="hidden" name="oculto" value="1">                  
                    </div>
                </div>
            </form>
        
    </div>
</div>

<div class="container-fluid container-bloque">
    <div class="row row-page-contact-info">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 text-center">
                    <div class="info-telefono">
                        <p><span><i class="fas fa-phone"></i></span></p>
                        <p><?php echo esc_html( get_option( 'atr_telefono' ) ); ?></p>
                        <p></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 text-center">
                    <div class="info-direccion">
                        <p><span class="location"><i class="fas fa-map-marker-alt"></i></span></p>
                        <p><?php echo esc_html( get_option( 'atr_direccion' ) ); ?></p>
                        <p></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 text-center">
                    <div class="info-horario">
                        <p><span><i class="fas fa-clock"></i></span></p>
                        <p><?php echo get_field('horarios_semana'); ?></p>
                        <p><?php echo get_field('horarios_fin_de_semana'); ?></p>
                    </div>
                </div>
            </div>
        </div><!--/container-->
    </div><!--/row-page-contact-info-->
</div>

<div class="container-fluid container-map">
    <div class="row">
        <div id="map" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mapa"></div>
    </div>
</div>

<?php get_template_part( 'public/partials/newsletter' ); ?>

<?php get_footer(); ?>