<?php

class RES_Taxonomias{
    public function tipo_comida(){
        $post_types = ['post'];

        $labels = array(
            'name' => _x( 'Tipo de comida', 'taxonomy', 'taxonomy general name' ),
            'singular_name' => _x( 'Tipo de comida', 'taxonomy singular name' ),
            'search_items' => __( 'Buscar Tipo de comida' ),
            'all_items' => __( 'Todos los Tipo de comidas' ),
            'parent_item' => __( 'Tipo de comida Padre' ),
            'parent_item_colon' => __( 'Tipo de comida Padre:' ),
            'edit_item' => __( 'Editar Tipo de comida' ),
            'update_item' => __( 'Actualizar Tipo de comida' ),
            'add_new_item' => __( 'Agregar Nuevo Tipo de comida' ),
            'new_item_name' => __( 'Nuevo Tipo de comida' ),
            'menu_name' => __( 'Tipo de comida' ),
            ''
        );
    
        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'tipo-comida' ),
            //Campos api rest
            'show_in_rest' => true,
            'rest_base' => 'tipo-comida',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        );
    
        register_taxonomy( 'tipo-comida', $post_types, $args );
    }
}

/*
function atr_taxonomias(){
    $post_types = ['post'];

    $labels = array(
        'name' => _x( 'Tipo de comida', 'taxonomy', 'taxonomy general name' ),
        'singular_name' => _x( 'Tipo de comida', 'taxonomy singular name' ),
        'search_items' => __( 'Buscar Tipo de comida' ),
        'all_items' => __( 'Todos los Tipo de comidas' ),
        'parent_item' => __( 'Tipo de comida Padre' ),
        'parent_item_colon' => __( 'Tipo de comida Padre:' ),
        'edit_item' => __( 'Editar Tipo de comida' ),
        'update_item' => __( 'Actualizar Tipo de comida' ),
        'add_new_item' => __( 'Agregar Nuevo Tipo de comida' ),
        'new_item_name' => __( 'Nuevo Tipo de comida' ),
        'menu_name' => __( 'Tipo de comida' ),
        ''
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'tipo-comida' ),
        //Campos api rest
        'show_in_rest' => true,
        'rest_base' => 'tipo-comida',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    );

    register_taxonomy( 'tipo-comida', $post_types, $args );

}

add_action( 'init', 'atr_taxonomias' );
*/