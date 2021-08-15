<?php
namespace Classes;

/*
 * Classe User
 */

include_once 'ACClass.class.php';

class User extends ACClass {
	private $id;
	private $username;
	private $email;
	private $password;
	private $admin = 0;
	private $token;

    public function __construct(array $data){
		parent::__construct($data);
	}

	public function __destruct() {
		setcookie(USER_COOKIE, NULL, time() - 100);
	}

	//GETTERS

	public function getId() {
		return ($this->id);
	}

	public function getPassword()
	{
		return ($this->password);
	}

	public function isAdmin() {
		return ($this->admin);
	}

    public function getUsername(){
		return ($this->username);
    }

    public function getEmail(){
        return ($this->email);
	}

	public function getToken() {
		return ($this->token);
	}

	//SETTERS

	public function setId(int $id) {
		$this->id = $id;
	}

	public function setUsername(string $username) {
		if (strlen($username) < 4) {
			$this->setErrors("username","Username too short");
		} else if (strlen($username) > 255) {
			$this->setErrors("username","Username too long");
		} else {
			$this->username = htmlspecialchars($username);
		}
	}

	public function setPassword($password) {
		if (strlen($password > 255)) {
			$this->setErrors("password","Password too long");
		} else {
			$this->password = hash('sha256', htmlspecialchars($password));
		}
	}

	public function setPasswordConf($password_confirmation) {
		if ($this->password != hash('sha256', htmlspecialchars($password_confirmation))) {
			$this->setErrors("passwordConf","Password don't match");
			return (false);
		}
		return (true);
	}

	public function setEmail($email)
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->setErrors('email','Please enter the correct format');
		} else {
			$this->email = htmlspecialchars($email);
		}
	}

	public function setAdmin($admin) {
		if (empty($admin) || $admin == NULL || !$admin)
			$this->admin = false;
		else
			$this->admin = true;
	}

	public function setToken($token = null) {
		if (!$token)
			$this->token= uniqid($this->username, true);
		else
			$this->token = $token;
		
	}

	public function rememberMe($option) {
		if ($option) {
			setcookie( "user_token", $this->getToken(), strtotime( '+30 days' ) );
			setcookie( "user_id", $this->getId(), strtotime( '+30 days' ) );
		}
		$_SESSION['user_id'] = $this->getId();
		$_SESSION['user_token'] = $this->getToken();
	
	}

	public function hasChanges(User $user) {
		if ($this->username != $user->getUsername())
			return (true);
		if ($this->email != $user->getEmail())
			return (true);
		if ($this->admin != $user->isAdmin())
			return (true);
		return (false);
	}
}
