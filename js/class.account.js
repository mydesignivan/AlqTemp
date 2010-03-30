/* 
 * Clase Account
 *
 * Su funcion: Crear, Modificar o Eliminar usuarios
 *
 */

var Account = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(mode){
        mode_edit = mode;
        f = $('#formAccount')[0];
        if( f ){
            $.validator.setting('#formAccount .validate', {
                effect_show     : 'slide',
                validateOne     : true
            });

            $("input[name='txtFirstName'], input[name='txtLastName']").validator({
                v_required  : true
            });
            $(f.txtEmail).validator({
                v_required  : true,
                v_email     : true
            });
            $(f.txtUser).validator({
                v_required  : true,
                v_user      : [5,10]
            });
            $(f.txtPass).validator({
                v_required  : !mode_edit,
                v_password  : [8,10]
            });
            $(f.txtPass2).validator({
                v_required  : !mode_edit,
                v_compare   : $(f.txtPass)
            });
            if( f.txtCaptcha ){
                $(f.txtCaptcha).validator({
                    v_required  : true
                });
            }
        }
    };

    this.save = function(){
        if( working ) return false;

        ajaxloader.show();

        $.validator.validate('#formAccount .validate', function(error){
            if( !error ){

                $.ajax({
                    type : 'post',
                    url  : baseURI+'registro/ajax_check/',
                    data : {
                        username : escape(f.txtUser.value),
                        email    : escape(f.txtEmail.value),
                        captcha  : $(f.txtCaptcha).val(),
                        userid   : $(f.user_id).val()
                    },
                    success : function(data){
                        if( data=="existsuser" ){
                            show_error(f.txtUser, 'El usuario ingresado ya existe.');

                        }else if( data=="existsmail" ){
                            show_error(f.txtEmail, 'El email ingresado ya existe.');

                        }else if( data=="captcha_error" ){
                            show_error(f.txtCaptcha, 'El c&oacute;digo ingresado es incorrecto.');

                        }else if( data=="ok" ){
                            f.submit();
                        }else{
                            alert("ERROR: \n"+data);
                        }
                    },
                    error   : function(result){
                        alert("ERROR: \n"+result.responseText);
                    },
                    complete : function(){
                        ajaxloader.hidden();
                    }
                });
            }else ajaxloader.hidden();
            
        });
        return false;
    };

    this.delete_account = function(id){
        var msg = "Si elimina su usuario se eliminara también las propiedades associadas.\n";
        msg+= "¿Está seguro de confirmar la eliminación del usuario?.";
        if( confirm(msg) ){
            location.href = baseURI+"panel/micuenta/delete/"+id;
        }
        return false;
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var working=false;
    var f=false;
    var mode_edit = false;

    /* PRIVATE METHODS
     **************************************************************************/
    var ajaxloader = {
        show : function(){
            working=true;
            popup.show('<p>Enviando formulario.</p><img src="images/ajax-loader5.gif" alt="" />');
        },
        hidden : function(){
            popup.hidden();
            working=false;
        }
    }

})();
