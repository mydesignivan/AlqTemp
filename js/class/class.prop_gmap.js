
var PGmap = new (function(){
    /* PUBLIC PROPERTIES
     **************************************************************************/
    this.options={
        selector : '#map',
        coorLat  : -32.8885012,
        coorLng  : -68.8569772,
        address  : '',
        zoom     : 13,
        mapType  : 'm', // m=Mapa, k=Satelitar, h=Hibrido
        draggable : true,
        controlMapType : true,
        controlLargeMap : true,
        iconMarker : 'images/home.png',
        iconMap    : [0,0, 60,0, 60,60, 0,60],
        iconSizeX  : 60,
        iconSizeY  : 60
    };

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(_param){
        if (GBrowserIsCompatible()) {

            var param = $.extend({}, This.options, {}, _param);

            map = new GMap2($(param.selector)[0]);
            var point = new GLatLng(param.coorLat, param.coorLng);
            //map.enableScrollWheelZoom();
            map.setCenter(point, param.zoom);
            if( param.controlMapType ) map.addControl(new GMapTypeControl());
            if( param.controlLargeMap ) map.addControl(new GLargeMapControl());
            geocoder = new GClientGeocoder();

            if( param.mapType ){
                var type = G_NORMAL_MAP;
                if( param.mapType=='k' ) type = G_SATELLITE_MAP;
                else if( param.mapType=='h' ) type = G_HYBRID_MAP;
                map.setMapType(type);
            }


            //Personaliza el Icono
            var IconMarker = new GIcon(G_DEFAULT_ICON);
            IconMarker.image = param.iconMarker;
            IconMarker.imageMap = param.iconMap;
            IconMarker.iconSize = new GSize(param.iconSizeX, param.iconSizeY);
            
            //Crea una marca en el mapa
            marker = new GMarker(point, {
                icon      : IconMarker,
                draggable : param.draggable
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
                var html = '<ul class="list-gmap">';

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

         marker.setPoint(new GLatLng(lat, lng));

         showMessage(t.innerHTML);
    };

    this.updateOptions = function(){
        This.options.zoom = map.getZoom();
        This.options.mapType = map.getCurrentMapType().getUrlArg();
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
        This.options.coorLat = lat;
        This.options.coorLng = lng;
        This.options.address = address;
        This.options.zoom = map.getZoom();
        This.options.mapType = map.getCurrentMapType().getUrlArg();
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