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
 * Define el nombre del theme y la versión, esta clase es fundamental para  crear tablas personalizadas
 * del thema, crearemos bases de datos para aplicaciones del frontend
 * 
 * @since      1.0.0
 * @package    ATR THEME
 * @subpackage ATR THEME/admin
 * @author     Jhon J.R <info@newtheme.eu>
 * 
 * @property string $theme_name
 * @property string $version
 */

 class ATR_DB_Public{

    //Paso 1
     public function atr_form_contact_db(){
         /**
         * Funcionamiento :
         * al cargar por primera vez esta tabla, la version sera la 1.0
         * si hacemos alguna modificacion solo debemos cambiar la version, de 1.0 a 1.1 por ejemplo
         * y modificaremos la tabla de mas abajo, dentro del condicional if
         * 
         */
        /**
         * PASO 1 : Crear Tabla version 1.0
         * https://codex.wordpress.org/Creating_Tables_with_Plugins
         * global $wpdb, wordpress data base me permite hacer consultas sql a la BBDD
         * global $DBversion_contact; con esto creo una version para la tabla que voy a crear, en caso de actualizar o modificar
         * $DBversion_contact = '1.0'; esta es la version para este theme
         * $tabla = $wpdb->prefix . 'contactme'; este sera el nombre de la tabla
         * $charset_collate= $wpdb->get_charset_collate(); este es el set charset de wordpress
         * $sql, es la consulta, junto con el $charset_collate
         * require_once(ABSPATH), ESTA ES LA RUTA ABSOLUTA QUE DEFINE WORDPRESS
         * 'wp_admin/includes/upgrade.php' esto nos comunica con el archivo de wordpress que maneja las tablas
         * dbDelta($sql); esta funcion se encuentra dentro del archivo upgrade.php
         * dbDelta($sql); examina la estructura de tabla actual, la compara con la estructura de tabla deseada y agrega o modifica 
         * la tabla según sea necesario, por lo que puede ser muy útil para las actualizaciones
         * add_option('newtheme_db_version', $DB_version_contact); esto me crea una api_option, con la llave 'newtheme_db_version'
         */
        global $wpdb;
        global $DB_version_contact;
        $DB_version_contact = '1.0';

        $tabla = $wpdb->prefix . "contacto";
        $charset = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $tabla (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            nombre varchar(70) NOT NULL,
            correo varchar(100) NOT NULL,
            telefono varchar(12) NOT NULL,
            mensaje longtext NOT NULL,
            PRIMARY KEY(id)
        ) $charset; ";

        require_once ( ABSPATH . 'wp-admin/includes/upgrade.php');
        //dbDelta( $sql );
        //Asi llamaremos a la version de esta tabla
        add_option('restaurant_db_version', $DB_version_contact);

        /**
         * PASO 2 : Actualizar Tabla
         * Actualizar DB_version
         * con el codigo que escribiremos aqui podremos actualizar la BBDD en cualquier momento
         * Agregar campos, eliminar campos, actualizar
         */
        $version_actual = get_option('restaurant_db_version');

        if ( $DB_version_contact != $version_actual ){

            //Nombre de la tabla
            $tabla = $wpdb->prefix . "contacto";
            $charset = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $tabla (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                nombre varchar(70) NOT NULL,
                correo varchar(100) NOT NULL,
                telefono varchar(12) NOT NULL,
                mensaje longtext NOT NULL,
                PRIMARY KEY(id)
            ) $charset; ";

            require_once ( ABSPATH . 'wp-admin/includes/upgrade.php');
            //dbDelta( $sql );
            //Asi llamaremos a la version de esta tabla
            add_option('restaurant_db_version', $DB_version_contact);
        }
     }

     //Paso 2 revisamos el formulario
    public function atr_form_contact_restaurant_db_revisar(){
        /**
         * Esta funcion revisa las tablas creadas para el formulario de contacto para la funcion atr_form_contact_db()
         */
        global $DB_version_contact;
        if  ( get_site_option( 'restaurant_db_version' ) != $DB_version_contact ){
                //esta es la funcion callback con la que se creo  las tablas en el paso 1
                atr_form_contact_db();
        }

    }

    //PAso 3 Isertamos los datos en la tabla
     public function atr_save_form_contact(){
        /**
         * IMPORTANTE : SE DEBE INCLUIR LA VARIABLE global $wpdb, o los datos no se insertaran en la tabla
         * y esto nos mostrara un errorr
        */
        global $wpdb;
        if ( isset( $_POST['enviar'] ) ) : 
            if ( $_POST['nombre'] == null && $_POST['email'] == null && $_POST['telefono'] == null && $_POST['mensaje'] == null ) : 
          

                //echo $message;

            elseif ( $_POST['nombre'] != null && $_POST['email'] != null && $_POST['telefono'] != null && $_POST['mensaje'] != null && $_POST['oculto'] == '1' ) :
                $name       = sanitize_text_field( $_POST['nombre'] );
                $email      = sanitize_text_field( $_POST['email'] );
                $telefono   = sanitize_text_field( $_POST['telefono'] );
                $mensaje    = sanitize_text_field( $_POST['mensaje'] );

                //Paso 1 : Tabla
                $tabla = $wpdb->prefix . 'contacto';

                //Paso 2 : Datos
                //aqui pondremos el nombre de las columnas y los datos a insertar
                $datos = array(
                    'nombre'    => $name,
                    'correo'    => $email,
                    'telefono'  => $telefono,
                    'mensaje'   => $mensaje

                );

                //Paso 3 : Formato s=string, d=para numeros f=flotante, numeros con decimales por ejempo(3.50, 0.0003, etc)
                $formato =array(
                    '%s',
                    '%s',
                    '%s',
                    '%s'
                );

                //Paso 4 : realizamos la consulta
                $wpdb->insert( $tabla, $datos, $formato );

                //Paso 5 envio de correo, aqui utilizaremos la funcion wp_mail();
                $to = get_option('admin_email');
                $subject = 'Consulta';
                $mensaje = $mensaje;

            
                //$headers From llevara el nombre del que envia el mensaje + el correo
                $headers[]= 'From: "' . $name . '" < ' . $email . ' >';
                //Cc es a donde queremos enviar la copia del correo
                //$headers[]= "Cc: Jhon Jairo <jhonja14795@gmail.com>";
        

                 //wp_mail( $to, $subject, $message, $headers, $attachments );
                 wp_mail( $to, $subject, $mensaje, $headers );

               

                //Paso 6 :
                // redireccionamos, crearemos una pagina nueva en el cpanel, la llamaremos(message);
                $url        = get_page_by_title('Mensaje enviado');
                $location   = get_permalink($url->ID);

                //wp_safe_redirect( $location, $status ); esta funcion siempre va acompañada de un exit();
                wp_redirect($location);

                exit();
            endif;
        endif;

     }

     /**
     * Funcion para eliminar registros de DB form la BBDD
     */
    public function atr_dbform_eliminar(){
         /**
         * Para comprobar la conexion con el ajax escribiremos die(json_encode($_POST))
         */
        if(isset($_POST['tipo'])){
            if($_POST['tipo']=='eliminar'){

                global $wpdb;
                $tabla = $wpdb->prefix . 'contacto';

                $id_registro = $_POST['id'];

                /**
                 * La funcion $wpdb->delete(); RECIBE 3 parametros
                 * 1. la tabla
                 * 2. el where
                 * 3. el tipo de dato, para numero d, paradecimal f, para string s
                 * Nota: esta funcion devuelve 1 si se elimina el registro
                 */
                $resultado = $wpdb->delete( $tabla, array( 'id' => $id_registro ), array('%d') );

                if ( $resultado == 1 ){
                    $respuesta = array(
                        'respuesta' => 1,
                        'id' => $id_registro
                    );
                }else{
                    $respuesta = array(
                        'respuesta' => 'error'
                    );
                }

            }
        }

        die( json_encode($respuesta) );
    }


    /**
     * cargando las tabla para el formulario de reservas
     */
    //Paso 1 : creamos la tabla
    public function atr_form_reservas_db(){
        /**
        * Funcionamiento :
        * al cargar por primera vez esta tabla, la version sera la 1.0
        * si hacemos alguna modificacion solo debemos cambiar la version, de 1.0 a 1.1 por ejemplo
        * y modificaremos la tabla de mas abajo, dentro del condicional if
        * 
        */
       /**
        * PASO 1 : Crear Tabla version 1.0
        * https://codex.wordpress.org/Creating_Tables_with_Plugins
        * global $wpdb, wordpress data base me permite hacer consultas sql a la BBDD
        * global $DBversion_contact; con esto creo una version para la tabla que voy a crear, en caso de actualizar o modificar
        * $DBversion_contact = '1.0'; esta es la version para este theme
        * $tabla = $wpdb->prefix . 'contactme'; este sera el nombre de la tabla
        * $charset_collate= $wpdb->get_charset_collate(); este es el set charset de wordpress
        * $sql, es la consulta, junto con el $charset_collate
        * require_once(ABSPATH), ESTA ES LA RUTA ABSOLUTA QUE DEFINE WORDPRESS
        * 'wp_admin/includes/upgrade.php' esto nos comunica con el archivo de wordpress que maneja las tablas
        * dbDelta($sql); esta funcion se encuentra dentro del archivo upgrade.php
        * dbDelta($sql); examina la estructura de tabla actual, la compara con la estructura de tabla deseada y agrega o modifica 
        * la tabla según sea necesario, por lo que puede ser muy útil para las actualizaciones
        * add_option('newtheme_db_version', $DB_version_contact); esto me crea una api_option, con la llave 'newtheme_db_version'
        */
       global $wpdb;
       global $DB_version_reservas;
       $DB_version_reservas = '1.0';

       $tabla = $wpdb->prefix . "reservas";
       $charset = $wpdb->get_charset_collate();

       $sql = "CREATE TABLE $tabla (
           id mediumint(9) NOT NULL AUTO_INCREMENT,
           nombre varchar(70) NOT NULL,
           correo varchar(100) NOT NULL,
           telefono varchar(12) NOT NULL,
           fecha date NOT NULL,
           hora varchar(6) NOT NULL,
           personas varchar(60) NOT NULL,
           PRIMARY KEY(id)
       ) $charset; ";

       require_once ( ABSPATH . 'wp-admin/includes/upgrade.php');

       //dbDelta( $sql );
       //Asi llamaremos a la version de esta tabla
       add_option('restaurant_dbreservas_version', $DB_version_reservas);

       /**
        * PASO 2 : Actualizar Tabla
        * Actualizar DB_version
        * con el codigo que escribiremos aqui podremos actualizar la BBDD en cualquier momento
        * Agregar campos, eliminar campos, actualizar
        */
       $version_actual = get_option('restaurant_dbreservas_version');

       if ( $DB_version_reservas != $version_actual ){

           //Nombre de la tabla
           $tabla = $wpdb->prefix . "reservas";
           $charset = $wpdb->get_charset_collate();

           $sql = "CREATE TABLE $tabla (
               id mediumint(9) NOT NULL AUTO_INCREMENT,
                nombre varchar(70) NOT NULL,
                correo varchar(100) NOT NULL,
                telefono varchar(12) NOT NULL,
                fecha date NOT NULL,
                hora varchar(6) NOT NULL,
                personas varchar (60) NOT NULL,
                PRIMARY KEY(id)
           ) $charset; ";

           require_once ( ABSPATH . 'wp-admin/includes/upgrade.php');
           //dbDelta( $sql );
           //Asi llamaremos a la version de esta tabla
           add_option('restaurant_dbreservas_version', $DB_version_reservas);
       }
    }

    //Paso 2 revision de la tabla
    public function atr_form_reservas_restaurant_db_revisar(){
        /**
        * Esta funcion revisa las tablas creadas para el formulario de contacto para la funcion atr_form_contact_db()
        */
       global $DB_version_reservas;
       if  ( get_site_option( 'restaurant_dbreservas_version' ) != $DB_version_reservas ){
            //esta es la funcion callback con la que se creo  las tablas en el paso 1
            atr_form_reservas_db();
       }
    }

    //Paso 3 insertamos los datos en la BBDD
    public function atr_db_reserva_enviada(){

        /**
         * IMPORTANTE : SE DEBE INCLUIR LA VARIABLE global $wpdb, o los datos no se insertaran en la tabla
         * y esto nos mostrara un errorr
         */
        global $wpdb;

        if( isset( $_POST['reserva'] ) ) :
            if( $_POST['nombre'] == null && $_POST['email'] == null && $_POST['telefono'] == null && $_POST['fecha'] == null && $_POST['hora'] == null && $_POST['personas'] == null ) : 
                $mensaje = "rellene el formulario";
                echo $mensaje;

            elseif( $_POST['nombre'] != null && $_POST['email'] != null && $_POST['telefono'] != null && $_POST['fecha'] != null && $_POST['hora'] != null && $_POST['personas'] != null && $_POST['oculto'] == 1) :

                $name       = sanitize_text_field( $_POST['nombre'] );
                $email      = sanitize_text_field( $_POST['email'] );
                $fecha      = sanitize_text_field( $_POST['fecha'] );
                $telefono      = sanitize_text_field( $_POST['telefono'] );
                $hora       = sanitize_text_field( $_POST['hora'] );
                $personas   = sanitize_text_field( $_POST['personas'] );

                
                
                


                //Paso 1 : Tabla
                $tabla = $wpdb->prefix . 'reservas';

                //Paso 2 : Datos
                //aqui pondremos el nombre de las columnas y los datos a insertar
                $datos = array(
                    'nombre'        => $name,
                    'correo'        => $email,
                    'fecha'         => $fecha,
                    'telefono'      => $telefono,
                    'hora'          => $hora,
                    'personas'      => $personas

                );

                //Paso 3 : Formato s=string, d=para numeros f=flotante, numeros con decimales por ejempo(3.50, 0.0003, etc)
                $formato = array(
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s'
                );

                

                //Paso 4 : realizamos la consulta
                $wpdb->insert( $tabla, $datos, $formato );

                //Paso 5 envio de correo, aqui utilizaremos la funcion wp_mail();
                $to = get_option('admin_email');
                $subject = 'Reserva Nueva';
                $mensaje = "<p> Nombre :  ' . $name . ' </p>
                            <p> Email :  ' . $email . </p>
                            <p> Teléfono : ' . $telefono . </p>
                            <p> Fecha : ' . $fecha . </p>
                            <p> Hora : ' . $hora . </p>
                            <p> Personas : ' . $personas . </p>
                ";

            
                //$headers From llevara el nombre del que envia el mensaje + el correo
                $headers[]= 'From: "' . $name . '" < ' . $email . ' >';
                //Cc es a donde queremos enviar la copia del correo
                //$headers[]= "Cc: Jhon Jairo <jhonja14795@gmail.com>";
        

                //wp_mail( $to, $subject, $message, $headers, $attachments );
                wp_mail( $to, $subject, $mensaje, $headers );

                // redireccionamos, crearemos una pagina nueva en el cpanel, la llamaremos(message);
                $url        = get_page_by_title('Mensaje enviado');
                $location   = get_permalink($url->ID);

                //wp_safe_redirect( $location, $status ); esta funcion siempre va acompañada de un exit();
                wp_redirect($location);

                exit();

            endif;

        endif;
    }
    

    public function atr_dbreservas_eliminar(){
        /**
        * Para comprobar la conexion con el ajax escribiremos die(json_encode($_POST))
        */
       if(isset($_POST['tipo'])){
           if($_POST['tipo']=='reserva'){

               global $wpdb;

               $tabla = $wpdb->prefix . 'reservas';

               $id_registro = $_POST['id'];
               

               /**
                * La funcion $wpdb->delete(); RECIBE 3 parametros
                * 1. la tabla
                * 2. el where
                * 3. el tipo de dato, para numero d, paradecimal f, para string s
                * Nota: esta funcion devuelve 1 si se elimina el registro
                */
               $resultado = $wpdb->delete( $tabla, array( 'id' => $id_registro ), array('%d') );

               if ( $resultado == 1 ){
                   $respuesta = array(
                       'respuesta' => 1,
                       'id' => $id_registro
                   );
               }else{
                   $respuesta = array(
                       'respuesta' => 'error'
                   );
               }

           }
       }

       die( json_encode($respuesta) );
   }

 }