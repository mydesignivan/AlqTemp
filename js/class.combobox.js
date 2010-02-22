/* 
 * Clase ComboBox
 *
 * Llamada por las vistas: propform_view
 * Su funcion: Mostrar el listado de los Estados/Provincias
 * 
 */

var ComboBox = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.states = function(el, optdef){
        if( el.value==0 ) return false;
        exec_ajax(el, '#cboStates', 'list_states', optdef);
        return false;
    };
    /*this.city = function(el){
        if( el.value==0 ) return false;
        exec_ajax(el, '#cboCity', 'list_city')
        return false;
    };*/


    /* PRIVATE METHODS
     **************************************************************************/
    var exec_ajax = function(el, selector, segment, optdef){
        el.disabled = true;

        $.getJSON(baseURI+'search/'+segment+'/'+el.value, function(data){
            var combo = $(selector)[0];

            combo.options.length = 1;
            if( optdef ) combo.options[0].text = optdef;

            $(data).each(function(){
                combo.options[combo.options.length] = new Option(this.name, this.state_id);
            });
            el.disabled = false;

        });
    };

})();
