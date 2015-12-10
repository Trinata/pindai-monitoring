<?php

define ('debug', true);

/* define app path */

$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

define ('CODEKIR_ROOTPATH', '/home/andreass/data/xampp/htdocs/pindai-monitoring/');

/* define engine path */
define ('CODEKIR_PACKAGE', '/home/andreass/data/xampp/htdocs/new-codekir/loader/');

define ('CODEKIR_TEMPLATE', 'modern');

/* 
	define loader path
*/
define ('CODEKIR_APPPATH', CODEKIR_ROOTPATH . 'applications/default/');
define ('CODEKIR_ADMINPATH', CODEKIR_ROOTPATH . 'applications/admin/');
define ('CODEKIR_COREPATH', CODEKIR_PACKAGE . 'engine/');
define ('CODEKIR_LIBS', CODEKIR_PACKAGE . 'plugin/');
define ('CODEKIR_TMP', CODEKIR_ROOTPATH . 'tmp/');
define ('CODEKIR_LOGS', CODEKIR_TMP . 'logs/');
define ('CODEKIR_CACHE', CODEKIR_TMP . 'cache/');

/* define cache database */
define ('CACHE_DB', true);

require_once (CODEKIR_COREPATH.'admin-system.php');

?>
