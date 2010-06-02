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
        //Inicialisa la Galeria de Imagenes
        ImageGallery.initializer(json);
        ImageGallery.load();

        // Inicialisa el Validador de campos
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


        // Aplica opacidad a la mascara para el form contact
        $('#formConsult .ajaxloader-mask').css('opacity', '0.5');

        // Configura el calendario
        $("input.datepicker").datepicker({
            showOn          : 'both',
            buttonImage     : 'images/icon_calendar.png',
            buttonImageOnly : true,
            dateFormat      : 'MM d, yy'
        });
    };

    this.send_consult = function(){
        if( working ) return false;

         ajaxloader.show('Validando Formulario');

         var cartel = false;
         $.validator.validate('#formConsult .validate', function(error){
             if( !error && validEmptyField() ){

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
                             cartel.html('Ocurrio un error en el envio.').slideDown('slow');
                         }
                     },
                     error : function(result){
                         alert("ERROR; \n"+result.responseText);
                     },
                     complete : function(){
                         ajaxloader.hidden();
                         f.txtName.value = "Nombre";
                         f.txtEmail.value = "E-mail";
                         f.txtPhone.value = "N&uacute;mero de Contacto";
                         f.txtResLlegada.value = "";
                         f.txtResSalida.value = "";
                         f.cboResAdultos.options[0].selected=true;
                         f.cboResNinios.options[0].selected=true;
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
     };

     var validEmptyField = function(){
         var arr = Array('txtName', 'txtEmail', 'txtConsult');

         try{
             $(arr).each(function(i, t){
                var obj = $('#formConsult [name='+t+']');

                if( obj.length>0 ){
                    obj.trigger('focus');
                    if( obj.val().length==0 ) {
                         ajaxloader.hidden();
                         show_error(obj, 'Este campo es obligatorio');
                         throw true;
                    }
                }
             });

         }catch(e){return false;}
         return true;
     };

})();