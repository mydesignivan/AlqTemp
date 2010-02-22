/* 
 * Clase RememberPass
 *
 * Llamada por las vistas: passwordreset_view, rememberpass_view
 * Su funcion:
 *  - Envia form para pedir el reseteo de contraseña.
 *  - Envia form para resetear la contraseña.
 *
 */

var RememberPass = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(error){
        if( $('#form1').length>0 ){
            f = $('#form1')[0];

            $.validator.setting('#form1 .validate', {
                effect_show     : 'slide',
                activeBlur      : false,
                addClass        : 'validator'
            });

            $(f.txtField).validator({
                v_required   : true,
                container    : '#cont-input-email'
            });

            if( error=="userinactive"||error=="notexists" ){
                var msg="";
                if( error=="userinactive" ) msg = "El usuario se encuentra inactivo.";
                else msg = 'La direccion de correo electr&oacute;nico o el usuario que has puesto no la reconocemos. Por favor int&eacute;ntalo de nuevo o ponte en contacto con el <a href="'+baseURI+'contacto">administrador</a>.';

                $.validator.show(f.txtField, {
                    message : msg
                });
            }
        }else if( $('#form2').length>0 ){
            f = $('#form2')[0];

            $.validator.setting('#form2 .validate', {
                effect_show     : 'slide',
                validateOne     : true
            });
            $(f.txtPass).validator({
                v_required   : true,
                v_password   : [8,10]
            });
            $(f.txtPass2).validator({
                v_required   : true,
                v_compare    : '#txtPass'
            });
        }

    };

    this.send = function(){
        if( working ) return false;
        working=true;

        $.validator.validate('#'+f.id+' .validate', function(error){
            if( !error ){
                f.submit();
            }
            working=false;
        });

        return false;
    };
    
    /* PRIVATE PROPERTIES
     **************************************************************************/
    var f=false;
    var working=false;

})();