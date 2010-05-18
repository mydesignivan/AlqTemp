/* 
 * Clase Prop
 *
 * Esta clase es llamada en la seccion "Destacar"
 *
 */

var Prop = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.disting = function(){
        $('#sm-popup').modal();
    };


    this.action={
        disting : function(dist, selector){
            if( working ) return false;

            var lstProp = $(selector+" input:checked");
            if( lstProp.length==0 ){
                alert("Debe seleccionar una propiedad.");
                return false;
            }
            var info = get_data(lstProp);
            var url = baseURI+"paneluser/destacar/disting/"+info.id+"/"+dist;

            if( dist==1 ){
                working=true;
                $.get(baseURI+'paneluser/destacar/ajax_check_saldo_distingprop', function(data){
                    if( data=="error" ){
                        alert("El saldo disponible no es suficiente para destacar una propiedad.");
                        return false;
                    }else if( data=="ok" ){
                        location.href = url;
                    }else{
                        alert("ERROR:\n"+data);
                    }
                    working=false;
                });
            }else{
                location.href = url;
            }

            return false;
        }
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var working = false;

    /* PRIVATE METHODS
     **************************************************************************/

})();