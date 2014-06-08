<?php

class User{

	// creates user and writes to database

	function createUser($USERNAME, $EMAIL, $PASSWORD, $NAME){
		//TABLE user (time REAL, UID TEXT, user TEXT, email TEXT, pass TEXT, name TEXT, image TEXT, data TEXT, token TEXT, loc TEXT)
		try {
			$this->$db->beginTransaction();
			$this->$db->query("INSERT INTO 'users' VALUES('0.0', '0', 'test@example.com', 'LeTest', 'testtest');");
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

		return true;

	}

}

?>