<?php

/**
 * La funcionalidad específica de administración del theme.
 *
 * @link       https://newtheme.eu
 * @since      1.0.0
 *
 * @package    theme_name
 * @subpackage theme_name/admin
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
class ATR_Public {
    
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
        $this->normalize = new ATR_Normalize;
        
    }
    
    /**
	 * Registra los archivos de hojas de estilos del área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function enqueue_styles() {
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en ATR_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El ATR_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */
        
        wp_enqueue_style( $this->theme_name, ATR_DIR_URI . 'public/css/atr-public.css', array(), $this->version, 'all' );
        
        /**
         * Bootstrap 4.0 css
         * https://getbootstrap.com/docs/4.0/getting-started/introduction/
         */
        wp_enqueue_style( 'bootstrap-grid', ATR_DIR_URI . 'helpers/bootstrap_4.1.3/css/bootstrap-grid.css', array(), '4.0.0', 'all');
        wp_enqueue_style( 'bootstrap-reboot', ATR_DIR_URI . 'helpers/bootstrap_4.1.3/css/bootstrap-reboot.css', array(), '4.0.0', 'all');
        wp_enqueue_style( 'bootstrap-min', ATR_DIR_URI . 'helpers/bootstrap_4.1.3/css/bootstrap.css', array(), '4.0.0', 'all');

        /**
         * Fontawesome 5.3
         * https://fontawesome.com
         */
        wp_enqueue_style('brands', ATR_DIR_URI . 'helpers/fontawesome_5.3.1/css/brands.min.css', array(), '5.3.1', 'all');
        wp_enqueue_style( 'fontawesome', ATR_DIR_URI . 'helpers/fontawesome_5.3.1/css/fontawesome.min.css', array(), '5.3.1', 'all' );
        //wp_enqueue_style('regular', ATR_DIR_URI . 'helpers/fontawesome_5.1.3/css/regular.min.css', array(), '5.3.1', 'all' );
        //wp_enqueue_style( 'solid', ATR_DIR_URI . 'helpers/fontawesome_5.1.3/css/solid.min.css', array(), '5.3.1', 'all' );
        
    }
    
    /**
	 * Registra los archivos Javascript del área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function enqueue_scripts() {
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en ATR_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El ATR_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */        
        
        wp_enqueue_script( $this->theme_name, ATR_DIR_URI . 'public/js/atr-public.js', array( 'jquery'), $this->version, false );
        wp_enqueue_style( 'normalize', ATR_DIR_URI . 'public/css/normalize.css', array(), '8.0.0', 'all' );

        /**
         * Fuentes de google "google fonts"
         * Fuente josefin sans y domine para los h1.h2...
         * https://fonts.google.com/?query=roboto&selection.family=Roboto:300
         */
        wp_enqueue_style( 'josefin', 'https://fonts.googleapis.com/css?family=Josefin+Sans' );

        wp_enqueue_style( 'domine', 'https://fonts.googleapis.com/css?family=Domine' );

        /**
         * Bootstrap js
         * https://getbootstrap.com/docs/4.0/getting-started/introduction/
         */
        wp_enqueue_script( 'bootstrap-bundle', ATR_DIR_URI . 'helpers/bootstrap_4.1.3/js/bootstrap.bundle.min.js', array('jquery'), '4.0.0', true );
        wp_enqueue_script( 'bootstrap-min', ATR_DIR_URI . 'helpers/bootstrap_4.1.3/js/bootstrap.min.js', array('jquery'), '4.0.0', true );

        /**
         * fontawesome 5.3.1 js
         * https://fontawesome.com
         */
        wp_enqueue_script('brands-js', ATR_DIR_URI . 'helpers/fontawesome_5.3.1/js/brands.min.js', array(), '5.3.1', true );
        wp_enqueue_script('fontawesome-js', ATR_DIR_URI . 'helpers/fontawesome_5.3.1/js/fontawesome.min.js', array(), '5.3.1', true );
        wp_enqueue_script('regular-js', ATR_DIR_URI . 'helpers/fontawesome_5.3.1/js/regular.min.js', array(), '5.3.1', true );
        wp_enqueue_script('solid-js', ATR_DIR_URI . 'helpers/fontawesome_5.3.1/js/solid.min.js', array(), '5.3.1', true );

        /**
         *Google Maps 
         *IMPORTANTE : definir en el array que se cargue la libreria jquery
         */
        $api_key = esc_html( get_option('atr_api_key') );
        wp_enqueue_script('mapa', 'https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&callback=initMap', array('jquery'), '', true );

        /**
         * Pasamos las variables de php a javascript
         * Aquí pasaremos los valores de latitud, longitud y zoom 
         */
        wp_localize_script( 
            //este es el nombre del archivo javascript donde pasare los valores
            $this->theme_name,
            //este es el nombre que le dare a la variable atr_opciones 
            'atr_opciones', 
            array(
                'latitud'   => get_option( 'atr_latitud' ),
                'longitud'  => get_option( 'atr_longitud' ),
                'zoom'      => get_option( 'atr_zoom' )
            ) 
        );

        /**
         * Nuevo wp_localize para crear un modal de imagenes
         * Parametros : $handle, $name, $object
         * $handle : nombre del archivo donde escribire el script
         * $name : nombre de la variable que creare y utilizare
         * $object : por defecto es un array de objetos y por defecto si es un array
         * utilizaremos la funcion admin_url('admin-ajax.php)
         */
        wp_localize_script(
            $this->theme_name,
            'atr_ruta',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
            )
        );

        /**
         * Creamos el wp_localize_script(), para la pagina galeria
         */
        wp_localize_script(
            $this->theme_name,
            'atr_ruta_galeria',
            array(
                'ajaxurl' => admin_url('admin-ajax.php')
            )
        );
        
    }

    /**
     * funcion ajax para el modal de la galeria del frontend
     */
    public function atr_enviar_ruta() {

        $post_ruta = $_POST['post_ruta'];
        $ruta = $post_ruta;
        // echo $post_ruta; ?>

        <div class="modal-content">
            <span class="close">&times;</span>
            <img src="<?php echo $ruta; ?>" alt="">
            <div class="galeria">
                <!-- holaa -->
            </div>
        </div> 
        

    <?php   die(); 
    }

    /**
     * Funcion ajax para el modal de la galeria de la pagina galeria
     */
    public function atr_enviar_ruta_page_galeria(){
        $post_ruta_galeria = $_POST['post_ruta_galeria'];
        $ruta = $post_ruta_galeria; ?>

        <div class="modal-content">
            <span class="close">&times;</span>
            <img src="<?php echo $ruta; ?>" alt="">
        </div> 
        
        <?php die();
    }

    // public function atr_agregar_async_defer( $tag, $handle ){
    //     if ( 'mapa' !== $handle ){
            
    //         return str_replace(' src', ' async="async" defer="defer" src', $tag );
    //     }
    //     return $tag;
    // }

    public function atr_register_sidebars(){
        /**
         * sidebar para el blog, aqui mostrare las ultimas entradas
         */
        register_sidebar(array(
            'name' => __('Sidebar Blog', 'atr-opt'),
            'id' => __('sidebar_blog', 'atr-opt'),
            'description' => __('sidebar para el blog', 'atr-opt'),
            'before_widget' => '<div class="%1$s" id="widget-blog">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-blog">',
            'after_title' => '</h3>'
        ));
    }

    /**
     * Añade los menus al gancho de inicio en el c-panel del theme
     * @since 1.0.0
     * @access public
     */
    public function atr_add_menus(){
        /**
         * El ATR_Cargador creara la relación entre los ganchos definidos
         * y las funciones definidas en esta clase
         */
        register_nav_menus( [
            'menu_principal' => __('Menu Principal', 'atr-opt'),
            'menu_sociales' => __('Menu Redes Sociales', 'atr-opt')
        ] );

        //thumbnails
        add_theme_support('post-thumbnails');

        /**
         * Añadir tamaños de imagen
         */
        add_image_size('header', 1600, 470, true);

        add_image_size('post', 900, 760, true);

        //Añadir logo dinamicamente desde la opcion personalizar
        //creamos un array de propiedades para la imagen del logo
        $logo = [
            'width' => 300,
            'height' => 70,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' ),
        ];
        add_theme_support( 'custom-logo', $logo );
    }
    
     /**
     * Añade los custom post type al gancho de inicio en el c-panel del theme
     * https://codex.wordpress.org/Function_Reference/register_post_type (parametres)
     * @since 1.0.0
     * @access public
     */
    public function atr_cpt(){
        /**
     * @var $labels => son los nombres de las etiquetas
     * 
     *      'name'               => nombre en plural para el tipo de publicacion 
     *      'singular_name'      => Nombre para un objeto de este tipo de publicación. El valor predeterminado es Publicar
     *      'menu_name'          => nombre que llevara el menu en el c-panel, por defecto el mismo de los 2 campos anteriores
     *      'name_admin_bar'     => Cadena para usar en Nuevo en la barra de menú de Admin.
     *      'add_new'            => Boton de añadir nuevo, El valor predeterminado es Add New Post
     *      'add_new_itew'       => El valor predeterminado es Añadir nueva publicación
     *      'new_item'           => El valor predeterminado es New post
     *      'edit_item'          => El valor predeterminado es edit post / edit page.
     *      'view_item'          => El valor predeterminado es Ver publicación 
     *      'all_items'          => Cadena para el submenú. El valor predeterminado es Todas las publicaciones / Todas las páginas
     *      'search_items'       => El valor predeterminado es Buscar publicaciones
     *      'parent_item_colon'  => Esta cadena no se utiliza en tipos no jerárquicos. En los jerárquicos, el valor predeterminado es 'Página principal'
     *      'not_found'          => El valor predeterminado es No se han encontrado publicaciones / No se han encontrado páginas.
     *      'not_found_in_trash' => El valor predeterminado es No se encontraron publicaciones en la Papelera 
     */
    $labels = array(
        'name'               => _x( 'Menu', 'atr-opt' ),
        'singular_name'      => _x( 'Menu', 'post type singular name', 'atr-opt' ),
        'menu_name'          => _x( 'Menu', 'admin menu', 'atr-opt' ),
        'name_admin_bar'     => _x( 'Menu', 'add new on admin bar', 'atr-opt' ),
        'add_new'            => _x( 'Add new menu', 'book', 'atr-opt' ),
        'add_new_item'       => __( 'Add new menu', 'atr-opt' ),
        'new_item'           => __( 'New menu', 'atr-opt' ),
        'edit_item'          => __( 'Edit menu', 'atr-opt' ),
        'view_item'          => __( 'View menu', 'atr-opt' ),
        'all_items'          => __( 'All menus', 'atr-opt' ),
        'search_items'       => __( 'Search menus', 'atr-opt' ),
        'parent_item_colon'  => __( 'Parent menus:', 'atr-opt' ),
        'not_found'          => __( 'No menus found.', 'atr-opt' ),
        'not_found_in_trash' => __( 'No menus found in Trash.', 'atr-opt' )
    );

    /**
     * @var $args argumentos para la funcion register_post_type()
     *      
     *      'labels'                => aqui pondremos la array $labels
     *      'description'           => una breve descripcion de lo que es el tipo de publicacion
     *      'public'                => Controla cómo el tipo es visible para los autores y los lectores
     *      'publicly_queryable'    => Si las consultas se pueden realizar en el front-end como parte de parse_request ().
     *      'show_ui'               => se debe generar una IU (interfas de usuario) predeterminada para administrar este tipo de publicación
     *      'show_in_menu'          => Dónde mostrar el tipo de publicación en el menú de administración. show_ui debe ser cierto. Predeterminado
     *      'query_var'             => Establece la clave query_var para este tipo de publicación. por default es true, establecido en $ post_type
     *      'rewrite'               => si utilizamos la opcion comentada, se reescribe, debe estar en false
     *      'capability_type'       => se usa como base para construir capacidades, por default es post
     *      'has_archive'           => Habilita archivos de tipo de publicación. Usará $post_type como archivo comprimido por defecto.
     *      'hierarchical'          => Si el tipo de publicación es jerárquico (por ejemplo, página).Permite que el padre sea especificado. por default es false
     *      'menu_position'         => posicion del muenu
     *      'menu_icon'             => La url al icono que se usará para este menú o el nombre del icono de la fuente del icono
     *      'supports'              => tenemos :title, editor, author, thumbnail, excerpt, trackbacks, custom-fields, comments, post-formats...etc
     *      'taxonomies'            => Un conjunto de taxonomías registradas como category o post_tag que se utilizará con este tipo de publicación.
     */
    $args = array(
        'label'               => __( 'Menus', 'atr-opt' ),
        'labels'             => $labels,
        'description'        => __( 'Description.', 'atr-opt' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'menus' ),
        //'rewrite'            => false, //asi no muestra la ruta amigable
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 3,
        'menu_icon'          => ATR_DIR_URI . 'admin/img/menu-icon.png',
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'category', 'post_tag', 'precio' ),
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'exclude_from_search' => false,
        'show_in_admin_bar'   => true,
    );

    /**
     *themes sera el nombre id del Custom Post Type
        */
    register_post_type( 'menus', $args );

    /**
     * Esta funcion refresca automaticamente los enlaces de las publicaciones del custom post type
     * asi podremos visualizar los post
     */
    flush_rewrite_rules();


    }

    /**
     * Añade los custom post type al gancho de inicio en el c-panel del theme
     * https://codex.wordpress.org/Function_Reference/register_post_type (parametres)
     * @since 1.0.0
     * @access public
     */
    public function atr_cpt_eventos(){
        
        $labels = array (
            'name'              => _x('Eventos', 'atr-opt'),
            'singular_name'     => _x('Eventos', 'post type singular name','atr-opt'),
            'menu_name'         => _x('Eventos', 'admin evento', 'atr-opt'),
            'name_admin_bar'     => _x( 'Eventos', 'add new on admin bar', 'atr-opt' ),
            'add_new'            => _x( 'Add new evento', 'book', 'atr-opt' ),
            'add_new_item'       => __( 'Add new ', 'atr-opt' ),
            'new_item'           => __( 'New evento', 'atr-opt' ),
            'edit_item'          => __( 'Edit evento', 'atr-opt' ),
            'view_item'          => __( 'View evento', 'atr-opt' ),
            'all_items'          => __( 'All eventos', 'atr-opt' ),
            'search_items'       => __( 'Search eventos', 'atr-opt' ),
            'parent_item_colon'  => __( 'Parent eventos:', 'atr-opt' ),
            'not_found'          => __( 'No eventos found.', 'atr-opt' ),
            'not_found_in_trash' => __( 'No eventos found in Trash.', 'atr-opt' )
        );

        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'atr-opt' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'eventos' ), //Así veremos la ruta amigable
            //'rewrite'            => false, //así no se ve la ruta amigable
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 4,
            'menu_icon'          => ATR_DIR_URI . 'admin/img/menu-icon.png',
            'supports'           => array( 'title', 'editor', 'thumbnail', 'post-formats', 'custom-fields' ),
            'taxonomies'          => array( 'category', 'post_tag' ),
        );
    
        /**
         *themes sera el nombre id del Custom Post Type
            */
        register_post_type( 'eventos', $args );
    
        /**
         * Esta funcion refresca automaticamente los enlaces de las publicaciones del custom post type
         * asi podremos visualizar los post
         */
        flush_rewrite_rules();
    
    }


    /**
     *excerpt(), esta funcion me resume el post en 40 palabras, lo modificaremos para que
     *sean 20 palabras
     *https://developer.wordpress.org/reference/functions/the_excerpt/
     * @since 1.0.0
     * @access public
     */
    public function atr_excerpt($length){
        return 30;
    }

    /**
     * Para los colores degutenberg
     */
    public function atr_colors_gutenberg(){

        //Soporte para los estylos por default de gutenberg
        add_theme_support('wp-block-styles');

        //soporte a una paleta de colores
        add_theme_support('editor-color-palette', array(
            array(
                'name' => 'Azul',
                'slug' => 'azul',
                'color' => '#25a5D5'
            ),
            array(
                'name' => 'Verde',
                'slug' => 'verde',
                'color' => '#82bd58'
            ),
            array(
                'name' => 'Gris',
                'slug' => 'gris',
                'color' => '#414141'
            ),
            array(
                'name' => 'Blanco',
                'slug' => 'blanco',
                'color' => '#ffffff'
            )
        ));
        
        //Elimina la posibilidad de cambiar el color que establecemos (elimina color personalizado)
        add_theme_support('disable-custom-colors');
    }

    public function atr_advanced_custom_fields(){

        //para ver el ACF comentar la constante define
        //define( 'ACF_LITE', true );
        
        include_once ATR_DIR_PATH . 'helpers/advanced-custom-fields/acf.php';
        
        if(function_exists("register_field_group"))
        {
            register_field_group(array (
                'id' => 'acf_eventos',
                'title' => 'Eventos',
                'fields' => array (
                    array (
                        'key' => 'field_5c786835158f3',
                        'label' => 'Fecha',
                        'name' => 'fecha',
                        'type' => 'text',
                        'instructions' => 'Escriba aquí el día del evento, el mes y el año
            EJ: 10 de Mayo, 2019',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_5c7868b1158f4',
                        'label' => 'Hora',
                        'name' => 'hora',
                        'type' => 'text',
                        'instructions' => 'Escriba aquí la hora o las horas en las que se realizara el evento
            EJ: 15:00 - 21:00',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'eventos',
                            'order_no' => 0,
                            'group_no' => 0,
                        ),
                    ),
                ),
                'options' => array (
                    'position' => 'normal',
                    'layout' => 'default',
                    'hide_on_screen' => array (
                    ),
                ),
                'menu_order' => 0,
            ));
            register_field_group(array (
                'id' => 'acf_formulario-reservaciones',
                'title' => 'Formulario-reservaciones',
                'fields' => array (
                    array (
                        'key' => 'field_5c649acc688cd',
                        'label' => 'imagen_1',
                        'name' => 'imagen_1',
                        'type' => 'image',
                        'instructions' => 'Añada aquí la imagen izquierda del formulario',
                        'save_format' => 'url',
                        'preview_size' => 'medium',
                        'library' => 'all',
                    ),
                    array (
                        'key' => 'field_5c649bd2688ce',
                        'label' => 'imagen_2',
                        'name' => 'imagen_2',
                        'type' => 'image',
                        'instructions' => 'Añada aquí la imagen a la derecha del formulario',
                        'save_format' => 'url',
                        'preview_size' => 'medium',
                        'library' => 'all',
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'page_template',
                            'operator' => '==',
                            'value' => 'page-reservas.php',
                            'order_no' => 0,
                            'group_no' => 0,
                        ),
                    ),
                ),
                'options' => array (
                    'position' => 'normal',
                    'layout' => 'default',
                    'hide_on_screen' => array (
                    ),
                ),
                'menu_order' => 0,
            ));
            register_field_group(array (
                'id' => 'acf_front-page',
                'title' => 'Front-page',
                'fields' => array (
                    array (
                        'key' => 'field_5c61b9a4c92a0',
                        'label' => 'galeria',
                        'name' => 'galeria',
                        'type' => 'wysiwyg',
                        'instructions' => 'Añada la galeria de imagenes aqui',
                        'default_value' => '',
                        'toolbar' => 'full',
                        'media_upload' => 'yes',
                    ),
                    array (
                        'key' => 'field_5c63011e89a70',
                        'label' => 'bloque-imagen1',
                        'name' => 'bloque-imagen1',
                        'type' => 'image',
                        'instructions' => 'Añada aquí la imagen del bloque 1',
                        'save_format' => 'url',
                        'preview_size' => 'full',
                        'library' => 'all',
                    ),
                    array (
                        'key' => 'field_5c63028889a71',
                        'label' => 'texto1',
                        'name' => 'texto1',
                        'type' => 'wysiwyg',
                        'instructions' => 'Ponga aquí el texto que acompaña la imagen',
                        'default_value' => '',
                        'toolbar' => 'full',
                        'media_upload' => 'yes',
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'page',
                            'operator' => '==',
                            'value' => '6',
                            'order_no' => 0,
                            'group_no' => 0,
                        ),
                    ),
                ),
                'options' => array (
                    'position' => 'normal',
                    'layout' => 'default',
                    'hide_on_screen' => array (
                    ),
                ),
                'menu_order' => 0,
            ));
            register_field_group(array (
                'id' => 'acf_galeria-galeria',
                'title' => 'Galeria-galeria',
                'fields' => array (
                    array (
                        'key' => 'field_5c6dd14c321d0',
                        'label' => 'gallery',
                        'name' => 'gallery',
                        'type' => 'wysiwyg',
                        'instructions' => 'Añada aqui una galeria para su página',
                        'default_value' => '',
                        'toolbar' => 'full',
                        'media_upload' => 'yes',
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'page_template',
                            'operator' => '==',
                            'value' => 'page-galeria.php',
                            'order_no' => 0,
                            'group_no' => 0,
                        ),
                    ),
                ),
                'options' => array (
                    'position' => 'normal',
                    'layout' => 'no_box',
                    'hide_on_screen' => array (
                    ),
                ),
                'menu_order' => 0,
            ));
            register_field_group(array (
                'id' => 'acf_horarios',
                'title' => 'Horarios',
                'fields' => array (
                    array (
                        'key' => 'field_5c7da37ff192e',
                        'label' => 'Horarios Semana',
                        'name' => 'horarios_semana',
                        'type' => 'text',
                        'instructions' => 'Ponga aquí los horarios de atención entre semana, ejemplo: lunes a viernes + horarios',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_5c7da3fef192f',
                        'label' => 'Horarios fin de semana',
                        'name' => 'horarios_fin_de_semana',
                        'type' => 'text',
                        'instructions' => 'Ponga aquí los horarios de atención fin de semana, ejemplo: sabados de 8:00 a 13:00',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'page_template',
                            'operator' => '==',
                            'value' => 'page-contacto.php',
                            'order_no' => 0,
                            'group_no' => 0,
                        ),
                    ),
                ),
                'options' => array (
                    'position' => 'normal',
                    'layout' => 'default',
                    'hide_on_screen' => array (
                    ),
                ),
                'menu_order' => 0,
            ));
            register_field_group(array (
                'id' => 'acf_precio',
                'title' => 'Precio',
                'fields' => array (
                    array (
                        'key' => 'field_5c68b796e3c0d',
                        'label' => 'precio',
                        'name' => 'precio',
                        'type' => 'text',
                        'instructions' => 'Ponga aqui el precio de su menú',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'menus',
                            'order_no' => 0,
                            'group_no' => 0,
                        ),
                    ),
                ),
                'options' => array (
                    'position' => 'normal',
                    'layout' => 'default',
                    'hide_on_screen' => array (
                    ),
                ),
                'menu_order' => 0,
            ));
        }



    }
    
}









