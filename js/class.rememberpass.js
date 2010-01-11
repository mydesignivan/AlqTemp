/* 
 * Clase 
 * 
 */

var RememberPass = new (function(){

    /*
     * PUBLIC METHODS
     */
    this.send = function(f){
        Validator.validate(function(error){
            if( !error ){
                f.submit();
            }
            return false;
        });

        return false;
    };

})();

var Validator = new Class_Validator({
    selectors : '#form1 .validate',
    messageClass : 'formError_Account',
    messagePos : 'up',
    validationOne : true
});
