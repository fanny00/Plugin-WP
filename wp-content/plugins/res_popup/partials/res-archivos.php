<?php
/**
 * Aqui encolamos todos los archivos css y js
 */


function enqueue_style( $hook ){

    if( $hook != 'toplevel_page_res_popup' ){
        return;
    }

    //Encolando css
    wp_enqueue_style(
        'admin-style',
        plugin_dir_url( __DIR__ ) . 'admin/css/app.css',
        [],
        '1.0.0',
        'all'
    );

    // Encolando la libreria de bootstrap 5
    wp_enqueue_style(
        'bootstrap-css', 
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.3.2/css/bootstrap.min.css', 
        [], 
        '5.3.2', 
        'all'
    );

    wp_enqueue_style(
        'bootstrap-rtl-css', 
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.3.2/css/bootstrap.rtl.min.css', 
        [], 
        '5.3.2', 
        'all'
    );

    wp_enqueue_style(
        'bootstrap-grid-css', 
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.3.2/css/bootstrap-grid.min.css', 
        [], 
        '5.3.2', 
        'all'
    );

    wp_enqueue_style(
        'bootstrap-grid-rtl-css', 
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.3.2/css/bootstrap-grid.rtl.min.css', 
        [], 
        '5.3.2', 
        'all'
    );

    wp_enqueue_style(
        'bootstrap-reboot-css', 
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.3.2/css/bootstrap-reboot.min.css', 
        [], 
        '5.3.2', 
        'all'
    );

    wp_enqueue_style(
        'bootstrap-reboot-rtl-css', 
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.3.2/css/bootstrap-reboot.rtl.min.css', 
        [], 
        '5.3.2', 
        'all'
    );

    wp_enqueue_style(
        'bootstrap-utilities-css', 
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.3.2/css/bootstrap-utilities.min.css', 
        [], 
        '5.3.2', 
        'all'
    );

    wp_enqueue_style(
        'bootstrap-utilities-rtl-css', 
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.3.2/css/bootstrap-utilities.rtl.min.css', 
        [], 
        '5.3.2', 
        'all'
    );

}

add_action('admin_enqueue_scripts', 'enqueue_style');

function enqueue_scripts( $hook ){

    if( $hook != 'toplevel_page_res_popup' ){
        return;
    }

    //Encolando js
    wp_enqueue_script(
        'admin-script',
        plugin_dir_url(__DIR__) . 'admin/js/app.js',
        ['jquery', 'bootstrap-min'],
        '1.0.0',
        true
    );

    //Encolando libreria de bootstrap
    wp_enqueue_script(
        'bootstrap-min',
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.3.2/js/bootstrap.min.js',
        ['jquery'],
        '5.0.0',
        true
    );

    wp_enqueue_script(
        'bootstrap-bundle',
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.3.2/js/bootstrap.bundle.min.js',
        ['jquery'],
        '5.0.0',
        true
    );

    //Función localize
    wp_localize_script(
        'admin-script',
        'dataPopup',
        array(
            'url'       => admin_url('admin-ajax.php'),
            'seguridad' => wp_create_nonce('resdata_seg'),
            'objeto'    => get_option('res_popup')
        )
    );

    //Función para crear popup con los datos
    wp_localize_script(
        'admin-script',
        'dataCreatePopup',
        array(
            'url'       => admin_url('admin-ajax.php'),
            'seguridad' => wp_create_nonce('resdata_seg')
        )
    );


}
add_action( 'admin_enqueue_scripts', 'enqueue_scripts' );
