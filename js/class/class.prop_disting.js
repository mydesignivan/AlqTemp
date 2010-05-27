/* 
 * Clase Prop
 *
 * Esta clase es llamada en la seccion "Destacar"
 *
 */

var Prop = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.disting = function(type){
        if( working ) return false;

        if( confirm('¿Está seguro que desea destacar las propiedades seleccionadas?') ){
            var f = $('#form1')[0];

            f.action = baseURI+'paneluser/destacar/disting/';
            f.data_post.value = JSON.encode({
                id   : _data.id,
                type : type
            });

            working=true;
            $.get(baseURI+'paneluser/destacar/ajax_check_saldo_distingprop', function(data){
                if( data=="error" ){
                    alert("El saldo disponible no es suficiente para destacar una propiedad.");
                    return false;
                }else if( data=="ok" ){
                    f.submit();
                }else{
                    alert("ERROR:\n"+data);
                }
                working=false;
            });
        }
        return false;
    };

    this.action={
        disting : function(){
            if( valid('#tbl-disting') ){
                Popup.initializer({
                    selContainer : '#sm-popup2',
                    selContent   : '.sm-popup-middle .sm-popup-b2',
                    width        : '380px',
                    height       : '250px',
                    effectOpen   : 'fade',
                    effectClose  : 'normal'
                });
                Popup.load_ajax(baseURI+'paneluser/destacar/ajax_popup_typedisting/');
            }
            return false;
        },
        undisting : function(){
            if( working ) return false;
            working=true;
            
            if( valid('#tbl-undisting') ){
                var f = $('#form1')[0];
                if( confirm('¿Está seguro que desea quitar el destacado a las propiedades seleccionadas?') ){
                    f.action = baseURI+'paneluser/destacar/undisting/';
                    f.data_post.value = JSON.encode(_data.id);
                    f.submit();
                }
            }
            return false;
        }
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var working = false;
    var _data={};

    /* PRIVATE METHODS
     **************************************************************************/
     var valid = function(selector){
        var lstProp = $(selector+" input:checked");
        if( lstProp.length==0 ){
            alert("Debe seleccionar al menos un item.");
            _data={};
            return false;
        }
        _data = get_data(lstProp);
        return true;
     };

})();