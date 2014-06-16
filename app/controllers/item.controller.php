<?php

class Item{
	private $db;

	function __construct(){
		$this->db=Database::getInstance();
		if($GLOBALS['rebuild']) { $this->seed(); }
	}

	public function db(){
		return $this->db;
	}

	// makes fake data
	function seed(){
	}

	function generateIID(){
		return rand(pow(10, 7), pow(10, 8)-1); //random 8 digit number
	}

	function show($IID){
		$IID=sanitize($IID);
		$GLOBALS['item']=$this->db->db->query("SELECT IID, images, title, description, token FROM items WHERE IID = '$IID' LIMIT 1;")->fetchAll(PDO::FETCH_ASSOC);
        $GLOBALS['title']=$GLOBALS['item']['title'];
	    $GLOBALS['yield']=VIEWS . DS . 'item' . DS . 'show.php';

	}

	function createItem($title, $images, $data, $token){
		$IID=$this->generateIID();
		$UID=$_SESSION['auth'];
		$time = time();			
		$this->db->db->beginTransaction();
		$this->db->db->exec("INSERT INTO 'items' (time, IID, UID, description, title, token) VALUES('$time', '$IID', '$UID', '$data', '$title', '$token');");
		$this->db->db->commit();

		sendXHR('Offer created');

	}

	function create(){
		//validate presence of required data
		if(!isset($_POST['data'])
			|| !isset($_POST['title'])) errorXHR('Missing data');

		if($_POST['title']=='') errorXHR('Missing data');

		//send message
		$this->createItem(
			sanitize($_POST['title'])
			, ''
			, sanitize($_POST['data'])
			, '');
	}

	function showAll($UID){
		$GLOBALS['item']=$this->db->db->query("SELECT * FROM items WHERE UID = '$UID';")->fetchAll(PDO::FETCH_ASSOC);
	    $GLOBALS['yield']=VIEWS . DS . 'item' . DS . 'show.all.php';		
	}

	function getUIDfromIID($IID){
		$result = $this->db->db->query("SELECT UID FROM items WHERE IID = '$IID' LIMIT 1;")->fetchAll(PDO::FETCH_ASSOC);
		return $result['UID'];
	}

	function delete($IID){
		$this->db->db->beginTransaction();
			//AND UID = '" . $_SESSION['auth'] . "'
		echo "DELETE FROM items WHERE IID = $IID;";
		$this->db->db->exec("DELETE FROM items WHERE IID = $IID;");
		$this->db->db->commit();
		sendXHR('y');
	}

	function search(){
		$term=sanitize($_GET['term']);
		if($term=='') errorXHR('empty');
		$count=$this->db->db->query("SELECT * FROM items WHERE title LIKE '% $term %' OR title like '$term %' OR title like '% $term' OR title like '$term' OR title='$term' OR description LIKE '% $term %' OR description like '$term %' OR description like '% $term' OR description like '$term' OR description='$term';")->rowCount();

		if($count<0) errorXHR('nothing found');

	    $GLOBALS['item']=$this->db->db->query("SELECT * FROM items WHERE title LIKE '%$term%' or description LIKE '%$term%';")->fetchAll(PDO::FETCH_ASSOC);
	    $GLOBALS['file']=VIEWS . DS . 'search.view.php';	
	}
}

?>