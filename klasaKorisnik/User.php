<?php

class User {
	public $id;
	public $first_name;
	public $last_name;
	public $age;

	function __construct($id, $first_name, $last_name, $age) {
		
		$this->id = $id;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->age = $age;
	}

	function getName() {
		
		return $this->first_name . $this->last_name;
	}

	function isAdult() {

		if($this->age >= 18 && $this->age <=130 /* you can't be too old :D */) {
			echo "User is adult.";
		} else if($this->age <= 0) {
			echo "SORRY, incorrect input!";
		} else {
			echo "User is not adult.";
		}
	}
}

$user1 = new User(100, "Veljko ", "Forcan", 30);

echo "User name is " . $user1->getName() . ";" . "<br>";
echo $user1->isAdult() . " (" . $user1->age . " years old);" . "<br>";

?>