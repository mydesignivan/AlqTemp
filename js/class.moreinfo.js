/* 
 * Clase 
 * 
 */

var MoreInfo = new (function(){

    /*
     * PUBLIC METHODS
     */
     this.send_consult = function(){
         ValidatorEmail.validate(function(error){
             if( error ){
                //alert('Se han encontrado errores.\nPor favor, revise el formulario.');
             }else{
                 ajaxload.show();

                 $.ajax({
                     type : 'post',
                     url  : document.baseURI+'index.php/masinfo/sendconsult',
                     data : $(document.formConsult).serialize(),
                     success : function(data){
                         if( data=="ok" ){
                              $('#formConsult .message').html('La consulta ha sido enviada con &eacute;xito.').slideDown('slow');
                         }else{
                              $('#formConsult .message').html('Ocurrio un error al enviar mensaje.').slideDown('slow');
                         }
                     },
                     error : function(xml){
                         alert("ERROR; "+xml.responseText);
                     },
                     complete : function(){
                         ajaxload.hidden();
                     }
                 });                 
             }
         });

     };


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



var ValidatorEmail = new Class_Validator({
    selectors : '#formConsult .validate',
    messageClass : 'formError_Account',
    messagePos : 'up',
    validationOne : true
});
