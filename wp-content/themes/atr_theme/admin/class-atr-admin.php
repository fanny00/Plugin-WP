<?php

/**
 * La funcionalidad específica de administración del theme.
 *
 * @link       https://newtheme.eu
 * @since      1.0.0
 *
 * @package    newtheme_blank
 * @subpackage newtheme_blank/admin
 */

/**
 * Define el nombre del theme, la versión y dos métodos para
 * Encolar la hoja de estilos específica de administración y JavaScript.
 * 
 * @since      1.0.0
 * @package    ATR THEME
 * @subpackage ATR THEME/admin
 * @author     Jhon J.R <info@newtheme.eu>
 * 
 * @property string $theme_name
 * @property string $version
 */
class ATR_Admin {
    
    /**
	 * El identificador único de éste theme
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $theme_name  El nombre o identificador único de éste theme
	 */
    private $theme_name;
    
    /**
	 * Versión actual del theme
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version  La versión actual del theme
	 */
    private $version;
    
    /**
	 * Objeto registrador de menús
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $build_menupage  Instancia del objeto ATR_Build_Menupage
	 */
    private $build_menupage;
    
    /**
	 * Objeto ATR_Normalize
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $normalize Instancia del objeto ATR_Normalize
	 */
    private $normalize;
    
    /**
	 * Objeto ATR_Helpers
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $helpers Instancia del objeto ATR_Helpers
	 */
    private $helpers;
    
    /**
     * @param string $theme_name nombre o identificador único de éste theme.
     * @param string $version La versión actual del theme.
     */
    public function __construct( $theme_name, $version ) {
        
        $this->theme_name = $theme_name;
        $this->version = $version;
        $this->build_menupage = new ATR_Build_Menupage();
        $this->normalize = new ATR_Normalize;
        
    }
    
    /**
	 * Registra los archivos de hojas de estilos del área de administración
	 *
	 * @since    1.0.0
     * @access   public
     *
     * @param    string   $hook    Devuelve el texto del slug del menú con el texto toplevel_page
	 */
    public function enqueue_styles( $hook ) {
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en ATR_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El ATR_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */
        
        /**
         * atr-admin.css
         * Archivo de hojas de estilos principales
         * de la administración
         */
		wp_enqueue_style( 'atr_wordpress_icons_css', ATR_DIR_URI . 'admin/css/atr-wordpress.css', array(), $this->version, 'all' );
        
        /**
         * Condicional para controlar la carga de los archivos
         * solamente en la página del plugin
         */
        if( $hook != 'toplevel_page_atr-opt' ) {
            return;
        }
        
        /**
         * atr-admin.css
         * Archivo de hojas de estilos principales
         * de la administración
         */
		wp_enqueue_style( $this->theme_name, ATR_DIR_URI . 'admin/css/atr-admin.css', array(), $this->version, 'all' );
        
    }
    
    /**
	 * Registra los archivos Javascript del área de administración
	 *
	 * @since    1.0.0
     * @access   public
     *
     * @param    string   $hook    Devuelve el texto del slug del menú con el texto toplevel_page
	 */
    public function enqueue_scripts( $hook ) {
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en ATR_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El ATR_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */
        
        /**
         * Condicional para controlar la carga de los archivos
         * solamente en la página del theme
         */
        if( $hook != 'toplevel_page_atr-opt' ) {
            return;
        }
        
        wp_enqueue_media();
        
        /**
         * atr-admin.js
         * Archivo Javascript principal
         * de la administración
         */
        wp_enqueue_script( $this->theme_name, ATR_DIR_URI . 'admin/js/atr-admin.js', [ 'jquery' ], $this->version, true );
        
        /**
         * Lozalizando el archivo Javascript
         * principal del área de administración
         * para pasarle el objeto "bcpg" con los parámetros:
         * 
         * @param bcpg.url        Url del archivo admin-ajax.php
         * @param bcpg.seguridad  Nonce de seguridad para el envío seguro de datos
         */
        wp_localize_script(
            $this->theme_name,
            'atrAdmin',
            [
                'url'       => admin_url( 'admin-ajax.php' ),
                'seguridad' => wp_create_nonce( 'atr_seg' )
            ]
        );
        
    }

    public function enqueue_style_dbform( $hook ){
        /**
         * Condicional para controlar la carga de los archivos en el submenu ATR Options
         * solamente en la página del theme
         */
        if( $hook != 'atr-opciones_page_db_form' ) {
            return;
        }
         /**
         * Sweetalert2 https://sweetalert2.github.io/#download
         * descargaremos el paquete desde la consola de windows con :
         * npm install sweetalert2
         * encolamos el min.css
         */
        wp_enqueue_style( $this->theme_name, ATR_DIR_URI . 'helpers/sweetalert2/sweetalert2.min.css', array(), $this->version, 'all' );
    }

    public function enqueue_script_dbform($hook){
        /**
         * Condicional para controlar la carga de los archivos en el submenu ATR Options
         * solamente en la página del theme
         */
        if( $hook != 'atr-opciones_page_db_form' ) {
            return;
        }

        wp_enqueue_media();

        /**
         * Sweetalert2 https://sweetalert2.github.io/#download
         * descargaremos el paquete desde la consola de windows con :
         * npm install sweetalert2
         * encolamos el allmin.js y el min.css
         */
        wp_enqueue_script( $this->theme_name, ATR_DIR_URI . 'helpers/sweetalert/sweetalert2.all.js', ['jquery'], $this->version, true );


        /**
         * atr-dbform.js
         * Archivo Javascript para el submenu dbform
         * de la administración
         */
        wp_enqueue_script( 'dbform', ATR_DIR_URI . 'admin/js/atr-dbform.js', [ 'jquery' ], $this->version, true );
        
        /**
         * Lozalizando el archivo Javascript
         * principal del área de administración, aqui nombramos la url
         * para pasarle el objeto "bcpg" con los parámetros:
         * 
         * @param bcpg.url        Url del archivo admin-ajax.php, este admin ajax es un archivo de wordpress
         * @param bcpg.seguridad  Nonce de seguridad para el envío seguro de datos
         */
        wp_localize_script(
            'dbform',
            'url_eliminar',
            [
                'urlajax'       => admin_url( 'admin-ajax.php' ),
                'seguridad' => wp_create_nonce( 'atr_seg' )
            ]
        );
    }

    /**
     * Estas funciones cargaran los archivos css y js para el formulario de reservas
     */

    public function enqueue_style_dbreservas( $hook ){

         /**
         * Condicional para controlar la carga de los archivos en el submenu ATR Options
         * solamente en la página del theme
         */
        if( $hook != 'atr-opciones_page_db_reservas' ) {
            
            return;
        }

          /**
         * Sweetalert2 https://sweetalert2.github.io/#download
         * descargaremos el paquete desde la consola de windows con :
         * npm install sweetalert2
         * encolamos el min.css
         */
        wp_enqueue_style( $this->theme_name, ATR_DIR_URI . 'helpers/sweetalert2/sweetalert2.min.css', array(), $this->version, 'all' );


    }

    public function enqueue_script_dbreservas($hook){

         /**
         * Condicional para controlar la carga de los archivos en el submenu ATR Options
         * solamente en la página del theme
         */
        if( $hook != 'atr-opciones_page_db_reservas' ) {
            return;
        }

        wp_enqueue_media();

        /**
         * Sweetalert2 https://sweetalert2.github.io/#download
         * descargaremos el paquete desde la consola de windows con :
         * npm install sweetalert2
         * encolamos el allmin.js y el min.css
         */
        wp_enqueue_script( $this->theme_name, ATR_DIR_URI . 'helpers/sweetalert/sweetalert2.all.js', ['jquery'], $this->version, true );


        /**
         * atr-dbreservas.js
         * Archivo Javascript para el submenu dbreservas
         * de la administración
         */
        wp_enqueue_script( 'dbreservas', ATR_DIR_URI . 'admin/js/atr-dbreservas.js', [ 'jquery' ], $this->version, true );
        
        /**
         * Lozalizando el archivo Javascript
         * principal del área de administración, aqui nombramos la url
         * para pasarle el objeto "bcpg" con los parámetros:
         * 
         * @param bcpg.url        Url del archivo admin-ajax.php, este admin ajax es un archivo de wordpress
         * @param bcpg.seguridad  Nonce de seguridad para el envío seguro de datos
         */
        wp_localize_script(
            'dbreservas',
            'url_eliminar_reserva',
            [
                'urlajax'       => admin_url( 'admin-ajax.php' ),
                'seguridad' => wp_create_nonce( 'atr_seg' )
            ]
        );

    }
    
    /**
	 * Registra los menús del theme en el
     * área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function add_menu() {
        
        $this->build_menupage->add_menu_page(
            __( 'ATR Opciones', 'atr-opt' ),
            __( 'ATR Opciones', 'atr-opt' ),
            'manage_options',
            'atr-opt',
            [ $this, 'controlador_display_menu' ],
            ATR_DIR_URI . 'admin/img/config.png',
            22
        );

        /**
         * Asi agregamos el submenu DB form
         */
        $this->build_menupage->add_submenu_page(

            __('atr-opt', 'atr-opt'),
            __('DB form', 'atr-opt'),
            __('DB form', 'atr-opt'),
            'manage_options',
            'db_form',
            [ $this, 'controlador_display_submenu' ]
        );

        
        /**
         * Asi agregamos el submenu DB Reservas
         */
        $this->build_menupage->add_submenu_page(

            __('atr-opt', 'atr-opt'),
            __('DB Reservas', 'atr-opt'),
            __('DB Reservas', 'atr-opt'),
            'manage_options',
            'db_reservas',
            [ $this, 'controlador_display_submenu_reservas' ]
        );
        
        $this->build_menupage->run();
        
    }

    public function atr_registrar_opciones(){

        /**
         * Aqui Pasare una a una el grupo de opciones
         * esto registrara la info que introduzcamos dentro de cada input del grupo que he registrado
         * despues vamos al formulario del admin  ATR Opt y utilizamos settings_fields()
         */
        register_setting('atr_opciones_grupo', 'atr_direccion');
        register_setting('atr_opciones_grupo', 'atr_telefono');
        register_setting('atr_opciones_grupo', 'atr_correo');
        
        //Nuevo grupo para la api maps de google, atr_opciones_map, es el nombre del grupo
        register_setting('atr_opciones_map', 'atr_latitud');
        register_setting('atr_opciones_map', 'atr_longitud');
        register_setting('atr_opciones_map', 'atr_zoom');
        register_setting('atr_opciones_map', 'atr_api_key');
    }
    
    /**
	 * Controla las visualizaciones del menú
     * en el área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function controlador_display_menu() {
        
        require_once ATR_DIR_PATH . 'admin/partials/atr-admin-display.php';
        
    }
    public function controlador_display_submenu(){

        require_once ATR_DIR_PATH . 'admin/partials/atr-submenu-dbform.php';
        
    }
    public function controlador_display_submenu_reservas(){

   
        require_once ATR_DIR_PATH . 'admin/partials/atr-submenu-dbreservas.php';
    }



    
}




















