/*
 * Script: Popup
 * Autor: Ivan Mattoni
 * Empresa: MyDesign
 * Año: 2010
 */

var ClassPopup = function(setting){

    /* PUBLIC PROPERTIES
     *************************************************************************/
    this.isLoad = false;

    /* PUBLIC METHODS
     *************************************************************************/
    this.initializer = function(){        
        _maskBG = $(SETTING.maskBG_selector).css({
            'position' : 'fixed',
            'opacity'  : SETTING.maskBG_opacity,
            'left'     : 0,
            'top'      : 0,
            'width'    : "100%",
            'height'   : "100%"
        });
    };

    this.load = function(_param, _setting){
        var param = {
            ajaxUrl  : '',
            ajaxData : {},
            html     : ''
        };

        if( typeof _setting=="object" ) SETTING = $.extend({}, SETTING, {}, _setting);
        param = $.extend({}, param, {}, _param);

        _divPopup = $(SETTING.selector);
        if( _data.width==0 ) _data.width = _divPopup.css('width');
        if( _data.height==0 ) _data.height = _divPopup.css('height');
        
        if( SETTING.maskBG_selector!=null ) _maskBG.show();

        var content = _divPopup.find(SETTING.selector_content);
        var firstLoad = true;

        if( !$.data(_divPopup[0], 'jquery_popup') ) {
            $.data(_divPopup[0], 'jquery_popup', true);
        }else{
            firstLoad = false;
        }

        if( !SETTING.bloqEsc ){
            $(document.body).bind('keyup', bloq_esc);
        }else $(document.body).unbind('keyup', bloq_esc);
        $(window).bind('resize', _This.center);

        _divPopup.show();

        if( SETTING.reload || firstLoad ) {
            if( param.ajaxUrl!='' ) content.html(SETTING.contentDefault);
            else{
                if( param.html!='' ) content.html(param.html);
                func_comun1(content);
            }
            _This.center();
        }


        if( param.ajaxUrl!='' && (SETTING.reload || firstLoad) ) {
            $.post(param.ajaxUrl, param.ajaxData, function(data){
                content.html(data);
                func_comun1(content);
            });
        }
        _This.isLoad = true;
    };

    this.close = function(_setting){
        if( typeof _setting=="object" ) SETTING = $.extend({}, SETTING, {}, _setting);

        var func = function(){
            $(document.body).unbind('keypress');
            $(window).unbind('resize');
            _maskBG.hide();
            _divPopup.hide();
            _This.isLoad = false;

            if( SETTING.effectOpen=='autoresize' ){                
                _divPopup.css({
                    width   : _data.width,
                    height  : _data.height,
                    opacity : 1
                });
            }
            if( typeof SETTING.onClose=="function" ) SETTING.onClose();
        };

        switch( SETTING.effectClose ){
            default:
                func();
            break;
            case 'fade':
                _divPopup.fadeOut(300, func);
            break;
            case 'autoresize':
                var left = (($(window).width()/2) - (parseInt(_data.width)/2))+"px";
                var top = (($(window).height()/2) - (parseInt(_data.height)/2))+"px";
                
                _divPopup.find(SETTING.selector_content).hide();
                _divPopup.animate({
                    top     : top,
                    left    : left,
                    width   : _data.width,
                    height  : _data.height,
                    opacity : 0
                }, 300, function(){
                    func();
                });
            break;
        }
    };

    this.center = function(){
        _divPopup.css({
            'left' : (($(window).width()/2)-(_divPopup.width()/2))+"px",
            'top'  : (($(window).height()/2)-(_divPopup.height()/2))+"px"
        });
    };

    this.reset = function(){
        $.data($(SETTING.selector)[0], 'jquery_popup', false);
    };


    /* PRIVATE PROPERTIES
     **********************************************************************/
    var SETTING = {
        selector           : '#jquery-popup',
        selector_content   : '.jquery-popup-middle',
        reload             : true,     // Vuelve a mostrar el contenido
        bloqEsc            : false,    // Bloquea el boton escape
        effectClose        : 'fade',   // Efecto fade al cerrar popup (fade)
        effectOpen         : null,     // Efecto fade al cerrar popup (autoresize)
        effectOptions      : {},       // Opciones para los efectos
        maskBG_selector    : null,     // Mascara de fondo
        maskBG_opacity     : '0.5',
        onLoad             : null,
        onClose            : null,
        contentDefault     : ''
    };
    var _This=this;
    var _divPopup = false;
    var _maskBG = false;
    var _data = {
        width : 0,
        height : 0
    };


    /* PRIVATE METHODS
     **********************************************************************/
    var bloq_esc = function(e){
        if( e.keyCode==27 ) _This.close(SETTING);
    };

    var func_comun1 = function(content){
        if( SETTING.effectOpen=='autoresize' ) {
            content.hide();
            openPopup();
        }else {if( typeof SETTING.onLoad=="function" ) SETTING.onLoad();}
    };

    var openPopup = function(){
        switch( SETTING.effectOpen ){
            case 'autoresize':
                var opt ={
                    width  : '250px',
                    height : '250px'
                };
                opt = $.extend({}, opt, {}, SETTING.effectOptions);

                var left = (($(window).width()/2) - parseInt(opt.width)/2)+"px";
                var top = (($(window).height()/2) - parseInt(opt.height)/2)+"px";
                var content = _divPopup.find(SETTING.selector_content);

                _divPopup.animate({
                    top     : top,
                    left    : left,
                    width   : opt.width,
                    height  : opt.height
                }, 500, function(){
                    content.fadeIn('slow');
                    if( typeof SETTING.onLoad=="function" ) SETTING.onLoad();
                });
            break;
        }
    };

    /* CONSTRUCTOR
     **********************************************************************/
    SETTING = $.extend({}, SETTING, {}, setting);
}
