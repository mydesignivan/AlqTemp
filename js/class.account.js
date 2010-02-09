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
                var userid="", f=false;
                f = $('#formAccount')[0];

                $('#ajaxloader').show();
                if( f.user_id ) userid = f.user_id.value;

                $.ajax({
                    type : 'post',
                    url  : baseURI+'ajax_account/valid/',
                    data : {
                        username : escape(f.txtUser.value),
                        email    : escape(f.txtEmail.value),
                        captcha  : f.txtCatcha.value,
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
                            f.submit();
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

    this.delete_account = function(id){
        var msg = "Si elimina su usuario se eliminara también las propiedades associadas.\n";
        msg+= "¿Está seguro de confirmar la eliminación del usuario?.";
        if( confirm(msg) ){
            location.href = baseURI+"myaccount/delete/"+id;
        }
        return false;
    };

    this.captcha_show = function(selector){
        $.ajax({
            type : 'POST',
            url  : baseURI+"ajax_account/generatecaptcha",
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
