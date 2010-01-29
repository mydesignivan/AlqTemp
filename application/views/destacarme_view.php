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
                    <h1>Destacarme</h1>
                </div>

            <?php if( $this->session->userdata('credit')>0 ){?>
                <div class="credit">
                    <div class="credit_attention">El posicionamiento de la propiedad <span class="t2">se realizar&aacute; unicamente para la secci&oacute;n elegida</span> y la <span class="t2">propiedad seleccionada.</span> La duraci&oacute;n de la posici&oacute;n ser&aacute; de <span class="t2">3 meses</span> desde la fecha de contrataci&oacute;n.</div>
                </div>

                <div class="header">
                    <div class="header_left">Im&aacute;gen</div>
                    <div class="header_center">Ubicaci&oacute;n</div>
                    <div class="header_right">Categor&iacute;a</div>
                </div>

                <div id="tblProp" class="container_scroll table_body">
                <?php
                if( $listProp->num_rows>0 ){
                    $n=0;
                    foreach( $listProp->result_array() as $row ){
                        $n++;
                        $class = $n%2 ? 'table_impar' : 'table_par';
                 ?>

                    <div class="<?=$class;?>">
                        <div class="table_left">
                            <input type="checkbox" name="checkbox" value="<?=$row['prop_id'];?>" />
                            <div class="miniatura"><img src="<?=$row['image'];?>" alt="" width="85" /></div>
                        </div>
                        <div class="table_center"><?=$row['address'];?></div>
                        <div class="table_right"><?=$row['category'];?></div>
                    </div>
                <?php }
                }else{?>
                    <center><h3>No hay propiedades cargadas.</h3></center>
                <?php }?>
                </div>
                <div class="table_bottom"></div>

                <?php if( $listProp->num_rows>0 ){?>
                <div class="container_button"><a href="#" class="button2" onclick="Prop.action.disting(1, '#tblProp .table_left'); return false;">Canjear Puntos</a></div>
                <?php }?>

                <br />&nbsp;<br />

                <div class="selection">
                    <h2>Propiedades que ya han sido destacadas</h2>
                    <p>Seleccione las propiedades <br />que desea eliminar del destacado</p>
                </div>

                <div class="header">
                    <div class="header_left">Im&aacute;gen</div>
                    <div class="header_center">Ubicaci&oacute;n</div>
                    <div class="header_right">Categor&iacute;a</div>
                </div>
                <div id="tblProp2" class="container_scroll table_body">
                <?php
                if( $listPropDisting->num_rows>0 ){
                    $n=0;
                    foreach( $listPropDisting->result_array() as $row ){
                        $n++;
                        $class = $n%2 ? 'table_impar' : 'table_par';
                 ?>

                    <div class="<?=$class;?>">
                        <div class="table_left">
                            <input type="checkbox" name="checkbox" value="<?=$row['prop_id'];?>" />
                            <div class="miniatura"><img src="<?=$row['image'];?>" alt="" width="85" /></div>
                        </div>
                        <div class="table_center"><?=$row['address'];?></div>
                        <div class="table_right"><?=$row['category'];?></div>
                    </div>
                <?php } 
                }else{?>
                    <center><h3>No hay propiedades destacadas.</h3></center>
                <?php }?>
                </div>
                <div class="table_bottom"></div>

                <?php if( $listPropDisting->num_rows>0 ){?>
                <div class="container_button"><a href="#" class="button1" onclick="Prop.action.disting(0, '#tblProp2 .table_left'); return false;">Eliminar</a></div>
                <?php }?>

             <?php }else{?>

                <p>No posee creditos para destacar propiedades.</p>

            <?php }?>
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