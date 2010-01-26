/* 
 * Clase 
 * 
 */

var Account = new (function(){

    /*
     * PUBLIC METHODS
     */

    this.save = function(){
        if( working ) return;

        ValidatorAccount.validate(function(error){
            if( !error ){
                working=true;
                var userid="";
                if( document.formAccount.user_id ) userid = "/"+document.formAccount.user_id.value;

                $('#ajaxloader').show();
                $.get(document.baseURI+'index.php/ajax_account/valid/'+escape(document.formAccount.txtUser.value)+userid+'/'+document.formAccount.txtCatcha.value, function(data){
                    if( data=="exists" ){
                        if( $('#contmessage').is(':hidden') ){
                            $('#contmessage').html('El usuario ingresado ya existe.');
                            $('#contmessage').slideToggle('slow');
                        }
                        $('#ajaxloader').hide();
                        working=false;
                    }else if( data=="captcha_error" ){
                        ValidatorAccount.message.hidden("#formAccount .validate");
                        ValidatorAccount.message.show("#txtCatcha", ['El c&oacute;digo ingresado es incorrecto.']);
                        $('#ajaxloader').hide();
                        working=false;
                        
                    }else{
                        document.formAccount.submit();
                    }
                });

            }else{
                alert('Se han encontrado errores.\nPor favor, revise el formulario.');
            }
        });
    };

    this.delete_account = function(id, url){
        var msg = "Si elimina su usuario se eliminara también las propiedades associadas.\n";
        msg+= "¿Está seguro de confirmar la eliminación del usuario?.";
        if( confirm(msg) ){
            location.href = url+"/"+id;
        }
        return false;
    };

    this.captcha_show = function(selector){
        $.ajax({
            type : 'POST',
            url  : document.baseURI+"index.php/ajax_account/generatecaptcha",
            success : function(data){
                $(selector).replaceWith(data);
            }
        });

    };

    /*
     * PRIVATE PROPERTIES
     */
    var working=false;

})();

var ValidatorAccount = new Class_Validator({
    selectors : '#formAccount .validate',
    messageClass : 'formError_Account',
    messagePos : 'up',
    validationOne : true
});
