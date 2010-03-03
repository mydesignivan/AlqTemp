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
            <?php include ('includes/header_paneluser_inc.php');?>
        </div>
             
        <?php include('includes/banner_vertical_inc.php');?>
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top">
                    <h1>Propiedades</h1>
                </div>

                <div class="buttons">
                    <a href="javascript:void(Prop.action.del());" class="button1">Eliminar</a>
                </div>

    <?php if( $listProp->num_rows>0 ){?>
                <div class="tbl-header">
                    <div class="cell-1">&nbsp;</div>
                    <div class="cell-2">Propiedad</div>
                    <div class="cell-3">Usuario</div>
                    <div class="cell-4">Acci&oacute;n</div>
                </div>

                <div id="tblProp" class="tbl-body">
    <?php
        $n=0;
        foreach( $listProp->result_array() as $row ){
            $n++;
            $class = $n%2 ? 'table_impar' : 'table_par';
    ?>

                <div class="<?=$class;?>">
                    <div class="cell-1"><input type="checkbox" name="checkbox" value="<?=$row["prop_id"];?>" /></div>
                    <div class="cell-2"><a href="#" class="link1"><?=$row['address'];?></a></div>
                    <div class="cell-3"><?=$row['username'];?></div>
                    <div class="cell-4"><a href="#" class="link1">Eliminar</a></div>
                </div>
    <?php }

                }else{?>
                    <center><h3>No hay propiedades cargadas.</h3></center>
                <?php }?>
                </div>
                <!--end .table_body -->
                <div class="table_bottom"></div>
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