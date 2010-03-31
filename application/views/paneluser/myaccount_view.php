            <div class="span-10 prepend-left-small">
                <form id="formAccount" action="<?=site_url('/paneluser/micuenta/edit');?>" method="post" enctype="application/x-www-form-urlencoded">
                    <p class="span-10">
                        <label class="label3 float-left">*Nombre:</label>
                        <input type="text" name="txtFirstName" class="input-form float-right validate" tabindex="1" value="<?=$info['firstname'];?>" />
                    </p>
                    <p class="span-10 clear">
                        <label class="label3 float-left">*Apellido:</label>
                        <input type="text" name="txtLastName" class="input-form float-right validate" tabindex="2" value="<?=$info['lastname'];?>" />
                    </p>
                    <p class="span-10 clear">
                        <label class="label3 float-left">*Email:</label>
                        <input type="text" name="txtEmail" class="input-form float-right validate" tabindex="3" value="<?=$info['email'];?>" />
                    </p>
                    <p class="span-10 clear">
                        <label class="label3 float-left">Tel&eacute;fono:</label>
                        <input type="text" name="txtPhone" class="input-phone float-right" tabindex="5" value="<?=$info['phone'];?>" />
                        <input type="text" name="txtPhoneArea" class="input-phonearea float-right" tabindex="4" value="<?=$info['phone_area'];?>" />
                    </p>
                    <p class="span-10 clear">
                        <label class="label3 float-left">*Usuario:</label>
                        <input type="text" name="txtUser" class="input-form float-right validate" tabindex="6" value="<?=$info['username'];?>" />
                    </p>
                    <p class="span-10 clear">
                        <label class="label3 float-left">*Password:</label>
                        <input type="password" name="txtPass" class="input-form float-right validate" tabindex="7" />
                    </p>
                    <p class="span-10 clear">
                        <label class="label3 float-left">*Repetir Contrase&ntilde;a:</label>
                        <input type="password" name="txtPass2" class="input-form float-right validate" tabindex="8" />
                    </p>

                    <div class="clear span-15 text-center prepend-top">
                        <button type="button" class="button-large" onclick="Account.save();">Guardar</button>
                    </div>

                    <div class="span-10 clear"><label class="label-legend">(*) Campo obligatorios</label></div>

                    <input type="hidden" name="user_id" value="<?=$info['user_id'];?>" />
                </form>
            </div>

            <div class="span-4 last prepend-1">
                <br /><br /><br />
                <label class="label-large">Saldo Disponible</label><br />
                <input type="text" class="input-saldo" value="U$S <?=$this->session->userdata('fondo');?>" onkeypress="return false;" />
            </div>

            <script type="text/javascript">
            <!--
                Account.initializer(true);
            -->
            </script>
