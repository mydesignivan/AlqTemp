<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="span-24 last">
    <div class="header-col-left">
        <a href="<?=$this->config->item('base_url');?>" class="logo"><img src="images/logo_alquilerestemp.png" alt="AlquileresTemporarios.org" width="257" height="107" /></a>
    </div>

    <div class="header-col-right">
        <div class="header-top">

            <!-- =============== LINKS HEADER TOP =============== -->
            <div class="column span-5 first">
                <a href="<?=site_url('/index/');?>" class="link-header"><img class="icon" src="images/icon_home.png" alt="" width="22" height="20" /> Inicio</a>
                <a href="<?=site_url('/contacto/');?>" class="link-header"><img class="icon" src="images/icon_contact.png" alt="" width="16" height="16" /> Contacto</a>
            </div>

            <?php require('header_login_inc.php');?>
            <!-- =============== END LINKS HEADER TOP =============== -->
        </div>
    </div>

    <!-- =============== MENU =============== -->
    <div class="menu-container2">
        <ul class="menu">
            <li><a class="menu-option" href="<?=site_url("/paneladmin/index/");?>">Informaci&oacute;n</a></li>
            <li><a class="menu-option" href="<?=site_url("/paneladmin/propiedades/");?>">Propiedades</a></li>
            <li><a class="menu-option" href="<?=site_url("/paneladmin/usuarios/");?>">Usuarios</a></li>
            <li><a class="menu-option" href="<?=site_url("/paneladmin/destacados/");?>">Destacados</a></li>
            <li><a class="menu-option" href="<?=site_url("/paneladmin/pedidos/");?>">Pedidos</a></li>
            <li><a class="menu-option" href="<?=site_url("/paneladmin/banner/");?>">Banner</a></li>
            <li><a class="menu-option" href="<?=site_url("/paneladmin/setup/");?>">Configuraci&oacute;n</a></li>
            <li><a class="menu-option" href="<?=site_url("/paneladmin/log/");?>">Mensajes Error</a></li>
        </ul>
    </div>
    <!-- =============== END MENU =============== -->
</div>
