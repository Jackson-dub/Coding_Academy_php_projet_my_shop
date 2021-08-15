<?php
session_start();
include_once 'bootstrap.php';

$pageInfo = array(
	'page'	=>	'editProduct',
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
$productManager = new Classes\ProductManager($connect->getBdd());

if (isset($_POST) && !empty($_POST) && isset($_FILES) && !empty($_FILES) ) {
	$product = new Classes\Product($_POST);
	if (!$product->hasErrors()) {
		$productManager->updateProduct($product);
		header('Location: list-product.php');
	}
}

if ( !isset($_GET['product']) || !($product = $productManager->getById($_GET['product'])) )
	header('Location: index.php');

$obj = array(
	'user' => serialize($user),
	'product' => serialize($product)
);

try {
	$page = new Classes\Controller($pageInfo);
	echo $page->getPage($obj);
}catch (Exception $e) {
	echo $e->getMessage();
}

//Log out pour innactivité
 if (isset($_SESSION["loggedin"]) && (time() - $_SESSION["loggedin"] > 1800)){
 	session_unset($_SESSION["loggedin"]);
	session_destroy($_SESSION["loggedin"]);
 }
?>
