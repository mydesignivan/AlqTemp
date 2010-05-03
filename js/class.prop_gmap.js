/* 
 * Clase Prop
 *
 * Su funcion:
 *  - Crear, Modificar o Eliminar propiedades
 *  - Destaca prop o elimina prop destacadas.
 * 
 */

var PGmap = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(){
        if (GBrowserIsCompatible()) {
            map = new GMap2($('#map')[0]);
            var point = new GLatLng(-32.8885012, -68.8569772);

            map.setCenter(point, 13);
            map.addControl(new GLargeMapControl());
            geocoder = new GClientGeocoder();
            
            //Personaliza el Icono
            var IconMarker = new GIcon(G_DEFAULT_ICON);
            IconMarker.image = "images/home.gif";
            IconMarker.imageMap = [0,0, 48,0, 48,48, 0,48];
            IconMarker.iconSize = new GSize(48,48);
            
            //Crea una marca en el mapa
            marker = new GMarker(point, {
                icon      : IconMarker,
                draggable : true
            });
            map.addOverlay(marker);
            
            //Agrega el evento cuando al soltar el icono para mostrar su ubicacion
            GEvent.addListener(marker, 'dragend', dragEnd);

        }
    };

    this.search = function(){
        if( working ) return false;
        
        var inputAddress = $('#txtGAddress');

        if( inputAddress.val().length==0 ){
            show_error("#msgbox-gmap", "Este campo es obligatorio.", "#msgbox-gmap");
            return false;
        }else $.validator.hide('#msgbox-gmap');

        ajaxloader.show();

        geocoder.getLocations(inputAddress.val(), function(response){
            ajaxloader.hidden();
            if( !response || response.Status.code != 200 ) {
                show_error("#msgbox-gmap", "Lo sentimos, no se ha encontrado su direcci&oacute;n.", "#msgbox-gmap");

            } else {
                $.validator.hide('#msgbox-gmap');
                var html = '<ul class="list-gmap"></ul>';

                $(response.Placemark).each(function(){
                    html+='<li><a href="javascript:void(0)" onclick="PGmap.moveToPoint(this,'+ this.Point.coordinates[1]+','+this.Point.coordinates[0]+')">'+ this.address +'</a></li>';
                });

                html+='</ul>';
                html+='<br /><a href="javascript:popup.close()" class="link5">Cerrar</a>';

                popup.load({html : html});
            }
        });
        return false;
    };

    this.moveToPoint = function(t, lat, lng){
         popup.close();
         marker.setPoint(new GLatLng(lat, lng));
         showMessage(t.innerHTML);
    };

    /* PRIVATE PROPERTIES
     **************************************************************************/
    var map;
    var geocoder;
    var marker;
    var working=false;


    /* PRIVATE METHODS
     **************************************************************************/
     var dragEnd = function(point){
        ajaxloader.show();
        geocoder.getLocations(point, function(response){
            ajaxloader.hidden();
            var place = response.Placemark[0];
            showMessage(place.address)
        });
     };

     var showMessage = function(address){
        var txt = "Ahora estas aqu&iacute;<br />"+address;

        marker.openInfoWindowHtml('<div class="gmap-info">'+txt+'</div>');
        $('#txtGAddress').val(address)
        setTimeout(function(){marker.closeInfoWindow()}, 5000);
     };

     var ajaxloader={
         show : function(){
             working=true;
             $('#gmap-ajaxloader').show();
         },
         hidden : function(){
             working=false;
             $('#gmap-ajaxloader').hide();
         }
     };

})();