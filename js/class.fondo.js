/* 
 * Clase Fondo
 *
 * Su funcion: Envia el pedido de compra
 *
 */

var Fondo = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(){
        f = $('#form1')[0];
    };

    this.buy = function(){

        window.open('https://argentina.dineromail.com/Carrito/cart.asp?NombreItem=Agregar+Fondos&amp;TipoMoneda=2&amp;PrecioItem=5%2E00&amp;NroItem=%2D&amp;image_url=https%3A%2F%2F&amp;DireccionExito=http%3A%2F%2Fwww%2Ealquilerestemporarios%2Eorg%2Fpago%5Fok&amp;DireccionFracaso=http%3A%2F%2Fwww%2Ealquilerestemporarios%2Eorg%2Ferror&amp;DireccionEnvio=0&amp;Mensaje=0&amp;MediosPago=4%2C2%2C7%2C13&amp;Comercio=504643','Carrito','width=600,height=275,toolbar=no,location=no,status=no,menubar=no,resizable=yes,scrollbars=yes,directories=no');

        return false;
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var f=false;
    var This=this;


})();
