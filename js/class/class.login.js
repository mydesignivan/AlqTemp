/* 
 * Clase Login
 *
 * Su funcion: Muestra/Oculta el form de login y permite el logeo al panel.
 *
 */

var Login = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(login_message){
        $(document.body).click(function(){
            if( !mouse_over && opendialog ){
                This.close_dialog();
            }
        });
        $('#login-container').hover(function(){mouse_over=true;}, function(){mouse_over=false;});
        
        if( login_message!="" ){
            $('#login-container').css("background", "url(images/bg_login2.png) no-repeat");
            $('#login-error').html(login_message);
            This.open_dialog();
        }

    };
    this.open_dialog = function(){
        $('#buttonLogin').hide();
        $('#login-container').show();
        $('#txtLoginUser').focus();

        $(document.body).keyup(function(e){
            if( e.keyCode==27 ) This.close_dialog();
        });

        opendialog=true;
    };
    this.close_dialog = function(){
        $('#login-container').hide();
        $('#buttonLogin').show();
        opendialog=false;
        $(document.body).unbind('keyup');
    };


    /* PROPERTIES PRIVATE
     **************************************************************************/
    var mouse_over=false;
    var opendialog=false;
    var This=this;

})();
