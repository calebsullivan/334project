<div id="menu">
    <div class="pure-menu  pure-menu-open">
        <a class="pure-menu-heading" href="/">offr</a>
        <ul><?php
    foreach ($GLOBALS['views'] as $view){

        if($view == $GLOBALS['title']){
?>        <li class="pure-menu-selected">
<?php } else { ?> 
        <li> 
<?php } ?>
            <a href="/<?php echo strtolower($view)?>/"><?php echo $view?></a>
        </li>
<?php
    }
?>        </ul>
    </div>
</div>