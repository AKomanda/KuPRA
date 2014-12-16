<?php
include_once 'core/init.php';
class Validation{
	private $_errors = array();
	private $_email_regex = "/[a-zA-Z0-9_.+]+@[a-zA-Z0-9]+.[a-zA-Z]/";
	private $regex = "/[a-zA-Z0-9\pL]/";
	private $regex_with_space = "/[a-zA-Z0-9 \pL]/";
	private $db;
	
	public function __construct(){
		$this->db = databaseController::getDB();
	}
	
	public function regValidation($data = array()){
		$email = $data['email'];
		
		if(strlen($email) > 0){
			if(!preg_match($this->_email_regex, $email)){
				$this->_errors[] = 'Neteisingas Email formatas';
			}
			if($this->db->get('vartotojas', array('pastas', '=', $email))->count() != 0){
				$this->_errors[] = 'Vartotojas su tokiu Email jau užregistrutas';
			}
		}else{
			$this->_errors[] = 'Email laukas negali būti tuščias';
		}
		
		$login = $data['login'];
		
		if(strlen($login) < 4 || strlen($login)> 30){
			$this->_errors[] = 'Prisijungimo vardas negali būti trumpesnis nei 4 ir ilgesnis nei 30 simbolių';
		}else{
			if(!preg_match($this->regex, $login)){
				$this->_errors[] = 'Neteisingas prisijungimo vardo formatas naudokite tik raides ir skaicius';
			}
			if($this->db->get('vartotojas', array('login', '=', $login))->count() != 0){
				$this->_errors[] = 'Vartotojas su tokiu prisijungimo vardu jau užregistrutas';
			}
		}
		
				
		
		$nick = $data['nick'];
		
		if(strlen($nick) < 4 || strlen($nick)> 30){
			$this->_errors[] = 'Vartotojo slapyvardis negali būti trumpesnis nei 4 ir ilgesnis nei 30 simbolių';
		}else{
			if(!preg_match($this->regex, $nick)){
				$this->_errors[] = 'Neteisingas slapyvardžio formatas naudokite tik raides ir skaicius';
			}
			if($this->db->get('vartotojas', array('slapyvardis', '=', $nick))->count() != 0){
				$this->_errors[] = 'Vartotojas su tokiu slapyvardžiu jau užregistrutas';
			}
		}
		
		

		$pass = $data['password'];
		$rep_pass = $data['password_again'];
		
		if(strlen($pass) < 6 || strlen($pass)> 30){
			$this->_errors[] = 'Slaptažodis negali būti trumpesnis nei 6 ir ilgesnis nei 30 simbolių';
		}else{
			if(!preg_match($this->regex, $pass)){
				$this->_errors[] = 'Neteisingas slaptažodžio formatas naudokite tik raides ir skaicius';
			}
			if($pass != $rep_pass){
				$this->_errors[] = 'Įvesti slapyvardžiai nesutampa';
			}
		}
		
	}
	
	public function loginValidation($login, $password){
		if(strlen($login) == 0){
			$this->_errors[] = 'Prisijungimo vardo laukas negali būti tuščias';
		}
		if(strlen($password) == 0){
			$this->_errors[] = 'Slaptažodžio laukas negali būti tuščias';
		}
	}
	
	public function measureValidation($short, $name){
		$this->measureShortValidation($short);
		$this->measureNameValidation($name);
	}
	public function measureShortValidation($short){
		if(strlen($short) == 0 || strlen($short) > 16){
			$this->_errors[] = 'sutrumpinimas gali būti 1-16 simbolių ilgio';
		}elseif(!preg_match($this->regex, $short)){
			$this->_errors[] = 'Sutrumpinimui naudokite tik raides ir skaičius';
		}
	}
	
	public function measureNameValidation($name){
		if(strlen($name) > 0 && strlen($name) < 16){
			if(!preg_match($this->regex, $name)){
				$this->_errors[] = 'Pavadinimui naudokite tik raides ir skaičius';
			}elseif(databaseController::getDB()->get('matavimo_vienetai', array('Pavadinimas', '=', $name))->count() > 0){
				$this->_errors[] = 'Matavimo vieneto pavadinimas jau egzistuoja';
			}
		}else{
			$this->_errors[] = 'Pavadinimas gali būti 1-16 simbolių ilgio';
		}
	}
	
	public function productSearchValidation($input){
		if(strlen($input) < 3){
			$this->_errors[] = 'Į paiešką įrašykite bent 3 simbolius';
		}elseif(!preg_match($this->regex_with_space, $input)){
			$this->_errors[] = 'Paieškoje naudokite tik raides ir skaicius';
		}
		
	}
	
	public function passwordChangeValidation($data = array()){
			if(strlen($data['newPassword']) < 6 || strlen($data['newPassword'])> 30){
				$this->_errors[] = 'Slaptažodis negali būti trumpesnis nei 6 ir ilgesnis nei 30 simbolių';
			}else{
				if(!preg_match($this->regex, $data['newPassword'])){
					$this->_errors[] = 'Neteisingas slaptažodžio formatas naudokite tik raides ir skaicius';
				}
				if($data['newPassword'] != $data['newPasswordAgain']){
					$this->_errors[] = 'Įvesti slapyvardžiai nesutampa';
				}
			}
	}
	
	public function getErrors(){
		return $this->_errors;
	}
	
}