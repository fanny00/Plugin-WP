<?php
/**
 * Template Name: Galeria
 */
get_header(); ?>

<div class="container container-bloque container-galeria">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div id="modal-galeria" class="modal-galeria"></div>
        </div>
        <?php
            
            //Paso 1, obtengo el id de las imagenes
            $gallery = get_field('gallery', $post->ID, false);
            //Paso 2, separo los ids
            $gallery_ids = explode('"', $gallery);
            //var_dump($gallery_ids);
            //Paso 3, elijo el objeto que me devuelve los ids en una cadena de string y los separo
            $gallery_ids = $gallery_ids[3];
            //Utilizo el explode para separar el string y convertirlo en array
            $ids = explode(",", $gallery_ids);
            //Paso 4, creo un contador
            $i=0;

            foreach( $ids as $imagen_id):
                $imagen = wp_get_attachment_image_src( $imagen_id, 'medium' );
         ?>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 img-galeria text-center">

           <div class="sombra">
                <a href="<?php echo $imagen[0]; ?>"><span><i class="fas fa-search"></i></span></a>
           </div>
            <img class="imagen" id="imagen-<?php $i; ?>" src="<?php echo $imagen[0]; ?>" width="100%" alt="">

        </div>
        <?php $i++; endforeach; ?>
    </div>
</div>

<!--NEWSLETTER-->
<?php get_template_part('public/partials/newsletter'); ?>





<?php get_footer(); ?>