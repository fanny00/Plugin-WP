<?php 
/**
 * Plugin Name: Res pop-up
 * Plugin URI: https://newtheme.eu
 * Description: Plugin para pop up
 * Version: 1.0.0
 * Author: Jhon J.R
 * Author URI: https://newtheme.eu
 * License: GPL2
 * License URI: https: //www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pop-up
 * Domain Path: /languages
*/

function res_install(){
    //acción al activar el plugin
    require_once 'activador.php';
}
register_activation_hook(__FILE__, 'res_install');

function res_desactivador(){
    //acción al desactivar el plugin
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'res_desactivador');

//Menú de opciones
require_once 'partials/res-menu.php';

//Encolamiento de archivos
require_once 'partials/res-archivos.php';

//parte publica
require_once 'public/res-public-popup.php';