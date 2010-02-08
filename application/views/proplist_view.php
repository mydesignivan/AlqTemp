<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <script type="text/javascript" src="js/class.prop.js"></script>
    <script type="text/javascript" src="js/class.combobox.js"></script>
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
                    <h1>Propiedades</h1>
                </div>

                <div class="buttons">
                    <a href="<?=site_url('/prop/form');?>" class="button1">Nuevo</a>
                <?php if( $listProp->num_rows>0 ){?>
                    <a href="#" class="button1" onclick="Prop.action.edit(); return false;">Modificar</a>
                    <a href="#" class="button1" onclick="Prop.action.del(); return false;">Eliminar</a>
                <?php }?>
                </div>

                <?php if( $listProp->num_rows>0 ){?>
                <div class="header">
                    <div class="header_left">Im&aacute;gen</div>
                    <div class="header_center">Ubicaci&oacute;n</div>
                    <div class="header_right">Categor&iacute;a</div>
                </div>
                <div id="tblProp" class="table_body">
                <?php
                    $n=0;
                    foreach( $listProp->result_array() as $row ){
                        $n++;
                        $class = $n%2 ? 'table_impar' : 'table_par';
                    ?>
                    <div class="<?=$class;?>">
                        <div class="table_left">
                            <input type="checkbox" name="checkbox" value="<?=$row["prop_id"];?>" />
                            <div class="miniatura"><img src="<?=$row['image'];?>" alt="" width="85" /></div>
                        </div>
                        <div class="table_center"><a href="<?=site_url('/masinfo/index/'.$row['prop_id']);?>" class="link1" target="_blank"><?=$row["address"];?></a></div>
                        <div class="table_right"><?=$row["category"];?></div>
                    </div>
                <?php }
                }else{?>
                    <center><h3>No hay propiedades cargadas.</h3></center>
                <?php }?>
                </div>
                <!--end .table_body -->
                <div class="table_bottom"></div>


                <br />&nbsp;<br />
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