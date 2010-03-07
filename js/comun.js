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

function checkRow(td){
    var checkbox = $(td).parent().find('input:checkbox')[0];
    checkbox.checked = !checkbox.checked;
}

function search_city(city){
    var f = $('#formSearch')[0];
    // Reset form
    for( var n=0; n<=f.elements.length-1; n++ ){
        if( f.elements[n].nodeName.toLowerCase()=="input" ) f.elements[n].value='';
        if( f.elements[n].nodeName.toLowerCase()=="select" ) f.elements[n].selectedIndex=0;
    }

    for( var n=0; n<=f.cboCity.options.length-1; n++ ){
        if( f.cboCity.options[n].value==city ) {
            f.cboCity.selectedIndex=n;
            f.submit();
            break;
        }
    }
}

function show_error(el, msg){
    $.validator.show(el,{
        message : msg
    });
    el.focus();
}
