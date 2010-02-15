/* 
 * Clase 
 * 
 */

var Account = new (function(){

    /*
     * PUBLIC METHODS
     */
    this.initializer = function(){
        f = $('#formAccount')[0];

        $.validator.setting('#formAccount .validate', {
            effect_show     : 'slide',
            validateOne     : true
        });

        $(f.txtName).validator({
            v_required  : true
        });
        $(f.txtEmail).validator({
            v_required  : true,
            v_email     : true
        });
        $(f.txtUser).validator({
            v_required  : true,
            v_user      : [4,15]
        });
        $(f.txtPass).validator({
            v_required  : true,
            v_password  : [6,15]
        });
        $(f.txtPass2).validator({
            v_required  : true,
            v_compare   : $(f.txtPass)
        });
    };

    this.save = function(){        
        if( working ) return false;

        $.validator.validate('#formAccount .validate', function(error){
            alert(error);
            if( !error ){
                working=true;
                var userid="";

                $('#ajaxloader').show();
                if( f.user_id ) userid = f.user_id.value;

                $.ajax({
                    type : 'post',
                    url  : baseURI+'ajax_account/valid/',
                    data : {
                        username : escape(f.txtUser.value),
                        email    : escape(f.txtEmail.value),
                        captcha  : f.txtCaptcha.value,
                        userid   : userid
                    },
                    success : function(data){
                        if( data=="existsuser" ){
                            show_error(f.txtUser, 'El usuario ingresado ya existe.');

                        }else if( data=="existsmail" ){
                            show_error(f.txtEmail, 'El email ingresado ya existe.');

                        }else if( data=="captcha_error" ){
                            show_error(f.txtCaptcha, 'El c&oacute;digo ingresado es incorrecto.');

                        }else if( data=="ok" ){
                            alert("ok")
                            //f.submit();
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
    var f=false;


    /*
     * PRIVATE METHODS
     */
    var show_error = function(el, msg){
        $.validator.show(el,{
            message : msg
        });
    };

})();
