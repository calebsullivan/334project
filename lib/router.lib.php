<?php

function route($user){
    $path = ltrim($_SERVER['REQUEST_URI'], '/'); //tokenize url params
    $path = explode('/', $path);

    if($path[0] == ''){ //home page
        if($GLOBALS['user']->isAuth()) { 
            $GLOBALS['title']="Welcome back, ". $_SESSION['name'];
            $GLOBALS['description']="What are you looking for today?";
        } else {
            $GLOBALS['title']="Welcome to OFFR";
            $GLOBALS['description']="The marketplace for stuff and things.";
        }
        $GLOBALS['yield']=VIEWS . DS . 'home.view.php';
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
            if(!$GLOBALS['user']->isAuth()) redirect('/');
            $GLOBALS['title']="Dashboard";
            $GLOBALS['yield']=VIEWS . DS . 'dashboard.view.php';
            break;
        case 'home':
            if(!$GLOBALS['user']->isAuth()) redirect('/');
            $GLOBALS['title']="Home";
            $GLOBALS['yield']=VIEWS . DS . 'home.view.php';
            break;
        case 'search':
            $GLOBALS['title']="Search";
            $GLOBALS['yield']=VIEWS . DS . 'search.view.php';
            break;
        case 'offer':
            $GLOBALS['title']="Create offer";
            $GLOBALS['yield']=VIEWS . DS . 'offer.view.php';
            break;
        case 'messages':
            if(!$GLOBALS['user']->isAuth()) redirect('/');
            $GLOBALS['title']="Messages";
            $GLOBALS['yield']=VIEWS . DS . 'messages.view.php';
            break;

        case 'login':
            if(post()) $user->login();
            if($GLOBALS['user']->isAuth()) redirect('/');
            $GLOBALS['title']="Log in";
            $GLOBALS['yield']=VIEWS . DS . 'user' . DS . 'login.php';
            break;
        case 'signup':
            if(post()) $user->signup();
            if($GLOBALS['user']->isAuth()) redirect('/');
            $GLOBALS['title']="Sign up";
            $GLOBALS['yield']=VIEWS . DS . 'user' . DS . 'signup.php';
            break;

        case 'user':
            if(!$GLOBALS['user']->isAuth()) redirect('/');
            $GLOBALS['title']=$GLOBALS['user']->name();
            $GLOBALS['yield']=VIEWS . DS . 'user' . DS . 'show.php';
            break;

        case 'logout':
            if(get()) $user->logout();
            if(post()) $user->logout();
            if($GLOBALS['user']->isAuth()) redirect('/');
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
