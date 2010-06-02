<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<form id="form1" action="<?=site_url('/paneladmin/setup/save/');?>" method="post">
<div id="tabs" class="setup-tabs">
    <ul>
        <li><a href="#tabs-1">General</a></li>
        <li><a href="#tabs-2">Metadata</a></li>
        <li><a href="#tabs-3">htaccess</a></li>
    </ul>
    <div id="tabs-1">
        <fieldset class="span-13">
            <legend>Tiempos</legend>

            <div class="span-8 last">
                <div class="span-5 last"><label class="label-form">Prop. Destacada</label></div>
                <div class="float-left" style="position: relative;"><input type="text" id="gral_time_propdisting" name="gral_time_propdisting" class="input-small2 validate" value="<?=$info['gral_time_propdisting'];?>" style="text-align: right;" /> meses</div>
            </div>
            <div class="clear span-8 last">
                <div class="span-5 last"><label class="label-form float-left">Duraci&oacute;n de una Cuenta Plus</label></div>
                <div class="float-left" style="position: relative;"><input type="text" id="gral_time_cp" name="gral_time_cp" class="input-small2 validate" value="<?=$info['gral_time_cp'];?>" style="text-align: right;" /> a&ntilde;os</div>
            </div>
        </fieldset>

        <fieldset class="clear span-13">
            <legend>Costos</legend>

            <div class="span-8 last">
                <div class="span-5 last"><label class="label-form">Costo del destaque</label></div>
                <div class="float-left" style="position: relative;"><input type="text" id="gral_costo_disting" name="gral_costo_disting" class="input-small2 validate" value="<?=$info['gral_costo_disting'];?>" style="text-align: right;" /> U$S</div>
            </div>
            <div class="clear span-8 last">
                <div class="span-5 last"><label class="label-form float-left">Costo Cuenta Plus</label></div>
                <div class="float-left" style="position: relative;"><input type="text" id="gral_costo_cp" name="gral_costo_cp" class="input-small2 validate" value="<?=$info['gral_costo_cp'];?>" style="text-align: right;" /> U$S</div>
            </div>
        </fieldset>

        <fieldset class="clear span-13">
            <legend>Cantidad</legend>

            <div class="span-8 last">
                <div class="span-5 last"><label class="label-form">Prop. Destacadas</label></div>
                <input type="text" id="gral_count_propdisting" name="gral_count_propdisting" class="input-small2 float-left validate" value="<?=$info['gral_count_propdisting'];?>" style="text-align: right;" />
            </div>
            <div class="span-8 last">
                <div class="span-5 last"><label class="label-form">Prop. Similares</label></div>
                <input type="text" id="gral_count_propsimilares" name="gral_count_propsimilares" class="input-small2 float-left validate" value="<?=$info['gral_count_propdisting'];?>" style="text-align: right;" />
            </div>
            <div class="clear span-13 last">
                <div class="span-5 last"><label class="label-form float-left">Im&aacute;genes Gratis</label></div>
                <input type="text" id="gral_count_freeimages" name="gral_count_freeimages" class="input-small2 float-left validate" value="<?=$info['gral_count_freeimages'];?>" style="text-align: right;" />
            </div>
            <div class="clear span-13 last">
                <div class="span-5 last"><label class="label-form float-left">Im&aacute;gen Cuenta Plus</label></div>
                <input type="text" id="gral_count_imagescp" name="gral_count_imagescp" class="input-small2 float-left validate" value="<?=$info['gral_count_imagescp'];?>" style="text-align: right;" />
            </div>
        </fieldset>

        <fieldset class="clear span-13">
            <legend>Otros</legend>

            <div class="span-13 last">
                <label class="label-form">Script default movie</label>
                <input type="text" name="gral_otros_scriptmovie" class="input-large validate" value='<?=$info['gral_otros_scriptmovie'];?>' />
            </div>
        </fieldset>
    </div>
    <div id="tabs-2" class="hide">
        <fieldset class="clear span-13">
            <legend>T&iacute;tulos</legend>

            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">General</label></div>
                <div class="float-left"><input type="text" name="meta_titles_general" class="input-medium2" value="<?=$info['meta_titles_general'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Index</label></div>
                <div class="float-left"><input type="text" name="meta_titles_index" class="input-medium2" value="<?=$info['meta_titles_index'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Mas Info</label></div>
                <div class="float-left"><input type="text" name="meta_titles_moreinfo" class="input-medium2" value="<?=$info['meta_titles_moreinfo'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Contacto</label></div>
                <div class="float-left"><input type="text" name="meta_titles_contact" class="input-medium2" value="<?=$info['meta_titles_contact'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Form. Registro</label></div>
                <div class="float-left"><input type="text" name="meta_titles_formreg" class="input-medium2" value="<?=$info['meta_titles_formreg'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Recordar Contrase&ntilde;a</label></div>
                <div class="float-left"><input type="text" name="meta_titles_rememberpss" class="input-medium2" value="<?=$info['meta_titles_rememberpss'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Mi Cuenta</label></div>
                <div class="float-left"><input type="text" name="meta_titles_myaccount" class="input-medium2" value="<?=$info['meta_titles_myaccount'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Propiedades</label></div>
                <div class="float-left"><input type="text" name="meta_titles_prop" class="input-medium2" value="<?=$info['meta_titles_prop'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Destacar</label></div>
                <div class="float-left"><input type="text" name="meta_titles_disting" class="input-medium2" value="<?=$info['meta_titles_disting'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Cuenta Plus</label></div>
                <div class="float-left"><input type="text" name="meta_titles_cp" class="input-medium2" value="<?=$info['meta_titles_cp'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Agregar Fondos</label></div>
                <div class="float-left"><input type="text" name="meta_titles_addfondo" class="input-medium2" value="<?=$info['meta_titles_addfondo'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Condiciones de uso</label></div>
                <div class="float-left"><input type="text" name="meta_titles_conditions" class="input-medium2" value="<?=$info['meta_titles_conditions'];?>" /></div>
            </div>
        </fieldset>

        <fieldset class="clear span-13">
            <legend>Palabras Claves</legend>

            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">General</label></div>
                <div class="float-left"><input type="text" name="meta_keywords_general" class="input-medium2" value="<?=$info['meta_keywords_general'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Index</label></div>
                <div class="float-left"><input type="text" name="meta_keywords_index" class="input-medium2" value="<?=$info['meta_keywords_index'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Mas Info</label></div>
                <div class="float-left"><input type="text" name="meta_keywords_moreinfo" class="input-medium2" value="<?=$info['meta_keywords_moreinfo'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Contacto</label></div>
                <div class="float-left"><input type="text" name="meta_keywords_contact" class="input-medium2" value="<?=$info['meta_keywords_contact'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Form. Registro</label></div>
                <div class="float-left"><input type="text" name="meta_keywords_formreg" class="input-medium2" value="<?=$info['meta_keywords_formreg'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Recordar Contrase&ntilde;a</label></div>
                <div class="float-left"><input type="text" name="meta_keywords_rememberpss" class="input-medium2" value="<?=$info['meta_keywords_rememberpss'];?>" /></div>
            </div>
        </fieldset>

        <fieldset class="clear span-13">
            <legend>Descripci&oacute;n</legend>

            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">General</label></div>
                <div class="float-left"><input type="text" name="meta_desc_general" class="input-medium2" value="<?=$info['meta_desc_general'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Index</label></div>
                <div class="float-left"><input type="text" name="meta_desc_index" class="input-medium2" value="<?=$info['meta_desc_index'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Mas Info</label></div>
                <div class="float-left"><input type="text" name="meta_desc_moreinfo" class="input-medium2" value="<?=$info['meta_desc_moreinfo'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Contacto</label></div>
                <div class="float-left"><input type="text" name="meta_desc_contact" class="input-medium2" value="<?=$info['meta_desc_contact'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Form. Registro</label></div>
                <div class="float-left"><input type="text" name="meta_desc_formreg" class="input-medium2" value="<?=$info['meta_desc_formreg'];?>" /></div>
            </div>
            <div class="span-13 last">
                <div class="span-4 last"><label class="label-form">Recordar Contrase&ntilde;a</label></div>
                <div class="float-left"><input type="text" name="meta_desc_rememberpss" class="input-medium2" value="<?=$info['meta_desc_rememberpss'];?>" /></div>
            </div>
        </fieldset>
    </div>
    <div id="tabs-3" class="hide">
        <label class="label-form">Editor</label><br />
        <textarea name="txtHtaccess" cols="22" rows="5" class="textarea-edit validate"><?=$info['htaccess'];?></textarea>
    </div>
</div>

<div class="clear span-15 prepend-top-small text-center">
    <button type="button" class="button-large" onclick="Setup.save();">Guardar</button>
</div>
</form>

<script type="text/javascript">
<!--
    Setup.initializer();
-->
</script>