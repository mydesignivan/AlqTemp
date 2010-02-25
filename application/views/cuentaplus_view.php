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
                    <h1>Cuenta Plus</h1>
                </div>
                <div class="container_center">
       <?php if( $this->session->userdata('fondo')==0 ){?>

                    <p class="message1">Usted no posee saldo para adquirir esta cuenta plus, para realizar esta operaci&oacute;n tiene que agregar fondos a su cuenta.</p>

       <?php }else{
                  if( !$this->session->flashdata('cp_status') ){?>

                    <div class="plus1">
                        <span class="t1">"Canjee fondos</span> y podr&aacute; obtener su <span class="t1">CUENTA PLUS</span>
                        <br />permitiendole acceder a servicios adicionales<span class="t1">"</span>
                    </div>
                    <div class="plus2">
                        <div class="plus2_top">Algunos Beneficios de su CUENTA PLUS</div>
                        <div class="plus2_bottom">
                            <ul>
                                <li>Cargar hasta <span class="t2">10 propiedades.</span></li>
                                <li>Agregar hasta <span class="t2">8 fotos por propiedad.</span></li>
                                <li>Ubicar su propiedad en un <span class="t2">mapa de google.</span></li><br /><span class="t2">y MUCHO M&Aacute;S!!!</span>
                            </ul>
                            <center><img src="images/cuenta_plus.png" alt="Obtene tu CUENTA PLUS por solo U$S 100 ANUALES " /></center>
                        </div>
                    </div>
                    <!--end .plus2 -->

                    <div class="container_button">
                        <br />
                        <a class="button3" href="<?=site_url('/cuentaplus/shipping/');?>">Obtener Cuenta</a>
                    </div>


                <?php }elseif( $this->session->flashdata('cp_status')=="insufficient_amount" ){?>

                    <p class="message1">Usted no posee saldo suficiente para adquirir esta cuenta plus, para realizar esta operaci&oacute;n tiene que agregar fondos a su cuenta.</p>

                <?php }elseif( $this->session->flashdata('cp_status')=="ok" ){?>

                    <p class="message1">Gracias por adquirir una Cuenta Plus</p>

                <?php }
       }?>

                </div>
                <!--end .container_center -->
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