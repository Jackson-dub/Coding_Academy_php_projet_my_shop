<?php

namespace Classes;

include_once '../bootstrap.php';

class Connect{
	private $bdd;

	public function __construct() {
		try {
			$this->bdd = new \PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);
			$this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch (\PDOException $e) {
			$error = "PDO ERROR: ".$e->getMessage()." storage in ".ERROR_LOG_FILE.PHP_EOL;
			print($error);
			print("Error connection to DB".PHP_EOL);
			file_put_contents(ERROR_LOG_FILE, $error, FILE_APPEND);
			unset($error);
			die;
		}
	}

	public function getBdd() {
		return ($this->bdd);
	}
}
