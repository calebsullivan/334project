<?php
define("DEBUG", true); 

if(DEBUG) { 
    error_reporting(E_ALL);
    ini_set('display_errors', 'on'); }

session_start();

 
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
?>