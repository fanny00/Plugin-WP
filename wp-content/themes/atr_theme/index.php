<?php
/**
 * Esta es la pagina donde se publicaran todas las entradas de blog
 **/ 
get_header(); ?>


<div class="container container-bloque container-blog">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center text-content">
            <?php 
                $args = array(
                    'post_type'     => 'page',
                    'name'          => 'blog'
                );
                $titulo = new WP_Query($args);
                while ( $titulo-> have_posts() ): $titulo->the_post();
                echo get_the_content($titulo->post->ID);
                //var_dump(the_content());
                endwhile; wp_reset_postdata(  );
             ?>
        </div>

        <?php 
            //Asi obtenemos un count de los post publicados;
            $count_posts = wp_count_posts('post');
            $lista = $count_posts->publish;
            $lista = $lista;
            //var_dump($lista);
            $i = 0;

        ?>
        
        <?php
             while ( have_posts() ): the_post(); 
             //creo un operador ternario
             $contador = $i % 2 == 1 ? 'reverse' : 'normal';
             //var_dump($contador);
             $i++;
        ?>
    
       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row content-blog <?php echo $contador; ?>">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 position-1" >
                    <?php $imagen = get_the_post_thumbnail_url(); ?>
                    <a href="#">
                        <img class="img-fluid" src="<?php echo $imagen; ?>" alt="<?php bloginfo('name'); ?>">
                    </a>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 position-2">
                    <a href="<?php the_permalink(); ?>">
                        <!--aqui el date-->
                        <?php the_title('<h5>', '</h5>'); ?>
                    </a>
                    <span><?php the_excerpt(); ?></span>
                    <div>
                        <a type="button" class="btn btn-dark" href="<?php the_permalink() ?>">ver más</a>
                    </div>
                </div>
            </div><!--/row-->
       </div>
        <?php endwhile; ?>
    </div>
</div>

<?php echo get_template_part( 'public/partials/newsletter' ) ?>

<?php get_footer(); ?>