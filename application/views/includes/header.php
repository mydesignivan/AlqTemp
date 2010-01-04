<div class="top_left">
        <div class="top_menu">
            <ul>
                <li><a href="index.php"><img src="images/icono_inicio.png" alt="inicio" /> Inicio</a></li>
                <li><a href="contacto.php"><img src="images/icono_contacto.png" alt="contacto" />Contacto</a></li>
            </ul>
        </div>
        <div class="logo"><img src="images/logo_alquilerestemp.png" alt="www.alquilerestemporarios.org" border="0" /></div>
    </div>

    <div class="top_right">
        <div class="registro">
            <form name="formLogin" id="formLogin" action="<?=site_url('/login/');?>" enctype="application/x-www-form-urlencoded" method="post">
                <div class="float-left"><input type="text" name="txtLoginUser" id="txtLoginUser" value="Usuario" class="input_login float-left validator {v_required : true}" onfocus="clear_input(event)" onblur="set_input(event, 'Usuario')" /></div>
                <div class="float-left"><input type="text" name="txtLoginPass" id="txtLoginPass" value="Contrase&ntilde;a" class="input_login float-left validator {v_required : true}" onfocus="clear_input(event, 1)" onblur="set_input(event, 'Contrase&ntilde;a', 1)" /></div>
                <input type="button" id="btnLogin" value="login" class="login" onclick="Login.login();" />
                <input type="hidden" name="action" value="login" />
            </form>
        </div>
        <div class="banner_top_cuadrado"><h1>Espacio para publicitar</h1></div>
    </div>
    <div class="search">
        <div class="search_top">
            <div class="img_search"><img src="images/icono_buscar.png" alt="buscar" border="0" /></div>
            <div class="div1">Buscador:&nbsp;<input type="text" class="input"/></div>
            <a href="#">Buscar</a>
        </div>
        <div class="search_left">
       	    <select name="pais"></select>
            <br />
            <select name="provincia"></select>
        </div>
        <div class="search_right">
            <select name="ciudad"></select>
            <br />
            <select name="departamento"></select>
        </div>
    </div>
    <div class="column1">
        <div class="main_menu">
            <ul class="sf-menu">
                <li>
                    <a class="menu-option" href="#">Casas</a>
                    <ul>
                        <li><a href="#">Casa1</a></li>
                        <li><a href="#">Casa2</a></li>
                        <li><a href="#">Casa3</a></li>
                        <li><a href="#">Casa4</a></li>
                    </ul>
                </li>
                <li><a class="menu-option" href="#">Departamentos</a></li>
                <li><a class="menu-option" href="#">Cabañas</a></li>
                <li><a class="menu-option" href="#">Otros</a></li>
            </ul>
        </div>
        <div class="banner_top_horizontal"><h1>Espacio para publicitar</h1></div>
        <div class="button_publicar"><a href="#"><img src="images/button_publique_gratis.png" alt="publique gratis" border="0" onmouseover="this.src='images/button_publique_gratis_over.png'" onmouseout="this.src='images/button_publique_gratis.png'" /></a></div>
    </div>
