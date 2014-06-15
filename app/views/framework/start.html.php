<!DOCTYPE HTML>
<html lang='en'>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php render($GLOBALS['title']);?></title>
	<link rel="stylesheet" type="text/css" href="/assets/css/html5reset.css"/>
	<link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css"/>
	<link rel="stylesheet" type="text/css" href="/assets/css/pure/pure-min.css"/>
	<link rel="stylesheet" type="text/css" href="/assets/css/medium/medium-editor.css"/>
	<link rel="stylesheet" type="text/css" href="/assets/css/medium/flat.css"/>
	<link rel="stylesheet" type="text/css" href="/assets/css/side-menu.css"/>
	<link rel="stylesheet" type="text/css" href="/assets/css/site.css"/>
</head>
<body>
<div id="layout">
<?php 
    if($GLOBALS['user']->isAuth())
    	echo'<a class=" pure-button button-error " id="logout" href="/logout/">Logout</a>';
    ?>
