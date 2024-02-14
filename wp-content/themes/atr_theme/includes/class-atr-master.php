<?php

/**
 * El archivo que define la clase del cerebro principal del plugin
 *
 * Una definición de clase que incluye atributos y funciones que se 
 * utilizan tanto del lado del público como del área de administración.
 * 
 * @link       https://newtheme.eu
 * @since      1.0.0
 *
 * @package    ATR THEME
 * @subpackage ATR THEME/includes
 */

/**
 * También mantiene el identificador único de este complemento,
 * así como la versión actual del theme.
 *
 * @since      1.0.0
 * @package    ATR THEME
 * @subpackage ATR THEME/includes
 * @author     Jhon J.R <info@newtheme.com>
 * 
 * @property object $cargador
 * @property string $theme_name
 * @property string $version
 */
class ATR_Master {
    
    /**
	 * El cargador que es responsable de mantener y registrar
     * todos los ganchos (hooks) que alimentan el theme.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      ATR_Cargador    $cargador  Mantiene y registra todos los ganchos ( Hooks ) del THEME
	 */
    protected $cargador;
    
    /**
	 * El identificador único de éste THEME
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $theme_name  El nombre o identificador único de éste theme
	 */
    protected $theme_name;
    
    /**
     * Versión actual del theme
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version  La versión actual del theme
	 */
    protected $version;
    
    /**
     * Constructor
     * 
	 * Defina la funcionalidad principal del theme.
	 *
	 * Establece el nombre y la versión del theme que se puede utilizar en todo el theme.
     * Cargar las dependencias, carga de instancias, definir la configuración regional (idioma)
     * Establecer los ganchos para el área de administración y
     * el lado público del sitio.
	 *
	 * @since    1.0.0
	 */
    public function __construct() {
        
        $this->theme_name = 'ATR_gourmet';
        $this->version = '1.0.0';
        
        $this->cargar_dependencias();
        $this->cargar_instancias();
        $this->set_idiomas();
        $this->definir_admin_hooks();
        $this->definir_public_hooks();
        
    }
    
    /**
	 * Cargue las dependencias necesarias para este theme.
	 *
	 * Incluya los siguientes archivos que componen el theme:
	 *
	 * - BCT_Cargador. Itera los ganchos del theme.
	 * - BCT_i18n. Define la funcionalidad de la internacionalización
	 * - BCT_Admin. Define todos los ganchos del área de administración.
	 * - BCT_Public. Define todos los ganchos del del cliente/público.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
    private function cargar_dependencias() {
        
        /**
		 * La clase responsable de iterar las acciones y filtros del núcleo del theme.
		 */
        require_once ATR_DIR_PATH . 'includes/class-atr-cargador.php';
        
        /**
		 * La clase responsable de definir la funcionalidad de la
         * internacionalización del theme
		 */
        require_once ATR_DIR_PATH . 'includes/class-atr-i18n.php';        
        
        /**
		 * La clase responsable de registrar menús y submenús
         * en el área de administración
		 */
        require_once ATR_DIR_PATH . 'includes/class-atr-build-menupage.php';
        
        /**
		 * La clase responsable de normalizar acentos, eñes,
         * y caracteres especales
		 */
        require_once ATR_DIR_PATH . 'includes/class-atr-normalize.php';
        
        /**
		 * La clase responsable de definir todas las acciones en el
         * área de administración
		 */
        require_once ATR_DIR_PATH . 'admin/class-atr-admin.php';
        
        /**
		 * La clase responsable de definir todas las acciones en el
         * área del lado del cliente/público
		 */
		require_once ATR_DIR_PATH . 'public/class-atr-public.php';
		
		/**
		 * Esta clase me permite crear BBDD personalizadas para el frontend
		 */
		require_once ATR_DIR_PATH . 'public/inc/class-atr-create-db.php';
        
    }
    
    /**
	 * Defina la configuración regional de este theme para la internacionalización.
     *
     * Utiliza la clase ATR_i18n para establecer el dominio y registrar el gancho
     * con WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
    private function set_idiomas() {
        
        $atr_i18n = new ATR_i18n();
        $this->cargador->add_action( 'after_setup_theme', $atr_i18n, 'load_theme_textdomain' );
        
    }
    
    /**
	 * Cargar todas las instancias necesarias para el uso de los 
     * archivos de las clases agregadas
	 *
	 * @since    1.0.0
	 * @access   private
	 */
    private function cargar_instancias() {
        
        // Cree una instancia del cargador que se utilizará para registrar los ganchos con WordPress.
        $this->cargador     		= new ATR_Cargador;
        $this->atr_admin    		= new ATR_Admin( $this->get_theme_name(), $this->get_version() );
		$this->atr_public   		= new ATR_Public( $this->get_theme_name(), $this->get_version() );
		$this->atr_public_create_db = new ATR_DB_Public($this->get_theme_name(), $this->get_version() ); 
        
    }
    
    /**
	 * Registrar todos los ganchos relacionados con la funcionalidad del área de administración
     * del plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
    private function definir_admin_hooks() {
        
        $this->cargador->add_action( 'admin_enqueue_scripts', $this->atr_admin, 'enqueue_styles' );
		$this->cargador->add_action( 'admin_enqueue_scripts', $this->atr_admin, 'enqueue_scripts' );
		$this->cargador->add_action( 'admin_enqueue_scripts', $this->atr_admin, 'enqueue_script_dbform' );
		$this->cargador->add_action( 'admin_enqueue_style', $this->atr_admin, 'enqueue_style_dbform' );
		$this->cargador->add_action( 'admin_enqueue_scripts', $this->atr_admin, 'enqueue_script_dbreservas' );
		$this->cargador->add_action( 'admin_enqueue_style', $this->atr_admin, 'enqueue_style_dbreservas' );
		//Registrar grupos de opciones ver funcion en archivo class-atr-master.php
		$this->cargador->add_action( 'admin_init', $this->atr_admin, 'atr_registrar_opciones');
        
        $this->cargador->add_action( 'admin_menu', $this->atr_admin, 'add_menu' );
        
    }
    
    /**
	 * Registrar todos los ganchos relacionados con la funcionalidad del área de administración
     * Del plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
    private function definir_public_hooks() {
        
		$this->cargador->add_action( 'wp_enqueue_scripts', $this->atr_public, 'enqueue_styles' );
		// $this->cargador->add_action( 'after_setup_theme', $this->atr_public, 'atr_advanced_custom_fields' );
		$this->cargador->add_action( 'wp_enqueue_scripts', $this->atr_public, 'enqueue_scripts' );
		$this->cargador->add_action( 'init', $this->atr_public, 'atr_add_menus');
		$this->cargador->add_action('init', $this->atr_public, 'atr_cpt');
		$this->cargador->add_action('init', $this->atr_public, 'atr_register_sidebars');
		$this->cargador->add_action('init', $this->atr_public, 'atr_cpt_eventos');
		$this->cargador->add_action('after_setup_theme', $this->atr_public, 'atr_advanced_custom_fields');

		//Colors gutenberg
		$this->cargador->add_action('after_setup_theme', $this->atr_public, 'atr_colors_gutenberg');


		$this->cargador->add_filter('excerpt_length', $this->atr_public, 'atr_excerpt');
		//Ganchos para la BBDD de formulario de contacto
		$this->cargador->add_action('after_setup_theme', $this->atr_public_create_db, 'atr_form_contact_db');
		$this->cargador->add_action( 'plugins_loaded', $this->atr_public_create_db, 'atr_form_contact_restaurant_db_revisar');
		$this->cargador->add_action( 'init', $this->atr_public_create_db, 'atr_save_form_contact');
		$this->cargador->add_action( 'wp_ajax_atr_dbform_eliminar', $this->atr_public_create_db, 'atr_dbform_eliminar');
		//Formulario para reservas
		$this->cargador->add_action('after_setup_theme', $this->atr_public_create_db, 'atr_form_reservas_db');
		$this->cargador->add_action( 'init', $this->atr_public_create_db, 'atr_db_reserva_enviada');
		$this->cargador->add_action( 'plugins_loaded', $this->atr_public_create_db, 'atr_form_reservas_restaurant_db_revisar');
		$this->cargador->add_action( 'wp_ajax_atr_dbreservas_eliminar', $this->atr_public_create_db, 'atr_dbreservas_eliminar');
		//Map async defer
		//$this->cargador->add_filter( 'script_loader_tag', $this->atr_public, 'atr_agregar_async_defer', 10, 2 );

		/**
		 * Ganchos para el ajax de imagenes modal del frontend
		 * atr_ajax_ruta, es el nombre de la funcion que se creo en el script
		 * esta funcion se añade al gancho de accion wp_ajax_
		 * esta funcion solo vale para usuarios logeados
		 */
		$this->cargador->add_action( 'wp_ajax_atr_ajax_ruta', $this->atr_public, 'atr_enviar_ruta');

		/**
		 * Funcion ajax imagenes modal para todo tipo de usuarios
		 */
		$this->cargador->add_action('wp_ajax_nopriv_atr_ajax_ruta', $this->atr_public, 'atr_enviar_ruta');

		/**
		 * Ganchos para el ajax de imagenes modal de la pagina galeria
		 * esta funcion solo vale para usuarios logeados
		 */
		$this->cargador->add_action( 'wp_ajax_atr_ajax_ruta_galeria', $this->atr_public, 'atr_enviar_ruta_page_galeria' );

		/**
		 * Funcion ajax imagenes modal para todo tipo de usuarios
		 */
		$this->cargador->add_action( 'wp_ajax_nopriv_atr_ajax_ruta_galeria', $this->atr_public, 'atr_enviar_ruta_page_galeria' );
        
    }
    
    /**
	 * Ejecuta el cargador para ejecutar todos los ganchos con WordPress.
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function run() {
        $this->cargador->run();
    }
    
	/**
	 * El nombre del theme utilizado para identificarlo de forma exclusiva en el contexto de
     * WordPress y para definir la funcionalidad de internacionalización.
	 *
	 * @since     1.0.0
     * @access    public
	 * @return    string    El nombre del theme.
	 */
	public function get_theme_name() {
		return $this->theme_name;
	}

	/**
	 * La referencia a la clase que itera los ganchos con el theme.
	 *
	 * @since     1.0.0
     * @access    public
	 * @return    ATR_Cargador    Itera los ganchos del theme.
	 */
	public function get_cargador() {
		return $this->cargador;
	}

	/**
	 * Retorna el número de la versión del theme
	 *
	 * @since     1.0.0
     * @access    public
	 * @return    string    El número de la versión del theme.
	 */
	public function get_version() {
		return $this->version;
	}
    
}
















