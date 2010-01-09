<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>
</head>

<body>
    <div id="container">
        <div id="header">
        <?php include ('includes/header_inc.php');?>
        </div><!-- end #header -->
      
        <div id="sidebar1">
            <?php include('includes/banner_inc.php');?>
        </div><!-- end #sidebar1 -->
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top"><h1>San Lorenzo</h1></div>
                <div class="content_left">
                    <div class="photos">
                        <div class="photo_top"><img src="images/image_house1.jpg" alt="propiedades" /></div>
                        <div class="photo_bottom">
                            <div class="arrow_left"><a href="#"><img src="images/arrow_photo_previous.png" alt="foto anterior" border="0" onmouseover="this.src='images/arrow_photo_previous_over.png'" onmouseout="this.src='images/arrow_photo_previous.png'" /></a></div>
                            <div class="middle"></div>
                            <div class="arrow_right"><a href="#"><img src="images/arrow_photo_next.png" alt="foto anterior" border="0" onmouseover="this.src='images/arrow_photo_next_over.png'" onmouseout="this.src='images/arrow_photo_next.png'" /></a></div>
                        </div>
                    </div>
                    <!--end.photos-->

                    <div class="text">
                        <h2>Descripci&oacute;n</h2> Hotel Provincial desde una zona pintoresca –muy cercana a variadas ofertas de bares, restaurantes y tiendas-, propone 40 habitaciones totalmente equipadas.
                        <br />
                        TV por cable, Internet en habitaciones, teléfono, calefacción central y aire acondicionado, caja de seguridad y secadores de cabello son algunos de sus servicios. Además para deleitarse con el sol mendocino.
                    </div>
                </div>
                <!--end .content_left-->

                <div class="content_right">
                    <div class="contact">
                        <div class="mail_icon"></div>
                        <form action="" enctype="application/x-www-form-urlencoded">
                            Nombre <br /><input type="text" />
                            <p>E-mail<br /><input type="text" /></p>
                            <p>N&uacute;mero de Contacto<br /><input type="text" /></p>
                            <p>Consulta<br /><input type="text" class="consulta" /></p>
                            <a href="#"><input name="Enviar" type="submit" class="send" value="Enviar" /></a>
                        </form>
                    </div>
                    <div class="address">
                        <p><img src="images/icon_web.png" alt="direccion web" border="0"/>www.alquilerestemporarios.com</p>
                        <p><img src="images/icon_address.png" alt="direccion" border="0"/>Belgrano 1259 - Mendoza</p>
                        <p><img src="images/icon_phone.png" alt="telefono" border="0"/>+54 (261) 4258284</p>
                        <p><a href="#"><img src="images/icon_map.png" alt="ver mapa" border="0"/>Ver mapa</a></p>
                    </div>
                </div>
                <!--end.content_right-->
                <div class="services">
                    <h2>Servicios</h2>
                    <div class="services_details">
                        <ul>
                            <li>Tv por Cable</li>
                            <li>Tv por Cable</li>
                            <li>Tv por Cable</li>
                    	</ul>
                    </div>
                    <div class="services_details">
                        <ul>
                            <li>Tv por Cable</li>
                            <li>Tv por Cable</li>
                            <li>Tv por Cable</li>
                    	</ul>
                    </div>
                    <div class="services_details">
                        <ul>
                            <li>Tv por Cable</li>
                            <li>Tv por Cable</li>
                            <li>Tv por Cable</li>
                    	</ul>
                    </div>
                </div>
                <!--end .services-->
            </div>
            <!--end .maintContent -->
        </div>
        <!-- end .container_mainContent -->
      
    	<br class="clearfloat" />
      
        <div id="footer">
            <?php include ('includes/footer_inc.php');?>
        </div><!-- end #footer -->
    </div>
    <!-- end #container -->
</body>
</html>