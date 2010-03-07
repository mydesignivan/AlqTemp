/* 
 * Clase Login
 *
 * Llamada por las vistas: head_inc
 * Su funcion: Muestra/Oculta el form de login y permite el logeo al panel.
 *
 */

var Login = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(){
        $(document.body).click(function(){
            if( !mouse_over && opendialog ){
                This.close_dialog();
            }
        });
        $('#login-container').hover(function(){mouse_over=true;}, function(){mouse_over=false;});
        
        if( typeof login_message!="undefined" ){
            $('#login-container .container-form').css("background", "url(images/background_login2.png) no-repeat");
            $('#login-error').html(login_message);
            This.open_dialog();
        }

    };
    this.open_dialog = function(){
        $('#login-container .signin').hide();
        $('#login-container .container-form').show();
        $('#formLogin')[0].txtLoginUser.focus();
        opendialog=true;
    };
    this.close_dialog = function(){
        $('#login-container .signin').show();
        $('#login-container .container-form').hide();
        opendialog=false;
    };


    /* PROPERTIES PRIVATE
     **************************************************************************/
    var mouse_over=false;
    var opendialog=false;
    var This=this;

})();
