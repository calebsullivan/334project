<?php

$GLOBALS['status']=0;
$GLOBALS['yeild']='';

enableReporting();
session_start();
session_name("offr");

$user = new User();
$GLOBALS['user']=$user;


if(!$GLOBALS['user']->isAuth()) 
	$GLOBALS['views'] = $GLOBALS['unauth_views'];

route($user);

// if(XHR){
// }else{
// 	route($user);
// }

?>