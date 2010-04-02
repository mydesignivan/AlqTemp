    <?php if( $this->session->flashdata('statusmail')=="ok" ){?>

                <div class="form-contact-message">
                    <p>Muchas gracias por comunicarse,</p>
                    <p>En breve estaremos en contacto.</p>
                </div>
    <?php }else{?>
                <div class="form-contact">

                    <form id="formContact" action="<?=site_url('/contacto/send');?>" method="post" enctype="application/x-www-form-urlencoded">
                        <div class="span-7">
                            <p>
                                <label class="label-form">*Nombre:</label><br />
                                <input type="text" class="input-contact2 validate" name="txtName" />
                            </p>
                            <p>
                                <label class="label-form">*Email:</label><br />
                                <input type="text" class="input-contact2 validate" name="txtEmail" />
                            </p>
                        </div>
                        <div class="span-6">
                            <p>
                                <label class="label-form">Tel&eacute;fono:</label><br />
                                <input type="text" class="input-contact2 input" name="txtPhone" />
                            </p>
                            <p>
                                <label class="label-form">Area de Consulta:</label><br />
                                <select name="cboArea" class="select-contact2">
                                    <option value="jbasaez@mydesign.com.ar">Publicidad</option>
                                    <option value="jbasaez@mydesign.com.ar">Consultas</option>
                                </select>
                            </p>
                        </div>
                        <div class="clear span-13">
                            <p>
                                <label class="label-form">*Consulta:</label><br />
                                <textarea class="textarea-contact2 validate" name="txtConsult" rows="22" cols="6"></textarea>
                            </p>
                        </div>
                        <div class="clear span-13">
                            <p class="clear"><label class="label-legend">(*) Campos obligatorios</label></p>
                        </div>

                        <div class="clear span-13 text-center">
                            <button type="button" class="button-small" onclick="Contact.send();">Enviar</button>
                        </div>
                    </form>
                </div>
                
                <script type="text/javascript">
                <!--
                    Contact.initializer();
                -->
                </script>
    <?php }?>