<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="span-24 last">
    <div class="header-col-left">
        <a href="<?=$this->config->item('base_url');?>" class="logo"><img src="images/logo_alquilerestemp.png" alt="AlquileresTemporarios.org" width="257" height="107" /></a>
    </div>

    <div class="header-col-right">
        <div class="header-top">

            <!-- =============== LINKS HEADER TOP =============== -->
            <div class="column span-5 first">
                <a href="<?=$this->config->item('base_url');?>" class="link-header"><img class="icon" src="images/icon_home.png" alt="" width="16" height="16" /> Inicio</a>
                <a href="<?=site_url('/contacto/');?>" class="link-header"><img class="icon" src="images/icon_contact.png" alt="" width="16" height="16" /> Contacto</a>
            </div>

    <?php if( !$this->session->userdata('logged_in') ){?>
            <div class="column prepend-1">
                <a href="<?=site_url('/registro/');?>" onmouseover="this.firstChild.src='images/btn_register_over.png'" onmouseout="this.firstChild.src='images/btn_register.png'"><img src="images/btn_register.png" alt="Registrarse" width="127" height="29" /></a>
            </div>

    <?php }else{

            require('header_login_inc.php');

          }?>
            <!-- =============== END LINKS HEADER TOP =============== -->

            <!-- =============== LOGIN =============== -->
    <?php if( !$this->session->userdata('logged_in') ){?>
            <div class="column span-2 float-right">
                <a href="javascript:Login.open_dialog();" id="buttonLogin" class="link-signin">Login</a>
                <div id="login-container" class="form-login">
                    <a href="javascript:Login.close_dialog();" class="btn-login">Login</a>
                    <form id="formLogin" class="form" action="<?=site_url('/login/');?>" enctype="application/x-www-form-urlencoded" method="post">
                        <div class="span-4">
                            <label for="txtLoginUser" class="label-login">Usuario</label><br />
                            <input type="text" name="txtLoginUser" id="txtLoginUser" class="input-login validate" value="" />
                        </div>
                        <div class="clear span-4">
                            <label for="txtLoginPass" class="label-login">Contrase&ntilde;a</label><br />
                            <input type="password" name="txtLoginPass" id="txtLoginPass" class="input-login validate" value="" />
                        </div>
                        <div class="clear span-4"><button type="submit" value="Entrar" class="button-login">Entrar</button></div>
                        <div class="clear"><a href="<?=site_url('/recordarcontrasenia/');?>" class="link2">¿Olvido su Contraseña?</a></div>
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
        <form id="formSearch" action="" enctype="application/x-www-form-urlencoded" onsubmit="return false;">
            <div class="row1">
                <label class="label-search">Buscador&nbsp;</label>
                <div class="cont-input"><img src="images/icon_search.png" alt="" class="float-left" width="22" height="22" /><input type="text" class="i1" name="search" value="<?=@$searcher["search"];?>" onkeypress="if(getKeyCode(event)==13) Searcher.search();" />
                </div>
                <button type="button" class="button-small" onclick="Searcher.search();">Buscar</button>
            </div>
            <div class="row2">
                <div class="span-4">
                    <?=form_dropdown('country', $comboCountry, @$searcher['country'], 'class="select-search" title="Pa&iacute;ses" onchange="Searcher.show_combo(this);"');?><br />
                    <?=form_dropdown('state', $comboStates, @$searcher['state'], 'class="select-search" title="Estados / Provincias" onchange="Searcher.show_combo(this);"');?>
                </div>
                <div class="span-4 last">
                    <?=form_dropdown('city', $comboCity, @$searcher['city'], 'class="select-search" title="Ciudades" onchange="Searcher.show_combo(this);"');?><br />
                    <?=form_dropdown('category', $comboCategory, @$searcher['category'], 'class="select-search" title="Cetegor&iacute;as" onchange="Searcher.show_combo(this);"');?>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
    <!--
        Searcher.initializer();
    -->
    </script>
    <!-- =============== END SEARCH =============== -->


    <!-- =============== MENU =============== -->
    <div class="menu-container">
        <ul class="menu">
            <li><a class="menu-option" href="<?=site_url("/casas/");?>">Casas</a></li>
            <li><a class="menu-option" href="<?=site_url("/departamentos/");?>">Departamentos</a></li>
            <li><a class="menu-option" href="<?=site_url("/cabanias/");?>">Cabañas</a></li>
            <li><a class="menu-option" href="<?=site_url("/otros/");?>">Otros</a></li>
        </ul>
    </div>
    <!-- =============== END MENU =============== -->

    <!-- =============== BANNER HORIZONTAL =============== -->
    <?php require('banner_horizontal_inc.php');?>
    <!-- =============== END BANNER HORIZONTAL =============== -->
    <div class="header-publique">
        <?php $url = !$this->session->userdata('logged_in') ? site_url('/registro/') : site_url('/paneluser/propiedades/form/');?>
        <a href="<?=$url;?>"><img src="images/btn_publique_gratis.png" alt="publique gratis" onmouseover="this.src='images/btn_publique_gratis_over.png'" onmouseout="this.src='images/btn_publique_gratis.png'" width="109" height="68" /></a>
    </div>
</div>
