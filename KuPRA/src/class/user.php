<?php

include_once "meniu.php";
include_once "recepie.php";
include_once "databaseController.php";

class user
{
    public $class;
    public $nick;
    private $name;
    private $surname;
    private $photo;
    private $adress;
    private $description;
    private $login;
    private $password;
    public $menu; //valgiarastis (valgiarascio objektas)
    public $recipes;
    public $foodstuff; //maisto produktai (maisto produktu objektas)
    public $fridge;
    public $SIUnits; //SI sistemos matavimo vienetai

    //####################### GETERIAI #############################

    public function getClass(){
        return $this->class;
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

    

    










    
    