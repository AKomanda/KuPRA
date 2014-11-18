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
	
	
	public function getMeniuId($author) {
		global $conn;
		$result = mysqli_query($conn, "SELECT id FROM valgiarastis WHERE Autorius = " . $author);
		return "a";
	}
	
	public function getMeniuRecepies($author) {
		global $conn;
		$result = mysqli_query($conn, 'SELECT receptai FROM valgiarastis WHERE Autorius = "' . $author . '"') or die("Bad syntax");
		/*
		 * $result = recepto_id:porciju_sk:data;recepto_id:porciju_sk:data;
		 */
		
		$num=$result->num_rows;
		$result = $result->fetch_assoc();
		
		$recepies = explode(";", (string) $result['receptai']);
		$finalRecepies = array();
		for($i = 0; $i < sizeof($recepies); $i++) {
			$dividedRecepie = explode(":", $recepies[$i]);
			array_push ($finalRecepies, $dividedRecepie);
		}
		
		return $finalRecepies;
	}

}
?>