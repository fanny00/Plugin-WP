<?php
/*
*Template Name: Reservas
*/
 get_header(); ?>

<div class="container container-bloque container-reservaciones">
    <?php get_template_part( 'public/partials/form', 'reservaciones' ); ?>
</div>

<?php get_template_part('public/partials/newsletter'); ?>

<?php get_footer(); ?>