<?php

class Database{
	
	private static $instance = null;

	function __construct(){
		// do we need to build a new database?
		$GLOBALS['rebuild'] = false;
		if(!file_exists(DATABASE_LOCATION)) { $GLOBALS['rebuild'] = true; }

		// bind the database handler
		$this->db = new PDO("sqlite:" . DATABASE_LOCATION );
		// If we need to rebuild, the file will have been automatically made by the PDO call,
		if($GLOBALS['rebuild']) { $this->migrate(DATABASE_LOCATION); }
	}

	// rebuilds the database if there is no database
	function migrate($dbfile){
		$this->db->beginTransaction();
		$this->db->exec("CREATE TABLE activity (time REAL, UID TEXT, user TEXT, type TEXT, data, image TEXT, data TEXT, token TEXT, loc TEXT);");
		$this->db->exec("CREATE TABLE users (time REAL, UID TEXT, user TEXT, email TEXT, pass TEXT, name TEXT, image TEXT, data TEXT, token TEXT, loc TEXT);");
		$this->db->exec("CREATE TABLE messages (time REAL, IID TEXT, toUID TEXT, fromUID TEXT, read TEXT, data TEXT, token TEXT, loc TEXT);");
		$this->db->exec("CREATE TABLE items (time REAL, IID TEXT, UID TEXT, title TEXT, images TEXT, data TEXT, token TEXT, loc TEXT);");
		$this->db->exec("CREATE TABLE contact (time REAL, ID TEXT, time_date TEXT, IP TEXT, UID TEXT, UA TEXT, data TEXT, token TEXT, loc TEXT);");
		$this->db->commit();

	}

	// lazy singleton
	static public function getInstance(){
        if(self::$instance === null)
            self::$instance = new Database();
        return self::$instance;
    }
}

?>
