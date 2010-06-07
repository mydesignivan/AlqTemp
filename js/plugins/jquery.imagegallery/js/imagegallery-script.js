/* 
 * Name: ImageGallery
 * Autor: Ivan Mattoni
 * Empresa: MyDesign
 * Version: 2.0
 */

var ClassImageGallery = function(options){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(json){
        element.thumbs = $(options.selectorThumbs);
        element.preview = $(options.selectorPreview);

        if( element.thumbs.length==0 || element.preview.length==0 || !json ) {
            error = true;
            return false;
        }
        // Crea el div AjaxLoader para el Preview y define el evento
        element.ajaxload_preview = $('<div class="'+options.cssPrefix+"ajaxload-preview"+'" />');
        if( element.preview.is("a") ) {
            hasFancybox = typeof element.preview.fancybox!="undefined";
            if( hasFancybox ) element.preview.fancybox();
            element.preview = element.preview.find("img");
            element.preview.parent().parent().append(element.ajaxload_preview);
        }else if( element.preview.is("img") ){
            element.preview.parent().append(element.ajaxload_preview);
        }

        // Esto es para definir algunas variables que se van a utilizar para ejecutar el efecto slide
        if( options.effect_slide ){
            data.leftPreview = element.preview.offset().left + parseInt(element.preview.css("paddingLeft"));
            data.topPreview = element.preview.offset().top + parseInt(element.preview.css("paddingTop"));
            data.widthPreview = element.preview.width();
            data.heightPreview = element.preview.height();
        }

        // Crea el contenedor de los thumbs
        element.containerThumbs = $('<div />').css({
            position    : 'absolute',
            left        : 0,
            top         : 0,
            visibility  : 'hidden',
            opacity     : 0
        });
        element.thumbs.append(element.containerThumbs);

        // Crea el div AjaxLoader para los Thumbs
        element.ajaxload_thumb = $('<div class="'+options.cssPrefix+'ajaxload-thumb"><p>Loading...</p><div class="progressbar"><div class="bar"></div></div></div>');
        element.thumbs.append(element.ajaxload_thumb);
        element.progressbar = element.ajaxload_thumb.find('div.progressbar');
        element.bar = element.ajaxload_thumb.find('div.bar');

        // Crea los div para los Thumb
        var Images = eval(json);
        var html="";
        $(Images).each(function(){
            var href_img_thumb = eval('this.'+options.json_definevar.href_img_thumb);
            var href_img_full = eval('this.'+options.json_definevar.href_img_full);

            imagesThumb.push(href_img_thumb);
            html+= '<div class="'+options.cssPrefix+'thumb"><a href="'+href_img_full+'"></a></div>\n';
        });
        element.containerThumbs.append(html);
        element.divThumb = element.containerThumbs.find("div."+options.cssPrefix+'thumb');
        topleft = element.divThumb.eq(0).outerWidth(true);

        return false;
    };

    this.previous = function(){
        if( working || error ) return false;

        if( index>0 ){
            working=true;
            var left=0;
            for( var n=index-options.step; n>=index-options.step && n>=0; n-- ){
                 left+= element.divThumb.eq(n).outerWidth(true);
            }

            resto-=left;

            element.containerThumbs.animate({left : '+='+left}, 500, function(){working=false;});

            index-=options.step;
        }

        return false;
    };

    this.next = function(){
        if( working || error ) return false;

        if( (element.containerThumbs.width()-resto) > element.thumbs.width() ){
            working=true;
            var left=0;
            for( var n=index; n<=index+options.step-1 && n<=imagesThumb.length-1; n++ ){
                 left+= element.divThumb.eq(n).outerWidth(true);
            }

            resto+=left;

            element.containerThumbs.animate({left : '-='+left}, 500, function(){working=false;});

            index+=options.step;
        }

        return false;
    };

    this.load = function(){
        $(imagesThumb).each(function(i){
            var img = new Image();
            var a = element.divThumb.find('a');

            $(img).load(function(){
                imgComplete++;
                progressbar(imgComplete);
                a.eq(this.alt).append(this)
                              .bind('click', showpreview);

                var div = element.divThumb.eq(this.alt);
                div.css('width', this.width)
                   .css('height', this.height);
                conthumbs_width += div.outerWidth(true);

            }).error(function(){
                imgComplete++;
                progressbar(imgComplete);

                a.eq(this.alt).append('<div class="'+options.cssPrefix+'noimage">Imagen no disponible</div>')
                              .attr('href', "javascript:void(0)");
              
                var w = a.eq(this.alt).find('div').width()+"px";
                var h = a.eq(this.alt).find('div').height()+"px";

                var div = element.divThumb.eq(this.alt);
                div.css('width', w)
                   .css('height', h);
                conthumbs_width += div.outerWidth(true);


            }).attr('src', this)
              .attr('alt', i);
        });
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
     var DEFAULTS={
         selectorThumbs		:	'', 	  // [STRING]
         selectorPreview	:	'', 	  // [STRING]
         cssPrefix              :       'IG-',    // [STRING]
         json_definevar         :       {},       // [STRING]
         effect_slide           :       false,    // [BOOLEAN]
         effect_preview         :       'simple', // [STRING] slide, simple
         step                   :       1         // [INTEGER] define los saltos de thumbs
     };
     var working = true;
     var error = false;
     var element = {};
     var data = {};
     var index = 0;
     var resto = 0;
     var imgComplete = 0;
     var imagesThumb = [];
     var conthumbs_width=0;
     var hasFancybox=false;
     var topleft = 0;



    /* PRIVATE METHODS
     **************************************************************************/
    var showpreview = function(e){
        if( working || error ) return false;
        e.preventDefault();

        var t = this;

        ajaxload.show();

        var img = new Image();
        $(img).load(function(){
            var src = this.src;
            element.preview.attr("src", src);

            if( options.effect_slide ){
                working=true;
                element.ajaxload_preview.hide();

                var img = $('<img src="'+src+'" alt="" />');
                img.attr("width", $(t).width());
                img.attr("height", $(t).height());
                img.css({
                    position : 'absolute',
                    left     : $(t).offset().left + "px",
                    top      : $(t).offset().top + 'px',
                    zIndex   : 2000,
                    display  : 'block',
                    opacity  : '0.5'
                });

                $(document.body).append(img);

                img.animate({
                    top  : data.topPreview+"px",
                    left : data.leftPreview+"px"
                }, 800, function(){
                    $(this).css("opacity", "1");
                    $(this).animate({
                        width : data.widthPreview+"px",
                        height : data.heightPreview+"px"
                    }, 600, function(){
                        img.remove();
                        element.preview.show();
                        element.preview.parent().attr('href', src)
                                                .attr('rel', 'group')
                                                .show();
                        if( hasFancybox ) element.preview.parent().fancybox();
                        working=false;
                    });
                });

            }else ajaxload.hidden();

        }).error(function(){
            alert("La imágen ampliada no esta disponible.");
            ajaxload.hidden();
            
        }).attr('src', this.href);

        return false;
    };

    var progressbar = function(n){
        var width = (n*parseInt(element.progressbar.width())) / imagesThumb.length;
        element.bar.css('width', width+"px");
        if( n==imagesThumb.length ){
            setTimeout(success, 400);
        }
    };

    var success = function(){
        element.ajaxload_thumb.hide();
        element.containerThumbs.css('width', conthumbs_width+"px")
                               .css('visibility', 'visible')
                               .animate({opacity:1}, 500);
       working=false;
    };

    var ajaxload={
        show : function(){
            element.preview.hide();
            element.ajaxload_preview.show();
        },
        hidden : function(){
            element.preview.show();
            element.ajaxload_preview.hide();
        }
    };

    /* CONSTRUCTOR
     **************************************************************************/
    options = $.extend({}, DEFAULTS, {}, options);

}
