<?php

class RES_Master{

    protected $plugin_dir_path;
    protected $cargador;
    protected $taxonomias;

    public function __construct(){

        $this->plugin_dir_path = plugin_dir_path( __FILE__ );
        $this->cargar_dependencias();
        $this->definir_admin_hooks();

    }

    public function cargar_dependencias(){

        require_once $this->plugin_dir_path . 'res-cargador.php';
        require_once $this->plugin_dir_path . 'res-taxonomias.php';

        $this->cargador = new RES_Cargador;
        $this->taxonomias = new RES_Taxonomias;

    }

    public function definir_admin_hooks(){

        $this->cargador->add_action( 'init', $this->taxonomias, 'tipo_comida' );
        
    }


    public function res_run(){

        $this->cargador->res_run();

    }

}