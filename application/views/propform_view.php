<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <script type="text/javascript" src="js/class.combobox.js"></script>
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
                    <h1>Nueva Propiedad</h1>
                    <!--<div class="icons">
                        <span>Usuario:</span>
                        Propietario<a href="#"><img src="images/icon_exit.png" alt="salir" /> Salir</a>
                    </div>-->
                </div>
                <div class="content_left">
                    <div id="contmessage"></div>
                    <form name="formProp" id="formProp" action="<?=site_url('/prop/create');?>" method="post" enctype="application/x-www-form-urlencoded">
                        <p><span class="cell">*Dirección:</span><input type="text" name="txtAddress" class="input style_input validate {v_required:true}" value="<?=$data['address'];?>" /></p>
                      	<!--<p>
                        	<span class="cell">*Foto:</span>
                            <input type="file" name="fileField" class="input" />
                            <a href="#" class="add">Adjuntar otro archivo</a>
                        </p>-->

                        <p><span class="cell">*Descripci&oacute;n:</span><textarea name="txtDesc" class="input style_textarea  validate {v_required:true}" cols="20" rows="5"><?=$data['description'];?></textarea></p>

                        <p>
                            <span class="cell">*Servicios:</span>
                            <div id="contServices" class="list input overflow-x-hidden">
                                <ul id="lstServices">
                                    <?php
                                        $n=0;
                                        foreach( $services as $row ){
                                            $n++;
                                            $class = $n%2 ? 'class="impar"' : "";
                                    ?>

                                    <li <?=$class;?>><input type="checkbox" name="checkbox" class="checkbox" value="<?=$row['service_id'];?>" /><span><?=$row['name'];?></span></li>

                                    <?php }?>
                                </ul>
                            </div>
                      	</p>

                      	<p>
                            <span class="cell">*Pais:</span>
                            <select name="cboCountry" class="select2 float-right validate {v_required:true}" onchange="ComboBox.states(this);">
                                <option value="0">Seleccione un Pa&iacute;s</option>
                                <?php get_options_country($data['country_id']);?>
                            </select>
                        </p>
                        <p>
                            <span class="cell">*Provincia</span>
                            <select name="cboStates" id="cboStates" class="select2 float-right validate {v_required:true}">
                                <option value="0">Seleccione un Pa&iacute;s</option>
                                <?php if( $data['state_id']!='' ) get_options_state(array('selected'=>$data['state_id']));?>
                            </select>
                        </p>
                        <p><span class="cell">*Ciudad:</span><input type="text" name="txtCity" class="input style_input validate {v_required:true}" onblur="$(this).ucFirst();" value="<?=$data['city'];?>" /></p>
                        <p><span class="cell">Tel&eacute;fono:</span><input type="text" name="txtPhone" class="input style_input" value="<?=$data['phone'];?>" /></p>
                        <p><span class="cell">P&aacute;gina Web:</span><input type="text" name="txtWebsite"  class="input style_input" onblur="$(this).formatURL();" value="<?=$data['website'];?>" /></p>
                        <p><span class="cell">Precio:</span><input type="text" name="txtPrice" class="input style_input" value="<?=$data['price'];?>" /></p>
                        <input type="hidden" name="services" value="<?=$data['services'];?>" />
                    </form>

                    <p><div class="container_button"><a class="button1" href="#" onclick="Prop.save(); return false;">Guardar</a></div></p>

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