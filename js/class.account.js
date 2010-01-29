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

                $('#ajaxloader').show();
                if( document.formAccount.user_id ) userid = document.formAccount.user_id.value;

                $.ajax({
                    type : 'post',
                    url  : document.baseURI+'index.php/ajax_account/valid/',
                    data : {
                        username : escape(document.formAccount.txtUser.value),
                        email    : escape(document.formAccount.txtEmail.value),
                        captcha  : document.formAccount.txtCatcha.value,
                        userid   : userid
                    },
                    success : function(data){
                        if( data=="existsuser" ){
                            show_error('El usuario ingresado ya existe.');

                        }else if( data=="existsmail" ){
                            show_error('El email ingresado ya existe.');

                        }else if( data=="captcha_error" ){
                            ValidatorAccount.message.hidden("#formAccount .validate");
                            ValidatorAccount.message.show("#txtCatcha", ['El c&oacute;digo ingresado es incorrecto.']);
                            $('#ajaxloader').hide();

                        }else if( data=="ok" ){
                            document.formAccount.submit();
                        }
                    },
                    error   : function(http){
                        alert("ERROR: "+http.responseText);
                    },
                    complete : function(){
                        $('#ajaxloader').hide();
                        working=false;
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


    /*
     * PRIVATE METHODS
     */
    var show_error = function(msg){
        $('#contmessage').html(msg);
        if( $('#contmessage').is(':hidden') ){
            $('#contmessage').slideToggle('slow');
        }
        $('#ajaxloader').hide();
    };

})();

var ValidatorAccount = new Class_Validator({
    selectors : '#formAccount .validate',
    messageClass : 'formError_Account',
    messagePos : 'up',
    validationOne : true
});
