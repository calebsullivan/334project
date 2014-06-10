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
		$this->createUser('test', 'test@example.com', 'password', 'Test User');
		$this->createUser('test2', 'test2@example.com', 'password', 'Test Two');
	}

	function sendMessage($fromUID, $toUID, $IID, $data){
	//"CREATE TABLE messages (time REAL, IID TEXT, toUID TEXT, fromUID TEXT, read TEXT, data TEXT, token TEXT, loc TEXT);"

	}

	function getMessages($UID){

	}

}

?>