/* 
 * Clase Search
 *
 * Llamada por las vistas:
 * activacion_view, propdetalle_view, passwordreset_view, formregistro_view,
 * rememberpass_view, condiciones_view, index_view, contacto_view
 *
 * Su funcion: Busca propiedades.
 *
 */

var Search = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.search = function(){
        var f = $('#formSearch')[0];
        var search = f.txtSearch.value.length==0 ? "empty" : f.txtSearch.value;

        var params = "search/"+ escape(search) +"/";
            params+= "country/"+ escape(f.cboCountry.value) +"/";
            params+= "states/"+ f.cboStates.value +"/";
            params+= "city/"+ f.cboCity.value +"/";
            params+= "category/"+ f.cboCategory.value+"/";
            params+= "page/0";

        f.action = baseURI+"search/index/"+params;
        f.submit();
    };

})();
