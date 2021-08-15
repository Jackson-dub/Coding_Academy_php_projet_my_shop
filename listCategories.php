<?php
session_start();
include_once 'bootstrap.php';

$pageInfo= array(
	'page'	=>	'list-categories',
	'title'	=>	'Categories Manager',
	'description'	=>	'Page to manage categories',
	'keywords'		=>	'connexion user shop vente ligne commerce',
	'baseDir'		=> dirname(__FILE__)
);

$connect = new Classes\Connect();
$categoryManager = new Classes\CategoryManager($connect->getBdd());
//SI LE FORMULAIRE A ETE ENVOYE
if (isset($_POST) && !empty($_POST)) {
	$categories = []; //WE SET AN EMPTY ARRAY TO STORE USERS
	for ($i = 0; $i < $_POST['cat_count']; $i++) {
		$data 				= [];
		$data['id'] 		= $_POST['id_'.$i];
		$data['name'] 		= $_POST['name_'.$i];
		$data['parent']		= $_POST['parent_'.$i];
		$categories[$i]	= new Classes\Category($data);
		unset($data);
	}
	foreach($categories as $current) {
		$categoryManager->update($current);
	}
	unset($categories);
}

$allCategories = $categoryManager->getAllCategories();

$categories = $categoryManager->getList(1);

$obj = array(
	'user' => serialize($user),
	'categories'=> serialize($categories),
	'allCategories'=> serialize($allCategories)
);

try {
	$page = new Classes\Controller($pageInfo);
	echo $page->getPage($obj);
} catch (Exception $e) {
	echo $e->getMessage();
}
