
var PGmap = new (function(){
    /* PUBLIC PROPERTIES
     **************************************************************************/
    this.options={
        coorLat : -32.8885012,
        coorLng : -68.8569772,
        address : '',
        zoom    : 13,
        mapType : 'm' // m=Mapa, k=Satelitar, h=Hibrido
    };

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(param){
        if (GBrowserIsCompatible()) {

            param = $.extend({}, param, {}, options);

            map = new GMap2($('#map')[0]);
            var point = new GLatLng(param.coorLat, param.coorLng);
            //map.enableScrollWheelZoom();
            map.setCenter(point, param.zoom);
            map.addControl(new GMapTypeControl());
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

            //Muestra la direccion
            $('#txtGAddress').val(param.address);
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

         saveProp(lat, lng, t.innerHTML);

         This.Go({coorLat:lat, coorLng:lng});
         showMessage(t.innerHTML);
    };

    this.Go = function(opt){
        var point = new GLatLng(opt.coorLat, opt.coorLng);
         marker.setPoint(point);
         if( opt.address ) $('#txtGAddress').val(opt.address);
         if( opt.zoom ) map.setCenter(point, opt.zoom);
         if( opt.mapType ){
            var type = G_NORMAL_MAP;
            if( opt.mapType=='k' ) type = G_SATELLITE_MAP;
            else if( opt.mapType=='h' ) type = G_HYBRID_MAP;
            map.setMapType(type);
         }
         saveProp(opt.coorLat, opt.coorLng, opt.address);
    };

    /* PRIVATE PROPERTIES
     **************************************************************************/
    var map;
    var geocoder;
    var marker;
    var working=false;
    var This=this;


    /* PRIVATE METHODS
     **************************************************************************/
     var dragEnd = function(point){
        ajaxloader.show();
        geocoder.getLocations(point, function(response){
            ajaxloader.hidden();
            var place = response.Placemark[0];
            saveProp(place.Point.coordinates[1], place.Point.coordinates[0], place.address);
            showMessage(place.address);
        });
     };

     var showMessage = function(address){
        var txt = "Ahora estas aqu&iacute;<br />"+address;

        marker.openInfoWindowHtml('<div class="gmap-info">'+txt+'</div>');
        $('#txtGAddress').val(address);
        setTimeout(function(){marker.closeInfoWindow()}, 5000);
     };

     var saveProp = function(lat, lng, address){
        options.coorLat = lat;
        options.coorLng = lng;
        options.address = address;
        options.zoom = map.getZoom();
        options.mapType = map.getCurrentMapType().getUrlArg();
     };

     var getType = function(){
        var type = G_NORMAL_MAP;
        if( opt.mapType=='k' ) type = G_SATELLITE_MAP;
        else if( opt.mapType=='h' ) type = G_HYBRID_MAP;
        return type;
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