<?php
class databaseController {
	
	private $server = "127.0.0.1";
	private $username = "root";
	private $password = "";
	private  $conn;
	
	public function __construct() {
		global $server;
		global $username;
		global $password;
		global $conn;
		$conn = mysqli_connect($server, 'root', $password, "kupra") or die ("could not connect to mysql");
	}
	
	
 	
}
?>