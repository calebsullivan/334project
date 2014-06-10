<?php

class Message{
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

	function sendMessage($fromUID, $IID, $message){
	//TABLE user (time REAL, UID TEXT, user TEXT, email TEXT, pass TEXT, name TEXT, image TEXT, data TEXT, token TEXT, loc TEXT)
	//CREATE TABLE messages (time REAL, IID TEXT, toUID TEXT, fromUID TEXT, read TEXT, data TEXT, token TEXT, loc TEXT)
		$result = $this->db->db->query("SELECT UID FROM items WHERE IID = '$IID' LIMIT 1;")->fetch(PDO::FETCH_ASSOC);
		$toUID=$result['UID'];
		$time = time();			

		$this->db->beginTransaction();
		$this->db->exec("INSERT INTO 'messages' (time, IID, toUID, fromUID, read, data) VALUES('$time', '$IID', '$toUID', '$fromUID', '0', '$message');");
		$this->db->commit();

		sendXHR('Message sent');

	}

	function getAllMessages($UID){
		$result = $this->db->db->query("SELECT UID FROM items WHERE IID = '$IID' LIMIT 1;")->fetch(PDO::FETCH_ASSOC);
	}

	function send(){
		//validate presence of required data
		if(!isset($_POST['iid'])
			|| !isset($_POST['message'])) errorXHR('Missing data');

		//send message
		$this->sendMessage( $_SESSION['auth']
			, sanitize($_POST['iid'])
			, sanitize($_POST['message']));
	}
}

?>