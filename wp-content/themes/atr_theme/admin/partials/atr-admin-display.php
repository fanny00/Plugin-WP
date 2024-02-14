<div class="wrap">
    <h1>Ajustes Restaurante</h1>
    <!--el form apunta al archivo options.php de wordpress, para registrar las opciones-->
    <?php
        if ( isset( $_GET['tab']) ) :

            $active_tab = $_GET['tab'];

        endif;
    ?>
    <h2 class="nav-tab-wrapper">
        <a href="?page=atr-opt&tab=tema" class="nav-tab<?php echo $active_tab=='tema' ? 'nav-tab-active' : '' ?>">Ajustes</a>
        <a href="?page=atr-opt&tab=map" class="nav-tab<?php echo $active_tab=='map' ? 'nav-tab-active' : '' ?>">Google Maps</a>
    </h2>
    <form action="options.php" method="post">

        <?php if ( $active_tab == 'tema' ) : ?>
                <?php 
                    settings_fields('atr_opciones_grupo');
                    do_settings_sections('atr_opciones_grupo');
                    
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Direccion</th>
                        <!--Pondremos dentro de la api_option(), el nombre del campo registrado-->
                        <td><input type="text" name="atr_direccion" value="<?php echo esc_attr( get_option('atr_direccion') ); ?>"></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Telefono</th>
                        <td><input type="text" name="atr_telefono" value="<?php echo esc_attr( get_option('atr_telefono') ); ?>"></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Correo</th>
                        <td><input type="text" name="atr_correo" value="<?php echo esc_attr( get_option('atr_correo') ); ?>"></td>
                    </tr>
                    
                </table>
        <?php else : ?>
                <!--Aqui los ajustes para la api maps-->
                <?php 
                    settings_fields('atr_opciones_map');
                    do_settings_sections('atr_opciones_map');
                    
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Latitud</th>
                        <!--Pondremos dentro de la api_option(), el nombre del campo registrado-->
                        <td><input type="text" name="atr_latitud" value="<?php echo esc_attr( get_option('atr_latitud') ); ?>"></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Longitud</th>
                        <td><input type="text" name="atr_longitud" value="<?php echo esc_attr( get_option('atr_longitud') ); ?>"></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Zoom</th>
                        <td><input type="text" name="atr_zoom" value="<?php echo esc_attr( get_option('atr_zoom') ); ?>"></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Api_key</th>
                        <td><input type="text" name="atr_api_key" value="<?php echo esc_attr( get_option('atr_api_key') ); ?>"></td>
                    </tr>
                    
                </table>
    <?php endif; ?>       

        <?php
        //esta funcion solo funciuona en la parte del admin 
        submit_button(); ?>
    </form>
</div>
<?php

?>
