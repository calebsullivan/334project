<?php

function error403(){
	header('HTTP/1.1 403 Forbidden');
	
	$GLOBALS['file']= VIEWS . DS . 'error' . DS . '403.php';

	$GLOBALS['status']=403;
}

function error404(){
	header('HTTP/1.1 404 Not Found');
	
	$GLOBALS['file']= VIEWS . DS . 'error' . DS . '404.php';

	$GLOBALS['status']=404;
}

function error500(){
	header('HTTP/1.1 500 Internal Server Error');
	
	$GLOBALS['file']= VIEWS . DS . 'error' . DS . '500.php';

	$GLOBALS['status']=500;
}

function redirect($location){

	header("Location: http://" . $_SERVER['HTTP_HOST'].$location, true, 302);
	header("Location: http://" . $_SERVER['HTTP_HOST']);
	
	exit;
}

//render content, insert variables
// TODO expand
function render($content){

	switch($content){
		case 'title':
		if(isset($GLOBALS['title'])) echo $GLOBALS['title'];
		break;
		case 'description':
		if(isset($GLOBALS['description'])) echo $GLOBALS['description'];
		break;
		case 'yeild':
		if(isset($GLOBALS['yeild'])) return $GLOBALS['yeild'];
		break;
		default:
		echo $content;
	}

	echo null;

}
// TODO
function sanitize($c){
	return $c;
}

function sanitizeUnsafe($c){
	return $c;
}

function path($view){
	switch($view){
		case 'Dashboard':
		return 'dashboard';
		case 'Messages':
		return 'messages';
		case 'Create offer':
		return 'offer';
		case 'Search':
		return 'search';
		case 'Sign up':
		return 'signup';
		case 'Log in':
		return 'login';
		default:
		return '/';
	}
}

function post(){ return $_SERVER['REQUEST_METHOD'] == 'POST'; }
function get(){ return $_SERVER['REQUEST_METHOD'] == 'GET'; }

?>