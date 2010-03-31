<?php if( @$action=="accesdenied" ){?>

    <p>
        Estimado usuario, le informamos que el servicio gratuito que usted dispone, le permite cargar un maximo de tres propiedades.<br />
        En caso que desee cargar mas propiedades, debera obtener una <a href="<?=site_url('/paneluser/cuentaplus/');?>">Cuenta Plus</a>.
    </p>

<?php }elseif( @$action=="limitexceeded" ){?>

    <p>
        Ha superado el limite para cargar propiedades.
    </p>

<?php }else{?>

    <?php require(APPPATH . 'views/includes/popup_inc.php');?>

            <form id="formProp" action="" method="post" enctype="application/x-www-form-urlencoded">
                <p class="span-10">
                    <label class="label3 float-left">*Direcci&oacute;n:</label>
                    <input type="text" name="txtAddress" id="txtAddress" class="input-form float-right validate" tabindex="1" value="<?=@$info['address'];?>" />
                </p>

                <?php
                    $html = '
                    <div class="span-16">
                        <label class="label3 float-left">*Foto:</label>
                        <div class="column-photo">
                            <div class="ajaxloader2"><img src="images/ajax-loader.gif" alt="" />&nbsp;&nbsp;Subiendo Im&aacute;gen...</div>
                            <a href="#" class="append-right-small2 float-left hide jq-thumb" rel="group"><img src="" alt="" width="69" height="60" /></a>
                            <input type="text" class="input-form float-left jq-uploadinput" value="" />
                            <div class="button-examin">Examinar</div>
                        </div>
                    </div>';

                    $images = @$info['images'];
                    if( empty($images) ) echo $html;
                    else{
                        $n=0;
                        foreach( $images->result_array() as $image ){
                            $n++;

                            echo '<div class="clear span-16">';
                            if( $n==1 ) echo '<label class="label3 float-left">*Foto:</label>';
                            echo '<div class="column-photo">';
                            echo '  <div class="ajaxloader2"><img src="images/ajax-loader.gif" alt="" />&nbsp;&nbsp;Subiendo Im&aacute;gen...</div>';
                            echo '  <a href="'.$image['name'].'" class="append-right-small2 float-left jq-thumb" rel="group"><img src="'. $image['name_thumb'] .'" alt="" width="69" height="60" /></a>';
                            echo '  <input type="text" name="" class="input-form float-left jq-uploadinput" value="'.$image['name_original'].'" />';
                            echo '  <div id="b'.$image['image_id'].'" class="button-examin">Examinar</div>';
                            if( $n>1 ) echo '<button type="button" class="button-small float-left" onclick="Prop.remove_row_file(this,'. $image['image_id'] .');">Eliminar</button>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
               ?>

                <div class="clear span-10 append-bottom prepend-top">
                    <div class="float-right">
                        <a href="#" class="link-attachments" onclick="Prop.append_row_file(this); return false;">Adjuntar otro archivo</a>
                        <p id="au-leyend" class="text-small">Archivos (jpg | gif | png) 2MB max &emsp; &emsp;</p>
                    </div>
                </div>

                <p class="clear span-10">
                    <label class="label3 float-left">*Descripci&oacute;n:</label>
                    <textarea name="txtDesc" id="txtDesc" class="textarea-form float-right validate" cols="22" rows="5"><?=@$info['description'];?></textarea>
                </p>
                <p class="clear span-10">
                    <label class="label3 float-left">*Categor&iacute;a:</label>
                    <?=form_dropdown('cboCategory', $comboCategory, @$info["category_id"], 'class="select-form float-right" id="cboCategory"');?>
                </p>

                <div class="clear span-10">
                    <label class="label3 float-left">*Servicios:</label>

                    <div class="list-servicios">
                        <ul id="listServices">
                <?php
                    $n=0;
                    $checked="";
                    foreach( $listServices as $row ){
                        $n++;
                        $class = $n%2 ? '' : 'class="row-par"';
                        if( @$info['services'] ){
                            $checked = arr_search($info['services'], 'service_id=='.$row['service_id']) ? ' checked="checked"' : '';
                        }
                 ?>
                            <li <?=$class;?>>
                                <input type="checkbox" name="checkbox" class="checkbox" value="<?=$row['service_id'];?>" <?=$checked;?> />
                                <span><?=$row['name'];?></span>
                            </li>
            <?php }?>
                        </ul>
                    </div>
                </div>

                <p class="clear span-10">
                    <label class="label3 float-left">*Pa&iacute;s:</label>
                    <?=form_dropdown('cboCountry', $comboCountry, @$info["country_id"], 'id="cboCountry" class="select-form float-right validate" onchange="Prop.show_states(this);"');?>
                </p>
                <p class="clear span-10">
                    <label class="label3 float-left">*Provincia:</label>
                    <?=form_dropdown('cboStates', $comboStates, @$info['state_id'], 'id="cboStates" class="select-form float-right validate"');?>
                </p>
                <p class="clear span-10">
                    <label class="label3 float-left">*Ciudad:</label>
                    <input type="text" name="txtCity" id="txtCity" class="input-form float-right validate" onblur="$(this).ucFirst();" value="<?=@$info['city'];?>" />
                </p>
                <p class="clear span-10">
                    <label class="label3 float-left">Telefono:</label>
                    <input type="text" name="txtPhone" class="input-form float-right" value="<?=@$info['phone'];?>" />
                </p>
                <p class="clear span-10">
                    <label class="label3 float-left">P&aacute;gina Web:</label>
                    <input type="text" name="txtWebsite" class="input-form float-right" onblur="$(this).formatURL();" value="<?=(@$info['website']==FALSE || @$info['website']=='') ? "http://" : @$info['website'];?>" />
                </p>
                <p class="clear span-10">
                    <label class="label3 float-left">Precio:</label>
                    <input type="text" name="txtPrice" class="input-form float-right" value="<?=@$info['price'];?>" />
                </p>

                <div class="span-10 clear"><label class="label-legend">(*) Campo obligatorios</label></div>

                <div class="clear span-15 text-center prepend-top">
                    <button type="button" class="button-large" onclick="Prop.save();">Guardar</button>&nbsp;&nbsp;
                    <button type="button" class="button-large" onclick="location.href='<?=site_url('/paneluser/propiedades/cancel');?>';">Cancelar</button>
                </div>

                <input type="hidden" name="services" value="" />
                <input type="hidden" name="images_new" value="" />
                <input type="hidden" name="images_deletes" value="" />
                <input type="hidden" name="images_modified_id" value="" />
                <input type="hidden" name="images_modified_name" value="" />
                <input type="hidden" name="extra_post" value="" />
                <input type="hidden" name="prop_id" value="<?=@$info['prop_id'];?>" />
            </form>
            <script type="text/javascript">
            <!--
                Prop.initializer(<?=!@info ? "false" : "true";?>);
            -->
            </script>
<?php }?>