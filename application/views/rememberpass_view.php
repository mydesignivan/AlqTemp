<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>
    <script type="text/javascript" src="js/class.rememberpass.js"></script>
    <script type="text/javascript" src="js/class.search.js"></script>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/header_inc.php');?>
        </div>
        <!-- end #header -->
      
        <div id="sidebar1">
            <?php include('includes/banner_inc.php');?>
        </div>
        <!-- end #sidebar1 -->
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top"><h1>Contrase&ntilde;a Login</h1></div>

                <?php if( !$status ){?>
                    <div class="content_rememberpass">
                        <form id="form1" action="<?=site_url('/rememberpass/send/');?>" method="post" onsubmit="return RememberPass.send(this);">
                            <p>Escriba su direcci&oacute;n de correo</p>
                            <input type="text" name="txtEmail" class="input validate {v_required:true, v_email:true}" />&nbsp;<input type="submit" value="Enviar" />
                        </form>
                        <br />
                    </div>

                <?php }elseif( $status=="emailnotexists" ){?>
                    <p>El email ingresado no existe.</p>

                <?php }elseif( $status=="userinactive" ){?>
                    <p>El usuario no esta activado.</p>

                <?php }elseif( $status=="ok" ){?>
                    <p>En unos instantes recibira un mail con su contrase&ntilde;a.</p>

                <?php }?>

            </div>      
        </div>
        <!--end .container_mainContent-->
      
      
        <div id="footer">
            <?php include ('includes/footer_inc.php');?>
        </div><!-- end #footer -->

    </div>
    <!-- end #container -->
</body>
</html>
