    <!--<div id="message-login"></div>-->

    <div class="top_left">
        <div class="logo"><a href="<?=site_url('/');?>"><img src="images/logo_alquilerestemp.png" alt="www.alquilerestemporarios.org" /></a></div>
    </div>

    <div class="top_right">
        <div class="registro">
            <div class="header-menu-cell1">
                <a href="<?=site_url('/');?>" class="link2"><img src="images/icono_inicio.png" alt="" /> Inicio</a>
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
                        <div class="row"><a href="<?=site_url('/rememberpass/');?>" class="link3">¿Olvido su Contraseña?</a></div>
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
                <a href="<?=site_url('/micuenta/');?>" class="link3">(mi cuenta)</a>
            </div>
            <div class="header-menu-salir">
                <a href="<?=site_url('/login/logout/');?>" class="button1">Salir</a>
            </div>
            <?php }?>
            
            
        </div>
        <!--<div class="banner_top_cuadrado"><h1>Espacio para publicitar</h1></div>-->
    </div>
    <div class="search">
        <form id="formSearch" action="" method="post">
            <div class="search_top">
                <div class="img_search"><img src="images/icono_buscar.png" alt="buscar" border="0" /></div>
                <div class="div1">Buscador:&nbsp;<input type="text" class="input" name="txtSearch" value="<?=getval($_POST, "txtSearch");?>" onkeypress="javascript:if(getKeyCode(event)==13) Search.search();" /></div>
                <a href="#" class="button1" onclick="Search.search(); return false;">Buscar</a>
            </div>
            <div class="search_left">
                <select name="cboCountry" class="select1">
                    <option value="0">Paises</option>
                    <?php get_options_search_country(getval($_POST, "cboCountry"));?>
                </select>
                <br />
                <select name="cboStates" id="cboStates" class="select1">
                    <option value="0">Estados / Provincias</option>
                    <?php get_options_search_states(getval($_POST, "cboStates"));?>
                </select>
            </div>
            <div class="search_right">
                <select name="cboCity" id="cboCity" class="select1">
                    <option value="0">Ciudades</option>
                    <?php get_options_search_city(getval($_POST, "cboCity"));?>
                </select>
                <br />
                <select name="cboCategory" class="select1">
                    <option value="0">Categor&iacute;as</option>
                    <option value="1" <?php if( getval($_POST, "cboCategory")==1 ) echo 'selected="selected"';?>>Casas</option>
                    <option value="2" <?php if( getval($_POST, "cboCategory")==2 ) echo 'selected="selected"';?>>Caba&ntilde;as</option>
                    <option value="3" <?php if( getval($_POST, "cboCategory")==3 ) echo 'selected="selected"';?>>Departamentos</option>
                    <option value="4" <?php if( getval($_POST, "cboCategory")==4 ) echo 'selected="selected"';?>>Otros</option>
                </select>
            </div>
        </form>
    </div>
    <div class="column1">
        <div class="main_menu">
            <ul>
                <li><a class="menu-option" href="<?=site_url("/search/casas/");?>">Casas</a></li>
                <li><a class="menu-option" href="<?=site_url("/search/departamentos/");?>">Departamentos</a></li>
                <li><a class="menu-option" href="<?=site_url("/search/cabanias/");?>">Cabañas</a></li>
                <li><a class="menu-option" href="<?=site_url("/search/otros/");?>">Otros</a></li>
            </ul>
        </div>
        <div class="banner_top_horizontal">
            <script type="text/javascript">
            <!--
                google_ad_client = "pub-8532219450775915";
                /* 468x60, alqtemp */
                google_ad_slot = "6217707974";
                google_ad_width = 468;
                google_ad_height = 60;
            //-->
            </script>
            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
        </div>

        <?php $url = !$this->session->userdata('logged_in') ? site_url('/registro/') : site_url('/prop/form/');?>

        <div class="button_publicar"><a href="<?=$url;?>"><img src="images/button_publique_gratis.png" alt="publique gratis" border="0" onmouseover="this.src='images/button_publique_gratis_over.png'" onmouseout="this.src='images/button_publique_gratis.png'" /></a></div>
    </div>
