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
                        <span class="cell">Importe $ &emsp;</span>
                        <select name="cboImport" class="input style_input2">
                          <option value="20">20</option>
                          <option value="40">40</option>
                          <option value="50">50</option>
                        </select>
                        <span>&nbsp;2 creditos</span>
                    </div>
                    <div class="container_button"><a class="button2" href="javascript:$('#form1').submit();">Comprar</a></div>
                </form>
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
