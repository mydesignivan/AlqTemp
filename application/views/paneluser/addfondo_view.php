        <?php if( !isset($result_buy) ){?>
                <div class="message-attention"><div class="message">El fondo que adquiera a trav&eacute;s de nuestra web no ser&aacute; reembolsable y el mismo solo puede ser utilizado dentro de los servicios ofrecidos por <b>alquilerestemporarios.org</b></div></div>

                <form id="form1" action="<?=site_url('/paneluser/agregarfondos/send/');?>" class="prepend-top" method="post">
                    <div class="prepend-4">
                        <div class="span-5 first">
                            <label class="label-large">Saldo Disponible</label><br />
                            <input type="text" class="input-saldo" value="U$S <?=$this->session->userdata('fondo');?>" onkeypress="return false;" />
                        </div>
                        <div class="span-4 last">
                            <label class="label-large">Agregar Fondos</label><br />
                            <label class="label3">Importe&nbsp;</label>
                            <select name="cboImport" id="cboImport">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <input type="hidden" name="credit" />
                    </div>

                    <div class="span-15 last text-center">
                        <br />
                        <a href="javascript:void(Fondo.buy());"><img src="images/btn_buy.jpg" alt="Comprar" /></a>
                    </div>
                </form>

                <script type="text/javascript">
                <!--
                    Fondo.initializer();
                -->
                </script>

        <?php }elseif( @$result_buy=="success" ){?>
                <div class="notice">La compra ha sido realizada con &eacute;xito.</div>

        <?php }elseif( @$result_buy=="cancel" ){?>
                <div class="notice">La compra ha sido cancelada.</div>
        <?php }?>
