<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head.php');?>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/header_panel.php');?>
        </div><!-- end #header -->
      
        <div id="sidebar1">
            <?php include('includes/banner.php');?>
        </div><!-- end #sidebar1 -->
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top">
                    <h1>Mi Cuenta</h1>
                    <div class="icons">
                        <span>Usuario:</span><?=$this->session->userdata('name');?><a href="<?=site_url('/logout/');?>"><img src="images/icon_exit.png" border="0" alt="Salir" /> Salir</a>
                    </div>
                </div>
                <div class="content_left">
                    <form action="" enctype="application/x-www-form-urlencoded">
                        <p><span class="cell">*Nombre:</span><input type="text" class="input" /></p>
                        <p><span class="cell">*E-Mail:</span><input type="text" class="input" /></p>
                        <p><span class="cell">Teléfono:</span><input type="text" class="input" /></p>
                        <p><span class="cell">*Usuario:</span><input type="text" class="input" /></p>
                        <p><span class="cell">*Contraseña:</span><input type="password" class="input" /></p>
                        <p><span class="cell">*Repetir:</span><input type="text" class="input" /></p>
                    </form>
                    <div class="container_button">
                        <a class="button1" href="#">Guardar</a>
                        <a class="button2" href="#">Eliminar Cuenta</a>
                    </div>
                    <h3>&nbsp;</h3>
                    <h3>(*)Campos Obligatorios</h3>
                </div>

                <div class="content_right">
                    <div class="cuenta_plus"><a href="#"><img src="images/cuenta_plus.png" alt="Obtene tu Cuenta Plus" /></a></div>
                </div>  
            </div>
            <!--end .maintContent -->
        </div><!-- end .container_mainContent -->
      
    	<br class="clearfloat" />
    	
        <div id="footer">
            <?php include ('includes/footer.php');?>
        </div><!-- end #footer -->
    </div>
    <!-- end #container -->
</body>
</html>