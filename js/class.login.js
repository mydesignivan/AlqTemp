/* 
 * Clase encargada del logeo
 * 
 */

var Login = new (function(){

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


})();


var ValidatorLogin = new Class_Validator({
    selectors : '#formLogin .validate',
    messageClass : 'formError_Login'
});

var ValidatorLogin2 = new Class_Validator({
    selectors : '#formLogin .validate',
    messageClass : 'formError_Down',
    messagePos : 'up'
});
