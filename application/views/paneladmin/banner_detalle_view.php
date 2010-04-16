<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="span-10 prepend-left-small">
    <div class="span-10">
        <label class="label-form float-left">*Nombre:</label>
        <input type="text" name="txtFirstName" class="input-form float-right validate" tabindex="3" value="<?=$info['firstname'];?>" />
    </div>
    <div class="span-10 clear">
        <label class="label-form float-left">*Apellido:</label>
        <input type="text" name="txtLastName" class="input-form float-right validate" tabindex="4" value="<?=$info['lastname'];?>" />
    </div>
    <div class="span-10 clear">
        <label class="label-form float-left">*Email:</label>
        <input type="text" name="txtEmail" class="input-form float-right validate" tabindex="5" value="<?=$info['email'];?>" />
    </div>
    <div class="span-10 clear">
        <label class="label-form float-left">Tel&eacute;fono:</label>
        <input type="text" name="txtPhone" class="input-phone float-right" tabindex="7" value="<?=$info['phone'];?>" />
        <input type="text" name="txtPhoneArea" class="input-phonearea float-right" tabindex="6" value="<?=$info['phone_area'];?>" />
    </div>
    <div class="span-10 clear">
        <label class="label-form float-left">*Usuario:</label>
        <input type="text" name="txtUser" class="input-form float-right validate" tabindex="8" value="<?=$info['username'];?>" disabled />
    </div>
    <div class="span-10 clear">
        <label class="label-form float-left">*Password:</label>
        <input type="password" name="txtPass" class="input-form float-right validate" tabindex="9" disabled />
    </div>
</div>

