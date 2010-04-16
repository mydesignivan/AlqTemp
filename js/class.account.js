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
                effect_show     : 'slidefade',
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
            popup.initializer();
        }
    };

    this.save = function(){
        if( working ) return false;

        ajaxloader.show('Validando Formulario.');

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
                            ajaxloader.show('Enviando Formulario.');
                            f.submit();
                        }else{
                            alert("ERROR: \n"+data);
                        }
                        if( data!="ok" ) ajaxloader.hidden();
                    },
                    error   : function(result){
                        alert("ERROR: \n"+result.responseText);
                    }
                });
            }else ajaxloader.hidden();
            
        });
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
        show : function(msg){
            working=true;

            var html = '<div class="text-center">';
                html+= '<p>'+msg+'</p>';
                html+= '<img src="images/ajax-loader5.gif" alt="" />';
                html+= '</div>';

            popup.load({html : html}, {
                reload  : true,
                bloqEsc : true,
                effectClose : null
            });
        },
        hidden : function(){
            popup.close();
            working=false;
        }
    }

})();
