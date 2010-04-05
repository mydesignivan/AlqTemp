/* 
 * Name: ImageGallery
 * Autor: Ivan Mattoni
 * Empresa: MyDesign
 * Año: 2010
 */

var ClassImageGallery = function(options){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(json){
        element.thumbs = $(options.selectorThumbs);
        element.preview = $(options.selectorPreview);

        if( element.thumbs.length==0 || element.preview.length==0 ) {
            error = true;
            return false;
        }

        // Crea el div AjaxLoader para el Preview y define el evento
        element.ajaxload = $('<div class="'+options.cssPrefix+"-ajaxload"+'" />');
        if( element.preview.is("a") ) {
            element.preview.bind("click", zoomimage);
            element.preview = element.preview.find("img");
            element.preview.parent().parent().append(element.ajaxload);
        }else if( element.preview.is("img") ){
            element.preview.parent().append(element.ajaxload);
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
            position : 'absolute',
            left     : 0,
            top      : 0,
            display  : 'none',
            border   : '1px solid red'
        });
        element.thumbs.append(element.containerThumbs);

        // Crea el div AjaxLoader para los Thumbs
        var divAjaxload = $('<div class="'+options.cssPrefix+'ajaxload-thumb"><p>Loading...</p></div>');
        var barprogress = $('<div class="barprogress"></div>');
        element.progress = $('<div class="progress"></div>');
        barprogress.append(element.progress);
        divAjaxload.append(barprogress);
        element.thumbs.append(divAjaxload);

        // Crea los div para los Thumb
        var Images = eval(json);
        var html="";
        $(Images).each(function(){
            var href_img_thumb = eval('this.'+options.json_definevar.href_img_thumb);
            var href_img_full = eval('this.'+options.json_definevar.href_img_full);
            var image_name = eval('this.'+options.json_definevar.image_name);

            imagesThumb.push(href_img_thumb);
            html+= '<div class="'+options.cssPrefix+'thumb"><a href="'+href_img_full+'"><img src="" alt="'+image_name+'" /></a></div>\n';
        });
        element.containerThumbs.append(html);
        
    };

    this.previous = function(){
        if( working || error ) return false;

        if( index>0 ){
            index--;
            var left = data.tagLI[index].offsetWidth + parseInt(data.tagLI.eq(index).css("marginLeft")) + parseInt(data.tagLI.eq(index).css("marginRight"));
            resto-=left;

            working=true;
            $.fx.off = false;
            element.thumbs.animate({left:'+='+left}, 500, function(){working=false;});
        }

        return false;
    };

    this.next = function(){
        if( working || error ) return false;

        var posRight = element.thumbs[0].offsetWidth-resto;

        if( posRight > data.containerThumbs[0].offsetWidth ){
            var left = data.tagLI[index].offsetWidth + parseInt(data.tagLI.eq(index).css("marginLeft")) + parseInt(data.tagLI.eq(index).css("marginRight"));
            resto+=left;

            working=true;
            $.fx.off = false;
            element.thumbs.animate({left:'-='+left},500, function(){working=false;});

            index++;
        }

        return false;
    };

    this.load = function(){
        temp = setInterval(function(){
            

        }, 50);
        
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
     var DEFAULTS={
         selectorThumbs		:	'', 	  // [STRING]
         selectorPreview	:	'', 	  // [STRING]
         cssPrefix              :       'IG-',     // [STRING]
         json_definevar         :       {},       // [STRING]
         effect_slide           :       false,    // [BOOLEAN]
         effect_preview         :       'simple'  // [STRING] slide, simple
     };
     var working = false;
     var error = false;
     var element = {};
     var data = {};
     var index = 0;
     var resto = 0;
     var image = new Image();
     var temp = false;
     var imagesThumb = [];


    /* PRIVATE METHODS
     **************************************************************************/
    var showpreview = function(e){
        if( working || error ) return false;
        e.preventDefault();

        var t = this;

        ajaxload.show();

        image.src = this.href;
        clearInterval(temp);
        temp = setInterval(function(){
            if( image.complete ) {
                clearInterval(temp);
                element.preview.attr("src", image.src);


                if( options.effect_slide ){
                    working=true;
                    element.ajaxload.hide();

                    var img = $('<img src="'+image.src+'" alt="" />');
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

                    $.fx.off = false;
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
                            working=false;
                        });
                    });

                }else ajaxload.hidden();
            }
        }, 50);

        return false;
    };

    var zoomimage = function(e){
        if( working || error ) return false;
        e.preventDefault();

        working = true;

        var img = $(this).find("img");
        image.src = img.attr('src');
        
        var scrollTop = $(window).scrollTop();
        var left = ($(window).width()/2) - (image.width/2);
        var top  = (($(window).height()/2) - (image.height/2));
        var viewTop, viewLeft, viewWidth, viewHeight;

        if( options.effect_preview=="slide" ){
            viewTop = data.topPreview-scrollTop;
            viewLeft = data.leftPreview;
            viewWidth = img.width();
            viewHeight = img.height();
        }else{
            viewTop = top;
            viewLeft = left;
            viewWidth = image.width;
            viewHeight = image.height;
        }


        element.divMask = $('<div />');
        element.divMask.css({
            position        : 'fixed',
            left            : 0,
            top             : 0,
            width           : '100%',
            height          : '100%',
            backgroundColor : '#ccc',
            opacity         : '0.5',
            zIndex          : 1000
        });
        element.divMask.bind('click', closebox);

        element.divView = $('<div class="'+options.cssPrefix+'_view"></div>');

        var html = '<div class="'+options.cssPrefix+'_view_top"><div class="'+options.cssPrefix+'_view_no" /><div class="'+options.cssPrefix+'_view_ne"><div class="'+options.cssPrefix+'_closebox" /></div></div>';
            html+= '<div class="'+options.cssPrefix+'_view_content">';
                html+= '<div class="'+options.cssPrefix+'_view_left" />';
                html+= '<img src="'+img.attr("src")+'" alt="" />';
                html+= '<div class="'+options.cssPrefix+'_view_right" />';
            html+= '</div>';
            html+= '<div class="'+options.cssPrefix+'_view_bottom"><div class="'+options.cssPrefix+'_view_so" /><div class="'+options.cssPrefix+'_view_se" /></div>';

        element.divView.append(html);
        element.divView.css({
            position : 'fixed',
            top     : viewTop+"px",
            left    : viewLeft+"px",
            zIndex  : 2000,
            display : 'block'
        });
        $(document.body).append(element.divView, element.divMask);

        var view_top = $('div.'+options.cssPrefix+'_view_top');
        var view_content = $('div.'+options.cssPrefix+'_view_content img');
        var view_bottom = $('div.'+options.cssPrefix+'_view_bottom');
        var view_left = $('div.'+options.cssPrefix+'_view_left');
        var view_right = $('div.'+options.cssPrefix+'_view_right');
        var val_dif = Math.abs(parseInt(view_left.css('left'))) + Math.abs(parseInt(view_right.css('right')));
        
        view_top.css('width', (viewWidth + val_dif)+"px");
        view_content.css({
            width  : (viewWidth + val_dif)+"px",
            height : (viewHeight + val_dif)+"px"
        });
        view_bottom.css('width', (viewWidth + val_dif)+"px");
        view_left.css('height', (viewHeight + val_dif)+"px");
        view_right.css('height', (viewHeight + val_dif)+"px");

        $('div.'+options.cssPrefix+'_closebox').bind('click', closebox);

        if( options.effect_preview=='slide' ){
            $.fx.off = false;
            setTimeout(function(){
                element.divView.animate({
                    left   : left,
                    top    : top
                }, 800, function(){
                    view_content.animate({
                       width : image.width,
                       height : image.height
                    }, 500);
                    $('div.'+options.cssPrefix+'_view_top, div.'+options.cssPrefix+'_view_bottom').animate({
                        width : image.width + val_dif
                    }, 500);
                    $('div.'+options.cssPrefix+'_view_left, div.'+options.cssPrefix+'_view_right').animate({
                        height : image.height + val_dif
                    }, 500, function(){
                        working=false;
                        $('div.'+options.cssPrefix+'_closebox').css({
                           right : '4px',
                           top   : '6px'
                        });
                    });
                });

            }, 1000);
        }else working=false;

        return false;
    };

    var closebox = function(){
        $.fx.off = true;
        element.divMask.remove();
        element.divView.remove();
    };

    var get_width_containerthumb = function(){
         var width=0;
         data.tagLI.each(function(){
             var t = $(this);
             width+=this.offsetWidth + parseInt(t.css("marginLeft")) + parseInt(t.css("marginRight"));
             t.find("a").bind("click", showpreview);
         });

         element.thumbs.css({
             width    : width+"px",
             position : "relative"
         });
    };

    var ajaxload={
        show : function(){
            element.ajaxload.show();
            element.preview.hide();
        },
        hidden : function(){
            element.ajaxload.hide();
            element.preview.show();
        }
    };

    /* CONSTRUCTOR
     **************************************************************************/
    options = $.extend({}, DEFAULTS, {}, options);

}
