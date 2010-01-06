/* 
 * Clase encargada de crear eliminar, modificar o eliminar usuarios
 * 
 */

var Account = new (function(){

    /*
     * PUBLIC METHODS
     */
    this.save = function(){
        if( !ValidatorAccount.statusError ){
            document.formAccount.submit();
        }else{
            alert('Por favor, revise el formulario.');
        }
    };

    this.delete_account = function(){

    };

})();

var ValidatorAccount = new Class_Validator({
    selectors : '#formAccount .validate',
    messageClass : 'formError_Account',
    messagePos : 'up',
    validationOne : true
});
