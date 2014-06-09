<?php 
define('DEV', true); 

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('VIEWS', ROOT . DS . 'app' . DS . 'views');
define('LIBS', ROOT . DS . 'lib');
define('XHR', strtolower(getenv('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest');

// load application, prep
require_once( LIBS . DS . 'bootstrap.lib.php');
require_once( LIBS . DS . 'global.lib.php');
require_once( LIBS . DS . 'config.lib.php');

// route
require_once( LIBS . DS . 'router.lib.php');

// execute
require_once( ROOT . DS . 'db' . DS . 'config.db.php');
require_once( ROOT . DS . 'db' . DS . 'database.db.php');

require_once( ROOT . DS . 'app' . DS . 'load.app.php');

require_once( LIBS . DS . 'init.lib.php');

if(isset($GLOBALS['file'])){
	require_once($GLOBALS['file']);
} else {
// ----------- BEGIN VIEW ----------- //
require_once( VIEWS . DS . 'framework' . DS . 'start.html.php');
require_once( VIEWS . DS . 'framework' . DS . 'menu.html.php');
?>

<div id="main">
<?php require_once( VIEWS . DS . 'framework' . DS . 'header.html.php'); ?>
			
<div class="content">
<?php require_once($GLOBALS['yield']);?>
</div>
			
<?php require_once( VIEWS . DS . 'framework' . DS . 'footer.html.php'); ?>
</div>

<?php
require_once( VIEWS . DS . 'framework' . DS . 'end.html.php');
// ----------- END VIEW ----------- //
}
//done? exit safely

ob_end_flush();
flush();

exit($GLOBALS['status']);
?>