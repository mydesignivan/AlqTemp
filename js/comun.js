var panelName = "";
if( location.pathname.indexOf('/paneluser/')!=-1 ) panelName='/paneluser/';
else if( location.pathname.indexOf('/paneladmin/')!=-1 ) panelName='/paneladmin/';


function checkRow(td){
    var checkbox = $(td).parent().find('input:checkbox')[0];
    checkbox.checked = !checkbox.checked;
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

function get_data(arr){
    var names = [], id = [];

    arr.each(function(i){
        id.push(this.value);
        names.push($(this).parent().parent().find('.link-title').text());
    });

    return {
        id    : id,
        names : names
    }
}
