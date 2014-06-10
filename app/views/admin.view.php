<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'on'); 

    if(isset($_GET['what'])!=true) $_GET['what']='';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        session_name("offr");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administration</title>

    <link rel="stylesheet" href="/assets/css/pure-min.css">
    <link rel="stylesheet" href="/assets/css/side-menu.css">
    <script type="text/javascript" href="/assets/js/jquery-1.11.1.js"></script>
    <script type="text/javascript" href="/assets/js/medium-editor.js"></script>
    <script type="text/javascript" href="/assets/js/common.js"></script>
    <script type="text/javascript">
        $( document ).ready( function() {
           
        });
    </script>

</head>
<body>
<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu pure-menu-open">
            <a class="pure-menu-heading" href="#">334project</a>
            <ul>
                <li <?php if ($_GET['what'] == '') {?> class="pure-menu-selected" <?php }?> >
                    <a href="/dev/">Developer</a></li>
                <li <?php if ($_GET['what'] == 'database') {?> class="pure-menu-selected" <?php }?> >
                    <a href="/dev/?what=database">Database</a></li>
                <li <?php if ($_GET['what'] == 'info') {?> class="pure-menu-selected" <?php }?> >
                    <a href="/dev/?what=info">Info</a></li>
                <li <?php if ($_GET['what'] == 'git') {?> class="pure-menu-selected" <?php }?> >
                    <a href="?what=git">git</a>
                </li>

            </ul>
        </div>
    </div>

<?php if ($_GET['what'] == '') {?>
    <div id="main">
        <div class="header"><h1>Admin</h1></div>

        <div class="content">
            <h2 class="content-subhead">Set/get</h2>
                <p><a href="#">Clear all domain cookies</a></p>
                <p><a href="#">Clear all login cookies</a></p>
                <p><a href="#">Set admin login cookie</a></p>

            <h2 class="content-subhead">Diagnostic</h2>
                <p><a href="phpinfo.dev">phpinfo</a></p>
        </div>
    </div>
<?php }?>
<?php if ($_GET['what'] == 'info') {?>
    <div id="main">
        <div class="header"><h1>Info</h1></div>
        <div class="content">
            <h2 class="content-subhead">REQUEST_URI</h2>
            <pre><?php echo $_SERVER['REQUEST_URI'];?></pre>

            <h2 class="content-subhead">REMOTE_ADDR</h2>
            <pre><?php echo $_SERVER['REMOTE_ADDR'];?></pre>

            <h2 class="content-subhead">HTTP_USER_AGENT</h2>
            <pre><?php echo $_SERVER['HTTP_USER_AGENT'];?></pre>

            <h2 class="content-subhead">PATH_TRANSLATED</h2>
            <pre><?php echo $_SERVER['PATH_TRANSLATED'];?></pre>

            <h2 class="content-subhead">SERVER_SOFTWARE</h2>
            <pre><?php echo $_SERVER['SERVER_SOFTWARE'];?></pre>

            <h2 class="content-subhead">ERROR_LOG</h2>
            <pre><?php echo ini_get('error_log');?></pre>
            <span>(only appears if safe_mode off)</span>
        </div>
    </div>
<?php }?>
<?php if ($_GET['what'] == 'git') {?>
    <div id="main">
        <div class="header"><h1>git</h1></div>

        <div class="content">
            <h2 class="content-subhead">Github repo</h2>
            <p><a href="http://github.com/calebsullivan/334project">github repo</a></p>


        </div>
    </div>
<?php }?>
<?php if ($_GET['what'] == 'database') {?>
    <div id="main">
        <div class="header"><h1>Database functions</h1></div>

        <div class="content">
            <h2 class="content-subhead">Seed</h2>
            <p><a href="/db/init.db.php">db seed</a></p>


        </div>
    </div>
<?php }?>


</div>

</body>
</html>
