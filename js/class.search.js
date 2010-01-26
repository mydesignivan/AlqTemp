/* 
 * Clase encargada del logeo
 * 
 */

var Search = new (function(){

    this.search = function(){
        var f = document.formSearch;
        var search = f.txtSearch.value.length==0 ? "empty" : f.txtSearch.value;

        var params = "search/"+ escape(search) +"/";
            params+= "country/"+ escape(f.cboCountry.value) +"/";
            params+= "states/"+ f.cboStates.value +"/";
            params+= "city/"+ f.cboCity.value +"/";
            params+= "category/"+ f.cboCategory.value+"/";
            params+= "page/0";

        document.formSearch.action = document.baseURI+"index.php/search/index/"+params;
        document.formSearch.submit();
    };


})();
