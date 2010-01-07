<div class="top_left">
        <div class="top_menu">
            <ul>
                <li><a href="<?=site_url('/');?>"><img src="images/icono_inicio.png" alt="inicio" /> Inicio</a></li>
                <li><a href="<?=site_url('/contacto/');?>"><img src="images/icono_contacto.png" alt="contacto" />Contacto</a></li>
            </ul>
        </div>
        <div class="logo"><img src="images/logo_alquilerestemp.png" alt="www.alquilerestemporarios.org" border="0" /></div>
    </div>

    <div class="top_right">
        <div class="registro">
            <?php if( !$this->session->userdata('logged_in') ){?>
                <form name="formLogin" id="formLogin" action="<?=site_url('/login/');?>" enctype="application/x-www-form-urlencoded" method="post" onsubmit="return Login.validate();">
                    <div class="float-left"><input type="text" name="txtLoginUser" id="txtLoginUser" value="Usuario" class="input_login float-left validate {v_required : true}" onfocus="clear_input(event)" onblur="set_input(event, 'Usuario')" /></div>
                    <div class="float-left"><input type="text" name="txtLoginPass" id="txtLoginPass" value="Contrase&ntilde;a" class="input_login float-left validate {v_required : true}" onfocus="clear_input(event, 1)" onblur="set_input(event, 'Contrase&ntilde;a', 1)" /></div>
                    <input type="submit" id="btnLogin" value="login" class="login" />
                    <input type="hidden" name="action" value="login" />
                </form>

            <?php }else{?>

                <span>Usuario:</span><?=$this->session->userdata('name');?>
                &nbsp;&nbsp;<a href="<?=site_url('/myaccount/');?>">(mi cuenta)</a>
                <a href="<?=site_url('/login/logout/');?>">&nbsp;&nbsp;&nbsp;<img src="images/icon_exit.png" alt="Salir" /> Salir</a>
            <?php }?>
        </div>
        <div class="banner_top_cuadrado"><h1>Espacio para publicitar</h1></div>
    </div>
    <div class="search">
        <div class="search_top">
            <div class="img_search"><img src="images/icono_buscar.png" alt="buscar" border="0" /></div>
            <div class="div1">Buscador:&nbsp;<input type="text" class="input"/></div>
            <a href="#">Buscar</a>
        </div>
        <form name="formSearch" action="" method="post">
            <div class="search_left">
                <select name="cboCountry" class="select1" onchange="Search.show_states(this);">
                    <option value="0">Paises</option>
                    <?php get_options_country();?>
                </select>
                <br />
                <select name="cboState" class="select1" onchange="Search.show_city(this);">
                    <option value="0">Estados / Provincias</option>
                </select>
            </div>
            <div class="search_right">
                <select name="cboCity" class="select1">
                    <option value="0">Ciudades</option>
                </select>
                <br />
                <select name="cboCategory" class="select1">
                    <option value="0">Categor&iacute;as</option>
                    <option value="">Casas</option>
                    <option value="">Caba&ntilde;as</option>
                    <option value="">Departamentos</option>
                    <option value="">Otros</option>
                </select>
            </div>
        </form>
    </div>
    <div class="column1">
        <div class="main_menu">
            <ul>
                <li><a class="menu-option" href="#">Casas</a></li>
                <li><a class="menu-option" href="#">Departamentos</a></li>
                <li><a class="menu-option" href="#">Cabañas</a></li>
                <li><a class="menu-option" href="#">Otros</a></li>
            </ul>
        </div>
        <div class="banner_top_horizontal"><h1>Espacio para publicitar</h1></div>

        <?php $url = !$this->session->userdata('logged_in') ? site_url('/registro/') : site_url('/prop/form/');?>

        <div class="button_publicar"><a href="<?=$url;?>"><img src="images/button_publique_gratis.png" alt="publique gratis" border="0" onmouseover="this.src='images/button_publique_gratis_over.png'" onmouseout="this.src='images/button_publique_gratis.png'" /></a></div>
    </div>
