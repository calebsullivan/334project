<?php 

require_once( ROOT . DS . 'lib' . DS . 'init.lib.php');

require_once( ROOT . DS . 'lib' . DS . 'router.lib.php');


require_once( ROOT . DS . 'framework' . DS . 'start.html.php');
require_once( ROOT . DS . 'framework' . DS . 'header.html.php');

//render(yeild);

require_once( ROOT . DS . 'framework' . DS . 'footer.html.php');
require_once( ROOT . DS . 'framework' . DS . 'end.html.php');

ob_end_flush();
flush();

exit(0);
?>