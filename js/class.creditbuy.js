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

    this.buy = function(){

        var url="";
        switch( parseInt(f.cboImport.value) ){
            case 5:
                url = 'https://argentina.dineromail.com/Carrito/cart.asp?NombreItem=Comprar+Creditos&amp;TipoMoneda=1&amp;PrecioItem=20%2E00&amp;NroItem=%2D&amp;image_url=https%3A%2F%2F&amp;DireccionExito=http%3A%2F%2F&amp;DireccionFracaso=http%3A%2F%2F&amp;DireccionEnvio=0&amp;Mensaje=1&amp;MediosPago=4%2C2%2C7%2C13&amp;Comercio=504643';
            break;
            case 10:
                url = 'https://argentina.dineromail.com/Carrito/cart.asp?NombreItem=Comprar+Creditos&amp;TipoMoneda=1&amp;PrecioItem=20%2E00&amp;NroItem=%2D&amp;image_url=https%3A%2F%2F&amp;DireccionExito=http%3A%2F%2F&amp;DireccionFracaso=http%3A%2F%2F&amp;DireccionEnvio=0&amp;Mensaje=1&amp;MediosPago=4%2C2%2C7%2C13&amp;Comercio=504643';
            break;
            case 20:
                url = 'https://argentina.dineromail.com/Carrito/cart.asp?NombreItem=Comprar+Creditos&amp;TipoMoneda=1&amp;PrecioItem=20%2E00&amp;NroItem=%2D&amp;image_url=https%3A%2F%2F&amp;DireccionExito=http%3A%2F%2F&amp;DireccionFracaso=http%3A%2F%2F&amp;DireccionEnvio=0&amp;Mensaje=1&amp;MediosPago=4%2C2%2C7%2C13&amp;Comercio=504643';
            break;
            case 30:
                url = 'https://argentina.dineromail.com/Carrito/cart.asp?NombreItem=Comprar+Creditos&amp;TipoMoneda=1&amp;PrecioItem=20%2E00&amp;NroItem=%2D&amp;image_url=https%3A%2F%2F&amp;DireccionExito=http%3A%2F%2F&amp;DireccionFracaso=http%3A%2F%2F&amp;DireccionEnvio=0&amp;Mensaje=1&amp;MediosPago=4%2C2%2C7%2C13&amp;Comercio=504643';
            break;
            case 50:
                url = 'https://argentina.dineromail.com/Carrito/cart.asp?NombreItem=Comprar+Creditos&amp;TipoMoneda=1&amp;PrecioItem=20%2E00&amp;NroItem=%2D&amp;image_url=https%3A%2F%2F&amp;DireccionExito=http%3A%2F%2F&amp;DireccionFracaso=http%3A%2F%2F&amp;DireccionEnvio=0&amp;Mensaje=1&amp;MediosPago=4%2C2%2C7%2C13&amp;Comercio=504643';
            break;
        }

        window.open(url,'Carrito','width=600,height=275,toolbar=no,location=no,status=no,menubar=no,resizable=yes,scrollbars=yes,directories=no');

        return false;
    };

    this.show_credit = function(value){
        var res = parseInt(value)*parseInt(credit);
        f.credit.value = res;
        $('#totalCredit').val(res);
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var credit=0;
    var f=false;
    var This=this;


})();
