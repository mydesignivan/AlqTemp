/* 
 * Clase Prop
 *
 * Esta clase es llamada en el listado de propiedades
 * 
 */

var Prop = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.action={
        edit : function(){
            var lstProp = get_list();
            if( lstProp.length==0 ){
                alert("Debe seleccionar una propiedad para modificar.");
                return true;
            }
            if( lstProp.length>1 ){
                alert("Debe seleccionar una sola propiedad.");
                return false;
            }
            location.href = baseURI+'paneluser/propiedades/form/'+lstProp.val();
            return false;
        },

        del : function(){
            var lstProp = get_list();
            if( lstProp.length==0 ){
                alert("Debe seleccionar una propiedad.");
                return false;
            }
            
            var data = get_data(lstProp);

            if( confirm("¿Está seguro de eliminar la(s) propiedad(es) seleccionada(s)?\n\n"+data.names) ){
                location.href = baseURI+'paneluser/propiedades/delete/'+data.id;
            }
            return false;
        },
        del2 : function(){
            var lstProp = $("#tblList input:checked");
            if( lstProp.length==0 ){
                alert("Debe seleccionar una propiedad.");
                return false;
            }

            var data = get_data(lstProp);

            if( confirm("¿Está seguro de eliminar la(s) propiedad(es) seleccionada(s)?\n\n"+data.names) ){
                location.href = baseURI+'paneladmin/propiedades/delete/'+data.id;
            }
            return false;
        }
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/

    /* PRIVATE METHODS
     **************************************************************************/
    var get_data = function(arr){
        var names="", id="";

        arr.each(function(i){
            id+=this.value+"/";
            names+= $(this).parent().parent().find('.table_center').text()+", ";
        });

        id = id.substr(0, id.length-1);
        names = names.substr(0, names.length-2);

        return {
            id   : id,
            names : names
        }
    };

    var get_list = function(){
        return $("#tblProp .table_left input:checked");
    };

})();