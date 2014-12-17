<?php

include_once 'core/init.php';

class user
{
	public $id;
    public $class;
    public $email;
    public $nick;
    public $name;
    public $surname;
    public $photo;
    public $adress;
    public $description;
    public $login;
    private $password;
    public $menu; //valgiarastis (valgiarascio objektas)
    public $recipes;
    public $fridge;
    public $foodstuff; //maisto produktai (maisto produktu objektas)
    public $SIUnits; //SI sistemos matavimo vienetai

    //####################### KONSTRUKTORIUS #######################

    public function __construct() {
    }
    //####################### STATINIAI METODAI ####################
    
    public static function getUser($id) {
    	$user = new user;
    	$user->setId($id);
    	$data = databaseController::getDB()->get("vartotojas", array("id", "=", $id));
    	if($data->error()){
    		return false;
    	}else{
    		$userData = $data->results()[0];
    	}
    	$user->class = $userData->Teises;
    	$user->setName($userData->Vardas);
    	$user->setSurname($userData->Pavarde);
    	$user->setAdress($userData->Adresas);
    	$user->setNick($userData->Slapyvardis);
    	$user->setDescription($userData->Aprasymas);
    	$user->setPhoto($userData->Nuotrauka);
    	$user->setLogin($userData->Slapyvardis);
    	$user->setPassword($userData->Slaptazodis);
    	$user->setEmail($userData->pastas);
    	$user->menu = meniu::getMeniu($id);
    	$products = databaseController::getDB()->get('saldytuvas', array('Vartotojas', '=', $id))->results();
    	$fridge = array();
    	foreach($products as $item){
    		$product = Product::getProduct($item->Produktas);
    		$amount = $item->Kiekis;
    		$mesure = databaseController::getDB()->get('matavimo_vienetai', array('ID', '=', $item->Matavimo_vienetas))->results();
    		$fridge[] = array(
    				'id' => $item->Produktas,
    				'product' => $product,
    				'amount' => $amount,
    				'mesure' => $item->Matavimo_vienetas);
    	}
    	$user->fridge = $fridge;
    	return $user;
    }
    
    public static function create($data = array()){
    	return databaseController::getDB()->insert('vartotojas', array(
    		'teises' => 'user',
    		'vardas' => '',
    		'pavarde' => '',
    		'adresas' => '',
    		'slapyvardis'=> $data['nick'],
    		'nuotrauka' => '../resources/default/user/default.png',
    		'slaptazodis' => password_hash($data['password'], PASSWORD_DEFAULT),
    		'aprasymas' => '',
    		'login' => $data['login'],
    		'pastas' => $data['email']));
    }
    
    public static function find_by_id($id){
    	$user = databaseController::getDB()->get('vartotojas', array('id', '=', $id));
    	if ($user->count() > 0){
    		return $user->results()[0];
    	}else{
    		return false;
    	}
    }
    
    public static function find_by_login($login){
    	$user = databaseController::getDB()->get('vartotojas', array('login', '=', $login));
    	if ($user->count() > 0){
    		return $user->results()[0];
    	}else{
    		return false;
    	}
    }
    
    public static function login($login, $password){
    	if(!User::isLoggedIn()){
    		if($user = User::find_by_login($login)){
    			if(User::authenticate($user, $password)){
    				$_SESSION['current_user'] = $user->ID;
    				#self::$current_user = User::getUser($user->ID);
    				return true;
    			}else{
    				return false;
    			}
    		}else{
    			return false;
    		}
    	}else{
    		return false;
    	}
    }
    
    public static function authenticate($user = null, $password = null){
    	if($user){
    		if($password){
    			return password_verify($password, $user->Slaptazodis);
    		}
    	}else{
    		return false;
    	}	
    }
    
    public static function current_user(){
    	$id = $_SESSION['current_user'];
    	return User::getUser($id);
    	#return self::$current_user;
    }
    
    public static function isLoggedIn(){
    	if(isset($_SESSION['current_user'])){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    public static function logOut(){
    	if(User::isLoggedIn()){ 
    		unset($_SESSION['current_user']);
    		if(session_destroy()){
    			//redirect
    		}
    	}
    }
    
    //####################### INSTANCE METHODS ####################
    //####################### GETERIAI ############################
    
    public function getClass(){
        return $this->class;
    }
    
    public function getFridgeContent(){
    	$this->updateFridge();
    	return $this->fridge;
    }
    
    public function isAdmin(){
    	if($this->class == 'admin'){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    private function updateFridge(){
    	$products = databaseController::getDB()->get('saldytuvas', array('Vartotojas', '=', $this->id))->results();
    	$fridge = array();
    	foreach($products as $item){
    		if($item->Kiekis <= 0){
    			databaseController::getDB()->delete('saldytuvas', array('ID', '=', $item->ID));
    		}else{
    		$product = Product::getProduct($item->Produktas);
    		$amount = $item->Kiekis;
    		$mesure = databaseController::getDB()->get('matavimo_vienetai', array('ID', '=', $item->Matavimo_vienetas))->results();
    		$fridge[$item->ID] = array(
    				'id' => $item->ID,
    				'product' => $product,
    				'amount' => $amount,
    				'mesure' => $item->Matavimo_vienetas);
    		}
    	}
    	$this->fridge = $fridge;
    }

    public function getMenuProducts(){
    	$db = databaseController::getDB();
    	$recepies = $db->query("SELECT * FROM valgiarastis WHERE Vartotojas = ? AND Pagamintas = ?", array($this->id, 0));
		if($recepies->count() === 0){
			return "Jūsų valgiaraštis yra tuščias";
		}else{
			$recepies = $recepies->results();
		}
		$products = array();
		foreach($recepies as $recepie){
			$recPortions = $db->get('receptai', array("ID", '=', $recepie->Receptas))->results()[0]->Porciju_skaicius;
			$menuPortions = $recepie->Porciju_skaicius;
			$ingridients = $db->get('recepto_produktai', array('Receptas', '=', $recepie->Receptas))->results();
			foreach($ingridients as $ingridient){
				$exists = false;
				foreach($products as $key => $product){
					if($product['product'] == $ingridient->Produktas && $product['measure'] == $ingridient->Matavimo_vienetas){
						$products[$key]['amount'] += $ingridient->Kiekis * $menuPortions / $recPortions;
						$exists = true;
					}				
				}
				if(!$exists){
				
					$products[] = array('product' => $ingridient->Produktas,
							'amount' => $ingridient->Kiekis  * $menuPortions / $recPortions,
							'measure' => $ingridient->Matavimo_vienetas);
				}
			}
		}
		$fridge = $this->getFridgeContent();
		#print_r($fridge);
		foreach($products as $key => $product){
			foreach($fridge as $f){
				if($product['product'] == $f['product']->id && $product['measure'] == $f['mesure'] ){
					if($product['amount'] > $f['amount']){
						$products[$key]['amount'] -= $f['amount'];
					}else{
						unset($products[$key]);
					}
				}
			}
		}
		if(!empty($products)){
			return $products;
		}else{
			return 'Jums nieko netruksta';
		}
		
    }
    
    public function getNick(){
        return $this->nick;
    }

    private function getName(){
        return $this->name;
    }

    private function getSurname(){
        return $this->surname;
    }

    private function getPhoto(){
        return $this->photo;
    }

    private function getAdress(){
        return $this->adress;
    }

    private function getDescription(){
        return $this->description;
    }

    private function getLogin(){
        return $this->login;
    }

    private function getPassword(){
        return $this->password;
    }

    //#############################################################




    //###################### SETERIAI #############################

    private function setId($id){
    	$this->id = $id;
    }
    
    private function setEmail($email){
    	$this->email = $email;
    }
    
    private function setPassword($pass){
        $this->password = $pass;
    }

    private function setNick($nick){
        $this->nick = $nick;
    }

    private function setName($name){
        $this->name = $name;
    }

    private function setSurname($surname){
        $this->surname = $surname;
    }

    private function setPhoto($photo){
        $this->photo = $photo;
    }

    private function setAdress($adress){
        $this->adress = $adress;
    }

    private function setDescription($description){
        $this->description = $description;
    }

    private function setLogin($login){
        $this->login = $login;
    }

    //#############################################################
    


    
    //############################ 2 - 5  UZSAKOVO REIKALAVIMAI ###########################

	public function matchPassword($password){
		return password_verify($password, $this->password);
	}
    
    private function makeAdmin(){
        $this->class = "Administrator"; //arba skaicius
    }

    private function makeUser(){
        $this->class = "User"; //arba skaicius
    }

    private function makeDish(){
    
    }

    private function evaluateDish(){

    }

    private function isMakeableDish(){

    }

    /*
     * ko reikia, kad pagaminti konkretu patiekala (recepta)
     */

    private function missingProducts(){

    }

    /*
     * ko reikia, kad pagaminti visus valgiarascio patiekalus (receptus)
     */

    private function whatsNeededForAll(){

    }

    /*
     * modifyWhatsNeededForAllList
     */

    private function modifyWNFAList(){ 

    }

    /*
     * insertWhatsNeededForAllList
     */

    private function insertWNFAList(){ 

    }

    //###################################################################################

    


    //######################## VARTOTOJAS TVARKO ESYBES ############################

    private function createFoodstuff(){
    
    }

    private function createRecipe(){

    }

    private function modRecipe(){    //mod - modify

    }

    private function delRecipe(){    //del - delete

    }

    private function delFromMenu(){

    }

    private function insertToMenu(){

    }

    private function delFromFridge(){

    }

    private function insertToFridge(){
  
    }
 
    //###############################################################################

   


    //########################## ADMINISTRATORIUS TVARKO ESYBES #############################

    private function createSIUnit(){    //kaip suprantu, pasitikslinus su uzsakovu, matavimo vienetus kuria tik administratorius

    }

    private function modSIUnit(){

    }

    private function delSIUnit(){

    }

    private function modFoodStuff(){

    }

    private function delFoodStuff(){

    }

    private function adminModRecipe(){

    }

    private function adminDelRecipe(){

    }

    //######################################################################################

}

?>

    

    










    
    