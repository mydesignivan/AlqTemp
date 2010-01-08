/* 
 * Clase 
 * 
 */

var Prop = new (function(){

    /*
     * PUBLIC METHODS
     */
    this.save = function(){
        if( !ValidatorProp.validate(function(error){
            if( !error ){
                document.formProp.submit();
            }else{
                alert('Se han encontrado errores.\nPor favor, revise el formulario.');
            }
        }));
    };


})();

var ValidatorProp = new Class_Validator({
    selectors : '#formProp .validate',
    messageClass : 'formError_Account',
    messagePos : 'up',
    validationOne : true
});
