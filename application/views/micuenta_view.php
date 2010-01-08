<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <script type="text/javascript" src="js/class.account.js"></script>
<?php if( $this->session->flashdata('statusrecord')!='' ) {?>
    <script type="text/javascript">
        $(document).ready(function(){
            <?php if( $this->session->flashdata('statusrecord')=='saveok' ){?>
                $('#contmessage').html('Los datos han sido guardados con &eacute;xito.');
            <?php }?>
            <?php if( $this->session->flashdata('statusrecord')=='userexists' ){?>
                $('#contmessage').html('El nombre de usuario ya existe.');
            <?php }?>

            $('#contmessage').slideToggle('slow');
        });
    </script>
<?php }?>
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
                    <h1>Mi Cuenta</h1>
                    <!--<div class="icons">
                        <span>Usuario:</span><?=$this->session->userdata('name');?><a href="<?=site_url('/login/logout/');?>"><img src="images/icon_exit.png" border="0" alt="Salir" /> Salir</a>
                    </div>-->
                </div>
                <div class="content_left">
                    <div id="contmessage"></div>
                    <form name="formAccount" id="formAccount" action="<?=site_url('/myaccount/edit');?>" method="post" enctype="application/x-www-form-urlencoded">
                        <p><span class="cell">*Nombre:</span><input type="text" class="input validate {v_required:true}" name="txtName" value="<?=$dataUser['name'];?>" /></p>
                        <p><span class="cell">*E-Mail:</span><input type="text" class="input validate {v_required:true, v_email:true}" name="txtEmail" value="<?=$dataUser['email'];?>" /></p>
                        <p><span class="cell">Teléfono:</span><input type="text" class="input" name="txtPhone" value="<?=$dataUser['phone'];?>" /></p>
                        <p><span class="cell">*Usuario:</span><input type="text" class="input validate {v_required:true}" name="txtUser" value="<?=$dataUser['username'];?>" /></p>
                        <p><span class="cell">*Contraseña:</span><input type="password" class="input validate {v_password:[6,10]}" name="txtPass" id="txtPass" /></p>
                        <p><span class="cell">*Repetir:</span><input type="password" class="input validate {v_compare:'txtPass'}" name="txtPass2" /></p>

                        <input type="hidden" name="user_id" value="<?=$dataUser['user_id'];?>" />
                    </form>
                    <div class="container_button">
                        <a class="button1" href="#" onclick="Account.save(); return false;">Guardar</a>
                        <a class="button2" href="#" onclick="Account.delete_account(); return false;">Eliminar Cuenta</a>
                    </div>
                    <br class="clearfloat" />
                    <h3>(*)Campos Obligatorios</h3>
                        
                </div>

                <div class="content_right">
                    <div class="cuenta_plus"><a href="#"><img src="images/cuenta_plus.png" alt="Obtene tu Cuenta Plus" /></a></div>
                </div>  
            </div>
            <!--end .maintContent -->
        </div><!-- end .container_mainContent -->
      
    	<br class="clearfloat" />
    	
        <div id="footer">
            <?php include ('includes/footer_inc.php');?>
        </div><!-- end #footer -->
    </div>
    <!-- end #container -->
</body>
</html>