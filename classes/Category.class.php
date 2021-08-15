<?php

namespace Classes;

include_once 'ACClass.class.php';
include_once 'Connect.class.php';
include_once 'CategoryManager.class.php';

class Category extends ACClass {
	private $id;
	private $name;
	private $parent = NULL;
	
	//GETTERS
	public function getId(){
	    return ($this->id);
	}

	public function getName(){
	    return ($this->name);
	}

	public function getParent() {
		if (isset($this->parent) && !empty($this->parent))
			return ($this->parent);
	}
	public function getParent_id(){
		if (isset($this->parent) && !empty($this->parent))
		    return ($this->parent->getId());
		else
			return 'NULL';
	}

	//SETTERS
	public function setId(int $id){
	    $this->id = $id;
	}
	
	public function setName(string $name){
	    $this->name = $name;
	}

	public function setParent(int $parent_id) {
		$connect = new Connect();
		$categoryManager = new CategoryManager($connect->getBdd());
		$this->parent = $categoryManager->getById($parent_id);
		unset($categoryManager);
		unset($connect);
	}

	//OTHER METHODS
	public function hasChanges(Category $category) {
		if ($this->getName() != $category->getName())
			return (true);
		if ($this->getParent() != $category->getParent())
			return (true);
		return (false);
	}
}
