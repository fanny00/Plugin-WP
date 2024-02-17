$ = jQuery.noConflict();

$(document).ready(function(){

    setTimeout(function(){
        var Modalpopup = new bootstrap.Modal(document.getElementById('modalPreviewPublic'), {
            keyboard: false
        })

        Modalpopup.show();
    }, 4000);

})