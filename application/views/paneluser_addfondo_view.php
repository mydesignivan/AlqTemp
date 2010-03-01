<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <script type="text/javascript" src="js/class.fondo.js"></script>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/headerpanel_inc.php');?>
        </div><!-- end #header -->
      
        
        <?php include('includes/banner_inc.php');?>
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top">
                    <h1>Agregar Fondos</h1>
                </div>

                <?php if( !isset($result_buy) ){?>
                <div class="credit">
                    <div class="credit_attention">El fondo que adquiera a trav&eacute;s de nuestra web no ser&aacute; reembolsable y el mismo solo puede ser utilizado dentro de los servicios ofrecidos por <b>alquilerestemporarios.org</b></div>
                </div>

                <form id="form1" action="<?=site_url('agregarfondos/send/');?>" method="post">

                    <div class="addfondo-form">
                        <div class="cc-col-left">
                            <label class="text1">Saldo Disponible</label><br />
                            <input type="text" class="input2" value="U$S <?=$this->session->userdata('fondo');?>" onkeypress="return false;" size="13" />
                        </div>
                        <div class="cc-col-right">
                            <label class="text1">Agregar Fondos&nbsp;</label><br />
                            <label class="text1">Importe&nbsp;</label>
                            <select name="cboImport" id="cboImport" class="input style_input2">
                              <option value="5">5</option>
                              <option value="10">10</option>
                              <option value="20">20</option>
                              <option value="30">30</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                        </div>
                    </div>

                    <div class="container_button">
                        <a href="javascript:void(Fondo.buy());"><img src="images/button-buy.jpg" alt="Comprar" /></a>
                        <!--<a href="javascript:void(0)" onclick="window.open('https://argentina.dineromail.com/Carrito/cart.asp?NombreItem=Comprar+Creditos&amp;TipoMoneda=1&amp;PrecioItem=20%2E00&amp;NroItem=%2D&amp;image_url=https%3A%2F%2F&amp;DireccionExito=http%3A%2F%2F&amp;DireccionFracaso=http%3A%2F%2F&amp;DireccionEnvio=0&amp;Mensaje=1&amp;MediosPago=4%2C2%2C7%2C13&amp;Comercio=504643','Carrito','width=600,height=275,toolbar=no,location=no,status=no,menubar=no,resizable=yes,scrollbars=yes,directories=no');"><img src="https://argentina.dineromail.com/imagenes/post-login/boton-pagar-01.gif" border="0"></a>-->
                    </div>

                    <input type="hidden" name="credit" />
                </form>
                    <script type="text/javascript">
                    <!--
                        Fondo.initializer();
                    -->
                    </script>

                <?php }elseif( @$result_buy=="success" ){?>
                    <p class="message1">La compra ha sido realizada con exito.</p>

                <?php }elseif( @$result_buy=="cancel" ){?>
                    <p class="message1">La compra ha sido cancelada.</p>
                    
                <?php }?>
            </div>
            <!--end .maintContent -->
            <div class="background_bottom"></div>
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
