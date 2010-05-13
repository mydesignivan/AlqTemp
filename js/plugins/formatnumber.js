var formatNumber = new function(){

    /* CONSTRUCTOR
     **************************************************************************/
    this.init = function(sel, options){
        OPTIONS = $.extend({}, OPTIONS, options);

        $(sel).each(function(){
            var t = $(this);
            t.bind('keyup', on_keydown);
            t.bind('keypress', on_keypress);
            if( OPTIONS.monedaSymbol ) t.bind('focus', on_focus);
            if( OPTIONS.autoFormat ) t.bind('blur', on_blur);

            t.data('fn-numdec', 1);
            t.data('fn-numint', 0);
        });
    };

    /* PRIVATE PROPERTIES
     **************************************************************************/
    var OPTIONS={
        decimalSymbol    : '.',
        symbolSeparation : ',',
        monedaSymbol     : null,
        decimalDigit     : null,
        integerDigit     : null,
        negativeNumber   : false,
        integerNumber    : true,
        autoFormat       : false
    };

    /* PRIVATE METHODS
     **************************************************************************/
    var on_keydown = function(e){
        var t = $(this);
        if( e.which != 8 && e.which != 0 && !(e.which>=44 && e.which<=46) && (OPTIONS.integerDigit!=null || OPTIONS.decimalDigit!=null) ){
            var part = get_intdec(this.value);
            var numInt = part.numInt;
            var numDec = part.numDec;

            t.data('fn-numdec', numDec.toString().length);
            t.data('fn-numint', numInt.toString().length);
        }
    }



    var on_keypress = function(e){
        var condition = false;
        var t = $(this);

        //document.title = e.which;

        condition = "e.which >= 48 && e.which <= 57 || e.which == 8 || e.which == 0";
        if( !OPTIONS.integerNumber ) condition+= " || e.which == 46 || e.which == 44";
        if( OPTIONS.negativeNumber ) condition+= " || e.which == 45";
        condition = eval(condition);

        if( condition ){
            if( e.which != 8 && e.which != 0 && !(e.which>=44 && e.which<=46) && (OPTIONS.integerDigit!=null || OPTIONS.decimalDigit!=null) ){
                var part = get_intdec(this.value);
                var numInt = part.numInt;
                var numDec = part.numDec;



                /*if( t.data('fn-numint')!=numInt.toString().length ) document.title = 'entero';
                else if( t.data('fn-numdec')!=numDec.toString().length ) document.title = 'decimal';*/

                //document.title = "   /   "+numInt.toString().length + " / " + numDec.toString().length;
                //document.title = "   /   "+numInt + " / " + numDec;
                
                document.title = t.data('fn-numint') + " / " + t.data('fn-numdec');

                /*if( OPTIONS.decimalDigit!=null && numDec!='' ) {
                    if( numDec.length >= OPTIONS.decimalDigit ){
                        e.preventDefault()
                    }
                }
                if( OPTIONS.integerDigit!=null && numInt!='' ) {
                    if( numInt.length >= OPTIONS.integerDigit ){
                        e.preventDefault()
                    }
                }*/
                        //return false;

            }

            return true;

        } else e.preventDefault();

        return false;
    };

    var on_blur = function(){
        var numInt='', numDec='';
        var n = 0;
        var result = [];
        var c='';
        var i=0;

        if( !OPTIONS.integerNumber ) {
            var part = get_intdec(this.value);
            numInt = part.numInt;
            numDec = part.numDec;
        }

        for( i=numInt.length-1; i>=0; i-- ){
            c = numInt.charAt(i).toString();
            n++;

            result.push(c);
            if( n==3 && i!=0 ) {
                result.push(",");
                n=0;
            }
        }

        this.value = result.reverse().join('');

        if( !OPTIONS.integerNumber ) {
            if( OPTIONS.decimalDigit!=null ) {
                this.value+=OPTIONS.decimalSymbol;
                if( numDec==0 ) for( i=1; i<=OPTIONS.decimalDigit; i++ ) this.value += '0';
                else this.value+=numDec;
            }
        }

        if( OPTIONS.monedaSymbol!=null ) this.value = OPTIONS.monedaSymbol+' '+this.value;
    };

    var on_focus = function(){
        this.value = this.value.replace(OPTIONS.monedaSymbol+' ', '');
    };

    var get_intdec = function(str){
        var v = eval("str.toString().replace(/\\"+ OPTIONS.symbolSeparation +"/gi, '').replace(/\\-/gi, '')");
        var f = v.lastIndexOf(OPTIONS.decimalSymbol);
        var numInt = v;
        var numDec = 0;
        if( f!=-1 ){
            numInt = v.substr(0, f);
            numInt = eval("numInt.replace(/\\"+ OPTIONS.decimalSymbol +"/gi, '')");
            numDec = v.substr(f+1, v.length);
        }
        return {
            numInt : numInt,
            numDec : numDec
        };
    };


};