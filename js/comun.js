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

function show_error(el, msg, container){
    if( typeof container=="undefined" ) container=null;
    $.validator.show(el,{
        message : msg,
        container : container
    });
    try{el.focus();}
    catch(e){}
}