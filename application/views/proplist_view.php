<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <script type="text/javascript" src="js/class.prop.js"></script>
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
                    <h1>Propiedades</h1>
                    <!--<div class="icons">
                        <span>Usuario:</span>
                        Propietario<a href="#"><img src="images/icon_exit.png" border="0" alt="salir" /> Salir</a>
                    </div>-->
                </div>

                <?php if( count($listProp)>0 ){?>
                <div class="buttons">
                    <a href="#" class="button1" onclick="Prop.action.edit(); return false;">Modificar</a>
                    <a href="#" class="button1" onclick="Prop.action.del(); return false;">Eliminar</a>
                </div>

                <div class="header">
                    <div class="header_left">Im&aacute;gen</div>
                    <div class="header_center">Ubicaci&oacute;n</div>
                    <div class="header_right">Categor&iacute;a</div>
                </div>
                <div id="tblProp" class="table_body">
                <?php
                    $n=0;
                    foreach( $listProp as $row ){
                        $n++;
                        $class = $n%2 ? 'table_impar' : 'table_par';
                    ?>
                    <div class="<?=$class;?>">
                        <div class="table_left">
                            <input type="checkbox" name="checkbox" id="checkbox" value="<?=$row["prop_id"];?>" />
                            <div class="miniatura"><img src="images/img1.png" alt="" /></div>
                        </div>
                        <div class="table_center"><?=$row["address"];?></div>
                        <div class="table_right"><?=$row["category"];?></div>
                    </div>
                <?php }?>
                </div>
                <!--end .table_body -->
                <div class="table_bottom"></div>
                <?php }else{?>
                    <p>No existen propiedades cargadas.</p>
                <?php }?>


                <br />&nbsp;<br />
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