<?php
define("DEBUG", true); 

if(DEBUG) { error_reporting(E_ALL); ini_set('display_errors', 'on'); }

// URL BOOTSTRAPPING

require_once('framework/start.php');
require_once('framework/head.php');

$path = ltrim($_SERVER['REQUEST_URI'], '/'); //tokenize url params
$elements = explode('/', $path);
if(count($elements) == 0){

//render home

}
else switch(array_shift($elements)){ //switch parameter
    case 'framework':
        header('HTTP/1.1 403 Forbidden');
        // Show403();
        exit();
        break;
    case 'assets':
        header('HTTP/1.1 403 Forbidden');
        // Show403();
        exit();
        break;
    default:
        header('HTTP/1.1 404 Not Found');
		break;
        // Show404();
}
?>

<?php
//render(yeild);
require_once('framework/foot.php');
require_once('framework/end.php');
exit(0);
?>