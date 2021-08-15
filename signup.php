<?php
include_once 'bootstrap.php';

$data = array(
	'page'	=>	'Inscription',
	'title'	=>	'Sign Up',
	'description'	=>	'Here you can create your account for our shop',
	'keywords'		=>	'creation user shop vente ligne commerce',
	'baseDir'		=> dirname(__FILE__)
);

//SI LE FORMULAIRE A ETE ENVOYE
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user = new Classes\User($_POST);
	$user->setToken();
	if (!$user->hasErrors()) {
    	$connect = new Classes\Connect();
    	$userManager = new Classes\UserManager($connect->getBdd());
    	$userManager->addUser($user);
		$_SESSION['user_id'] = $user->getId();
		$_SESSION['user_token'] = $user->getToken();
		header("Location: index.php");
	}
} else {
	$user = NULL;
}

$obj = ['user' => serialize($user)];

try {
	$page = new Classes\Controller($data);
	echo $page->getPage($obj);
} catch (Exception $e) {
	echo $e->getMessage();
}
