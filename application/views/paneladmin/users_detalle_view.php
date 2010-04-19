<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="span-10">
    <div class="span-10">
        <div class="column-label"><label class="label-form">Nombre:</label></div>
        <div class="column-data"><?=$info['firstname'];?></div>
    </div>
    <div class="span-10 clear">
        <div class="column-label"><label class="label-form">Apellido:</label></div>
        <div class="column-data"><?=$info['lastname'];?></div>
    </div>
    <div class="span-10 clear">
        <div class="column-label"><label class="label-form">Email:</label></div>
        <div class="column-data"><?=$info['email'];?></div>
    </div>
    <div class="span-10 clear">
        <div class="column-label"><label class="label-form">Tel&eacute;fono:</label></div>
        <div class="column-data">
            <?php if( !empty($info['phone_area']) ){?><span>(<?=$info['phone_area'];?>) </span><?php }?>
            <span><?=$info['phone'];?></span>
        </div>
    </div>
    <div class="span-10 clear">
        <div class="column-label"><label class="label-form">Usuario:</label></div>
        <div class="column-data"><?=$info['username'];?></div>
    </div>
    <div class="span-10 clear">
        <div class="column-label"><label class="label-form">Password:</label></div>
        <div class="column-data"><?=$info['password'];?></div>
    </div>
    <div class="span-10 clear">
        <div class="column-label"><label class="label-form">Importe:</label></div>
        <div class="column-data">U$S <?=$info['fondo'];?></div>
    </div>
    <div class="span-10 text-center"><br /><button type="button" class="button-small" onclick="popup.close()">Cerrar</button></div>
</div>

