<?php

class Database{
	
	function __construct(){
		// do we need to build a new database?
		$rebuild = false;
		if(!file_exists(DATABASE_LOCATION)) { $rebuild = true; }

		// bind the database handler
		$this->db = new PDO("sqlite:" . DATABASE_LOCATION );

		// If we need to rebuild, the file will have been automatically made by the PDO call,
		if($rebuild) { $this->migrate(DATABASE_LOCATION); }
	}

	// rebuilds the database if there is no database
	function migrate($dbfile){
		$this->db->beginTransaction();
		$this->db->exec("CREATE TABLE users (time REAL, UID TEXT, user TEXT, email TEXT, pass TEXT, name TEXT, image TEXT, data TEXT, token TEXT, loc TEXT);");
		$this->db->exec("CREATE TABLE messages (time REAL, IID TEXT, toUID TEXT, fromUID TEXT, read TEXT, data TEXT, token TEXT, loc TEXT);");
		$this->db->exec("CREATE TABLE items (time REAL, IID TEXT, UID TEXT, images TEXT, data TEXT, token TEXT, loc TEXT);");
		$this->db->commit();

		//seed(); //insert fake data
	}

	function seed(){
		try {
			$this->$db->beginTransaction();
			$this->$db->exec("INSERT INTO 'users' VALUES('0.0', '0', 'test@example.com', 'LeTest', 'testtest');");
			$this->$db->commit();
		} catch (Exception $e) {
			$this->$db->rollback();
		}
	}
}

?>
