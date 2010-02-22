<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/*
|--------------------------------------------------------------------------
| NOMBRE DE LAS TABLAS (BASE DE DATO)
|--------------------------------------------------------------------------
*/
define('TBL_IMAGES', 'images');
define('TBL_COUNTRY', 'list_country');
define('TBL_STATES', 'list_states');
define('TBL_SERVICES', 'list_services');
define('TBL_PROPERTIES', 'properties');
define('TBL_PROPERTIES_SERVS', 'properties_to_services');
define('TBL_PROPERTIES_DISTING', 'properties_disting');
define('TBL_USERS', 'users');
define('TBL_LOGSEARCHES', 'log_searches');


/*
|--------------------------------------------------------------------------
| MENSAJES DE ERROR
|--------------------------------------------------------------------------
*/
define('ERR_100', 'Se produjo un error interno en la base de dato.');
define('ERR_101', 'La actualizacion de los datos no pudo ser completado.');
define('ERR_102', 'Los datos no pudieron ser guardados.');
define('ERR_103', 'El usuario ha sido creado satisfactoriamente pero no se ha podido enviar el email de activaci&oacute;n del mismo');

define('ERR_UPLOAD_NOTUPLOAD', 'El archivo no ha podido llegar al servidor.');
define('ERR_UPLOAD_MAXSIZE', 'El tamaño del archivo debe ser menor a %s MB.');
define('ERR_UPLOAD_FILETYPE', 'El tipo de archivo es incompatible.');

define('ERR_DB_UPDATE', 'Ha ocurrido un error al tratar de actualizar la tabla "%s".');
define('ERR_DB_INSERT', 'Ha ocurrido un error al tratar de insertar datos en la tabla "%s".');
define('ERR_DB_DELETE', 'Ha ocurrido un error al tratar de eliminar datos en la tabla "%s".');

define('ERR_PROP_CREATE', 'La propiedad no pudo ser guardada. Si el error coninua por favor, comuniquelo al administrador del sitio.');
define('ERR_PROP_EDIT',   'La propiedad no pudo ser modificada. Si el error coninua por favor, comuniquelo al administrador del sitio.');
define('ERR_PROP_DELETE', 'La propiedad no pudo ser eliminada. Si el error coninua por favor, comuniquelo al administrador del sitio.');
define('ERR_PROP_COPY_FAILD', 'La imagen %s no se pudo copiar.');
define('ERR_PROP_IMAGE_NONEXISTENT', 'La imagen %s no existe.');

define('ERR_USER_EDIT',   'El usuario no pudo ser modificado. Si el error coninua por favor, comuniquelo al administrador del sitio.');
define('ERR_USER_DELETE', 'El usuario no pudo ser eliminado. Si el error coninua por favor, comuniquelo al administrador del sitio.');


/*
|--------------------------------------------------------------------------
| EMAIL FORM REGISTRO
|--------------------------------------------------------------------------
*/
$msg = 'Hola, %s.<br /><br />';
$msg.= 'Por favor confirme su cuenta de AlquileresTemporarios.org haciendo click en este link:<br /><br />';
$msg.= '<a href="%s">%s</a><br /><br />';
$msg.= 'Una vez confirmado, usted tendra acceso completo a AlquileresTemporarios.org y todas las notificaciones futuras seran enviadas a esta cuenta de email.<br /><br />';
$msg.= 'Muchas Gracias!<br />AlquileresTemporarios.org';

define('EMAIL_REG_FROM', 'no-reply@alquilerestemporarios.org');
define('EMAIL_REG_NAME', 'AlquileresTemporarios.org');
define('EMAIL_REG_SUBJECT', 'Confirme su cuenta de AlquileresTemporarios.org');
define('EMAIL_REG_MESSAGE', $msg);

/*
|--------------------------------------------------------------------------
| EMAIL FORM REGISTRO DE ACTIVACION
|--------------------------------------------------------------------------
*/
$msg = 'Hola, %s.<br /><br />';
$msg.= 'Gracias por registrarte en AlquileresTemporarios.org.<br /><br />';
$msg.= 'Tus datos de registro son:<br />';
$msg.= 'Usuario: %s<br />';
$msg.= 'Contrase&ntilde;a: %s<br /><br />';
$msg.= 'Atentamente,<br />';
$msg.= 'AlquileresTemporarios.org';

define('EMAIL_REGACTIVE_FROM', 'no-reply@alquilerestemporarios.org');
define('EMAIL_REGACTIVE_NAME', 'AlquileresTemporarios.org');
define('EMAIL_REGACTIVE_SUBJECT', 'Bienvenido a AlquileresTemporarios.org');
define('EMAIL_REGACTIVE_MESSAGE', $msg);

/*
|--------------------------------------------------------------------------
| EMAIL RECORDAR CONTRASEÑA
|--------------------------------------------------------------------------
*/
$msg = "Hola!<br /><br />";
$msg.= "¿No recuerda su contrase&ntilde;a?<br />";
$msg.= "Puede sucederle a cualquiera.<br /><br />";
$msg.= "Por favor abra este link en su navegador:<br /><br />";
$msg.= '<a href="%s">%s</a><br /><br />';
$msg.= 'Esto resetear&aacute; su contrase&ntilde;a<br />';
$msg.= 'Usted puede luego ingresar y cambiarla por alguna que recuerde.<br /><br />';
$msg.= 'Atentamente,<br />';
$msg.= 'AlquileresTemporarios.org';

define('EMAIL_RP_FROM', 'no-reply@alquilerestemporario.org');
define('EMAIL_RP_NAME', 'AlquileresTemporarios.org');
define('EMAIL_RP_SUBJECT', 'Resetear su contraseña de AlquileresTemporarios.org');
define('EMAIL_RP_MESSAGE', $msg);

/*
|--------------------------------------------------------------------------
| EMAIL FORMULARIO CONSULTA DE LA PROP
|--------------------------------------------------------------------------
*/
define('EMAIL_CONSULTPROP_SUBJECT', 'Consulta propiedad');
define('EMAIL_CONSULTPROP_MESSAGE', 'Propiedad: %s<br>Nombre persona: %s<br>Telefono: %s<br>Consulta:<hr color="#000000" />%s');

/*
|--------------------------------------------------------------------------
| EMAIL CONTACTO
|--------------------------------------------------------------------------
*/
define('EMAIL_CONTACT_TO', 'ivan@mydesign.com.ar');
define('EMAIL_CONTACT_SUBJECT', 'Formulario de consulta');
define('EMAIL_CONTACT_MESSAGE', 'Nombre: %s<br>Telefono: %s<br>Consulta:<hr color="#000000" />%s');

/*
|--------------------------------------------------------------------------
| EMAIL COMPRAR CREDITO
|--------------------------------------------------------------------------
*/
define('EMAIL_BUYCREDIT_FROM', 'ivan@mydesign.com.ar');
define('EMAIL_BUYCREDIT_TO', 'ivan@mydesign.com.ar');
define('EMAIL_BUYCREDIT_SUBJECT', 'Pedido');
define('EMAIL_BUYCREDIT_MESSAGE', '<b>Nombre:</b> %s<hr color="#000000" /><b>Telefono:</b> %s<hr color="#000000" /><b>Email:</b> %s<hr color="#000000" /><b>Forma de Pago:</b> %s<hr color="#000000" /><b>Importe:</b> U$S %s<hr color="#000000" /><b>Total Credito</b> %s');


/*
|--------------------------------------------------------------------------
| UPLOAD FILE
|--------------------------------------------------------------------------
*/
define('UPLOAD_DIR', './uploads/');
define('UPLOAD_DIR_TMP', './uploads/tmp/');
define('UPLOAD_FILETYPE', 'gif|jpg|png');
define('UPLOAD_MAXSIZE', 1024); //Expresado en Kylobytes

define('IMAGE_THUMB_WIDTH', 107);
define('IMAGE_THUMB_HEIGHT', 90);
define('IMAGE_ORIGINAL_WIDTH', 800);
define('IMAGE_ORIGINAL_HEIGHT', 600);


/*
|--------------------------------------------------------------------------
| CONFIG
|--------------------------------------------------------------------------
*/
define('CREDIT_VALUE', 3);
define('DISTPROP_CREDIT', 3);
define('DISTPROP_MONTH', 1);





/* End of file constants.php */
/* Location: ./system/application/config/constants.php */