<?php

define ('debug', true);

/* define app path */
define ('CODEKIR_ROOTPATH', '/home/andreass/data/xampp/htdocs/pindai-monitoring/');

/* define engine path */
define ('CODEKIR_PACKAGE', '/home/andreass/data/xampp/htdocs/new-codekir/loader/');

define ('CODEKIR_TEMPLATE', 'modern');

/* 
	define loader path, do not edit this path
*/
define ('CODEKIR_APPPATH', CODEKIR_ROOTPATH . 'applications/default/');
define ('CODEKIR_ADMINPATH', CODEKIR_ROOTPATH . 'applications/admin/');
define ('CODEKIR_COREPATH', CODEKIR_PACKAGE . 'engine/');
define ('CODEKIR_LIBS', CODEKIR_PACKAGE . 'plugin/');
define ('CODEKIR_LOGS', CODEKIR_PACKAGE . 'logs/');
define ('CODEKIR_CACHE', CODEKIR_PACKAGE . 'cache/');
define ('CODEKIR_TMP', CODEKIR_PACKAGE . 'tmp/');

require_once (CODEKIR_COREPATH.'admin-system.php');

?>