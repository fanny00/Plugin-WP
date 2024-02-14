<?php

/**
 * Define la funcionalidad de internacionalización
 *
 * Carga y define los archivos de internacionalización de este theme para que esté listo para su traducción.
 *
 * @link       https://newtheme.eu
 * @since      1.0.0
 *
 * @package    ATR THEME
 * @subpackage ATR THEME/includes
 */

/**
 * Ésta clase define todo lo necesario durante la activación del theme
 *
 * @since      1.0.0
 * @package    ATR THEME
 * @subpackage ATR THEME/includes
 * @author     Jhon J.R <info@newtheme.com>
 */
class ATR_i18n {
    
    /**
	 * Carga el dominio de texto (textdomain) del theme para la traducción.
	 *
     * @since    1.0.0
     * @access public 
	 */    
    public function load_theme_textdomain() {
        
        $textdomain = "atr-opt";
        
        load_theme_textdomain(
            $textdomain,
            false,
            ATR_DIR_PATH . 'lang'
        );
        
        $locale = apply_filters( 'theme_locale', is_admin() ? get_user_locale() : get_locale(), $textdomain );
        
        load_textdomain( $textdomain, get_theme_file_path( "lang/$textdomain-$locale.mo" ) );
        
    }
    
}