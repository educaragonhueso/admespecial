<?php
define("CONTROLADOR_DEFECTO", "centros");
define("ACCION_DEFECTO", "index");

/*
if(isset($_SERVER['CONTEXT_DOCUMENT_ROOT']))
	define("DIR_BASE",$_SERVER['CONTEXT_DOCUMENT_ROOT']."/");
else
	define("DIR_BASE","/datos/www/preadmespecial.aragon.es/public_admespecial/guarderias/");
*/
define("DIR_BASE","/datos/www/preadmespecial.aragon.es/public_admespecial/guarderias/");
define("DIR_CORE",DIR_BASE."/core");
#define("IPREMOTA","172.27.0.56");
define("IPREMOTA","15.16.149.60");
define("PAGINA_ACTIVA","1");
//parametros propios de la aplicacion
define("DIR_APP",DIR_BASE."/app/");
define("DIR_CONF",DIR_BASE."config/");
define("DIR_CLASES",DIR_BASE."scripts/clases/");
define("DIR_LOGS",DIR_BASE.'/scripts/datos/logs/');

define("DATA_SCRIPTS_DIR",'/scripts/datos_entrada/');

define("URL_BASE",'http://preadmespecial.aragon.es/guarderias/');

define("VERSION",'PRE');

define("DIA_INICIO_INSCRIPCION",'2020/05/26');
define("DIA_MAX_SOL_ALUMNO",'2020/05/28');
define("DIA_FIN_INSCRIPCION",'2020/05/28');

define("DIA_BAREMACION",'2020/05/28');
define("DIA_PUBLICACION_BAREMACION",'2020/05/029');

define("DIA_SORTEO",'2020/06/30');

define("DIA_PROVISIONALES",'2020/06/28');
define("DIA_DEFINITIVOS",'2020/06/30');
define("DIA_MATRICULA",'2020/06/30');

define("DIA_SORTEO_FASE2",'2020/06/12');

define("DIA_FASE3",'2020/06/26');

?>
