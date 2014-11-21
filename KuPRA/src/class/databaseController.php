<?php
class databaseController {
	
	private $server = "127.0.0.1";
	private $username = "root";
	private $database = 'kupra';
	private $password = "";
	private $_pdo;
	private $_query;
	private $_error = false;
	private $_results;
	private $_count = 0;
	private static $_instance = null;
	
	private function __construct() {
		global $server;
		global $username;
		global $password;
		global $database;
		try{
			$this->_pdo = new PDO('mysql:host=' . $server . ';dbname=' . $database, $username, $password );
			echo 'success!';
		}catch (PDOExcerption $e) {
			die($e->getMessage());
		}
	}
	
	public static function getDB(){
		if(!isset(self::$_instance)){
			self::$_instance = new databaseController();
		}else{
			return self::$_instance;
		}
	}
	
	
 	
}
?>