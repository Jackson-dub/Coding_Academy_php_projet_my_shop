<?php

namespace Classes;

include_once 'ACClass.class.php';

class Product extends ACClass {

    private $id;
    private $name;
    private $description;
    private $price;
    private $picture;
    private $category_id;

	const UPLOADS_DIR = 'uploads/';

    public function __construct(array $data){
        parent::__construct($data);
		
    }

	//Getters
	
	public function getName(){
	    return ($this->name);
	}
	
	public function getDescription(){
	    return ($this->description);
	}
	
	public function getPrice(){
	    return ($this->price);
	}
	
	public function getPicture(){
	    return ($this->picture);
	}
	
	public function getId(){
	    return ($this->id);
	}
	
	public function getCategory_id() {
		return ($this->category->getId());
	}

	//Setters
	public function setId(int $id){
	    $this->id = $id;
	}
	
	public function setName(string $name){
	    $this->name = $name;
	}
	
	public function setDescription(string $description){
	    $this->description = $description;
	}
	
	public function setPrice(float $price){
	    if ($price > 0){
	        $this->price = $price;
	    }else{
	        $this->setErrors("Product","Product should not be free");
	    }
	}
	
	public function setPicture($picture){
	    $this->picture = $picture;
	}

	public function setCategory_id(int $category_id) {
		$this->category_id = $category_id;
	}

	public function uploadPicture() {
		$target_file = self::UPLOADS_DIR. basename($_FILES["picture"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  		$check = getimagesize($_FILES["picture"]["tmp_name"]);
  		if($check === false) {
  		  $this->setErrors("Picture", "File is not an image.");
  		}
		if (file_exists($target_file)) {
		  $this->setErrors("Picture", "Sorry, file already exists.");
		}
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  $this->setErrors("Picture", "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
		}
  		if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
			$this->picture = $target_file;
		} else {
  			$this->setErrors("Picture", "Sorry, there was an error uploading your file.");
  		}
	}

	public function hasChanges(Product $product) {
		if ($this->getName() != $product->getName())
			return (true);
		if ($this->getDescription() != $product->getDescription())
			return (true);
		if ($this->getPrice != $product->getPrice())
			return (true);
		if ($this->getPicture() != $product->getPicture())
			return (true);
		return (false);
	}
}
