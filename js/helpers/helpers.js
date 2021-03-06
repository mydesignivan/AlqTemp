jQuery.fn.extend({
    ucFirst : function(){
        return this.each(function(){
            if( this.value ){
                this.value = this.value.substr(0,1).toUpperCase()+this.value.substr(1,this.value.length).toLowerCase();
            }
        });
    },

    ucTitle : function(){
        return this.each(function(){
            if( this.value ){
                if( this.value.length>0 ){
                    var arr = this.value.split(" ");
                    var t = this;
                    this.value="";
                    $(arr).each(function(){
                        t.value+= this.substr(0,1).toUpperCase()+this.substr(1,this.length).toLowerCase()+" ";
                    });
                    t.value = t.value.substr(0, t.value.length-1);
                }
            }
        });
    },

    ucLower : function(){
        return this.each(function(){
            if( this.value ){
                this.value = this.value.toLowerCase();
            }
        });
    },

    ucUpper : function(){
        return this.each(function(){
            if( this.value ){
                this.value = this.value.toUpperCase();
            }
        });
    },
    
    convertDate : function(){
        return this.each(function(){
            if( this.value ){
                this.value = this.value.replace(/^(\d{2})\/(\d{2})\/(\d{4})$/, "$2/$1/$3");
            }
        });
        
    },

    setOpacity : function(opacity){ //Opacity = 1-10
        return this.each(function(){
            var s = this.style;
            var alphaRe = /alpha\([^\)]*\)/gi;
            if( window.ActiveXObject ){ // IE
                s.zoom = 1;
                s.filter = (s.filter || '').replace(alphaRe, '') +
                           (opacity == 1 ? '' : ' alpha(opacity=' + opacity * 100 + ')');
            }else{
                s.opacity = opacity*0.1;
            }
        });
    },

    formatURL : function(){
        return this.each(function(){
            if( this.value ){
                this.value = this.value.toLowerCase();
                if( this.value.substr(0,7)!="http://" ){
                    this.value = "http://"+this.value.toLowerCase();
                }
            }
        });
    },
    
    toArrayValue : function(){
        var arr = new Array();
        this.each(function(){
            var t = $(this);
            if( t.is(':input') ) arr.push(t.val());
            else arr.push(t.text());
        });
        return arr;
    },

    show2 : function(){
        this.each(function(){
            $(this).css({
                visibility : 'visible',
                position   : 'relative'
            });
        });
    },

    hide2 : function(){
        this.each(function(){
            $(this).css({
                visibility : 'hidden',
                position   : 'absolute'
            });
        });
    }
    
});


function getKeyCode(e){
    if (!e) e = window.event;
    if( e.keyCode ) {
        return e.keyCode;  //DOM
    } else if( e.which ) {
        return e.which;    //NS 4 compatible
    } else if( e.charCode ) {
        return e.charCode; //also NS 6+, Mozilla 0.9+
    } else { //total failure, we have no way of obtaining the key code
        return false;
    }
}

function clear_input(e, isPass){
    if (!e) e = window.event;
    if (e.target) var el = e.target;
    else if (e.srcElement) var el = e.srcElement;
    if( el.nodeType == 3 )  // defeat Safari bug
        el = el.parentNode;

    if( el && (el.getAttribute("attrInputClear")==null || el.getAttribute("attrInputClear")=="1") ){
        el.value = "";

        if( isPass && el.getAttribute("type").toLowerCase()!="password" ) {
            if( document.all ){
                var input = document.createElement("input");
                    input.setAttribute("type", "password");
                    if( el.name ) input.name = el.name;
                    if( el.id ) input.id = el.id;
                    if( el.className ) input.className = el.className;
                    input.value = el.value;
                    input.onfocus = el.onfocus;
                    input.onblur = el.onblur;
                    if( el.getAttribute("attrInputClear")!=null ) input.setAttribute("attrInputClear", el.getAttribute("attrInputClear"));

                el.parentNode.replaceChild(input, el);
                setTimeout(function(){input.focus();}, 800);

            }else el.setAttribute("type", "password");
        }
    }
    return false;
}

function set_input(e, text, isPass){
    if (!e) e = window.event;
    if (e.target) var el = e.target;
    else if (e.srcElement) var el = e.srcElement;
    if(	el.nodeType == 3 )  // defeat Safari bug
        el = el.parentNode;

    if( el ){
        if( el.value.length==0 ){
            if( isPass && el.getAttribute("type").toLowerCase()!="text" ) {
                var input = document.createElement("input");
                    input.setAttribute("type", "text");
                    if( el.name ) input.name = el.name;
                    if( el.id ) input.id = el.id;
                    if( el.className ) input.className = el.className;
                    input.value = el.value;
                    input.onfocus = el.onfocus;
                    input.onblur = el.onblur;

                el.parentNode.replaceChild(input, el);
                input.value = text;
                input.setAttribute("attrInputClear", "1");

            }else {
                el.setAttribute("type", "text");
                el.value = text;
                el.setAttribute("attrInputClear", "1");
            }

        }else el.setAttribute("attrInputClear", "0");
    }
    return false;
}

function basename (path, suffix) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Ash Searle (http://hexmen.com/blog/)
    // +   improved by: Lincoln Ramsay
    // +   improved by: djmix
    // *     example 1: basename('/www/site/home.htm', '.htm');
    // *     returns 1: 'home'
    // *     example 2: basename('ecra.php?p=1');
    // *     returns 2: 'ecra.php?p=1'

    var b = path.replace(/^.*[\/\\]/g, '');

    if (typeof(suffix) == 'string' && b.substr(b.length-suffix.length) == suffix) {
        b = b.substr(0, b.length-suffix.length);
    }

    return b;
}

// Elimina un espacio de un Array
Array.prototype.unset_array = function(key){
    return this.splice(this.indexOf(key), 1);
}
