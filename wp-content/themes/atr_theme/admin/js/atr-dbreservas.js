$ = jQuery.noConflict();

$(document).ready(function(){
   //console.log(url_eliminar);

    $('.borrar-registro-2').on('click', function(e){

        e.preventDefault();
        var id= $(this).attr('data-dbreservas');

        /**
         * En este lado pondremos el codigo de sweetalert2
         * Podemos modificar el texto de la ventana
         */
        swal({
            title: 'Estás seguro?',
            text: "¡No podrás revertir esto!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, Eliminarlo!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.value) {

                                    $.ajax({
                                        type: 'post',
                                        data: {
                                            'action' : 'atr_dbreservas_eliminar',//esta funcion debo crearla, sera para eliminar registros
                                            'id' : id,
                                            'tipo' : 'reserva'
                                        },
                                        url: url_eliminar_reserva.urlajax,
                                        success: function(data){
                                            console.log(data);//aqui veremos el mensaje de la funcion dbform_eliminar
                                            /**
                                             * utilizaremos JSON.parse, para convertir la respuesta en un objeto y
                                             * a continuacion removeremos la fila donde esta el archivo eliminado,
                                             * utilizaremos .parent(), que accede al objeto padre y .remove()
                                             * resultado.id, asi apuntamos al objeto id, con un .
                                             */
                                            var resultado= JSON.parse(data);
                                            if( resultado.respuesta == 1 ){
                                                jQuery("[data-dbreservas='"+ resultado.id +"' ]").parent().parent().remove();
                                                
                                                //El swal es la ventana que me crea sweetalert2
                                                swal(
                                                    'Eliminado!',
                                                    'La reserva se ha eliminado!',
                                                    'success'
                                                )
                                                //console.log(resultado);
                                            }
                                        }
                                    })
                }
            })
    });

});