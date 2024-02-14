<?php 
/**
 * Template Name: Menu 1
 */
get_header(); ?>

<div class="container-fluid container-menu-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 text-center titulo-menu">
                    <span><?php the_title('<h3>', '</h3>'); ?></span>
                    <hr class="linea1">
                    <hr class="linea2">
                </div>
                <?php
                    //Aqui creare el WP_Query que mostrara las entradas de los post
                    $args = array(
                        'post_type'         => 'menus',
                        'category_name'     => 'ensaladas',
                        'posts_per_page'    => 6,
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

<?php get_template_part('public/partials/newsletter'); ?>




<?php get_footer(); 