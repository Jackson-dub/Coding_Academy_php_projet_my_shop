<?php
namespace Classes;

/*
 * Abstract class
 *
 * Elle possède l'attribut hydrate et check data
 */

abstract class ACClass {
	protected $mandatory_att = [];	//List of mandatory attributes for checkdata
	protected $errors 		 = [];	//Erreurs à lever

	public function __construct(array $data) {
		if ($this->checkData($data)) {
			$this->hydrate($data);
		} else {
			//$this->throwErrors();
		}
	}

	/*
	 * Function to hydrate object with data
	 */
	public function hydrate(array $data) {
		foreach($data as $key => $value) {
			$method = "set".ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			} else {
				$this->setErrors("attrUnknown", "The attribute ".$key." does not exists in ".get_class($this)." object.");
			}
		}
	}

	// SETTERS
	
	public function setMandatoryAttributes(array $data) {
		$this->mandatory_att = $data;
	}

	public function setErrors(string $typeError, string $str) {
		$error = $this->errors[$typeError] = $str . PHP_EOL;
		file_put_contents(ERROR_LOG_FILE, $error, FILE_APPEND);
	}

	//GETTERS

	//Echo all errors
	public function getErrors(string $type = NULL)
	{
		$errors = [];
		if (!empty($this->errors)) {
			foreach ($this->errors as $key => $value) {
				if ($type == NULL || $key == $type)
					$errors[] = $value;
			}
		}
		return ($errors);
	}

	public function getError($key) {
		if (!empty($this->errors))
			return $this->errors[$key];
	}

	/*
	 * Function to check whether the params are ok
	 */
	public function checkData(array $data) {
		foreach ($this->mandatory_att as $attribute) {
			if ( !array_key_exists($attribute, $data) ) {
				$this->setErrors("attrMissing", $attribute." attribute for ".get_class($this)." object missing.");
			}
		}
		return (!$this->hasErrors());
	}

	/*
	 * Function that returns true if has errors
	 * and false if no errors
	 */
	public function hasErrors() {
		return (count($this->errors));
	}
}
