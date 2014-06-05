<?php
// --------- BEGIN URI ROUTER ---------- //
$path = ltrim($_SERVER['REQUEST_URI'], '/'); //tokenize url params
$elements = explode('/', $path);
if(count($elements) == 0){
//home page
} else switch(array_shift($elements)){ //switch parameter
    case 'framework':
		header('HTTP/1.1 403 Forbidden');
        // Show403();
        // exit(403);
        break;
    case 'assets':
		header('HTTP/1.1 403 Forbidden');
        // Show403();
        // exit(403);
        break;
    case 'dashboard':
		header('HTTP/1.1 200 OK');

    	break;
    default:
        header('HTTP/1.1 404 Not Found');
        // Show404();
		break;
}
// --------- END URI ROUTER ---------- //
?>