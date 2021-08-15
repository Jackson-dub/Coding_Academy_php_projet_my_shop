<?php
namespace Classes;
include_once 'classes/ACClassManager.class.php';

class UserManager extends ACClassManager {

	const	SQL_TABLE = 'users';

	public function __construct(\PDO $bdd) {
		parent::__construct($bdd);
	}

    public function addUser(User &$user) {
		if ( $this->userExists($user->getEmail()) )
			$user->setErrors("general", "User exists already");
		if ($user->hasErrors())
			return (false);

        $sql = "INSERT INTO users (username, email, password, admin, token) VALUES (:username, :email, :password, :admin, :token)";
        $r = $this->bdd->prepare($sql);
		$r->bindParam(':username', $user->getUsername(), \PDO::PARAM_STR);
		$r->bindParam(':email', $user->getEmail(), \PDO::PARAM_STR);
		$r->bindParam(':password', $user->getPassword(), \PDO::PARAM_STR);
		$r->bindParam(':admin', $user->isAdmin(), \PDO::PARAM_INT);
		$r->bindParam(':token', $user->getToken(), \PDO::PARAM_STR);
		try {
			$r->execute();
			$user->setId($this->bdd->lastInsertId());
        } catch (\PDOException $e) {
			$this->catchError($e);
        }
        return ($r);
    }

	public function userExists($email) {
    	$sql = "SELECT id FROM users WHERE email = :email";
        $r = $this->bdd->prepare($sql);
		$r->bindParam(':email', $email, \PDO::PARAM_STR);
		try {
			$r->execute();
			$result = $r->fetch();
		} catch (\PDOException $e) {
			$this->catchError($e);
		}
        if ($result) {
			return (true);
        } else {
            return false;
        }
	}

    public function getUser($email, $password)
    {
    	$sql = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$password."'";
        $stmt = $this->bdd->query($sql);
		$stmt->setFetchMode(\PDO::FETCH_ASSOC|\PDO::FETCH_PROPS_LATE);
		try {
			$result = $stmt->fetch();
		} catch (\PDOException $e) {
			$this->catchError($e);
		}
        if ($result) {
            return new User($result);

        } else {
            return false;
        }
    }

    public function getUserByToken($id, $token) {
    	$sql = "SELECT * FROM users WHERE id = '".$id."' AND token = '".$token."'";
        $r = $this->bdd->query($sql);
		$r->setFetchMode(\PDO::FETCH_ASSOC|\PDO::FETCH_PROPS_LATE);
		try {
			$result = $r->fetch();
		} catch (\PDOException $e) {
			$this->catchError($e);
		}
        if ($result) {
            return new User($result);

        } else {
            return (NULL);
        }
    }

    public function getUserById($id) {
    	$sql = "SELECT * FROM users WHERE id = ".$id;
        $r = $this->bdd->query($sql);
		$r->setFetchMode(\PDO::FETCH_ASSOC|\PDO::FETCH_PROPS_LATE);
		try {
			$result = $r->fetch();
		} catch (\PDOException $e) {
			$this->catchError($e);
		}
        if ($result) {
            return new User($result);

        } else {
            return (NULL);
        }
    }


    public function updateUser(User $user){
		if ( !$this->isUserChanged($user) )
			return ;
		try{
			$sql = "UPDATE users
				SET username = :username,
				email = :email,
				admin = :admin
				WHERE  id = :id";
        	$r = $this->bdd->prepare($sql);
			$r->bindValue(':username', $user->getUsername(), \PDO::PARAM_STR);
			$r->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
			$r->bindValue(':admin', $user->isAdmin(), \PDO::PARAM_INT);
			$r->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
            $r->execute();
			$_SESSION['info'][] = "User ".$user->getUsername()." updated";
        } catch(\PDOException $e){
			$this->catchError($e);
        }
    }


	public function isUserChanged(User $user) {
    	$sql = "SELECT username, email, admin FROM users WHERE id = ".$user->getId();
        $r = $this->bdd->query($sql);
		$r->setFetchMode(\PDO::FETCH_ASSOC|\PDO::FETCH_PROPS_LATE);
		try {
			$result = $r->fetch();
			$sqlUser = new User($result);	
		} catch (\PDOException $e) {
			$this->catchError($e);
		}

		return ( $sqlUser->hasChanges($user) );
	}

	public function getAllUsers(){

		$sql = "SELECT * FROM users";
        $r = $this->bdd->query($sql);
		$r->setFetchMode(\PDO::FETCH_ASSOC|\PDO::FETCH_PROPS_LATE);
		try {
			$result = $r->fetchAll();
			return $result;
		} catch (\PDOException $e) {
			$this->catchError($e);
		}

	}

}


