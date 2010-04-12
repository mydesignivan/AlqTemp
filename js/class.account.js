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
        This.events.change_search($('#cboSearchBy').val(), true);
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

    this.events={
        change_search : function(opt, clear){
            if( !clear ) $('#txtSearch').val('');
            $('#txtSearch').focus();

            if( opt=="date_added" || opt=="last_modified" ) {
                $('#txtSearch').attr('maxlength', 19)
                               .bind('keypress', This.events.dateformat);
            }else{
                $('#txtSearch').unbind('keypress')
                               .removeAttr('maxlength');
            }
        },
        dateformat : function(e){
            if (e.which >= 48 && e.which <= 57 || e.which == 8) {
                var count = this.value.length;
                if( e.which!=8 ){
                    if( count==2 || count==5 ) this.value+="-";
                    if( count==10 ) this.value+=" ";
                    if( count==13 || count==16 ) this.value+=":";
                }else{
                    if( count==4 || count==7 || count==12 || count==15 || count==18) this.value = this.value.substr(0, this.value.length-1);
                }

                return true;
            }else {
                e.preventDefault();
            }
        }
    };

    this.Search = function(){
        if( $('#txtSearch').val()!='' ){
            location.href = baseURI+'paneladmin/usuarios/search/'+$('#cboSearchBy').val()+"/"+$('#txtSearch').val();
        }
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
    var This=this;
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
                effectClose : false
            });
        },
        hidden : function(){
            popup.close();
            working=false;
        }
    }

})();
