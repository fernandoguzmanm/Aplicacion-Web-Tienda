<?php

/**
 * Parámetros de conexión a la BD
 */
define('BD_HOST', 'localhost');
define('BD_NAME', 'awp2');
define('BD_USER', 'awp2');
define('BD_PASS', 'awpass');

/**
 * Parámetros de configuración utilizados para generar las URLs y las rutas a ficheros en la aplicación
 */
define('RAIZ_APP', dirname(__DIR__));
define('RUTA_APP', '/Proyecto1/');
define('RUTA_INCLUDES', RUTA_APP . 'includes/');
define('RUTA_CSS', RUTA_APP . 'css/');
define('RUTA_JS', RUTA_APP . 'js/');
define('RUTA_IMGS', RUTA_APP . 'img/');
define('RUTA_CONTROLADORES', RUTA_INCLUDES . 'controladores/');
define('RUTA_MODELOS', RUTA_INCLUDES . 'modelos/');
define('RUTA_VISTAS', RUTA_INCLUDES . 'vistas/');
define('RUTA_MYSQL', RUTA_INCLUDES . 'mysql/');
/**
 * Configuración del soporte de UTF-8, localización (idioma y país) y zona horaria
 */
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF-8');
date_default_timezone_set('Europe/Madrid');
