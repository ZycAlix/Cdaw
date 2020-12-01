<?php

// define('_MYSQL_HOST','127.0.0.1');

define('DB_HOST','localhost');
define('DB_PORT',3306);
define('DB_DATABASE','cdaw');
define('DB_USERNAME','root');
define('DB_PASSWORD','root');

// define('__DEBUG', false);
define('__DEBUG', true);

define( 'JWT_BACKEND_KEY', '6d8HbcZndVGNAbo4Ih1TGaKcuA1y2BKs-I5CmP' );
define( 'JWT_ISSUER', $_SERVER['HTTP_HOST'] . $_SERVER['CONTEXT_PREFIX']);

// ================================================================================
// Debug utilities
// ================================================================================

if(__DEBUG) {
	error_reporting(E_ALL);
	ini_set("display_errors", E_ALL);
} else {
	error_reporting(0);
	ini_set("display_errors", 0);
}

function myLog($msg) {
	if(__DEBUG) {
		echo $msg;
	}
}

function myDump($var) {
	if(__DEBUG) {
		var_dump($var);
	}
}

