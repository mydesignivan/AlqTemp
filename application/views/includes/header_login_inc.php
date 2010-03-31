<?php
    $url = $this->session->userdata('level')==0 ? site_url("/paneluser/micuenta/") : site_url("/paneladmin/index/");
?>

        <div class="float-left">
            <label class="label-user">Usuario:&nbsp;</label>
            <span class="text-small"><?=$this->session->userdata('username');?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <a href="<?=$url;?>" class="link2">(mi cuenta)</a>
        </div>
        <div class="float-right append-right-small">
            <button type="button" class="button-small" onclick="location.href='<?=site_url('/login/logout/');?>';">Salir</button>
        </div>
