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
                    <?php if( $listProp->num_rows>0 ){?>
                        <a href="javascript:void(Prop.action.del2());" class="button1">Eliminar</a>
                    <?php }?>
                </div>

                <table id="tblList" class="table" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <td class="border-rb cell-1">&nbsp;</td>
                            <td class="border-rb cell-4">Propiedad</td>
                            <td class="border-rb cell-5">Usuario</td>
                            <td class="border-rb cell-6">Fecha Creaci&oacute;n</td>
                            <td class="border-rb cell-6">Fecha Modificaci&oacute;n</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( $listProp->num_rows>0 ){$n=0;?>

                        <?php foreach( $listProp->result_array() as $row ){$n++;
                            $class = $n%2 ? "table-row" : "table-row-odd";
                         ?>
                            <tr class="<?=$class;?>">
                                <td class="border-r cell-1"><input type="checkbox" value="<?=$row['prop_id'];?>" /></td>
                                <td class="border-r cell-4"><a href="#"><?=nl2br($row['address']);?></a></td>
                                <td class="border-r cell-5"><?=$row['username'];?></td>
                                <td class="border_r cell-6"><?=$row['date_added'];?></td>
                                <td class="cell-6"><?=$row['last_modified'];?></td>
                            </tr>
                        <?php }?>

                        <?php }else{?>
                            <tr>
                                <td><center><h2>No hay Propiedades cargadas.</h2></center></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>

            </div>
            <!--end .table_body -->
            <div class="background_bottom"></div>
        </div>
      
    	<br class="clearfloat" />
    	
        <div id="footer">
            <?php include ('includes/footer_inc.php');?>
        </div><!-- end #footer -->
    </div>
    <!-- end #container -->
</body>
</html>