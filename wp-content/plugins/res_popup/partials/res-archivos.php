<?php 
/**
 * Aquí encolaremos todos los archivos css y js
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

    //Encolando la libreria de bootstrap 5
    wp_enqueue_style(
        'bootstrap-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.0/css/bootstrap.min.css',
        [],
        '5.0.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-rtl-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.0/css/bootstrap.rtl.min.css',
        [],
        '5.0.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-grid-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.0/css/bootstrap-grid.min.css',
        [],
        '5.0.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-grid-rtl-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.0/css/bootstrap-grid.rtl.min.css',
        [],
        '5.0.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-reboot-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.0/css/bootstrap-reboot.min.css',
        [],
        '5.0.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-reboot-rtl-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.0/css/bootstrap-reboot.rtl.min.css',
        [],
        '5.0.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-utilities-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.0/css/bootstrap-utilities.min.css',
        [],
        '5.0.0',
        'all'
    );

    wp_enqueue_style(
        'bootstrap-utilities-rtl-css',
        plugin_dir_url( __DIR__ ) . 'helpers/bootstrap-5.0/css/bootstrap-utilities.rtl.min.css',
        [],
        '5.0.0',
        'all'
    );

    /**
     * Función para utilizar el marco multimedia de wordpress
     */
    wp_enqueue_media();

}
add_action( 'admin_enqueue_scripts', 'enqueue_style' );


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
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.0/js/bootstrap.min.js',
        ['jquery'],
        '5.0.0',
        true
    );

    wp_enqueue_script(
        'bootstrap-bundle',
        plugin_dir_url(__DIR__) . 'helpers/bootstrap-5.0/js/bootstrap.bundle.min.js',
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

//Función para recibir el ajax
function res_data_popup(){

    check_ajax_referer('resdata_seg', 'nonce');

    if( current_user_can('manage_options') ){

        extract( $_POST, EXTR_OVERWRITE );

        if( $tipo == 'add' ){

            if( get_option('res_popup') == null ){

                $args[] = array(
                    'nombre' => $nombre,
                    'id' => $id
                );

                $data = update_option( 'res_popup', $args, true );

                $json = json_encode([
                    'data' => $data,
                    'objeto' => $args
                ]);

            }else if( get_option( 'res_popup' ) != null ){

                $args = array(
                    'nombre' => $nombre,
                    'id' => $id
                );

                $objeto = get_option('res_popup');
                array_push( $datos_u, $args );
                $data = update_option( 'res_popup', $datos_u, true );

                $json = json_encode([
                    'objeto' => $objeto,
                    'datos_u' => $datos_u,
                    'id' => $id
                ]);

            }

        }else if( $tipo == 'delete' ){

            $data = get_option( 'res_popup' );

            //Convertimos el valor $objeto a entero
            $objeto = (int) $objeto;

            if( is_int($objeto) ){

                unset($data[$objeto]);
                $update_data = update_option('res_popup', $data, true);

            }

            if( get_option($nombre) != null ){

                $deleteObject = delete_option($nombre);

            }

            $json = json_encode([
                'objeto' => $objeto,
                'datos' => $data,
                'nombre' => $nombre
            ]);

        }

        echo $json;
        wp_die();

    }
    
}
add_action( 'wp_ajax_res_data_popup', 'res_data_popup' );

//Función para crear el popup con los datos del ajax
function res_create_popup(){

    check_ajax_referer('resdata_seg', 'nonce');

    if( current_user_can('manage_options') ){

        extract( $_POST, EXTR_OVERWRITE );

        if( $tipo == 'create' ){

            if( get_option($nombre) == null ){

                $args[] = array(
                    'nombre'        => $nombre,
                    'titulo'        => $titulo,
                    'subtitulo'     => $subtitulo,
                    'imagen'        => $imagen,
                    'texto'         => $texto,
                    'buttonCheck'   => $buttonCheck,
                    'buttonTitle'   => $buttonTitle,
                    'buttonCheck1'  => $buttonCheck1,
                    'buttonCheck2'  => $buttonCheck2,
                    'buttonUrl'     => $buttonUrl
                );

                $data = add_option( $nombre, $args, true );
                $objeto = get_option( $nombre );

                $json = json_encode([
                    'data' => $data,
                    'objeto' => $objeto
                ]);

            }else if( get_option($nombre) != null ){

                $args[] = array(
                    'nombre'        => $nombre,
                    'titulo'        => $titulo,
                    'subtitulo'     => $subtitulo,
                    'imagen'        => $imagen,
                    'texto'         => $texto,
                    'buttonCheck'   => $buttonCheck,
                    'buttonTitle'   => $buttonTitle,
                    'buttonCheck1'  => $buttonCheck1,
                    'buttonCheck2'  => $buttonCheck2,
                    'buttonUrl'     => $buttonUrl
                );

                $data = update_option( $nombre, $args, true );
                $objeto = get_option( $nombre );

                $json = json_encode([
                    'data' => $data,
                    'objeto' => $objeto
                ]);

            }

        }

        echo $json;
        wp_die();

    }
    
}
add_action( 'wp_ajax_res_create_popup', 'res_create_popup' );