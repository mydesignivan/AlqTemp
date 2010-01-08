/* 
 * Clase
 * 
 */

var ComboBox = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.states = function(el){
        if( el.value==0 ) return false;
        exec_ajax(el, '#cboStates', 'list_states')
        return false;
    };
    this.city = function(el){
        if( el.value==0 ) return false;
        exec_ajax(el, '#cboCity', 'list_city')
        return false;
    };


    /* PRIVATE METHODS
     **************************************************************************/
    var exec_ajax = function(el, selector, segment){
        el.disabled = true;

        $.getJSON(document.baseURI+'index.php/ajax_search/'+segment+'/'+el.value, function(data){
            var combo = $(selector)[0];

            combo.options.length=1;

            $(data).each(function(){
                combo.options[combo.options.length] = new Option(this.name, this.state_id);
            });
            el.disabled = false;

        });
    };

})();
