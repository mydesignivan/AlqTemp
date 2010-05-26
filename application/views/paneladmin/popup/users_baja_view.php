<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<fieldset class="fieldset-listusers">
    <legend>Usuarios</legend>

    <select id="lstUsers" class="select-list-users" multiple onchange="Info.get_info(this)">
    <?php foreach( $listUsers->result_array() as $row ){?>
        <option value="<?=$row['id'];?>" title="<?=$row['name'];?>"><?=$row['name'];?></option>
    <?php }?>
    </select>
</fieldset>

<fieldset class="fieldset-data">
    <legend>Datos del Usuario</legend>

    <div class="span-8">
        <div class="column-label"><label class="label-form">Nombre:</label></div>
        <div class="column-data" id="datName"></div>
    </div>
    <div class="span-8 clear">
        <div class="column-label"><label class="label-form">Email:</label></div>
        <div class="column-data" id="datEmail"></div>
    </div>
    <div class="span-8 clear">
        <div class="column-label"><label class="label-form">Tel&eacute;fono:</label></div>
        <div class="column-data" id="datPhone"></div>
    </div>
    <div class="span-8 clear">
        <div class="column-label"><label class="label-form">Usuario:</label></div>
        <div class="column-data" id="datUsername"></div>
    </div>
    <div class="span-8 clear">
        <div class="column-label"><label class="label-form">Motivo:</label></div>
        <div class="column-data column-data-motive" id="datMotive"></div>
    </div>
</fieldset>
<div class="span-13 text-center">
    <button type="button" class="button-small simplemodal-close">Cerrar</button>
</div>

