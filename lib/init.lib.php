<?php

$GLOBALS['status']=0;
$GLOBALS['yeild']='';

enableReporting();
session_start();

$DATABASE = new Database();
$USER = new User();


session_name("nanoblog");


if(!XHR){
	route();
}else{

}

?>