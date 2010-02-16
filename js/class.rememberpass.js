/* 
 * Clase 
 * 
 */

var RememberPass = new (function(){

    /*
     * PUBLIC METHODS
     */
    this.initializer = function(){
        f = $('#form1')[0];

        $.validator.setting('#form1 .validate', {
            effect_show     : 'slide',
            validateOne     : true,
            addClass        : 'validator'
        });

        $(f.txtEmail).validator({
            v_required  : true,
            v_email     : true,
            container   : '#cont-input-email'
        });
    };

    this.send = function(f){
        $.validator.validate(function(error){
            if( !error ){
                f.submit();
            }
            return false;
        });

        return false;
    };

    /*
     * PRIVATE PROPERTIES
     */
    var f=false;

})();