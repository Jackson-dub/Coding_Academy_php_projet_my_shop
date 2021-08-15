<?php
namespace Classes;

include_once '../bootstrap.php';
include_once 'ACClassManager.class.php';
include_once 'Product.class.php';

class ProductManager extends ACClassManager {
	const	SQL_TABLE = 'products';

	public function __construct(\PDO $bdd) {
		parent::__construct($bdd);
	}

    public function addProduct(Product $product) {
     
        if($product->getId() == 0){
            $sql = 'INSERT INTO products (name, description, price, picture) VALUES (:name, :description, :price, :picture)';
        	$r = $this->bdd->prepare($sql);
        	$r->bindValue(':name', $product->getName(), \PDO::PARAM_STR);
        	$r->bindValue(':price', $product->getPrice(), \PDO::PARAM_STR);
        	$r->bindValue(':description', $product->getDescription(), \PDO::PARAM_STR);
        	$r->bindValue(':picture', $product->getPicture(), \PDO::PARAM_STR);
        	try {
        	    $r->execute();
        	} catch (\PDOException $e) {
				$this->catchError($e);
                echo "product not added";
        	}
        }
    }


    public function deleteProduct($product)
    {
        $sql = "DELETE FROM products WHERE id = ?";
        $query = $this->bdd->prepare($sql);
        if ($query->execute([$product->getid()])) {
            echo "Product has been removed";
        } else {
            $product->setErrors("deleteError", "Product hasn't been removed");
        }
    }

   
    public function getProduct($id)
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->bdd->query($sql);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        if ($result) {
            return new Product($result);
        } else {
            return false;
        }
    }

    public function getAllProducts(){

        $sql= 'SELECT * FROM products';
        $stmt = $this->bdd->query($sql);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC | \PDO::FETCH_PROPS_LATE);
      
        try{
            $result = $stmt->fetchAll();
        }catch (\PDOException $e) {
            $error = "PDOException Error: ".$e->getMessage().PHP_EOL;
        }

        return $result;
    }

    public function updateProduct(Product $product){
		if ( !$this->hasProductChanged($product) )
			return ;
		if ($_FILES['picture']['size'] > 0)
			$product->uploadPicture();
		try{
			$sql = "UPDATE ".static::SQL_TABLE."
				SET name = :name,
				description = :description,
				price = :price,
				picture = :picture
				WHERE  id = :id";
        	$r = $this->bdd->prepare($sql);
			$r->bindValue(':name', $product->getName(), \PDO::PARAM_STR);
			$r->bindValue(':description', $product->getDescription(), \PDO::PARAM_STR);
			$r->bindValue(':price', $product->getPrice(), \PDO::PARAM_STR);
			$r->bindValue(':picture', $product->getPicture(), \PDO::PARAM_STR);
			$r->bindValue(':id', $product->getId(), \PDO::PARAM_INT);
            $r->execute();
			$_SESSION['info'][] = "Product".$product->getName()." updated";
        } catch(\PDOException $e){
			$this->catchError($e);
        }
    }

	public function hasProductChanged(Product $product) {
    	$sql = "SELECT name, description, price, picture FROM ".static::SQL_TABLE." WHERE id = ".$product->getId();
        $r = $this->bdd->query($sql);
		$r->setFetchMode(\PDO::FETCH_ASSOC|\PDO::FETCH_PROPS_LATE);
		try {
			$result = $r->fetch();
			$sqlProduct = new Product($result);	
		} catch (\PDOException $e) {
			$this->catchError($e);
		}

		return ( $sqlProduct->hasChanges($product) );
	}

	public function getById(int $id) {
        $sql = "SELECT * FROM ".static::SQL_TABLE." WHERE id = ".$id;
		try {
        	$r = $this->bdd->query($sql);
			$r->setFetchMode(\PDO::FETCH_CLASS, 'Product');
			$result= $r->fetch();
		} catch (\PDOException $e) {
			$this->catchError($e);
		}
        if ($result) {
            return new Product($result);
        } else {
            return false;
		}
	}

    public function searchProducts($search)
    {
        $sql = 'SELECT * FROM products WHERE name = :search OR LOCATE(:search,description)>0 OR LOCATE(:search,name)>0';
        $r = $this->bdd->prepare($sql);
        $r->bindParam(':search', $search, \PDO::PARAM_STR);
        try {
            if ($r->execute()) {
                $r->setFetchMode(\PDO::FETCH_ASSOC);
                $results = $r->fetchAll();
            } else {
                throw new \PDOException('Connection to dataBase failed');
            }
        } catch (\PDOException $e) {
            echo 'PDOError: ' . $e->getMessage() . PHP_EOL;
        }
        return ($results);
    }
}
