<?php
session_start();
include_once 'bootstrap.php';

$pageInfo = array(
	'page'	=>	'createCategory',
	'title'	=>	'My Shop',
	'description'	=>	'Mon super site de shop en ligne',
	'keywords'		=>	'shop vente ligne commerce',
	'baseDir'		=> dirname(__FILE__)
);

if(!isset($user)){
	header('location:index.php');
}

if (!$user->isAdmin())
  header('Location:index.php?error='.ADMIN_FORBIDDEN);

$connect = new Classes\Connect();
$categoryManager = new Classes\CategoryManager($connect->getBdd());

if (isset($_POST) && !empty($_POST)) {
	$category = new Classes\Category($_POST);
	if (!$category->hasErrors()) {
		$categoryManager->add($category);
		header('Location: listCategories.php');
	}
}

$allCategories = $categoryManager->getAllCategories();
$obj = array(
	'user'	=> serialize($user),
	'allCategories' => serialize($allCategories)
);

try {
	$page = new Classes\Controller($pageInfo);
	echo $page->getPage($obj);
} catch (Exception $e) {
	echo $e->getMessage();
}

//Log out pour innactivité
 if (isset($_SESSION["loggedin"]) && (time() - $_SESSION["loggedin"] > 1800)){
 	session_unset($_SESSION["loggedin"]);
	session_destroy($_SESSION["loggedin"]);
 }
?>
