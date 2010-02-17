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
<?php if( $this->session->flashdata('statusrecord')=='saveok' ) {?>
    <script type="text/javascript">
    <!--
        $(document).ready(function(){
            $('#contmessage').html('Los datos han sido guardados con &eacute;xito.');
            $('#contmessage').slideToggle('slow');
        });
    -->
    </script>
<?php }?>
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
                    <h1>Mi Cuenta</h1>
                </div>
                <div class="content_left">
                    <div id="contmessage"></div>
                    <form id="formAccount" action="<?=site_url('/myaccount/edit');?>" method="post" enctype="application/x-www-form-urlencoded">
                        <p><span class="cell">*Nombre:</span><input type="text" class="input validate" name="txtName" value="<?=$dataUser['name'];?>" /></p>
                        <p><span class="cell">*E-Mail:</span><input type="text" class="input validate" name="txtEmail" value="<?=$dataUser['email'];?>" /></p>
                        <p><span class="cell">Teléfono:</span><input type="text" class="input" name="txtPhone" value="<?=$dataUser['phone'];?>" /></p>
                        <p><span class="cell">*Usuario:</span><input type="text" class="input validate" name="txtUser" value="<?=$dataUser['username'];?>" /></p>
                        <p><span class="cell">*Contraseña:</span><input type="password" class="input validate" name="txtPass" /></p>
                        <p><span class="cell">*Repetir:</span><input type="password" class="input validate" name="txtPass2" /></p>

                        <input type="hidden" name="user_id" value="<?=$dataUser['user_id'];?>" />
                    </form>
                    <div class="container_button2">
                        <a class="button1" href="javascript:void(Account.save());">Guardar</a>
                        <a class="button1" href="javascript:void(Account.delete_account(<?=$dataUser['user_id'];?>));">Eliminar</a>
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
                    <!--<div class="cuenta_plus"><a href="#"><img src="images/cuenta_plus.png" alt="Obtene tu Cuenta Plus" /></a></div>-->
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