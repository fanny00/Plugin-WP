<?php

/**
 * Plugin Name: CPT Plugin
 * Plugin Uri: https://newtheme.eu
 * Description: Este es un plugin para agregar un CPT
 * Version: 1.0.0
 * Requires PHP: 7.0
 * Author: Newtheme
 * Author Uri: https://newtheme.eu
 * License: GPL V2
 * License Uri: https://www.gnu.org/licences/gpl-2.0.html
 * Text Domain: cpt-plugin
 * Domain Path: /languages
 */


function atr_post_type_recetas(){

    //Etiqueta para el post type
    $labels = array(
        'name' => _x( 'metas', 'Post Type General Name', 'cpt-plugin' ),
        'singular_name' => _x( 'Receta', 'Post type Singular Name', 'cpt-plugin' ),
        'menu_name' => __(' Recetas', 'cpt-plugin' ),
        'parent_item_colon' => __( 'Menu Padre', 'cpt-plugin' ),
        'all_items' => __( 'Todas las Recetas', 'cpt-plugin'),
        'view_item' => __( 'Ver Menu', 'cpt-plugin' ),
        'add_new_item' => __( 'Agregar Nueva Receta', 'cpt-plugin' ),
        'add_new' => __( 'Agregar Nueva Receta', 'cpt-plugin' ),
        'edit_item' => __( 'Editar Receta', 'cpt-plugin' ),
        'update_item' => __( 'Actualizar Receta', 'cpt-plugin' ),
        'search_items' => __('Buscar Receta', 'cpt-plugin' ),
        'not_found' => __( 'No encontrado', 'cpt-plugin' ),
        'not_found_in_trash' => __( 'No encontrado en la papelera', 'cpt-plugin' ) 
    );

    // Otras opciones para el post type
    $args = array(
        'label' => __( 'Recetas', 'cpt-plugin' ),
        'description' => __( 'Receta news and reviews', 'cpt-plugin' ),
        'labels' => $labels,
        // Todo lo que soporta este post type
        'supports' => array( 
            'title', 
            'editor', 
            'excerpt', 
            'author', 
            'thumbnail', 
            'comments', 
            'revisions', 
            'custom-fields', ),
        /* Un Post Type hierarchical es como las paginas y puede tener padres e hijos.
        * Uno sin hierarchical es como los posts
        */
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-page',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        //Habilitando la wp res appi
        'show_in_rest' => true,
        'rest_base' => 'recetas-appi',
        'rest_controller_class' => 'WP_REST_Posts_controller'
    );

    //Registrar el post CPT
    register_post_type( 'recetas', $args );
}

add_action('init', 'atr_post_type_recetas' );

