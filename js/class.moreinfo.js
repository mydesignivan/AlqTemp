/* 
 * Clase 
 * 
 */

var MoreInfo = new (function(){

    /*
     * PUBLIC METHODS
     */
    this.initializer = function(){
        f = $('#formConsult')[0];
        $.validator.setting('#formConsult .validate', {
            effect_show     : 'slide',
            validateOne     : true,
            addClass        : 'validator'
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
    };

     this.send_consult = function(){
         $.validator.validate('#formConsult .validate', function(error){
             if( !error ){
                 ajaxload.show();
                 var data = $('#formConsult').serialize();

                 $.ajax({
                     type : 'post',
                     url  : baseURI+'masinfo/sendconsult',
                     data : data,
                     success : function(data){
                         if( data=="ok" ){
                              $('#formConsult .message').html('La consulta ha sido enviada con &eacute;xito.').slideDown('slow');
                         }else{
                              $('#formConsult .message').html('Ocurrio un error al enviar el mensaje.').slideDown('slow');
                         }
                     },
                     error : function(xml){
                         alert("ERROR; "+xml.responseText);
                     },
                     complete : function(){
                         ajaxload.hidden();
                         f.txtName.value = "";
                         f.txtEmail.value = "";
                         f.txtPhone.value = "";
                         f.txtConsult.value = "";

                         setTimeout(function(){
                             $('#formConsult .message').slideUp('slow');
                         }, 5000);
                     }
                 });                 
             }
         });

     };

     /*
      * PRIVATE PROPERTIES
      */
     var f=false;


    /*
     * PRIVATE METHODS
     */
     var ajaxload={
         el  : false,
         el2 : false,
         show : function(){
             this.el = $('<div class="ajaxload-mask" />');
             this.el2 = $('<div class="ajaxload-message"><img src="images/ajax-loader4.gif" alt=""><p>Enviando consulta...</p></div>');
             $('#contFormConsult').append(this.el, this.el2);
         },
         hidden : function(){
            this.el.remove();
            this.el2.remove();
         }
     }

})();