<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <!--SCRIPT "VALIDADOR DE FORMULARIOS"-->
    <link type="text/css" href="js/jquery.validator/css/style.css" rel="stylesheet"  />
    <script type="text/javascript" src="js/jquery.validator/js/script.js"></script>
    <!--END SCRIPT-->

    <script type="text/javascript" src="js/class.rememberpass.js"></script>
    <script type="text/javascript" src="js/class.search.min.js"></script>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/header_inc.php');?>
        </div>
        <!-- end #header -->
      
        
        <?php include('includes/banner_inc.php');?>
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top"><h1>Recordar Contrase&ntilde;a</h1></div>

                    <div class="content_rememberpass">
                        <?php if( @$status=="ok" ){?>
                        <form id="form3" action="<?=site_url('/login/account_access/');?>" method="post">
                            <p class="message1">
                                Muy Bien! Su contrase&ntilde;a ha sido cambiada!<br />
                                Por favor asegurese de memorizarla o anotarla en un lugar seguro.
                            </p>

                            <a href="javascript:$('#form3').submit();">Acceder a su cuenta</a>
                            <input type="hidden" name="p1" value="<?=$data['username'];?>" />
                            <input type="hidden" name="p2" value="<?=$data['password'];?>" />
                        </form>

                        <?php }else{?>
                        <form id="form2" action="<?=site_url('/recordarcontrasenia/send_newpass/'.$this->uri->segment(3)."/".$this->uri->segment(4));?>" method="post">
                            <p class="message1">
                                Cambie su Contrase&ntilde;a<br />
                                Por favor, elija una contrase&ntilde;a para usar con su cuenta de AlquileresTemporarios.org
                            </p>
                            <div class="row">
                                <span class="float-left">Nueva Contrase&ntilde;a:</span>
                                <input type="password" name="txtPass" id="txtPass" class="float-right input style_input validate" />
                            </div>
                            <div class="row">
                                <span class="float-left">Verifique Nueva Contrase&ntilde;a:</span>
                                <input type="password" name="txtPass2" class="float-right input style_input validate" />
                            </div>
                            
                            <div class="container_button"><a href="javascript:void(RememberPass.send());" class="button2">Cambiar</a></div>

                            <input type="hidden" name="usr" value="<?=@$username;?>" />
                            <input type="hidden" name="token" value="<?=@$token;?>" />
                        </form>
                        <?php }?>
                        <br />
                    </div>

                    <script type="text/javascript">
                    <!--
                        RememberPass.initializer();
                    -->
                    </script>
            </div>
            <!--end .mainContent-->
            <div class="background_bottom"></div>
        </div>
        <!--end .container_mainContent-->
      
      
        <div id="footer">
            <?php include ('includes/footer_inc.php');?>
        </div><!-- end #footer -->

    </div>
    <!-- end #container -->
</body>
</html>
