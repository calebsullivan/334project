<?php

$GLOBALS['status']=0;
$GLOBALS['yeild']='';

enableReporting();
session_start();

$GLOBAL['DB']= new Database();
$GLOBAL['USER'] = new User();

session_name("offr");

if(!XHR){
	route();
}else{

}

?>