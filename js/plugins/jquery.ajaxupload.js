/* 
 * AjaxUpload
 * Version : 1.0
 * Autor   : Ivan Mattoni
 * Empresa : MyDesign
 */

var ClassAjaxUpload=function(options){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(){
        button = $(options.selector);
        error = button.length==0;
        start();
    };

    this.append_input = function(el){
        if( error || working ) return false;
        if( !el.css ) el = $(el);

        el.css({
            position : 'relative',
            overflow : 'hidden'
        });
        el.append(create_input());

        return false;
    };

    this.submit = function(){
        if( error || working ) return false;
        
         form.empty().append(create_iframe());
         $(options.selector).each(function(){
             form.append($(this).find("input"));
         });

         form.submit();
         return false;
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var DEFAULTS={
        selector            :   '',         // [STRING]
        action              :   '',         // [STRING]
        autoSubmit          :   true,       // [BOOLEAN]
        multifile           :   false,      // [BOOLEAN]
        onSubmit            :   Function(), // [FUNCTION]
        onComplete          :   Function()  // [FUNCTION]
    };
    var button=false;
    var error=false;
    var working=false;
    var form = false;
    var tmpButton = false;

    /* PRIVATE METHODS
    ***************************************************************************/
    var start = function(){
        if( error ) return false;

        form = $('<form action="'+options.action+'" method="post" enctype="multipart/form-data" target="ajaxuploadiframe"></form>');
        $(document.body).append(form);
        
        button.each(function(){
            var b = $(this);
            b.css({
                position : 'relative',
                overflow : 'hidden'
            });
            b.append(create_input());
        });
        
        return false;
    };

    var create_input = function(){
        var i = $('<input type="file" name="'+(options.multifile ? 'userfile[]' : 'userfile')+'" />');

        i.attr('size', '200');
        i.css({
            position : 'absolute',
            margin   : 0,
            padding  : 0,
            left     : 0,
            top      : 0,
            zIndex   : 1000,
            width    : '600px',
            cursor   : 'pointer',
            opacity  : 0,
            cssOpacity : 0
        });

        if( $.browser.opera ) i.css('margin', '5px 0 0 -518px');
        if( $.browser.msie ) i.css('margin', '0 0 0 -518px');

        i.bind('change', function(){
            if( typeof options.onSubmit=="function" ){
                if( options.onSubmit(this, this.value.replace(/^([\W\w]*)\./gi, '').toLowerCase()) ){
                    if( options.autoSubmit ){
                        working=true;
                        tmpButton = $(this).parent();
                        form.empty()
                            .append(create_iframe())
                            .append(this)
                            .submit();                    
                    }
                }
            }
        });
        return i;
    };

    var create_iframe = function(){
        var iframe = $('<iframe name="ajaxuploadiframe" id="ajaxuploadiframe" src="about:blank" width="400" height="100"></iframe>');
        iframe.attr('src', '');
        iframe.bind('load', eventLoadIframe);
        //iframe.bind('load', prueba);
        iframe.hide();
        return iframe;
    };

    var eventLoadIframe = function(e){
        var content = this.contentDocument || this.contentWindow.document;
            content = content.body.innerHTML;

        if( content!="" ){
            var input = false;

            if( options.autoSubmit ) {
                tmpButton.append(create_input());
                input = tmpButton.find('input')[0];
            }else{
                input = new Array();
                var el = $(options.selector);
                el.each(function(){
                    var i = create_input();
                    $(this).append(i);
                    input.push(i[0]);
                });
            }

            if( typeof options.onComplete=="function" ){
                options.onComplete(content, input);
            }
        }

        working=false;
        return false;
    };

    /* CONSTRUCTOR
     **************************************************************************/
    options = $.extend({}, DEFAULTS, {}, options);

}