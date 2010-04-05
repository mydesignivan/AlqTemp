function checkRow(td){
    var checkbox = $(td).parent().find('input:checkbox')[0];
    checkbox.checked = !checkbox.checked;
}

function Search(){
    var url = baseURI+"index/searcher/";
    $($('#formSearch').serializeArray()).each(function(){
        var t = $(this);
        if( t.val()!=""&&t.val()!=0 ) url+= t.attr('name')+"/"+t.val()+"/";
    });
    location.href = url+"page/";
}

function show_error(el, msg, container){
    if( typeof container=="undefined" ) container=null;
    $.validator.show(el,{
        message : msg,
        container : container
    });
    try{el.focus();}
    catch(e){}
}