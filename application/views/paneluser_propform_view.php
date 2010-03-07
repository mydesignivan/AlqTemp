<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <!--SCRIPT "VALIDADOR DE FORMULARIOS"-->
    <link type="text/css" href="js/jquery.validator/css/style.css" rel="stylesheet"  />
    <script type="text/javascript" src="js/jquery.validator/js/script.js"></script>
    <!--END SCRIPT-->
    <!--SCRIPT "FANCYBOX"-->
    <link type="text/css" href="js/jquery.fancybox/jquery.fancybox.css" rel="stylesheet"  />
    <script type="text/javascript" src="js/jquery.fancybox/jquery.fancybox-1.2.1.pack.js"></script>
    <!--END SCRIPT-->

    <script type="text/javascript" src="js/jquery.ajaxupload.min.js"></script>

    <script type="text/javascript" src="js/class.prop.js"></script>
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
                    <h1><?=(!@$data) ? "Nueva Propiedad" : "Modificar Propiedad";?></h1>
                </div>
                <div class="content_left">
                <?php if( @$action=="accesdenied" ){?>

                    <p class="message1">
                        Estimado usuario, le informamos que el servicio gratuito que usted dispone, le permite cargar un maximo de tres propiedades.<br />
                        En caso que desee cargar mas propiedades, debera obtener una <a href="<?=site_url('/panel/cuentaplus/');?>">Cuenta Plus</a>.
                    </p>

                <?php }elseif( @$action=="limitexceeded" ){?>

                    <p class="message1">
                        Ha superado el limite para cargar propiedades.
                    </p>

                <?php }else{?>
                    
                    <?php require('includes/popup_inc.php');?>

                    <form id="formProp" action="" method="post" enctype="application/x-www-form-urlencoded">
                        <div class="row2">
                            <span class="cell">*Dirección:</span>
                            <input type="text" name="txtAddress" id="txtAddress" class="input style_input validate" value="<?=@$data['address'];?>" />
                        </div>
                    <?php
                        $html = '
                        <div class="row">
                            <span class="cell">*Foto:</span>
                            <div class="col ">
                                <div class="ajaxloader2"><img src="images/ajax-loader.gif" alt="" />&nbsp;&nbsp;Subiendo Im&aacute;gen...</div>
                                <a href="#" class="previewthumb" rel="group"><img src="" alt="" width="69" height="60" /></a>
                                <input type="text" name="" class="input style_input float-left ajaxupload-input" value="" />
                                <div class="button2 btnexamin">Examinar</div>
                            </div>
                        </div>';

                        $images = @$data['images'];
                        if( empty($images) ) echo $html;
                        else{
                            $n=0;
                            foreach( $images->result_array() as $image ){
                                $n++;

                                echo '<div class="row">';
                                if( $n==1 ) echo '<span class="cell">*Foto:</span>';
                                echo '<div class="col">';
                                echo '  <div class="ajaxloader2"><img src="images/ajax-loader.gif" alt="" />&nbsp;&nbsp;Subiendo Im&aacute;gen...</div>';
                                echo '  <a href="'.$image['name'].'" class="previewthumb" rel="group"><img src="'. $image['name_thumb'] .'" alt="" width="69" height="60" /></a>';
                                echo '  <input type="text" name="" class="input style_input float-left ajaxupload-input" value="'.$image['name_original'].'" />';
                                echo '  <div id="b'.$image['image_id'].'" class="button2 float-left btnexamin">Examinar</div>';
                                if( $n>1 ) echo '<a class="button2 float-left" onclick="Prop.remove_row_file(this,'. $image['image_id'] .'); return false;">Eliminar</a>';
                                echo '</div>'; //end col
                                echo '</div>'; //end row
                            }
                        }
                   ?>
                        <div class="row2">
                                <a href="#" class="add" onclick="Prop.append_row_file(this); return false;">Adjuntar otro archivo</a>
                                <p id="au-leyend" class="aling-right">Archivos (jpg | gif | png) 2MB max &emsp; &emsp;</p>
                        </div>


                        <div class="row2"><span class="cell">*Descripci&oacute;n:</span><textarea name="txtDesc" id="txtDesc" class="input style_textarea  validate" cols="20" rows="5"><?=@$data['description'];?></textarea></div>

                        <div class="row2">
                            <span class="cell">*Categor&iacute;a:</span>
                            <?=form_dropdown('cboCategory', $comboCategory, @$data["category_id"], 'class="select2 float-right validate" id="cboCategory"');?>
                        </div>

                        <div class="row2">
                            <span class="cell">*Servicios:</span>
                            <div id="contServices" class="list input overflow-x-hidden">
                                <ul id="lstServices">
                            <?php
                                $n=0;
                                $checked="";
                                foreach( $comboServices as $row ){
                                    $n++;
                                    $class = $n%2 ? 'class="impar"' : "";
                                    if( @$data['services'] ){
                                        $checked = arr_search($data['services'], 'service_id=='.$row['service_id']) ? ' checked="checked"' : '';
                                    }
                             ?>

                                    <li <?=$class;?>><input type="checkbox" name="checkbox" class="checkbox" value="<?=$row['service_id'];?>" <?=$checked;?> /><span><?=$row['name'];?></span></li>

                                    <?php }?>
                                </ul>
                            </div>
                        </div>

                        <div class="row2">
                            <span class="cell">*Pais:</span>
                            <?=form_dropdown('cboCountry', $comboCountry, @$data["country_id"], 'id="cboCountry" class="select2 float-right validate" onchange="Prop.show_states(this);"');?>
                        </div>
                        <div class="row2">
                            <span class="cell">*Provincia</span>
                            <?=form_dropdown('cboStates', $comboStates, @$data['state_id'], 'id="cboStates" class="select2 float-right validate"');?>
                        </div>
                        <div class="row2"><span class="cell">*Ciudad:</span><input type="text" name="txtCity" id="txtCity" class="input style_input validate" onblur="$(this).ucFirst();" value="<?=@$data['city'];?>" /></div>
                        <div class="row2"><span class="cell">Tel&eacute;fono:</span><input type="text" name="txtPhone" class="input style_input" value="<?=@$data['phone'];?>" /></div>
                        <div class="row2"><span class="cell">P&aacute;gina Web:</span><input type="text" name="txtWebsite"  class="input style_input" onblur="$(this).formatURL();" value="<?=(@$data['website']==FALSE || @$data['website']=='') ? "http://" : @$data['website'];?>" /></div>
                        <div class="row2"><span class="cell">Precio:</span><input type="text" name="txtPrice" class="input style_input" value="<?=@$data['price'];?>" /></div>


                        <input type="hidden" name="services" value="" />
                        <input type="hidden" name="images_new" value="" />
                        <input type="hidden" name="images_deletes" value="" />
                        <input type="hidden" name="images_modified_id" value="" />
                        <input type="hidden" name="images_modified_name" value="" />
                        <input type="hidden" name="prop_id" value="<?=@$data['prop_id'];?>" />
                    </form>

                    <p>
                        <div class="container_button">
                            <a class="button1 float-left" href="javascript:void(Prop.save());">Guardar</a>
                            <a class="button1 float-left" href="<?=site_url('/panel/propiedades/cancel');?>">Cancelar</a>
                        </div>
                    </p>

                    <div class="warning"><h3>(*) Campos Obligatorios </h3></div>

                <?php }?>
                </div>

                <script type="text/javascript">
                <!--
                    Prop.initializer();
                -->
                </script>

                <!--end .content_left -->
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