<?php

function error403(){
	header('HTTP/1.1 403 Forbidden');
	
	$GLOBALS['yeild']='403';

	$GLOBALS['status']=403;
}

function error404(){
	header('HTTP/1.1 404 Not Found');
	
	$GLOBALS['yeild']='404';

	$GLOBALS['status']=404;
}

function render($content){

	echo $content;

}

function sanitizeSafe(){

}

function sanitizeUnsafe(){
	
}

?>