<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <script type="text/javascript" src="js/class.combobox.js"></script>
    <script type="text/javascript" src="js/class.prop.js"></script>
    <script type="text/javascript" src="js/ajaxupload.2.0.js"></script>
    <script type="text/javascript">
    <!--
    $(document).ready(function(){
        var button = $('.btnexamin'), interval;
        new AjaxUpload('.btnexamin', {
            action: document.baseURI+'index.php/ajax_upload',
            onSubmit : function(file , ext){
                if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                    alert('Error: Solo se permiten imagenes');
                    return false;
                } else {
                    document.title = "subiendo";
                    //button.text('Uploading');
                    this.disable();
                }
            },
            onComplete: function(file, response){
                alert(response);
                alert(file);
                document.title = "listo";
                //button.text('Upload');
                // habilito upload button
                this.enable();
                // Agrega archivo a la lista
                //$('#lista').appendTo('.files').text(file);
            }
        });
    });
    -->
    </script>
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
                    <h1><?=(!$data) ? "Nueva Propiedad" : "Modificar Propiedad";?></h1>
                    <!--<div class="icons">
                        <span>Usuario:</span>
                        Propietario<a href="#"><img src="images/icon_exit.png" alt="salir" /> Salir</a>
                    </div>-->
                </div>
                <div class="content_left">
                    <div id="contmessage"></div>
                    <form name="formProp" id="formProp" action="" method="post" enctype="application/x-www-form-urlencoded">
                        <div class="row2"><span class="cell">*Dirección:</span><input type="text" name="txtAddress" class="input style_input validate {v_required:true}" value="<?=getval($data, 'address');?>" /></div>
                        <div class="row">
                            <span class="cell">*Foto:</span>
                            <a href="#" class="button2 float-right">Eliminar</a>
                            <div href="#" class="button2 float-right btnexamin">Examinar</div>
                            <input type="text" name="" class="input style_input" value="" />
                        </div>
                        <div class="row"><a href="#" class="add">Adjuntar otro archivo</a></div>


                        <div class="row2"><span class="cell">*Descripci&oacute;n:</span><textarea name="txtDesc" class="input style_textarea  validate {v_required:true}" cols="20" rows="5"><?=getval($data, 'description');?></textarea></div>

                        <div class="row2">
                            <span class="cell">*Categor&iacute;a:</span>
                            <select name="cboCategory" class="select2 float-right validate {v_required:true}">
                            <?php $val = getval($data, 'category');?>
                                <option value="1" <?php if($val==1) echo 'selected="selected"';?>>Casas</option>
                                <option value="2" <?php if($val==2) echo 'selected="selected"';?>>Departamentos</option>
                                <option value="3" <?php if($val==3) echo 'selected="selected"';?>>Caba&ntilde;as</option>
                                <option value="4" <?php if($val==4) echo 'selected="selected"';?>>Otros</option>
                            </select>
                        </div>
                        
                        <div class="row2">
                            <span class="cell">*Servicios:</span>
                            <div id="contServices" class="list input overflow-x-hidden">
                                <ul id="lstServices">
                            <?php
                                $n=0;
                                $checked="";
                                $service_id = getval($data, 'service_id');
                                foreach( $services as $row ){
                                    $n++;
                                    $class = $n%2 ? 'class="impar"' : "";
                                    if( $service_id!="" ) $checked = array_search($row["service_id"], $service_id) ? 'checked="checked"' : "";
                             ?>

                                    <li <?=$class;?>><input type="checkbox" name="checkbox" class="checkbox" value="<?=$row['service_id'];?>" <?=$checked;?> /><span><?=$row['name'];?></span></li>

                                    <?php }?>
                                </ul>
                            </div>
                        </div>

                        <div class="row2">
                            <span class="cell">*Pais:</span>
                            <select name="cboCountry" class="select2 float-right validate {v_required:true}" onchange="ComboBox.states(this, 'Seleccione una Provincia');">
                                <option value="0">Seleccione un Pa&iacute;s</option>
                                <?php get_options_country(getval($data, 'country_id'));?>
                            </select>
                        </div>
                        <div class="row2">
                            <span class="cell">*Provincia</span>
                            <select name="cboStates" id="cboStates" class="select2 float-right validate {v_required:true}">
                                <?php
                                    if( !$data ) echo '<option value="0">Seleccione un Pa&iacute;s</option>';
                                    $val = getval($data, 'state_id');
                                    if( $val!='' ) get_options_state(array('country_id'=>getval($data, 'country_id'), 'selected'=>$val));
                                ?>
                            </select>
                        </div>
                        <div class="row2"><span class="cell">*Ciudad:</span><input type="text" name="txtCity" class="input style_input validate {v_required:true}" onblur="$(this).ucFirst();" value="<?=getval($data, 'city');?>" /></div>
                        <div class="row2"><span class="cell">Tel&eacute;fono:</span><input type="text" name="txtPhone" class="input style_input" value="<?=getval($data, 'phone');?>" /></div>
                        <div class="row2"><span class="cell">P&aacute;gina Web:</span><input type="text" name="txtWebsite"  class="input style_input" onblur="$(this).formatURL();" value="<?=getval($data, 'website');?>" /></div>
                        <div class="row2"><span class="cell">Precio:</span><input type="text" name="txtPrice" class="input style_input" value="<?=getval($data, 'price');?>" /></div>

                        <input type="hidden" name="services" value="" />
                        <input type="hidden" name="prop_id" value="<?=getval($data, 'prop_id');?>" />
                    </form>

                    <p><div class="container_button"><a class="button1" href="#" onclick="Prop.save(); return false;">Guardar</a><img id="ajaxloader" src="images/ajax-loader2.gif" alt="" width="22" height="22" /></div></p>

                    <div class="warning"><h3>(*) Campos Obligatorios </h3></div>
                </div>
                <!--end .content_left -->
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