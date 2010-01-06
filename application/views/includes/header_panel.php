    <div class="top_left">
        <div class="top_menu">
            <ul>
                <li><a href="index.php"><img src="images/icono_inicio.png" alt="inicio" border="0" /> Inicio</a></li>
                <li><a href="contacto.php"><img src="images/icono_contacto.png" alt="contacto" border="0" />Contacto</a></li>
            </ul>
        </div>
        <div class="logo"><img src="images/logo_alquilerestemp.png" alt="www.alquilerestemporarios.org" border="0" /> </div>
    </div>

    <div class="top_right">
        <div class="registro">
            <span>Usuario:</span><?=$this->session->userdata('name');?><a href="<?=site_url('/login/logout/');?>">&nbsp;&nbsp;&nbsp;<img src="images/icon_exit.png" alt="Salir" /> Salir</a>
        </div>
    </div>

    <div class="column_panel">
        <div class="menu_panel">
            <ul>
                <li><a href="#">Propiedades</a></li>
                <li><a href="#">Servicios Premium</a></li>
                <li><a href="mi_cuenta.php">Mi Cuenta</a></li>
                <li><a href="comprar_creditos.php">Comprar Creditos</a></li>
            </ul>
        </div>
    </div>
