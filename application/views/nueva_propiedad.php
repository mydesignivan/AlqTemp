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
                    <h1>Nueva Propiedad</h1>
                    <!--<div class="icons">
                        <span>Usuario:</span>
                        Propietario<a href="#"><img src="images/icon_exit.png" alt="salir" /> Salir</a>
                    </div>-->
                </div>
                <div class="content_left">
                    <form action="" enctype="application/x-www-form-urlencoded">
                        <p><span class="cell">*Dirección:</span><input type="text" class="input style_input" /></p>
                      	<!--<p>
                        	<span class="cell">*Foto:</span>
                            <input type="file" name="fileField" class="input" />
                            <a href="#" class="add">Adjuntar otro archivo</a>
                        </p>-->

                        <p><span class="cell">*Descripci&oacute;n:</span><textarea class="input style_textarea" cols="20" rows="5"></textarea></p>

                        <p>
                            <span class="cell">*Servicios:</span>
                            <div class="list input">
                                <ul>
                                    <li class="impar"><input type="checkbox" name="checkbox" class="checkbox" /><span>Salon de reuni&oacute;n</span></li>
                                    <li><input type="checkbox" name="checkbox" class="checkbox" /><span>Secador de pelo</span></li>
                                    <li class="impar"><input type="checkbox" name="checkbox" class="checkbox" /><span>Aire acondicionado</span></li>
                                    <li><input type="checkbox" name="checkbox" class="checkbox" /><span>Calefacci&oacute;n</span></li>
                                    <li class="impar"><input type="checkbox" name="checkbox" class="checkbox" /><span>Aire acondicionado</span></li>
                                    <li><input type="checkbox" name="checkbox" class="checkbox" /><span>Calefacci&oacute;n</span></li>
                                    <li class="impar"><input type="checkbox" name="checkbox" class="checkbox" /><span>Aire acondicionado</span></li>
                                </ul>
                            </div>
                      	</p>

                      	<p><span class="cell">*Pais:</span><input type="text" class="input style_input" /></p>
                        <p><span class="cell">*Provincia</span><input type="text" class="input style_input" /></p>
                        <p><span class="cell">*Ciudad:</span><input type="text" class="input style_input" /></p>
                        <p><span class="cell">Tel&eacute;fono:</span><input type="text" class="input style_input" /></p>
                        <p><span class="cell">P&aacute;gina Web:</span><input type="password" class="input style_input" /></p>
                        <p><span class="cell">Precio:</span><input type="password" class="input style_input" /></p>
                    </form>

                    <p><div class="container_button"><a class="button1" href="#">Guardar</a></div></p>

                    <div class="warning"><h3>(*) Campos Obligatorios </h3></div>
                </div>
                <!--end .content_left -->
             </div>
             <!--end .maintContent -->
        </div>
        <!-- end .container_mainContent -->
      
        <br class="clearfloat" />
      
        <div id="footer">
            <?php include ('includes/footer.php');?>
        </div><!-- end #footer -->
    </div>
    <!-- end #container -->
</body>
</html>