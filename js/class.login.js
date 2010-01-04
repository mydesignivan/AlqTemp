/* 
 * Clase encargada del logeo
 * 
 */

var Login = new (function(){

    this.login = function(){
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

        document.formLogin.submit();
        return false;
    };


})();
