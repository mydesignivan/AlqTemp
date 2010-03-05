    <div class="top_left">
        <div class="logo"><a href="<?=site_url('/index/');?>" target="_blank"><img src="images/logo_alquilerestemp.png" alt="www.alquilerestemporarios.org" /></a></div>
    </div>

    <div class="top_right">
        <div class="registro">
            <div class="header-menu-cell1">
                <a href="<?=site_url('/index/');?>" class="link2"><img src="images/icono_inicio.png" alt="" /> Inicio</a>
                <a href="<?=site_url('/contacto/');?>" class="link2"><img src="images/icono_contacto.png" alt="" /> Contacto</a>
            </div>
            
            <div class="header-menu-cell3">
                <span class="title2">Admin:&nbsp;</span> <span class="title1"><?=$this->session->userdata('name');?></span>
            </div>
            <div class="header-menu-salir">
                <a href="<?=site_url('/login/logout/');?>" class="button1">Salir</a>
            </div>
        </div>
    </div>

    <div class="column_panel">
        <div class="menu_panel">
            <ul>
                <li><a href="<?=site_url('/paneladmin/informacion/');?>">Informacion</a></li>
                <li><a href="<?=site_url('/paneladmin/propiedades/');?>">Propiedades</a></li>
                <li><a href="<?=site_url('/paneladmin/usuarios/');?>">Usuarios</a></li>
                <li><a href="<?=site_url('/paneladmin/destacados/');?>">Destacados</a></li>
                <li><a href="<?=site_url('/paneladmin/fondos/');?>">Fondos</a></li>
                <li><a href="<?=site_url('/paneladmin/banner/');?>">Banner</a></li>
            </ul>
        </div>
    </div>
