<div class="top_left">
        <div class="top_menu">
            <ul>
                <li><a href="<?=site_url('/');?>"><img src="images/icono_inicio.png" alt="inicio" /> Inicio</a></li>
                <li><a href="<?=site_url('/contacto/');?>"><img src="images/icono_contacto.png" alt="contacto" /> Contacto</a></li>
            </ul>
        </div>
        <div class="logo"><a href="<?=site_url('/');?>"><img src="images/logo_alquilerestemp.png" alt="www.alquilerestemporarios.org" /></a></div>
    </div>

    <div class="top_right">
        <div class="registro">
            <?php if( !$this->session->userdata('logged_in') ){?>
                <form name="formLogin" id="formLogin" action="<?=site_url('/login/');?>" enctype="application/x-www-form-urlencoded" method="post" onsubmit="return Login.validate();">
                    <div class="float-left"><input type="text" name="txtLoginUser" id="txtLoginUser" value="Usuario" class="input_login float-left validate {v_required : true}" onfocus="clear_input(event)" onblur="set_input(event, 'Usuario')" /></div>
                    <div class="float-left"><input type="text" name="txtLoginPass" id="txtLoginPass" value="Contrase&ntilde;a" class="input_login float-left validate {v_required : true}" onfocus="clear_input(event, 1)" onblur="set_input(event, 'Contrase&ntilde;a', 1)" /></div>
                    <div class="float-left"><input type="submit" id="btnLogin" value="login" class="login float-left" /></div>
                    <div class="float-left"><a href="<?=site_url('/rememberpass/');?>"> &iquest;Olvido su contrase&ntilde;a?</a></div>
                </form>

            <?php }else{?>

                <span>Usuario:</span><?=$this->session->userdata('name');?>
                &nbsp;&nbsp;<a href="<?=site_url('/myaccount/');?>">(mi cuenta)</a>
                <a href="<?=site_url('/login/logout/');?>">&nbsp;&nbsp;&nbsp;<img src="images/icon_exit.png" alt="Salir" /> Salir</a>
            <?php }?>
        </div>
        <!--<div class="banner_top_cuadrado"><h1>Espacio para publicitar</h1></div>-->
    </div>
    <div class="search">
        <form name="formSearch" action="" method="post">
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
                <li><a class="menu-option" href="<?=site_url("/search/index/category/1/page/0");?>">Casas</a></li>
                <li><a class="menu-option" href="<?=site_url("/search/index/category/2/page/0");?>">Departamentos</a></li>
                <li><a class="menu-option" href="<?=site_url("/search/index/category/3/page/0");?>">Cabañas</a></li>
                <li><a class="menu-option" href="<?=site_url("/search/index/category/4/page/0");?>">Otros</a></li>
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
