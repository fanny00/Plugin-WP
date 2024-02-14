<div class="wrap">
    <h3>Data Base Reservas</h3>
    <p>Aquí se guarda una copia de todas las reservas de los clientes</p>
    <table class="wp-list-table widefat striped">
        <thead>
            <tr>
            <th class="manage-column">ID</th>
                <th class="manage-column">Nombre</th>
                <th class="manage-column">Correo</th>
                <th class="manage-column">Teléfono</th>
                <th class="manage-column">fecha</th>
                <th class="manage-column">Hora</th>
                <th class="manage-column">Personas</th>
                <th class="manage-column">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                global $wpdb; 

                $tabla = $wpdb->prefix . 'reservas';
                $registros = $wpdb->get_results("SELECT * FROM $tabla", ARRAY_A);

                foreach ( $registros as $registro ) :
            ?>
                <tr>
                    <td><?php echo $registro['id']; ?></td>
                    <td><?php echo $registro['nombre']; ?></td>
                    <td><?php echo $registro['correo']; ?></td>
                    <td><?php echo $registro['telefono']; ?></td>
                    <?php
                    /*  
                        url: https://codex.wordpress.org/Function_Reference/mysql2date
                        La funcion mysql2date(), me devuelve un nuevo formato fecha, el que yo programe
                        l = Full name for day of the week (lower-case L).
                        F = Full name for the month.
                        j = The day of the month.
                        Y = The year in 4 digits. (lower-case y gives the year’s last 2 digits)
                        url: https://wordpress.org/support/article/formatting-date-and-time/
                    */
                     ?>
                    <td><?php echo mysql2date( 'l, F j, Y', $registro['fecha'] ); ?></td>
                    <td><?php echo $registro['hora']; ?></td>
                    <td><?php echo $registro['personas']; ?></td>
                    <td>
                        <!--IMPORTANTE : en el atributo data-dbreservas=""  se recoge el id de la tabla que debemos de eliminar
                        debemos de colocar un echo seguido de $resgistro['id'] para que se imprima el id de la fila-->
                        <a href="#" class="borrar-registro-2" data-dbreservas="<?php echo $registro['id']; ?>">Eliminar</a>
                    </td>
                </tr>
            

            <?php 

                endforeach;

            ?>
        </tbody>
    </table>
</div>