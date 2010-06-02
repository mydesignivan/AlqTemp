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
        if( (f=$('#formAccount')[0]) ){

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

            if( !mode_edit ){
                $(f.txtPass).validator({
                    v_required  : true,
                    v_password  : [8,10]
                });
                $(f.txtPass2).validator({
                    v_required  : true,
                    v_compare   : $(f.txtPass)
                });
            }

            if( f.txtCaptcha ){
                $(f.txtCaptcha).validator({
                    v_required  : true,
                    addClass    : 'validator-captcha'
                });
            }

            formatNumber.init('#formAccount input[name=txtPhone], #formAccount input[name=txtPhoneArea]');

        }else if( (f=$('#formAccount2')[0]) ){

            $.validator.setting('#formAccount2 .validate', {
                effect_show     : 'slidefade',
                validateOne     : true
            });
            $(f.txtUser).validator({
                v_required  : true
            });
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

    this.user_down = function(){
        $.validator.validate('#formAccount2 .validate', function(error){
            if( !error ){
                $.post(baseURI+'paneluser/micuenta/ajax_checkuser', {user:f.txtUser.value}, function(data){
                    if( data=="error" ){
                        show_error(f.txtUser, 'El Usuario ingresado no se corresponde con el de la cuenta.');
                    }else if( data=="ok" ){
                        f.submit();
                    }else{
                        alert("ERROR\n"+data);
                    }
                });
            }
        });
    };

    this.open_popup = {
        editpss : function(){
            Popup.initializer({
                selContainer : '#sm-popup2',
                selContent   : '.sm-popup-middle .sm-popup-b2',
                width        : '320px',
                height       : '280px',
                effectOpen   : 'resize'
            });
            Popup.load_ajax(baseURI+'paneluser/micuenta/ajax_popup_editpass/', '', function(){
                $('button.simplemodal-close').focus();                
                $.validator.setting('#jquery-popup2 .jquery-popup-middle .jquery-popup-b2 .validate', {
                    effect_show     : 'slidefade',
                    validatorOne    : true
                });
                $('#txtPssCurrent, #txtPssNew').validator({
                    v_required  : true,
                    v_password  : [8,10]
                });
                $('#txtPssVeri').validator({
                    v_required  : true,
                    v_compare   : '#txtPssNew'
                });
            });
        }
    };

    this.save_pass = function(){
        ajaxloader2.show();

        $.validator.validate('#sm-popup2 .validate', function(error){
            if( !error ){
                $.post(baseURI+'paneluser/micuenta/ajax_save_pass/', {
                    pss_current: $('#txtPssCurrent').val(),
                    pss_new : $('#txtPssNew').val()
                }, function(data){
                    if( data=="notexists" ){
                        show_error('#txtPssCurrent', 'No se ha podido autentificar la contrase&ntilde;a.');
                    }else if( data=="ok" ){
                        popup.close();
                    }else{
                        alert("ERROR\n"+data);
                    }
                    if( data!="ok" ) ajaxloader2.hidden();
                });
            }else ajaxloader2.hidden();
        });
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
                html+= msg+'<br />';
                html+= '<img src="images/ajax-loader5.gif" alt="" />';
                html+= '</div>';

            Popup.initializer({
                selContainer : '#sm-popup1',
                selContent   : '.sm-popup-middle',
                actionClose  : false
            });
            Popup.load_html(html);
        },
        hidden : function(){
            $.modal.close();
            working=false;
        }
    };

    var ajaxloader2 = {
        show : function(){
            $('#ajaxloader1').show();
            $('#maskEditPss').css('opacity', 0.5);
        },
        hidden : function(){
            $('#ajaxloader1').hide();
            $('#maskEditPss').css('opacity', 1);
        }
    };

})();
