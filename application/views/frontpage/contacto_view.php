<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php if( $this->session->flashdata('statusmail')=="ok" ){?>

            <div class="form-contact-message">
                <p>Muchas gracias por comunicarse,</p>
                <p>En breve estaremos en contacto.</p>
            </div>
<?php }else{?>
            <div class="form-contact">

                <form id="formContact" action="<?=site_url('/contacto/send');?>" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="span-7">
                        <div class="span-7">
                            <label class="label-form">*Nombre:</label><br />
                            <input type="text" class="input-form validate" name="txtName" />
                        </div>
                        <div class="clear span-7">
                            <label class="label-form">*Email:</label><br />
                            <input type="text" class="input-form validate" name="txtEmail" />
                        </div>
                    </div>
                    <div class="span-6">
                        <div class="span-6">
                            <label class="label-form">Tel&eacute;fono:</label><br />
                            <input type="text" class="input-form input" name="txtPhone" />
                        </div>
                        <div class="clear span-6">
                            <label class="label-form">Area de Consulta:</label><br />
                            <select name="cboArea" class="select-form">
                                <option value="jbasaez@mydesign.com.ar">Publicidad</option>
                                <option value="jbasaez@mydesign.com.ar">Consultas</option>
                            </select>
                        </div>
                    </div>
                    <div class="clear span-13">
                        <div class="span-13">
                            <label class="label-form">*Consulta:</label><br />
                            <textarea class="textarea-contact2 validate" name="txtConsult" rows="22" cols="6"></textarea>
                        </div>
                    </div>
                    <div class="clear span-13"><label class="label-legend">(*) Campos obligatorios</label></div>

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