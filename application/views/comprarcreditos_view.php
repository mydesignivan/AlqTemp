<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <script type="text/javascript" src="js/class.creditbuy.js"></script>
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
                    <h1>Comprar Cr&eacute;dito</h1>
                </div>
                <div class="credit">
                    <div class="credit_attention">El Cr&eacute;dito que adquiera a trav&eacute;s de nuestra web no ser&aacute; reembolsable y el mismo solo puede ser utilizado dentro de los servicios ofrecidos por <b>alquilerestemporarios.org</b></div>
                </div>

                <?php if( !$this->session->flashdata('status') ){?>
                <form id="form1" action="<?=site_url('comprarcredito/send/');?>" method="post">
                    <h3>1 dolar equivale a 3 cr&eacute;ditos.</h3>
                    <div class="column_left">
                        <span class="cell">Forma de pago &emsp;</span>
                        <select name="cboFormaPago" class="input style_input">
                          <option value="Pago Facil">Pago Facil (ARG)</option>
                          <option value="Rapipago">Rapipago (ARG)</option>
                          <option value="Tarjeta de Credito">Tarjeta de Credito</option>
                          <option value="Transferencia bancaria">Transferencia bancaria</option>
                        </select>
                    </div>
                    <div class="column_right">
                        <span class="cell">Importe U$S &emsp;</span>
                        <select name="cboImport" class="input style_input2" onchange="creditBuy.show_credit(this.value)">
                          <option value="5">5</option>
                          <option value="10">10</option>
                          <option value="20">20</option>
                          <option value="30">30</option>
                          <option value="50">50</option>
                        </select>
                        <span id="spanCredit"></span>
                    </div>
                    <div class="container_button">
                        <a class="button2" href="javascript:void(creditBuy.send());">Comprar</a>
                        <a href="javascript:void(0)" onclick="window.open('https://argentina.dineromail.com/Carrito/cart.asp?NombreItem=Comprar+Creditos&amp;TipoMoneda=1&amp;PrecioItem=20%2E00&amp;NroItem=%2D&amp;image_url=https%3A%2F%2F&amp;DireccionExito=http%3A%2F%2F&amp;DireccionFracaso=http%3A%2F%2F&amp;DireccionEnvio=0&amp;Mensaje=1&amp;MediosPago=4%2C2%2C7%2C13&amp;Comercio=504643','Carrito','width=600,height=275,toolbar=no,location=no,status=no,menubar=no,resizable=yes,scrollbars=yes,directories=no');"><img src="https://argentina.dineromail.com/imagenes/post-login/boton-pagar-01.gif" border="0"></a>
                    </div>
                    <input type="hidden" name="credit" />
                </form>
                    <script type="text/javascript">
                    <!--
                        creditBuy.initializer(<?=CREDIT_VALUE;?>);
                    -->
                    </script>

                <?php }elseif( $this->session->flashdata('status')=="ok" ){?>
                    <p>La compra ha sido realizada con exito.</p>
                    
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
