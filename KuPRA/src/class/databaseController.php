<?php
class databaseController {
	
	private $server = "localhost";
	private $username = "root";
	private $password = "";
	private $conn;
	
	public function __contruct() {
		$conn = new mysqli($server, $username, $password);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		echo "Connected successfully";
	}
	
	public function __destruct() {
	}
	
	public function getMeniuId($author) {
		$result = mysql_query("SELECT id FROM valgiaraštis WHERE Autorius = " . $author);
		return "a";
	}
	
	public function getMeniuRecepies($author) {
		$result = mysql_query("SELECT receptai FROM valgiaraštis WHERE Autorius = " . $author);
		/*
		 * $result = recepto_id:porciju_sk:data;recepto_id:porciju_sk:data;
		 */
		$recepies = explode(";", $result);
		$finalRecepies = array();
		for($i = 0; $i < sizeof($recepies); $i++) {
			$dividedRecepie = explode(":", $recepies[$i]);
			array_push ($finalRecepies, $dividedRecepie);
		}
		
		return $finalRecepies;
	}

}
?>