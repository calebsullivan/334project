<div id="menu">
    <div class="pure-menu  pure-menu-open">
        <a class="pure-menu-heading" href="/">offr</a>
        <ul>
<?php
    foreach ($GLOBALS['views'] as $view){
?>
            <li class=" ">
                <a href="/<?php echo strtolower($view)?>/"><?php echo $view?></a>
            </li>
<?php
    }
?>

        </ul>
    </div>
</div>