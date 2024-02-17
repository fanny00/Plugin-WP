/** 
 * Archivo js de la parte de la administración
 */

$ = jQuery.noConflict();

//Variables globales
var modalNombre;
var modalId;
var popupNombre;
var popupId;

//Variables globales marco multimedia
var marco;
var imgDataEdit = $('.block-02 #imgFondo');
var imagen = $('.campo-imagen #imagen img');

//Ajax edit pop-up
var tituloDataEdit      = $('.block-02 #titulo');
var subtituloDataEdit   = $('.block-02 #subTitulo');
var btnTitle            = $('#camposSwitch #btnText1');
var btnCheck            = $('#switch input[type=checkbox]');
var btnCheck1           = $('#camposSwitch #newTab');
var btnCheck2           = $('#camposSwitch #sameTab');
var btnUrl              = $('#camposSwitch #btnUrl');
var URLactual           = window.location;


$(document).ready(function(){

    $('#btn_crear').on('click', function(){

        var Modalpopup = new bootstrap.Modal(document.getElementById('Modalpopup'), {
            keyboard: false
          })

        Modalpopup.show();

    })

})

//Boton guardar pop-up
$(document).ready(function(){

    $('.modalData #btnGuardar').on('click', function(){

        modalNombre = $('.modalData #dataNom').val();
        modalId = Math.floor(Math.random() * 100);

        $.ajax({
            url: dataPopup.url,
            type: 'post',
            dataType: 'json',
            data: {
                action: 'res_data_popup',
                nonce: dataPopup.seguridad,
                nombre: modalNombre,
                id: modalId,
                tipo: 'add',
                datos_u: dataPopup.objeto
            },
            success: function(res){

                console.log(res.objeto);
                console.log(res.datos_u);

                setTimeout(function(){

                    var Modalpopup = new bootstrap.Modal(document.getElementById('Modalpopup'), {
                        keyboard: false
                    })

                    Modalpopup.hide();

                }, 1500);

                location.href = "?page=res_popup&edit="+ modalNombre +"&id="+ modalId;
                
            }
        })

    })

})

//Botón editar pop-up redirige a la página del popup
$(document).ready(function(){

    $('#tableId tr #btn_editar').on('click', function(){

        var item = $(this);
        var tr = item.parent().parent();

        popupNombre = tr.attr('data-nombre');
        popupId = tr.attr('id');

        location.href = "?page=res_popup&edit="+popupNombre+"&id="+popupId;


    })

})

//Boton para volver atras
$(document).ready(function(){

    $('.block-01 #volverAtras').on('click', function(){

        location.href = "?page=res_popup";

    })

})

//Botón switch call to action
$(document).ready(function(){

    $('.switch').on('click', function(){

        var check = $('#switch input[type=checkbox]');

        if( check.is(':checked') ){

            $('#camposSwitch').show(1000);

        }else{
            $('#camposSwitch').hide(1000);
        }

    })

})

//Marco multimedia
$(document).ready(function(){

    $('#imgFondo').on('click', function(e){

        e.preventDefault();

        if( marco ){

            marco.open();
            return;

        }

        marco = wp.media({
            frame: 'select',
            title: 'Seleccionar imagen para pop-up',
            button: {
                text: 'usar esta imagen'
            },
            multiple: false,
            library: {
                type: 'image'
            }
        })

        marco.on('select', function(){

            var imgPopup = marco.state().get('selection').first().toJSON();
            var urlLimpia = limpiar_ruta(imgPopup.url);
            imgDataEdit.val(urlLimpia);
            imagen.attr('src', urlLimpia);

        })

        marco.open();

    })

})

//Limpiar la ruta
function limpiar_ruta( url ){

    //servidor local
    var local = /localhost/;

    if( local.test(url) ){

        var url_pathname = location.pathname;
        var indexPost = url_pathname.indexOf('wp-admin');
        var url_pos = url_pathname.slice(0, indexPost);
        var url_delete = location.protocol + '//' + location.host + url_pos;

        return url_pos + url.replace(url_delete, '');


    }else{

        //servidor remoto
        var url_real = location.protocol + '//' + location.hostname;
        return url.replace(url_real, '');

    }

}

//Ajax data edit pop-up
$(document).ready(function(){

    $('.block-02 #btnSave').on('click', function(){

        var titulo           = tituloDataEdit.val();
        var subtitulo       = subtituloDataEdit.val();
        var imagenUrl       = imgDataEdit.val();
        var textDataEdit    = tinyMCE.activeEditor.getContent();
        var dataNombre      = $(this).attr('data-nombre');
        var buttonCheck     = btnCheck.is(':checked');
        var buttonTitle     = btnTitle.val();
        var buttonCheck1    = btnCheck1.is(':checked');
        var buttonCheck2    = btnCheck2.is(':checked');
        var buttonUrl       = btnUrl.val();

        $.ajax({
            url: dataCreatePopup.url,
            type: 'post',
            dataType: 'json',
            data: {
                action: 'res_create_popup',
                nonce: dataCreatePopup.seguridad,
                nombre: dataNombre,
                titulo: titulo,
                subtitulo: subtitulo,
                imagen: imagenUrl,
                texto: textDataEdit,
                buttonCheck: buttonCheck,
                buttonTitle: buttonTitle,
                buttonCheck1: buttonCheck1,
                buttonCheck2: buttonCheck2,
                buttonUrl: buttonUrl,
                tipo: 'create'
            },
            success: function(res){

                location.href = URLactual;
                console.log(res.data);
                console.log(res.objeto);

            }
        });

    })

})

//function onload para las opciones del botón  call to action
window.onload = function (){

    //recuperamos los valores de la URL
    var valores = window.location.search;

    //instanciamos a la clase URLSearchParams y creamos un objeto
    var urlParams = new URLSearchParams(valores);

    //verificar si existe un parametro
    var edit = urlParams.has('edit');
    var idEdit = urlParams.has('id');

    var checkbox = $('#switch input[type=checkbox]');
    var validate = checkbox.attr('data-check');

    //radio buttons
    var radioButton1 = $('#camposSwitch #newTab');
    var validateRadio1 = radioButton1.attr('data-check');

    var radioButton2 = $('#camposSwitch #sameTab');
    var validateRadio2 = radioButton2.attr('data-check');

    //convertimos el string true a un valor booleano
    validate = (validate === 'true');

    if( edit == true && idEdit == true ){

        if( validate == true ){

            checkbox.prop('checked', true);

        }else{

            checkbox.prop('checked', false);
            $('#camposSwitch').hide();

        }

        //radio buttons validate
        if(validateRadio1 == 'true'){
            radioButton1.prop('checked', true);
        }else{
            radioButton1.prop('checked', false);
        }

        if(validateRadio2 == 'true'){
            radioButton2.prop('checked', true);
        }else{
            radioButton2.prop('checked', false);
        }
        

    }


}

//Evento para activar la previsualización del pop-up
$(document).ready(function(){

    $('.page-edit-popup #btnPreview').on('click', function(e){

        e.preventDefault();

        var titulo          = tituloDataEdit.val();
        var subtitulo       = subtituloDataEdit.val();
        var imgUrl          = imagen.attr('src');
        var texto           = tinyMCE.activeEditor.getContent();
        var buttonTitle     = btnTitle.val();
        var buttonCheck1    = btnCheck1.attr('data-check');
        var buttonUrl       = btnUrl.val();

        modal_edit( titulo, subtitulo, imgUrl, texto, buttonTitle, buttonCheck1, buttonUrl );

    })

})

//función para añadir el popup
function modal_edit( titulo, subtitulo, imgUrl, texto, buttonTitle, buttonCheck1, buttonUrl ){

    var ventana = '';

    if(buttonCheck1 == 'true'){

        ventana = '_blank';

    }else{

        ventana = '_self';

    }

    var html = '';

    html += `
    <div class="modal modalData" tabindex="-1" id="modalPreview">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
        
                <div class="row">
                <div class="col-4 col-sm-4">
                    <div class="class-imgFondo" style="background-image: url(${imgUrl})"></div>
                </div>
        
                <div class="col-8 col-sm-8">
                    <div class="mb-3 mt-2 row">
                        <div class="col-12 col-sm-12 d-flex justify-content-end pd-btnclose">
                            <div class="col-1">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <div class="boton-close"><span aria-hidden="true">x</span></div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <div class="col-12 pd-textmodal">
                            <div class="content-popup text-center">
                                <h4>${titulo}</h4>
                                <h6>${subtitulo}</h6>
                                <p>
                                    ${texto}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <div class="col-12 pd-textmodal btn-callAction text-center">
                            <a href="${buttonUrl}" class="btn btn-success" target="${ventana}">
                                <span>${buttonTitle}</span>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
                
            </div>
        </div>
    </div>
    `;

    $('.page-edit-popup').append(html);

    var Modalpopup = new bootstrap.Modal(document.getElementById('modalPreview'), {
        keyboard: false
    })

    Modalpopup.show();

}

//delete pop-up
$(document).ready(function(){

    $('#tableId tr #btn_eliminar').on('click', function(){

        var item = $(this);
        var objeto = item.attr('data-objeto');
        var tr = item.parent().parent();

        popupNombre = tr.attr('data-nombre');
        popupId = tr.attr('id');

        var deletePopupEdit = popupNombre+'-ID-'+popupId;

        $.ajax({
            url: dataPopup.url,
            type: 'post',
            dataType: 'json',
            data: {
                action: 'res_data_popup',
                nonce: dataPopup.seguridad,
                nombre: deletePopupEdit,
                objeto: objeto,
                tipo: 'delete'
            },
            success: function(res){

                var deleteElement = document.getElementById(popupId);
                deleteElement.remove();
                location.href= URLactual;

            }

        })

    })

})