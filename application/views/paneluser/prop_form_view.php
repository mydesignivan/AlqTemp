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
                <?php require(APPPATH . 'views/includes/popup1_inc.php');?>
                
                <div class="span-16">
                    <label class="label-form2 lbl-w3">*Referencia de tu propiedad:</label>
                    <div class="float-left">
                        <input type="text" name="txtReference" id="txtReference" class="input-form validate" tabindex="1" value="<?=@$info['reference'];?>" onblur="$(this).ucTitle();" />
                        <span class="label-legend">&nbsp;&nbsp;Máximo <b>40</b> car&aacute;cteres</span>
                    </div>
                </div>
                <div class="clear span-16">
                    <label class="label-form2 lbl-w3">*Direcci&oacute;n:</label>
                    <div class="float-left"><input type="text" name="txtAddress" id="txtAddress" class="input-form validate" tabindex="2" value="<?=@$info['address'];?>" /></div>
                </div>
                <?php
                    $html = '
                    <div class="span-16">
                        <label class="label-form2 lbl-w3">*Foto:</label>
                        <div class="float-left">
                            <img src="images/ajax-loader.gif" alt="" width="16" height="16" class="jq-ajaxloader float-left hide" />
                            <a href="#" class="hide append-right-small2 jq-thumb float-left" rel="group"><img src="" alt="" width="69" height="60" class="" /></a>
                            <input type="text" class="input-image jq-uploadinput" value="" />
                            <div class="button-examin">Examinar</div>
                        </div>
                    </div>';

                    $images = @$info['images'];
                    if( empty($images) ) echo $html;
                    else{
                        $n=0;
                        foreach( $images->result_array() as $image ){
                            $n++;

                            echo '<div class="clear span-16 prepend-top-small">';
                            if( $n==1 ) echo '<label class="label-form2 lbl-w3">*Foto:</label>';
                            else echo '<label class="label-form2 lbl-w3">&nbsp;</label>';

                            echo '<div class="float-left">';
                            echo '  <img src="images/ajax-loader.gif" alt="" class="jq-ajaxloader float-left hide" />';
                            echo '  <a href="'.$image['name'].'" class="append-right-small2 jq-thumb float-left" rel="group"><img src="'. $image['name_thumb'] .'" alt="" width="69" height="60" /></a>';
                            echo '  <input type="text" name="" class="input-image jq-uploadinput" value="'.$image['name_original'].'" />';
                            echo '  <div id="b'.$image['image_id'].'" class="button-examin">Examinar</div>';
                            if( $n>1 ) echo '<button type="button" class="button-small float-left" onclick="Prop.remove_row_file(this,'. $image['image_id'] .');">Eliminar</button>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                ?>

                <div class="clear span-16 prepend-top">
                    <label class="label-form2 lbl-w3">&nbsp;</label>
                    <div class="float-left">
                        <div id="msgbox_images" class="clear"></div>
                        <a href="#" class="link-attachments" onclick="Prop.append_row_file(this); return false;" tabindex="4">Adjuntar otro archivo</a>
                        <p class="text-small">M&aacute;ximo 2 megas por foto (gif, jpg o png)</p>
                    </div>
                </div>

                <div class="clear span-16">
                    <label class="label-form2 lbl-w3">*Descripci&oacute;n:</label>
                    <div class="float-left">
                        <textarea name="txtDesc" id="txtDesc" class="textarea-desc validate" cols="22" rows="5" tabindex="5"><?=@$info['description'];?></textarea>
                        <div class="clear text-small float-right" id="jq-charcounter">&nbsp;Te quedan <b>&nbsp;</b> caracteres</div>
                    </div>
                </div>
                <div class="clear span-16">
                    <label class="label-form2 lbl-w3">*Categor&iacute;a:</label>
                    <div class="float-left"><?=form_dropdown('cboCategory', $comboCategory, @$info["category_id"], 'class="select-form float-left validate" id="cboCategory" tabindex="6"');?></div>
                </div>

                <div class="clear span-16 prepend-top-small">
                    <label class="label-form2 lbl-w3">*Servicios:</label>

                    <div class="list-servicios">
                        <ul id="listServices">
                <?php
                    $n=0;
                    $checked="7";
                    $tabindex = ' tabindex=""';
                    foreach( $listServices as $row ){
                        $n++;
                        $class = $n%2 ? '' : 'class="row-par"';
                        if( @$info['services'] ){
                            $checked = arr_search($info['services'], 'service_id=='.$row['service_id']) ? ' checked="checked"' : '';
                        }
                 ?>
                            <li <?=$class;?>>
                                <input type="checkbox" name="checkbox" class="checkbox" value="<?=$row['service_id'];?>" <?=$checked . $tabindex;?> />
                                <a href="javascript:void(0)" onclick="checkRow(this)" class="link1"><?=$row['name'];?></a>
                            </li>
            <?php $tabindex="";}?>
                        </ul>
                    </div>
                    <div id="msgbox_services" class="clear"></div>
                </div>

                <div class="clear span-16 prepend-top-small">
                    <label class="label-form2 lbl-w3">Capacidad:</label>
                    <div class="float-left">
                        <select id="cboCapacity" name="cboCapacity" onchange="Prop.actions.capacity_change(this.value);" tabindex="8">
                            <?php for($n=0; $n<=9; $n++) {
                                $selected = $n == @$info['capacity'] ? ' selected="selected"' : '';
                                echo '<option value="'.$n.'"'.$selected.'>'.$n.'</option>';
                            }?>
                        </select>
                        <span id="spnPeople">persona</span>
                    </div>
                </div>

                <div class="clear span-16 prepend-top-small">
                    <label class="label-form2 lbl-w3">*Pa&iacute;s:</label>
                    <div class="float-left"><?=form_dropdown('cboCountry', $comboCountry, @$info["country_id"], 'id="cboCountry" class="select-form float-left validate" onchange="Prop.show_states(this);" tabindex="9"');?></div>
                </div>
                <div class="clear span-16 prepend-top-small">
                    <label class="label-form2 lbl-w3">*Provincia:</label>
                    <div class="float-left"><?=form_dropdown('cboStates', $comboStates, @$info['state_id'], 'id="cboStates" class="select-form float-left validate" tabindex="10"');?></div>
                </div>
                <div class="clear span-16 prepend-top-small">
                    <label class="label-form2 lbl-w3">*Ciudad:</label>
                    <div class="float-left"><input type="text" name="txtCity" id="txtCity" class="input-form validate" onblur="$(this).ucFirst();" value="<?=@$info['city'];?>" tabindex="11" /></div>
                </div>
                <div class="clear span-16">
                    <label class="label-form2 lbl-w3">Telefono:</label>
                    <input type="text" name="txtPhoneArea" id="txtPhoneArea" class="input-phonearea" value="<?=@$info['phone_area'];?>" tabindex="12" />
                    <input type="text" name="txtPhone" id="txtPhone" class="input-phone" value="<?=@$info['phone'];?>" tabindex="13" />
                </div>
                <div class="clear span-16">
                    <label class="label-form2 lbl-w3">P&aacute;gina Web:</label>
                    <input type="text" name="txtWebsite" class="input-form" onblur="$(this).formatURL();" value="<?=(@$info['website']==FALSE || @$info['website']=='') ? "http://" : @$info['website'];?>" tabindex="14" />
                </div>
                <div class="clear span-16">
                    <label class="label-form2 lbl-w3">Precio:</label>
                    <select name="cboMoneySymbol" class="float-left" tabindex="15">
                        <option value="$" <?php if( @$info['pricemoney']=="$" ) echo 'selected="selected"';?>>$</option>
                        <option value="U$S" <?php if( @$info['pricemoney']=="U\$S" ) echo 'selected="selected"';?>>U$S</option>
                        <option value="€" <?php if( @$info['pricemoney']=="€" ) echo 'selected="selected"';?>>€</option>
                    </select>
                    <input type="text" name="txtPrice" id="txtPrice" class="input-price" value="<?=@$info['price'];?>" tabindex="16" />
                    <select name="cboPriceBy" class="float-left" tabindex="17">
                        <option value="por d&iacute;a" <?php if( @$info['priceby']=="por d&iacute;a" ) echo 'selected="selected"';?>>por d&iacute;a</option>
                        <option value="por semana" <?php if( @$info['priceby']=="por semana" ) echo 'selected="selected"';?>>por semana</option>
                        <option value="por quincena" <?php if( @$info['priceby']=="por quincena" ) echo 'selected="selected"';?>>por quincena</option>
                        <option value="por mes" <?php if( @$info['priceby']=="por mes" ) echo 'selected="selected"';?>>por mes</option>
                    </select>
                </div>

                <div class="clear prepend-top-small span-16">
                    <label class="label-form float-left">Posicionar mi propiedad en un mapa:&nbsp;</label>
                    <div class="float-left text-small">
                        <input type="radio" name="optGmap" value="1" onclick="Prop.show_gmap();" <?php if( @$info['gmap_visible']==1 ) echo 'checked="checked"';?> tabindex="18" />Si&nbsp;&nbsp;
                        <input type="radio" name="optGmap" value="0" onclick="$('#divGmap, #map').hide2();" <?php if( @$info['gmap_visible']==0 || !isset($info) ) echo 'checked="checked"';?> tabindex="19" />No
                    </div>
                </div>
                <div id="divGmap" class="clear span-16 prepend-top <?php if( @$info['gmap_visible']==0 ) echo 'hide2';?>">
                    <label class="label-form2 lbl-w3">Google Map:</label>
                    <div class="float-left">
                        <div id="map" class="gmap"></div><br />
                        <p class="label-legend">Arrastra el marcador para ajustar tu ubicaci&oacute;n<br />Puedes buscar por ejemplo "lavalle 1525, bs as" o "mendoza, ar"</p>
                        <input type="text" id="txtGAddress" class="input-form" onkeypress="if( getKeyCode(event)==13 ) PGmap.search();" tabindex="20" /><button type="button" class="button-small" onclick="PGmap.search()">Buscar</button>
                        <img id="gmap-ajaxloader" src="images/ajax-loader2.gif" alt="Espere por favor" class="hide" />
                        <div id="msgbox-gmap" class="float-left clear"></div>
                    </div>                    
                </div>

                <?php if( $cuenta_plus ){?>
                <div class="clear span-16">
                    <label class="label-form float-left">Insertar Video&nbsp;</label>
                    <div class="float-left text-small">
                        <input type="radio" name="optMovie" value="1" onclick="$('#divMovie').show2();" <?php if( @$info['movie_visible']==1 ) echo 'checked="checked"';?> tabindex="21" />Si&nbsp;&nbsp;
                        <input type="radio" name="optMovie" value="0" onclick="$('#divMovie').hide2();" <?php if( @$info['movie_visible']==0 || !isset($info) ) echo 'checked="checked"';?> tabindex="22" />No
                    </div>
                </div>
                <div id="divMovie" class="clear span-16 prepend-top <?php if( @$info['movie_visible']==0 ) echo 'hide2';?>">
                    <label class="label-form2 lbl-w3">C&oacute;digo de Video:</label>
                    <div class="float-left">
                            <?php if( @$info && !empty($info['movie_url']) ){
                                $movie_url = sprintf(setup('CFG_MOVIE_OBJECT'), $info['movie_url'], $info['movie_url']);
                                echo $movie_url."<br />";
                            }?>
                            <label class="label-legend">Pege aqu&iacute; el c&oacute;digo del video que desea insertar</label><br />
                            <input type="text" name="txtUrlMovie" class="input-form" value='<?=@$movie_url;?>' onclick="this.select()" tabindex="23" />
                        <div id="msgbox_urlmovie" class="clear float-left"></div>
                    </div>
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
                <?php
                    if( @$info ){
                        if( $info['gmap_visible']==1 ){
                            echo ",cuentaplus : {";
                            echo "  coorLat : ".$info['gmap_lat'].",";
                            echo "  coorLng : ".$info['gmap_lng'].",";
                            echo "  address : '".$info['gmap_address']."',";
                            echo "  zoom    : ".$info['gmap_zoom'].",";
                            echo "  mapType : '".$info['gmap_maptype']."'";
                            echo "}";
                        }else{
                            echo ',cuentaplus : true';
                        }

                    }else{
                        echo ',cuentaplus : true';
                    }
                ?>
                });
            -->
            </script>
<?php }?>