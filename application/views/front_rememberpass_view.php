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
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/header_inc.php');?>
        </div>
        <!-- end #header -->
      
        
        <?php include('includes/banner_vertical_inc.php');?>
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top"><h1>Recordar contrase&ntilde;a</h1></div>

                <div class="content_rememberpass">
                    <form id="form1" action="<?=site_url('/recordarcontrasenia/send/');?>" method="post">
                    <?php if( @$status=="ok" ){?>
                        <p class="message1">Muy bien, le hemos enviado las instrucciones a su email. Reviselo!</p>
                        <p class="message1">Usted puede mantener esta pagina abierta mientras chequea su email. Si usted no recibe las instrucciones en el transcurso de un minuto o dos pruebe <a href="javascript:$('#form1').submit();">Reenviar las instrucciones</a></p>
                        <input type="hidden" name="txtField" value="<?=$field;?>" />

                    <?php }else{?>

                        <h2>¿Olvido su Contraseña?</h2>
                        <p class="message1">AlquileresTemporarios.org le enviara las instrucciones para resetear su contrase&ntilde;a a la direcci&oacute;n de correo asociada a su cuenta.</p>
                        <p>Por favor escriba su direcci&oacute;n de <b>email</b> o su <b>usuario</b> a continuaci&oacute;n.</p>

                        <div id="cont-input-email" class="cell1"><input type="text" name="txtField" class="input validate" /></div>&nbsp;
                        <a href="javascript:void(RememberPass.send());" class="button1">Enviar</a>
                    <?php }?>
                    </form>
                    <br />
                </div>

                <script type="text/javascript">
                <!--
                    RememberPass.initializer('<?=@$status;?>');
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
