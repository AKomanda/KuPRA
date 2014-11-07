<?php
	class measurementUnit
	{
		private $id;
		public $name;
		public $shortName;
		public $type;
		
		
		public function __construct($id, $name, $shortName, $type) {
			$this->id = $id;
			$this->name = $name;
			$this->shortName = $shortName;
			$this->type = $type;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function getShortName() {
			return $this->shortName;
		}
		
		public function getType() {
			return $this->type . "<br>";
		}
		
		
	}
?>