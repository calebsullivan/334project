<?php

class User{

	// creates user and writes to database

	function __construct(){
		$this->$db=$GLOBAL['DB'];
	}

	function createUser($USERNAME, $EMAIL, $PASSWORD, $NAME){
		//TABLE user (time REAL, UID TEXT, user TEXT, email TEXT, pass TEXT, name TEXT, image TEXT, data TEXT, token TEXT, loc TEXT)
		try {
			$this->$db->beginTransaction();
			$this->$db->exec("INSERT INTO 'users' VALUES('0.0', '0', 'test@example.com', 'LeTest', 'testtest');");
			$this->$db->commit();
		} catch (Exception $e) {
			$this->$db->rollback();
		}

	}

	function updateUser($USERNAME, $EMAIL, $PASSWORD, $NAME){

	}


	// isAuth: authenticated status of the current user
	// returns false if anonymous user
	function isAuth(){

		return false;
	}

	function logIn($username, $plaintext_password){
		$salt="3KJHRD9FH3KJHF93";
		$sha1=sha1($salt.$plaintext_password);

		return true;

	}

}

?>