<div class="wrap">
    <h3>Data Base Contacto</h3>
    <p>Aqui se guarda una copia de los correos de contacto desde el formulario de contacto</p>
    <table class="wp-list-table widefat striped">
        <thead>
            <tr>
                <th class="manage-column">ID</th>
                <th class="manage-column">Nombre</th>
                <th class="manage-column">Correo</th>
                <th class="manage-column">telefono</th>
                <th class="manage-column">Mensaje</th>
                <th class="manage-column">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                global $wpdb;

                $tabla = $wpdb->prefix . 'contacto';
                $registros = $wpdb->get_results("SELECT * FROM $tabla", ARRAY_A);

                foreach ( $registros as $registro ) :
            ?>

                <tr>
                    <td><?php echo $registro['id']; ?></td>
                    <td><?php echo $registro['nombre']; ?></td>
                    <td><?php echo $registro['correo']; ?></td>
                    <td><?php echo $registro['telefono']; ?></td>
                    <td><?php echo $registro['mensaje']; ?></td>
                    <td>
                     <!--IMPORTANTE : en el atributo data-dbreservas=""  se recoge el id de la tabla que debemos de eliminar
                        debemos de colocar un echo seguido de $resgistro['id'] para que se imprima el id de la fila-->
                        <a href="#" class="borrar-registro" data-dbform="<?php echo $registro['id']; ?>">Eliminar</a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>