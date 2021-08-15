<?php
namespace Classes;

include_once '../bootstrap.php';
include_once 'ACClassManager.class.php';
include_once 'Category.class.php';

class CategoryManager extends ACClassManager {
	const	SQL_TABLE = 'categories';

	public function __construct(\PDO $bdd) {
		parent::__construct($bdd);
	}

    public function add(Category $category) {
        if(!$category->getId()){

            $sql = 'INSERT INTO '.static::SQL_TABLE.' (name, parent_id) VALUES (:name, :parent_id)';
        	$r = $this->bdd->prepare($sql);
        	$r->bindValue(':name', $category->getName(), \PDO::PARAM_STR);
        	$r->bindValue(':parent_id', $category->getParent_id(), \PDO::PARAM_INT);
        	try {
        	    $r->execute();
        	} catch (\PDOException $e) {
				$this->catchError($e);
        	}
        	return ($r);
        }
    }

    public function getAllCategories(){

        $sql= 'SELECT * FROM '.static::SQL_TABLE;
        $stmt = $this->bdd->query($sql);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
      
        try{
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }catch (\PDOException $e) {
            $error = "PDOException Error: ".$e->getMessage().PHP_EOL;
        }

        return $result;
    }

    public function update(Category $category){
		if ( !$this->hasCategoryChanged($category) ) {
			return ;
		}
		try{
			$sql = "UPDATE ".static::SQL_TABLE."
				SET name = :name,
				parent_id = :parent_id
				WHERE  id = :id";
        	$r = $this->bdd->prepare($sql);
			$r->bindValue(':name', $category->getName(), \PDO::PARAM_STR);
			$r->bindValue(':parent_id', $category->getParent_id(), \PDO::PARAM_INT);
			$r->bindValue(':id', $category->getId(), \PDO::PARAM_INT);
            $r->execute();
			$_SESSION['info'][] = "Category ".$category->getName()." updated";
        } catch(\PDOException $e){
			$this->catchError($e);
        }
    }

	public function hasCategoryChanged(Category $category) {
    	$sql = "SELECT name, parent_id as parent FROM ".static::SQL_TABLE." WHERE id = ".$category->getId();
        $r = $this->bdd->query($sql);
		$r->setFetchMode(\PDO::FETCH_ASSOC|\PDO::FETCH_PROPS_LATE);
		try {
			$result = $r->fetch();
			$sqlCategory = new Category($result);	
		} catch (\PDOException $e) {
			$this->catchError($e);
		}

		return ( $sqlCategory->hasChanges($category) );
	}

	public function getById(int $id) {
        $sql = "SELECT * FROM ".static::SQL_TABLE." WHERE id = ".$id;
		try {
        	$r = $this->bdd->query($sql);
			$r->setFetchMode(\PDO::FETCH_CLASS, 'Category');
			$result= $r->fetch();
		} catch (\PDOException $e) {
			$this->catchError($e);
		}
        if ($result) {
            return new Category($result);
        } else {
            return false;
		}
	}

    public function searchCategory($search) {

        $sql = 'SELECT * FROM '.static::SQL_TABLE.' WHERE name = :search OR LOCATE(:search,description)>0 OR LOCATE(:search,name)>0';
        $r = $this->bdd->prepare($sql);
        $r->bindParam(':search', $search, \PDO::PARAM_STR);
        try {
            if ($r->execute()) {
                $r->setFetchMode(\PDO::FETCH_ASSOC);
                $results = $r->fetchAll();
            } else {
                throw new PDOException('Connection to dataBase failed');
            }
        } catch (\PDOException $e) {
            echo 'PDOError: ' . $e->getMessage() . PHP_EOL;
        }
        return ($results);
    }
}
