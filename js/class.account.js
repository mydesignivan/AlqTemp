/* 
 * Clase 
 * 
 */

var Account = new (function(){

    /*
     * PUBLIC METHODS
     */
    this.save = function(){
        ValidatorAccount.validate(function(error){
            if( !error ){
                document.formAccount.submit();
            }else{
                alert('Se han encontrado errores.\nPor favor, revise el formulario.');
            }
        });
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
