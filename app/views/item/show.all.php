<?php
foreach ($GLOBALS['item'] as $item){
	echo '<div style="display:inline" class="item-list">';
	echo $item['title'];
	echo $item['description'];
	echo '<a href="#" class="deleteItem pure-button button-danger" data-itemid="' . $item['IID'] . '">Delete</a>';
	echo '</div>';
}
?>