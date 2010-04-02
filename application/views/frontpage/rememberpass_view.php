            <form id="form1" action="<?=site_url('/recordarcontrasenia/send/');?>" method="post" enctype="application/x-www-form-urlencoded">
            <?php if( @$status=="ok" ){?>
                <p>Muy bien, le hemos enviado las instrucciones a su email. Reviselo!</p>
                <p>Usted puede mantener esta pagina abierta mientras chequea su email. Si usted no recibe las instrucciones en el transcurso de un minuto o dos pruebe <a href="javascript:$('#form1').submit();">Reenviar las instrucciones</a></p>
                <input type="hidden" name="txtField" value="<?=$field;?>" />

            <?php }else{?>
                <h2>¿Olvido su Contraseña?</h2>
                <p>AlquileresTemporarios.org le enviara las instrucciones para resetear su contrase&ntilde;a a la direcci&oacute;n de correo asociada a su cuenta.</p>
                <p>Por favor escriba su direcci&oacute;n de <b>email</b> o su <b>usuario</b> a continuaci&oacute;n.</p>
                <br />
                <p>
                    <label class="label-form float-left">Email / Usuario&nbsp;</label>
                    <input type="text" name="txtField" class="input-form float-left validate" />
                </p>

                <div class="span-15 text-center prepend-top">
                    <button type="button" class="button-small" onclick="RememberPass.send()">Enviar</button>
                </div>
            <?php }?>
            </form>

            <script type="text/javascript">
            <!--
                RememberPass.initializer('<?=@$status;?>');
            -->
            </script>
