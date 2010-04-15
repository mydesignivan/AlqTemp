<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="span-24 last">
    <div class="header-col-left">
        <a href="<?=$this->config->item('base_url');?>" class="logo"><img src="images/logo_alquilerestemp.png" alt="AlquileresTemporarios.org" /></a>
    </div>

    <div class="header-col-right">
        <div class="header-top">

            <!-- =============== LINKS HEADER TOP =============== -->
            <div class="column span-5 first">
                <a href="<?=site_url('/index/');?>" class="link-header"><img class="icon" src="images/icon_home.png" alt="" /> Inicio</a>
                <a href="<?=site_url('/contacto/');?>" class="link-header"><img class="icon" src="images/icon_contact.png" alt="" /> Contacto</a>
            </div>

            <?php require('header_login_inc.php');?>
            <!-- =============== END LINKS HEADER TOP =============== -->
        </div>
    </div>

    <!-- =============== MENU =============== -->
    <div class="menu-container2">
        <ul class="menu">
            <li><a class="menu-option" href="<?=site_url("/paneluser/micuenta/");?>">Mi Cuenta</a></li>
            <li><a class="menu-option" href="<?=site_url("/paneluser/propiedades/");?>">Propiedades</a></li>
            <?php if( $this->session->userdata('username')=="ivan"||$this->session->userdata('username')=="difiesta"||$this->session->userdata('username')=="jbasez" ){?>
            <li><a class="menu-option" href="<?=site_url("/paneluser/destacar/");?>">Destacar</a></li>
            <li><a class="menu-option" href="<?=site_url("/paneluser/cuentaplus/");?>">Cuenta Plus</a></li>
            <li><a class="menu-option" href="<?=site_url("/paneluser/agregarfondos/");?>">Agregar Fondos</a></li>
            <?php }?>
        </ul>
    </div>
    <!-- =============== END MENU =============== -->
</div>
