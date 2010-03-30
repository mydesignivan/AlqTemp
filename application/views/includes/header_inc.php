<div class="span-24 last">
    <div class="header-col-left">
        <a href="http://www.alquilerestemporarios.org" class="logo"><img src="images/logo_alquilerestemp.png" alt="AlquileresTemporarios.org" /></a>
    </div>

    <div class="header-col-right">
        <div class="header-top">

            <!-- =============== LINKS HEADER TOP =============== -->
            <div class="column span-5 first">
                <a href="<?=site_url('/index/');?>" class="link1"><img src="images/icon_home.png" alt="" /> Inicio</a>
                <a href="<?=site_url('/contacto/');?>" class="link1"><img src="images/icon_contact.png" alt="" /> Contacto</a>
            </div>

    <?php if( !$this->session->userdata('logged_in') ){?>
            <div class="column prepend-1">
                <a href="<?=site_url('/registro/');?>" onmouseover="this.firstChild.src='images/btn_register_over.png'" onmouseout="this.firstChild.src='images/btn_register.png'"><img src="images/btn_register.png" alt="Registrarse" /></a>
            </div>

    <?php }else{?>

            <div class="float-left">
                <label class="label-user">Usuario:&nbsp;</label>
                <span class="text-small"><?=$this->session->userdata('name');?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <a href="<?=site_url('/panel/micuenta/');?>" class="link2">(mi cuenta)</a>
            </div>
            <div class="float-right append-right-small">
                <button type="button" class="button-small" onclick="location.href='<?=site_url('/login/logout/');?>';">Salir</button>
            </div>
    <?php }?>
            <!-- =============== END LINKS HEADER TOP =============== -->

            <!-- =============== LOGIN =============== -->
    <?php if( !$this->session->userdata('logged_in') ){?>
            <div class="column span-2 float-right">
                <a href="javascript:Login.open_dialog();" id="buttonLogin" class="link-signin">Login</a>
                <div id="login-container" class="form-login">
                    <a href="javascript:Login.close_dialog();" class="btn-login">Login</a>
                    <form id="formLogin" class="form" action="<?=site_url('/login/');?>" enctype="application/x-www-form-urlencoded" method="post">
                        <p>
                            <label for="txtLoginUser" class="label-login">Usuario</label><br />
                            <input type="text" name="txtLoginUser" id="txtLoginUser" class="input-login validate" value="" />
                        </p>
                        <p>
                            <label for="txtLoginPass" class="label-login">Contrase&ntilde;a</label><br />
                            <input type="password" name="txtLoginPass" id="txtLoginPass" class="input-login validate" value="" />
                        </p>
                        <p><button type="submit" value="Entrar" class="button-login">Entrar</button></p>
                        <p><a href="<?=site_url('/recordarcontrasenia/');?>" class="link2">¿Olvido su Contraseña?</a></p>
                    </form>
                    <div id="login-error"></div>
                </div>
            </div>

            <script type="text/javascript">
            <!--
                Login.initializer('<?=$this->session->flashdata('message_login')?>');
            -->
            </script>

    <?php }?>
            <!-- =============== END LOGIN =============== -->
        </div>
    </div>

    <!-- =============== SEARCH =============== -->
    <div class="clear search">
        <form id="formSearch" action="<?=site_url("/index/result/");?>" method="post" enctype="application/x-www-form-urlencoded">
            <div class="row1">
                <label class="label-search">Buscador&nbsp;</label>
                <div class="cont-input"><img src="images/icon_search.png" alt="" class="float-left" /><input type="text" class="i1" name="txtSearch" value="<?=@$_POST["txtSearch"];?>" onkeypress="if(getKeyCode(event)==13) $('#formSearch').submit();" /></div>
                <button type="submit" class="button-small">Buscar</button>
            </div>
            <div class="row2">
                <div class="span-4">
                    <?=form_dropdown('cboCountry', $comboCountry, @$_POST["cboCountry"], 'class="select-search" title="Pa&iacute;ses"');?><br />
                    <?=form_dropdown('cboStates', $comboStates, @$_POST["cboStates"], 'class="select-search" title="Estados / Provincias"');?>
                </div>
                <div class="span-4 last">
                    <?=form_dropdown('cboCity', $comboCity, @$_POST['cboCity'], 'class="select-search" title="Ciudades"');?><br />
                    <?=form_dropdown('cboCategory', $comboCategory, @$_POST['cboCategory'], 'class="select-search" title="Cetegor&iacute;as"');?>
                </div>
            </div>
        </form>
    </div>
    <!-- =============== END SEARCH =============== -->


    <!-- =============== MENU =============== -->
    <div class="menu-container">
        <ul class="menu">
            <li><a class="menu-option" href="<?=site_url("/index/casas/");?>">Casas</a></li>
            <li><a class="menu-option" href="<?=site_url("/index/departamentos/");?>">Departamentos</a></li>
            <li><a class="menu-option" href="<?=site_url("/index/cabanias/");?>">Cabañas</a></li>
            <li><a class="menu-option" href="<?=site_url("/index/otros/");?>">Otros</a></li>
        </ul>
    </div>
    <!-- =============== END MENU =============== -->

    <!-- =============== BANNER HORIZONTAL =============== -->
    <?php require('banner_horizontal_inc.php');?>
    <!-- =============== END BANNER HORIZONTAL =============== -->
    <div class="header-publique">
        <?php $url = !$this->session->userdata('logged_in') ? site_url('/registro/') : site_url('/panel/propiedades/form/');?>
        <a href="<?=$url;?>"><img src="images/btn_publique_gratis.png" alt="publique gratis" onmouseover="this.src='images/btn_publique_gratis_over.png'" onmouseout="this.src='images/btn_publique_gratis.png'" /></a>
    </div>
</div>
