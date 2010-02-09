var Contact = new (function(){

    /*
     * PUBLIC METHODS
     */
     this.send = function(){
         ValidatorContact.validate(function(error){
             if( error ){
                alert('Se han encontrado errores.\nPor favor, revise el formulario.');
             }else{
                 $('#formContact').submit();
             }
         });

     };

})();


var ValidatorContact = new Class_Validator({
    selectors : '#formContact .validate',
    messageClass : 'formError_Account',
    messagePos : 'up',
    validationOne : true
});
