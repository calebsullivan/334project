<?php

class Database{
	
	function __construct(){
		// do we need to build a new database?
		$rebuild = false;
		if(!file_exists(DATABASE_LOCATION)) { $rebuild = true; }

		// bind the database handler
		try {
			$this->db = new PDO("sqlite:" . DATABASE_LOCATION );
		} catch (Exception $e) {
		}

		// If we need to rebuild, the file will have been automatically made by the PDO call,
		if($rebuild) { migrate(DATABASE_LOCATION); }
	}

	// rebuilds the database if there is no database to work with yet
	function migrate($dbfile){
		$create = "CREATE TABLE user (time REAL, UID TEXT, user TEXT, email TEXT, pass TEXT, name TEXT, img TEXT, dat TEXT, tok TEXT, loc TEXT);";
		$this->db->beginTransaction();
		$this->db->exec($create);
		$this->db->commit();

		//seed();
	}

	function seed(){
		try {
			$this->$db->beginTransaction();
			$this->$db->query("INSERT INTO 'users' VALUES('0.0', '0', 'test@example.com', 'LeTest', 'testtest');");
			$this->$db->commit();
		} catch (Exception $e) {
			$this->$db->rollback();
		}
	}
}

?>
