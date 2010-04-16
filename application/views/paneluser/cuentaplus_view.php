<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php if( $this->session->userdata('username')=="ivan" ){?>


<?php if( $this->session->userdata('fondo')==0 ){?>
                <div class="notice">Usted no posee saldo suficiente para adquirir esta cuenta plus, para realizar esta operaci&oacute;n tiene que agregar fondos a su cuenta.</div>

<?php }else{
        if( !isset($action) ){
            if( !$this->session->flashdata('cp_status') ){?>

                <p class="text-destacado">
                    <b>"Canjee fondos</b> y podr&aacute; obtener su <b>CUENTA PLUS</b>
                    <br />permitiendole acceder a servicios adicionales<b>"</b>
                </p>
                <div class="message-rectangle">Algunos Beneficios de su CUENTA PLUS</div>

                <ul class="ul-list-cuentaplus">
                    <li>Cargar hasta <b>10 propiedades.</b></li>
                    <li>Agregar hasta <b>8 fotos por propiedad.</b></li>
                    <li>Ubicar su propiedad en un <b>mapa de google.</b></li>
                    <li class="sintip"><br /><b>y MUCHO M&Aacute;S!!!</b></li>
                </ul>

                <div class="text-center">
                    <img src="images/cuenta_plus.png" alt="Obtene tu CUENTA PLUS por solo U$S 100 ANUALES " />
                    <br /><br />
                    <button type="button" class="button-large">Obtener Cuenta</button>
                </div>

        <?php }elseif( $this->session->flashdata('cp_status')=="insufficient_amount" ){?>

                <div class="notice">Usted no posee saldo suficiente para adquirir esta cuenta plus, para realizar esta operaci&oacute;n tiene que agregar fondos a su cuenta.</div>

        <?php }elseif( $this->session->flashdata('cp_status')=="ok" ){?>
                <div class="notice">Gracias por adquirir una Cuenta Plus</div>

        <?php }
         }else{
              if( $action=="confirm_buy" && !$check_cuentaplus['result']){?>

                    <div class="text-destacado">
                        <p>Se va realizar una compra de la Cuenta Plus por un valor de U$S 100</p>
                        <p>¿Esta seguro de realizar esta compra?</p>
                        <br />
                        <button type="button" class="button-large" onclick="location.href='<?=site_url('/paneluser/cuentaplus/shipping/');?>';">Aceptar</button>&nbsp;&nbsp;&nbsp;
                        <button type="button" class="button-large" onclick="location.href='<?=site_url('/paneluser/cuentaplus/cancel/');?>';">Cancelar</button>
                    </div>

            <?php }elseif( $action=="confirm_buy" && $check_cuentaplus['result'] ){?>

                <div class="notice">Usted ya posee el servicio de cuenta plus hasta el <?=$check_cuentaplus['date'];?>. Si desea extender su plazo haga clic <a href="<?=site_url('/paneluser/cuentaplus/shipping/');?>" class="link">aqu&iacute;</a></div>

            <?php }elseif( $action=="cancel" ){?>

                    <div class="text-destacado">
                        <p>La compra de la Cuenta Plus ha sido cancelada</p><br />
                        <p><a href="<?=site_url('/index/');?>" class="link">Volver al Home</a></p>
                    </div>

            <?php }
         }
}?>

<?php }else{?>

    <p class="text-destacado">
        <br />
        <br />
        <br />
        <b>Este servicio aun no se encuentra habilitado</b>
    </p>


<?php }?>
