<?php

// if(dbtype='SQLITE3'){
	if(DEV){
		$DATABASE_NAME = "development";
	}else{
		$DATABASE_NAME = "production";
	}
	define('DATABASE_LOCATION', ROOT . DS . 'db' . DS . $DATABASE_NAME . '.db');
// else 
	// mysql con settings

?>