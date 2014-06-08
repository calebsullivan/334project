<?php

$GLOBALS['status']=0;
$GLOBALS['yeild']='';

enableReporting();
session_start();

$DATABASE = new Database();
$USER = new User();

session_name("offr");

if(!XHR){
	route();
}else{

}

?>