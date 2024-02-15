<?php
/**
 *  Se activa cuando el plugin va a ser desactivado
 */

 if( !defined( 'WP_UNINSTALL_PLUGIN' ) ){
    exit();
 }

 /**
  * Agrega todo el código necesario para eliminar
  * Bases de datos, limpiar caché, limpiar enlaces permanentes, etc ...
  * en la desinstalación del plugin
  */