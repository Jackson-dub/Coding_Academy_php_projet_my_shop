<?php
namespace Classes;
include_once('../bootstrap.php');
include_once('IClassManager.interface.php');

/*
 * Abstract class for Managers
 *
 * Elle possède l'attribut hydrate et check data
 */

abstract class ACClassManager implements \IClassManager {
	const SQL_TABLE = NULL;
	protected $bdd;

    public function __construct(\PDO $bdd) {
        $this->bdd = $bdd;
    }

    public function delete(int $id) {
    	try{
    	    $r = "DELETE FROM ".static::SQL_TABLE." WHERE id = '".$id."';";
    	    if ($quest = $this->bdd->query($r)) {
    	        echo "User has been deleted";
    	    } else{
    	        throw new \PDOException("deleteError", "User hasn't been deleted");
    	    };

    	} catch(\PDOException $e){
			$this->catchError($e);
    	}
    }

	public function getList(int $pageNumber, int $limit = 11) {
        $sql = "SELECT count(*) FROM ".static::SQL_TABLE;
		try {
        	$q = $this->bdd->query($sql);
			$nbRows= $q->fetchColumn();
		} catch (\PDOException $e) {
			$this->catchError($e);
		}
		if (!$nbRows)
			return (NULL);
        $nbPages = ceil($nbRows / $limit);
		if ($pageNumber > $nbPages)
			$pageNumber = $nbPages;

         $offset = ($pageNumber - 1) * $limit;
        
         $sql = "SELECT * FROM ".static::SQL_TABLE." LIMIT ".$limit." OFFSET ".$offset;

        $q = $this->bdd->query($sql);
		$q->setFetchMode(\PDO::FETCH_OBJ|\PDO::FETCH_PROPS_LATE);
		try {
			$r = $q->fetchAll();
		} catch (\PDOException $e) {
			$this->catchError($e);
		}
        return $r;
	}

	public function catchError(\PDOException $e) {
		$error = "PDO Exception Error: ".$e->getMessage().PHP_EOL;
		file_put_contents(ERROR_LOG_FILE, $error, FILE_APPEND);
	}
}
