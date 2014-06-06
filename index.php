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
require_once( LIBS . DS . 'router.lib.php');

// execute
require_once( LIBS . DS . 'init.lib.php');

// ----------- BEGIN VIEW ----------- //
require_once( VIEWS . DS . 'framework' . DS . 'start.html.php');
require_once( VIEWS . DS . 'framework' . DS . 'menu.html.php');
?>

<div id="main">
<?php require_once( VIEWS . DS . 'framework' . DS . 'header.html.php'); ?>
			
			<div id="content">
				<?php render($GLOBALS['yeild']);?>
			</div>
			
<?php require_once( VIEWS . DS . 'framework' . DS . 'footer.html.php'); ?>
</div>

<?php
require_once( VIEWS . DS . 'framework' . DS . 'end.html.php');
// ----------- END VIEW ----------- //

//done? exit safely

ob_end_flush();
flush();

exit($GLOBALS['status']);
?>