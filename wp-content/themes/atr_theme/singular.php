<?php 
/**
 * Pagina para publicación unica de Blog
 */
get_header(); ?>


<div class="container container-bloque">
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 block-post">
            <div class="row row-block-post">
                <?php while ( have_posts() ): the_post(); ?>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 imagen">
                        <?php 
                            //Importante- poner $post->ID, como primer parametro
                            $size = 'post';
                            $imagen = get_the_post_thumbnail_url($post->ID, $size);
                        ?>
                        <?php if ( !is_page('mensaje-enviado') ) : ?>
                            <img class="img-fluid" src="<?php echo $imagen; ?>" alt="<?php bloginfo( 'name' ); ?>">
                        <?php endif; ?>
                    </div>
            
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 texto">
                        <?php the_content(); ?>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 comment-blog">
                        <p><?php comment_form(); ?></p>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 comment-blog-public">
                        <ul class="comment-list">
                            <?php 
                                $args = [
                                    'post_id' => $post->ID,
                                    'status' => 'approve'
                                ];
                                $comments = get_comments($args);
                                wp_list_comments( array(
                                    'per_page' => 10,
                                    'reverse_top_level' => false
                                ), $comments );
                            ?>
                        </ul>
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

<?php //var_dump( get_post_meta( 107, 'colores' ) ); ?>

<?php get_footer(); ?>
