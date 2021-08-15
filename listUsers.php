<?php
session_start();
include_once 'bootstrap.php';

$pageInfo= array(
	'page'	=>	'list-users',
	'title'	=>	'Sign In',
	'description'	=>	'Here you can connect to your account',
	'keywords'		=>	'connexion user shop vente ligne commerce',
	'baseDir'		=> dirname(__FILE__)
);

$connect = new Classes\Connect();
$userManager = new Classes\UserManager($connect->getBdd());
//SI LE FORMULAIRE A ETE ENVOYE
if (isset($_POST) && !empty($_POST)) {
	$users = []; //WE SET AN EMPTY ARRAY TO STORE USERS
	for ($i = 0; $i < $_POST['user_count']; $i++) {
		$data 				= [];
		$data['id'] 		= $_POST['id_'.$i];
		$data['username'] 	= $_POST['username_'.$i];
		$data['email'] 		= $_POST['email_'.$i];
		$data['admin'] 		= $_POST['admin_'.$i];
		$users[$i]	= new Classes\User($data);
		unset($data);
	}
	foreach($users as $currUser) {
		$userManager->updateUser($currUser);
	}
	unset($users);
}


if($_GET['page']){
	$users = $userManager->getList($_GET['page']);
   }else{
   $users = $userManager->getList(1);
}


$obj = array(
	'user' => serialize($user),
	'users'=> serialize($users)
);

try {
	$page = new Classes\Controller($pageInfo);
	echo $page->getPage($obj);
} catch (Exception $e) {
	echo $e->getMessage();
}
