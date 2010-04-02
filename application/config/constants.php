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
define('TBL_CATEGORY', 'list_category');
define('TBL_SERVICES', 'list_services');
define('TBL_PROPERTIES', 'properties');
define('TBL_PROPERTIES_SERVS', 'properties_to_services');
define('TBL_PROPERTIES_DISTING', 'properties_disting');
define('TBL_USERS', 'users');
define('TBL_LOGSEARCHES', 'log_searches');
define('TBL_CUENTAPLUS', 'cuentaplus');
define('TBL_USERSONLINE', 'users_online');


/*
|--------------------------------------------------------------------------
| MENSAJES DE ERROR
|--------------------------------------------------------------------------
*/
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

define('ERR_LOG_DELETE',     'Error al eliminar los log seleccionado(s)');
define('ERR_LOG_DELETE_LOG', 'Error al eliminar el archivo log "%s"');

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
$msg = "<b>Propiedad:</b> %s<br /><br />";
$msg.= "<b>Nombre:</b> %s<br /><br />";
$msg.= "<b>Telefono:</b> %s<br /><br />";
$msg.= '<b>Consulta:</b><hr color="#000000" />%s';

define('EMAIL_CONSULTPROP_SUBJECT', 'AlquileresTemporarios.org - Consulta Propiedad');
define('EMAIL_CONSULTPROP_MESSAGE', $msg);

/*
|--------------------------------------------------------------------------
| EMAIL CONTACTO
|--------------------------------------------------------------------------
*/
$msg = '<b>Nombre:</b> %s<br /><br />';
$msg.= '<b>Telefono:</b> %s<br /><br />';
$msg.= '<b>Consulta:</b><hr color="#000000" />%s';
define('EMAIL_CONTACT_SUBJECT', 'Formulario de Consulta');
define('EMAIL_CONTACT_MESSAGE', $msg);

/*
|--------------------------------------------------------------------------
| EMAIL AGREGAR FONDOS
|--------------------------------------------------------------------------
*/
define('EMAIL_BUYCREDIT_FROM', 'ivan@mydesign.com.ar');
define('EMAIL_BUYCREDIT_TO', 'ivan@mydesign.com.ar');
define('EMAIL_BUYCREDIT_SUBJECT', 'Pedido');
define('EMAIL_BUYCREDIT_MESSAGE', '<b>Nombre:</b> %s<hr color="#000000" /><b>Telefono:</b> %s<hr color="#000000" /><b>Email:</b> %s<hr color="#000000" /><b>Forma de Pago:</b> %s<hr color="#000000" /><b>Importe:</b> U$S %s<hr color="#000000" /><b>Total Credito</b> %s');

/*
|--------------------------------------------------------------------------
| EMAIL CUENTA PLUS
|--------------------------------------------------------------------------
*/
$msg = 'Hola %s<br /><br />

Tu cuenta plus ha sido activada!<br />
A partir de este momento puedes disfrutar de los beneficios que la misma te<br />
brinda como:<br />
%s<br /><br />

Mantente informado, ya que estaremos agregando cada vez mas servicios para que
puedas tener mas y mejores herramientas para manejar tus alquileres<br /><br />

Atte<br />
AlquileresTemporarios.org';

define('EMAIL_CUENTAPLUS_FROM', 'no-reply@alquilerestemporario.org');
define('EMAIL_CUENTAPLUS_NAME', 'AlquileresTemporarios.org');
define('EMAIL_CUENTAPLUS_SUBJECT', 'Gracias por adquirir nuestros servicios.');
define('EMAIL_CUENTAPLUS_MESSAGE', $msg);

/*
|--------------------------------------------------------------------------
| EMAIL AVISO DE VENCIMIENTO "CUENTA PLUS"
|--------------------------------------------------------------------------
*/
$msg = 'Hola %s<br /><br />

Tu cuenta plus esta por vencer.<br />
Para no perder tus beneficios, no olvides renovarla a traves de la secci&oacute;n<br />
"Cuenta Plus" en nuestra web o a traves de este <a href="%s">%s</a><br />

recuerda que la "Cuenta Plus" te permite:
-(listar lo que permite la cuenta plus)

Atte
AlquileresTemporarios.org';

define('EMAIL_VENC_CUENTAPLUS_FROM', 'no-reply@alquilerestemporario.org');
define('EMAIL_VENC_CUENTAPLUS_NAME', 'AlquileresTemporarios.org');
define('EMAIL_VENC_CUENTAPLUS_SUBJECT', 'Aviso de Vencimiento.');
define('EMAIL_VENC_CUENTAPLUS_MESSAGE', $msg);

/*
|--------------------------------------------------------------------------
| EMAIL AVISO DE VENCIMIENTO "PROPIEDAD"
|--------------------------------------------------------------------------
*/
$msg = 'Hola %s<br /><br />

El destaque de tu propiedad %s esta por vencer.<br />
Para no perder tu posicionamiento, no olvides renovar el destaque a traves de la<br />
seccion "Destacarme" en nuestra web o a traves de este <a href="%s">%s</a><br /><br />

Recuerda que el "Destacarme" te permite estar entre los primeros resultados de<br />
b&uacute;squeda y asi lograr tener una cantidad de visitas y consultas mucho mayor<br />
sobre tu alquiler<br /><br />

Atte<br />
AlquileresTemporarios.org';

define('EMAIL_VENC_PROP_FROM', 'no-reply@alquilerestemporario.org');
define('EMAIL_VENC_PROP_NAME', 'AlquileresTemporarios.org');
define('EMAIL_VENC_PROP_SUBJECT', 'Aviso de Vencimiento.');
define('EMAIL_VENC_PROP_MESSAGE', $msg);


/*
|--------------------------------------------------------------------------
| EMAIL PEDIDOS
|--------------------------------------------------------------------------
*/
$msg = 'Hola %s<br /><br />

Te informamos que segun lo solicitado, se le han acreditado fondos en su cuenta <br />
por un total de U\$S %s<br />
A partir de este momento ya puede hacer uso de los mismas <a href="%s">Accediendo a su cuenta</a><br /><br />

Muchas gracias por utilizar nuestros servicios<br /><br />

<font color="#ccc">
Recuerde que los mismos solo pueden ser utilizados para servicios prestados por<br />
AlquileresTemporarios.org<br />
Los mismos no son transferibles ni reembolsables bajo ningun concepto.
</font><br /><br />

Atte.<br />
AlquileresTemporarios.org';

define('EMAIL_ORDERS_FROM', 'no-reply@alquilerestemporario.org');
define('EMAIL_ORDERS_NAME', 'AlquileresTemporarios.org');
define('EMAIL_ORDERS_SUBJECT', 'Tu pago ha sido acreditado.');
define('EMAIL_ORDERS_MESSAGE', $msg);


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
* CFG_VALUE_xxxx es el importe del servicio (Esta expresado en dolares)
*/
define('CFG_TIME_DISTPROP', 1);      // Tiempo que dura una propiedad destacada (expresado en meses)
define('CFG_TIME_CUENTAPLUS', 1);    // Tiempo que dura una Cuenta Plus (expresado en años)
define('CFG_COSTO_PROPDISTING', 5);  // Costo para destacar propiedad
define('CFG_COSTO_CUENTAPLUS', 30); // Costo para adquirir una cuenta plus
define('CFG_FREE_TOTAL_PROP', 3);    // Cantidad de propiedad gratis
define('CFG_FREE_TOTAL_IMAGES', 3);  // Cantidad de imagenes gratis
define('CFG_CUENTAPLUS_TOTAL_PROP', 10);   // Cantidad de propiedad CUENTA PLUS
define('CFG_CUENTAPLUS_TOTAL_IMAGES', 8);  // Cantidad de imagenes CUENTA PLUS


/*
|--------------------------------------------------------------------------
| TITULOS DE CADA SECCION
|--------------------------------------------------------------------------
*/
define('TITLE_GLOBAL', 'AlquileresTemporarios.org'); // Titulo para todas las secciones
define('TITLE_INDEX', '');
define('TITLE_MASINFO', '');
define('TITLE_CONTACTO', '');
define('TITLE_REGISTRO', '');
define('TITLE_MICUENTA', '');
define('TITLE_PROPIEDADES', '');
define('TITLE_DESTACAR', '');
define('TITLE_CUENTAPLUS', '');
define('TITLE_AGREGAR_FONDOS', '');
define('TITLE_CONDICIONES', '');     // Condiciones de Uso
define('TITLE_RECORDARCONTRA', '');  // Recordar Contraseña



/*
|--------------------------------------------------------------------------
| META - Palabras Claves y Descripcion de la web
|--------------------------------------------------------------------------
*/
define('META_KEYWORDS', '');
define('META_DESCRIPTION', '');


/* End of file constants.php */
/* Location: ./system/application/config/constants.php */