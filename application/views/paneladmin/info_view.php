<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php require(APPPATH . 'views/includes/popup2_inc.php');?>
<div class="float-left">
    <div class="span-16">
        <fieldset class="fieldset-information">
            <legend>Info. Usuarios</legend>

            <div class="span-6"><label class="label-form">Cant. registrados en el dia de hoy:</label> <strong><?=$info['user']['count_user_day'];?></strong></div>
            <div class="clear span-6"><label class="label-form">Usuarios logeados:</label> <strong><?=$info['user']['total_online'];?></strong></div>
            <div class="clear span-6"><label class="label-form">Usuarios registrados:</label> <strong><?=$info['user']['total_users'];?></strong></div>
            <div class="clear span-6"><label class="label-form">Usuarios dado de baja:</label> <strong><?=$info['user']['total_baja'];?></strong> &nbsp;<?php if( $info['user']['total_baja']>0 ){?><a href="javascript:void(Info.open_popup());" class="link1">Mas info</a><?php }?></div>
        </fieldset>
        <fieldset class="fieldset-information">
            <legend>Info. Propiedades</legend>

            <div class="span-6"><label class="label-form">Cant. prop. nuevas en el dia de hoy:</label> <strong><?=$info['prop']['count_prop_day'];?></strong></div>
            <div class="clear span-6"><label class="label-form">Total de propiedades:</label> <strong><?=$info['prop']['total_prop'];?></strong></div>
            <div class="span-6"><label class="label-form">Cant. prop. destacadas:</label> <strong><?=$info['prop']['prop_disting'];?></strong></div>
        </fieldset>
    </div>

    <div class="clear span-16">
        <fieldset class="fieldset-information">
            <legend>Otros datos</legend>
            <div class="clear span-6"><label class="label-form">Cant. con Cuenta Plus:</label> <strong><?=$info['otros']['count_cuentaplus'];?></strong></div>
            <div class="clear span-6"><label class="label-form">Ganancias:</label> <strong>U$S <?=$info['otros']['total_ganancias'];?></strong></div>
        </fieldset>
    </div>
</div>

<p class="clear text-center">
    <br />
    <button type="button" class="button-large" onclick="location.reload(true)">Refrescar</button>
</p>
