<?php

function route(){
    $path = ltrim($_SERVER['REQUEST_URI'], '/'); //tokenize url params
    $path = explode('/', $path);

    if($path[0] == ''){
    echo "test";
    } else 
    switch(array_shift($path)){ //route for first path in file name
        case 'app':
        case 'assets':
        case 'db':
        case 'etc':
        case 'lib':
        case 'tmp':
            error403();
            break;
        
        case 'dashboard':

        	break;


        default:
            error404();
    		break;
    }

    // prepare path for next use
    array_shift($path);
    $GLOBALS['path'] = $path;
}

?>
