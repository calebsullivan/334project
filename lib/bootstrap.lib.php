<?php

function enableReporting() {
	if(DEV) { 
	    error_reporting(E_ALL);
	    ini_set('display_errors', 'on'); 
	} else {
		error_reporting(E_ALL);
	    ini_set('display_errors','Off');
	    ini_set('log_errors', 'On');
	    ini_set('error_log', ROOT . DS . 'tmp' . DS . 'error_log');
	}
}

?>