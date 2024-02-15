<?php
/**
 * Plugin Name: Res pop-up
 * Plugin URI: https://newtheme.eu
 * Description: Plugin para pop up
 * Version: 1.0.0
 * Author: Fanny Campos Allende
 * Author URI: https://newtheme.eu
 * License: GPL2
 * License URI: https: //www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pop-up
 * Domain Path: /languages
*/

function res_install(){
    // Acción al activar el plugin
    require_once 'activador.php';
}

register_activation_hook(__FILE__, 'res_install');

function res_desactivador(){
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'res_desactivador');