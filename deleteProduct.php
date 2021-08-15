<?php

include_once 'bootstrap.php';

$pageInfo = array(
	'page'	=>	'deleteConfirmationProduct',
	'title'	=>	'Confirm delete',
	'description'	=>	'Mon super site de shop en ligne',
	'keywords'		=>	'shop vente ligne commerce',
	'baseDir'		=> dirname(__FILE__)
);

if(!isset($user)){
	header('location:index.php');
}

if (!$user->isAdmin())
  header('Location:index.php?error='.ADMIN_FORBIDDEN);

if (!isset($_GET['product']))
	header('Location: index.php');

$connect = new Classes\Connect();
$productManager = new Classes\ProductManager($connect->getBdd());

if ( !($productToDelete = $productManager->getById($_GET['product'])) ) {
	$_SESSION['info'][] = "Le produit que vous voulez supprimer n'existe pas.";
	header('Location: index.php');
} else if ($_GET['confirm'] == true) {
	$_SESSION['info'][] = "Le produit ".$productToDelete->getName()." a bien été supprimé.";
	$productManager->delete($productToDelete->getId());
	header('Location: list-product.php');
}

$obj = array(
	'productToDelete' => serialize($productToDelete)
);

try {
	$page = new Classes\Controller($pageInfo);
	echo $page->getPage($obj);
} catch (Exception $e) {
	echo $e->getMessage();
}
?>
