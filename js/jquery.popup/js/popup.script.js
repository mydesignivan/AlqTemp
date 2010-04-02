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
        var _container = SETTING.selector_container==null ? $(window) : $(SETTING.selector_container);
        var scrollHeight = Math.max(document.body.scrollHeight, document.body.clientHeight);
        var width = _container.width();
        var height = _container.height() + scrollHeight;

        _maskBG = $(SETTING.maskBG_selector).css({
            'position' : 'absolute',
            'opacity'  : SETTING.maskBG_opacity,
            'left'     : 0,
            'top'      : 0,
            'width'    : width+"px",
            'height'   : height+"px"
        });

       document.title = $('body').outerHeight();
    };

    this.load = function(_param, _setting){
        var param = {
            ajaxUrl  : '',
            html     : ''
        };
        var setting = SETTING;

        if( typeof _setting=="object" ) setting = $.extend({}, SETTING, {}, _setting);

        param = $.extend({}, param, {}, _param);
        _divPopup = $(setting.selector);

        if( setting.maskBG_selector!=null ) _maskBG.show();
        if( typeof setting.onLoad=="function" ) setting.onLoad();

        var content = _divPopup.find(setting.selector_content);
        var firstLoad = true;

        if( !$.data(_divPopup[0], 'jquery_popup') ) {
            $.data(_divPopup[0], 'jquery_popup', true);
        }else{
            firstLoad = false;
        }

        _divPopup.show();

        if( setting.reload || firstLoad ) {
            if( param.ajaxUrl!='' ) content.html(setting.contentDefault);
            else{
                if( param.html!='') content.html(param.html);
            }
            _This.center();
        }

        if( !setting.bloqEsc ){
            $(document.body).keyup(function(e){
                if( e.keyCode==27 ) _This.close(setting);
            });
        }
        $(window).resize(function() {
            _This.center();
        });

        if( param.ajaxUrl!='' && (setting.reload || firstLoad) ) {
            $.get(param.ajaxUrl, '', function(data){
                content.html(data);
            });
        }
        _This.isLoad = true;
    };

    this.close = function(_setting){
        var setting = SETTING;
        if( typeof _setting=="object" ) setting = $.extend({}, SETTING, {}, _setting);

        var func = function(){
            if( typeof setting.onClose=="function" ) setting.onClose();
            $(document.body).unbind('keypress');
            $(window).unbind('resize');
            _maskBG.hide();
            _This.isLoad = false;
        };

        if( setting.efectClose ) _divPopup.fadeOut(300, func);
        else func();
    };

    this.center = function(){
        _divPopup.css({
            'left' : ((_container.width()/2)-(_divPopup.width()/2))+"px",
            'top'  : ((_container.height()/2)-(_divPopup.height()/2))+"px"
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
        selector_container : null,
        reload             : true,     // Vuelve a mostrar el contenido
        bloqEsc            : false,    // Bloquea el boton escape
        efectClose         : true,     // Efecto fade al cerrar popup
        maskBG_selector    : null,     // Mascara de fondo
        maskBG_opacity     : '0.5',
        onLoad             : null,
        onClose            : null,
        defaultContent     : ''
    };
    var _This=this;
    var _divPopup = false;
    var _maskBG = false;
    var _container = false;

    /* CONSTRUCTOR
     **********************************************************************/
    SETTING = $.extend({}, SETTING, {}, setting);
}
