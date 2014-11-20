<?php
class recepie {
	private $id;
	public $author;
	public $name;
	public $score;
	public $type;
	public $portionCount;
	public $timeToMake;
	public $products;
	public $description;
	public $photos;
	public $visibility;
	
	
	public function __construct() {
		$types = array("desertai", "gėrimai");
		$products = array(array("Pienas", "1"), array("Miltai", "2"));
		$photos = array("photo1", "photo2");
		
		$this->setId("1");
		$this->setAuthor("admin");
		$this->setName("kotletai");
		$this->setScore("10");
		$this->setType($types);
		$this->setPortionCount("3");
		$this->setTimeToMake("20");
		$this->setProducts($products);
		$this->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sagittis velit a mauris dapibus iaculis. Sed ac nisl quis leo malesuada rutrum sit amet ac massa. Nunc porttitor quis nibh et consequat. Mauris ultricies augue felis, eget bibendum neque blandit nec. Phasellus eu ultrices augue. Curabitur at auctor nisl. In sollicitudin felis ac dolor dapibus, nec ornare neque commodo.
Pellentesque eu lectus ut ligula lacinia commodo. Proin leo eros, rutrum at convallis in, cursus a dolor. Sed ut dapibus elit. Nunc iaculis risus eget nunc blandit, vel suscipit ex cursus. Donec sed ornare augue. Curabitur dictum, lectus ac suscipit aliquet, mi enim condimentum elit, id congue urna sapien rhoncus diam. Maecenas scelerisque tincidunt arcu, eu eleifend lorem laoreet at. Mauris hendrerit magna ipsum, vitae congue mauris eleifend a. Vestibulum non odio urna. Sed eros quam, condimentum id risus convallis, ultrices consectetur libero. Quisque id posuere lorem. Nulla et orci porta, commodo mi sit amet, finibus justo. Proin id mi sed tellus mollis interdum vel maximus leo. Vestibulum posuere ultricies imperdiet.");
		$this->setPhotos($photos);
		$this->setVisibility("1");
	}
	
	// get functions
	public function getId() {
		return $this->id;
	}
	
	public function getAuthor() {
		return $this->author;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getScore() {
		return $this->score;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function getPortionCount() {
		return $this->portionCount;
	}
	
	public function getTimeToMake() {
		return $this->timeToMake;
	}
	
	public function getProducts() {
		return $this->products;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function getPhotos() {
		return $this->photos;
	}
	
	public function getVisibility() {
		return $this->visibility;
	}

	//set functions
	
	public function setId($val) {
		$this->id = $val;
	}
	
	public function setAuthor($val) {
		$this->author = $val;
	}
	
	public function setName($val) {
		$this->name = $val;
	}
	
	public function setScore($val) {
		$this->score = $val;
	}
	
	public function setType($val) {
		$this->type = $val;
	}
	
	public function setPortionCount($val) {
		$this->portionCount = $val;
	}
	
	public function setTimeToMake($val) {
		$this->timeToMake = $val;
	}
	
	public function setProducts($val) {
		$this->products = $val;
	}
	
	public function setDescription($val) {
		$this->description = $val;
	}
	
	public function setPhotos($val) {
		$this->photos = $val;
	}
	
	public function setVisibility($val) {
		$this->visibility = $val;
	}
	
	
}

?>