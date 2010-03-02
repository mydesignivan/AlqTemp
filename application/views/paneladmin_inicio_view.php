<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/header_paneladmin_inc.php');?>
        </div><!-- end #header -->
      
        
        <?php include('includes/banner_vertical_inc.php');?>
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top">
                    <h1>Inicio</h1>
                </div>
                <div class="content_left">

                    <fieldset style="width:250px">
                        <legend>Info. Usuarios</legend>

                        <p><b>Cant. registrados en el dia de hoy:</b> <?=$info['user']['count_user_day'];?></p>
                        <p><b>Cant. con Cuenta Plus:</b> <?=$info['user']['count_cuentaplus'];?></p>
                        <p><b>Usuarios logeados:</b> <?=$info['user']['total_users_online'];?></p>
                        <p><b>Usuarios registrados:</b> <?=$info['user']['total_users'];?></p>
                    </fieldset>
                    
                    <fieldset style="width:250px">
                        <legend>Info. Propiedades</legend>

                        <p><b>Cant. prop. nuevas en el dia de hoy:</b> <?=$info['prop']['count_prop_day'];?></p>
                        <p><b>Total de propiedades:</b> 200</p>

                    </fieldset>

                    <script type="text/javascript">
                    <!--
                        //Account.initializer();
                    -->
                    </script>
                </div>

                <div class="content_right">
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