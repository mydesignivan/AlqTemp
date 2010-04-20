<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="ajaxloader1" class="ajaxloader1"></div>
<div id="maskEditPss" class="prepend-1">

    <h2>Modifica tu Constrase&ntilde;a</h2>

    <div class="span-6">
        <label class="label-form" for="txtPssCurrent">Constrase&ntilde;a actual</label><br />
        <input type="password" id="txtPssCurrent" class="input-form validate" />
    </div>
    <div class="clear span-6">
        <label class="label-form" for="txtPssNew">Nueva constrase&ntilde;a</label><br />
        <input type="password" id="txtPssNew" class="input-form validate" />
    </div>
    <div class="clear span-6">
        <label class="label-form" for="txtPssVeri">Repetir nueva constrase&ntilde;a</label><br />
        <input type="password" id="txtPssVeri" class="input-form validate" />
    </div>

    <div class="span-6 text-center">
        <button type="button" class="button-small" onclick="Account.save_pass();">Modificar</button>&nbsp;&nbsp;
        <button type="button" class="button-small" onclick="popup.close();">Cerrar</button>
    </div>
</div>
