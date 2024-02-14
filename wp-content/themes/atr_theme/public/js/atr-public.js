
function initMap(){

    //Ahora obtenemos un array de objetos
    //console.log(atr_opciones);
    
    var cordenada = {
        //Los datos devueltos aparecen como string, entre comillas, debemos pasar las cordenadas a float
        lat: parseFloat(atr_opciones.latitud), 
        lng: parseFloat(atr_opciones.longitud)
    };

    //map options
    var options = {
        //El dato devuelto es un entero asi que lo convertimos a entero
        zoom: parseInt(atr_opciones.zoom),
        center: cordenada
    }

    //new map
    var map = new google.maps.Map( document.getElementById( 'map' ), options );

    //add marker
    var marker = new google.maps.Marker({
        position: cordenada,
        map: map,
        //Aqui pondremos la ruta de la imagen para el marcador
        //icon: 'flag-icon.png'
    });

    //popup para el marcador
    var infoWindow = new google.maps.InfoWindow({
        content: '<h1> Texto Aqui </h1>'
    })

    marker.addListener( 'click', function(){
        infoWindow.open( map, marker );
    })

}
  

( function( $ ){


    //Dropdown jquery
    // $('.li-menu ul').addClass('visible');
    
    // $('.li-menu').hover(function(){
    //     $('.sub-menu').removeClass('visible');
    // }, function(){
    //     $('.sub-menu').addClass('visible');
    // })


    $('.text-content hr').addClass('separador_1');
    $('.text-content hr').html('<hr class="separador_2">'); 
    
    //añadiendo barras
    $('.text-form hr').addClass('separador_1');
    $('.text-form hr').html('<hr class="separador_2">');
    //añadiendo barras a paginas
    $('.text-content hr').addClass('separador_1');
    $('.text-content hr').html('<hr class="separador_2">');

    //Añadiendo clases al sidebar
    $('div .textwidget').addClass('row');
    $('div .textwidget p').wrap('<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12"></div>');

    //search form
    $('.searchform #s').attr('placeholder', 'Buscar');
    $('.searchform #searchsubmit').attr('class', 'btn btn-dark ');

    //form comentarios
    $('.form-submit input').addClass('btn btn-dark');
    $('.reply a').addClass('btn btn-dark');


  

    /**
     * Construimos un ajax para crear una galeria de imagenes
     * IMPORTANTE : EL PASO 1 ME SIRVE PARA TODAS LAS MODALES QUE HAGA EN ESTA WEB
     */

    //Paso 1. ocultamos la ventana modal
    $('.modal-galeria').hide();

    //Paso 2 pasamos las rutas por ajax
    $(document).on('click', '.row-front-page-gallery .sombra a', function(e){
        e.preventDefault();
        var name = $(this).attr('href');
        //console.log(name);
        $.ajax({
            url: atr_ruta.ajaxurl,
            type: 'post',
            data: {
                //en el action creare la funcion atr_ajax_ruta
                action: 'atr_ajax_ruta',
                //post_ruta, asi llamare a la variable donde almacenare la ruta
                post_ruta: name
            },
            success: function(resultado){
                
               //alert(resultado);
                $('.modal-galeria').html(resultado).show();
                //Paso 3. creamos la funcion para cerrar la ventana modal
                $('.close').on('click', function(){
                    $('.modal-galeria').hide();
                })
            }
        })
    })

    /**
     * Construiremos un ajax para la pagina galeria
     */
    $(document).on('click', '.container-galeria .sombra a', function(e){
        e.preventDefault();
        var name = $(this).attr('href');
        //console.log(name);
        $.ajax({
            url: atr_ruta_galeria.ajaxurl,
            type: 'post',
            data: {
                action: 'atr_ajax_ruta_galeria',
                post_ruta_galeria: name
            },
            success: function(respuesta){
                // alert(respuesta);
                $('.modal-galeria').html(respuesta).show();
                $('.close').on('click', function(){
                    $('.modal-galeria').hide();
                })
            }
        })
    })
    
    
})( jQuery );