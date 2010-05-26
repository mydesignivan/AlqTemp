<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="message-attention"><div class="message">El fondo que adquiera a trav&eacute;s de nuestra web no ser&aacute; reembolsable y el mismo solo puede ser utilizado dentro de los servicios ofrecidos por <b>alquilerestemporarios.org</b></div></div>

<form id="form1" action='https://argentina.dineromail.com/Shop/Shop_Ingreso.asp' method='post' class="prepend-top">
    <div class="prepend-4">
        <div class="span-5 first">
            <label class="label-large">Saldo Disponible</label><br />
            <input type="text" class="input-saldo" value="U$S <?=$this->session->userdata('fondo');?>" onkeypress="return false;" />
        </div>
        <div class="span-4 last">
            <label class="label-large">Agregar Fondos</label><br />
            <label class="label-form">Importe&nbsp;<b>U$S</b></label>
            <select name="cboImport" id="cboImport">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>

    <div class="span-15 last text-center">
        <br />
        <a href="javascript:void(Fondo.buy());"><img src="images/btn_buy.jpg" alt="Comprar" width="123" height="44" /></a>
    </div>

    <input type='hidden' name='NombreItem' value='AlquileresTemporarios.org'>
    <input type='hidden' name='TipoMoneda' value='1'>
    <input type='hidden' name='PrecioItem' value='5.00'>
    <input type='hidden' name='E_Comercio' value='96191'>
    <input type='hidden' name='NroItem' value='-'>
    <input type='hidden' name='image_url' value='http://'>
    <input type='hidden' name='DireccionExito' value='http://www.alquilerestemporarios.org/checkout_success'>
    <input type='hidden' name='DireccionFracaso' value='http://www.alquilerestemporarios.org/checkout_cancel'>
    <input type='hidden' name='DireccionEnvio' value='0'>
    <input type='hidden' name='Mensaje' value='1'>
</form>