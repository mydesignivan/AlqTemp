/* 
 * Clase 
 * 
 */

var Prop = new (function(){

    /*
     * PUBLIC METHODS
     */
    this.save = function(){
        if( working ) return;

        ValidatorProp.validate(function(error){
            if( !error && validServices() ){
                working=true;
                $.get(document.baseURI+'index.php/ajax_prop/existsprop/'+escape(document.formProp.txtAddress.value), function(data){
                    if( data=="propexists" ){
                        $('#contmessage').html('La propiedad ingresada ya existe.');
                        $('#contmessage').slideToggle('slow');
                        working=false;
                    }else{
                        var servsel="";
                        checkServ.each(function(){
                            servsel+=this.value+",";
                        });
                        servsel = servsel.substr(0, servsel.length-1);
                        document.formProp.services.value = servsel;

                        document.formProp.submit();
                    }
                });

            }else{
                alert('Se han encontrado errores.\nPor favor, revise el formulario.');
            }
        });
    };

    var checkServ;
    var working=false;

    var validServices = function(){
        checkServ = $("#lstServices").find("li input:checked");
        if( checkServ.length == 0 ){
            ValidatorProp.message.hidden("#formProp .validate");
            ValidatorProp.message.show("#contServices", ['Seleccione al menos un servicio.']);
            return false;
        }
        return true;
    }

    $(document).ready(function(){
       //document.formProp.cboCountry.selectedIndex=0;
    });


})();

var ValidatorProp = new Class_Validator({
    selectors : '#formProp .validate',
    messageClass : 'formError_Account',
    messagePos : 'up',
    validationOne : true
});
