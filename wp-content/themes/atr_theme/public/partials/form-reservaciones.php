<div class="row">
    <?php $template = 'page-reservas.php'; ?>
    <?php if ( is_page_template( $template ) || is_front_page(  )) :
          $reservas = new WP_Query('pagename=reservas');
          while ( $reservas-> have_posts(  )) : $reservas->the_post();
          //the_content();
    ?>
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 imagen-1">
            <?php $imagen1 = get_field('imagen_1'); ?>
            <img class="img-fluid" src="<?php echo $imagen1; ?>" alt="Delicious Restaurant">
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 formulario">
            <div class="row text-content-form text-form">
                <?php
                    the_content();
                 ?>
            </div>
            <form action="" method="post">
                <div class="nombre">
                    <label for="Nombre"><i class="fas fa-user"></i></label>
                    <input type="text" name="nombre" id="nombre" placeholder="Ingresa tu Nombre" required>
                </div>
                <div class="email">
                    <label for="Email"><i class="fas fa-envelope"></i></label>
                    <input type="email" name="email" id="email" placeholder="Ingresa tu @correo" required>
                </div>
                <div class="telefono">
                    <label for="Telefono"><i class="fas fa-mobile-alt"></i></label>
                    <input type="tel" name="telefono" id="telefono" placeholder="Tu teléfono" required>
                </div>
                <div class="fecha">
                    <label for="Fecha"><i class="fas fa-calendar-alt"></i></label>
                    <input type="date" name="fecha" id="fecha" placeholder="Indica la fecha de la Reserva" required>
                </div>
                <div class="hora">
                    <?php 
                        $Horas = array('13:00','13:30','14:00','14:30','15:00','15:30','16:00','20:00','20:30','21:00','21:30','22:00','22:30');

                        //var_dump($Horas);
                        
                    ?>
                    <label for="Hora"><i class="fas fa-clock"></i></label>
                    <select name="hora" id="hora" required>
                        <option value="">Selecciona una hora</option>
                        <?php foreach($Horas as $hora): ?>
                            <option value="<?php echo $hora; ?>"><?php echo $hora; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="personas">
                    <label for="Personas"><i class="fas fa-users"></i></i></label>
                    <select name="personas" id="personas" required>
                        <option value="">Seleccione el número de personas</option>

                        <?php 
                            $persona = array('2','3','4','5','6','7','8','9','10','Más de 10');

                            foreach( $persona as $personas):
                        ?>

                            <option value="<?php echo $personas; ?>"><?php echo $personas; ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="submit-button text-center">
                    <button class="btn btn-dark" type="submit" name="reserva" id="reserva">Enviar Reserva</button>
                </div>
                <!--Este input estara oculto y me servira para verificar que se carga correctamente el form-->
                <input type="hidden" name="oculto" value="1">
            </form>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-12 col sm-12 col-12 imagen-2">
            <?php $imagen2 = get_field('imagen_2'); ?>
            <img class="img-fluid" src="<?php echo $imagen2; ?>" alt="Delicious Restaurant">
        </div>
    <?php endwhile; ?>
        <?php endif; ?>
    </div>