<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="dist-popup-content">

    <div class="cont">
        <p class="title">Haga clic en el tipo de destaque.</p>

        <a href="javascript:void(Prop.disting('index'));" class="dist-popup-rectangle">
            <b>Index</b>
        </a>
        <a href="javascript:void(Prop.disting('category'));" class="dist-popup-rectangle">
            <b>Categor&iacute;a</b>
        </a>
        <a href="javascript:void(Prop.disting('city'));" class="dist-popup-rectangle">
            <b>Ciudad</b>
        </a>
        <div class="text-center">
            <button type="button" class="button-small simplemodal-close">Cerrar</button>
        </div>
    </div>

    <div id="pdtype-content" class="cont hide"></div>
</div>
