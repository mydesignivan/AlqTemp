/* 
 * Clase creditBuy
 *
 * Llamada por las vistas: comprarcreidtos_view
 * Su funcion: Eniva el pedido de compra
 *
 */

var creditBuy = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(val){
        f = $('#form1')[0];
        credit = val;
        This.show_credit(f.cboImport.value);
    };

    this.save = function(){
        f.submit();
        return false;
    };

    this.show_credit = function(value){
        var res = parseInt(value)*parseInt(credit);
        res = res>1 ? res+" cr&eacute;ditos" : res+" cr&eacute;dito";
        f.credit.value = res;
        $('#spanCredit').html("&nbsp;"+res);
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var credit=0;
    var f=false;
    var This=this;


})();
