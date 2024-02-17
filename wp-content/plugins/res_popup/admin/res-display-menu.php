<?php 
/** 
 * Aqui crearemos el html de la primera página
 */

$dato = get_option('res_popup');
//var_dump($dato);

?>

<div class="container-fluid page-menu" style="background-color: #f1f1f1">
    <h3>Dashboard</h3>
    <div class="row">

        <!--bloque 01-->
        <div class="col-sm-12">
            <div class="card mb-3" style="max-width: 100%;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?php echo plugin_dir_url(__FILE__) . 'imgs/img-pop-up.png'; ?>" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"> Title </h5>
                            <p class="card-text">
                                Gana dinero promocionando algún tipo de producto o servicio
                            </p>
                            <p class="card-text">
                                <small class="text-muted">Convierte tus visitas en ganancias</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--bloque 02-->
        <div class="col-sm-12">
            <div class="card text-dark mb-3">
                <div class="card-header">
                    <h6 class="res-box-title">
                        Pop-ups
                    </h6>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        En esta parte podrás editar o eliminar tu pop-up, cada vez que crees uno 
                        aparecerá justo debajo con su respectivo shortcode para que lo pegues en las 
                        páginas donde quieras que aparezca.
                    </p>

                    <table class="table" id="tableId">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Shortcode</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                                if($dato != ''){

                                    foreach($dato as $key => $datos):
                                        
                                        $output = "
                                        <tr id='$datos[id]' data-nombre='$datos[nombre]'>
                                            <th scope='row'>$datos[nombre]</th>
                                            <td>[popup nombre='$datos[nombre]' id='$datos[id]']</td>
                                            <td>
                                                <a href='#' type='button' class='btn btn-outline-info' id='btn_editar'>
                                                    <span class='dashicons dashicons-welcome-write-blog'></span>
                                                </a>
                                                <a href='#' type='button' class='btn btn-outline-danger' id='btn_eliminar' data-objeto='$key'>
                                                    <span class='dashicons dashicons-trash'></span>
                                                </a>
                                            </td>
                                        </tr>
                                        ";

                                        echo $output;

                                    endforeach;

                                }else{

                                    echo $outpup = '';

                                }

                            ?>
                        </tbody>
                    </table>

                    <!--botón crear-->
                    <a href="#" type="button" class="btn btn-primary text-uppercase btn-crear" id="btn_crear">
                        <span class="dashicons dashicons-plus"></span> Crear
                    </a>

                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'res-modal.php'; ?>

