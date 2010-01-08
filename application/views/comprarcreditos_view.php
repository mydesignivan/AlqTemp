<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/headerpanel_inc.php');?>
        </div><!-- end #header -->
      
        <div id="sidebar1">
            <?php include('includes/banner_inc.php');?>
        </div><!-- end #sidebar1 -->
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top">
                    <h1>Comprar Cr&eacute;dito</h1>
                    <!--<div class="icons">
                        <span>Usuario:</span>
                        Propietario<a href="#"><img src="images/icon_exit.png" alt="salir" /> Salir</a>
                    </div>-->
                </div>
                <div class="credit">
                    <div class="credit_attention">El Cr&eacute;dito que adquiera a trav&eacute;s de nuestra web no ser&aacute; reembolsable y el mismo solo puede ser utilizado dentro de los servicios ofrecidos por <span class="t2">alquilerestemporarios.org</span></div>
                </div>
                <div class="column_left">
                    <form action="" enctype="application/x-www-form-urlencoded">
                        <span class="cell">Forma de pago</span>
                        <select name="select" class="input style_input">
                          <option>Debito</option>
                          <option>Tarjeta de Credito</option>
                          <option>Efectivo</option>
                        </select>
                    </form>
                </div>
                <div class="column_right">
                    <form action="" enctype="application/x-www-form-urlencoded">
                        <span class="cell">Importe $</span>
                        <select name="select" class="input style_input">
                          <option>20</option>
                          <option>40</option>
                          <option>50</option>
                        </select>
                    </form>
                </div>
                <div class="container_button"><a class="button2" href="#">Realizar Compra</a></div>
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
