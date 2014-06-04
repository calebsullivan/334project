<?php 
define("DEBUG", true); 

if(DEBUG) { 
    error_reporting(E_ALL);
    ini_set('display_errors', 'on'); }

session_start();

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

require_once('framework/start.php');
require_once('framework/header.php');


//render(yeild);


require_once('framework/footer.php');
require_once('framework/end.php');

ob_end_flush();
flush();

exit(0);
?>