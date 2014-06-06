<?php

function route(){
$path = ltrim($_SERVER['REQUEST_URI'], '/'); //tokenize url params
$elements = explode('/', $path);

if($elements[0] == ''){
//home page
} else switch(array_shift($elements)){ //route for first path in file name
    case 'app':
        error403();
        break;
    case 'assets':
        error403();
        break;
    case 'dashboard':
		header('HTTP/1.1 200 OK');

    	break;
    default:
        error404();
		break;
    }
}
?>