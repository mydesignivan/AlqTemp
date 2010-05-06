<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

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

            <form id="formProp" action="" method="post" enctype="application/x-www-form-urlencoded">
                <?php require(APPPATH . 'views/includes/popup_inc.php');?>
                
                <div class="span-10">
                    <label class="label-form float-left">*Direcci&oacute;n:</label>
                    <input type="text" name="txtAddress" id="txtAddress" class="input-form float-right validate" tabindex="1" value="<?=@$info['address'];?>" onblur="$(this).ucTitle();" />
                </div>
                <?php
                    $html = '
                    <div class="span-16">
                        <label class="label-form float-left">*Foto:</label>
                        <div class="column-photo">
                            <div class="ajaxloader2"><img src="images/ajax-loader.gif" alt="" />&nbsp;&nbsp;Subiendo Im&aacute;gen...</div>
                            <a href="#" class="hide append-right-small2 float-left jq-thumb" rel="group"><img src="" alt="" width="69" height="60" class="" /></a>
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
                            if( $n==1 ) echo '<label class="label-form float-left">*Foto:</label>';
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

                <div class="clear span-10 prepend-top">
                    <div class="float-right">
                        <div id="msgbox_images" class="clear"></div>
                        <a href="#" class="link-attachments" onclick="Prop.append_row_file(this); return false;" tabindex="2">Adjuntar otro archivo</a>
                        <p class="text-small">Archivos (jpg | gif | png) 2MB max &emsp; &emsp;</p>
                    </div>
                </div>

                <div class="clear span-15">
                    <label class="label-form float-left">*Descripci&oacute;n:</label>
                    <textarea name="txtDesc" id="txtDesc" class="textarea-form-large float-right validate" cols="22" rows="5" tabindex="3"><?=@$info['description'];?></textarea>
                    <div class="clear float-right text-small" id="jq-charcounter">Te quedan <b>&nbsp;</b> caracteres</div>
                </div>
                <div class="clear span-10">
                    <label class="label-form float-left">*Categor&iacute;a:</label>
                    <?=form_dropdown('cboCategory', $comboCategory, @$info["category_id"], 'class="select-form float-right validate" id="cboCategory" tabindex="4"');?>
                </div>

                <div class="clear span-10 prepend-top-small">
                    <label class="label-form float-left">*Servicios:</label>

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
                                <a href="javascript:void(0)" onclick="checkRow(this)" class="link1"><?=$row['name'];?></a>
                            </li>
            <?php }?>
                        </ul>
                    </div>
                    <div id="msgbox_services" class="clear"></div>
                </div>

                <div class="clear span-10 prepend-top-small">
                    <label class="label-form float-left">*Pa&iacute;s:</label>
                    <?=form_dropdown('cboCountry', $comboCountry, @$info["country_id"], 'id="cboCountry" class="select-form float-right validate" onchange="Prop.show_states(this);" tabindex="5"');?>
                </div>
                <div class="clear span-10 prepend-top-small">
                    <label class="label-form float-left">*Provincia:</label>
                    <?=form_dropdown('cboStates', $comboStates, @$info['state_id'], 'id="cboStates" class="select-form float-right validate" tabindex="6"');?>
                </div>
                <div class="clear span-10 prepend-top-small">
                    <label class="label-form float-left">*Ciudad:</label>
                    <input type="text" name="txtCity" id="txtCity" class="input-form float-right validate" onblur="$(this).ucFirst();" value="<?=@$info['city'];?>" tabindex="7" />
                </div>
                <div class="clear span-10">
                    <label class="label-form float-left">Telefono:</label>
                    <input type="text" name="txtPhone" class="input-phone float-right" value="<?=@$info['phone'];?>" tabindex="9" />
                    <input type="text" name="txtPhoneArea" class="input-phonearea float-right" value="<?=@$info['phone_area'];?>" tabindex="8" />
                </div>
                <div class="clear span-10">
                    <label class="label-form float-left">P&aacute;gina Web:</label>
                    <input type="text" name="txtWebsite" class="input-form float-right" onblur="$(this).formatURL();" value="<?=(@$info['website']==FALSE || @$info['website']=='') ? "http://" : @$info['website'];?>" tabindex="10" />
                </div>
                <div class="clear span-10">
                    <label class="label-form float-left">Precio:</label>
                    <input type="text" name="txtPrice" class="input-form float-right" value="<?=@$info['price'];?>" tabindex="11" />
                </div>

                <?php if( $cuenta_plus ){?>
                <div class="clear span-16">
                    <label class="label-form float-left">Posicionar mi propiedad en un mapa:&nbsp;</label>
                    <div class="float-left text-small">
                        <input type="radio" name="optGmap" value="1" onclick="Prop.show_gmap();" <?php if( @$info['gmap_visible']==1 ) echo 'checked="checked"';?> />Si&nbsp;&nbsp;
                        <input type="radio" name="optGmap" value="0" onclick="$('#divGmap, #map').hide2();" <?php if( @$info['gmap_visible']==0 || !isset($info) ) echo 'checked="checked"';?> />No
                    </div>
                </div>
                <div id="divGmap" class="clear span-16 prepend-top <?php if( @$info['gmap_visible']==0 ) echo 'hide2';?>">
                    <label class="label-form float-left">Google Map:</label>
                    <div class="column-photo">
                        <div id="map" class="gmap"></div><br />
                        <p class="label-legend">Arrastra el marcador para ajustar tu ubicaci&oacute;n<br />Puedes buscar por ejemplo "lavalle 1525, bs as" o "mendoza, ar"</p>
                        <input type="text" id="txtGAddress" class="input-form validate" onkeypress="if( getKeyCode(event)==13 ) PGmap.search();" /><button type="button" class="button-small" onclick="PGmap.search()">Buscar</button>
                        <img id="gmap-ajaxloader" src="images/ajax-loader2.gif" alt="Espere por favor" class="hide" />
                        <div id="msgbox-gmap" class="float-left"></div>
                    </div>                    
                </div>
                <div class="clear span-16">
                    <label class="label-form float-left">Mostrar Videos&nbsp;</label>
                    <div class="float-left text-small">
                        <input type="radio" name="optMovie" value="1" onclick="$('#divGmap, #map').show2();" <?php if( @$info['movie_visible']==1 ) echo 'checked="checked"';?> />Si&nbsp;&nbsp;
                        <input type="radio" name="optMovie" value="0" onclick="$('#divGmap, #map').hide2();" <?php if( @$info['movie_visible']==0 || !isset($info) ) echo 'checked="checked"';?> />No
                    </div>
                </div>
                <div id="divMovie" class="clear span-16 <?php if( @$info['movie_visible']==0 ) echo 'hide2';?>">
                    
                </div>
                <?php }?>

                <!-- ============== END FORM =============== -->

                <!--<div class="span-10 clear"><label class="label-legend">(*) Campo obligatorios</label></div>-->

                <div class="clear span-15 text-center prepend-top">
                    <button type="button" class="button-large" onclick="Prop.save();">Guardar</button>&nbsp;&nbsp;
                    <button type="button" class="button-large" onclick="location.href='<?=site_url('/paneluser/propiedades/cancel');?>';">Cancelar</button>
                </div>

                <input type="hidden" name="extra_post" value="" />
                <input type="hidden" name="prop_id" value="<?=@$info['prop_id'];?>" />
            </form>
            <script type="text/javascript">
            <!--
                Prop.initializer({
                    mode       : <?=!@$info ? "false" : "true";?>
                <?php if( $cuenta_plus ){
                        if( @$info ){?>
                            ,cuentaplus : {
                                coorLat : <?=@$info['gmap_lat'];?>,
                                coorLng : <?=@$info['gmap_lng'];?>,
                                address : '<?=@$info['gmap_address'];?>',
                                zoom    : <?=@$info['gmap_zoom'];?>,
                                mapType : '<?=@$info['gmap_maptype'];?>'
                            }
                <?php   }else{
                            echo ',cuentaplus : true';
                        }
                      }?>
                });
            -->
            </script>
<?php }?>