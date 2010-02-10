/* 
 * Clase encargada del logeo
 * 
 */

var Login = new (function(){

    /*
     * METHODS PUBLIC
     */
    this.validate = function(){
        if( $("#txtLoginUser").val().toLowerCase()=="usuario" ){
            ValidatorLogin2.message.hidden("#txtLoginPass");
            ValidatorLogin2.message.show("#txtLoginUser", ['Ingrese un usuario.']);
            return false;
        }
        if( $("#txtLoginPass").val().toLowerCase()=="contraseña" ){
            ValidatorLogin2.message.hidden("#txtLoginUser");
            ValidatorLogin2.message.show("#txtLoginPass", ['Ingrese una contrase&ntilde;a.']);
            return false;
        }

        return true;
    };

    this.open_dialog = function(){
        $('#login-container .signin').hide();
        $('#login-container .container-form').show();
        $('#formLogin')[0].txtLoginUser.focus();
        opendialog=true;
    };
    this.close_dialog = function(){
        $('#login-container .signin').show();
        $('#login-container .container-form').hide();
        opendialog=false;
    };

    /*
     * PROPERTIES PRIVATE
     */
    var mouse_over=false;
    var opendialog=false;
    var This=this;

    /*
     * CONSTRUCTOR
     */
    $(document).ready(function(){
        $(document.body).click(function(){
            if( !mouse_over && opendialog ){
                This.close_dialog();
            }
        });
        $('#login-container').hover(function(){mouse_over=true;}, function(){mouse_over=false;});
    });

})();


var ValidatorLogin2 = new Class_Validator({
    selectors : '#formLogin .validate',
    messageClass : 'formError_Down',
    messagePos : 'up'
});
