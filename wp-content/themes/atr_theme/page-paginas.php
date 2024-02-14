<?php
/**
 * Template Name: Paginas
 */
get_header(); ?>

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
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $eventos = new WP_Query($args);
            

            while ( $eventos->have_posts() ) : $eventos->the_post();
         ?>
         <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 page-paginas-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 imagen text-center">
                    <div class="sombra">
                        <a href="<?php the_permalink(); ?>"><i class="fas fa-link"></i></span></a>
                    </div>
                    <a href="<?php echo get_the_permalink(); ?>">
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

<?php get_template_part('public/partials/newsletter'); ?>


<?php get_footer(); ?>