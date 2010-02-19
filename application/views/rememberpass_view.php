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
    <script type="text/javascript" src="js/class.search.js"></script>
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
                <div class="content_top"><h1>Recordar contrase&ntilde;a</h1></div>

                <?php if( !$status ){?>
                    <div class="content_rememberpass">
                        <form id="form1" action="<?=site_url('/rememberpass/send/');?>" method="post">
                            <p>Escriba su direcci&oacute;n de correo</p>
                            <div id="cont-input-email" class="cell1"><input type="text" name="txtEmail" class="input validate" /></div>&nbsp;<a href="javascript:void(RememberPass.send(this));" class="button1">Enviar</a>
                        </form>
                        <br />
                    </div>

                    <script type="text/javascript">
                    <!--
                        RememberPass.initializer();
                    -->
                    </script>

                <?php }elseif( $status=="emailnotexists" ){?>
                    <p>El email ingresado no existe.</p>

                <?php }elseif( $status=="userinactive" ){?>
                    <p>El usuario no esta activado.</p>

                <?php }elseif( $status=="ok" ){?>
                    <p>En unos instantes recibira un mail con su contrase&ntilde;a.</p>

                <?php }?>

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
