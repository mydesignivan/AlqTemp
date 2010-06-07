/* 
 * Esta clase depende del plugin simplemodal
 *
 */

var Popup = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(settings){
         container = $(settings.selContainer);
         container.data('popup-settings', $.extend({}, SETTINGS, {}, settings));
         content = container.find(settings.selContent);
         
         var set = container.data('popup-settings');
         OPTIONS.escClose = set.actionClose;
         OPTIONS.overlayClose = set.actionClose;
    };

    this.load_html = function(){
        content.empty();
        $(arguments).each(function(i, t){
             content.html(t);
        });
        
        container.modal(OPTIONS);
    };

    this.load_ajax = function(url, param, callback){
         if( typeof param=="undefined" ) param='';
         if( typeof callback=="undefined" ) callback = Function();
         callBack = callback;

         content.html('<p align="center"><img src="images/ajax-loader6.gif" alt="Cargando..." width="100" height="100" /></p>');

         $.post(url, param, function(data){
             content.html(data);
             container.modal(OPTIONS);
         });
    };

    this.center = function(){
        $(window).trigger('resize');
    };
    
    /* PRIVATE PROPERTIES
     **************************************************************************/
    var container = false;
    var content = false;
    var sizes = {};
    var callBack = Function();
    var SETTINGS = {
        selContainer : '',        // [required]
        selContent   : '',        // [required]
        width        : null,      // [optional]
        height       : null,      // [optional]
        effectOpen   : 'normal',  // [optional] resize, fade, normal
        effectClose  : 'normal',  // [optional] resize, fade, normal
        actionClose  : true
    };
    var OPTIONS = {
        opacity : 30,
        onOpen  : function(dialog){
            dialog.overlay.show();
            dialog.container.show();
            var settings = container.data('popup-settings');

            if( settings.effectOpen!='resize' ){
                if( settings.width!=null && settings.height!=null ){
                    dialog.data.css({
                        width : settings.width,
                        height : settings.height
                    });
                }
                /*dialog.container.css({
                    width : dialog.data.innerWidth(),
                    height : dialog.data.innerHeight()
                }).show();*/
                dialog.container.css({
                    width : settings.width,
                    height : settings.height
                }).show();
            }

            if( settings.effectClose=='resize' ){
                dialog.data.show().css('visibility', 'hidden');
                sizes.width = container.width();
                sizes.height = container.height();
                sizes.left = parseInt(dialog.container.css('left'));
                sizes.top = parseInt(dialog.container.css('top'));
            }

            switch( settings.effectOpen ){
                default:
                    dialog.data.show().css('visibility', 'inherit');
                    dialog.data.show();
                    callBack();
                break;
                case 'resize':
                    dialog.data.css({
                        visibility : 'hidden',
                        opacity    : 0
                    });

                    var left = parseInt(dialog.container.css('left')) - (((parseInt(settings.width)/2) - (container.width()/2))/2);
                    var top = parseInt(dialog.container.css('top')) - (((parseInt(settings.height)/2) - (container.height()/2))/2);

                    //document.title = left + "  /  " +top;

                    if( settings.width!=null && settings.height!=null ){
                        dialog.data.css('visibility', 'visible').animate({
                            left    : left,
                            top     : top,
                            width   : settings.width,
                            height  : settings.height,
                            opacity : 1
                        }, 500, function(){callBack();});
                    }

                break;
                case 'fade':
                    dialog.data.css('visibility', 'inherit');
                    dialog.data.fadeIn('slow', function(){
                        $(window).trigger('resize');
                        callBack();
                    });
            }
        },
        onClose : function(dialog){
            var settings = container.data('popup-settings');

             switch( settings.effectClose ){
                default:
                    $.modal.close();
                break;

                case 'resize':

                    //alert(sizes.left+" / "+sizes.top+" // "+sizes.width+" / "+sizes.height);

                    dialog.data.animate({
                        left   : sizes.left,
                        top    : sizes.top,
                        width  : sizes.width,
                        height : sizes.height,
                        opacity : 0
                    }, 300, function(){
                        $.modal.close();
                    });

                break;
                case 'fade':
                    dialog.data.fadeOut('slow', function(){
                        dialog.overlay.fadeOut(300, function(){
                            $.modal.close();
                        });
                    });
                break;
             }
        }
    };

    /* PRIVATE METHODS
     **************************************************************************/


})();
