<?php
/**
 * Plugin Name: Pruebas
 * Plugin Uri: https://pruebas.com
 * Description: Este es un plugin de pruebas
 * Version: 1.0.0
 * Requires PHP: 7.0
 * Author: Newtheme
 * Author Uri: https://newtheme.eu
 * License: GPL V2
 * License Uri: https://www.gnu.org/licences/gpl-2.0.html
 * Text Domain: pruebas
 * Domain Path: /languages
 */

 
 

 function res_desactivacion(){
    //Acción
   // flush_rewrite_rules();
 }
 register_deactivation_hook(__FILE__, 'res_desactivacion');



 if( !isset( $mivariable ) ){
    $mivariable = "Nuevo valor";
 }

 if( !function_exists( 'res_install' ) ){
    function res_install(){
        //Accion
        require_once 'activador.php';
     }

     register_activation_hook( __FILE__, 'res_install');
 }

 if ( !class_exists( 'RES_Mi_Class' ) ){
    class RES_Mi_Class {
    //escribimos el código a ejecutar
    }
}

if( !function_exists( 'res_plugins_cargados' ) ){

    function res_plugins_cargados(){

       if( current_user_can( 'edit_pages' ) ){

         if( !function_exists( 'add_meta_description' ) ){

           function add_meta_description(){
             
            echo "<meta name='description' content='Creación de Plugins en Wordpress'>";

           }
           add_action( 'wp_head', 'add_meta_description');

         }

       }

    }
    add_action( 'plugins_loaded', 'res_plugins_cargados' );
}

if( !function_exists( 'res_prueba_nonce' ) ){
   function res_prueba_nonce(){
      add_menu_page(
         'RES Prueba Nonce', 
         'RES Prueba Nonce', 
         'manage_options', 
         'res_pruebas_nonce', 
         'res_pruebas_page_display', 
         'dashicons-welcome-learn-more', 
         '15'
      );

      remove_menu_page('res_pruebas_nonce');
   }

   add_action('admin_menu', 'res_prueba_nonce');
}

if( !function_exists( 'res_pruebas_page_display') ){

   function res_pruebas_page_display(){

      if( current_user_can( 'edit_others_posts' ) ){

          $nonce = wp_create_nonce( 'mi_nonce_de_seguridad' );

          echo "<br> $nonce <br>";         

          if( isset( $_POST['nonce']) && !empty( $_POST['nonce']) ){

             if( wp_verify_nonce($_POST['nonce'], 'mi_nonce_de_seguridad') ){

               echo "Hemos verificado correctamente el nonce recibido <br> Nonce: {$_POST['nonce']} <br>";

             } else {
               echo "El nonce no fue recibido o no es correcto";
             }

          }

          ?>

           <br>
           <form action="" method="post">
            <input type="hidden" name="nonce" value="<?php echo $nonce; ?>">
            <input type="hidden" name="eliminar" value="eliminar">
            <button type="submit">Eliminar</button>
           </form>

          <?php
      }
   }
}

if( !function_exists( 'res_options_page' ) ){
   function res_options_page(){
      add_menu_page(
         'RES opciones de Página', 
         'Res opciones de Página', 
         'manage_options', 
         'res_options_page', 
         'res_options_page_display', 
         plugin_dir_url( __FILE__ ) . 'img/icono_personalizado.png', 
         15
      );

      add_submenu_page(
         'res_options_page', 
         'Submenu 1', 
         'Submenu 1', 
         'manage_options', 
         'res_submenu1_pruebas', 
         'res_submenu1_pruebas_display'
      );
   }

   add_action( 'admin_menu', 'res_options_page' );
}

if( !function_exists( 'res_options_page_display' ) ){
   function res_options_page_display(){
      ?>

         <!--html-->
         <div class="wrap">

            <form action="" method="post">
                <input type="text" name="" id="" placeholder="Texto">

                <?php do_action('res_extend_form'); ?>

                <?php submit_button('Enviar') ?>
            </form>

         </div>

      <?php
   }
}

function res_anadir_campos_nuevos(){
   ?>
      <input type="text" name="" id="" placeholder="Apellido">
   <?php
}
add_action('res_extend_form', 'res_anadir_campos_nuevos');

if( !function_exists( 'res_submenu1_pruebas_display' ) ){
   function res_submenu1_pruebas_display(){
      ?>
       <!--html-->
         <div class="wrap">
            <h3>
               Bievenido a la página submenu
            </h3>
         </div>
      <?php
   }
}


function example_theme_support() {
   remove_theme_support( 'widgets-block-editor' );
}
add_action( 'init', 'example_theme_support' );

// Función para eliminar wiidget

function miprimerafuncion()
{
   unregister_widget('WP_Widget_Calendar');
}

add_action('widgets_init', 'miprimerafuncion');

// Función para enviar email al crear un post
function function_callback_save_post($post_id, $post){
   if( wp_is_post_revision( $post_id ) ){
      return;
   }

   $autor_id = $post->post_author;
   $name_autor = get_the_author_meta('display_name', $autor_id );
   $email_autor = get_the_author_meta( 'user_email', $autor_id );
   $title = $post->post_title;
   $permalink = get_permalink($post_id);

   // Datos para el email
   $para = sprintf( '%s', $email_autor );
   $asunto = sprintf( 'Publicación guardada: %s', $title );
   $mensaje = sprintf( 
      'Felicitaciones, %s ! su publicación "%s"  ha sido guardada, 
       puede verlo en el siguiente enlace: %s', $name_autor, $title, $permalink
      );

   $headers[] = 'From "' . $name_autor . '" < ' . get_option( 'admin_email' ) . '> ';

   wp_mail( $para, $asunto, $mensaje, $headers );

}

add_action( 'save_post',  'function_callback_save_post', 10, 2);

function atr_modificar_texto( $texto ){
   $texto = "...";
   return $texto;
}

add_filter( 'excerpt_more', 'atr_modificar_texto', 10 );


// Función shortcode
function res_primer_shortcode( $atts, $content = null ){
   return '<h3 class="title">' . $content . '</h3>';
}

add_shortcode('res_texto', 'res_primer_shortcode');


//Shortcode complejo
function res_shortcode_link_personalizado( $atts, $contenido = null ){
   $attr_default = array(
      'texto' => 'ver información',
      'class' => ' btn btn-primary',
      'url' => '#',
      'target' => '_blank'
   );

   $atts = array_change_key_case( (array)$atts, CASE_LOWER );

   // CONVERTIREMOS LOS OBJETOS EN VARIABLES
   extract( shortcode_atts( $attr_default, $atts, 'reslink' ), EXTR_OVERWRITE );

   return "
   <a href='$url' class='$class' target='$target'>
      $contenido
   </a>
   ";
}

add_shortcode( 'reslink', 'res_shortcode_link_personalizado' );


 remove_shortcode( 'reslink' );

 function filter_the_content_in_the_main_loop( $content ){

   if( ( is_singular('post' ) ) && in_the_loop() && is_main_query() ){
      if( is_single( 'entrada-shortcode' ) && !shortcode_exists('reslink') ){

         return $content . "
            <div class='alert alert-danger' role='alert'>" .
               esc_html__('shortcode no existe', 'res-pruebas')
           . "</div>
         ";

      }
   }

   return $content;
 }

 add_filter( 'the_content', 'filter_the_content_in_the_main_loop' );


 function res_funcion_setting(){
   //Registrando una nueva función en la pagina general
      register_setting('general', 'res_primera_configuracion');
     
      //Registrando una nueva sección en la pagina general
      add_settings_section(
      'res_config_seccion',
      'Mi primera configuración',
      'res_config_seccion_cb',
      'general'
      );

      add_settings_field(
         'res_config_campo1',
         'Configuración Campo 1',
         'res_config_campo_cb1',
         'general',
         //string id del settings_section
         'res_config_seccion',
         //6º parametro array asociativo
         [
         'label_for' => 'res_campo_1',
         'class' => 'clase_campo',
         'res_dato_personalizado' => 'valor personalizado'
         ]
      );

      add_settings_field(
         'res_config_campo2',
         'Configuración Campo 2',
         'res_config_campo_cb2',
         'general',
         //string id del settings_section
         'res_config_seccion',
         //6º parametro array asociativo
         [
            'label_for' => 'res_campo_2',
            'class' => 'clase_campo',
            'res_dato_personalizado' => 'valor personalizado'
         ]
      );
  }

   add_action( 'admin_init', 'res_funcion_setting' );

   // Función callback sección
   function res_config_seccion_cb(){
      echo "<p>Mi Primer ajuste de configuración</p>";
   }


   // Función callback campo 1
   function res_config_campo_cb1( $args ){

      $resconfig = get_option( 'res_primera_configuracion' );
      $valor = isset( $resconfig[$args['label_for']] ) ? esc_attr( $resconfig[$args['label_for']] ) : '';

      $html = "<input class='{$args['class']}' data-custom='{$args['res_dato_personalizado']}' type='text' name='res_primera_configuracion[{$args['label_for']}]' value='$valor'>";
      echo $html;

   }

   // Función callback campo 2
   function res_config_campo_cb2( $args ){

      $resconfig = get_option( 'res_primera_configuracion' );
      $valor = isset( $resconfig[$args['label_for']] ) ? esc_attr( $resconfig[$args['label_for']]) : '';

      $html = "<input class='{$args['class']}' data-custom='{$args['res_dato_personalizado']}' type='text' name='res_primera_configuracion[{$args['label_for']}]' value='$valor'>";
      echo $html;
   }


   add_post_meta( 101, 'colores', 'Azul', true );
  // add_post_meta( 101, 'colores', 'Verde', true );


   update_post_meta(101, 'colores', 'Marron', 'Azul');

   if( !function_exists('atr_add_caja_personalizada')){

      function atr_add_caja_personalizada(){
         $post_types = ['post', 'eventos'];

         // Creando Metaboxes
         add_meta_box(
            'atr_mi_metabox',
            'Datos Extra',
            'atr_metacaja_html',
            $post_types,
            'normal',
            'high',
            null
         );
      }

      add_action('add_meta_boxes', 'atr_add_caja_personalizada');

   }

   function atr_metacaja_html( $post ){

      $atr_dato = get_post_meta( $post->ID, 'atr_datos', true );

      $tiempo = isset( $atr_dato['tiempo'] ) ? $atr_dato['tiempo'] : '';
      $precio = isset( $atr_dato['precio'] ) ? $atr_dato['precio'] : '';
      $valoracion = isset( $atr_dato['valoracion'] ) ? $atr_dato['valoracion'] : '';

      $editor = isset( $atr_dato['editor'] ) ? $atr_dato['editor'] : '';

      $html = "
      <div>
         <label for='atr_tiempo'>Tiempo</label>
         <input type='text' name='atr_dato[tiempo]' id='atr_tiempo' value='$tiempo'>
      </div>

      <div>
         <label for='precio'>Precio</label>
         <input type='text' name='atr_dato[precio]' id='atr_precio' value='$precio'>
      </div>

      <div>
      <label for='atr_valoracion'>Valoración</label>
      <select name='atr_dato[valoracion] id='atr_valoracion'>
            <option value=''>Tu valoración</option>
            <option value='1" . selected($valoracion, 1, false ) . "'>1</option>
            <option value='2" . selected($valoracion, 2, false ) . "'>2</option>
            <option value='3" . selected($valoracion, 3, false ) . "'>3</option>
            <option value='4" . selected($valoracion, 4, false ) . "'>4</option>
            <option value='5" . selected($valoracion, 5, false ) . "'>5</option>
         </select>
      </div>
      ";

      echo $html;

      wp_editor( 
         $editor, 
         'atr_dato[editor]', 
         [
            'media_buttons'
         ]
      );
   }


   function atr_save_metacaja_datos( $post_id ){

       if( array_key_exists( 'atr_dato', $_POST ) ){

         update_post_meta(
            $post_id,
            'atr_datos',
            $_POST['atr_datos']
         );
       }

   }

   add_action( 'save_post', 'atr_save_metacaja_datos' );

   







  // add_post_meta( 101, 'mimetadato', 'un valor cualquiera' );

 //  delete_post_meta( 101, 'mimetadato');


  /* add_post_meta( 101, 'colores', 'Azul' );
   add_post_meta( 101, 'colores', 'Verde' );
  // add_post_meta( 101, 'colores', 'Rojo' );*/

  // delete_post_meta( 101, 'colores');




 /*  $valor = "color rojo";

 //  add_option( 'atr_valor_personalizado_01', $valor );

   $valor = [
      'rojo',
      'verde',
      'azul',
      'Titulo' => 'colores principales'
   ];

  // add_option( 'atr_valor_personalizado_02', $valor );
 

   $opcion_personalizada1 = get_option( 'atr_valor_personalizado_01' );

   echo "$opcion_personalizada1 <br>";

   $opcion_personalizada2 = get_option('atr_valor_personalizado_02');

 //  var_dump( $opcion_personalizada2 );

   $valor_nuevo = 'Este es el nuevo valor';
   update_option( 'atr_valor_personalizado_01', $valor_nuevo );

   delete_option('atr_valor_personalizado_02');

   delete_option('atr_valor_personalizado_01');


*/









/*function res_config_seccion_cb(){
   echo "<p>Mi primer ajuste de configuración</p>";
}*/

//Función callback campo
/*function res_config_campo1_cb1(){
   $resconfig = get_option( 'res_primera_configuracion' );
   $resconfig = isset( $resconfig ) ? esc_attr( $resconfig ) : '';

   $html = "<input type='text' name='res_primera_configuracion' value='$resconfig'>";
   echo $html;

}*/






/*if( shortcode_exists( 'reslink' ) ){
   echo "si existe";
} else {
   echo "no existe";
}*/



/*
$mensaje = "Mensaje<?php echo 'DELETE, DROP, UPDATE'; ?> guardado";
echo sanitize_text_field($mensaje);

echo "<br>";

$_POST['email'] = 'pruebas ¿¿¿¿¿@pruebas.com ||';
$email = $_POST['email'];
echo sanitize_email($email);
*/

/*
$_POST['email'] = 'prueba@prueba.eu';
$email = $_POST['email'];

if( is_email($email) ){
    echo "Este email es correcto <br>";
} else {
    echo "Email incorrecto <br>";
}

$_POST['frutas'] = array(
    'Mango',
    'Pera',
    'Manzana',
    'Piña'
);

$frutas = $_POST['frutas'];

if( in_array( 'Manzana', $frutas )){
  echo "Manzana existe";
} else {
    echo "Manzana no existe";
}
*/


/*
 if( !defined( 'WP_UNINSTALL_PLUGIN') ){
    exit();
 }

 if( is_admin() ){
    require_once 'admin/display-admin.php';
 } else {
    require_once 'public/display-public.php';
 }
*/