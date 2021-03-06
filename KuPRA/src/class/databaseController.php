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
		try{
			$this->_pdo = new PDO('mysql:host=' . $this->server . ';dbname=' . $this->database, $this->username, $this->password );
			$this->_pdo->exec("SET NAMES 'utf8';");
		}catch (PDOExcerption $e) {
			die($e->getMessage());
		}
	}
	
	public static function getDB(){
		if(!isset(self::$_instance)){
			return self::$_instance = new databaseController();
		}else{
			return self::$_instance;
		}
	}
	
	public function query($sql, $params = array()){
		$this->_error = false;
		if ($this->_query = $this->_pdo->prepare($sql)){
			$x = 1;
			if (count($params)){
				foreach($params as $param){
					$this->_query->bindValue($x, $param);
					$x++;	
				}
			}
			if($this->_query->execute()){
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}else{
				$this->_error = true;
			}
		}
		return $this;
	}
	
	public function action($action, $table, $where = array()){
		if(count($where) === 3){
			$operators = array('<', '>', '=', '>=', '<=', '!=', 'like');
			$field = $where[0];
			$operator = $where[1];
			$value = $where[2];
			if(in_array($operator, $operators)){
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
				if(!$this->query($sql, array($value))->error()){
					return $this;
				}
			}
		}elseif (count($where) === 0){
			$sql = "{$action} FROM {$table}";
			if(!$this->query($sql, array())->error()){
				return $this;
			}
		}else{
			return false;
		}
	}
	
	public function get($table, $where){
		return $this->action("SELECT *", $table, $where);
	}
	
	public function delete($table, $where){
		return $this->action("DELETE", $table, $where);
	}
	
	public function insert($table, $data = array()){
		if(count($data)){
			$fields = array_keys($data);
			$values = '';
			$counter = 1;
			
			foreach($data as $d){
				$values .= '?';
				if($counter < count($data)){
					$values .= ', ';
				}
				$counter ++;
			}
			
			$query = "INSERT INTO {$table} (`" . implode('`,`', $fields) . "`) VALUES ({$values})";
			if (!$this->query($query, $data)->error()){
				return true;
			}else{
				return false;
			}
		}
		return false;
	}
	
	public function update($table, $fields = array(), $where){
		$values = '';
		$counter = 1;
		foreach(array_keys($fields) as $field){
			$values .= "{$field} = ?";
			if ($counter < count($fields)){
				$values .= ', ';
			}
			$counter ++ ;
		}
		$query = "UPDATE {$table} SET {$values} WHERE {$where[0]} {$where[1]} {$where[2]}";
		if (!$this->query($query, $fields)->error()){
			return true;
		}else{
			return false;
		}
	}
	
	public function getLast(){
		return $this->_pdo->lastInsertId();
	}
	
 	public function error(){
 		return $this->_error;
 	}
 	
 	public function count(){
 		return $this->_count;
 	}
 	
 	public function results(){
 		return $this->_results;
 	}
}
?>
