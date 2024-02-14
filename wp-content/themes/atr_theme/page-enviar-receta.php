<?php 
/**
 * Pagina para publicación de recetas
 */
get_header(); ?>


<div class="container container-bloque">
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 block-post">
            <div class="row row-block-post">
                <?php while ( have_posts() ): the_post(); ?>
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <?php the_content(); ?>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 comment-blog">
                        <p><?php comment_form(); ?></p>
                    </div>
                    

                <?php endwhile; ?>
            </div><!--/row-block-post-->
        </div><!--/block-post-->
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <?php
                //llamaremos a un archivo sidebar con la funcion get_sidebar();
                //crearemos este archivo en nuestra raiz
                get_sidebar();
            ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>