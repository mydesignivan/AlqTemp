    <div class="float-left">
        <fieldset class="fieldset-information">
            <legend>Info. Usuarios</legend>

            <p><label class="label-form">Cant. registrados en el dia de hoy:</label> <?=$info['user']['count_user_day'];?></p>
            <p><label class="label-form">Cant. con Cuenta Plus:</label> <?=$info['user']['count_cuentaplus'];?></p>
            <p><label class="label-form">Usuarios logeados:</label> <?=$info['user']['total_users_online'];?></p>
            <p><label class="label-form">Usuarios registrados:</label> <?=$info['user']['total_users'];?></p>
        </fieldset>
        <fieldset class="fieldset-information">
            <legend>Info. Propiedades</legend>

            <p><label class="label-form">Cant. prop. nuevas en el dia de hoy:</label> <?=$info['prop']['count_prop_day'];?></p>
            <p><label class="label-form">Total de propiedades:</label> <?=$info['prop']['total_prop'];?></p>
        </fieldset>
    </div>

    <p class="clear text-center">
        <br />
        <button type="button" class="button-large" onclick="location.reload(true)">Refrescar</button>
    </p>
