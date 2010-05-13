/* 
 * Clase Fondo
 *
 */

var Fondo = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.buy = function(){
        if( working ) return false;
        working=true;

        //window.open('https://argentina.dineromail.com/Carrito/cart.asp?NombreItem=Agregar+Fondos&amp;TipoMoneda=2&amp;PrecioItem=5%2E00&amp;NroItem=%2D&amp;image_url=https%3A%2F%2F&amp;DireccionExito=http%3A%2F%2Fwww%2Ealquilerestemporarios%2Eorg%2Fpago%5Fok&amp;DireccionFracaso=http%3A%2F%2Fwww%2Ealquilerestemporarios%2Eorg%2Ferror&amp;DireccionEnvio=0&amp;Mensaje=0&amp;MediosPago=4%2C2%2C7%2C13&amp;Comercio=504643','Carrito','width=600,height=275,toolbar=no,location=no,status=no,menubar=no,resizable=yes,scrollbars=yes,directories=no');
        if( confirm('¿Estás seguro de realizar la compra?') ){
            $.post(baseURI+'paneluser/agregarfondos/ajax_order', 'importe='+$('#cboImport').val(), function(data){
                if( data.substr(0,5)=="token" ){
                    data = data.substr(5, data.length-5);

                    var f = $('#form1')[0];
                    f.PrecioItem.value = $('#cboImport').val()+".00";
                    f.DireccionExito.value = "http://www.alquilerestemporarios.org/checkout_success/"+data;
                    f.DireccionFracaso.value = "http://www.alquilerestemporarios.org/checkout_cancel/"+data;

                    f.submit();
                }else {
                    alert("ERROR:\n"+data);
                    working = false;
                }
            });
        }

        return false;
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var working = false;


})();
