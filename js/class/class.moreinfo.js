/* 
 * Clase MoreInfo
 *
 * Su funcion: Envia el form de consulta al propietario del inmueble.
 *
 */

var MoreInfo = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(json){
        //Inicializa la Galeria de Imagenes
        ImageGallery.initializer(json);
        ImageGallery.load();

        // Inicializa el Validador de campos
        f = $('#formConsult')[0];
        $.validator.setting('#formConsult .validate', {
            effect_show     : 'slidefade',
            validateOne     : true,
            addClass        : 'validator-contact'
        });
        $(f.txtName).validator({
            v_required : true
        });
        $(f.txtEmail).validator({
            v_required : true,
            v_email    : true
        });
        $(f.txtConsult).validator({
            v_required : true
        });

        $('#formConsult .ajaxloader-mask').css('opacity', '0.5');
    };

    this.send_consult = function(){
        if( working ) return false;

         ajaxloader.show('Validando Formulario');

         var cartel = false;
         $.validator.validate('#formConsult .validate', function(error){
             if( !error ){
                 ajaxloader.show('Enviando consulta...');
                 $.ajax({
                     type : 'post',
                     url  : baseURI+'masinfo/ajax_sendconsult',
                     data : $('#formConsult').serialize(),
                     success : function(data){
                         if( data=="ok" ){
                             cartel = $('#formConsult .success');
                             cartel.html('La consulta ha sido enviada con &eacute;xito.').slideDown('slow');
                         }else{
                             cartel = $('#formConsult .error');
                             cartel.html('Ocurrio un error al enviar el mensaje.').slideDown('slow');
                         }
                     },
                     error : function(result){
                         alert("ERROR; \n"+result.responseText);
                     },
                     complete : function(){
                         ajaxloader.hidden();
                         f.txtName.value = "";
                         f.txtEmail.value = "";
                         f.txtPhone.value = "";
                         f.txtConsult.value = "";

                         setTimeout(function(){
                             cartel.slideUp('slow');
                         }, 5000);
                     }
                 });
             }else ajaxloader.hidden();
         });

     };

    /* PRIVATE PROPERTIES
     **************************************************************************/
     var f=false;
     var working=false;


    /* PRIVATE METHODS
     **************************************************************************/
     var ajaxloader={
         show : function(msg){
             working=true;
             $('#formConsult .ajaxloader-mask').show();
             $('#formConsult .ajaxloader').html('<img src="images/ajax-loader4.gif" alt=""><p>'+msg+'</p>').show();
         },
         hidden : function(){
            working=false;
            $('#formConsult .ajaxloader-mask, #formConsult .ajaxloader').hide();
         }
     }

})();