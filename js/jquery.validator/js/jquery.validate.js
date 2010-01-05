/*
 * jQuery JavaScript Library v1.3
 * http://jquery.com/
 *
 * Copyright (c) 2009 Ivan Mattoni
 * Empresa MyDesign
 * Dual licensed under the MIT and GPL licenses.
 * http://docs.jquery.com/License
 *
 * Ultima Actualizacion: 22-10-2009
 */
 
var Class_Validator = function(options){

    /*  CONSTRUCTOR
    /**************************************************************************/
    var DEFAULTS={
        selectors		:	'',           // [STRING]
        messageClass		:	'formError',  // [STRING]
        messagePos		:	'right',      // [STRING]  left, top, right, bottom
        messageCustom		:	{},           // [OBJECT]  {id: {option: 'message'}}
        messageEffect		:	'fade',       // [STRING]  null, fade, slide, slideFade
        messageSuccess		:	false,        // [BOOLEAN]
        messageNameVar		:	'_VALIDATE_MESSAGES', // [STRING]
        validationOne		:	false,                // [BOOLEAN]
        validationEvent		:	true,	 	      // [BOOLEAN]
        catchaURL		:	''                    // [STRING]  (Si v_catcha=true debe ingresar el path del catcha)
    };
	
    var DEFAULTS_OPTIONS={
        v_required		:	false,	// [BOOLEAN]
        v_required_radio	:	'',	// [STRING]
        v_string		:	null,	// [BOOLEAN]
        v_password		:	null,	// [ARRAY]   [min, max]
        v_email			:	false,	// [BOOLEAN]
        v_date			:	null,	// [STRING]
        v_compare		:	'',	// [STRING]
        v_select_val		:	0,	// [INTEGER]
        v_catcha		:	false	// [BOOLEAN]
    };

    options = $.extend({}, DEFAULTS, {}, options);
    if( options.selectors=="" ) return;

    $(document).ready(function(){
        if( options.validationEvent ){
            $(options.selectors).each(function(i, val) {
                var type = $(this).attr("type");
                var nodeName = this.nodeName.toLowerCase();
                if( (nodeName=="input"&&(type=="text"||type=="password"||type=="file")) || nodeName=="textarea" || nodeName=="select" )
                        $(this).blur(function(e){ValidationEngine(e);});
                else if( nodeName=="input" && type=="checkbox" ) $(this).click(function(e){ValidationEngine(e)});
                else if( nodeName=="input" && type=="radio" ) $(this).click(function(){removeFormError(val)});
            });
        }
    });
	

    /*  PUBLIC PROPERTIES
    /**************************************************************************/
    this.statusError = false;

    /*  PUBLIC METHODS
    /**************************************************************************/
    this.validate = function(callback){
        if( options.selectors=="" ) return;
        var sel = $(options.selectors);
        var lengthElements = sel.length-1;

        sel.each(function(i, val) {
            ValidationEngine(val);
            if( i==lengthElements ) if( typeof callback=="function" ) callback(This.statusError, elementError);
        });
    };
	
    this.message={
        show: function(sel, arrayMsg){
            $(sel).each(function(){
                show_message_error(this, arrayMsg);
            });
        },
        hidden: function(sel){
            $(sel).each(function(){
                hidden_message(this);
            });
        }
    };


    /*  PRIVATE PROPERTIES
    /**************************************************************************/
    var This = this;
    var idInputBack = '';
    var elementError = false;
	

    /*  PRIVATE METHODS
    /**************************************************************************/
    var ValidationEngine = function(e) {
        var el = !e.target ? e : e.target;

        if( $(el).css("display")=="none" ) return false;
        if( options.validationOne && elementError && elementError!=el ) return false;

        var nodeName = el.nodeName.toLowerCase();
        var str = $(el).attr('class');
        var exec=true;

        if( str.indexOf("{")>-1 && str.indexOf("}")>-1 ){
                var f1 = str.search(/[.*{]/gi);
                var f2 = str.substr(f1).search(/[}.*]/gi);
        }

        //try{
            eval('var OPTION='+str.substr(f1, f2+1));
            OPTION = $.extend({}, DEFAULTS_OPTIONS, {}, OPTION);
        //}catch(e){return false;}

        var arrayMsg = new Array();

        //======= Valid Field "REQUIRED" ========
        if( OPTION.v_required && nodeName!="select" ){
            if( valid_required(el) ) arrayMsg.push(get_message(el, 'required'));
        }
        //======= Valid Field "REQUIRED_SELECT" ========
        if( OPTION.v_required && nodeName=="select" ){
            if( valid_required_select(el, OPTION.v_select_val) ) arrayMsg.push(get_message(el, 'required'));
        }
        //======= Valid Field "REQUIRED_RADIO" ========
        if( OPTION.v_required_radio!="" ){
            if( valid_required_option(el, OPTION.v_required_radio) ) arrayMsg.push(get_message(el, 'required'));
        }
        //======= Valid Field "STRING" ========
        if( OPTION.v_string && OPTION.v_string!=null ){
            if( valid_string(el) ) arrayMsg.push(get_message(el, 'string'));
        }
        //======= Valid Field "NUMERIC" ========
        if( !OPTION.v_string && OPTION.v_string!=null ){
            if( !valid_string(el) ) arrayMsg.push(get_message(el, 'numeric'));
        }
        //======= Valid Field "EMAIL" ========
        if( OPTION.v_email ){
            if( valid_email(el) ) arrayMsg.push(get_message(el, 'email'));
        }
        //======= Valid Field "DATE" ========
        if( OPTION.v_date!="" && OPTION.v_date!=null ){
            if( valid_date(el) ) arrayMsg.push(get_message(el, 'date'));
        }
        //======= Valid Field "PASSWORD" ========
        if( OPTION.v_password && OPTION.v_password.length==2 ){
            var val = OPTION.v_password;
            if( valid_password(el, val[0], val[1]) ) arrayMsg.push(get_message(el, 'password', OPTION.v_password));
        }
        //======= Valid Field "COMPARE" ========
        if( OPTION.v_compare!="" && document.getElementById(OPTION.v_compare) ){
            if( valid_compare(el, document.getElementById(OPTION.v_compare)) ) arrayMsg.push(get_message(el, 'compare'));
        }
        //======= Valid Field "CATCHA" ========
        if( OPTION.v_catcha && options.catchaURL!="" && el.value && el.value.length>0 ){
            valid_catcha(el, arrayMsg);
            exec=false;
        }

        if( exec ) execute_message(el, arrayMsg);
    };
    /****************** FIN FUNCTION [ValidationEngine] ***********************/
	

    //--- FUNCIONES PARA PARA VALIDAR LOS CAMPOS
    var valid_required = function(el){
        return ($(el).attr("type")=="checkbox" && !el.checked) || el.value.length==0;
    };
    var valid_required_select = function(el, value){
        return el.value==value;
    };
    var valid_required_option = function(el, Class){
        if( idInputBack!=Class ){
            var ret=true;
            $("input."+Class).each(function(){
                    if( this.checked ) {ret=false; return false;}
            });
            idInputBack = Class;
            return ret;
        }
    };
    var valid_string = function(el){
        return el.value.length>0 && !isNaN(parseFloat(el.value));
    };
    var valid_numeric = function(el){
        return el.value.length>0 && isNaN(parseFloat(el.value));

    };
    var valid_email = function(el){
        var regExp = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
        return el.value.length>0 && !regExp.test(el.value);
    };
    var valid_date = function(el){
        var value = el.value;
        if( value.length==10 ){
            value = jQuery.trim(value);
            var pattern = "";

            switch( value ){
                case 'dd/mm/yyyy': pattern = "/"; break;
                case 'dd-mm-yyyy': pattern = "-"; break;
                case 'dd.mm.yyyy': pattern = "."; break;
                case 'mm/dd/yyyy': pattern = "/"; break;
                case 'mm-dd-yyyy': pattern = "-"; break;
                case 'mm.dd.yyyy': pattern = "."; break;
            }
            if( pattern=="" ) return false;

            myArray = el.value.split(pattern);
            if( myArray.length!=3 ) return false;

            if( value.substr(0,2)=="dd" ){
                var Day = myArray[0];
                var Month = myArray[1];
                var Year = myArray[2];
            }else{
                var Day = myArray[1];
                var Month = myArray[0];
                var Year = myArray[2];
            }

            if( isNaN(Year) || Year.length<4 || parseFloat(Year)<1900 ) return false;
            if( isNaN(Month) || parseFloat(Month)<1 || parseFloat(Month)>12 ) return false;
            if( isNaN(Day) || parseInt(Day, 10)<1 || parseInt(Day, 10)>31 ) return false;
            if( Month==4 || Month==6 || Month==9 || Month==11 || Month==2 ) {
                if( Month==2 && Day > 28 || Day>30 ) return false;
            }
        }else return false;
        return true;
    };
    var valid_password = function(el, min, max){
        //var RegExPattern = new RegExp("/(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{"+min+","+max+"})$/");
        var RegExPattern = new RegExp(/(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,10})$/);
        return (!el.value.match(RegExPattern)) && (el.value.length>0);
    };
    var valid_compare = function(el1, el2){
        return el1.value!=el2.value && el1.value.length>0;
    };
    var valid_catcha = function(el, arrayMsg){
        $.ajax({
            type: "POST",
            url: options.catchaURL,
            data: "code="+el.value,
            success: function(data, textStatus){
                    if( data=="false" ) arrayMsg.push(get_message(el, 'catcha'));
                    execute_message(el, arrayMsg);
            }
        });
    };
    //---------------- FIN FUNCIONES PARA VALIDAR LOS CAMPOS -------------------
	
    //==== Muestra/Oculta el Mensaje ====
    var execute_message = function(el, arrayMsg){
        if( arrayMsg.length>0 ) {
            elementError = el;
            This.statusError=true;
            show_message_error(el, arrayMsg);
        }else {
            elementError = false;
            This.statusError=false;
            (!options.messageSuccess) ? hidden_message(el) : show_message_success(el);
        }
    };

    //==== Muestra mensaje de Error ====
    var show_message_error = function(el, arrayMsg){
        arrayMsg = arrayMsg.join("<br>");

        removeFormSuccess(el);

        if( !el.objectFormError ){
            var div = el.objectFormError = document.createElement("DIV");
            div.className = options.messageClass;
            $(div).append('<DIV class="formErrorArrow_'+options.messagePos+'"></DIV><DIV class="formErrorContent">'+arrayMsg+'</DIV>');
            $(el.parentNode).append(div);
            show_effect=true;
        }else {
            var div = el.objectFormError;
            div.lastChild.innerHTML = arrayMsg;
            show_effect=false;
        }

        switch(options.messagePos){
            case "top":
                $(div).css("top", "-"+(el.offsetLeft-div.offsetWidth)+"px");
                $(div).css("left", (el.offsetLeft)+"px");
            break;
            case "left":
                $(div).css("top", "0px");
                $(div).css("left", (el.offsetLeft-div.offsetWidth)+"px");
            break;
            case "bottom":
                $(div).css("top", el.offsetHeight+"px");
                $(div).css("left", (el.offsetLeft)+"px");
            break;
            case "right": default:
                $(div).css("top", "0px");
                $(div).css("left", (el.offsetLeft+el.offsetWidth)+"px");
            break;
        }

        if( show_effect ){
            switch(options.messageEffect.toLowerCase()){
                case 'fade':
                    $(div).fadeIn('slow');
                break;
                default:
                    $(div).css("display", "block");
                break;
            }
        }

        idInputBack="";

        return false;
    };
    /******************** FIN FUNCTION [show_message_error] *******************/
	
    //==== Muestra Mensaje de Exito ====
    var show_message_success = function(el){
        if( el.objectFormSuccess ) return;

        removeFormError(el);
        var div = el.objectFormSuccess = document.createElement("div");
        div.className = options.messageClass;
        $(div).append('<DIV class="formSuccess"></DIV>');
        $(div).css("top", "0px");
        $(div).css("left", (el.offsetLeft+el.offsetWidth)+"px");
        $(el.parentNode).append(div);
        $(div).fadeIn('slow');
    };
	
    //==== Oculta Mensaje de Error ====
    var hidden_message = function(el){
        if( !el.objectFormError ) return;
        idInputBack='';
        if( options.messageEffect==null||!options.messageEffect ) removeFormError(el);
        else{
            $(el.objectFormError).fadeOut("slow", function(){removeFormError(el);});
        }
    };
	
    //==== Elimina el div contenedor para Mensaje de Error ====
    var removeFormError = function(el){
        if( el.objectFormError ) {
            el.parentNode.removeChild(el.objectFormError);
            el.objectFormError=false;
        }
    };

    //==== Elimina el div contenedor para Mensaje de Exito ====
    var removeFormSuccess = function(el){
        if( el.objectFormSuccess ) {
            el.parentNode.removeChild(el.objectFormSuccess);
            el.objectFormSuccess=false;
        }
    };
	
    //==== Devuelce el mensaje ====
    var get_message = function(el, option, param){
        try{
            eval("msg = options.messageCustom."+el.id+"."+option);
        }catch(e){
            eval("msg = "+options.messageNameVar+"."+option);
        }
        if( option=="password" ) msg = msg.replace(/%min/gi, param[0]).replace(/%max/gi, param[1]);
        return msg;
    };

}