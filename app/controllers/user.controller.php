<?php

class User{
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

	function createUser($user, $email, $plaintext_password, $name){
		$time=time();
		$UID=$this->generateUID();
		$pass=$this->saltPassword($plaintext_password);

		try{
			$this->db->db->beginTransaction();
			$this->db->db->exec("INSERT INTO 'users' (time, UID, user, email, pass, name) VALUES('$time', '$UID', '$user', '$email', '$pass', '$name');");
			$this->db->db->commit();
		} catch (Exception $e) {
			echo $e;
			$this->db->db->rollback();
		}
	}

	function updateUser($user, $email, $plaintext_password, $name){

	}

	// isAuth: authenticated status of the current user
	// returns false if anonymous user
	function isAuth(){
		return array_key_exists('auth', $_SESSION) 
			|| array_key_exists('auth', $_COOKIE);//unimplemented
	}

	function userInUse(){

		return false;
	}

	function emailInUse(){
		return false;
	}

	function generateUID(){
		// should check that UID doesn't already exist, just in case
		return rand(pow(10, 3), pow(10, 4)-1); //random 4 digit number
	}

	function UIDexists($uid){
		return false;
	}

	function saltPassword($plaintext_password){
		// should be sha2
		$salt="3KJHRD9FH3KJHF93";
		return sha1($plaintext_password.$salt.$plaintext_password);
	}

	public function login(){
		$username=sanitize($_POST['username']);
		
		$password=$this->saltPassword($_POST['password']);

		$query = "SELECT UID, name, pass FROM users WHERE email = '".$username."' or user = '".$username."';";
		$result = $this->db()->db->query($query)->fetch(PDO::FETCH_ASSOC);

		if($result['pass'] == $password){
			$_SESSION['auth']=$result['UID'];
			$_SESSION['name']=$result['name'];
			sendXHR('success');
		} else {
			errorXHR('fail');
		}
	}
	
	public function signup(){
		
		//validate presence of required data
		if(!isset($_POST['username']) 
			|| !isset($_POST['email']) 
			|| !isset($_POST['password'])
			|| !isset($_POST['name']) 
			) errorXHR('Fill required fields');

		//create user, password does not need to be validated
		//because password is salted
		$this->createUser(sanitize($_POST['username'])
			, sanitize($_POST['email'])
			, $_POST['password']
			, sanitize($_POST['name']));
		$this->login();
	}

	public function logout(){
		session_unset();
		// sendXHR('logged out');
		redirect();
	}

}

?>