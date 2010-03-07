<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <!--SCRIPT "VALIDADOR DE FORMULARIOS"-->
    <link type="text/css" href="js/jquery.validator/css/style.css" rel="stylesheet"  />
    <script type="text/javascript" src="js/jquery.validator/js/script.js"></script>
    <!--END SCRIPT-->

    <script type="text/javascript" src="js/class.account.js"></script>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/header_paneluser_inc.php');?>
        </div><!-- end #header -->
      
        
        <?php include('includes/banner_vertical_inc.php');?>
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top">
                    <h1>Mi Cuenta</h1>
                </div>
                <div class="content_left">
                    <?php require('includes/popup_inc.php');?>
                    
                    <form id="formAccount" action="<?=site_url('/panel/micuenta/edit');?>" method="post" enctype="application/x-www-form-urlencoded">
                        <p><span class="cell">*Nombre:</span><input type="text" class="input validate" name="txtName" value="<?=$data['name'];?>" /></p>
                        <p><span class="cell">*E-Mail:</span><input type="text" class="input validate" name="txtEmail" value="<?=$data['email'];?>" /></p>
                        <p><span class="cell">Teléfono:</span><input type="text" class="input" name="txtPhone" value="<?=$data['phone'];?>" /></p>
                        <p><span class="cell">*Usuario:</span><input type="text" class="input validate" name="txtUser" value="<?=$data['username'];?>" /></p>
                        <p><span class="cell">*Contraseña:</span><input type="password" class="input validate" name="txtPass" /></p>
                        <p><span class="cell">*Repetir:</span><input type="password" class="input validate" name="txtPass2" /></p>

                        <input type="hidden" name="user_id" value="<?=$data['user_id'];?>" />
                    </form>
                    <div class="container_button2">
                        <a class="button1" href="javascript:void(Account.save());">Guardar</a>
                    </div>
                    <br class="clearfloat" />
                    <h3>(*)Campos Obligatorios</h3>

                    <script type="text/javascript">
                    <!--
                        Account.initializer();
                    -->
                    </script>

                </div>

                <div class="content_right">
                    <div class="cont-saldo">
                        <label class="text1">Saldo Disponible</label><br />
                        <input type="text" class="input2" value="U$S <?=$this->session->userdata('fondo');?>" onkeypress="return false;" size="13" />
                    </div>
                </div>  
            </div>
            <!--end .maintContent -->
            <div class="background_bottom"></div>
        </div><!-- end .container_mainContent -->
      
    	<br class="clearfloat" />
    	
        <div id="footer">
            <?php include ('includes/footer_inc.php');?>
        </div><!-- end #footer -->
    </div>
    <!-- end #container -->
</body>
</html>