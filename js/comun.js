var popup={
    show : function(html, form){
        var div = $('#popup');
        div.find('span').html(html);
        div.show();
    },
    hidden : function(){
        $('#popup').hide();
    }
};
