<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="float-left">
    <fieldset class="fieldset-information">
        <legend>Info. Usuarios</legend>

        <div class="span-6"><label class="label-form">Cant. registrados en el dia de hoy:</label> <strong><?=$info['user']['count_user_day'];?></strong></div>
        <div class="clear span-6"><label class="label-form">Cant. con Cuenta Plus:</label> <strong><?=$info['user']['count_cuentaplus'];?></strong></div>
        <div class="clear span-6"><label class="label-form">Usuarios logeados:</label> <strong><?=$info['user']['total_users_online'];?></strong></div>
        <div class="clear span-6"><label class="label-form">Usuarios registrados:</label> <strong><?=$info['user']['total_users'];?></strong></div>
    </fieldset>
    <fieldset class="fieldset-information">
        <legend>Info. Propiedades</legend>

        <div class="span-6"><label class="label-form">Cant. prop. nuevas en el dia de hoy:</label> <strong><?=$info['prop']['count_prop_day'];?></strong></div>
        <div class="clear span-6"><label class="label-form">Total de propiedades:</label> <strong><?=$info['prop']['total_prop'];?></strong></div>
    </fieldset>
</div>

<p class="clear text-center">
    <br />
    <button type="button" class="button-large" onclick="location.reload(true)">Refrescar</button>
</p>
