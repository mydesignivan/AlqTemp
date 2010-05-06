<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

    <div class="float-left prepend-top-small2">
        <label class="label-user">Usuario:&nbsp;</label>
        <span class="text-small"><?=$this->session->userdata('username');?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <?php if( $this->session->userdata('level')==0 ){?>
        <a href="<?=site_url("/paneluser/micuenta/");?>" class="link2">(mi cuenta)</a>
    <?php }else{
            if( $this->uri->segment(1)!="paneladmin" ){?>
                <a href="<?=site_url("/paneladmin/index/");?>" class="link2">(Volver al panel)</a>
    <?php   }
          }?>
    </div>
    <div class="float-right append-right-small prepend-top-small2">
        <button type="button" class="button-small" onclick="location.href='<?=site_url('/login/logout/');?>';">Salir</button>
    </div>
