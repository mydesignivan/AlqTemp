<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <script type="text/javascript" src="js/class.log.js"></script>
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
                    <h1>Listado de Errores</h1>
                </div>

                <div class="buttons">
                    <?php if( count($listDate)>0 ){?>
                        <div class="float-left">
                            <span>Fecha:&nbsp;</span>
                            <?=form_dropdown('cboDate', $listDate, (!$this->uri->segment(4)) ? date('Y-m-d') : $this->uri->segment(4), 'onchange="location.href=\''.site_url('paneladmin/log/display/').'/\'+this.value;" id="cboDate"');?>
                        </div>
                    <?php }?>
                    <?php if( count($listLog)>0 ){?>
                        <a href="javascript:void(Log.action.del());" class="button1">Eliminar</a>
                        <a href="javascript:void(Log.action.del_date());" class="button3">Eliminar Fecha</a>
                    <?php }?>
                </div>

                <table id="tblList" class="table" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <td class="cell-1 border-rb">&nbsp;</td>
                            <td class="cell-2 border-rb">Fecha</td>
                            <td class="cell-3 border-b">Mensaje</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if( count($listLog)>0 ){$n=0;
                           foreach( $listLog as $row ){$n++;
                                $class = $n%2 ? "table-row" : "table-row-odd";
                         ?>
                            <tr class="<?=$class;?> over">
                                <td class="cell-1 border-r"><input type="checkbox" value="<?=$row['index'];?>" /></td>
                                <td class="cell-2 border-r" onclick="checkRow(this)"><?=$row['date'];?></td>
                                <td class="cell-3" onclick="checkRow(this)"><?=$row['message'];?></td>
                            </tr>

                        <?php }
    

                         }else{?>
                        <tr>
                            <td colspan="3"><center><h2>No hay errores registrados.</h2></center></td>
                        </tr>                           
                   <?php }?>

                    </tbody>
                </table>

                <?php echo $this->pagination->create_links();?>

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