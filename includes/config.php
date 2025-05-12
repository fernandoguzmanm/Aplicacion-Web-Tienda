<?php




define('BD_HOST', 'vm019.db.swarm.test');
define('BD_NAME', 'tienda');
define('BD_USER', 'hola');
define('BD_PASS', 'hola');
/*
define('BD_HOST', 'localhost');
define('BD_NAME', 'tienda');
define('BD_USER', 'rishi');
define('BD_PASS', 'contrasenarishi');
*/
/**
 * Parámetros de configuración utilizados para generar las URLs y las rutas a ficheros en la aplicación
 */
define('RAIZ_APP', dirname(__DIR__) . '/'); // Ruta absoluta del sistema de archivos con barra al final
define('RUTA_APP', ''); // Ruta relativa para URLs
define('URL_BASE',  RUTA_APP); // URL base del proyecto

define('RUTA_BASE', RAIZ_APP); // Define RUTA_BASE como la ruta absoluta del sistema de archivos
define('RUTA_INCLUDES', RAIZ_APP . 'includes/');
define('RUTA_CSS', RAIZ_APP . 'css/');
define('RUTA_JS', RAIZ_APP . 'js/');
define('RUTA_IMGS', URL_BASE . 'img/');
define('RUTA_CONTROLADORES', RUTA_INCLUDES . 'controladores/');
define('RUTA_MODELOS', RUTA_INCLUDES . 'modelos/');
define('RUTA_VISTAS', RUTA_INCLUDES . 'vistas/');
define('RUTA_MYSQL', RUTA_INCLUDES . 'mysql/');

// URLs para recursos accesibles desde el navegador
define('URL_CSS', URL_BASE . 'css/');
define('URL_JS', URL_BASE . 'js/');
define('URL_IMGS', URL_BASE . 'img/');

/**
 * Configuración del soporte de UTF-8, localización (idioma y país) y zona horaria
 */
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF-8');
date_default_timezone_set('Europe/Madrid');
