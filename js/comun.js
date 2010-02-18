var popup={
    show : function(html){
        var container = $('#popup-container');
        container.show();
        container.css({
            opacity : 0.5,
            height  : $('#mainContent .content_left').height()+"px"
        });

        var div = $('#popup');

        div.find('.center-popup').html(html);
        div.show();

        div.css({
            left : (container.width()/2) - (div.width()/2)+"px",
            top  : (container.height()/2)-(div.height()/2)+"px"
        });

    },
    hidden : function(){
        $('#popup').hide();
        $('#popup-container').hide();
    }
};
