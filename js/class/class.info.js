var Info = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
     this.open_popup = function(){
            Popup.initializer({
                selContainer : '#sm-popup2',
                selContent   : '.sm-popup-middle .sm-popup-b2',
                width        : '550px',
                height       : '280px',
                effectOpen   : 'fade'
            });
            Popup.load_ajax(baseURI+"paneladmin/index/ajax_popup_users", '', function(){
                var el = $('#lstUsers')[0];
                el.options[0].selected=true;
                This.get_info(el);
            });
         
     };

     this.get_info = function(el){
         el.disabled = true;
         $.post(baseURI+"paneladmin/index/ajax_info_user", 'id='+el.value, function(data){
            eval('var info = '+data);

            $('#datName').html(info.name);
            $('#datEmail').html(info.email);
            $('#datPhone').html(info.phone);
            $('#datUsername').html(info.username);
            $('#datMotive').html(info.motive);
            el.disabled = false;
         });
     };

    /* PRIVATE PROPERTIES
     **************************************************************************/
     var This=this;

})();
