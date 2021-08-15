<?php
session_start();
include_once 'bootstrap.php';

$pageInfo = array(
	'page'	=>	'Home',
	'title'	=>	'My Shop',
	'description'	=>	'Mon super site de shop en ligne',
	'keywords'		=>	'shop vente ligne commerce',
	'baseDir'		=> dirname(__FILE__)
);


	$connect = new Classes\Connect();
	$productManager = new Classes\ProductManager($connect->getBdd());

	//SI LE FORMULAIRE A ETE ENVOYE
 	if (isset($_GET) && !empty($_GET)) {
	 $numPage  = $_GET['page'];
	 $products = $productManager->getList($numPage);
 	}else{
	 $products = $productManager->getList(1);
	 }
	
try {
	$page = new Classes\Controller($pageInfo);
	echo $page->getPage(['user' => serialize($user),'products' => serialize($products)]);
	//echo $page->getPage([,'products' => $products]);
} catch (Exception $e) {
	echo $e->getMessage();
}

//Log out pour innactivité
 if (isset($_SESSION["loggedin"]) && (time() - $_SESSION["loggedin"] > 1800)){
 	session_unset($_SESSION["loggedin"]);
	session_destroy($_SESSION["loggedin"]);
 }
?>
