<?php

$GLOBALS['status']=0;
$GLOBALS['yeild']='';

enableReporting();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
	session_name("offr");
}

$message = new Message();
$GLOBALS['message']=$message;

$user = new User();
$GLOBALS['user']=$user;

$item = new Item();
$GLOBALS['item']=$item;

if($GLOBALS['user']->isAuth()) {
	$GLOBALS['views'] = $GLOBALS['auth_views'];
	if($_SESSION['auth']==0)
	$GLOBALS['views'] = $GLOBALS['admin_views'];
}	
route($user);

// if(XHR){
// }else{
// 	route($user);
// }

?>