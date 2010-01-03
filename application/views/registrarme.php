<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head.php');?>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/header.php');?>
        </div><!-- end #header -->
      
        <div id="sidebar1">
            <?php include('includes/banner.php');?>
        </div><!-- end #sidebar1 -->
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top"><h1>Registrarrme</h1></div>
                <div class="content_left">
                    <form action="" enctype="application/x-www-form-urlencoded">
                        <p><span class="cell">*Nombre:</span><input type="text" class="input style_input" /></p>
                        <p><span class="cell">*E-Mail:</span><input type="text" class="input style_input" /></p>
                        <p><span class="cell">Teléfono:</span><input type="text" class="input style_input" /></p>
                        <p><span class="cell">*Usuario:</span><input type="text" class="input style_input" /></p>
                        <p><span class="cell">*Contraseña:</span><input type="password" class="input style_input" /></p>
                        <p><span class="cell">*Repetir:</span><input type="password" class="input style_input" /></p>
                        <p><div class="cell_cache"><img src="js/catcha/securimage_show.php?sid=<? echo md5(uniqid(time()));?>" id="image" alt="" width="150" /><a class="otra" href="#" onclick="document.getElementById('image').src = 'js/catcha/securimage_show.php?sid=' + Math.random(); return false">(Otra)</a>&nbsp;</div></p>
                        <p><span class="cell">*Ingresar C&oacute;digo:</span><input type="text" class="input style_input" /></p>
                    </form>
                    <div class="container_button"><a class="button1" href="#">Enviar</a></div>
                    <h3>&nbsp;</h3>
                    <h3>(*)Campos Obligatorios</h3>
                </div>
            </div>
            <!--end .maintContent -->
        </div>
        <!-- end .container_mainContent -->
      
    	<br class="clearfloat" />
      
        <div id="footer">
            <?php include ('includes/footer.php');?>
        </div><!-- end #footer -->
    </div><!-- end #container -->
</body>
</html>
