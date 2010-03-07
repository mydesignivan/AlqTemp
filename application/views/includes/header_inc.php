    <!--<div id="message-login"></div>-->

    <div class="top_left">
        <div class="logo"><a href="<?=site_url('/index/');?>"><img src="images/logo_alquilerestemp.png" alt="www.alquilerestemporarios.org" /></a></div>
    </div>

    <div class="top_right">
        <div class="registro">
            <div class="header-menu-cell1">
                <a href="<?=site_url('/index/');?>" class="link2"><img src="images/icono_inicio.png" alt="" /> Inicio</a>
                <a href="<?=site_url('/contacto/');?>" class="link2"><img src="images/icono_contacto.png" alt="" /> Contacto</a>
            </div>

            <?php if( !$this->session->userdata('logged_in') ){?>
            <div class="header-menu-cell2">
                <a href="<?=site_url('/registro/');?>" class="link-register" onmouseover="this.firstChild.src='images/button_registrarse2_over.png'" onmouseout="this.firstChild.src='images/button_registrarse2.png'"><img src="images/button_registrarse2.png" alt="Registrarse" /></a>
            </div>
            <div id="login-container">
                <a href="javascript:Login.open_dialog();" class="signin">Login</a>
                <div class="container-form">
                    <a href="javascript:Login.close_dialog();" class="signup">Login</a>
                    <form id="formLogin" action="<?=site_url('/login/');?>" enctype="application/x-www-form-urlencoded" method="post">
                        <div class="row">
                            <span class="title1">Usuario</span><br />
                            <input type="text" name="txtLoginUser" id="txtLoginUser" value="" class="input_login float-left validate" />
                        </div>
                        <div class="row">
                            <span class="title1">Contrase&ntilde;a</span><br />
                            <input type="password" name="txtLoginPass" id="txtLoginPass" value="" class="input_login float-left validate" />
                        </div>
                        <div class="row"><input type="submit" id="btnLogin" value="Entrar" class="button-enter-login" /></div>
                        <div class="row"><a href="<?=site_url('/recordarcontrasenia/');?>" class="link3">¿Olvido su Contraseña?</a></div>
                    </form>

                    <div id="login-error"></div>
                </div>
            </div>

            <script type="text/javascript">
            <!--
             <?php
                if( $this->session->flashdata('statusLogin') ) {
                    switch($this->session->flashdata('statusLogin')){
                        case "loginfaild":
                            $message = "El usuario y/o password son incorrectos.";
                        break;
                        case "userinactive":
                            $message = "El usuario no esta activado.";
                        break;
                    }
                    echo 'var login_message = "'.$message.'";';
                }
             ?>
                Login.initializer();
            -->
            </script>


            <?php }else{?>
            <div class="header-menu-cell3">
                <span class="title2">Usuario:&nbsp;</span><span class="title1"><?=$this->session->userdata('name');?></span>
            </div>
            <div class="header-menu-cell3">
                <a href="<?=site_url('/panel/micuenta/');?>" class="link3">(mi cuenta)</a>
            </div>
            <div class="header-menu-salir">
                <a href="<?=site_url('/login/logout/');?>" class="button1">Salir</a>
            </div>
            <?php }?>
            
            
        </div>
        <!--<div class="banner_top_cuadrado"><h1>Espacio para publicitar</h1></div>-->
    </div>
    <div class="search">
        <form id="formSearch" action="<?=site_url("/index/result/");?>" method="post">
            <div class="search_top">
                <div class="img_search"><img src="images/icono_buscar.png" alt="buscar" border="0" /></div>
                <div class="div1">Buscador:&nbsp;<input type="text" class="input" name="txtSearch" value="<?=@$_POST["txtSearch"];?>" onkeypress="if(getKeyCode(event)==13) $('#formSearch').submit();" /></div>
                <a href="javascript:$('#formSearch').submit();" class="button1">Buscar</a>
            </div>
            <div class="search_left">
                <?=form_dropdown('cboCountry', $comboCountry, @$_POST["cboCountry"], 'class="select1" title="Pa&iacute;ses"');?>
                <br />
                <?=form_dropdown('cboStates', $comboStates, @$_POST["cboStates"], 'class="select1" title="Estados / Provincias"');?>
            </div>
            <div class="search_right">
                <?=form_dropdown('cboCity', $comboCity, @$_POST['cboCity'], 'class="select1" title="Ciudades"');?>
                <br />
                <?=form_dropdown('cboCategory', $comboCategory, @$_POST['cboCategory'], 'class="select1" title="Cetegor&iacute;as"');?>
            </div>
        </form>
    </div>
    <div class="column1">
        <div class="main_menu">
            <ul>
                <li><a class="menu-option" href="<?=site_url("/index/casas/");?>">Casas</a></li>
                <li><a class="menu-option" href="<?=site_url("/index/departamentos/");?>">Departamentos</a></li>
                <li><a class="menu-option" href="<?=site_url("/index/cabanias/");?>">Cabañas</a></li>
                <li><a class="menu-option" href="<?=site_url("/index/otros/");?>">Otros</a></li>
            </ul>
        </div>

        <?php include('banner_horizontal_inc.php');?>

        <?php $url = !$this->session->userdata('logged_in') ? site_url('/registro/') : site_url('/panel/propiedades/form/');?>

        <div class="button_publicar"><a href="<?=$url;?>"><img src="images/button_publique_gratis.png" alt="publique gratis" border="0" onmouseover="this.src='images/button_publique_gratis_over.png'" onmouseout="this.src='images/button_publique_gratis.png'" /></a></div>
    </div>
